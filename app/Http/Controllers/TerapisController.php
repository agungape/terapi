<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Pelatihan;
use App\Models\Terapis;
use App\Models\TerapisPelatihan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class TerapisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $terapis = Terapis::orderBy('nib')->paginate(5);
        foreach ($terapis as $t) {
            $tanggal_lahir = Carbon::parse($t->tanggal_lahir);
            $t->usia = $tanggal_lahir->diffInYears(Carbon::now());
        }
        return view('terapis.index', ['t' => $terapis]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $terapi = new Terapis();
        // buat kode barang BR005
        $terapi->nib = 'BSC' . str_pad(Terapis::count() + 1, 2, '0', STR_PAD_LEFT);
        return view('terapis.create', compact('terapi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nib' => 'required|alpha_num|size:5|unique:terapis,nib',
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'telepon' => 'required|numeric',
        ]);
        $terapis = Terapis::create($validateData);
        Alert::success('Berhasil', "Data Terapis $request->nama berhasil dibuat");
        return redirect("/terapis#card-{$terapis->id}");
    }

    /**
     * Display the specified resource.
     */
    public function show(Terapis $terapi)
    {
        $tanggal_lahir = Carbon::parse($terapi->tanggal_lahir)->diffInYears(Carbon::now());
        $activity = Kunjungan::where('terapis_id', $terapi->id)->orderBy('created_at', 'desc')->paginate(10);
        $terapis = Terapis::with(['pelatihans' => function ($query) {
            $query->withPivot('tanggal', 'sertifikat', 'id');
        }])->where('id', $terapi->id)->first();
        return view('terapis.detail', compact('terapi', 'terapis', 'activity', 'tanggal_lahir'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Terapis $terapi)
    {
        return view('terapis.edit', compact('terapi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Terapis $terapi)
    {
        $validateData = $request->validate([
            'nib' => 'required|alpha_num|size:5|unique:terapis,nib,' . $terapi->id,
            'nama' => 'required',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'telepon' => 'required|numeric',
            'alamat' => 'required',
            'status' => 'required'
        ]);
        $terapi->update($validateData);
        Alert::success('Berhasil', "Terapis $request->nama telah di update");
        // Trik agar halaman kembali ke halaman asal
        return redirect($request->url_asal);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Terapis $terapi)
    {
        $terapi->delete();
        Alert::success('Berhasil', "$terapi->nama telah di hapus");
        return redirect("/terapis");
    }

    public function terapis_pelatihan(Terapis $terapi)
    {
        $pelatihan = Pelatihan::all();
        return view('terapis.pelatihan', compact('terapi', 'pelatihan'));
    }

    public function pelatihan_store(Request $request)
    {
        $nama = Terapis::where('id', $request->terapis_id)->first();
        $request->validate([
            'sertifikat' => 'required|mimes:pdf|max:10240',
        ]);

        $file = $request->file('sertifikat');
        $extFile = $file->getClientOriginalExtension();
        $namaFile =
            $nama->nama . "-" . time() . "." . $extFile;
        $path = 'sertifikat/' . $namaFile;

        Storage::disk('public')->put($path, file_get_contents($file));

        $data['terapis_id'] = $request->terapis_id;
        $data['pelatihan_id'] = $request->pelatihan_id;
        $data['tanggal'] = $request->tanggal;
        $data['sertifikat'] = $namaFile;

        TerapisPelatihan::create($data);
        Alert::success('Berhasil', "Sertifikat berhasil Di Upload");
        return redirect('/terapis/' . $request->terapis_id);
    }

    public function sertifikat_show($sertifikat)
    {
        $file = TerapisPelatihan::findOrFail($sertifikat);
        $ext = pathinfo(
            Storage::disk('public')->path('sertifikat/' . $file->sertifikat),
            PATHINFO_EXTENSION
        );

        return Storage::disk('public')->download('sertifikat/' . $file->sertifikat, 'preview.' . $ext, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $file->sertifikat . '"',
        ]);
    }
}

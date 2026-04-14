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
    public function __construct()
    {
        $this->middleware('permission:view terapis', ['only' => ['index']]);
        $this->middleware('permission:create terapis', ['only' => ['create', 'store']]);
        $this->middleware('permission:show terapis', ['only' => ['show', 'terapis_pelatihan', 'pelatihan_store', 'sertifikat_show']]);
        $this->middleware('permission:update terapis', ['only' => ['update', 'edit', 'ubahStatus']]);
        $this->middleware('permission:delete terapis', ['only' => ['destroy']]);
        $this->middleware('permission:delete foto terapis', ['only' => ['deleteFoto']]);
    }

    public function index(Request $request)
    {
        $query = Terapis::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                  ->orWhere('nib', 'like', "%$search%")
                  ->orWhere('telepon', 'like', "%$search%")
                  ->orWhere('alamat', 'like', "%$search%");
            });
        }

        $terapis = $query->orderBy('status', 'asc')->paginate(5)->withQueryString();
        
        // Calculate next ID for the modal
        $lastTerapis = Terapis::orderBy('id', 'desc')->first();
        $nextId = $lastTerapis ? $lastTerapis->id + 1 : 1;
        $newNib = 'BSC' . str_pad($nextId, 2, '0', STR_PAD_LEFT);

        return view('terapis.index', compact('terapis', 'newNib'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lastTerapis = Terapis::orderBy('id', 'desc')->first();
        $nextId = $lastTerapis ? $lastTerapis->id + 1 : 1;
        $newKode = 'BSC' . str_pad($nextId, 2, '0', STR_PAD_LEFT);

        // Membuat objek baru untuk terapis
        $terapi = new Terapis();
        $terapi->nib = $newKode;

        return view('terapis.create', compact('terapi', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nib' => 'required|alpha_num|size:5|unique:terapis,nib',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'telepon' => 'required|numeric',
            'perguruan_tinggi' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'role' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        if ($request->file('foto')) {
            $file = $request->file('foto');
            $extFile = $file->getClientOriginalExtension();
            $namaFile = "terapis-" . time() . "." . $extFile;
            $path = 'terapis/' . $namaFile;
            Storage::disk('public')->put($path, file_get_contents($file));
            $validateData['foto'] = $namaFile;
        }

        $terapis = Terapis::create($validateData);
        return redirect("/terapis")->with('success', "Data Terapis $request->nama berhasil dibuat");
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
        $role = [
            'terapi_perilaku' => 'Terapi Perilaku',
            'fisioterapi' => 'Fisioterapi'
        ];

        return view('terapis.edit', compact('terapi', 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Terapis $terapi)
    {
        $validateData = $request->validate([
            'nib' => 'required|alpha_num|size:5|unique:terapis,nib,' . $terapi->id,
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'telepon' => 'required|numeric',
            'alamat' => 'required|string',
            'perguruan_tinggi' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'role' => 'required',
            'status' => 'required|in:aktif,nonaktif',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        if ($request->file('foto')) {
            // Hapus foto lama jika ada
            if ($terapi->foto) {
                Storage::disk('public')->delete('terapis/' . $terapi->foto);
            }

            // Simpan foto baru
            $file = $request->file('foto');
            $extFile = $file->getClientOriginalExtension();
            $namaFile = "terapis-" . time() . "." . $extFile;
            $path = 'terapis/' . $namaFile;
            Storage::disk('public')->put($path, file_get_contents($file));

            // Update data foto
            $validateData['foto'] = $namaFile;
        }

        $terapi->update($validateData);
        // Trik agar halaman kembali ke halaman asal
        return redirect()->back()->with('success', "Terapis $request->nama telah di update");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Terapis $terapi)
    {
        $terapi->delete();
        return redirect("/terapis")->with('success', "$terapi->nama telah di hapus");
    }

    public function deleteFoto($id)
    {
        // Cari data anak berdasarkan ID
        $terapis = Terapis::findOrFail($id);

        // Pastikan anak memiliki foto sebelum menghapus
        if ($terapis->foto) {
            // Hapus foto dari penyimpanan
            Storage::disk('public')->delete('terapis/' . $terapis->foto);

            // Update kolom foto di database menjadi null
            $terapis->update(['foto' => null]);

            return redirect()->back()->with('success', "Foto terapis {$terapis->nama} berhasil dihapus");
        } else {
            return redirect()->back()->with('error', "terapis {$terapis->nama} tidak memiliki foto untuk dihapus");
        }

        return redirect()->back();
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
        return redirect('/terapis/' . $request->terapis_id)->with('success', "Sertifikat berhasil Di Upload");
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

    public function ubahStatus(Request $request)
    {
        $terapis = Terapis::find($request->id);

        // Toggle status between 'aktif' and 'nonaktif'
        if ($terapis) {
            $terapis->status = $terapis->status === 'aktif' ? 'nonaktif' : 'aktif';
            $terapis->save();

            return response()->json([
                'status' => 'success',
                'newStatus' => $terapis->status,
                'message' => 'Status Terapis ' . $terapis->nama . ' berhasil diperbarui.',
            ]);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Terapis tidak ditemukan.',
        ], 404);
    }
}

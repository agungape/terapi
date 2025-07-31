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

    public function index()
    {
        $terapis = Terapis::orderBy('nib')->paginate(5);
        return view('terapis.index', ['terapis' => $terapis]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lastTerapis = Terapis::orderBy('nib', 'desc')->first();
        $role = [
            'Terapi Perilaku' => 'Terapi Perilaku',
            'Fisioterapi' => 'Fisioterapi'
        ];

        // Jika tidak ada terapis, mulai dengan BSC01
        if ($lastTerapis) {
            // Mengambil angka terakhir dari nib (kode terapis)
            preg_match('/\d+/', $lastTerapis->nib, $matches);
            $lastNumber = (int)$matches[0];

            // Menambahkan 1 untuk kode baru
            $newNumber = $lastNumber + 1;

            // Format kode baru dengan menambahkan 0 di depan agar totalnya 5 karakter
            $newKode = 'BSC' . str_pad($newNumber, 2, '0', STR_PAD_LEFT);  // Menggunakan 2 digit angka setelah BSC
        } else {
            // Jika belum ada terapis, mulai dengan BSC01
            $newKode = 'BSC01';
        }

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
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'telepon' => 'required|numeric',
            'role' => 'nullable',
        ]);

        $terapis = Terapis::create($validateData);
        Alert::success('Berhasil', "Data Terapis $request->nama berhasil dibuat");
        return redirect("/terapis");
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
            'Terapi Perilaku' => 'Terapi Perilaku',
            'Fisioterapi' => 'Fisioterapi'
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
            'nama' => 'required',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'telepon' => 'required|numeric',
            'alamat' => 'required',
            'perguruan_tinggi' => 'nullable',
            'jurusan' => 'nullable',
            'role' => 'nullable',
            'status' => 'required',
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
        Alert::success('Berhasil', "Terapis $request->nama telah di update");
        // Trik agar halaman kembali ke halaman asal
        return redirect()->back();
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

            // Notifikasi sukses
            Alert::success('Berhasil', "Foto terapis {$terapis->nama} berhasil dihapus");
        } else {
            // Notifikasi jika tidak ada foto
            Alert::warning('Gagal', "terapis {$terapis->nama} tidak memiliki foto untuk dihapus");
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

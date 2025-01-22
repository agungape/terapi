<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Kunjungan;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use function Symfony\Component\String\b;

class AnakController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view anak', ['only' => ['index']]);
        $this->middleware('permission:create anak', ['only' => ['create', 'store']]);
        $this->middleware('permission:show anak', ['only' => ['show']]);
        $this->middleware('permission:update anak', ['only' => ['update', 'edit', 'ubahStatus']]);
        $this->middleware('permission:delete anak', ['only' => ['destroy']]);
    }

    public function index()
    {
        $anak = Anak::orderBy('nib')->paginate(5);

        foreach ($anak as $a) {
            $tanggal_lahir = Carbon::parse($a->tanggal_lahir);
            $a->usia = $tanggal_lahir->diffInYears(Carbon::now());

            $progres = Kunjungan::where('anak_id', $a->id)->whereIn('status', ['hadir', 'izin'])->count();

            // Hitung progres berdasarkan jumlah kunjungan
            $a->progresnilai = ($progres >= 20) ? 100 : ($progres * 5); // 5% untuk setiap kunjungan
        }

        return view('anak.index', ['anaks' => $anak]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pendidikan = [
            'belum' => 'Belum Sekolah',
            'PAUD' => 'PAUD',
            'TK' => 'TK',
            'SD' => 'SD',
            'SMP' => 'SMP',
            'SMA' => 'SMA'
        ];

        $pendidikan_orangtua = [
            'tidak' => 'Tidak Sekolah',
            'SD' => 'SD',
            'SMP' => 'SMP',
            'SMA' => 'SMA',
            'S1' => 'S1',
            'S2' => 'S2',
            'S3' => 'S3',
            'Prof' => 'Prof'
        ];

        $agama = [
            'islam' => 'Islam',
            'katolik' => 'Katolik',
            'protestan' => 'Protestan',
            'hindu' => 'Hindu',
            'budha' => 'Budha',
            'konghuchu' => 'Konghuchu'
        ];

        $anak = new Anak();
        // buat kode anak BSC001
        $anak->nib = 'BSC' . str_pad(Anak::count() + 1, 3, '0', STR_PAD_LEFT);
        return view('anak.create', compact('anak', 'pendidikan', 'pendidikan_orangtua', 'agama'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->tanggal_lahir);

        $validateData = $request->validate([
            'nib' => 'required|alpha_num|size:6|unique:anaks,nib',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'pendidikan' => 'required',
            'alamat' => 'required',
            'anak_ke' => 'nullable|numeric',
            'total_saudara' => 'nullable|numeric',
            'diagnosa' => 'nullable',
            'nama_ayah' => 'nullable',
            'nama_ibu' => 'nullable',
            'telepon_ayah' => 'nullable|numeric',
            'telepon_ibu' => 'nullable|numeric',
            'umur_ayah' => 'nullable|numeric',
            'umur_ibu' => 'nullable|numeric',
            'pendidikan_ayah' => 'nullable',
            'pendidikan_ibu' => 'nullable',
            'pekerjaan_ayah' => 'nullable',
            'pekerjaan_ibu' => 'nullable',
            'agama_ayah' => 'nullable',
            'agama_ibu' => 'nullable',
            'alamat_ayah' => 'nullable',
            'alamat_ibu' => 'nullable',
            'suku_ayah' => 'nullable',
            'suku_ibu' => 'nullable',
            'pernikahan_ayah' => 'nullable|numeric',
            'pernikahan_ibu' => 'nullable|numeric',
            'usia_saat_hamil_ayah' => 'nullable',
            'usia_saat_hamil_ibu' => 'nullable',
        ]);
        $anak = Anak::create($validateData);
        Alert::success('Berhasil', "Data Anak $request->nama berhasil dibuat");
        return redirect("/anak#card-{$anak->id}");
    }

    /**
     * Display the specified resource.
     */
    public function show(Anak $anak)
    {
        $kunjungan = Kunjungan::where('anak_id', $anak->id)->orderBy('pertemuan')->paginate(5);
        return view('anak.detail', compact('kunjungan', 'anak'));
    }


    public function edit(Anak $anak)
    {

        // dd($anak->tanggal_lahir);
        $pendidikan = [
            'belum' => 'Belum Sekolah',
            'TK' => 'TK',
            'SD' => 'SD',
            'SMP' => 'SMP',
            'SMA' => 'SMA'
        ];

        $pendidikan_orangtua = [
            'tidak' => 'Tidak Sekolah',
            'SD' => 'SD',
            'SMP' => 'SMP',
            'SMA' => 'SMA',
            'S1' => 'S1',
            'S2' => 'S2',
            'S3' => 'S3',
            'Prof' => 'Prof'
        ];

        // foreach ($anak as $a) {
        //     if ($a->tanggal_lahir) {
        //         // Mengubah format ke 'd/m/Y'
        //         $a->tanggal_lahir = $a->tanggal_lahir->format('d/m/Y');
        //     } else {
        //         $a->tanggal_lahir = null; // Jika tanggal_lahir null, tetap null
        //     }
        // }

        $agama = ['islam' => 'Islam', 'katolik' => 'Katolik', 'protestan' => 'Protestan', 'hindu' => 'Hindu', 'budha' => 'Budha', 'konghuchu' => 'Konghuchu'];
        return view('anak.edit', compact('anak', 'pendidikan', 'pendidikan_orangtua', 'agama'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anak $anak): RedirectResponse
    {
        $validateData = $request->validate([
            'nib' => 'required|alpha_num|size:6|unique:anaks,nib,' . $anak->id,
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'pendidikan' => 'required',
            'alamat' => 'required',
            'anak_ke' => 'nullable|numeric',
            'total_saudara' => 'nullable|numeric',
            'diagnosa' => 'nullable',
            'nama_ayah' => 'nullable',
            'nama_ibu' => 'nullable',
            'telepon_ayah' => 'nullable|numeric',
            'telepon_ibu' => 'nullable|numeric',
            'umur_ayah' => 'nullable|numeric',
            'umur_ibu' => 'nullable|numeric',
            'pendidikan_ayah' => 'nullable',
            'pendidikan_ibu' => 'nullable',
            'pekerjaan_ayah' => 'nullable',
            'pekerjaan_ibu' => 'nullable',
            'agama_ayah' => 'nullable',
            'agama_ibu' => 'nullable',
            'alamat_ayah' => 'nullable',
            'alamat_ibu' => 'nullable',
            'suku_ayah' => 'nullable',
            'suku_ibu' => 'nullable',
            'pernikahan_ayah' => 'nullable|numeric',
            'pernikahan_ibu' => 'nullable|numeric',
            'usia_saat_hamil_ayah' => 'nullable',
            'usia_saat_hamil_ibu' => 'nullable',
        ]);
        $anak->update($validateData);
        Alert::success('Berhasil', "Anak $request->nama telah di update");
        // Trik agar halaman kembali ke halaman asal
        return redirect($request->url_asal);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anak $anak)
    {
        $anak->delete();
        Alert::success('Berhasil', "$anak->nama telah di hapus");
        return redirect("/anak");
    }

    public function ubahStatus(Request $request)
    {
        $anak = Anak::find($request->id);

        // Toggle status between 'aktif' and 'nonaktif'
        if ($anak) {
            $anak->status = $anak->status === 'aktif' ? 'nonaktif' : 'aktif';
            $anak->save();

            return response()->json([
                'status' => 'success',
                'newStatus' => $anak->status,
                'message' => 'Status anak ' . $anak->nama . ' berhasil diperbarui.',
            ]);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Anak tidak ditemukan.',
        ], 404);
    }
}

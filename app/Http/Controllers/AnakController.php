<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Kunjungan;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

    public function index(Request $request)
    {
        $query = Anak::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                  ->orWhere('nib', 'like', "%$search%")
                  ->orWhere('alamat', 'like', "%$search%");
            });
        }

        $anaks = $query->withExists(['pemasukkans as has_package' => function($q) {
                $q->where('jenis_layanan', 'paket_terapi');
            }])
            ->orderBy('created_at', 'desc')
            ->orderBy('has_package', 'desc')
            ->paginate(5)
            ->withQueryString();

        $aktif = Anak::where('status', 'aktif')->count();
        $nonaktif = Anak::where('status', 'nonaktif')->count();
        $pria = Anak::where('status', 'aktif')->where('jenis_kelamin', 'L')->count();
        $wanita = Anak::where('status', 'aktif')->where('jenis_kelamin', 'P')->count();

        // Menyiapkan rincian paket aktif untuk setiap anak
        foreach ($anaks as $a) {
            $a->active_packages = $a->pemasukkans()
                ->where('jenis_layanan', 'paket_terapi')
                ->whereNotNull('tarif_id')
                ->with('tarif')
                ->get()
                ->filter(function($p) {
                    $sisa = $p->sisa_pertemuan;
                    // Handle paket gabungan (sisa berupa array)
                    if (is_array($sisa)) {
                        return ($sisa['perilaku'] ?? 0) > 0 || ($sisa['fisioterapi'] ?? 0) > 0;
                    }
                    return is_int($sisa) && $sisa > 0;
                });

            // Map data untuk modal Alpine.js
            $a->packages_data = $a->active_packages->map(function($p) {
                $tarif   = $p->tarif;
                $used    = $p->sudah_terpakai ?? 0;
                $isGabungan = $tarif && $tarif->jenis_terapi === 'gabungan';

                if ($isGabungan) {
                    $totalPerilaku   = $tarif->pertemuan_perilaku ?? 0;
                    $totalFisio      = $tarif->pertemuan_fisioterapi ?? 0;
                    $total           = $totalPerilaku + $totalFisio;
                    $sisaArr         = $p->sisa_pertemuan;
                    $sisaPerilaku    = $sisaArr['perilaku'] ?? 0;
                    $sisaFisio       = $sisaArr['fisioterapi'] ?? 0;
                    $sisa            = $sisaPerilaku + $sisaFisio;
                } else {
                    $total = $tarif->jumlah_pertemuan ?? 0;
                    $sisa  = is_int($p->sisa_pertemuan) ? $p->sisa_pertemuan : 0;
                }

                $percent = $total > 0 ? min(100, round((($total - $sisa) / $total) * 100)) : 0;

                return [
                    'label'   => $tarif->nama ?? 'Paket Terapi',
                    'total'   => $total,
                    'used'    => $total - $sisa,
                    'percent' => $percent,
                ];
            });
        }

        return view('anak.index', compact('anaks', 'aktif', 'nonaktif', 'pria', 'wanita'));
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
        // Generate NIB: cari NIB tertinggi, ambil angkanya, lalu +1
        $lastAnak = Anak::orderBy('nib', 'desc')->first();
        $lastNumber = $lastAnak ? (int) str_replace('BSC', '', $lastAnak->nib) : 0;
        $anak->nib = 'BSC' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        return view('anak.create', compact('anak', 'pendidikan', 'pendidikan_orangtua', 'agama'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->file('foto')) {
            $file = $request->file('foto');
            $extFile = $file->getClientOriginalExtension();
            $namaFile =
                "anak-" . time() . "." . $extFile;
            $path = 'anak/' . $namaFile;
            Storage::disk('public')->put($path, file_get_contents($file));
            $validateData['foto'] = $namaFile;
        }

        $anak = Anak::create($validateData);
        return redirect("/anak#card-{$anak->id}")->with('success', "Data Anak $request->nama berhasil dibuat");
    }

    /**
     * Display the specified resource.
     */
    public function show(Anak $anak)
    {
        $kunjungan = Kunjungan::where('anak_id', $anak->id)->where('jenis_terapi', 'terapi_perilaku')->whereNotNull('pertemuan')->whereNull('catatan')
            ->latest()
            ->paginate(10);
        $fisioterapi = Kunjungan::where('anak_id', $anak->id)->where('jenis_terapi', 'fisioterapi')->whereNotNull('pertemuan')->whereNull('catatan')
            ->latest()
            ->paginate(10);

        $activePackages = \App\Models\Pemasukkan::with('tarif')
            ->where('anak_id', $anak->id)
            ->where('jenis_layanan', 'paket_terapi')
            ->whereNotNull('tarif_id')
            ->get()
            ->filter(function($p) {
                return $p->sisa_pertemuan > 0;
            });

        return view('anak.detail', compact('kunjungan', 'fisioterapi', 'anak', 'activePackages'));
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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->file('foto')) {
            // Hapus foto lama jika ada
            if ($anak->foto) {
                Storage::disk('public')->delete('anak/' . $anak->foto);
            }

            // Simpan foto baru
            $file = $request->file('foto');
            $extFile = $file->getClientOriginalExtension();
            $namaFile = "anak-" . time() . "." . $extFile;
            $path = 'anak/' . $namaFile;
            Storage::disk('public')->put($path, file_get_contents($file));

            // Update data foto
            $validateData['foto'] = $namaFile;
        }

        $anak->update($validateData);
        // Trik agar halaman kembali ke halaman asal
        return redirect('/anak')->with('success', "Anak $request->nama telah di update");
    }

    public function deleteFoto($id)
    {
        // Cari data anak berdasarkan ID
        $anak = Anak::findOrFail($id);

        // Pastikan anak memiliki foto sebelum menghapus
        if ($anak->foto) {
            // Hapus foto dari penyimpanan
            Storage::disk('public')->delete('anak/' . $anak->foto);

            // Update kolom foto di database menjadi null
            $anak->update(['foto' => null]);

            return redirect()->back()->with('success', "Foto Anak {$anak->nama} berhasil dihapus");
        } else {
            // Notifikasi jika tidak ada foto
            return redirect()->back()->with('warning', "Anak {$anak->nama} tidak memiliki foto untuk dihapus");
        }

        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anak $anak)
    {
        $nama = $anak->nama;
        if ($anak->foto) {
            Storage::disk('public')->delete('anak/' . $anak->foto);
        }
        
        $anak->delete();
        return redirect()->route('anak.index')->with('success', "Data anak $nama berhasil dihapus dari sistem.");
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

<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Assessment;
use App\Models\Fisioterapi;
use App\Models\informasi;
use App\Models\Jadwal;
use App\Models\Kunjungan;
use App\Models\Pemasukkan;
use App\Models\Pemeriksaan;
use App\Models\Tarif;
use App\Models\Terapis;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;
use RealRashid\SweetAlert\Facades\Alert;

class MobileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->is('mobile') || $request->is('mobile/*')) {
            session(['view' => 'anak']);
        } else {
            session(['view' => 'admin']);
        }
        return view('mobile.login');
    }

    public function app()
    {
        $user = auth()->user();
        $namaUser = $user->name;
        $anak = Anak::where('nama', $namaUser)->first();
        $terapis = Terapis::where('status', 'aktif')->get();
        $informasi = Informasi::where('informasi', '!=', '')->first();

        $totalPertemuan = 20;

        $pertemuanAwal1 = Kunjungan::where('anak_id', $anak->id)->where('pertemuan', 1)
            ->orderBy('created_at', 'desc')
            ->first();

        $pertemuanAwal2 = Kunjungan::where('anak_id', $anak->id)->where('pertemuan', 20)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($pertemuanAwal2) {
            // Ambil semua pertemuan yang dibuat setelah id pertemuan 20 terakhir
            $kunjungan = Kunjungan::where('anak_id', $anak->id)
                ->where('id', '>', $pertemuanAwal2->id) // Ambil data setelah pertemuan 20 terakhir
                ->orderBy('pertemuan', 'asc')
                ->get();
        } else {
            $kunjungan = Kunjungan::where('anak_id', $anak->id)->orderBy('pertemuan')->get();
            $pertemuanSekarang = $kunjungan->max('pertemuan') ?? 1;
        }

        if ($pertemuanAwal1) {
            $sisa = Kunjungan::where('anak_id', $anak->id)
                ->where('id', '>=', $pertemuanAwal1->id)  // Ambil data setelah pertemuan 20 terakhir
                ->orderBy('pertemuan', 'asc')
                ->get();
            $pertemuanSekarang = $sisa->max('pertemuan') ?? 1;
        } else {
            $kunjungan = Kunjungan::where('anak_id', $anak->id)
                ->orderBy('pertemuan', 'asc')
                ->get();
            $pertemuanSekarang = $kunjungan->max('pertemuan') ?? 1;
        }
        $sisaPertemuan = max(0, $totalPertemuan - $pertemuanSekarang);
        $tarif = Tarif::latest()->get();
        return view('mobile.dashboard', compact('anak', 'terapis', 'kunjungan', 'tarif', 'sisaPertemuan', 'informasi'));
    }

    public function profile()
    {
        $user = auth()->user();
        $namaUser = $user->name;
        $anak = Anak::where('nama', $namaUser)->first();

        $kunjungan = Kunjungan::where('anak_id', $anak->id)->latest()->first();
        $season = $kunjungan->sesi ?? 'Tidak Ada';
        // $totalPertemuan = 20;
        // $pertemuanAwal = Kunjungan::where('anak_id', $anak->id)->where('pertemuan', 1)
        //     ->orderBy('created_at', 'desc')
        //     ->first();

        // if ($pertemuanAwal) {
        //     // Ambil semua pertemuan yang dibuat setelah id pertemuan 20 terakhir
        //     $hadir = Kunjungan::where('anak_id', $anak->id)
        //         ->where('id', '>=', $pertemuanAwal->id)
        //         ->where('status', 'hadir') // Ambil data setelah pertemuan 20 terakhir
        //         ->orderBy('pertemuan', 'asc')
        //         ->count();
        //     $izin = Kunjungan::where('anak_id', $anak->id)
        //         ->where('id', '>=', $pertemuanAwal->id)
        //         ->where('status', 'izin') // Ambil data setelah pertemuan 20 terakhir
        //         ->orderBy('pertemuan', 'asc')
        //         ->count();
        //     $absen = Kunjungan::where('anak_id', $anak->id)
        //         ->where('id', '>=', $pertemuanAwal->id)
        //         ->where('status', 'sakit') // Ambil data setelah pertemuan 20 terakhir
        //         ->orderBy('pertemuan', 'asc')
        //         ->count();
        //     $sisa = Kunjungan::where('anak_id', $anak->id)
        //         ->where('id', '>=', $pertemuanAwal->id)  // Ambil data setelah pertemuan 20 terakhir
        //         ->orderBy('pertemuan', 'asc')
        //         ->get();

        //     $pertemuanSekarang = $sisa->max('pertemuan') ?? 1;

        //     // Jika tidak ada data, asumsikan pertemuan pertama
        // } else {
        //     $hadir = Kunjungan::where('anak_id', $anak->id)
        //         ->where('status', 'hadir')
        //         ->orderBy('pertemuan')->count();
        //     $izin = Kunjungan::where('anak_id', $anak->id)
        //         ->where('status', 'izin')
        //         ->orderBy('pertemuan')->count();
        //     $absen = Kunjungan::where('anak_id', $anak->id)
        //         ->where('status', 'sakit')
        //         ->orderBy('pertemuan')->count();
        //     $kunjungan = Kunjungan::where('anak_id', $anak->id)
        //         ->orderBy('pertemuan', 'asc')
        //         ->get();

        //     $pertemuanSekarang = $kunjungan->max('pertemuan') ?? 1;
        // }

        // $sisaPertemuan = max(0, $totalPertemuan - $pertemuanSekarang);
        // $progress = ($pertemuanSekarang / $totalPertemuan) * 100;

        if (!$kunjungan || !$kunjungan->sesi) {
            // Berikan nilai default jika sesi tidak ada
            $hadir_terapi_perilaku = 0;
            $izin_terapi_perilaku = 0;
            $izin_hangus_terapi_perilaku = 0;
            $hadir_fisioterapi = 0;
            $izin_fisioterapi = 0;
            $izin_hangus_fisioterapi = 0;
        } else {
            $hadir_terapi_perilaku = Kunjungan::where('anak_id', $anak->id)
                ->where('sesi', $kunjungan->sesi)
                ->where('jenis_terapi', 'terapi_perilaku')
                ->whereNull('catatan')
                ->where('status', 'hadir')
                ->count();
            $izin_terapi_perilaku = Kunjungan::where('anak_id', $anak->id)
                ->where('sesi', $kunjungan->sesi)
                ->where('status', 'izin')
                ->count();
            $izin_hangus_terapi_perilaku = Kunjungan::where('anak_id', $anak->id)
                ->where('sesi', $kunjungan->sesi)
                ->where('status', 'sakit')
                ->count();

            $hadir_fisioterapi = Kunjungan::where('anak_id', $anak->id)
                ->where('sesi', $kunjungan->sesi)
                ->where('jenis_terapi', 'fisioterapi')
                ->whereNull('catatan')
                ->where('status', 'hadir')
                ->count();
            $izin_fisioterapi = Kunjungan::where('anak_id', $anak->id)
                ->where('sesi', $kunjungan->sesi)
                ->where('status', 'izin')
                ->count();
            $izin_hangus_fisioterapi = Kunjungan::where('anak_id', $anak->id)
                ->where('sesi', $kunjungan->sesi)
                ->where('status', 'sakit')
                ->count();
        }

        return view('mobile.profile', compact('anak', 'hadir_terapi_perilaku', 'izin_terapi_perilaku', 'izin_hangus_terapi_perilaku', 'hadir_fisioterapi', 'izin_fisioterapi', 'izin_hangus_fisioterapi', 'season'));
    }

    public function profile_edit()
    {
        $user = auth()->user();
        $namaUser = $user->name;
        $anak = Anak::where('nama', $namaUser)->first();

        return view('mobile.editprofile', compact('anak'));
    }

    public function profile_update(Request $request, Anak $anak): RedirectResponse
    {
        $validateData = $request->validate([
            'alamat' => 'required',
            'telepon_ibu' => 'nullable|numeric',
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
        return redirect()->back()->with('success', 'Data berhasil diperbaharui!');
    }

    public function ubah_password()
    {
        $user = auth()->user();
        $namaUser = $user->name;
        $anak = Anak::where('nama', $namaUser)->first();

        return view('mobile.ubahpassword', compact('anak', 'user'));
    }

    public function update_password(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Kata sandi berhasil diperbarui!');
    }

    public function kunjungan()
    {
        $user = auth()->user();
        $namaUser = $user->name;
        $anak = Anak::where('nama', $namaUser)->first();

        $anak = Anak::where('nama', $namaUser)->first();

        // Ambil semua kunjungan diurutkan berdasarkan sesi dan created_at
        $kunjungan = Kunjungan::where('anak_id', $anak->id)
            ->whereNull('catatan')
            ->where('jenis_terapi', 'terapi_perilaku')
            ->orderBy('sesi', 'desc')
            ->orderBy('created_at', 'asc')
            ->get();

        // Ambil semua kunjungan diurutkan berdasarkan sesi dan created_at
        $kunjungan_fisioterapi = Kunjungan::where('anak_id', $anak->id)
            ->whereNull('catatan')
            ->where('jenis_terapi', 'fisioterapi')
            ->orderBy('sesi', 'desc')
            ->orderBy('created_at', 'asc')
            ->get();

        // Kelompokkan berdasarkan sesi
        $groupedBySesi = $kunjungan->groupBy('sesi');
        $groupedBySesi_fisio = $kunjungan_fisioterapi->groupBy('sesi');

        // Kirim data ke view
        return view('mobile.kunjungan', [
            'anak' => $anak,
            'groupedBySesi' => $groupedBySesi,
            'sesiTerakhir' => $kunjungan->max('sesi'),
            'groupedBySesi_fisio' => $groupedBySesi_fisio,
            'sesiTerakhir_fisio' => $kunjungan_fisioterapi->max('sesi'),

        ]);
    }

    public function kunjungan_detail($id)
    {
        $user = auth()->user();
        $namaUser = $user->name;
        $anak = Anak::where('nama', $namaUser)->first();
        $kunjungan = Kunjungan::findOrFail($id);
        $pemeriksaan = Pemeriksaan::where('kunjungan_id', $kunjungan->id)->get();
        $fisioterapi = Fisioterapi::where('kunjungan_id', $kunjungan->id)->get();
        return view('mobile.kunjungandetail', compact('kunjungan', 'anak', 'pemeriksaan', 'fisioterapi'));
    }

    public function payment()
    {
        $user = auth()->user();
        $namaUser = $user->name;
        $anak = Anak::where('nama', $namaUser)->first();

        // string (Pembayaran Anak) Wajib menggunakan SPASI
        $pembayaran = Pemasukkan::where('deskripsi', 'Pembayaran Anak ' . $anak->nama)->get();
        return view('mobile.payment', compact('anak', 'pembayaran'));
    }


    public function result()
    {
        $user = auth()->user();
        $namaUser = $user->name;
        $anak = Anak::where('nama', $namaUser)->first();
        // string (Pembayaran Anak) Wajib menggunakan SPASI
        $assessment = Assessment::where('anak_id', $anak->id)->get();
        return view('mobile.hasil', compact('anak', 'assessment'));
    }

    public function tarif_detail($id)
    {
        $user = auth()->user();
        $namaUser = $user->name;
        $anak = Anak::where('nama', $namaUser)->first();
        $tarif = Tarif::findOrFail($id);
        return view('mobile.paketdetail', compact('tarif', 'anak'));
    }

    public function jadwal()
    {
        $user = auth()->user();
        $namaUser = $user->name;
        $anak = Anak::where('nama', $namaUser)->first();
        // $kunjungan = Kunjungan::where('anak_id', $anak->id)->orderBy('pertemuan')->get();
        // dd($kunjungan);
        return view('mobile.jadwal', compact('anak'));
    }

    public function download_invoice($id)
    {
        $invoice = Pemasukkan::findOrFail($id);
        $namaAnak = trim(str_replace('pembayaran anak ', '', strtolower($invoice->deskripsi)));
        $anak = Anak::where('nama', 'like', "%$namaAnak%")->first();
        $pdf = PDF::loadView('mobile.invoice', compact('invoice', 'anak'));

        // Cek jika akses dari HP
        if (request()->header('User-Agent') && preg_match('/Mobile|Android|iPhone/', request()->header('User-Agent'))) {
            return $pdf->download('invoice-' . $invoice->id . '.pdf'); // Download langsung
        } else {
            return $pdf->stream('invoice-' . $invoice->id . '.pdf'); // Tampilkan di browser
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Jadwal;
use App\Models\Kunjungan;
use App\Models\Pemasukkan;
use App\Models\Pemeriksaan;
use App\Models\Tarif;
use App\Models\Terapis;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

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
        $terapis = Terapis::get();

        $pertemuanAwal = Kunjungan::where('anak_id', $anak->id)->where('pertemuan', 20)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($pertemuanAwal) {
            // Ambil semua pertemuan yang dibuat setelah id pertemuan 20 terakhir
            $kunjungan = Kunjungan::where('anak_id', $anak->id)
                ->where('id', '>', $pertemuanAwal->id) // Ambil data setelah pertemuan 20 terakhir
                ->orderBy('pertemuan', 'asc')
                ->get();
        } else {
            $kunjungan = Kunjungan::where('anak_id', $anak->id)->orderBy('pertemuan')->get();
        }


        $tarif = Tarif::latest()->get();
        return view('mobile.dashboard', compact('anak', 'terapis', 'kunjungan', 'tarif'));
    }

    public function profile()
    {
        $user = auth()->user();
        $namaUser = $user->name;
        $anak = Anak::where('nama', $namaUser)->first();

        $totalPertemuan = 20;
        $pertemuanAwal = Kunjungan::where('anak_id', $anak->id)->where('pertemuan', 1)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($pertemuanAwal) {
            // Ambil semua pertemuan yang dibuat setelah id pertemuan 20 terakhir
            $hadir = Kunjungan::where('anak_id', $anak->id)
                ->where('id', '>=', $pertemuanAwal->id)
                ->where('status', 'hadir') // Ambil data setelah pertemuan 20 terakhir
                ->orderBy('pertemuan', 'asc')
                ->count();
            $izin = Kunjungan::where('anak_id', $anak->id)
                ->where('id', '>=', $pertemuanAwal->id)
                ->where('status', 'izin') // Ambil data setelah pertemuan 20 terakhir
                ->orderBy('pertemuan', 'asc')
                ->count();
            $absen = Kunjungan::where('anak_id', $anak->id)
                ->where('id', '>=', $pertemuanAwal->id)
                ->where('status', 'sakit') // Ambil data setelah pertemuan 20 terakhir
                ->orderBy('pertemuan', 'asc')
                ->count();
            $sisa = Kunjungan::where('anak_id', $anak->id)
                ->where('id', '>=', $pertemuanAwal->id)  // Ambil data setelah pertemuan 20 terakhir
                ->orderBy('pertemuan', 'asc')
                ->get();

            $pertemuanSekarang = $sisa->max('pertemuan') ?? 1;

            // Jika tidak ada data, asumsikan pertemuan pertama
        } else {
            $hadir = Kunjungan::where('anak_id', $anak->id)
                ->where('status', 'hadir')
                ->orderBy('pertemuan')->count();
            $izin = Kunjungan::where('anak_id', $anak->id)
                ->where('status', 'izin')
                ->orderBy('pertemuan')->count();
            $absen = Kunjungan::where('anak_id', $anak->id)
                ->where('status', 'sakit')
                ->orderBy('pertemuan')->count();
            $kunjungan = Kunjungan::where('anak_id', $anak->id)
                ->orderBy('pertemuan', 'asc')
                ->get();

            $pertemuanSekarang = $kunjungan->max('pertemuan') ?? 1;
        }

        $sisaPertemuan = max(0, $totalPertemuan - $pertemuanSekarang);
        $progress = ($pertemuanSekarang / $totalPertemuan) * 100;
        return view('mobile.profile', compact('anak', 'hadir', 'izin', 'absen', 'sisaPertemuan', 'progress'));
    }

    public function profile_edit()
    {
        $user = auth()->user();
        $namaUser = $user->name;
        $anak = Anak::where('nama', $namaUser)->first();

        return view('mobile.editprofile', compact('anak'));
    }


    public function kunjungan()
    {
        $user = auth()->user();
        $namaUser = $user->name;
        $anak = Anak::where('nama', $namaUser)->first();

        // $pertemuanAwal = Kunjungan::where('anak_id', $anak->id)->where('pertemuan', 20)
        //     ->orderBy('created_at', 'desc')
        //     ->first();

        // if ($pertemuanAwal) {
        //     // Ambil semua pertemuan yang dibuat setelah id pertemuan 20 terakhir
        //     $kunjungan = Kunjungan::where('anak_id', $anak->id)
        //         ->where('id', '>', $pertemuanAwal->id) // Ambil data setelah pertemuan 20 terakhir
        //         ->orderBy('pertemuan', 'asc')
        //         ->get();
        // } else {
        //     $kunjungan = Kunjungan::where('anak_id', $anak->id)->orderBy('pertemuan')->get();
        // }
        // return view('mobile.kunjungan', compact('anak', 'kunjungan'));
        $kunjungan = Kunjungan::where('anak_id', $anak->id)
            ->orderBy('created_at', 'asc') // Pastikan urutan sesuai waktu pembuatan
            ->get();

        $sesi = [];
        $sesiIndex = 1;
        $sesiTerakhir = null;
        $lastCreatedAt = null;

        foreach ($kunjungan as $index => $item) {
            $sesiKey = $sesiIndex;
            $sesi[$sesiKey][] = $item;

            // Simpan sesi terakhir berdasarkan created_at terbaru
            if (is_null($lastCreatedAt) || $item->tanggal > $lastCreatedAt) {
                $sesiTerakhir = $sesiKey;
                $lastCreatedAt = $item->tanggal;
            }

            if (($index + 1) % 20 == 0) {
                $sesiIndex++;
            }
        }

        // Kirim data kunjungan, sesi, dan sesi terakhir ke view
        return view('mobile.kunjungan', compact('kunjungan', 'sesi', 'anak', 'sesiTerakhir'));
    }

    public function kunjungan_detail($id)
    {
        $user = auth()->user();
        $namaUser = $user->name;
        $anak = Anak::where('nama', $namaUser)->first();
        $kunjungan = Kunjungan::findOrFail($id);
        $pemeriksaan = Pemeriksaan::where('kunjungan_id', $kunjungan->id)->get();
        return view('mobile.kunjungandetail', compact('kunjungan', 'anak', 'pemeriksaan'));
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

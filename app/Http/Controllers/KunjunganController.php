<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Kunjungan;
use App\Models\Pemeriksaan;
use App\Models\Program;
use App\Models\Tarif;
use App\Models\Terapis;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class KunjunganController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view pendaftaran', ['only' => ['index']]);
        $this->middleware('permission:view rekammedis', ['only' => ['riwayatAnak']]);
        $this->middleware('permission:show rekammedis', ['only' => ['show']]);
    }

    public function index()
    {
        return view('kunjungan.index');
    }

    public function getTerapisByJenis(Request $request)
    {
        $jenisTerapi = $request->jenis_terapi;

        if ($jenisTerapi === 'gabungan') {
            $perilaku = Terapis::where('role', 'terapi_perilaku')->where('status', 'aktif')->get();
            $fisioterapi = Terapis::where('role', 'fisioterapi')->where('status', 'aktif')->get();
            return response()->json([
                'perilaku' => $perilaku,
                'fisioterapi' => $fisioterapi
            ]);
        }

        // Query untuk mendapatkan terapis berdasarkan jenis terapi
        $terapis = Terapis::where('role', $jenisTerapi)
            ->where('status', 'aktif')
            ->get();

        return response()->json($terapis);
    }

    public function store(Request $request): RedirectResponse
    {
        $validateData = $request->validate([
            'anak_id' => 'required|exists:App\Models\Anak,id',
            'terapis_id' => 'required|exists:App\Models\Terapis,id',
            'terapis_id_pendamping' => 'nullable|exists:App\Models\Terapis,id',
            'jenis_terapi' => 'required',
            'catatan' => '',
            'status' => 'required',
        ]);

        if ($request->jenis_terapi === 'gabungan') {
            $request->validate([
                'terapis_id_pendamping' => 'required|exists:App\Models\Terapis,id',
            ]);
        }

        $anak = Anak::findOrFail($request->anak_id);

        // Validasi agar dalam hari yang sama tidak bisa mendaftar lebih dari 1x terapi perilaku
        if ($request->jenis_terapi == 'terapi_perilaku') {
            $today = Carbon::today();

            $cek = Kunjungan::where('anak_id', $request->anak_id)
                ->where('jenis_terapi', $request->jenis_terapi)
                ->whereDate('created_at', $today)
                ->first();

            if ($cek) {
                return back()->with('error', "Anak $request->nama sudah mendaftar hari ini. Silakan coba lagi besok.");
            }
        }

        // --- LOGIKA TRANSISI MULUS (SMOOTH TRANSITION) DENGAN LINK KWITANSI ---
        
        // 1. Dapatkan kwitansi aktif:
        // Prioritaskan yang dipilih user melalui tombol "Gunakan Paket" di UI
        $kwitansiAktif = null;
        if ($request->filled('selected_pemasukkan_id')) {
            $pilihanUser = \App\Models\Pemasukkan::where('id', $request->selected_pemasukkan_id)
                ->where('anak_id', $request->anak_id)
                ->first();
                
            // Pastikan paket yang dipilih benar-benar valid dan punya sisa untuk jenis_terapi ini
            if ($pilihanUser && $pilihanUser->getSisaPertemuanJenis($request->jenis_terapi) > 0) {
                $kwitansiAktif = $pilihanUser;
            }
        }

        // Jika user tidak memilih / id tidak valid, fallback ke metode FIFO otomatis
        if (!$kwitansiAktif) {
            $kwitansiAktif = $anak->kwitansiAktif($request->jenis_terapi);
        }
        
        // 2. Cari kunjungan terakhir untuk mengambil context
        $kunjungan_terakhir = Kunjungan::where('anak_id', $request->anak_id)
            ->where('jenis_terapi', $request->jenis_terapi)
            ->whereNull('catatan')
            ->orderBy('id', 'desc')
            ->first();

        $nextPertemuan = 1;
        $nextSesi = 1;
        $finalTarifId = null;
        $finalPemasukkanId = null;

        if ($kunjungan_terakhir) {
            // Tentukan batas pertemuan — untuk paket gabungan, ambil per-jenis
            $limitLama = 20;
            if ($kunjungan_terakhir->tarif_id) {
                $tarifLama = Tarif::find($kunjungan_terakhir->tarif_id);
                if ($tarifLama) {
                    $limitLama = $tarifLama->getPertemuanUntukJenis($request->jenis_terapi)
                        ?: ($tarifLama->jumlah_pertemuan ?? 20);
                }
            }

            // --- HITUNG PERTEMUAN ---
            $kwitansiTerakhirId = $kunjungan_terakhir->pemasukkan_id;
            $kwitansiAktifId    = $kwitansiAktif ? $kwitansiAktif->id : null;
            $kwitansiBerbeda    = ($kwitansiAktifId !== null) && ($kwitansiTerakhirId !== $kwitansiAktifId);

            if ($kwitansiBerbeda) {
                // Pindah kwitansi baru: hitung terpakai di kwitansi baru
                $query = Kunjungan::where('pemasukkan_id', $kwitansiAktifId)
                    ->where('anak_id', $request->anak_id)
                    ->whereIn('status', ['hadir', 'izin_hangus']);
                
                if ($request->jenis_terapi !== 'gabungan') {
                    $query->where('jenis_terapi', $request->jenis_terapi);
                }
                
                $maxPertemuan = $query->max('pertemuan') ?? 0;
                $nextPertemuan = $maxPertemuan + 1;
                $finalTarifId = $kwitansiAktif->tarif_id;
                $finalPemasukkanId = $kwitansiAktif->id;
            } elseif (in_array($kunjungan_terakhir->status, ['hadir', 'izin_hangus'])) {
                // Lanjutkan kwitansi lama (hadir)
                if ($kunjungan_terakhir->pertemuan < $limitLama) {
                    $nextPertemuan = $kunjungan_terakhir->pertemuan + 1;
                    $finalTarifId = $kunjungan_terakhir->tarif_id;
                    $finalPemasukkanId = $kunjungan_terakhir->pemasukkan_id;
                } else {
                    // Season baru (sudah melewati limit lama)
                    $nextPertemuan = 1;
                    $finalTarifId = $kwitansiAktif ? $kwitansiAktif->tarif_id : null;
                    $finalPemasukkanId = $kwitansiAktif ? $kwitansiAktif->id : null;
                }
            } else {
                // IZIN/SAKIT: nomor pertemuan tetap sama
                $nextPertemuan = $kunjungan_terakhir->pertemuan;
                $finalTarifId = $kunjungan_terakhir->tarif_id;
                $finalPemasukkanId = $kunjungan_terakhir->pemasukkan_id;
            }

        } else {
            // DATA BARU SAMA SEKALI / SWITCH KE GABUNGAN PERTAMA KALI
            if ($kwitansiAktif) {
                // Hitung dari kwitansi
                $query = Kunjungan::where('pemasukkan_id', $kwitansiAktif->id)
                    ->where('anak_id', $request->anak_id)
                    ->whereIn('status', ['hadir', 'izin_hangus']);
                
                if ($request->jenis_terapi !== 'gabungan') {
                    $query->where('jenis_terapi', $request->jenis_terapi);
                }
                
                $maxPertemuan = $query->max('pertemuan') ?? 0;
                $nextPertemuan = $maxPertemuan + 1;
            } else {
                $nextPertemuan = 1;
            }

            $finalTarifId = $kwitansiAktif ? $kwitansiAktif->tarif_id : null;
            $finalPemasukkanId = $kwitansiAktif ? $kwitansiAktif->id : null;
        }
        // --- HITUNG SESI (SEASON) ---
        if ($nextPertemuan === 1) {
            // Memulai season/paket baru
            $querySesi = Kunjungan::where('anak_id', $request->anak_id);
            if ($request->jenis_terapi === 'gabungan') {
                $querySesi->whereIn('jenis_terapi', ['terapi_perilaku', 'fisioterapi', 'gabungan']);
            } else {
                $querySesi->where('jenis_terapi', $request->jenis_terapi);
            }
            $nextSesi = ($querySesi->max('sesi') ?? 0) + 1;
        } else {
            // Melanjutkan season/paket yang sama
            if (isset($kwitansiAktif) && $kwitansiAktif) {
                $nextSesi = Kunjungan::where('pemasukkan_id', $kwitansiAktif->id)
                    ->where('anak_id', $request->anak_id)
                    ->max('sesi') ?? 1;
            } elseif (isset($kunjungan_terakhir) && $kunjungan_terakhir) {
                $nextSesi = $kunjungan_terakhir->sesi ?? 1;
            } else {
                $nextSesi = 1;
            }
        }

        $pertemuan = $nextPertemuan;
        $sesi = $nextSesi;

        // --- OTOMASI PENYELESAIAN SESI ---
        $statusSesi   = 'aktif';
        $maxPertemuan = 20;
        if ($finalTarifId) {
            $tarifInfo = Tarif::find($finalTarifId);
            if ($tarifInfo) {
                // Untuk paket gabungan: ambil limit sesuai jenis terapi yang dipilih
                $maxPertemuan = $tarifInfo->getPertemuanUntukJenis($request->jenis_terapi)
                    ?: ($tarifInfo->jumlah_pertemuan ?? 20);
            }
        }

        if (($request->status == 'hadir' || $request->status == 'izin_hangus') && $pertemuan >= $maxPertemuan) {
            $statusSesi = 'selesai';
        }

        $data = [
            'anak_id' => $request->anak_id,
            'terapis_id' => $request->terapis_id,
            'terapis_id_pendamping' => $request->terapis_id_pendamping,
            'tarif_id' => $finalTarifId,
            'pemasukkan_id' => $finalPemasukkanId,
            'jenis_terapi' => $request->jenis_terapi,
            'catatan' => $request->catatan,
            'status' => $request->status,
            'pertemuan' => $pertemuan,
            'sesi' => $sesi,
            'status_sesi' => $statusSesi,
        ];

        $kunjungan = Kunjungan::create($data);
        
        // Notifikasi cerdas
        $msg = "Data Anak $request->nama berhasil didaftarkan.";
        if ($finalTarifId) {
            $sisa = $maxPertemuan - $pertemuan;
            
            if ($statusSesi == 'selesai') {
                $msg .= " SEASON SELESAI OTOMATIS! Kuota paket telah habis.";
            } else {
                $msg .= " Sisa: $sisa sesi.";
            }
        } else {
            if ($statusSesi == 'selesai') {
                $msg .= " SEASON SELESAI OTOMATIS (Batas 20 Pertemuan).";
            }
        }

        return redirect("/data")->with('success', $msg);
    }

    public function riwayatAnak()
    {
        $terapis = Terapis::where('status', 'aktif')->get();
        $kunjungan = Kunjungan::with(['anak', 'terapis', 'terapisPendamping', 'tarif', 'pemasukkan.tarif'])
            ->whereNotNull('pertemuan')->whereNull('catatan')
            ->latest()
            ->paginate(10);

        // Ambil daftar sesi yang sudah selesai (berdasarkan kolom status_sesi)
        $completedSessions = Kunjungan::where('status_sesi', 'selesai')
            ->select('anak_id', 'sesi', 'jenis_terapi')
            ->get()
            ->map(function ($item) {
                return $item->anak_id . '-' . $item->sesi . '-' . $item->jenis_terapi;
            })
            ->toArray();

        // Statistik (Hadir, Izin, Izin Hangus ambil data HARI INI saja)
        $total = Kunjungan::whereNull('catatan')->count(); 
        $hadir = Kunjungan::whereDate('created_at', today())->whereNull('catatan')->where('status', 'hadir')->count();
        $izin = Kunjungan::whereDate('created_at', today())->where('status', 'izin')->count();
        $sakit = Kunjungan::whereDate('created_at', today())->where('status', 'sakit')->count();
        $izin_hangus = Kunjungan::whereDate('created_at', today())->where('status', 'izin_hangus')->count();

        return view('kunjungan.data', compact('terapis', 'kunjungan', 'hadir', 'izin', 'sakit', 'izin_hangus', 'total', 'completedSessions'));
    }

    public function show(Kunjungan $kunjungan)
    {
        // riwayat terapi_perilaku
        $riwayat = Kunjungan::with('pemeriksaans')->where('anak_id', $kunjungan->anak_id)->where('jenis_terapi', 'terapi_perilaku')->where('status', 'hadir')->whereNull('catatan')->latest()->get();
        // riwayat fisioterapi
        $riwayat_fisioterapi = Kunjungan::with('fisioterapis')->where('anak_id', $kunjungan->anak_id)->where('jenis_terapi', 'fisioterapi')->where('status', 'hadir')->whereNull('catatan')->latest()->get();

        $program = Program::where('jenis', 'terapi_perilaku')->get();
        $program_fisioterapi = Program::where('jenis', 'fisioterapi')->get();
        $tanggal_lahir = Carbon::parse($kunjungan->anak->tanggal_lahir);
        $kunjungan->usia = $tanggal_lahir->diffInYears(Carbon::now());

        // Cek apakah sesi saat ini sudah selesai
        $isCurrentSessionCompleted = Kunjungan::where('anak_id', $kunjungan->anak_id)
            ->where('sesi', $kunjungan->sesi)
            ->where('jenis_terapi', $kunjungan->jenis_terapi)
            ->where(function($q) use ($kunjungan) {
                $q->where('status_sesi', 'selesai')
                  ->orWhereExists(function ($query) use ($kunjungan) {
                      $query->select(DB::raw(1))
                            ->from('kunjungans as k2')
                            ->whereColumn('k2.anak_id', 'kunjungans.anak_id')
                            ->whereColumn('k2.jenis_terapi', 'kunjungans.jenis_terapi')
                            ->where('k2.sesi', '>', $kunjungan->sesi);
                  });
            })
            ->exists();

        if ($kunjungan->jenis_terapi === 'gabungan') {
            // riwayat gabungan
            $riwayat_gabungan = Kunjungan::with('pemeriksaanGabungans')->where('anak_id', $kunjungan->anak_id)->where('jenis_terapi', 'gabungan')->where('status', 'hadir')->whereNull('catatan')->latest()->get();
            return view('pemeriksaan.gabungan', compact('kunjungan', 'program', 'riwayat', 'riwayat_fisioterapi', 'program_fisioterapi', 'isCurrentSessionCompleted', 'riwayat_gabungan'));
        }

        return view('kunjungan.detail', compact('kunjungan', 'program', 'riwayat', 'riwayat_fisioterapi', 'program_fisioterapi', 'isCurrentSessionCompleted'));
    }

    public function search_kunjungan(Request $request)
    {
        $terapis = Terapis::where('status', 'aktif')->get();
        $query = Kunjungan::with(['anak', 'terapis', 'terapisPendamping', 'tarif', 'pemasukkan.tarif'])
            ->whereNotNull('pertemuan')
            ->whereNull('catatan')
            ->orderBy('created_at', 'desc');

        // Filter berdasarkan nama jika ada
        if ($request->filled('nama')) {
            $nama = $request->nama;
            $query->whereHas('anak', function($q) use ($nama) {
                $q->where('nama', 'like', '%' . $nama . '%');
            });
        }

        // Filter berdasarkan range tanggal jika ada
        $startDate = null;
        $endDate = null;
        if ($request->filled('date_range')) {
            $dates = explode(' - ', $request->date_range);
            if (count($dates) === 2) {
                try {
                    $startDate = Carbon::parse($dates[0])->startOfDay();
                    $endDate = Carbon::parse($dates[1])->endOfDay();
                    $query->whereBetween('created_at', [$startDate, $endDate]);
                } catch (\Exception $e) {
                    $startDate = null;
                    $endDate = null;
                }
            }
        }

        $kunjungan = $query->paginate(10)->withQueryString();

        $completedSessions = Kunjungan::where('status_sesi', 'selesai')
            ->select('anak_id', 'sesi', 'jenis_terapi')
            ->get()
            ->map(function ($item) {
                return $item->anak_id . '-' . $item->sesi . '-' . $item->jenis_terapi;
            })
            ->toArray();

        // Statistik (Hadir, Izin, Sakit, Izin Hangus)
        $statsQuery = Kunjungan::whereNull('catatan');

        // Jika ada filter nama, terapkan ke statistik juga
        if ($request->filled('nama')) {
            $nama = $request->nama;
            $statsQuery->whereHas('anak', function($q) use ($nama) {
                $q->where('nama', 'like', '%' . $nama . '%');
            });
        }

        // Jika ada filter tanggal, hitung statistik dalam rentang tanggal tersebut
        if ($startDate && $endDate) {
            $statsQuery->whereBetween('created_at', [$startDate, $endDate]);
            
            $total = (clone $statsQuery)->count();
            $hadir = (clone $statsQuery)->where('status', 'hadir')->count();
            $izin = (clone $statsQuery)->where('status', 'izin')->count();
            $sakit = (clone $statsQuery)->where('status', 'sakit')->count();
            $izin_hangus = (clone $statsQuery)->where('status', 'izin_hangus')->count();
        } else {
            // Jika tidak ada filter tanggal, statistik dihitung hari ini saja (kecuali total riwayat)
            $total = (clone $statsQuery)->count();
            
            $statsQueryToday = (clone $statsQuery)->whereDate('created_at', today());
            $hadir = (clone $statsQueryToday)->where('status', 'hadir')->count();
            $izin = (clone $statsQueryToday)->where('status', 'izin')->count();
            $sakit = (clone $statsQueryToday)->where('status', 'sakit')->count();
            $izin_hangus = (clone $statsQueryToday)->where('status', 'izin_hangus')->count();
        }

        return view('kunjungan.data', compact('terapis', 'kunjungan', 'hadir', 'izin', 'sakit', 'izin_hangus', 'total', 'completedSessions'));
    }

    public function edit(Kunjungan $kunjungan)
    {
        //
    }

    public function destroy(Kunjungan $kunjungan)
    {
        $kunjungan->delete();
        return redirect()->back()->with('success', "kunjungan anak telah di hapus");
    }

    public function tambahTerapis(Request $request, Kunjungan $kunjungan)
    {
        $validated = $request->validate([
            'terapis_id_pendamping' => 'required|exists:terapis,id',
        ]);

        // Pengecekan 1: Terapis pendamping tidak boleh sama dengan terapis utama
        if ($validated['terapis_id_pendamping'] == $kunjungan->terapis_id) {
            return redirect()->back()->with('error', 'Terapis pendamping tidak boleh sama dengan terapis utama');
        }

        // Pengecekan 2: Maksimal 2 terapis (1 utama + 1 pendamping)
        if ($kunjungan->terapis_id_pendamping) {
            return redirect()->back()->with('error', 'Maksimal hanya boleh ada 2 terapis (1 utama + 1 pendamping)');
        }

        // Update terapis pendamping
        $kunjungan->update(['terapis_id_pendamping' => $validated['terapis_id_pendamping']]);

        return redirect()->back()->with('success', "Terapis pendamping berhasil ditambahkan");
    }

    public function updateStatus(Request $request, Kunjungan $kunjungan)
    {
        $validated = $request->validate([
            'status' => 'required|in:hadir,izin,sakit,izin_hangus',
        ]);

        $oldStatus = $kunjungan->status;
        $newStatus = $validated['status'];

        // Daftar status yang terhitung dalam kuota paket (memotong saldo)
        $quotaStatuses = ['hadir', 'izin_hangus'];

        // Case A: Berubah dari "Tidak Potong Kuota" menjadi "Potong Kuota"
        if (!in_array($oldStatus, $quotaStatuses) && in_array($newStatus, $quotaStatuses)) {
            // Cari kwitansi aktif jika belum ada
            if (!$kunjungan->pemasukkan_id) {
                $kwitansi = $kunjungan->anak->kwitansiAktif($kunjungan->jenis_terapi);
                if ($kwitansi) {
                    $kunjungan->pemasukkan_id = $kwitansi->id;
                    $kunjungan->tarif_id = $kwitansi->tarif_id;
                }
            }
        }
        
        // Case B: Berubah dari "Potong Kuota" menjadi "Tidak Potong Kuota"
        if (in_array($oldStatus, $quotaStatuses) && !in_array($newStatus, $quotaStatuses)) {
            $kunjungan->pemasukkan_id = null;
            // Jika sebelumnya ini yang menutup sesi, kembalikan jadi aktif
            $kunjungan->status_sesi = 'aktif';
        }

        $kunjungan->status = $newStatus;

        // Re-check status_sesi (apakah sudah limit atau belum)
        $maxPertemuan = 20;
        if ($kunjungan->tarif_id) {
            $tarif = Tarif::find($kunjungan->tarif_id);
            $maxPertemuan = $tarif ? ($tarif->jumlah_pertemuan ?? 20) : 20;
        }

        if (in_array($kunjungan->status, $quotaStatuses) && $kunjungan->pertemuan >= $maxPertemuan) {
            $kunjungan->status_sesi = 'selesai';
        } else {
            $kunjungan->status_sesi = 'aktif';
        }

        $kunjungan->save();

        return redirect()->back()->with('success', "Status dan Sinkronisasi Kuota telah diperbaharui");
    }

    public function updateTerapis(Request $request, Kunjungan $kunjungan)
    {
        $validated = $request->validate([
            'terapis_id' => 'required|exists:terapis,id',
        ]);

        $kunjungan->update(['terapis_id' => $validated['terapis_id']]);

        return redirect()->back()->with('success', "Terapis telah di Perbaharui");
    }
}

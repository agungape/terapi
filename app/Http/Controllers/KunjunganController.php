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
        $terapis = Terapis::where('status', 'aktif')->get();
        $jenisTerapi = [
            'terapi_perilaku' => 'Terapi Perilaku',
            'fisioterapi' => 'Fisioterapi & Sensor Integrasi'
        ];

        return view('kunjungan.index', compact('terapis', 'jenisTerapi'));
    }

    public function create(Anak $anak)
    {
        return view('kunjungan.index', compact('anak'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validateData = $request->validate([
            'anak_id' => 'required|exists:App\Models\Anak,id',
            'terapis_id' => 'required|exists:App\Models\Terapis,id',
            'jenis_terapi' => 'required',
            'catatan' => '',
            'status' => 'required',
        ]);

        // Validasi agar dalam hari yang sama tidak bisa mendaftar lebih dari 1x terapi perilaku
        if ($request->jenis_terapi == 'terapi_perilaku') {
            $today = Carbon::today();

            $cek = Kunjungan::where('anak_id', $request->anak_id)
                ->where('jenis_terapi', $request->jenis_terapi)
                ->whereDate('created_at', $today)
                ->first();

            if ($cek) {
                Alert::error('Gagal Mendaftar', "Anak $request->nama sudah mendaftar hari ini. Silakan coba lagi besok.")->autoClose(6000);
                return back();
            }
        }

        // Ambil data kunjungan terakhir untuk jenis terapi ini
        $kunjungan_terakhir = Kunjungan::where('anak_id', $request->anak_id)
            ->where('jenis_terapi', $request->jenis_terapi)
            ->orderBy('created_at', 'desc')
            ->first();

        $nextPertemuan = 1;
        $nextSesi = 1;

        if ($kunjungan_terakhir) {
            // Jika ada kunjungan sebelumnya
            if ($kunjungan_terakhir->pertemuan < 20) {
                $nextPertemuan = $kunjungan_terakhir->pertemuan + 1;
                $nextSesi = $kunjungan_terakhir->sesi ?? 1;
            } else {
                // Jika pertemuan sudah 20, naikkan sesi dan reset pertemuan
                $nextPertemuan = 1;
                $nextSesi = ($kunjungan_terakhir->sesi ?? 1) + 1;
            }
        }

        $pertemuan = ($request->status == 'hadir' || $request->status == 'izin_hangus')
            ? $nextPertemuan
            : ($kunjungan_terakhir->pertemuan ?? 1);

        $sesi = ($request->status == 'hadir' || $request->status == 'izin_hangus')
            ? $nextSesi
            : ($kunjungan_terakhir->sesi ?? 1);

        $data = [
            'anak_id' => $request->anak_id,
            'terapis_id' => $request->terapis_id,
            'jenis_terapi' => $request->jenis_terapi,
            'catatan' => $request->catatan,
            'status' => $request->status,
            'pertemuan' => $pertemuan,
            'sesi' => $sesi,
        ];

        $kunjungan = Kunjungan::create($data);
        Alert::success('Berhasil', "Data Anak $request->nama berhasil didaftarkan")->autoClose(4000);
        return redirect("/data");
    }

    // Tambahkan method baru untuk handle selesai sesi
    public function selesaiSesi(Request $request): RedirectResponse
    {
        $validateData = $request->validate([
            'anak_id' => 'required|exists:App\Models\Anak,id',
            'jenis_terapi' => 'required',
        ]);

        // Ambil data kunjungan terakhir untuk jenis terapi ini
        $kunjungan_terakhir = Kunjungan::where('anak_id', $request->anak_id)
            ->where('jenis_terapi', $request->jenis_terapi)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($kunjungan_terakhir) {
            // Buat record baru untuk menandai selesai sesi
            $data = [
                'anak_id' => $request->anak_id,
                'terapis_id' => $kunjungan_terakhir->terapis_id,
                'jenis_terapi' => $request->jenis_terapi,
                'catatan' => 'Sesi selesai',
                'status' => 'hadir',
                'pertemuan' => null,
                'sesi' => ($kunjungan_terakhir->sesi ?? 1) + 1,
            ];

            Kunjungan::create($data);
            Alert::success('Berhasil', "Sesi terapi untuk anak ini telah diselesaikan dan akan dimulai sesi baru")->autoClose(4000);
            return redirect("/data");
        } else {
            Alert::error('Gagal', "Tidak ada data kunjungan sebelumnya")->autoClose(4000);
        }

        return back();
    }

    public function riwayatAnak()
    {
        $terapis = Terapis::where('status', 'aktif')->get();
        $kunjungan = Kunjungan::whereNotNull('pertemuan')->whereNull('catatan')
            ->latest()
            ->paginate(10);

        // Ambil daftar sesi yang sudah selesai (memiliki catatan 'Sesi selesai')
        $completedSessions = Kunjungan::where('catatan', 'Sesi selesai')
            ->select('anak_id', 'sesi', 'jenis_terapi')
            ->get()
            ->map(function ($item) {
                return $item->anak_id . '-' . ($item->sesi - 1) . '-' . $item->jenis_terapi;
            })
            ->toArray();

        // dd($completedSessions);
        $total = Kunjungan::whereNull('catatan')->where('status', 'hadir')->count();
        $hadir = Kunjungan::whereDate('created_at', today())->whereNull('catatan')->where('status', 'hadir')->count();
        $izin = Kunjungan::whereDate('created_at', today())->where('status', 'izin')->count();
        $sakit = Kunjungan::whereDate('created_at', today())->where('status', 'sakit')->count();
        $izin_hangus = Kunjungan::whereDate('created_at', today())->where('status', 'izin_hangus')->count();
        return view('kunjungan.data', compact('terapis', 'kunjungan', 'hadir', 'izin', 'sakit', 'izin_hangus', 'total', 'completedSessions'));
    }

    public function show(Kunjungan $kunjungan)
    {
        // riwayat terapi_perilaku
        $riwayat = Kunjungan::with('pemeriksaans')->where('anak_id', $kunjungan->anak_id)->where('jenis_terapi', 'terapi_perilaku')->whereNull('catatan')->latest()->get();
        // riwayat fisioterapi
        $riwayat_fisioterapi = Kunjungan::with('fisioterapis')->where('anak_id', $kunjungan->anak_id)->where('jenis_terapi', 'fisioterapi')->whereNull('catatan')->latest()->get();

        $program = Program::where('jenis', 'terapi_perilaku')->get();
        $program_fisioterapi = Program::where('jenis', 'fisioterapi')->get();
        $tanggal_lahir = Carbon::parse($kunjungan->anak->tanggal_lahir);
        $kunjungan->usia = $tanggal_lahir->diffInYears(Carbon::now());

        $hasHigherSession = Kunjungan::where('anak_id', $kunjungan->anak_id)
            ->where('jenis_terapi', $kunjungan->jenis_terapi)
            ->where('sesi', '>', $kunjungan->sesi)
            ->exists();

        // Cek apakah sesi saat ini sudah selesai
        $isCurrentSessionCompleted = Kunjungan::where('anak_id', $kunjungan->anak_id)
            ->where('sesi', $kunjungan->sesi)
            ->where('jenis_terapi', $kunjungan->jenis_terapi)
            ->where('catatan', 'Sesi selesai')
            ->exists();

        return view('kunjungan.detail', compact('kunjungan', 'program', 'riwayat', 'riwayat_fisioterapi', 'program_fisioterapi', 'hasHigherSession', 'isCurrentSessionCompleted'));
    }

    public function search_kunjungan(Request $request)
    {
        $terapis = Terapis::where('status', 'aktif')->get();
        $query = Kunjungan::with(['anak', 'terapis', 'tarif'])
            ->whereNotNull('pertemuan')
            ->whereNull('catatan')
            ->orderBy('created_at', 'desc');

        // Filter berdasarkan range tanggal jika ada
        if ($request->date_range) {
            $dates = explode(' - ', $request->date_range);
            $startDate = Carbon::parse($dates[0])->startOfDay();
            $endDate = Carbon::parse($dates[1])->endOfDay();

            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $kunjungan = $query->paginate(10);

        $completedSessions = Kunjungan::where('catatan', 'Sesi selesai')
            ->select('anak_id', 'sesi', 'jenis_terapi')
            ->get()
            ->map(function ($item) {
                return $item->anak_id . '-' . ($item->sesi - 1) . '-' . $item->jenis_terapi;
            })
            ->toArray();

        // Hitung statistik untuk card
        $total = $query->clone()->whereNull('catatan')->where('status', 'hadir')->count();
        $hadir = $query->clone()->whereNull('catatan')->where('status', 'hadir')->count();
        $izin = $query->clone()->whereNull('catatan')->where('status', 'izin')->count();
        $sakit = $query->clone()->whereNull('catatan')->where('status', 'sakit')->count();
        $izin_hangus = Kunjungan::whereDate('created_at', today())->where('status', 'izin_hangus')->count();

        return view('kunjungan.data', compact('terapis', 'kunjungan', 'hadir', 'izin', 'sakit', 'izin_hangus', 'total', 'completedSessions'));
    }

    public function edit(Kunjungan $kunjungan)
    {
        //
    }

    public function destroy(Kunjungan $kunjungan)
    {
        $kunjungan->delete();
        Alert::success('Berhasil', "kunjungan anak telah di hapus")->autoClose(4000);
        return redirect()->back();
    }

    public function tambahTerapis(Request $request, Kunjungan $kunjungan)
    {
        $validated = $request->validate([
            'terapis_id_pendamping' => 'required|exists:terapis,id',
        ]);

        // Pengecekan 1: Terapis pendamping tidak boleh sama dengan terapis utama
        if ($validated['terapis_id_pendamping'] == $kunjungan->terapis_id) {
            Alert::error('Gagal', 'Terapis pendamping tidak boleh sama dengan terapis utama')->autoClose(4000);
            return redirect()->back();
        }

        // Pengecekan 2: Maksimal 2 terapis (1 utama + 1 pendamping)
        if ($kunjungan->terapis_id_pendamping) {
            Alert::error('Gagal', 'Maksimal hanya boleh ada 2 terapis (1 utama + 1 pendamping)')->autoClose(4000);
            return redirect()->back();
        }

        // Update terapis pendamping
        $kunjungan->update(['terapis_id_pendamping' => $validated['terapis_id_pendamping']]);

        Alert::success('Berhasil', "Terapis pendamping berhasil ditambahkan")->autoClose(4000);
        return redirect()->back();
    }

    public function updateStatus(Request $request, Kunjungan $kunjungan)
    {
        $validated = $request->validate([
            'status' => 'required|in:hadir,izin,sakit,izin_hangus',
        ]);

        $kunjungan->update(['status' => $validated['status']]);

        Alert::success('Berhasil', "Status telah di Perbaharui")->autoClose(4000);
        return redirect()->back();
    }

    public function updateTerapis(Request $request, Kunjungan $kunjungan)
    {
        $validated = $request->validate([
            'terapis_id' => 'required|exists:terapis,id',
        ]);

        $kunjungan->update(['terapis_id' => $validated['terapis_id']]);

        Alert::success('Berhasil', "Terapis telah di Perbaharui")->autoClose(4000);
        return redirect()->back();
    }
}

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

    /**
     * Show the form for creating a new resource.
     */
    public function create(Anak $anak)
    {
        return view('kunjungan.index', compact('anak'));
    }

    /**
     * Store a newly created resource in storage.
     */

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
        $today = Carbon::today();

        $cek = Kunjungan::where('anak_id', $request->anak_id)
            ->where('jenis_terapi', $request->jenis_terapi)
            ->whereDate('created_at', $today)
            ->first();

        if ($cek) {
            Alert::error('Gagal Mendaftar', "Anak $request->nama sudah mendaftar hari ini. Silakan coba lagi besok.")->autoClose(6000);
            return back();
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

        $data = [
            'anak_id' => $request->anak_id,
            'terapis_id' => $request->terapis_id,
            'jenis_terapi' => $request->jenis_terapi,
            'catatan' => $request->catatan,
            'status' => $request->status,
            'pertemuan' => ($request->status == 'hadir' || $request->status == 'sakit') ? $nextPertemuan : $kunjungan_terakhir->pertemuan,
            'sesi' => ($request->status == 'hadir' || $request->status == 'sakit') ? $nextSesi : $kunjungan_terakhir->sesi,
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
        $kunjungan = Kunjungan::whereNull('catatan')
            ->latest()
            ->paginate(5);

        $hadir = Kunjungan::whereDate('created_at', today())->whereNull('catatan')->where('status', 'hadir')->count();
        $izin = Kunjungan::whereDate('created_at', today())->where('status', 'izin')->count();
        $sakit = Kunjungan::whereDate('created_at', today())->where('status', 'sakit')->count();

        return view('kunjungan.data', compact('kunjungan', 'hadir', 'izin', 'sakit'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Kunjungan $kunjungan)
    {
        // dd($kunjungan->anak_id);
        $riwayat = Kunjungan::with('pemeriksaans')->where('anak_id', $kunjungan->anak_id)->where('jenis_terapi', 'terapi_perilaku')->whereNull('catatan')->get();
        // dd($riwayat);
        $jumlah_pemeriksaan = Pemeriksaan::select('created_at', DB::raw('count(id) as value'))->whereHas('kunjungan', function ($query) use ($kunjungan) {
            $query->where('anak_id', $kunjungan->anak->id);
        })->groupBy('created_at')->get();

        $jumlah_pemeriksaan = array_reduce($jumlah_pemeriksaan->toArray(), function ($hold_data, $item) {
            $tanggal = strtotime($item['created_at']);
            $hold_data[$tanggal] = $item['value'];
            return $hold_data;
        });

        $program = Program::all();
        $tanggal_lahir = Carbon::parse($kunjungan->anak->tanggal_lahir);
        $kunjungan->usia = $tanggal_lahir->diffInYears(Carbon::now());
        return view('kunjungan.detail', compact('kunjungan', 'program', 'riwayat', 'jumlah_pemeriksaan'));
    }


    public function search_kunjungan(Request $request)
    {
        $query = Kunjungan::with(['anak', 'terapis', 'tarif'])
            ->orderBy('created_at', 'desc');

        // Filter berdasarkan range tanggal jika ada
        if ($request->date_range) {
            $dates = explode(' - ', $request->date_range);
            $startDate = Carbon::parse($dates[0])->startOfDay();
            $endDate = Carbon::parse($dates[1])->endOfDay();

            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $kunjungan = $query->paginate(10);

        // Hitung statistik untuk card
        $hadir = $query->clone()->where('status', 'hadir')->count();
        $izin = $query->clone()->where('status', 'izin')->count();
        $sakit = $query->clone()->where('status', 'sakit')->count();

        return view('kunjungan.data', compact('kunjungan', 'hadir', 'izin', 'sakit'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kunjungan $kunjungan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kunjungan $kunjungan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kunjungan $kunjungan)
    {
        //
    }
}

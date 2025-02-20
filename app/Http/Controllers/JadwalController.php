<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Jadwal;
use App\Models\Kunjungan;
use App\Models\Terapis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JadwalController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view jadwal anak', ['only' => ['index']]);
        $this->middleware('permission:create jadwal anak', ['only' => ['store', 'edit', 'update']]);
        $this->middleware('permission:delete jadwal anak', ['only' => ['destroy']]);
    }


    public function index()
    {
        $jadwals = Jadwal::orderBy('tanggal', 'asc')->orderBy('waktu', 'asc')->orderBy('terapis_id', 'asc')->paginate(20);

        $jadwalHari = $jadwals->map(function ($item) {
            $item->hari = Carbon::parse($item->tanggal)->translatedFormat('l'); // Tambahkan nama hari
            return $item;
        });

        $maxTerapisCount = Terapis::where('status', 'aktif')->count();
        $waktu = [
            '09.00 - 10.00'  => '09.00 - 10.00',
            '10.00 - 11.00' => '10.00 - 11.00',
            '11.00 - 12.00' => '11.00 - 12.00',
            '13.00 - 14.00' => '13.00 - 14.00',
            '14.00 - 15.00' => '14.00 - 15.00',
            '15.00 - 16.00' => '15.00 - 16.00',
            '16.00 - 17.00' => '16.00 - 17.00'
        ];

        $availableWaktu = [];

        foreach ($waktu as $key => $value) {
            // Hitung jumlah terapis yang sudah memilih waktu ini di tabel jadwal
            $terapisCount = Jadwal::where('waktu', $key)->count();

            // Jika jumlah terapis yang memilih waktu ini kurang dari maksimal, tambahkan waktu ke availableWaktu
            if ($terapisCount < $maxTerapisCount) {
                $availableWaktu[$key] = $value;
            }
        }

        $today = Carbon::today()->toDateString();

        // Ambil data anak yang belum memiliki jadwal hari ini
        $anaks = Anak::whereDoesntHave('jadwals', function ($query) use ($today) {
            $query->whereDate('tanggal', $today);
        })->where('status', 'aktif')->get();

        // $anaks = Anak::where('status', 'aktif')->orderBy('nama', 'ASC')->get();
        $terapis = Terapis::where('status', 'aktif')->orderBy('nama', 'ASC')->get();
        return view('jadwal.index', compact('anaks', 'terapis', 'jadwals', 'availableWaktu'));
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

        $validateData = $request->validate([
            'anak_id' => 'required|exists:App\Models\Anak,id',
            'terapis_id' => 'required|exists:App\Models\Terapis,id',
            'waktu' => 'required',
            'tanggal' => 'required|date',
        ]);

        // 1. Cek apakah anak sudah terdaftar pada tanggal ini
        $anakExists = Jadwal::where('anak_id', $request->anak_id)
            ->where('tanggal', $request->tanggal)
            ->exists();

        if ($anakExists) {
            return back()->withErrors(['anak_id' => 'Anak hanya boleh terdaftar satu kali pada hari ini.'])->withInput();
        }

        // 2. Cek apakah terapis sudah memiliki jadwal pada waktu yang sama
        $terapisExists = Jadwal::where('terapis_id', $request->terapis_id)
            ->where('tanggal', $request->tanggal)
            ->where('waktu', $request->waktu)
            ->exists();

        if ($terapisExists) {
            return back()->withErrors(['terapis_id' => 'Terapis sudah memiliki jadwal pada waktu yang sama.'])->withInput();
        }

        // // 3. Cek apakah waktu sudah digunakan dalam hari yang sama dengan anak berbeda
        // $waktuExists = Jadwal::where('waktu', $request->waktu)
        //     ->where('tanggal', $request->tanggal)
        //     ->where('terapis_id', '<>', $request->terapis_id)
        //     ->exists();

        // if ($waktuExists) {
        //     return back()->withErrors(['waktu' => 'Waktu ini sudah digunakan oleh anak lain pada tanggal yang sama.'])->withInput();
        // }


        $kunjungan_terakhir = Kunjungan::where('anak_id', $request->anak_id)->latest('created_at')->first();

        // Ambil nilai pertemuan sebagai string
        if ($kunjungan_terakhir == true) {
            $kunjungan_terakhirCount = $kunjungan_terakhir->pertemuan; // Asumsi kolomnya bernama 'pertemuan'
            $kunjungan_terakhirHasil = $kunjungan_terakhirCount + 1;
        } else {
            $kunjungan_terakhirHasil = 1;
        }
        // tambahkan 1

        $data['anak_id'] = $request->anak_id;
        $data['terapis_id'] = $request->terapis_id;
        $data['waktu'] = $request->waktu;
        $data['tanggal'] = $request->tanggal;
        $data['pertemuan'] = $kunjungan_terakhirHasil;

        $jadwal = Jadwal::create($data);
        Alert::success('Berhasil', "Data Jadwal berhasil dibuat");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        $jadwals = Jadwal::orderBy('tanggal', 'asc')->orderBy('waktu', 'asc')->paginate(20);

        $jadwalHari = $jadwals->map(function ($item) {
            $item->hari = Carbon::parse($item->tanggal)->translatedFormat('l'); // Tambahkan nama hari
            return $item;
        });

        $waktu = [
            '09.00 - 10.00'  => '09.00 - 10.00',
            '10.00 - 11.00' => '10.00 - 11.00',
            '11.00 - 12.00' => '11.00 - 12.00',
            '13.00 - 14.00' => '13.00 - 14.00',
            '14.00 - 15.00' => '14.00 - 15.00',
            '15.00 - 16.00' => '15.00 - 16.00',
            '16.00 - 17.00' => '16.00 - 17.00'
        ];
        $anaks = Anak::where('status', 'aktif')->orderBy('nama', 'ASC')->get();
        $terapis = Terapis::where('status', 'aktif')->orderBy('nama', 'ASC')->get();
        return view('jadwal.edit', compact('anaks', 'terapis', 'jadwals', 'waktu', 'jadwal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $validateData = $request->validate([
            'terapis_id' => 'required|exists:App\Models\Terapis,id',
            'waktu' => 'required',
            'tanggal' => 'required|date',
        ]);


        // 2. Cek apakah terapis sudah memiliki jadwal pada waktu yang sama
        $terapisExists = Jadwal::where('terapis_id', $request->terapis_id)
            ->where('tanggal', $request->tanggal)
            ->where('waktu', $request->waktu)
            ->exists();

        if ($terapisExists) {
            return back()->withErrors(['terapis_id' => 'Terapis sudah memiliki jadwal pada waktu yang sama.'])->withInput();
        }

        $data['anak_id'] = $jadwal->anak_id;
        $data['terapis_id'] = $request->terapis_id;
        $data['waktu'] = $request->waktu;
        $data['tanggal'] = $request->tanggal;
        $data['pertemuan'] = $jadwal->pertemuan;

        $jadwal->update($data);
        Alert::success('Berhasil', "Data Jadwal berhasil diupdate");
        return redirect()->route('jadwal.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        Alert::success('Berhasil', "jadwal telah di hapus");
        return redirect("/jadwal");
    }
}

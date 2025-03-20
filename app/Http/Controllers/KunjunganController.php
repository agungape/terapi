<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Kunjungan;
use App\Models\Pemeriksaan;
use App\Models\Program;
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
        $terapis = Terapis::all();
        return view('kunjungan.index', compact('terapis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Anak $anak)
    {
        $program = Program::all();
        return view('kunjungan.index', compact('anak', 'program'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validateData = $request->validate([
            'anak_id' => 'required|exists:App\Models\Anak,id',
            'terapis_id' => 'required|exists:App\Models\Terapis,id',
            'catatan' => '',
            'status' => 'required',
        ]);


        // fungsi validasi agar dalam hari yang sama tidak bisa mendaftar lebih dari 1x
        // $today = Carbon::today();
        // $cek = Kunjungan::where('anak_id', $request->anak_id)
        //     ->whereDate('created_at', $today)
        //     ->first();
        // if ($cek) {
        //     // Jika sudah ada pendaftaran, return error
        //     Alert::error('Gagal Mendaftar', "Anak $request->nama sudah mendaftar hari ini. Silakan coba lagi besok.");
        //     return back();
        // }

        // Cek apakah anak sudah pernah kunjungan sebelumnya
        $kunjungan_data = Kunjungan::where('anak_id', $request->anak_id)
            ->orderBy('created_at', 'desc')
            ->first();

        // Jika ada kunjungan sebelumnya, nomor pertemuan +1 dari yang terakhir dan jika pertemuan = 20 maka kemabli ke pertemuan 1
        if ($kunjungan_data) {
            $nextPertemuan = ($kunjungan_data->pertemuan == 20) ? 1 : $kunjungan_data->pertemuan + 1;
            $nullPertemuan = $kunjungan_data->pertemuan;
        } else {
            // Jika belum pernah kunjungan sebelumnya, pertemuan diisi dengan 1
            $nextPertemuan = 1;
        }

        $data['anak_id'] = $request->anak_id;
        $data['terapis_id'] = $request->terapis_id;
        $data['catatan'] = $request->catatan;
        $data['status'] = $request->status;
        if ($request->status == 'hadir') {
            $data['pertemuan'] = $nextPertemuan;
        } else {
            $data['pertemuan'] = $nullPertemuan;
        }

        $kunjungan = Kunjungan::create($data);
        Alert::success('Berhasil', "Data Anak $request->nama berhasil didaftarkan");
        return redirect("/data");
    }

    public function riwayatAnak()
    {
        $kunjungan = Kunjungan::orderBy('created_at', 'desc')->paginate(4);
        return view('kunjungan.data', compact('kunjungan'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Kunjungan $kunjungan)
    {
        // dd($kunjungan->anak_id);
        $riwayat = Kunjungan::with('pemeriksaans')->where('anak_id', $kunjungan->anak_id)->get();
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

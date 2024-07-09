<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Kunjungan;
use App\Models\Program;
use App\Models\Terapis;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KunjunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        $kunjungan = Kunjungan::create($validateData);
        Alert::success('Berhasil', "Data Anak $request->nama berhasil didaftarkan");
        return redirect("/data");
    }

    public function riwayatAnak()
    {
        $kunjungan = Kunjungan::orderBy('created_at')->paginate(5);
        return view('kunjungan.data', compact('kunjungan'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Kunjungan $kunjungan)
    {
        $program = Program::all();
        $tanggal_lahir = Carbon::parse($kunjungan->anak->tanggal_lahir);
        $kunjungan->usia = $tanggal_lahir->diffInYears(Carbon::now());
        return view('kunjungan.detail', compact('kunjungan', 'program'));
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

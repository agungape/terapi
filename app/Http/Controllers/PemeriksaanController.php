<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $cek = Pemeriksaan::where('kunjungan_id', $request->kunjungan_id)->first();
        if (!$cek) {
            $validateData = $request->validate([
                'kunjungan_id' => 'required|exists:App\Models\Kunjungan,id',
                'program_id' => 'required|array',
                'status' => 'required|array',
                'keterangan' => 'nullable|string',

                'program_id.*' => 'required|exists:App\Models\Program,id',
                'status.*' => 'required',
            ]);

            // Ambil data dari input
            $kunjunganId = $request->input('kunjungan_id');
            $programId = $request->input('program_id'); // array program_id
            $status = $request->input('status'); // array status
            $keterangan = $request->input('keterangan');

            foreach ($programId as $index => $idProgram) {
                Pemeriksaan::create([
                    'kunjungan_id' => $kunjunganId,
                    'program_id' => $idProgram,
                    'status' => $status[$index],
                    'keterangan' => $keterangan,
                ]);
            }

            Alert::success('Berhasil', "Pemeriksaan berhasil ditambahkan");
            return redirect()->back();
        } else
            Alert::error('Gagal menyimpan data', "data telah dibuat pada kunjungan ini!!! Hubungi admin untuk melakukan perubahan data")->autoClose(6000);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemeriksaan $pemeriksaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemeriksaan $pemeriksaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemeriksaan $pemeriksaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemeriksaan $pemeriksaan)
    {
        //
    }
}

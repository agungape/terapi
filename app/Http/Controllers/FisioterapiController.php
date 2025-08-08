<?php

namespace App\Http\Controllers;

use App\Models\Fisioterapi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FisioterapiController extends Controller
{
    public function store(Request $request)
    {

        $cek = Fisioterapi::where('kunjungan_id', $request->kunjungan_id)->first();
        if (!$cek) {
            $validateData = $request->validate([
                'kunjungan_id' => 'required|exists:App\Models\Kunjungan,id',
                'program_id' => 'required|array',
                'aktivitas_terapi' => 'required|array',
                'evaluasi' => 'required|string',
                'catatan_khusus' => 'nullable|string',

                'program_id.*' => 'required|exists:App\Models\Program,id',
                'aktivitas_terapi.*' => 'required',
            ]);

            // Ambil data dari input
            $kunjunganId = $request->input('kunjungan_id');
            $programId = $request->input('program_id');
            $aktivitas_terapi = $request->input('aktivitas_terapi');
            $evaluasi = $request->input('evaluasi');
            $catatan_khusus = $request->input('catatan_khusus');

            foreach ($programId as $index => $idProgram) {
                Fisioterapi::create([
                    'kunjungan_id' => $kunjunganId,
                    'program_id' => $idProgram,
                    'aktivitas_terapi' => $aktivitas_terapi[$index],
                    'evaluasi' => $evaluasi,
                    'catatan_khusus' => $catatan_khusus
                ]);
            }

            Alert::success('Berhasil', "Pemeriksaan berhasil ditambahkan")->autoClose(4000);
            return redirect()->back();
        } else
            Alert::error('Gagal menyimpan data', "data telah dibuat pada kunjungan ini!!! Hubungi admin untuk melakukan perubahan data")->autoClose(6000);
        return redirect()->back();
    }
}

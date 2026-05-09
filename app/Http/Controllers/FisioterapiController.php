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
                'pilihan_respons' => 'nullable|string',
                'hasil_kegiatan' => 'nullable|string',

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
                    'catatan_khusus' => $catatan_khusus,
                    'pilihan_respons' => json_decode($request->input('pilihan_respons'), true),
                    'hasil_kegiatan' => $request->input('hasil_kegiatan'),
                ]);
            }

            return redirect()->back()->with('success', "Pemeriksaan berhasil ditambahkan");
        } else
            return redirect()->back()->with('error', "data telah dibuat pada kunjungan ini!!! Hubungi admin untuk melakukan perubahan data");
    }
}

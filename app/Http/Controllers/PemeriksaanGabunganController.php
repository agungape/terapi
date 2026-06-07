<?php

namespace App\Http\Controllers;

use App\Models\PemeriksaanGabungan;
use Illuminate\Http\Request;

class PemeriksaanGabunganController extends Controller
{
    public function store(Request $request)
    {
        $jenis_form = $request->input('jenis_form'); // 'perilaku' atau 'fisioterapi'
        $kunjunganId = $request->input('kunjungan_id');

        // Cek apakah data untuk jenis form ini sudah ada di database untuk kunjungan ini
        $cek = PemeriksaanGabungan::where('kunjungan_id', $kunjunganId)
            ->where('jenis_form', $jenis_form)
            ->first();

        if ($cek) {
            return redirect()->back()->with('error', "Data E-Book untuk {$jenis_form} telah disimpan sebelumnya! Hubungi admin untuk perubahan.");
        }

        if ($jenis_form === 'perilaku') {
            $request->validate([
                'kunjungan_id' => 'required|exists:App\Models\Kunjungan,id',
                'program_id' => 'required|array',
                'status' => 'required|array',
                'keterangan' => 'nullable|string',
                'catatan_orang_tua' => 'nullable|string',
            ]);

            $programId = $request->input('program_id');
            $status = $request->input('status');

            foreach ($programId as $index => $idProgram) {
                PemeriksaanGabungan::create([
                    'kunjungan_id' => $kunjunganId,
                    'jenis_form' => 'perilaku',
                    'program_id' => $idProgram,
                    'status' => $status[$index] ?? null,
                    'keterangan' => $request->input('keterangan'),
                    'catatan_orang_tua' => $request->input('catatan_orang_tua'),
                    'pilihan_respons' => json_decode($request->input('pilihan_respons'), true),
                    'hasil_kegiatan' => $request->input('hasil_kegiatan'),
                ]);
            }
        } elseif ($jenis_form === 'fisioterapi') {
            $request->validate([
                'kunjungan_id' => 'required|exists:App\Models\Kunjungan,id',
                'program_id' => 'required|array',
                'aktivitas_terapi' => 'required|array',
                'evaluasi' => 'required|string',
                'catatan_khusus' => 'nullable|string',
            ]);

            $programId = $request->input('program_id');
            $aktivitas_terapi = $request->input('aktivitas_terapi');

            foreach ($programId as $index => $idProgram) {
                PemeriksaanGabungan::create([
                    'kunjungan_id' => $kunjunganId,
                    'jenis_form' => 'fisioterapi',
                    'program_id' => $idProgram,
                    'aktivitas_terapi' => $aktivitas_terapi[$index] ?? null,
                    'keterangan' => $request->input('evaluasi'),
                    'catatan_orang_tua' => $request->input('catatan_khusus'),
                    'pilihan_respons' => json_decode($request->input('pilihan_respons'), true),
                    'hasil_kegiatan' => $request->input('hasil_kegiatan'),
                ]);
            }
        }

        return redirect()->back()->with('success', "E-Book {$jenis_form} berhasil disimpan.");
    }
}

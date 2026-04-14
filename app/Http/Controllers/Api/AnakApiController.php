<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\HasilPemeriksaan;
use App\Models\Jadwal;
use App\Models\Kunjungan;
use App\Models\Pemasukkan;
use App\Models\Tarif;
use App\Models\informasi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnakApiController extends Controller
{
    /**
     * GET /api/v1/anak/profile
     */
    public function profile(Request $request)
    {
        $user = $request->user();
        $anak = $user->getAnakData();

        if (!$anak) {
            return response()->json(['success' => false, 'message' => 'Data anak tidak ditemukan.'], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => [
                'id'               => $anak->id,
                'nama'             => $anak->nama,
                'foto'             => $anak->foto ? asset('storage/anak/' . $anak->foto) : null,
                'tanggal_lahir'    => $anak->tanggal_lahir,
                'usia'             => $anak->usia,
                'jenis_kelamin'    => $anak->jenis_kelamin,
                'diagnosa'         => $anak->diagnosa,
                'alamat'           => $anak->alamat,
                'pendidikan'       => $anak->pendidikan,
                'nama_ayah'        => $anak->nama_ayah,
                'nama_ibu'         => $anak->nama_ibu,
                'telepon_ayah'     => $anak->telepon_ayah,
                'telepon_ibu'      => $anak->telepon_ibu,
                'status'           => $anak->status,
            ],
        ]);
    }

    /**
     * GET /api/v1/anak/kunjungan
     * Riwayat kunjungan dikelompokkan per sesi dan jenis terapi.
     */
    public function kunjungan(Request $request)
    {
        $user = $request->user();
        $anak = $user->getAnakData();

        if (!$anak) {
            return response()->json(['success' => false, 'message' => 'Data anak tidak ditemukan.'], 404);
        }

        $kunjungans = Kunjungan::with(['terapis', 'terapisPendamping', 'tarif'])
            ->where('anak_id', $anak->id)
            ->whereNull('catatan')
            ->orderBy('sesi', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        // Kelompokkan per jenis terapi → per sesi
        $grouped = $kunjungans->groupBy('jenis_terapi')->map(function ($byJenis) {
            return $byJenis->groupBy('sesi')->map(function ($bySesi) {
                return [
                    'sesi'       => $bySesi->first()->sesi,
                    'kunjungans' => $bySesi->map(fn($k) => [
                        'id'            => $k->id,
                        'pertemuan'     => $k->pertemuan,
                        'status'        => $k->status,
                        'tanggal'       => $k->getRawOriginal('created_at'),
                        'terapis'       => $k->terapis->nama ?? '-',
                        'paket'         => $k->tarif->nama ?? '-',
                        'jenis_terapi'  => $k->jenis_terapi,
                    ])->values(),
                    'total_hadir'    => $bySesi->where('status', 'hadir')->count(),
                    'total_izin'     => $bySesi->where('status', 'izin')->count(),
                    'total_sakit'    => $bySesi->where('status', 'sakit')->count(),
                ];
            })->values();
        });

        return response()->json(['success' => true, 'data' => $grouped]);
    }

    /**
     * GET /api/v1/anak/kunjungan/{id}
     */
    public function kunjunganDetail(Request $request, $id)
    {
        $user = $request->user();
        $anak = $user->getAnakData();

        $kunjungan = Kunjungan::with(['terapis', 'terapisPendamping', 'tarif', 'pemeriksaans.program', 'fisioterapis.program'])
            ->where('anak_id', $anak->id)
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => [
                'id'                 => $kunjungan->id,
                'pertemuan'          => $kunjungan->pertemuan,
                'sesi'               => $kunjungan->sesi,
                'jenis_terapi'       => $kunjungan->jenis_terapi,
                'status'             => $kunjungan->status,
                'tanggal'            => $kunjungan->getRawOriginal('created_at'),
                'catatan'            => $kunjungan->catatan,
                'terapis'            => $kunjungan->terapis ? ['nama' => $kunjungan->terapis->nama] : null,
                'terapis_pendamping' => $kunjungan->terapisPendamping ? ['nama' => $kunjungan->terapisPendamping->nama] : null,
                'paket'              => $kunjungan->tarif ? [
                    'nama'             => $kunjungan->tarif->nama,
                    'jumlah_pertemuan' => $kunjungan->tarif->jumlah_pertemuan,
                ] : null,
                'pemeriksaans' => $kunjungan->pemeriksaans->map(fn($p) => [
                    'program'    => $p->program->deskripsi ?? '-',
                    'status'     => $p->status,
                    'keterangan' => $p->keterangan,
                ]),
                'fisioterapis' => $kunjungan->fisioterapis->map(fn($f) => [
                    'program'          => $f->program->deskripsi ?? '-',
                    'aktivitas_terapi' => $f->aktivitas_terapi,
                    'evaluasi'         => $f->evaluasi,
                ]),
            ],
        ]);
    }

    /**
     * GET /api/v1/anak/assessment
     */
    public function assessment(Request $request)
    {
        $user = $request->user();
        $anak = $user->getAnakData();

        if (!$anak) {
            return response()->json(['success' => false, 'message' => 'Data anak tidak ditemukan.'], 404);
        }

        $assessments = Assessment::with('Psikolog')
            ->where('anak_id', $anak->id)
            ->latest()
            ->get()
            ->map(fn($a) => [
                'id'                 => $a->id,
                'tanggal_assessment' => $a->tanggal_assessment?->format('d/m/Y'),
                'tujuan_pemeriksaan' => $a->tujuan_pemeriksaan,
                'diagnosa'           => $a->diagnosa,
                'psikolog'           => $a->Psikolog->nama ?? '-',
                'status_bayar'       => $a->status_bayar,
                'skor_iq_total'      => $a->skor_iq_total,
                'klasifikasi'        => $a->klasifikasi,
            ]);

        return response()->json(['success' => true, 'data' => $assessments]);
    }

    /**
     * GET /api/v1/anak/assessment/{id}
     */
    public function assessmentDetail(Request $request, $id)
    {
        $user = $request->user();
        $anak = $user->getAnakData();

        $assessment = Assessment::with(['Psikolog', 'alatUkurs'])
            ->where('anak_id', $anak->id)
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => [
                'id'                    => $assessment->id,
                'tanggal_assessment'    => $assessment->tanggal_assessment?->format('d/m/Y'),
                'tujuan_pemeriksaan'    => $assessment->tujuan_pemeriksaan,
                'diagnosa'              => $assessment->diagnosa,
                'kesimpulan_observasi'  => $assessment->kesimpulan_observasi,
                'rekomendasi_orangtua'  => $assessment->rekomendasi_orangtua,
                'rekomendasi_terapi'    => $assessment->rekomendasi_terapi,
                'psikolog'              => $assessment->Psikolog->nama ?? '-',
                'status_bayar'          => $assessment->status_bayar,
                'skor_kognitif'         => $assessment->skor_kognitif,
                'skor_bahasa'           => $assessment->skor_bahasa,
                'skor_motorik'          => $assessment->skor_motorik,
                'skor_sosial_emosional' => $assessment->skor_sosial_emosional,
                'skor_perilaku_adaptif' => $assessment->skor_perilaku_adaptif,
                'skor_iq_total'         => $assessment->skor_iq_total,
                'klasifikasi'           => $assessment->klasifikasi,
                'interpretasi_skor'     => $assessment->interpretasi_skor,
                'alat_ukur_digunakan'   => $assessment->alatUkurs->map(fn($a) => [
                    'nama'          => $a->nama,
                    'singkatan'     => $a->singkatan,
                    'domain'        => $a->domain_label,
                    'skor_raw'      => $a->pivot->skor_raw,
                    'skor_standar'  => $a->pivot->skor_standar,
                    'persentil'     => $a->pivot->persentil,
                    'klasifikasi'   => $a->pivot->klasifikasi,
                ]),
            ],
        ]);
    }

    /**
     * GET /api/v1/anak/observasi
     */
    public function observasi(Request $request)
    {
        $user = $request->user();
        $anak = $user->getAnakData();

        if (!$anak) {
            return response()->json(['success' => false, 'message' => 'Data anak tidak ditemukan.'], 404);
        }

        $hasil = HasilPemeriksaan::where('anak_id', $anak->id)
            ->latest()
            ->get()
            ->map(fn($h) => [
                'id'                  => $h->id,
                'jenis'               => $h->jenis,
                'hasil'               => $h->hasil,
                'total_skor'          => $h->total_skor,
                'interpretasi'        => $h->interpretasi,
                'catatan_klinis'      => $h->catatan_klinis,
                'tanggal'             => $h->tanggal_pemeriksaan?->format('d/m/Y') ?? $h->created_at->format('d/m/Y'),
                'badge_class'         => $h->getBadgeClass(),
            ]);

        return response()->json(['success' => true, 'data' => $hasil]);
    }

    /**
     * GET /api/v1/anak/payment
     * Riwayat pembayaran linked by anak_id (bukan nama string).
     */
    public function payment(Request $request)
    {
        $user = $request->user();
        $anak = $user->getAnakData();

        if (!$anak) {
            return response()->json(['success' => false, 'message' => 'Data anak tidak ditemukan.'], 404);
        }

        // Ambil pembayaran berdasarkan anak_id (relasi resmi)
        $pembayaran = Pemasukkan::with(['tarif', 'assessment'])
            ->where('anak_id', $anak->id)
            ->orderBy('tanggal', 'desc')
            ->get()
            ->map(fn($p) => [
                'id'            => $p->id,
                'tanggal'       => $p->tanggal,
                'jumlah'        => $p->jumlah,
                'jumlah_raw'    => $p->jumlah_raw,
                'deskripsi'     => $p->deskripsi,
                'jenis_layanan' => $p->jenis_layanan,
                'metode_bayar'  => $p->metode_bayar,
                'sesi_dibayar'  => $p->sesi_dibayar,
                'paket'         => $p->tarif ? [
                    'nama'             => $p->tarif->nama,
                    'jumlah_pertemuan' => $p->tarif->jumlah_pertemuan,
                ] : null,
                'assessment' => $p->assessment ? [
                    'tanggal' => $p->assessment->tanggal_assessment?->format('d/m/Y'),
                    'tujuan'  => $p->assessment->tujuan_pemeriksaan,
                ] : null,
            ]);

        return response()->json(['success' => true, 'data' => $pembayaran]);
    }

    /**
     * GET /api/v1/anak/paket
     * Daftar paket terapi aktif + status per-anak.
     */
    public function paket(Request $request)
    {
        $user = $request->user();
        $anak = $user->getAnakData();

        $tarifs = Tarif::where('is_active', true)->latest()->get()->map(function ($t) use ($anak) {
            $terpakai    = $anak ? $anak->sesiTerpakaiPaket($t->id) : 0;
            $sudahLunas  = $anak ? $anak->sudahLunasPaket($t->id) : false;
            return [
                'id'               => $t->id,
                'nama'             => $t->nama,
                'deskripsi'        => $t->deskripsi,
                'tarif'            => $t->tarif,
                'tarif_raw'        => $t->getRawOriginal('tarif'),
                'gambar'           => $t->gambar ? asset('storage/tarif/' . $t->gambar) : null,
                'jumlah_pertemuan' => $t->jumlah_pertemuan,
                'jenis_terapi'     => $t->jenis_terapi,
                'sesi_terpakai'    => $terpakai,
                'sesi_sisa'        => max(0, ($t->jumlah_pertemuan ?? 0) - $terpakai),
                'sudah_lunas'      => $sudahLunas,
            ];
        });

        return response()->json(['success' => true, 'data' => $tarifs]);
    }

    /**
     * GET /api/v1/anak/jadwal
     * Jadwal terapi mendatang.
     */
    public function jadwal(Request $request)
    {
        $user = $request->user();
        $anak = $user->getAnakData();

        if (!$anak) {
            return response()->json(['success' => false, 'message' => 'Data anak tidak ditemukan.'], 404);
        }

        $jadwals = \App\Models\Jadwal::with('terapis')
            ->where('anak_id', $anak->id)
            ->where('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal', 'asc')
            ->get()
            ->map(fn($j) => [
                'id'      => $j->id,
                'tanggal' => $j->tanggal,
                'waktu'   => $j->waktu,
                'terapis' => $j->terapis->nama ?? '-',
                'pertemuan' => $j->pertemuan,
            ]);

        return response()->json(['success' => true, 'data' => $jadwals]);
    }

    /**
     * GET /api/v1/informasi
     * Informasi klinik untuk halaman home app.
     */
    public function informasi()
    {
        $info = \App\Models\Informasi::first();
        return response()->json([
            'success' => true,
            'data'    => $info,
        ]);
    }
}

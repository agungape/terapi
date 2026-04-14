<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Assessment;
use App\Models\Psikolog;
use App\Models\AlatUkur;
use App\Models\QuestionResponseWawancara;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;
use Illuminate\Support\Str;
use Milon\Barcode\DNS2D;
use RealRashid\SweetAlert\Facades\Alert;

class AssessmentController extends Controller
{
    public function getWawancara($anak)
    {
        try {
            $latestSession = QuestionResponseWawancara::where('anak_id', $anak)
                ->latest('created_at')
                ->first();

            if (!$latestSession) {
                return response()->json([]);
            }

            $wawancara = QuestionResponseWawancara::with('question_wawancara')
                ->where('anak_id', $anak)
                ->where('created_at', '>=', $latestSession->created_at->subMinute())
                ->get();

            return response()->json($wawancara);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        $assessment = Assessment::latest()->paginate(10);
        return view('assessment.index', compact('assessment'));
    }

    public function create()
    {
        $user = Auth::user();
        $roles = $user->getRoleNames();
        $anaks = Anak::where('status', 'aktif')->latest()->get();

        $alatukurs = AlatUkur::where('is_active', true)->get();

        if ($roles->contains('psikolog')) {
            $psikologs = Psikolog::where('nama', $user->name)->first();
            return view('assessment.create', compact('anaks', 'psikologs', 'roles', 'alatukurs'));
        } else {
            $psikologs = Psikolog::latest()->get();
            return view('assessment.create', compact('anaks', 'psikologs', 'roles', 'alatukurs'));
        }
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateRequest($request);

        $assessment = Assessment::create([
            'anak_id'               => $validated['anak_id'],
            'psikolog_id'           => $validated['psikolog_id'],
            'tanggal_assessment'    => $validated['tanggal_assessment'],
            'tujuan_pemeriksaan'    => $validated['tujuan_pemeriksaan'],
            'keluhan_utama'         => $validated['keluhan_utama'],
            'kesimpulan_observasi'  => $validated['kesimpulan_observasi'],
            'sumber_asesmen'        => $this->prepareJsonData($validated['sumber_asesmen_combined']),
            'observasi_awal'        => $this->prepareJsonData($validated['perilaku_combined']),
            'hasil_pemeriksaan'     => $this->prepareJsonData($validated['hasil_pemeriksaan_combined']),
            'diagnosa'              => $validated['diagnosa'],
            'diagnosa_banding'      => $validated['diagnosa_banding'] ?? null,
            'rekomendasi_orangtua'  => $this->prepareJsonData($validated['rekomendasi_orangtua_combined']),
            'rekomendasi_terapi'    => $this->prepareJsonData($validated['rekomendasi_terapi_combined']),
            'catatan_tambahan'      => $validated['catatan_tambahan'] ?? null,
            'persetujuan_psikolog'  => $validated['persetujuan_psikolog'] == '1',
            'alasan_tidak_setuju'   => $validated['alasan_tidak_setuju'] ?? null,

            // New Clinical Fields
            'mood_anak'             => $validated['mood_anak'] ?? null,
            'validitas_hasil'       => $validated['validitas_hasil'] ?? null,
            'catatan_rapport'       => $validated['catatan_rapport'] ?? null,
            'kontak_mata'           => $validated['kontak_mata'] ?? null,
            'komunikasi'            => $validated['komunikasi'] ?? null,
            'interaksi_sosial'      => $validated['interaksi_sosial'] ?? null,
            'saran_rujukan'         => $this->prepareJsonData($validated['saran_rujukan_combined'] ?? ''),
            'prioritas_terapi'      => $this->prepareJsonData($validated['prioritas_terapi_combined'] ?? ''),

            // Penilaian Psikologis
            'skor_kognitif'         => $request->skor_kognitif,
            'skor_bahasa'           => $request->skor_bahasa,
            'skor_motorik'          => $request->skor_motorik,
            'skor_sosial_emosional' => $request->skor_sosial_emosional,
            'skor_perilaku_adaptif' => $request->skor_perilaku_adaptif,
            'skor_iq_total'         => $request->skor_iq_total,
            'klasifikasi'           => $request->klasifikasi,
            'interpretasi_skor'     => $request->interpretasi_skor,
            'status_bayar'          => 'Menunggu Pembayaran',
        ]);

        $this->syncAlatUkur($assessment, $request->alat_ukur);

        return redirect("/assessment")->with('success', "Data Assessment berhasil dibuat dan status diatur ke Menunggu Pembayaran");
    }

    public function edit(Assessment $assessment)
    {
        $user = Auth::user();
        $roles = $user->getRoleNames();
        $anaks = Anak::latest()->get();
        $psikologs = Psikolog::latest()->get();

        if ($roles->contains('psikolog')) {
            $psikologs = Psikolog::where('nama', $user->name)->first();
        }

        return view('assessment.edit', compact('assessment', 'anaks', 'psikologs', 'roles'));
    }

    public function update(Request $request, Assessment $assessment): RedirectResponse
    {
        $validated = $this->validateRequest($request);

        $assessment->update([
            'anak_id'               => $validated['anak_id'],
            'psikolog_id'           => $validated['psikolog_id'],
            'tanggal_assessment'    => $validated['tanggal_assessment'],
            'tujuan_pemeriksaan'    => $validated['tujuan_pemeriksaan'],
            'keluhan_utama'         => $validated['keluhan_utama'],
            'kesimpulan_observasi'  => $validated['kesimpulan_observasi'],
            'sumber_asesmen'        => $this->prepareJsonData($validated['sumber_asesmen_combined']),
            'observasi_awal'        => $this->prepareJsonData($validated['perilaku_combined']),
            'hasil_pemeriksaan'     => $this->prepareJsonData($validated['hasil_pemeriksaan_combined']),
            'diagnosa'              => $validated['diagnosa'],
            'diagnosa_banding'      => $validated['diagnosa_banding'] ?? null,
            'rekomendasi_orangtua'  => $this->prepareJsonData($validated['rekomendasi_orangtua_combined']),
            'rekomendasi_terapi'    => $this->prepareJsonData($validated['rekomendasi_terapi_combined']),
            'catatan_tambahan'      => $validated['catatan_tambahan'] ?? null,
            'persetujuan_psikolog'  => $validated['persetujuan_psikolog'] == '1',
            'alasan_tidak_setuju'   => $validated['persetujuan_psikolog'] == '1' ? null : ($validated['alasan_tidak_setuju'] ?? null),

            // New Clinical Fields
            'mood_anak'             => $validated['mood_anak'] ?? null,
            'validitas_hasil'       => $validated['validitas_hasil'] ?? null,
            'catatan_rapport'       => $validated['catatan_rapport'] ?? null,
            'kontak_mata'           => $validated['kontak_mata'] ?? null,
            'komunikasi'            => $validated['komunikasi'] ?? null,
            'interaksi_sosial'      => $validated['interaksi_sosial'] ?? null,
            'saran_rujukan'         => $this->prepareJsonData($validated['saran_rujukan_combined'] ?? ''),
            'prioritas_terapi'      => $this->prepareJsonData($validated['prioritas_terapi_combined'] ?? ''),

            // Penilaian Psikologis
            'skor_kognitif'         => $request->skor_kognitif,
            'skor_bahasa'           => $request->skor_bahasa,
            'skor_motorik'          => $request->skor_motorik,
            'skor_sosial_emosional' => $request->skor_sosial_emosional,
            'skor_perilaku_adaptif' => $request->skor_perilaku_adaptif,
            'skor_iq_total'         => $request->skor_iq_total,
            'klasifikasi'           => $request->klasifikasi,
            'interpretasi_skor'     => $request->interpretasi_skor,
        ]);

        $this->syncAlatUkur($assessment, $request->alat_ukur);

        return redirect("/assessment")->with('success', "Data Assessment berhasil di Update");
    }

    public function destroy(Assessment $assessment): RedirectResponse
    {
        if ($assessment->file_assessment) {
            Storage::disk('public')->delete('hasil-assessment/' . $assessment->file_assessment);
        }
        $assessment->delete();
        return redirect()->back()->with('success', "Data Assessment berhasil di Hapus");
    }

    public function cetak(Assessment $assessment)
    {
        $data = [
            'nama' => $assessment->anak->nama,
            'alamat' => $assessment->anak->alamat,
            'tanggal_lahir' => $assessment->anak->tanggal_lahir,
            'persetujuan_psikolog' => $assessment->persetujuan_psikolog,
            'alasan_tidak_setuju' => $assessment->alasan_tidak_setuju,
            'tanggal_assessment' => Carbon::parse($assessment->tanggal_assessment)->translatedFormat('d F Y')
        ];

        $scanUrl = url('/barcode/assessment/scan?data=' . urlencode(json_encode($data)));
        $dns2d = new DNS2D();
        $barcode = $dns2d->getBarcodePNG($scanUrl, 'QRCODE', 2, 2);

        $html = view('assessment.pdf', [
            'assessment' => $assessment,
            'observasi_awal' => $assessment->observasi_awal,
            'sumber_asesmen' => $assessment->sumber_asesmen,
            'hasil_pemeriksaan' => $assessment->hasil_pemeriksaan,
            'rekomendasi_orangtua' => $assessment->rekomendasi_orangtua,
            'rekomendasi_terapi' => $assessment->rekomendasi_terapi,
            'barcode' => $barcode
        ])->render();

        $mpdf = new Mpdf([
            'mode' => 'utf-8', 'format' => 'A4', 'default_font' => 'times'
        ]);

        $mpdf->SetHeader("RAHASIA||Halaman {PAGENO}");
        $mpdf->SetFooter("||Layanan Terapi Anak Spesial");
        $mpdf->WriteHTML($html);

        $filename = 'Hasil-Assessment-' . Str::slug($assessment->anak->nama) . '.pdf';
        return response($mpdf->Output($filename, \Mpdf\Output\Destination::STRING_RETURN), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }

    public function scanBarcode(Request $request)
    {
        $data = json_decode(urldecode($request->input('data')), true);
        return view('assessment.barcode_hasil', compact('data'));
    }

    protected function syncAlatUkur(Assessment $assessment, $alatUkurData)
    {
        if (is_array($alatUkurData)) {
            $syncData = [];
            foreach ($alatUkurData as $au) {
                if (!empty($au['nama'])) {
                    $alatUkurModel = \App\Models\AlatUkur::firstOrCreate(
                        ['nama' => $au['nama']],
                        ['domain' => 'lainnya', 'is_active' => true]
                    );

                    $syncData[$alatUkurModel->id] = [
                        'skor_raw'      => $au['skor_raw'] ?? null,
                        'skor_standar'  => $au['skor_standar'] ?? null,
                        'persentil'     => $au['skor_persentil'] ?? $au['persentil'] ?? null,
                        'klasifikasi'   => $au['klasifikasi'] ?? null,
                        'catatan'       => $au['catatan'] ?? null,
                        'is_manual'     => isset($au['is_manual']) ? (bool)$au['is_manual'] : true,
                    ];
                }
            }
            $assessment->alatUkurs()->sync($syncData);
        } else {
            $assessment->alatUkurs()->detach();
        }
    }

    protected function prepareJsonData(string $combinedData): array
    {
        if (empty($combinedData)) {
            return [];
        }
        $items = preg_split('/\n\n|\r\n|\r/', $combinedData);
        return array_values(array_filter(array_map('trim', $items)));
    }

    protected function validateRequest(Request $request)
    {
        return $request->validate([
            'anak_id' => 'required|exists:App\Models\Anak,id',
            'psikolog_id' => 'required|exists:App\Models\Psikolog,id',
            'tanggal_assessment' => 'required|date',
            'tujuan_pemeriksaan' => 'required|string',
            'keluhan_utama' => 'required|string',
            'kesimpulan_observasi' => 'required|string',
            'sumber_asesmen_combined' => 'required|string',
            'perilaku_combined' => 'required|string',
            'hasil_pemeriksaan_combined' => 'required|string',
            'diagnosa' => 'required|string',
            'diagnosa_banding' => 'nullable|string',
            'rekomendasi_orangtua_combined' => 'required|string',
            'rekomendasi_terapi_combined' => 'required|string',
            'catatan_tambahan' => 'nullable|string',
            'persetujuan_psikolog' => 'required|in:0,1',
            'alasan_tidak_setuju' => 'required_if:persetujuan_psikolog,0|nullable|string',
            'skor_kognitif' => 'nullable|integer',
            'skor_bahasa' => 'nullable|integer',
            'skor_motorik' => 'nullable|integer',
            'skor_sosial_emosional' => 'nullable|integer',
            'skor_perilaku_adaptif' => 'nullable|integer',
            'skor_iq_total' => 'nullable|integer',
            'alat_ukur' => 'nullable|array',
            
            // New Clinical Fields
            'mood_anak' => 'nullable|string',
            'validitas_hasil' => 'nullable|string',
            'catatan_rapport' => 'nullable|string',
            'kontak_mata' => 'nullable|string',
            'komunikasi' => 'nullable|string',
            'interaksi_sosial' => 'nullable|string',
            'saran_rujukan_combined' => 'nullable|string',
            'prioritas_terapi_combined' => 'nullable|string',
        ]);
    }
}

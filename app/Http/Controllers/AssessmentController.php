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

        if ($roles->contains('psikolog')) {
            $psikologs = Psikolog::where('nama', $user->name)->first();
            return view('assessment.create', compact('anaks', 'psikologs', 'roles'));
        } else {
            $psikologs = Psikolog::latest()->get();
            return view('assessment.create', compact('anaks', 'psikologs', 'roles'));
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
            'status_bayar'          => 'belum_bayar',
        ]);

        return redirect("/assessment")->with('success', "Data Assessment berhasil dibuat");
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
        ]);

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

        $profile = \App\Models\Profile::first();
        $primaryColor = $profile->warna_primer ?? '#ef4444';

        // Use static previous logo
        $logoPath = public_path('assets/website/images/logo.jpg');

        $logoBase64 = '';
        if (file_exists($logoPath)) {
            $logoData = base64_encode(file_get_contents($logoPath));
            $logoBase64 = 'data:image/jpeg;base64,' . $logoData;
        }

        $logoPjiPath = public_path('assets/website/images/pji-removebg-preview.png');
        $logoPjiBase64 = '';
        if (file_exists($logoPjiPath)) {
            $pjiData = base64_encode(file_get_contents($logoPjiPath));
            $logoPjiBase64 = 'data:image/png;base64,' . $pjiData;
        }

        $pdfData = [
            'assessment' => $assessment,
            'observasi_awal' => $assessment->observasi_awal,
            'sumber_asesmen' => $assessment->sumber_asesmen,
            'hasil_pemeriksaan' => $assessment->hasil_pemeriksaan,
            'rekomendasi_orangtua' => $assessment->rekomendasi_orangtua,
            'rekomendasi_terapi' => $assessment->rekomendasi_terapi,
            'barcode' => $barcode,
            'logo' => $logoBase64,
            'logo_pji' => $logoPjiBase64,
            'tanggal' => $assessment->tanggal_assessment
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('assessment.pdf', $pdfData);
        
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled'      => true,
            'defaultFont'          => 'sans-serif'
        ]);

        $filename = 'Hasil-Assessment-' . Str::slug($assessment->anak->nama) . '.pdf';
        return $pdf->stream($filename);
    }

    public function scanBarcode(Request $request)
    {
        $data = json_decode(urldecode($request->input('data')), true);
        return view('assessment.barcode_hasil', compact('data'));
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
            'keluhan_utama' => 'nullable|string',
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
            
            // New Clinical Fields
            'mood_anak' => 'nullable|string',
            'validitas_hasil' => 'nullable|string',
            'catatan_rapport' => 'nullable|string',
            'kontak_mata' => 'nullable|string',
            'komunikasi' => 'nullable|string',
            'interaksi_sosial' => 'nullable|string',
        ]);
    }
}

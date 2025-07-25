<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Assessment;
use App\Models\Psikolog;
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
            'anak_id' => $validated['anak_id'],
            'psikolog_id' => $validated['psikolog_id'],
            'tanggal_assessment' => $validated['tanggal_assessment'],
            'tujuan_pemeriksaan' => $validated['tujuan_pemeriksaan'],
            'sumber_asesmen' => $this->prepareJsonData($validated['sumber_asesmen_combined']),
            'observasi_awal' => $this->prepareJsonData($validated['perilaku_combined']),
            'hasil_pemeriksaan' => $this->prepareJsonData($validated['hasil_pemeriksaan_combined']),
            'diagnosa' => $validated['diagnosa'],
            'rekomendasi_orangtua' => $this->prepareJsonData($validated['rekomendasi_orangtua_combined']),
            'rekomendasi_terapi' => $this->prepareJsonData($validated['rekomendasi_terapi_combined']),
            'catatan_tambahan' => $validated['catatan_tambahan'] ?? null,
            'persetujuan_psikolog' => $validated['persetujuan_psikolog'] == '1',
            'alasan_tidak_setuju' => $validated['alasan_tidak_setuju'] ?? null,
        ]);

        Alert::success('Berhasil', "Data Assessment berhasil dibuat");
        return redirect("/assessment");
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
            'sumber_asesmen_combined' => 'required|string',
            'perilaku_combined' => 'required|string',
            'hasil_pemeriksaan_combined' => 'required|string',
            'diagnosa' => 'required|string',
            'rekomendasi_orangtua_combined' => 'required|string',
            'rekomendasi_terapi_combined' => 'required|string',
            'catatan_tambahan' => 'nullable|string',
            'persetujuan_psikolog' => 'required|in:0,1',
            'alasan_tidak_setuju' => 'required_if:persetujuan_psikolog,0|nullable|string',
        ]);
    }

    public function edit(Assessment $assessment)
    {
        $user = Auth::user();
        $roles = $user->getRoleNames();
        $anaks = Anak::latest()->get();
        $psikologs = Psikolog::latest()->get();
        return view('assessment.edit', compact('assessment', 'anaks', 'psikologs', 'roles'));
    }

    public function update(Request $request, Assessment $assessment): RedirectResponse
    {
        $validateData = $request->validate([
            'anak_id' => 'required|exists:App\Models\Anak,id',
            'psikolog_id' => 'required|exists:App\Models\Psikolog,id',
            'file_assessment' =>  'nullable|file|mimes:pdf|max:5120',
            'assessment_awal' => 'required|string',
            'tanggal_assessment' => 'required|date',
            'diagnosa' => 'nullable|string',
            'rekomendasi' => 'nullable|string',
            'catatan_tambahan' => 'nullable|string',
            'tindak_lanjut' => 'nullable|string',
        ]);

        $namaAnak = Anak::findorFail($request->anak_id);

        if ($request->hasFile('file_assessment')) {

            if ($assessment->file_assessment) {
                Storage::disk('public')->delete('hasil-assessment/' . $assessment->file_assessment);
            }

            $file = $request->file('file_assessment');
            $extFile = $file->getClientOriginalExtension();
            $namaFile =
                "hasil-assessment-" . $namaAnak->nama . "." . $extFile;
            $path = 'hasil-assessment/' . $namaFile;
            Storage::disk('public')->put($path, file_get_contents($file));
            $validateData['file_assessment'] = $namaFile;
        } else {
            $validatedData['file_assessment'] = $assessment->file_assessment;
        }

        $assessment->update($validateData);
        Alert::success('Berhasil', "Data Assessment berhasil di Update");
        return redirect("/assessment");
    }

    public function destroy(Assessment $assessment)
    {
        Storage::disk('public')->delete('hasil-assessment/' . $assessment->file_assessment);
        $assessment->delete();
        Alert::success('Berhasil', "Data Assessment berhasil di Hapus");
        return redirect()->back();
    }

    public function cetak(Assessment $assessment)
    {
        $observasi_awal = $assessment->observasi_awal;
        $sumber_asesmen = $assessment->sumber_asesmen;
        $hasil_pemeriksaan = $assessment->hasil_pemeriksaan;
        $rekomendasi_orangtua = $assessment->rekomendasi_orangtua;
        $rekomendasi_terapi = $assessment->rekomendasi_terapi;

        $data = [
            'nama' => $assessment->anak->nama,
            'alamat' => $assessment->anak->alamat,
            'tanggal_lahir' => $assessment->anak->tanggal_lahir,
            // 'signature' => $->signature_image_path, // path ke gambar tanda tangan
            'tanggal_assessment' => $assessment->tanggal_assessment
        ];

        $scanUrl = url('/barcode/assessment/scan?data=' . urlencode(json_encode($data)));

        $dns2d = new DNS2D();

        // Generate QR Code dengan data JSON
        $barcode = $dns2d->getBarcodePNG($scanUrl, 'QRCODE', 2, 2);

        $html = view('assessment.pdf', compact('assessment', 'observasi_awal', 'sumber_asesmen', 'hasil_pemeriksaan', 'rekomendasi_orangtua', 'rekomendasi_terapi', 'barcode'))->render();

        // Konfigurasi MPDF
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'times',
            'margin_top' => 8,
            'margin_bottom' => 10,
            'margin_left' => 15,
            'margin_right' => 15,
        ]);

        // Atur metadata dan header/footer
        $mpdf->SetTitle("Hasil Assessment - {$assessment->anak->nama}");
        $mpdf->SetAuthor(config('app.name'));
        $mpdf->SetCreator(config('app.name'));

        // $mpdf->SetHeader("RAHASIA||Halaman {PAGENO}");
        // $mpdf->SetFooter("||Layanan Terapi Anak Spesial");

        // Tambahkan HTML ke PDF
        $mpdf->WriteHTML($html);

        // Generate nama file
        $filename = 'Hasil-Assessment-' . Str::slug($assessment->anak->nama) . '.pdf';

        // Output PDF ke browser untuk preview
        return response($mpdf->Output($filename, \Mpdf\Output\Destination::STRING_RETURN), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
            'Cache-Control' => 'public, must-revalidate, max-age=0',
            'Pragma' => 'public',
        ]);
    }

    public function scanBarcode(Request $request)
    {
        // Ambil data dari URL (contoh: ?data={"child_name":"Budi",...})
        $scannedData = $request->input('data');

        // Decode data JSON
        $data = json_decode(urldecode($scannedData), true);

        // Tampilkan view hasil scan
        return view('assessment.barcode_hasil', compact('data'));
    }
}

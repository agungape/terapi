<?php

namespace App\Http\Controllers;

use App\Models\AgeGroup;
use App\Models\Anak;
use App\Models\HasilPemeriksaan;
use App\Models\HpPerilaku;
use App\Models\HpSensorik;
use App\Models\Observasi;
use App\Models\QuestionAutis;
use App\Models\QuestionGpph;
use App\Models\QuestionPenglihatan;
use App\Models\QuestionPerilaku;
use App\Models\QuestionResponse;
use App\Models\QuestionResponseAutis;
use App\Models\QuestionResponseGpph;
use App\Models\QuestionResponsePerilaku;
use App\Models\Terapis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;
use Mpdf\Mpdf;

class ObservasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view observasi', ['only' => ['index', 'observasi_mulai', 'observasi_atec']]);
    }


    public function index()
    {
        $anaks = Anak::latest()->paginate(10);
        return view('observasi.index', compact('anaks'));
    }

    public function show(Anak $anak)
    {
        $ageGroups = AgeGroup::with('questions')->get();
        // hitung umur
        $tanggalLahir = Carbon::parse($anak->tanggal_lahir);
        $sekarang = Carbon::now();
        // Hitung total bulan
        $bulan = $tanggalLahir->diffInMonths($sekarang);
        // Tambahkan jumlah bulan ke tanggal lahir untuk menghitung sisa harinya
        $tanggalSetelahBulan = $tanggalLahir->addMonthsNoOverflow($bulan);
        $hari = $tanggalSetelahBulan->diffInDays($sekarang);
        // Format hasil
        $umur = "{$bulan} bulan {$hari} hari";
        // hitung umur
        $hasil = $anak->hasilPemeriksaans; // relasi hasMany
        $hpperilaku = HpPerilaku::latest()->get(); // relasi hasMany
        $hpsensorik = HpSensorik::latest()->get(); // relasi hasMany
        $sesuaiUmur = "  Puji Keberhasilan Orangtua/Pengasuh. Lanjutkan Stimulasi Sesuai Umur. Jadwalkan Kunjungan Berikutnya";
        $penyimpangan = "RS Rujukan Tumbuh Kembang Level 1";
        $interPerilaku = "Kemungkinan anak mengalami masalah mental emosional";
        $penyimpanganPerilaku = "Konseling kepada orang tua jadwalkan kunjungan berikutnya 3 bulan lagi";
        $qpenglihatan = QuestionPenglihatan::get();
        $qperilaku = QuestionPerilaku::latest()->get();
        $qautis = QuestionAutis::orderBy('no_urut')->get();
        $qgpph = QuestionGpph::orderBy('created_at', 'ASC')->get();
        return view('observasi.show', compact('anak', 'hasil', 'umur', 'ageGroups', 'sesuaiUmur', 'penyimpangan', 'qpenglihatan', 'qperilaku', 'qautis', 'interPerilaku', 'penyimpanganPerilaku', 'qgpph', 'hpperilaku', 'hpsensorik'));
    }


    public function observasi_atec(Request $request)
    {
        $validateData = $request->validate([
            'anak_id' => 'required|exists:App\Models\Anak,id',
            'hasil' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // upload gambar hasil atec
        if ($request->file('hasil')) {
            $file = $request->file('hasil');
            $extFile = $file->getClientOriginalExtension();
            $namaFile =
                "gambar-" . time() . "." . $extFile;
            $path = 'atec/' . $namaFile;
            Storage::disk('public')->put($path, file_get_contents($file));
            $data['hasil'] = $namaFile;
        }


        $data['anak_id'] = $request->anak_id;
        $data['jenis'] = 'ATEC';

        $atec = HasilPemeriksaan::create($data);
        Alert::toast("data Observasi berhasil di Tambahkan", 'success');
        return redirect()->back();
    }

    public function observasi_pendengaran(Request $request)
    {
        $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'answers' => 'required|array',
        ]);

        $anakId = $request->input('anak_id');
        $answers = $request->input('answers');

        $isPenyimpangan = false;

        foreach ($answers as $questionId => $answer) {
            if ($answer === 'tidak') {
                $isPenyimpangan = true;
            }

            QuestionResponse::create([
                'anak_id' => $anakId,
                'question_id' => $questionId,
                'answer' => $answer,
            ]);
        }

        // Tentukan hasil akhir
        $hasil = $isPenyimpangan ? 'Penyimpangan' : 'Sesuai Umur';

        // Simpan ke tabel hasil pemeriksaan
        HasilPemeriksaan::create([
            'anak_id' => $anakId,
            'jenis' => 'Penyimpangan Pendengaran',
            'hasil' => $hasil,
        ]);

        Alert::toast("data Observasi Penngengaran berhasil di Tambahkan", 'success');
        return redirect()->back();
    }

    public function observasi_penglihatan(Request $request)
    {
        $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'hasil' => 'required|string',
        ]);

        $anakId = $request->input('anak_id');
        $hasilInput = strtolower($request->input('hasil'));

        // Konversi hasil sesuai ketentuan
        if ($hasilInput === 'normal') {
            $hasil = 'Normal';
        } elseif ($hasilInput === 'gangguan') {
            $hasil = 'Curiga Gangguan Penglihatan';
        } else {
            $hasil = $request->input('hasil'); // fallback jika bukan normal/gangguan
        }

        HasilPemeriksaan::create([
            'anak_id' => $anakId,
            'jenis' => 'Penyimpangan Penglihatan',
            'hasil' => $hasil,
        ]);


        Alert::toast("data Observasi Penglihatan berhasil di Tambahkan", 'success');
        return redirect()->back();
    }

    public function observasi_perilaku(Request $request)
    {
        $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'answers' => 'required|array',
        ]);

        $anakId = $request->input('anak_id');
        $answers = $request->input('answers');

        $isPenyimpangan = false;

        foreach ($answers as $questionId => $answer) {
            if ($answer === 'ya') {
                $isPenyimpangan = true;
            }

            QuestionResponsePerilaku::create([
                'anak_id' => $anakId,
                'question_perilaku_id' => $questionId,
                'answer' => $answer,
            ]);
        }

        // Tentukan hasil akhir
        $hasil = $isPenyimpangan ? 'Penyimpangan' : 'Normal';

        // Simpan ke tabel hasil pemeriksaan
        HasilPemeriksaan::create([
            'anak_id' => $anakId,
            'jenis' => 'Penyimpangan Perilaku',
            'hasil' => $hasil,
        ]);

        Alert::toast("data Observasi Perilaku berhasil di Tambahkan", 'success');
        return redirect()->back();
    }

    public function observasi_autis(Request $request)
    {
        $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'answers' => 'required|array',
        ]);

        $anakId = $request->input('anak_id');
        $answers = $request->input('answers');

        // Critical item berdasarkan no_urut
        $criticalNoUrut = [2, 7, 9, 13, 14, 15];

        // Ambil ID pertanyaan critical dari tabel question_autis
        $criticalQuestionIds = QuestionAutis::whereIn('no_urut', $criticalNoUrut)
            ->pluck('id')
            ->toArray();

        $jumlahTidak = 0;

        foreach ($answers as $questionId => $answer) {
            // Cek apakah pertanyaan ini termasuk critical dan jawabannya TIDAK
            if (in_array($questionId, $criticalQuestionIds) && strtolower($answer) === 'tidak') {
                $jumlahTidak++;
            }

            QuestionResponseAutis::create([
                'anak_id' => $anakId,
                'question_autis_id' => $questionId,
                'answer' => $answer,
            ]);
        }

        // Tentukan hasil akhir berdasarkan jumlah 'tidak' pada critical item
        $hasil = $jumlahTidak >= 2 ? 'Risiko Autisme' : 'Tidak Berisiko';

        // Simpan ke tabel hasil pemeriksaan
        HasilPemeriksaan::create([
            'anak_id' => $anakId,
            'jenis' => 'Autisme',
            'hasil' => $hasil,
        ]);

        Alert::toast("data Observasi Autism berhasil di Tambahkan", 'success');
        return redirect()->back();
    }

    public function observasi_gpph(Request $request)
    {
        $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'answers' => 'required|array',
        ]);

        $anakId = $request->anak_id;
        $answers = $request->answers;

        $totalScore = 0;

        foreach ($answers as $questionId => $value) {
            $score = (int)$value;
            $totalScore += $score;

            // Simpan setiap jawaban
            QuestionResponseGpph::create([
                'anak_id' => $anakId,
                'question_gpph_id' => $questionId,
                'answer' => $score,
            ]);
        }

        // Hitung hasil GPPH
        $hasil = $totalScore < 13 ? 'Normal' : 'Kemungkinan GPPH';

        HasilPemeriksaan::create([
            'anak_id' => $anakId,
            'jenis' => 'GPPH',
            'hasil' => $hasil,
        ]);

        Alert::toast("data Observasi GPPH berhasil di Tambahkan", 'success');
        return redirect()->back();
    }

    public function observasi_hpperilaku(Request $request)
    {
        $validateData =  $request->validate([
            'deskripsi' => 'required'
        ]);

        $hpperilaku = HpPerilaku::create($validateData);
        Alert::toast("data Observasi Perilaku berhasil di Tambahkan", 'success');
        return redirect()->back();
    }

    public function observasi_hpsensorik(Request $request)
    {
        $validateData =  $request->validate([
            'deskripsi' => 'required'
        ]);

        $hpperilaku = HpSensorik::create($validateData);
        Alert::toast("data Observasi Sensorik berhasil di Tambahkan", 'success');
        return redirect()->back();
    }


    public function cetakObservasi(Request $request)
    {

        $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'tanggal' => 'required|date',
        ]);

        $anak = Anak::findOrFail($request->anak_id);
        $tanggal = $request->tanggal;

        $hasil = HasilPemeriksaan::where('anak_id', $anak->id)
            ->whereDate('created_at', $tanggal)
            ->orderBy('jenis')
            ->get()
            ->groupBy('jenis');

        $penyimpangan_perilaku = "Deteksi dini penyimpangan perilaku dan emosional algoritma pemeriksaan KMPE ";
        $autis = "Deteksi dini Autis pada anak algoritma pemeriksaan M-CHAT";
        $gpph = "Deteksi dini gangguan pemusatan perhatian dan hiperaktif (GPPH) pada anak prasekolah algoritma pemeriksaan GPPH";


        $jumlahJawabanYaPerilaku = QuestionResponsePerilaku::where('anak_id', $anak->id)
            ->whereDate('created_at', $tanggal)
            ->where('answer', 'YA')
            ->count();

        $jumlahJawabanTidakAutis = QuestionResponseAutis::where('anak_id', $anak->id)
            ->whereDate('created_at', $tanggal) // filter tanggal observasi
            ->where('answer', 'TIDAK')
            ->count();

        $totalNilaiGpph = QuestionResponseGpph::where('anak_id', $anak->id)
            ->whereDate('created_at', $tanggal) // filter tanggal observasi
            ->sum('answer'); // jumlahkan nilai jawaban

        $html = view('observasi.pdf_hasil', compact(
            'anak',
            'hasil',
            'tanggal',
            'penyimpangan_perilaku',
            'autis',
            'gpph',
            'jumlahJawabanYaPerilaku',
            'jumlahJawabanTidakAutis',
            'totalNilaiGpph'
        ))->render();

        $mpdf = new Mpdf([
            'default_font' => 'times',
            'margin_top' => 30,
            'margin_bottom' => 25,
        ]);

        $mpdf->SetTitle("Laporan Observasi - {$anak->nama}");
        $mpdf->SetHeader("Laporan Observasi||Halaman {PAGENO}");
        $mpdf->SetFooter("||" . date('d-m-Y') . " | " . config('app.name'));
        $mpdf->WriteHTML($html);

        // Generate PDF
        $pdfContent = $mpdf->Output('', \Mpdf\Output\Destination::STRING_RETURN);

        $filename = 'Laporan-Observasi-' . $anak->nama . '.pdf';

        return response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }
}

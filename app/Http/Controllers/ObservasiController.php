<?php

namespace App\Http\Controllers;

use App\Models\AgeGroup;
use App\Models\Anak;
use App\Models\HasilPemeriksaan;
use App\Models\HpPerilaku;
use App\Models\HpSensorik;
use App\Models\QuestionAutis;
use App\Models\QuestionGpph;
use App\Models\QuestionPenglihatan;
use App\Models\QuestionPerilaku;
use App\Models\QuestionResponse;
use App\Models\QuestionResponseAutis;
use App\Models\QuestionResponseGpph;
use App\Models\QuestionResponsePerilaku;
use App\Models\QuestionResponseWawancara;
use App\Models\QuestionWawancara;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\RedirectResponse;
use Mpdf\Mpdf;
use Illuminate\Support\Str;

class ObservasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view observasi', ['only' => ['index', 'observasi_mulai', 'observasi_atec']]);
    }


    public function index()
    {
        $anaks = Anak::where('status', 'aktif')->latest()->paginate(10);
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
        $hpperilaku = HpPerilaku::where('anak_id', $anak->id)->get();
        $hpsensorik = HpSensorik::where('anak_id', $anak->id)->get();
        $sesuaiUmur = "  Puji Keberhasilan Orangtua/Pengasuh. Lanjutkan Stimulasi Sesuai Umur. Jadwalkan Kunjungan Berikutnya";
        $penyimpangan = "RS Rujukan Tumbuh Kembang Level 1";
        $interPerilaku = "Kemungkinan anak mengalami masalah mental emosional";
        $penyimpanganPerilaku = "Konseling kepada orang tua jadwalkan kunjungan berikutnya 3 bulan lagi";
        $qpenglihatan = QuestionPenglihatan::get();
        $qperilaku = QuestionPerilaku::latest()->get();
        $qautis = QuestionAutis::orderBy('no_urut')->get();
        $qgpph = QuestionGpph::orderBy('created_at', 'ASC')->get();
        $qwawancara = QuestionWawancara::all();
        return view('observasi.show', compact('anak', 'hasil', 'umur', 'ageGroups', 'sesuaiUmur', 'penyimpangan', 'qpenglihatan', 'qperilaku', 'qautis', 'interPerilaku', 'penyimpanganPerilaku', 'qgpph', 'hpperilaku', 'hpsensorik', 'qwawancara'));
    }

    public function detail(HasilPemeriksaan $hasil)
    {
        $anak = Anak::where('id', $hasil->anak_id)->first();
        $tanggalLahir = Carbon::parse($anak->tanggal_lahir);
        $sekarang = Carbon::now();
        $bulan = $tanggalLahir->diffInMonths($sekarang);
        $tanggalSetelahBulan = $tanggalLahir->addMonthsNoOverflow($bulan);
        $hari = $tanggalSetelahBulan->diffInDays($sekarang);
        $umur = "{$bulan} bulan {$hari} hari";

        if ($hasil->jenis == 'Penyimpangan Perilaku') {
            $qrperilaku = QuestionResponsePerilaku::where('anak_id', $hasil->anak_id)
                ->whereDate('created_at', $hasil->created_at->toDateString())
                // ->pluck('question_perilaku_id', 'answer');
                ->get();
            return view('observasi.hasil.perilaku', compact('anak', 'umur', 'qrperilaku'));
        }

        if ($hasil->jenis == 'Penyimpangan Pendengaran') {
            $qrpendengaran = QuestionResponse::where('anak_id', $hasil->anak_id)
                ->whereDate('created_at', $hasil->created_at->toDateString())
                ->get();
            return view('observasi.hasil.pendengaran', compact('anak', 'umur', 'qrpendengaran'));
        }

        if ($hasil->jenis == 'GPPH') {
            $qrgpph = QuestionResponseGpph::where('anak_id', $hasil->anak_id)
                ->whereDate('created_at', $hasil->created_at->toDateString())
                ->get();

            $total = QuestionResponseGpph::where('anak_id', $hasil->anak_id)
                ->whereDate('created_at', $hasil->created_at->toDateString())
                ->sum('answer');

            return view('observasi.hasil.gpph', compact('anak', 'umur', 'qrgpph', 'total'));
        }

        if ($hasil->jenis == 'Autisme') {
            $qrautis = QuestionResponseAutis::where('anak_id', $hasil->anak_id)
                ->whereDate('created_at', $hasil->created_at->toDateString())
                ->get();
            return view('observasi.hasil.autisme', compact('anak', 'umur', 'qrautis'));
        }

        if ($hasil->jenis == 'Wawancara') {
            $qrwawancara = QuestionResponseWawancara::where('anak_id', $hasil->anak_id)
                ->whereDate('created_at', $hasil->created_at->toDateString())
                ->get();
            return view('observasi.hasil.wawancara', compact('anak', 'umur', 'qrwawancara'));
        }
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

    public function observasi_wawancara(Request $request)
    {
        $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'answers' => 'required|array',
        ]);

        $anakId = $request->input('anak_id');
        $answers = $request->input('answers');

        foreach ($answers as $questionId => $answer) {

            QuestionResponseWawancara::create([
                'anak_id' => $anakId,
                'question_wawancara_id' => $questionId,
                'answer' => $answer,
            ]);
        }

        HasilPemeriksaan::create([
            'anak_id' => $anakId,
            'jenis' => 'Wawancara',
            'hasil' => 'Wawancara',
        ]);

        Alert::toast("data Observasi Wawancara berhasil di Tambahkan", 'success');
        return redirect()->back();
    }

    public function observasi_hpperilaku(Request $request)
    {
        $validateData =  $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'deskripsi' => 'required'
        ]);

        $hpperilaku = HpPerilaku::create($validateData);
        Alert::toast("data Observasi Perilaku berhasil di Tambahkan", 'success');
        return redirect()->back();
    }

    public function hpperilaku_update(Request $request, HpPerilaku $id): RedirectResponse
    {
        $validateData =  $request->validate([
            'deskripsi' => 'required'
        ]);

        $id->update($validateData);
        Alert::toast("data Observasi Perilaku berhasil di Perbarui", 'success');
        return redirect()->back();
    }

    public function observasi_hpsensorik(Request $request)
    {
        $validateData =  $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'deskripsi' => 'required'
        ]);

        $hpsensorik = HpSensorik::create($validateData);
        Alert::toast("data Observasi Sensorik berhasil di Tambahkan", 'success');
        return redirect()->back();
    }

    public function hpsensorik_update(Request $request, HpSensorik $id): RedirectResponse
    {
        $validateData =  $request->validate([
            'deskripsi' => 'required'
        ]);

        $id->update($validateData);
        Alert::toast("data Observasi Sensorik berhasil di Perbarui", 'success');
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

        // Ambil data hasil pemeriksaan
        $hasil = HasilPemeriksaan::where('anak_id', $anak->id)
            ->whereDate('created_at', $tanggal)
            ->orderBy('created_at')
            ->get()
            ->groupBy('jenis');
        $atec = HasilPemeriksaan::where('anak_id', $anak->id)
            ->where('jenis', 'ATEC')
            ->whereDate('created_at', $tanggal)
            ->first();

        $hpperilaku = HpPerilaku::where('anak_id', $anak->id)->whereDate('created_at', $tanggal)->first();
        $hpsensorik = HpSensorik::where('anak_id', $anak->id)->whereDate('created_at', $tanggal)->first();
        // Hitung jawaban untuk masing-masing tes
        $jumlahJawabanYaPerilaku = QuestionResponsePerilaku::where('anak_id', $anak->id)
            ->whereDate('created_at', $tanggal)
            ->where('answer', 'YA')
            ->count();

        $jumlahJawabanTidakAutis = QuestionResponseAutis::where('anak_id', $anak->id)
            ->whereDate('created_at', $tanggal)
            ->where('answer', 'TIDAK')
            ->count();

        $totalNilaiGpph = QuestionResponseGpph::where('anak_id', $anak->id)
            ->whereDate('created_at', $tanggal)
            ->sum('answer');

        // Siapkan data untuk view
        $data = [
            'anak' => $anak,
            'atec' => $atec,
            'hasil' => $hasil,
            'tanggal' => $tanggal,
            'penyimpangan_perilaku' => "Deteksi dini penyimpangan perilaku dan emosional algoritma pemeriksaan KMPE",
            'autis' => "Deteksi dini Autis pada anak algoritma pemeriksaan M-CHAT",
            'gpph' => "Deteksi dini gangguan pemusatan perhatian dan hiperaktif (GPPH) pada anak prasekolah algoritma pemeriksaan GPPH",
            'jumlahJawabanYaPerilaku' => $jumlahJawabanYaPerilaku,
            'jumlahJawabanTidakAutis' => $jumlahJawabanTidakAutis,
            'totalNilaiGpph' => $totalNilaiGpph,
            'hpperilaku' => $hpperilaku,
            'hpsensorik' => $hpsensorik,
        ];

        // Render view ke HTML
        $html = view('observasi.pdf_hasil', $data)->render();

        // Konfigurasi MPDF
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'times',
            'margin_top' => 18,
            'margin_bottom' => 18,
            'margin_left' => 15,
            'margin_right' => 15,
        ]);

        // Atur metadata dan header/footer
        $mpdf->SetTitle("Laporan Observasi - {$anak->nama}");
        $mpdf->SetAuthor(config('app.name'));
        $mpdf->SetCreator(config('app.name'));

        $mpdf->SetHeader("RAHASIA||Halaman {PAGENO}");
        $mpdf->SetFooter("||" . $request->tanggal . " | " . config('app.name'));

        // Tambahkan HTML ke PDF
        $mpdf->WriteHTML($html);

        // Generate nama file
        $filename = 'Laporan-Observasi-' . Str::slug($anak->nama) . '.pdf';

        // Output PDF ke browser untuk preview
        return response($mpdf->Output($filename, \Mpdf\Output\Destination::STRING_RETURN), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
            'Cache-Control' => 'public, must-revalidate, max-age=0',
            'Pragma' => 'public',
        ]);
    }
}

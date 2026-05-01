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
use App\Models\KpspKelompokUsia;
use App\Models\KpspPertanyaan;
use App\Models\KpspJawaban;
use App\Models\KpspHasil;
use App\Models\Anthropometri;
use App\Models\QuestionAtec;
use App\Models\QuestionResponseAtec;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\RedirectResponse;
use Mpdf\Mpdf;
use Illuminate\Support\Str;
use Milon\Barcode\DNS2D;

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
        $qperilaku = QuestionPerilaku::orderBy('created_at', 'ASC')->get();
        $qautis = QuestionAutis::orderBy('no_urut')->get();
        $qgpph = QuestionGpph::orderBy('created_at', 'ASC')->get();
        $qwawancara = QuestionWawancara::all();
        $qatec = QuestionAtec::orderBy('section')->orderBy('no_urut')->get();
        $kpspKelompokUsias = KpspKelompokUsia::with('pertanyaans')->orderBy('usia_bulan')->get();
        $anthropometris = Anthropometri::where('anak_id', $anak->id)->orderBy('tanggal_pengukuran', 'desc')->get();
        return view('observasi.show', compact('anak', 'hasil', 'umur', 'ageGroups', 'sesuaiUmur', 'penyimpangan', 'qpenglihatan', 'qperilaku', 'qautis', 'interPerilaku', 'penyimpanganPerilaku', 'qgpph', 'hpperilaku', 'hpsensorik', 'qwawancara', 'qatec', 'kpspKelompokUsias', 'anthropometris'));
    }

    public function destroy_hasil(Request $request, $id)
    {
        $jenis = $request->input('jenis_model');
        if ($jenis === 'HpPerilaku') {
            HpPerilaku::findOrFail($id)->delete();
        } elseif ($jenis === 'HpSensorik') {
            HpSensorik::findOrFail($id)->delete();
        } else {
            HasilPemeriksaan::findOrFail($id)->delete();
        }
        return back()->with('success', 'Data log pemeriksaan berhasil dihapus');
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

        if ($hasil->jenis == 'KPSP') {
            $kpspHasil = KpspHasil::where('anak_id', $hasil->anak_id)
                ->whereDate('tanggal_pemeriksaan', $hasil->created_at->toDateString())
                ->with('kelompokUsia')
                ->first();

            $kpspJawaban = KpspJawaban::with('pertanyaan')
                ->where('anak_id', $hasil->anak_id)
                ->where('kpsp_kelompok_usia_id', $kpspHasil->kpsp_kelompok_usia_id)
                ->whereDate('created_at', $hasil->created_at->toDateString())
                ->get();

            return view('observasi.hasil.kpsp', compact('anak', 'umur', 'kpspHasil', 'kpspJawaban'));
        }

        if ($hasil->jenis == 'ATEC Kuesioner') {
            $qratec = QuestionResponseAtec::where('anak_id', $hasil->anak_id)
                ->whereDate('created_at', $hasil->created_at->toDateString())
                ->get();
            
            // Calculate subscores
            $subskor = ['I' => 0, 'II' => 0, 'III' => 0, 'IV' => 0];
            $questions = QuestionAtec::whereIn('id', $qratec->pluck('question_atec_id'))->get()->keyBy('id');
            
            foreach ($qratec as $resp) {
                if(isset($questions[$resp->question_atec_id])) {
                    $sec = $questions[$resp->question_atec_id]->section;
                    $subskor[$sec] += $resp->answer;
                }
            }

            return view('observasi.hasil.atec', compact('anak', 'umur', 'qratec', 'subskor', 'hasil'));
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
        return redirect()->back()->with('success', "data Observasi berhasil di Tambahkan");
    }

    public function observasi_atec_digital(Request $request)
    {
        $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'answers' => 'required|array',
        ]);

        $anakId = $request->input('anak_id');
        $answers = $request->input('answers');
        
        $totalSkor = 0;
        $subskor = ['I' => 0, 'II' => 0, 'III' => 0, 'IV' => 0];

        // Dapatkan semua pertanyaan untuk pemetaan section
        $questions = QuestionAtec::whereIn('id', array_keys($answers))->get()->keyBy('id');

        foreach ($answers as $qId => $scoreStr) {
            $score = (int) $scoreStr;
            $totalSkor += $score;
            
            if (isset($questions[$qId])) {
                $section = $questions[$qId]->section;
                $subskor[$section] += $score;
            }

            QuestionResponseAtec::create([
                'anak_id' => $anakId,
                'question_atec_id' => $qId,
                'answer' => $score,
            ]);
        }

        $interpretasi = "I.Wicara: {$subskor['I']}, II.Sosial: {$subskor['II']}, III.Sensorik: {$subskor['III']}, IV.Fisik: {$subskor['IV']}. Total ATEC: {$totalSkor}. (Makin rendah makin baik).";

        HasilPemeriksaan::create([
            'anak_id' => $anakId,
            'jenis' => 'ATEC Kuesioner',
            'hasil' => 'Skor ' . $totalSkor,
            'total_skor' => $totalSkor,
            'interpretasi' => $interpretasi,
            'tanggal_pemeriksaan' => now()->toDateString(),
        ]);

        Alert::toast("Kuesioner ATEC berhasil disimpan", 'success');
        return redirect()->back()->with('success', "Kuesioner ATEC berhasil disimpan");
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
        $jumlahTidak = 0;

        foreach ($answers as $questionId => $answer) {
            if ($answer === 'tidak') {
                $isPenyimpangan = true;
                $jumlahTidak++;
            }

            QuestionResponse::create([
                'anak_id'     => $anakId,
                'question_id' => $questionId,
                'answer'      => $answer,
            ]);
        }

        $hasil = $isPenyimpangan ? 'Penyimpangan' : 'Sesuai Umur';
        $totalSoal = count($answers);

        HasilPemeriksaan::create([
            'anak_id'             => $anakId,
            'jenis'               => 'Penyimpangan Pendengaran',
            'hasil'               => $hasil,
            'total_skor'          => $jumlahTidak,                          // Jumlah jawaban TIDAK
            'interpretasi'        => $isPenyimpangan
                ? "$jumlahTidak dari $totalSoal pertanyaan dijawab TIDAK — indikasi penyimpangan pendengaran."
                : 'Semua pertanyaan dijawab YA — tidak ada indikasi penyimpangan pendengaran.',
            'tanggal_pemeriksaan' => now()->toDateString(),
        ]);

        Alert::toast("Data Observasi Pendengaran berhasil di Tambahkan", 'success');
        return redirect()->back()->with('success', "Data Observasi Pendengaran berhasil di Tambahkan");
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
        return redirect()->back()->with('success', "data Observasi Penglihatan berhasil di Tambahkan");
    }

    public function observasi_perilaku(Request $request)
    {
        $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'answers' => 'required|array',
        ]);

        $anakId  = $request->input('anak_id');
        $answers = $request->input('answers');

        $isPenyimpangan = false;
        $jumlahYa = 0;

        foreach ($answers as $questionId => $answer) {
            if ($answer === 'ya') {
                $jumlahYa++;
            }

            QuestionResponsePerilaku::create([
                'anak_id'              => $anakId,
                'question_perilaku_id' => $questionId,
                'answer'               => $answer,
            ]);
        }

        $isPenyimpangan = $jumlahYa >= 1; // Standard KMME: 1 atau lebih jawaban Ya berindikasi masalah
        // WAIT: user plan kata "≥2 jawaban Ya -> kemungkinan masalah". Oh wait. 
        // Let's re-read user plan: "Interpretasi: ≥2 jawaban "Ya" → kemungkinan masalah mental emosional → rujuk"
        // Wait, Kemenkes KMME standard: "Bila ada 1 atau lebih jawaban Ya, maka anak kemungkinan mengalami masalah mental emosional." But user plan literally says "≥2 jawaban "Ya" -> kemungkinan masalah mental emosional".
        // I will follow user plan explicitly:
        $isPenyimpangan = $jumlahYa >= 2;

        $totalSoal = count($answers);
        $hasil     = $isPenyimpangan ? 'Penyimpangan' : 'Normal';

        HasilPemeriksaan::create([
            'anak_id'             => $anakId,
            'jenis'               => 'Penyimpangan Perilaku',
            'hasil'               => $hasil,
            'total_skor'          => $jumlahYa,
            'interpretasi'        => $isPenyimpangan
                ? "$jumlahYa dari $totalSoal pertanyaan dijawab YA — kemungkinan masalah mental emosional (KMME)."
                : "Hanya $jumlahYa pertanyaan dijawab YA — tidak ada indikasi masalah mental emosional.",
            'tanggal_pemeriksaan' => now()->toDateString(),
        ]);

        Alert::toast("Data Observasi Perilaku berhasil di Tambahkan", 'success');
        return redirect()->back()->with('success', "Data Observasi Perilaku berhasil di Tambahkan");
    }

    public function observasi_autis(Request $request)
    {
        $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'answers' => 'required|array',
        ]);

        $anakId  = $request->input('anak_id');
        $answers = $request->input('answers');

        $criticalNoUrut   = [5, 7, 11, 12, 13];
        $criticalQuestionIds = QuestionAutis::whereIn('no_urut', $criticalNoUrut)->pluck('id')->toArray();

        $jumlahTidakCritical = 0;
        $totalTidak  = 0;

        foreach ($answers as $questionId => $answer) {
            if (in_array($questionId, $criticalQuestionIds) && strtolower($answer) === 'tidak') {
                $jumlahTidakCritical++;
            }
            if (strtolower($answer) === 'tidak') {
                $totalTidak++;
            }

            QuestionResponseAutis::create([
                'anak_id'          => $anakId,
                'question_autis_id' => $questionId,
                'answer'           => $answer,
            ]);
        }

        $hasil = ($jumlahTidakCritical >= 1 || $totalTidak >= 3) ? 'Risiko Autisme' : 'Tidak Berisiko';

        HasilPemeriksaan::create([
            'anak_id'             => $anakId,
            'jenis'               => 'Autisme',
            'hasil'               => $hasil,
            'total_skor'          => $totalTidak,
            'interpretasi'        => ($jumlahTidakCritical >= 1 || $totalTidak >= 3)
                ? "$jumlahTidakCritical critical item dijawab TIDAK, total $totalTidak TIDAK — Risiko autisme terdeteksi (CHAT)."
                : "Tidak ada critical item dijawab TIDAK, total $totalTidak TIDAK — Tidak berisiko autisme.",
            'tanggal_pemeriksaan' => now()->toDateString(),
        ]);

        Alert::toast("Data Observasi Autisme berhasil di Tambahkan", 'success');
        return redirect()->back()->with('success', "Data Observasi Autisme berhasil di Tambahkan");
    }

    public function observasi_gpph(Request $request)
    {
        $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'answers' => 'required|array',
        ]);

        $anakId     = $request->anak_id;
        $answers    = $request->answers;
        $totalScore = 0;

        foreach ($answers as $questionId => $value) {
            $score       = (int) $value;
            $totalScore += $score;

            QuestionResponseGpph::create([
                'anak_id'          => $anakId,
                'question_gpph_id' => $questionId,
                'answer'           => $score,
            ]);
        }

        $hasil = $totalScore < 13 ? 'Normal' : 'Kemungkinan GPPH';

        // FIX: Sebelumnya total_skor TIDAK disimpan — sekarang diperbaiki
        HasilPemeriksaan::create([
            'anak_id'             => $anakId,
            'jenis'               => 'GPPH',
            'hasil'               => $hasil,
            'total_skor'          => $totalScore,
            'interpretasi'        => $totalScore < 13
                ? "Total skor GPPH: $totalScore (< 13) — tidak ada indikasi GPPH."
                : "Total skor GPPH: $totalScore (≥ 13) — kemungkinan Gangguan Pemusatan Perhatian dan Hiperaktif.",
            'tanggal_pemeriksaan' => now()->toDateString(),
        ]);

        Alert::toast("Data Observasi GPPH berhasil di Tambahkan", 'success');
        return redirect()->back()->with('success', "Data Observasi GPPH berhasil di Tambahkan");
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
        return redirect()->back()->with('success', "data Observasi Wawancara berhasil di Tambahkan");
    }

    public function observasi_kpsp(Request $request)
    {
        $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'kpsp_kelompok_usia_id' => 'required|exists:kpsp_kelompok_usias,id',
            'answers' => 'required|array',
        ]);

        $anakId = $request->input('anak_id');
        $kelompokUsiaId = $request->input('kpsp_kelompok_usia_id');
        $answers = $request->input('answers');

        $totalYa = 0;
        $totalTidak = 0;

        foreach ($answers as $questionId => $answer) {
            if ($answer === 'ya') {
                $totalYa++;
            } else {
                $totalTidak++;
            }

            KpspJawaban::create([
                'anak_id' => $anakId,
                'kpsp_kelompok_usia_id' => $kelompokUsiaId,
                'kpsp_pertanyaan_id' => $questionId,
                'jawaban' => $answer,
            ]);
        }

        if ($totalYa >= 9) {
            $interpretasi = 'S';
            $hasilTeks = 'Sesuai';
            $deskripsi = "Perkembangan anak Sesuai dengan umur (S).";
        } elseif ($totalYa >= 7) {
            $interpretasi = 'M';
            $hasilTeks = 'Meragukan';
            $deskripsi = "Perkembangan anak Meragukan (M).";
        } else {
            $interpretasi = 'P';
            $hasilTeks = 'Penyimpangan';
            $deskripsi = "Kemungkinan ada Penyimpangan (P).";
        }

        KpspHasil::create([
            'anak_id' => $anakId,
            'kpsp_kelompok_usia_id' => $kelompokUsiaId,
            'tanggal_pemeriksaan' => now()->toDateString(),
            'total_ya' => $totalYa,
            'total_tidak' => $totalTidak,
            'interpretasi' => $interpretasi,
            'catatan' => $deskripsi,
        ]);

        HasilPemeriksaan::create([
            'anak_id' => $anakId,
            'jenis' => 'KPSP',
            'hasil' => $hasilTeks,
            'total_skor' => $totalYa,
            'interpretasi' => $deskripsi,
            'tanggal_pemeriksaan' => now()->toDateString(),
        ]);

        Alert::toast("Data Observasi KPSP berhasil di Tambahkan", 'success');
        return redirect()->back()->with('success', "Data Observasi KPSP berhasil di Tambahkan");
    }

    public function observasi_anthropometri(Request $request)
    {
        $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',
            'lingkar_kepala' => 'nullable|numeric',
            'lingkar_lengan_atas' => 'nullable|numeric',
            'status_bb_u' => 'nullable|string',
            'status_tb_u' => 'nullable|string',
            'status_bb_tb' => 'nullable|string',
            'status_lk_u' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        $anak = Anak::findOrFail($request->anak_id);
        $usia_bulan = Carbon::parse($anak->tanggal_lahir)->diffInMonths(now());

        Anthropometri::create([
            'anak_id' => $request->anak_id,
            'tanggal_pengukuran' => now()->toDateString(),
            'berat_badan' => $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'lingkar_kepala' => $request->lingkar_kepala,
            'lingkar_lengan_atas' => $request->lingkar_lengan_atas,
            'usia_bulan' => $usia_bulan,
            'status_bb_u' => $request->status_bb_u,
            'status_tb_u' => $request->status_tb_u,
            'status_bb_tb' => $request->status_bb_tb,
            'status_lk_u' => $request->status_lk_u,
            'catatan' => $request->catatan,
        ]);

        HasilPemeriksaan::create([
            'anak_id' => $request->anak_id,
            'jenis' => 'Anthropometri',
            'hasil' => 'Pemeriksaan Fisik',
            'interpretasi' => "BB: {$request->berat_badan}kg, TB: {$request->tinggi_badan}cm",
            'tanggal_pemeriksaan' => now()->toDateString(),
        ]);

        Alert::toast("Data Pertumbuhan Fisik (Anthropometri) berhasil disimpan", 'success');
        return redirect()->back()->with('success', "Data Pertumbuhan Fisik berhasil disimpan");
    }

    public function observasi_hpperilaku(Request $request)
    {
        $validateData =  $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'deskripsi' => 'required'
        ]);

        $hpperilaku = HpPerilaku::create($validateData);
        return redirect()->back()->with('success', "data Observasi Perilaku berhasil di Tambahkan");
    }

    public function hpperilaku_update(Request $request, HpPerilaku $id): RedirectResponse
    {
        $validateData =  $request->validate([
            'deskripsi' => 'required'
        ]);

        $id->update($validateData);
        return redirect()->back()->with('success', "data Observasi Perilaku berhasil di Perbarui");
    }

    public function observasi_hpsensorik(Request $request)
    {
        $validateData =  $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'deskripsi' => 'required'
        ]);

        $hpsensorik = HpSensorik::create($validateData);
        return redirect()->back()->with('success', "data Observasi Sensorik berhasil di Tambahkan");
    }

    public function hpsensorik_update(Request $request, HpSensorik $id): RedirectResponse
    {
        $validateData =  $request->validate([
            'deskripsi' => 'required'
        ]);

        $id->update($validateData);
        return redirect()->back()->with('success', "data Observasi Sensorik berhasil di Perbarui");
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
            ->whereIn('jenis', ['ATEC', 'ATEC Kuesioner'])
            ->whereDate('created_at', $tanggal)
            ->first();

        $wawancara = QuestionResponseWawancara::with('question_wawancara')
            ->where('anak_id', $anak->id)
            ->whereDate('created_at', $tanggal)
            ->whereNotNull('answer')
            ->where('answer', '!=', '')
            ->get();
        $jumlahPertanyaanPendengaran = QuestionResponse::where('anak_id', $anak->id)
            ->whereDate('created_at', $tanggal)
            ->count();

        $jumlahJawabanTidakPendengaran = QuestionResponse::where('anak_id', $anak->id)
            ->whereDate('created_at', $tanggal)
            ->where('answer', 'tidak')
            ->count();

        $jawabanPenglihatan = HasilPemeriksaan::where('anak_id', $anak->id)
            ->whereDate('created_at', $tanggal)
            ->where('jenis', 'Penyimpangan Penglihatan')
            ->first();

        $hpperilaku = HpPerilaku::where('anak_id', $anak->id)->whereDate('created_at', $tanggal)->first();
        $hpsensorik = HpSensorik::where('anak_id', $anak->id)->whereDate('created_at', $tanggal)->first();
        // Hitung jawaban untuk masing-masing tes
        $jumlahJawabanYaPerilaku = QuestionResponsePerilaku::where('anak_id', $anak->id)
            ->whereDate('created_at', $tanggal)
            ->where('answer', 'YA')
            ->count();


        $criticalNoUrut = [2, 7, 9, 13, 14, 15];

        $jumlahJawabanTidakAutis = QuestionResponseAutis::with(['question_autis'])
            ->where('anak_id', $anak->id)
            ->whereDate('created_at', $tanggal)
            ->where('answer', 'TIDAK')
            ->whereHas('question_autis', function ($query) use ($criticalNoUrut) {
                $query->whereIn('no_urut', $criticalNoUrut);
            })
            ->count();

        $totalNilaiGpph = QuestionResponseGpph::where('anak_id', $anak->id)
            ->whereDate('created_at', $tanggal)
            ->sum('answer');

        // Data yang akan diencode dalam barcode
        $data = [
            'nama' => $anak->nama,
            'alamat' => $anak->alamat,
            'tanggal_lahir' => $anak->tanggal_lahir,
            // 'signature' => $->signature_image_path, // path ke gambar tanda tangan
            'tanggal_observasi' => $request->tanggal
        ];

        $scanUrl = url('/barcode/scan?data=' . urlencode(json_encode($data)));

        $dns2d = new DNS2D();

        // Generate QR Code dengan data JSON
        $barcode = $dns2d->getBarcodePNG($scanUrl, 'QRCODE', 2, 2);

        $anthropometris = Anthropometri::where('anak_id', $anak->id)->whereDate('created_at', $tanggal)->get();
        $kpsp = HasilPemeriksaan::where('anak_id', $anak->id)->where('jenis', 'KPSP')->whereDate('created_at', $tanggal)->first();

        // Encode logo ke Base64 agar pasti terbaca oleh DomPDF
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
            $logoPjiBase64 = 'data:image/jpeg;base64,' . $pjiData;
        }

        // Siapkan data untuk view
        $data = [
            'anak' => $anak,
            'barcode' => $barcode,
            'logo' => $logoBase64,
            'logo_pji' => $logoPjiBase64,
            'atec' => $atec,
            'hasil' => $hasil,
            'tanggal' => $tanggal,
            'penyimpangan_perilaku' => "Kuesioner Masalah Mental Emosional (KMME)",
            'penyimpangan_pendengaran' => "Tes Daya Dengar (TDD)",
            'penyimpangan_penglihatan' => "Tes Daya Lihat (TDL)",
            'autis' => "Checklist for Autism in Toddlers (CHAT)",
            'gpph' => "Gangguan Pemusatan Perhatian dan Hiperaktif (GPPH)",
            'jumlahJawabanYaPerilaku' => $jumlahJawabanYaPerilaku,
            'jumlahJawabanTidakAutis' => $jumlahJawabanTidakAutis,
            'jumlahPertanyaanPendengaran' => $jumlahPertanyaanPendengaran,
            'jumlahJawabanTidakPendengaran' => $jumlahJawabanTidakPendengaran,
            'jawabanPenglihatan' => $jawabanPenglihatan,
            'totalNilaiGpph' => $totalNilaiGpph,
            'hpperilaku' => $hpperilaku,
            'hpsensorik' => $hpsensorik,
            'wawancara' => $wawancara,
            'anthropometris' => $anthropometris,
            'kpsp' => $kpsp
        ];

        // Render view ke HTML
        $html = view('observasi.pdf_hasil', $data)->render();

        // Gunakan DomPDF (barryvdh/laravel-dompdf)
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('observasi.pdf_hasil', $data);

        // Konfigurasi DomPDF
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled'      => true,
            'defaultFont'          => 'sans-serif'
        ]);

        $filename = 'Laporan-Observasi-' . \Illuminate\Support\Str::slug($anak->nama) . '.pdf';

        return $pdf->stream($filename);
    }

    public function scanBarcode(Request $request)
    {
        // Ambil data dari URL (contoh: ?data={"child_name":"Budi",...})
        $scannedData = $request->input('data');

        // Decode data JSON
        $data = json_decode(urldecode($scannedData), true);

        // Tampilkan view hasil scan
        return view('observasi.barcode_hasil', compact('data'));
    }

    public function update_anthropometri(Request $request, $id)
    {
        $anthropometri = Anthropometri::findOrFail($id);
        $anthropometri->update($request->all());

        return redirect()->back()->with('success', 'Data Anthropometri berhasil diperbarui');
    }

    public function hapus_anthropometri($id)
    {
        $anthropometri = Anthropometri::findOrFail($id);
        $anthropometri->delete();

        return redirect()->back()->with('success', 'Data Anthropometri berhasil dihapus');
    }
}

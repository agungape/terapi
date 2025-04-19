<?php

namespace App\Http\Controllers;

use App\Models\AgeGroup;
use App\Models\Anak;
use App\Models\HasilPemeriksaan;
use App\Models\Observasi;
use App\Models\QuestionAutis;
use App\Models\QuestionPenglihatan;
use App\Models\QuestionPerilaku;
use App\Models\QuestionResponse;
use App\Models\QuestionResponseAutis;
use App\Models\QuestionResponsePerilaku;
use App\Models\Terapis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ObservasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view observasi', ['only' => ['index', 'observasi_mulai', 'observasi_atec']]);
    }


    public function index()
    {
        $observasi = Observasi::latest()->paginate(4);
        $jenis = [
            'wawancara' => 'Wawancara',
            'atec' => 'Atec',
            'penyimpangan pendengaran' => 'Deteksi Dini Penyimpangan Pendengaran'
        ];
        $anaks = Anak::latest()->paginate(10);
        $terapis = Terapis::all();
        return view('observasi.index', compact('anaks', 'terapis', 'jenis', 'observasi'));
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
        $sesuaiUmur = "  Puji Keberhasilan Orangtua/Pengasuh. Lanjutkan Stimulasi Sesuai Umur. Jadwalkan Kunjungan Berikutnya";
        $penyimpangan = "RS Rujukan Tumbuh Kembang Level 1";
        $interPerilaku = "Kemungkinan anak mengalami masalah mental emosional";
        $penyimpanganPerilaku = "Konseling kepada orang tua jadwalkan kunjungan berikutnya 3 bulan lagi";
        $qpenglihatan = QuestionPenglihatan::get();
        $qperilaku = QuestionPerilaku::latest()->get();
        $qautis = QuestionAutis::orderBy('no_urut')->get();
        return view('observasi.show', compact('anak', 'hasil', 'umur', 'ageGroups', 'sesuaiUmur', 'penyimpangan', 'qpenglihatan', 'qperilaku', 'qautis', 'interPerilaku', 'penyimpanganPerilaku'));
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
            'jenis' => 'penyimpangan pendengaran',
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
            'jenis' => 'penyimpangan penglihatan',
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

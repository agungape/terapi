<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Assessment;
use App\Models\Kategori;
use App\Models\Kunjungan;
use App\Models\Pemasukkan;
use App\Models\Pengeluaran;
use App\Models\SaldoKas;
use App\Models\Tarif;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use Mpdf\Mpdf;

class KeuanganController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view rekapan kas', ['only' => ['rekap', 'pemasukkan_json', 'pengeluaran_json']]);
        $this->middleware('permission:view kategori', ['only' => ['kategori', 'kategori_store', 'kategori_destroy']]);
        $this->middleware('permission:create kategori', ['only' => ['kategori_store']]);
        $this->middleware('permission:delete kategori', ['only' => ['kategori_destroy']]);
        $this->middleware('permission:view pemasukkan', ['only' => ['pemasukkan', 'getLogPemakaian']]);
        $this->middleware('permission:create pemasukkan', ['only' => ['pemasukkan_store']]);
        $this->middleware('permission:delete pemasukkan', ['only' => ['pemasukkan_destroy']]);
        $this->middleware('permission:view pengeluaran', ['only' => ['pengeluaran']]);
        $this->middleware('permission:create pengeluaran', ['only' => ['pengeluaran_store']]);
        $this->middleware('permission:delete pengeluaran', ['only' => ['pengeluaran_destroy']]);
        $this->middleware('permission:view laporan keuangan', ['only' => ['laporan_keuangan', 'laporan_pdf']]);
    }

    public function pemasukkan_json()
    {
        $pemasukkan = Pemasukkan::with(['kategori', 'anak', 'tarif'])->select('pemasukkans.*');
        return DataTables::of($pemasukkan)
            ->addColumn('kategori_nama', fn($row) => $row->kategori ? $row->kategori->nama : '-')
            ->addColumn('anak_nama', fn($row) => $row->anak ? $row->anak->nama : '-')
            ->make(true);
    }

    public function pengeluaran_json()
    {
        $pengeluaran = Pengeluaran::with('kategori')->select('pengeluarans.*');
        return DataTables::of($pengeluaran)
            ->addColumn('kategori_nama', fn($row) => $row->kategori ? $row->kategori->nama : '-')
            ->make(true);
    }

    public function rekap(Request $request)
    {
        $selectedYear = $request->input('year', date('Y'));

        $years_pemasukkan = Pemasukkan::selectRaw('YEAR(tanggal) as year')
            ->groupBy('year')->pluck('year');

        $years_pengeluaran = Pengeluaran::selectRaw('YEAR(tanggal) as year')
            ->groupBy('year')->pluck('year');

        $data_pemasukkan = Pemasukkan::selectRaw('MONTH(tanggal) as month, SUM(jumlah) as total')
            ->whereYear('tanggal', $selectedYear)
            ->groupBy('month')->orderBy('month')->get();

        $data_pengeluaran = Pengeluaran::selectRaw('MONTH(tanggal) as month, SUM(jumlah) as total')
            ->whereYear('tanggal', $selectedYear)
            ->groupBy('month')->orderBy('month')->get();

        if ($request->ajax()) {
            return response()->json([
                'incomeData'  => $data_pemasukkan,
                'expenseData' => $data_pengeluaran,
            ]);
        }

        $saldoKas        = SaldoKas::first();
        $totalPemasukan  = Pemasukkan::getTotalPemasukan();
        $formattedPemasukan = number_format($totalPemasukan, 0, ',', '.');
        $totalPengeluaran   = Pengeluaran::getTotalPengeluaran();
        $formattedPengeluaran = number_format($totalPengeluaran, 0, ',', '.');

        return view('keuangan.rekapkas', compact(
            'saldoKas', 'selectedYear', 'years_pemasukkan', 'years_pengeluaran',
            'formattedPemasukan', 'formattedPengeluaran', 'data_pemasukkan', 'data_pengeluaran'
        ));
    }

    public function kategori()
    {
        $jenis    = ['Pemasukkan' => 'Pemasukkan', 'Pengeluaran' => 'Pengeluaran'];
        $kategoris = Kategori::latest()->paginate(10);
        return view('keuangan.kategori', compact('kategoris', 'jenis'));
    }

    public function kategori_store(Request $request)
    {
        $validateData = $request->validate(['nama' => 'required', 'jenis' => 'required']);
        Kategori::create($validateData);
        return redirect()->back()->with('success', "Data kategori $request->nama berhasil dibuat");
    }

    public function kategori_destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->back()->with('success', "Kategori telah di hapus");
    }

    // ======================================================
    // ENDPOINT AJAX: Ambil layanan tersedia untuk anak tertentu
    // ======================================================

    /**
     * GET /pemasukkan/layanan/{anak_id}
     * Digunakan oleh form pemasukkan via AJAX untuk mengisi dropdown layanan.
     */
    public function getLayananByAnak(Request $request)
    {
        $request->validate(['anak_id' => 'required|exists:anaks,id']);
        $anakId = $request->anak_id;

        // 1. Ambil paket yang SUDAH DIBELI (untuk info sisa sesi)
        $pemasukkans = Pemasukkan::with('tarif')
            ->where('anak_id', $anakId)
            ->where('jenis_layanan', 'paket_terapi')
            ->whereNotNull('tarif_id')
            ->orderBy('id', 'asc')
            ->get();

        $paketTerbeli = $pemasukkans->map(function ($p) {
            return [
                'id'                => $p->tarif_id,
                'pemasukkan_id'     => $p->id,
                'nama'              => '[SUDAH DIBELI] ' . ($p->tarif->nama ?? 'Paket'),
                'tarif'             => 0, // Sudah bayar
                'jumlah_pertemuan'  => $p->tarif->jumlah_pertemuan ?? 20,
                'sisa'              => $p->sisa_pertemuan,
                'jenis_terapi'      => $p->tarif->jenis_terapi ?? '',
                'type'              => 'terbeli'
            ];
        });

        // 2. Ambil SEMUA PAKET TERSEDIA (untuk pembelian baru)
        $paketTersedia = Tarif::where('is_active', true)->get()->map(function($t) {
            return [
                'id'                => $t->id,
                'nama'              => '[BELI BARU] ' . $t->nama,
                'tarif'             => $t->getRawOriginal('tarif'),
                'jumlah_pertemuan'  => $t->jumlah_pertemuan,
                'type'              => 'baru'
            ];
        });

        // 3. Ambil assessment yang belum lunas
        $assessments = Assessment::where('anak_id', $anakId)
            ->where('status_bayar', 'belum_bayar')
            ->get()
            ->map(fn($a) => [
                'id'           => $a->id,
                'label'        => 'Assessment - ' . ($a->tanggal_assessment?->format('d/m/Y') ?? 'Tanpa Tanggal'),
                'tujuan'       => $a->tujuan_pemeriksaan,
                'tarif'        => 0, // Manual input for assessment usually
            ]);

        return response()->json([
            'paket_terbeli'  => $paketTerbeli,
            'paket_tersedia' => $paketTersedia,
            'assessments'    => $assessments,
        ]);
    }

    // ======================================================
    // PEMASUKKAN
    // ======================================================

    public function pemasukkan()
    {
        $saldoKas     = SaldoKas::first();
        $anaks        = Anak::where('status', 'aktif')->get();
        $kategori     = Kategori::firstOrCreate(
            ['nama' => 'Pembayaran Anak'],
            ['jenis' => 'Pemasukkan']
        );
        $kategoris    = Kategori::where('nama', '!=', 'Pembayaran Anak')->where('jenis', '!=', 'Pengeluaran')->get();
        $pemasukkans  = Pemasukkan::with(['anak', 'tarif', 'kategori'])->orderBy('tanggal', 'DESC')->paginate(10);
        $tarif        = Tarif::where('is_active', true)->latest()->get();
        $dataTerakhir = Pemasukkan::latest('updated_at')->first();
        $totalPemasukan = Pemasukkan::getTotalPemasukan();
        $formattedPemasukan = number_format($totalPemasukan, 0, ',', '.');

        return view('keuangan.pemasukkan', compact(
            'pemasukkans', 'kategori', 'kategoris', 'anaks',
            'saldoKas', 'dataTerakhir', 'formattedPemasukan', 'tarif'
        ));
    }

    public function pemasukkan_store(Request $request)
    {
        $validateData = $request->validate([
            'tanggal'        => 'required|date',
            'deskripsi'      => 'required',
            'kategori_id'    => 'required|exists:App\Models\Kategori,id',
            'tarif_id'       => 'nullable|exists:App\Models\Tarif,id',
            'anak_id'        => 'nullable|exists:App\Models\Anak,id',
            'assessment_id'  => 'nullable|exists:App\Models\Assessment,id',
            'jenis_layanan'  => 'nullable|in:assessment,paket_terapi,lainnya',
            'metode_bayar'   => 'nullable|in:tunai,transfer',
            'sesi_dibayar'   => 'nullable|integer',
            'jumlah'         => 'required',
            'gambar'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Bersihkan format ribuan dari jumlah
        $jumlahBersih = (int) str_replace('.', '', $request->jumlah);

        // Ambil saldo kas
        $saldo    = SaldoKas::latest()->first();
        $saldoAwal = $saldo ? (int) $saldo->getRawOriginal('saldo_awal') : 0;

        // Hitung saldo akhir
        $saldoAkhir = $saldoAwal + $jumlahBersih;

        // Upload bukti transfer (jika ada)
        $namaFile = null;
        if ($request->file('gambar')) {
            $file      = $request->file('gambar');
            $extFile   = $file->getClientOriginalExtension();
            $namaFile  = "gambar-" . time() . "." . $extFile;
            Storage::disk('public')->put('bukti-transfer/' . $namaFile, file_get_contents($file));
        }

        // Simpan atau update saldo kas
        if (!$saldo) {
            SaldoKas::create(['saldo_awal' => $saldoAkhir]);
        } else {
            $saldo->update(['saldo_awal' => $saldoAkhir]);
        }

        // Simpan pemasukkan
        $pemasukkan = Pemasukkan::create([
            'tanggal'       => $request->tanggal,
            'tarif_id'      => $request->tarif_id,
            'deskripsi'     => $request->deskripsi,
            'kategori_id'   => $request->kategori_id,
            'anak_id'       => $request->anak_id,
            'assessment_id' => $request->assessment_id,
            'jenis_layanan' => $request->jenis_layanan,
            'metode_bayar'  => $request->metode_bayar,
            'sesi_dibayar'  => $request->sesi_dibayar,
            'jumlah'        => $jumlahBersih,
            'saldo_akhir'   => $saldoAkhir,
            'gambar'        => $namaFile,
        ]);

        // Jika pembayaran untuk assessment, update status_bayar assessment
        if ($request->assessment_id && $request->jenis_layanan === 'assessment') {
            Assessment::where('id', $request->assessment_id)
                ->update(['status_bayar' => 'lunas']);
        }

        return redirect()->back()->with('success', "Data Pemasukkan berhasil di Tambahkan");
    }

    public function pemasukkan_destroy(Pemasukkan $pemasukkan)
    {
        $saldoKas = SaldoKas::latest()->first();

        // FIX: Gunakan getRawOriginal() agar tidak perlu parse string "Rp"
        $saldoAwal   = (int) $saldoKas->getRawOriginal('saldo_awal');
        $jumlahBayar = (int) $pemasukkan->getRawOriginal('jumlah');
        $saldoBaru   = $saldoAwal - $jumlahBayar;

        $saldoKas->update(['saldo_awal' => $saldoBaru]);

        // Revert status_bayar assessment jika ada
        if ($pemasukkan->assessment_id) {
            Assessment::where('id', $pemasukkan->assessment_id)
                ->update(['status_bayar' => 'belum_bayar']);
        }

        $pemasukkan->delete();

        if ($pemasukkan->gambar) {
            Storage::delete('public/bukti-transfer/' . $pemasukkan->gambar);
        }

        return redirect()->back()->with('success', "Data pemasukkan telah di hapus");
    }

    // ======================================================
    // PENGELUARAN
    // ======================================================

    public function pengeluaran()
    {
        $saldoKas       = SaldoKas::first();
        $kategoris      = Kategori::where('jenis', '!=', 'Pemasukkan')->get();
        $pengeluarans   = Pengeluaran::latest()->paginate(10);
        $dataTerakhir   = Pengeluaran::latest('updated_at')->first();
        $totalPengeluaran = Pengeluaran::getTotalPengeluaran();
        $formattedPengeluaran = number_format($totalPengeluaran, 0, ',', '.');
        return view('keuangan.pengeluaran', compact('pengeluarans', 'kategoris', 'saldoKas', 'dataTerakhir', 'formattedPengeluaran'));
    }

    public function pengeluaran_store(Request $request)
    {
        $request->validate([
            'tanggal'     => 'required|date',
            'deskripsi'   => 'required',
            'kategori_id' => 'required|exists:App\Models\Kategori,id',
            'jumlah'      => 'required',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $jumlahBersih = (int) str_replace('.', '', $request->jumlah);

        $saldo    = SaldoKas::latest()->first();
        $saldoAwal = $saldo ? (int) $saldo->getRawOriginal('saldo_awal') : 0;
        $saldoAkhir = $saldoAwal - $jumlahBersih;

        $namaFile = null;
        if ($request->file('gambar')) {
            $file     = $request->file('gambar');
            $extFile  = $file->getClientOriginalExtension();
            $namaFile = "gambar-" . time() . "." . $extFile;
            Storage::disk('public')->put('sturk-bayar/' . $namaFile, file_get_contents($file));
        }

        $saldo->update(['saldo_awal' => $saldoAkhir]);

        Pengeluaran::create([
            'tanggal'     => $request->tanggal,
            'deskripsi'   => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'jumlah'      => $jumlahBersih,
            'saldo_akhir' => $saldoAkhir,
            'gambar'      => $namaFile,
        ]);

        return redirect()->back()->with('success', "Data Pengeluaran berhasil di Tambahkan");
    }

    public function pengeluaran_destroy(Pengeluaran $pengeluaran)
    {
        $saldoKas    = SaldoKas::latest()->first();
        // FIX: Gunakan getRawOriginal() agar tidak perlu parse string "Rp"
        $saldoAwal   = (int) $saldoKas->getRawOriginal('saldo_awal');
        $jumlahBayar = (int) $pengeluaran->getRawOriginal('jumlah');
        $saldoBaru   = $saldoAwal + $jumlahBayar;

        $saldoKas->update(['saldo_awal' => $saldoBaru]);
        $pengeluaran->delete();

        if ($pengeluaran->gambar) {
            Storage::delete('public/bukti-transfer/' . $pengeluaran->gambar);
        }

        return redirect()->back()->with('success', "Data pengeluaran telah di hapus");
    }

    // ======================================================
    // LAPORAN KEUANGAN
    // ======================================================

    public function laporan_keuangan(Request $request)
    {
        $dateRange = $request->input('date_range');

        if ($dateRange) {
            $dates = explode(' - ', $dateRange);
            if (count($dates) == 2) {
                $startDate = $dates[0];
                $endDate   = $dates[1];
            } else {
                $startDate = now()->startOfMonth()->toDateString();
                $endDate   = now()->endOfMonth()->toDateString();
            }
        } else {
            $startDate = now()->startOfMonth()->toDateString();
            $endDate   = now()->endOfMonth()->toDateString();
        }

        // Hitung Saldo Awal sebelum StartDate
        $systemInitialBalance = SaldoKas::first()->saldo_awal ?? 0;
        $incomeBefore = DB::table('pemasukkans')->where('tanggal', '<', $startDate)->sum('jumlah');
        $expenseBefore = DB::table('pengeluarans')->where('tanggal', '<', $startDate)->sum('jumlah');
        $openingBalance = $systemInitialBalance + $incomeBefore - $expenseBefore;

        $financialReport = DB::table('pemasukkans')
            ->select('tanggal', DB::raw('"pemasukkan" as jenis'), 'jumlah', 'deskripsi', 'created_at')
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->unionAll(
                DB::table('pengeluarans')
                    ->select('tanggal', DB::raw('"pengeluaran" as jenis'), 'jumlah', 'deskripsi', 'created_at')
                    ->whereBetween('tanggal', [$startDate, $endDate])
            )
            ->orderBy('tanggal')
            ->orderBy('created_at')
            ->get();

        $currentBalance = $openingBalance;
        $financialReport = $financialReport->map(function ($item) use (&$currentBalance) {
            if ($item->jenis === 'pemasukkan') {
                $currentBalance += $item->jumlah;
            } elseif ($item->jenis === 'pengeluaran') {
                $currentBalance -= $item->jumlah;
            }
            $item->current_balance = $currentBalance;
            return $item;
        });

        return view('keuangan.laporan', compact('financialReport', 'startDate', 'endDate', 'openingBalance'));
    }

    public function laporan_pdf(Request $request, $startDate, $endDate)
    {
        // Hitung Saldo Awal sebelum StartDate
        $systemInitialBalance = SaldoKas::first()->saldo_awal ?? 0;
        $incomeBefore = DB::table('pemasukkans')->where('tanggal', '<', $startDate)->sum('jumlah');
        $expenseBefore = DB::table('pengeluarans')->where('tanggal', '<', $startDate)->sum('jumlah');
        $openingBalance = $systemInitialBalance + $incomeBefore - $expenseBefore;

        $financialReport = DB::table('pemasukkans')
            ->select('tanggal', DB::raw('"pemasukkan" as jenis'), 'jumlah', 'deskripsi', 'created_at')
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->unionAll(
                DB::table('pengeluarans')
                    ->select('tanggal', DB::raw('"pengeluaran" as jenis'), 'jumlah', 'deskripsi', 'created_at')
                    ->whereBetween('tanggal', [$startDate, $endDate])
            )
            ->orderBy('tanggal')
            ->orderBy('created_at')
            ->get();

        $currentBalance = $openingBalance;
        $financialReport = $financialReport->map(function ($item) use (&$currentBalance) {
            if ($item->jenis === 'pemasukkan') {
                $currentBalance += $item->jumlah;
            } else {
                $currentBalance -= $item->jumlah;
            }
            $item->current_balance = $currentBalance;
            return $item;
        });

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
            'financialReport' => $financialReport,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'openingBalance' => $openingBalance,
            'logoBase64' => $logoBase64,
            'logoPjiBase64' => $logoPjiBase64,
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('keuangan.laporan_pdf', $pdfData);
        
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled'      => true,
            'defaultFont'          => 'sans-serif'
        ]);

        $filename = 'Laporan-Keuangan-' . $startDate . '-sd-' . $endDate . '.pdf';
        return $pdf->stream($filename);
    }

    /**
     * GET /pemasukkan/log/{id}
     * Ambil riwayat pemakaian sesi (kunjungan) untuk kwitansi tertentu.
     */
    public function getLogPemakaian($id)
    {
        try {
            \Log::info("Fetching log for Pemasukkan ID: " . $id);
            // Relationship di Pemasukkan.php didefinisikan sebagai Tarif (Capital T)
            $pemasukkan = Pemasukkan::with(['Tarif', 'anak'])->findOrFail($id);
            
            // AUTO-SYNC: Cari kunjungan yang belum terhubung tapi seharusnya masuk ke kwitansi ini
            if ($pemasukkan->jenis_layanan === 'paket_terapi' && $pemasukkan->anak_id) {
                $query = Kunjungan::where('anak_id', $pemasukkan->anak_id)
                    ->whereNull('pemasukkan_id')
                    ->whereIn('status', ['hadir', 'izin_hangus']);
                
                if ($pemasukkan->tanggal) {
                    $query->whereDate('created_at', '>=', $pemasukkan->tanggal);
                }

                if ($pemasukkan->tarif_id) {
                    $query->where(function($q) use ($pemasukkan) {
                        $q->where('tarif_id', $pemasukkan->tarif_id)
                          ->orWhereNull('tarif_id'); // Handle case where visit was registered without tarif
                    });
                }

                // Ambil data kunjungan yang akan diupdate
                $toUpdate = $query->get();
                
                foreach($toUpdate as $k) {
                    // Update pendaftaran agar link ke kwitansi ini
                    $k->update([
                        'pemasukkan_id' => $pemasukkan->id,
                        'tarif_id' => $pemasukkan->tarif_id // Sinkronkan juga tarifnya
                    ]);
                }
                
                // Refresh data setelah update
                $pemasukkan->load(['kunjungans' => function($q) {
                    $q->orderBy('created_at', 'desc');
                }, 'kunjungans.terapis', 'Tarif']);
            } else {
                $pemasukkan->load(['kunjungans' => function($q) {
                    $q->orderBy('created_at', 'desc');
                }, 'kunjungans.terapis', 'Tarif']);
            }

            return view('keuangan.log_pemakaian', compact('pemasukkan'));
        } catch (\Exception $e) {
            \Log::error("Error fetching log: " . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function kwitansi_pdf($id)
    {
        $pemasukkan = Pemasukkan::with(['Tarif', 'anak', 'kategori'])->findOrFail($id);
        
        $pdfData = [
            'pemasukkan' => $pemasukkan,
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('keuangan.kwitansi_pdf', $pdfData);
        
        // Ukuran Thermal 80mm dalam points (1mm = 2.83465pt)
        // 80mm = 226.77pt, 150mm = 425.2pt
        $pdf->setPaper([0, 0, 226.77, 425.2], 'portrait');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled'      => true,
            'defaultFont'          => 'monospace'
        ]);

        $filename = 'Kwitansi-' . $pemasukkan->id . '.pdf';
        return $pdf->stream($filename);
    }
}

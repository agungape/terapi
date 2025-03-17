<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Kategori;
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

class KeuanganController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view rekapan kas', ['only' => ['rekap', 'pemasukkan_json', 'pengeluaran_json']]);
        $this->middleware('permission:view kategori', ['only' => ['kategori', 'kategori_store', 'kategori_destroy']]);
        $this->middleware('permission:create kategori', ['only' => ['kategori_store']]);
        $this->middleware('permission:delete kategori', ['only' => ['kategori_destroy']]);
        $this->middleware('permission:view pemasukkan', ['only' => ['pemasukkan']]);
        $this->middleware('permission:create pemasukkan', ['only' => ['pemasukkan_store']]);
        $this->middleware('permission:delete pemasukkan', ['only' => ['pemasukkan_destroy']]);
        $this->middleware('permission:view pengeluaran', ['only' => ['pengeluaran']]);
        $this->middleware('permission:create pengeluaran', ['only' => ['pengeluaran_store']]);
        $this->middleware('permission:delete pengeluaran', ['only' => ['pengeluaran_destroy']]);
        $this->middleware('permission:view laporan keuangan', ['only' => ['laporan_keuangan', 'laporan_pdf']]);
    }

    public function pemasukkan_json()
    {
        $pemasukkan = Pemasukkan::with('kategori')->select('pemasukkans.*');
        return DataTables::of($pemasukkan)
            ->addColumn('kategori_nama', function ($row) {
                return $row->kategori ? $row->kategori->nama : '-'; // Nama kategori atau fallback "-"
            })
            ->make(true);
    }

    public function pengeluaran_json()
    {
        $pengeluaran = Pengeluaran::with('kategori')->select('pengeluarans.*');
        return DataTables::of($pengeluaran)
            ->addColumn('kategori_nama', function ($row) {
                return $row->kategori ? $row->kategori->nama : '-'; // Nama kategori atau fallback "-"
            })
            ->make(true);
    }

    public function rekap(Request $request)
    {
        $selectedYear = $request->input('year', date('Y'));

        // Ambil daftar tahun dari tabel pemasukan
        $years_pemasukkan = Pemasukkan::selectRaw('YEAR(tanggal) as year')
            ->groupBy('year')
            ->pluck('year');

        $years_pengeluaran = Pengeluaran::selectRaw('YEAR(tanggal) as year')
            ->groupBy('year')
            ->pluck('year');

        // Ambil data pemasukan berdasarkan tahun yang dipilih
        $data_pemasukkan = Pemasukkan::selectRaw('MONTH(tanggal) as month, SUM(jumlah) as total')
            ->whereYear('tanggal', $selectedYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $data_pengeluaran = Pengeluaran::selectRaw('MONTH(tanggal) as month, SUM(jumlah) as total')
            ->whereYear('tanggal', $selectedYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        if ($request->ajax()) {
            return response()->json([
                'incomeData' => $data_pemasukkan,
                'expenseData' => $data_pengeluaran,
            ]);
        }


        $saldoKas = SaldoKas::first();
        // Hitung total pemasukan
        $totalPemasukan = Pemasukkan::getTotalPemasukan();
        $formattedPemasukan = 'Rp ' . rtrim(rtrim(number_format($totalPemasukan, 2, ',', '.'), '0'), ',');
        // hitung total pengeluaran
        $totalPengeluaran = Pengeluaran::getTotalPengeluaran();
        $formattedPengeluaran = 'Rp ' . rtrim(rtrim(number_format($totalPengeluaran, 2, ',', '.'), '0'), ',');


        return view('keuangan.rekapkas', compact('saldoKas', 'selectedYear', 'years_pemasukkan', 'years_pengeluaran', 'formattedPemasukan', 'formattedPengeluaran', 'data_pemasukkan', 'data_pengeluaran'));
    }

    public function kategori()
    {
        $jenis = [
            'Pemasukkan'  => 'Pemasukkan',
            'Pengeluaran' => 'Pengeluaran'
        ];
        $kategoris = Kategori::latest()->paginate(10);
        return view('keuangan.kategori', compact('kategoris', 'jenis'));
    }

    public function kategori_store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
        ]);
        $kategori = Kategori::create($validateData);
        Alert::success('Berhasil', "Data program $request->nama berhasil dibuat");
        return redirect()->back();
    }

    public function kategori_destroy(Kategori $kategori)
    {
        $kategori->delete();
        Alert::success('Berhasil', "kategori telah di hapus");
        return redirect()->back();
    }

    public function pemasukkan()
    {

        $saldoKas = SaldoKas::first();
        $anaks = Anak::where('status', 'aktif')->get();
        $kategori = Kategori::where('nama', 'Pembayaran Anak')->first();
        $kategoris = Kategori::where('nama', '!=', 'Pembayaran Anak')->where('jenis', '!=', 'Pengeluaran')->get();
        $pemasukkans = Pemasukkan::latest()->paginate(10);
        $tarif = Tarif::latest()->get();
        $dataTerakhir = Pemasukkan::latest('updated_at')->first();
        $totalPemasukan = Pemasukkan::getTotalPemasukan();

        $formattedPemasukan = 'Rp ' . rtrim(rtrim(number_format($totalPemasukan, 2, ',', '.'), '0'), ',');

        return view('keuangan.pemasukkan', compact('pemasukkans', 'kategori', 'kategoris', 'anaks', 'saldoKas', 'dataTerakhir', 'formattedPemasukan', 'tarif'));
    }

    public function pemasukkan_store(Request $request)
    {
        $validateData = $request->validate([
            'tanggal' => 'required|date',
            'deskripsi' => 'required',
            'kategori_id' => 'required|exists:App\Models\Kategori,id',
            'tarif_id' => 'nullable|exists:App\Models\Tarif,id',
            'jumlah' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // hitung penambahan saldo dari SALDO AWAL
        $jumlahPembayaran = $request->input('jumlah');

        // Hapus titik dari jumlah pembayaran
        $jumlahPembayaranbaru = (int)str_replace('.', '', $jumlahPembayaran);

        // Ambil saldo terakhir dari tabel saldo_kas
        $saldo = SaldoKas::latest()->first();

        if ($saldo == true) {
            $saldoAwal = (int) str_replace(['Rp', '.', ' '], '', $saldo->saldo_awal);
        }


        // Hitung saldo akhir setelah pemasukkan
        if ($saldo == null) {
            $saldoAkhir = 0 + $jumlahPembayaranbaru;
        } else {
            $saldoAkhir =  $saldoAwal + $jumlahPembayaranbaru;
        }



        // upload bukti transfer
        if ($request->file('gambar')) {
            $file = $request->file('gambar');
            $extFile = $file->getClientOriginalExtension();
            $namaFile =
                "gambar-" . time() . "." . $extFile;
            $path = 'bukti-transfer/' . $namaFile;
            Storage::disk('public')->put($path, file_get_contents($file));
            $data['gambar'] = $namaFile;
        }


        $data['tanggal'] = $request->tanggal;
        $data['tarif_id'] = $request->tarif_id;
        $data['deskripsi'] = $request->deskripsi;
        $data['kategori_id'] = $request->kategori_id;
        $data['jumlah'] = $jumlahPembayaranbaru;

        $data['saldo_akhir'] = $saldoAkhir;

        $saldoKasAkhir['saldo_awal'] = $saldoAkhir;

        if ($saldo == null) {
            $saldoKas = SaldoKas::create($saldoKasAkhir);
        } else {
            $saldo->update([
                'saldo_awal' => $saldoAkhir
            ]);
        }

        $pemasukkan = Pemasukkan::create($data);
        Alert::toast("data Pemasukkan berhasil di Tambahkan", 'success');
        return redirect()->back();
    }

    public function pemasukkan_destroy(Pemasukkan $pemasukkan)
    {
        $saldoKas = SaldoKas::latest()->first();
        $saldoAwal = (int) str_replace(['Rp', '.', ' '], '', $saldoKas->saldo_awal);

        $formatjumlah = $pemasukkan->jumlah;
        $saldoJumlah = (int) str_replace(['Rp', '.', ' '], '', $formatjumlah);
        $saldo = $saldoAwal - $saldoJumlah;

        $saldoKas->update([
            'saldo_awal' => $saldo
        ]);
        $pemasukkan->delete();
        Storage::delete('public/bukti-transfer/' . $pemasukkan->gambar);
        Alert::success('Berhasil', "data telah di hapus");
        return redirect()->back();
    }

    public function pengeluaran()
    {

        $saldoKas = SaldoKas::first();

        $kategoris = Kategori::where('jenis', '!=', 'Pemasukkan')->get();
        $pengeluarans = Pengeluaran::latest()->paginate(10);

        $dataTerakhir = Pengeluaran::latest('updated_at')->first();
        $totalPengeluaran = Pengeluaran::getTotalPengeluaran();
        $formattedPengeluaran = 'Rp ' . rtrim(rtrim(number_format($totalPengeluaran, 2, ',', '.'), '0'), ',');
        return view('keuangan.pengeluaran', compact('pengeluarans', 'kategoris', 'saldoKas', 'dataTerakhir', 'formattedPengeluaran'));
    }

    public function pengeluaran_store(Request $request)
    {
        $validateData = $request->validate([
            'tanggal' => 'required|date',
            'deskripsi' => 'required',
            'kategori_id' => 'required|exists:App\Models\Kategori,id',
            'jumlah' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // hitung penambahan saldo dari SALDO AWAL
        $jumlahPembayaran = $request->input('jumlah');

        // Hapus titik dari jumlah pembayaran
        $jumlahPembayaranbaru = (int)str_replace('.', '', $jumlahPembayaran);

        // Ambil saldo terakhir dari tabel saldo_kas
        $saldo = SaldoKas::latest()->first();

        if ($saldo == true) {
            $saldoAwal = (int) str_replace(['Rp', '.', ' '], '', $saldo->saldo_awal);
        }


        // Hitung saldo akhir setelah pemasukkan
        $saldoAkhir =  $saldoAwal - $jumlahPembayaranbaru;




        // upload bukti transfer
        if ($request->file('gambar')) {
            $file = $request->file('gambar');
            $extFile = $file->getClientOriginalExtension();
            $namaFile =
                "gambar-" . time() . "." . $extFile;
            $path = 'sturk-bayar/' . $namaFile;
            Storage::disk('public')->put($path, file_get_contents($file));
            $data['gambar'] = $namaFile;
        }


        $data['tanggal'] = $request->tanggal;
        $data['deskripsi'] = $request->deskripsi;
        $data['kategori_id'] = $request->kategori_id;
        $data['jumlah'] = $jumlahPembayaranbaru;
        $data['saldo_akhir'] = $saldoAkhir;


        $saldo->update([
            'saldo_awal' => $saldoAkhir
        ]);


        $pengeluaran = Pengeluaran::create($data);
        Alert::toast("data Pengeluaran berhasil di Tambahkan", 'success');
        return redirect()->back();
    }

    public function pengeluaran_destroy(Pengeluaran $pengeluaran)
    {
        $saldoKas = SaldoKas::latest()->first();
        $saldoAwal = (int) str_replace(['Rp', '.', ' '], '', $saldoKas->saldo_awal);

        $formatjumlah = $pengeluaran->jumlah;
        $saldoJumlah = (int) str_replace(['Rp', '.', ' '], '', $formatjumlah);
        $saldo = $saldoAwal + $saldoJumlah;

        $saldoKas->update([
            'saldo_awal' => $saldo
        ]);
        $pengeluaran->delete();
        if ($pengeluaran->gambar == true) {
            Storage::delete('public/bukti-transfer/' . $pengeluaran->gambar);
        }
        Alert::success('Berhasil', "data telah di hapus");
        return redirect()->back();
    }

    public function laporan_keuangan(Request $request)
    {
        $dateRange = $request->input('date_range');

        // Pastikan date_range ada dan memiliki format yang benar
        if ($dateRange) {
            // Pisahkan tanggal mulai dan tanggal selesai
            $dates = explode(' - ', $dateRange);

            // Periksa apakah array dates memiliki dua elemen
            if (count($dates) == 2) {
                $startDate = $dates[0];
                $endDate = $dates[1];
            } else {
                // Jika format tidak valid, set tanggal default
                $startDate = now()->startOfMonth()->toDateString();
                $endDate = now()->endOfMonth()->toDateString();
            }
        } else {
            // Jika date_range kosong, set tanggal default
            $startDate = now()->startOfMonth()->toDateString();
            $endDate = now()->endOfMonth()->toDateString();
        }



        $financialReport = DB::table('pemasukkans')
            ->select('tanggal', DB::raw('"pemasukkan" as jenis'), 'jumlah', 'deskripsi', DB::raw('NULL as saldo_awal'), 'created_at')
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->unionAll(
                DB::table('pengeluarans')
                    ->select('tanggal', DB::raw('"pengeluaran" as jenis'), 'jumlah', 'deskripsi', DB::raw('NULL as saldo_awal'), 'created_at')
                    ->whereBetween('tanggal', [$startDate, $endDate])
            )
            ->orderBy('created_at')
            ->get();

        // Hitung saldo akhir
        $currentBalance = 0;
        $financialReport = $financialReport->map(function ($item) use (&$currentBalance) {
            if ($item->jenis === 'pemasukkan') {
                $currentBalance += $item->jumlah;
            } elseif ($item->jenis === 'pengeluaran') {
                $currentBalance -= $item->jumlah;
            } elseif ($item->jenis === 'saldo') {
                $currentBalance = $item->saldo_awal; // Update saldo berdasarkan data saldo_kas
            }
            $item->current_balance = $currentBalance;
            return $item;
        });
        return view('keuangan.laporan', compact('financialReport', 'startDate', 'endDate'));
    }


    public function laporan_pdf(Request $request, $startDate, $endDate)
    {
        $financialReport = DB::table('pemasukkans')
            ->select('tanggal', DB::raw('"pemasukkan" as jenis'), 'jumlah', 'deskripsi', DB::raw('NULL as saldo_awal'), 'created_at')
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->unionAll(
                DB::table('pengeluarans')
                    ->select('tanggal', DB::raw('"pengeluaran" as jenis'), 'jumlah', 'deskripsi', DB::raw('NULL as saldo_awal'), 'created_at')
                    ->whereBetween('tanggal', [$startDate, $endDate])
            )
            ->orderBy('created_at')
            ->get();

        // Hitung saldo akhir
        $currentBalance = 0;
        $financialReport = $financialReport->map(function ($item) use (&$currentBalance) {
            if ($item->jenis === 'pemasukkan') {
                $currentBalance += $item->jumlah;
            } elseif ($item->jenis === 'pengeluaran') {
                $currentBalance -= $item->jumlah;
            } elseif ($item->jenis === 'saldo') {
                $currentBalance = $item->saldo_awal; // Update saldo berdasarkan data saldo_kas
            }
            $item->current_balance = $currentBalance;
            return $item;
        });


        // Generate PDF
        $pdf = Pdf::loadView('keuangan.laporan_pdf', [
            'financialReport' => $financialReport,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);

        // Menampilkan PDF langsung di browser
        return response($pdf->stream('laporan_keuangan_' . $startDate . '_to_' . $endDate . '.pdf'))
            ->header('Content-Type', 'application/pdf');
    }
}

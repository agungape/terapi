<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Kategori;
use App\Models\Keuangan;
use App\Models\Pemasukkan;
use App\Models\Pengeluaran;
use App\Models\SaldoKas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        $years = Pemasukkan::selectRaw('YEAR(tanggal) as year')
            ->groupBy('year')
            ->pluck('year');

        // Ambil data pemasukan berdasarkan tahun yang dipilih
        $data = Pemasukkan::selectRaw('MONTH(tanggal) as month, SUM(jumlah) as total')
            ->whereYear('tanggal', $selectedYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        if ($request->ajax()) {
            return response()->json([
                'chartData' => $data
            ]);
        }



        $saldoKas = SaldoKas::first();
        // Hitung total pemasukan
        $totalPemasukan = Pemasukkan::getTotalPemasukan();
        $formattedPemasukan = 'Rp ' . rtrim(rtrim(number_format($totalPemasukan, 2, ',', '.'), '0'), ',');
        // hitung total pengeluaran
        $totalPengeluaran = Pengeluaran::getTotalPengeluaran();
        $formattedPengeluaran = 'Rp ' . rtrim(rtrim(number_format($totalPengeluaran, 2, ',', '.'), '0'), ',');


        return view('keuangan.rekapkas', compact('saldoKas', 'selectedYear', 'years', 'data', 'formattedPemasukan', 'formattedPengeluaran'));
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

        $dataTerakhir = Pemasukkan::latest('updated_at')->first();
        $totalPemasukan = Pemasukkan::getTotalPemasukan();

        $formattedPemasukan = 'Rp ' . rtrim(rtrim(number_format($totalPemasukan, 2, ',', '.'), '0'), ',');

        return view('keuangan.pemasukkan', compact('pemasukkans', 'kategori', 'kategoris', 'anaks', 'saldoKas', 'dataTerakhir', 'formattedPemasukan'));
    }

    public function pemasukkan_store(Request $request)
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
}

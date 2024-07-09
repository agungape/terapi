<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Kunjungan;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AnakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anak = Anak::orderBy('nib')->paginate(5);

        foreach ($anak as $a) {
            $tanggal_lahir = Carbon::parse($a->tanggal_lahir);
            $a->usia = $tanggal_lahir->diffInYears(Carbon::now());
        }
        return view('anak.index', ['anaks' => $anak]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $anak = new Anak();
        // buat kode barang BR005
        $anak->nib = 'BSC' . str_pad(Anak::count() + 1, 3, '0', STR_PAD_LEFT);
        return view('anak.create', compact('anak'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        dd($request);
        $validateData = $request->validate([
            'nib' => 'required|alpha_num|size:6|unique:anaks,nib',
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'diagnosa' => '',
            'jenis_kelamin' => 'required',
            'telepon' => 'required|numeric',
            'wali' => 'required',
        ]);
        $anak = Anak::create($validateData);
        Alert::success('Berhasil', "Data Anak $request->nama berhasil dibuat");
        return redirect("/anak#card-{$anak->id}");
    }

    /**
     * Display the specified resource.
     */
    public function show(Anak $anak)
    {
        $kunjungan = Kunjungan::where('anak_id', $anak->id)->orderBy('pertemuan')->paginate(5);
        return view('anak.detail', compact('kunjungan', 'anak'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function kunjungan(Anak $anak)
    {
    }

    public function edit(Anak $anak)
    {
        return view('anak.edit', compact('anak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anak $anak): RedirectResponse
    {
        $validateData = $request->validate([
            'nib' => 'required|alpha_num|size:6|unique:anaks,nib,' . $anak->id,
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'diagnosa' => '',
            'jenis_kelamin' => 'required',
            'telepon' => 'required|numeric',
            'wali' => 'required',
        ]);
        $anak->update($validateData);
        Alert::success('Berhasil', "Anak $request->nama telah di update");
        // Trik agar halaman kembali ke halaman asal
        return redirect($request->url_asal);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anak $anak)
    {
        $anak->delete();
        Alert::success('Berhasil', "$anak->nama telah di hapus");
        return redirect("/anak");
    }
}

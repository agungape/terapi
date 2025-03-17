<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class TarifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarif = tarif::latest()->paginate(5);
        return view('tarif.index', compact('tarif'));
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
        $validateData = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'tarif' => 'required',
        ]);

        $tarif = Tarif::create($validateData);
        Alert::success('Berhasil', "Data tarif berhasil dibuat");
        return redirect("/tarif");
    }

    public function uploadGambar(Request $request)
    {
        // Validasi request
        $request->validate([
            'tarif_id' => 'required|exists:tarifs,id',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:10248',
        ]);

        // Ambil tarif berdasarkan ID
        $tarif = Tarif::findOrFail($request->tarif_id);

        // Simpan gambar ke storage
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($tarif->gambar) {
                Storage::delete('public/tarif/' . $tarif->gambar);
            }

            // Simpan gambar baru
            $file = $request->file('gambar');
            $extFile = $file->getClientOriginalExtension();
            $namaFile =
                "gambar-" . time() . "." . $extFile;
            $path = 'tarif/' . $namaFile;
            Storage::disk('public')->put($path, file_get_contents($file));

            // Update database dengan nama file
            $tarif->gambar = $namaFile;
            $tarif->save();
        }

        Alert::success('Berhasil', "data gambar berhasil dibuat");
        return redirect()->back();
    }

    public function hapusGambar($id)
    {
        // Ambil data tarif berdasarkan ID
        $tarif = Tarif::findOrFail($id);

        // Cek apakah ada gambar
        if ($tarif->gambar) {
            // Hapus file dari storage
            Storage::delete('public/tarif/' . $tarif->gambar);

            // Set kolom gambar menjadi null
            $tarif->gambar = null;
            $tarif->save();

            Alert::success('Berhasil', "data gambar berhasil dihapus");
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarif $tarif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarif $tarif)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarif $tarif)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarif $tarif)
    {
        Storage::disk('public')->delete('tarif/' . $tarif->gambar);
        $tarif->delete();
        Alert::success('Berhasil', "$tarif->nama telah di hapus");
        return redirect("/tarif");
    }
}

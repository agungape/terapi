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
    public function index(Request $request)
    {
        $query = Tarif::latest();
        
        if ($request->filled('jenis') && $request->jenis !== 'semua') {
            $query->where('jenis_terapi', $request->jenis);
        }

        $tarif = $query->paginate(12)->withQueryString();
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
            'nama'              => 'required',
            'deskripsi'         => 'nullable',
            'tarif'             => 'required',
            'jumlah_pertemuan'  => 'nullable|integer|min:1',
            'jenis_terapi'      => 'required|in:terapi_perilaku,fisioterapi',
            'is_active'         => 'nullable',
            'gambar'            => 'nullable|image|max:2048'
        ]);

        $validateData['is_active'] = $request->has('is_active');

        $tarif = new Tarif();
        $tarif->nama = $validateData['nama'];
        $tarif->deskripsi = $validateData['deskripsi'];
        $tarif->tarif = (int) str_replace('.', '', $validateData['tarif']);
        $tarif->jumlah_pertemuan = $validateData['jumlah_pertemuan'];
        $tarif->jenis_terapi = $validateData['jenis_terapi'];
        $tarif->is_active = $validateData['is_active'];
        
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFile = "tarif-" . time() . "." . $file->getClientOriginalExtension();
            $file->storeAs('tarif', $namaFile, 'public');
            $tarif->gambar = $namaFile;
        }

        $tarif->save();
        return redirect()->route('tarif.index')->with('success', "Paket terapi $tarif->nama berhasil dibuat.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarif $tarif) {}



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarif $tarif)
    {
        $validateData = $request->validate([
            'nama'              => 'required',
            'deskripsi'         => 'nullable',
            'tarif'             => 'required',
            'jumlah_pertemuan'  => 'nullable|integer|min:1',
            'jenis_terapi'      => 'required|in:terapi_perilaku,fisioterapi',
            'is_active'         => 'nullable',
            'gambar'            => 'nullable|image|max:2048'
        ]);

        $tarif->nama = $validateData['nama'];
        $tarif->deskripsi = $validateData['deskripsi'] ?? $tarif->deskripsi;
        $tarif->tarif = (int) str_replace('.', '', $validateData['tarif']);
        $tarif->jumlah_pertemuan = $validateData['jumlah_pertemuan'] ?? $tarif->jumlah_pertemuan;
        $tarif->jenis_terapi = $validateData['jenis_terapi'];
        $tarif->is_active = $validateData['is_active'];

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($tarif->gambar) {
                Storage::disk('public')->delete('tarif/' . $tarif->gambar);
            }
            
            $file = $request->file('gambar');
            $namaFile = "tarif-" . time() . "." . $file->getClientOriginalExtension();
            $file->storeAs('tarif', $namaFile, 'public');
            $tarif->gambar = $namaFile;
        }

        $tarif->save();
        return redirect()->route('tarif.index')->with('success', "Paket terapi $tarif->nama (Kategori: $tarif->jenis_terapi) berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarif $tarif)
    {
        Storage::disk('public')->delete('tarif/' . $tarif->gambar);
        $tarif->delete();
        return redirect("/tarif")->with('success', "$tarif->nama telah di hapus");
    }
}

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
            'nama'                  => 'required',
            'deskripsi'             => 'nullable',
            'tarif'                 => 'required',
            'jumlah_pertemuan'      => 'nullable|integer|min:1',
            'pertemuan_perilaku'    => 'nullable|integer|min:1',
            'pertemuan_fisioterapi' => 'nullable|integer|min:1',
            'jenis_terapi'          => 'required|in:terapi_perilaku,fisioterapi,gabungan,assessment,observasi',
            'is_active'             => 'nullable',
            'gambar'                => 'nullable|image|max:2048',
        ]);

        // Validasi kondisional untuk paket gabungan
        if ($request->jenis_terapi === 'gabungan') {
            $request->validate([
                'pertemuan_perilaku'    => 'required|integer|min:1',
                'pertemuan_fisioterapi' => 'required|integer|min:1',
            ]);
        }

        $validateData['is_active'] = $request->has('is_active');

        $tarif                       = new Tarif();
        $tarif->nama                 = $validateData['nama'];
        $tarif->deskripsi            = $validateData['deskripsi'];
        $tarif->tarif                = (int) preg_replace('/[^0-9]/', '', $validateData['tarif']);
        $tarif->jenis_terapi         = $validateData['jenis_terapi'];
        $tarif->is_active            = $validateData['is_active'];
        $tarif->pertemuan_perilaku   = $request->pertemuan_perilaku;
        $tarif->pertemuan_fisioterapi = $request->pertemuan_fisioterapi;

        // jumlah_pertemuan hanya relevan untuk single jenis (bukan gabungan/assessment/observasi)
        if (!in_array($request->jenis_terapi, ['gabungan', 'assessment', 'observasi'])) {
            $tarif->jumlah_pertemuan = $validateData['jumlah_pertemuan'];
        } else {
            $tarif->jumlah_pertemuan = null;
        }

        if ($request->hasFile('gambar')) {
            $file      = $request->file('gambar');
            $namaFile  = "tarif-" . time() . "." . $file->getClientOriginalExtension();
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
        $request->validate([
            'nama'                  => 'required',
            'deskripsi'             => 'nullable',
            'tarif'                 => 'required',
            'jumlah_pertemuan'      => 'nullable|integer|min:1',
            'pertemuan_perilaku'    => 'nullable|integer|min:1',
            'pertemuan_fisioterapi' => 'nullable|integer|min:1',
            'jenis_terapi'          => 'required|in:terapi_perilaku,fisioterapi,gabungan,assessment,observasi',
            'is_active'             => 'nullable',
            'gambar'                => 'nullable|image|max:2048',
        ]);

        if ($request->jenis_terapi === 'gabungan') {
            $request->validate([
                'pertemuan_perilaku'    => 'required|integer|min:1',
                'pertemuan_fisioterapi' => 'required|integer|min:1',
            ]);
        }

        $tarif->nama                  = $request->nama;
        $tarif->deskripsi             = $request->deskripsi;
        $tarif->tarif                 = (int) preg_replace('/[^0-9]/', '', $request->tarif);
        $tarif->jenis_terapi          = $request->jenis_terapi;
        $tarif->is_active             = $request->has('is_active');
        $tarif->pertemuan_perilaku    = $request->pertemuan_perilaku;
        $tarif->pertemuan_fisioterapi = $request->pertemuan_fisioterapi;

        if (!in_array($request->jenis_terapi, ['gabungan', 'assessment', 'observasi'])) {
            $tarif->jumlah_pertemuan = $request->jumlah_pertemuan;
        } else {
            $tarif->jumlah_pertemuan = null;
        }

        if ($request->hasFile('gambar')) {
            if ($tarif->gambar) {
                Storage::disk('public')->delete('tarif/' . $tarif->gambar);
            }
            $file      = $request->file('gambar');
            $namaFile  = "tarif-" . time() . "." . $file->getClientOriginalExtension();
            $file->storeAs('tarif', $namaFile, 'public');
            $tarif->gambar = $namaFile;
        }

        $tarif->save();
        return redirect()->route('tarif.index')->with('success', "Paket $tarif->nama ($tarif->jenis_terapi) berhasil diperbarui.");
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

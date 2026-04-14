<?php

namespace App\Http\Controllers;

use App\Models\AlatUkur;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AlatUkurController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('format') && $request->format === 'json') {
            return response()->json(\App\Models\AlatUkur::select('nama')
                        ->where('is_active', true)
                        ->pluck('nama'));
        }

        $alatUkurs = AlatUkur::latest()->paginate(15);
        return view('alat-ukur.index', compact('alatUkurs'));
    }

    public function create()
    {
        $domains = $this->getDomainOptions();
        return view('alat-ukur.create', compact('domains'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'              => 'required|string|max:255',
            'singkatan'         => 'nullable|string|max:50',
            'domain'            => 'required|in:kognitif,bahasa,motorik,sosial_emosional,perilaku_adaptif,komprehensif,lainnya',
            'min_usia_bulan'    => 'nullable|integer|min:0',
            'max_usia_bulan'    => 'nullable|integer|min:0',
            'min_skor'          => 'nullable|integer',
            'max_skor'          => 'nullable|integer',
            'deskripsi'         => 'nullable|string',
            'norma_interpretasi' => 'nullable|json',
            'is_active'         => 'nullable|boolean',
        ]);

        $validated['is_active']          = $request->has('is_active') ? true : false;
        $validated['norma_interpretasi'] = $request->norma_interpretasi
            ? json_decode($request->norma_interpretasi, true)
            : null;

        AlatUkur::create($validated);
        return redirect('/alat-ukur')->with('success', "Alat ukur {$validated['nama']} berhasil ditambahkan");
    }

    public function edit(AlatUkur $alatUkur)
    {
        $domains = $this->getDomainOptions();
        return view('alat-ukur.edit', compact('alatUkur', 'domains'));
    }

    public function update(Request $request, AlatUkur $alatUkur)
    {
        $validated = $request->validate([
            'nama'               => 'required|string|max:255',
            'singkatan'          => 'nullable|string|max:50',
            'domain'             => 'required|in:kognitif,bahasa,motorik,sosial_emosional,perilaku_adaptif,komprehensif,lainnya',
            'min_usia_bulan'     => 'nullable|integer|min:0',
            'max_usia_bulan'     => 'nullable|integer|min:0',
            'min_skor'           => 'nullable|integer',
            'max_skor'           => 'nullable|integer',
            'deskripsi'          => 'nullable|string',
            'norma_interpretasi' => 'nullable|json',
            'is_active'          => 'nullable|boolean',
        ]);

        $validated['is_active']          = $request->has('is_active') ? true : false;
        $validated['norma_interpretasi'] = $request->norma_interpretasi
            ? json_decode($request->norma_interpretasi, true)
            : null;

        $alatUkur->update($validated);
        return redirect('/alat-ukur')->with('success', "Alat ukur berhasil diperbarui");
    }

    public function destroy(AlatUkur $alatUkur)
    {
        $alatUkur->delete();
        return redirect()->back()->with('success', "Alat ukur telah dihapus");
    }

    public function show(AlatUkur $alatUkur)
    {
        return view('alat-ukur.show', compact('alatUkur'));
    }

    private function getDomainOptions(): array
    {
        return [
            'kognitif'         => 'Kognitif',
            'bahasa'           => 'Bahasa',
            'motorik'          => 'Motorik',
            'sosial_emosional' => 'Sosial & Emosional',
            'perilaku_adaptif' => 'Perilaku Adaptif',
            'komprehensif'     => 'Komprehensif (Multi-Domain)',
            'lainnya'          => 'Lainnya',
        ];
    }
}

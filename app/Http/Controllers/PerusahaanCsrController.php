<?php

namespace App\Http\Controllers;

use App\Models\PerusahaanCsr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerusahaanCsrController extends Controller
{
    public function index()
    {
        $csrs = PerusahaanCsr::latest()->get();
        return view('perusahaan_csr.index', compact('csrs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'deskripsi_program' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $data = $request->only(['nama_perusahaan', 'deskripsi_program']);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/csr-logos', $filename);
            $data['logo'] = 'csr-logos/' . $filename;
        }

        PerusahaanCsr::create($data);

        return redirect()->back()->with('success', 'Data Perusahaan CSR berhasil ditambahkan.');
    }

    public function update(Request $request, PerusahaanCsr $perusahaan_csr)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'deskripsi_program' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $data = $request->only(['nama_perusahaan', 'deskripsi_program']);

        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($perusahaan_csr->logo && Storage::exists('public/' . $perusahaan_csr->logo)) {
                Storage::delete('public/' . $perusahaan_csr->logo);
            }

            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/csr-logos', $filename);
            $data['logo'] = 'csr-logos/' . $filename;
        }

        $perusahaan_csr->update($data);

        return redirect()->back()->with('success', 'Data Perusahaan CSR berhasil diperbarui.');
    }

    public function destroy(PerusahaanCsr $perusahaan_csr)
    {
        // Hapus file logo jika ada
        if ($perusahaan_csr->logo && Storage::exists('public/' . $perusahaan_csr->logo)) {
            Storage::delete('public/' . $perusahaan_csr->logo);
        }

        $perusahaan_csr->delete();

        return redirect()->back()->with('success', 'Data Perusahaan CSR berhasil dihapus.');
    }
}

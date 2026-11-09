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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ]);

        $data = $request->only(['nama_perusahaan', 'deskripsi_program']);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $ext = strtolower($file->getClientOriginalExtension() ?: 'png');
            $filename = 'csr-' . time() . '-' . uniqid() . '.' . $ext;
            $data['logo'] = $file->storeAs('csr-logos', $filename, 'public');
        }

        PerusahaanCsr::create($data);

        return redirect()->back()->with('success', 'Data Perusahaan CSR berhasil ditambahkan.');
    }

    public function update(Request $request, PerusahaanCsr $perusahaan_csr)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'deskripsi_program' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ]);

        $data = $request->only(['nama_perusahaan', 'deskripsi_program']);

        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada (baik di disk public maupun path lama)
            if ($perusahaan_csr->logo) {
                if (Storage::disk('public')->exists($perusahaan_csr->logo)) {
                    Storage::disk('public')->delete($perusahaan_csr->logo);
                }
                if (Storage::exists('public/' . $perusahaan_csr->logo)) {
                    Storage::delete('public/' . $perusahaan_csr->logo);
                }
            }

            $file = $request->file('logo');
            $ext = strtolower($file->getClientOriginalExtension() ?: 'png');
            $filename = 'csr-' . time() . '-' . uniqid() . '.' . $ext;
            $data['logo'] = $file->storeAs('csr-logos', $filename, 'public');
        }

        $perusahaan_csr->update($data);

        return redirect()->back()->with('success', 'Data Perusahaan CSR berhasil diperbarui.');
    }

    public function destroy(PerusahaanCsr $perusahaan_csr)
    {
        // Hapus file logo jika ada
        if ($perusahaan_csr->logo) {
            if (Storage::disk('public')->exists($perusahaan_csr->logo)) {
                Storage::disk('public')->delete($perusahaan_csr->logo);
            }
            if (Storage::exists('public/' . $perusahaan_csr->logo)) {
                Storage::delete('public/' . $perusahaan_csr->logo);
            }
        }

        $perusahaan_csr->delete();

        return redirect()->back()->with('success', 'Data Perusahaan CSR berhasil dihapus.');
    }

    public function logo(PerusahaanCsr $perusahaan_csr)
    {
        if (!$perusahaan_csr->logo) {
            abort(404);
        }

        $relativePath = ltrim(str_replace(['..', '\\'], ['', '/'], $perusahaan_csr->logo), '/');

        $candidates = [
            storage_path('app/public/' . $relativePath),
            storage_path('app/public/public/' . $relativePath),
            public_path('storage/' . $relativePath),
        ];

        foreach ($candidates as $path) {
            if (is_file($path)) {
                return response()->file($path, [
                    'Cache-Control' => 'public, max-age=86400',
                ]);
            }
        }

        abort(404);
    }
}

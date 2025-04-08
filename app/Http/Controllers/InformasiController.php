<?php

namespace App\Http\Controllers;

use App\Models\informasi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InformasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view informasi', ['only' => ['index']]);
        $this->middleware('permission:update informasi', ['only' => ['update']]);
    }

    public function index()
    {
        $informasi = Informasi::first();
        return view('informasi.index', compact('informasi'));
    }

    public function update(Request $request, informasi $informasi)
    {
        $request->validate([
            'informasi' => 'nullable',
        ]);

        $informasi->update([
            'informasi' => $request->informasi,
        ]);

        Alert::success('Berhasil', "Informasi telah di update");
        return redirect()->back();
    }
}

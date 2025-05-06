<?php

namespace App\Http\Controllers;

use App\Models\Psikolog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PsikologController extends Controller
{
    public function index()
    {
        $psikolog = Psikolog::latest()->paginate(5);
        return view('psikolog.index', compact('psikolog'));
    }

    public function create()
    {
        return view('psikolog.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validateData = $request->validate([
            'nama' => 'required',
            'alamat' => 'nullable',
            'telepon' => 'nullable'
        ]);

        $psikolog = Psikolog::create($validateData);
        Alert::success('Berhasil', "Data berhasil dibuat");
        return redirect('/psikolog');
    }

    public function edit(Psikolog $psikolog)
    {
        return view('psikolog.edit', compact('psikolog'));
    }

    public function update(Psikolog $psikolog, Request $request)
    {

        $validateData = $request->validate([
            'nama' => 'required',
            'alamat' => 'nullable',
            'telepon' => 'nullable'
        ]);

        $psikolog->update($validateData);
        Alert::success('Berhasil', "Data berhasil di Ubah");
        return redirect('/psikolog');
    }

    public function destroy($psikolog)
    {
        $hapus = Psikolog::findOrFail($psikolog);
        $hapus->delete();
        Alert::success('Berhasil', "Data berhasil di Hapus");
        return redirect()->back();
    }
}

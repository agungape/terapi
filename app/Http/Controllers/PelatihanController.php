<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PelatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelatihan = Pelatihan::orderBy('created_at')->paginate(5);
        return view('pelatihan.index', compact('pelatihan'));
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
            'instansi' => 'required',
        ]);
        $pelatihan = Pelatihan::create($validateData);
        Alert::success('Berhasil', "Data pelatihan $request->nama berhasil dibuat");
        return redirect("/pelatihan#card-{$pelatihan->id}");
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelatihan $pelatihan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelatihan $pelatihan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelatihan $pelatihan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelatihan $pelatihan)
    {
        $pelatihan->delete();
        Alert::success('Berhasil', "$pelatihan->nama telah di hapus");
        return redirect("/pelatihan");
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Observasi;
use App\Models\Terapis;
use Illuminate\Http\Request;

class ObservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis = [
            'wawancara' => 'Wawancara',
            'katolik' => 'Katolik',
            'protestan' => 'Protestan',
            'hindu' => 'Hindu',
            'budha' => 'Budha',
            'konghuchu' => 'Konghuchu'
        ];
        $anaks = Anak::all();
        $terapis = Terapis::all();
        return view('observasi.index', compact('anaks', 'terapis', 'jenis'));
    }

    public function observasi_mulai(Request $request)
    {
        if ($request->jenis == 'wawancara') {

            $anak = Anak::where('id', $request->anak_id)->first();
            $jenis = $request->input('jenis');

            return view('observasi.wawancara', compact('anak', 'jenis'));
        }
    }

    public function observasi_atec()
    {
        return view('observasi.atec');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

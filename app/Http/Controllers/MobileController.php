<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Kunjungan;
use App\Models\Terapis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

class MobileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->is('mobile') || $request->is('mobile/*')) {
            session(['view' => 'anak']);
        } else {
            session(['view' => 'admin']);
        }
        return view('mobile.login');
    }

    public function app()
    {
        $user = auth()->user();
        $namaUser = $user->name;
        $anak = Anak::where('nama', $namaUser)->first();
        $terapis = Terapis::get();
        foreach ($terapis as $t) {
            $tanggal_lahir = Carbon::parse($t->tanggal_lahir);
            $t->usia = $tanggal_lahir->diffInYears(Carbon::now());
        }
        $kunjungan = Kunjungan::where('anak_id', $anak->id)->orderBy('pertemuan')->get();
        return view('mobile.dashboard', compact('anak', 'terapis', 'kunjungan'));
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

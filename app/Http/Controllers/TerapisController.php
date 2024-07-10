<?php

namespace App\Http\Controllers;

use App\Models\Terapis;
use App\Models\TerapisPelatihan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TerapisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $terapis = Terapis::orderBy('nib')->paginate(5);
        foreach ($terapis as $t) {
            $tanggal_lahir = Carbon::parse($t->tanggal_lahir);
            $t->usia = $tanggal_lahir->diffInYears(Carbon::now());
        }
        return view('terapis.index', ['t' => $terapis]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $terapis = new Terapis();
        // buat kode barang BR005
        $terapis->nib = 'BSC' . str_pad(Terapis::count() + 1, 2, '0', STR_PAD_LEFT);
        return view('terapis.create', compact('terapis'));
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
    public function show(Terapis $terapi)
    {
        $terapis = Terapis::with(['pelatihans' => function ($query) {
            $query->withPivot('tanggal', 'sertifikat'); // Mengambil kolom expires_at dari pivot
        }])->where('id', $terapi->id)->first();
        // dd($terapis);
        // $terapis = Terapis::findOrFail($terapi->id);
        // $pelatihan = $terapis->pelatihans;
        return view('terapis.detail', compact('terapi', 'terapis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Terapis $terapis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Terapis $terapis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Terapis $terapis)
    {
        //
    }

    public function terapis_pelatihan()
    {
    }
}

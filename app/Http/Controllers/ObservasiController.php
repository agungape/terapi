<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Observasi;
use App\Models\Terapis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ObservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $observasi = Observasi::latest()->paginate(10);
        $jenis = [
            'wawancara' => 'Wawancara',
            'atec' => 'Atec'
        ];
        $anaks = Anak::all();
        $terapis = Terapis::all();
        return view('observasi.index', compact('anaks', 'terapis', 'jenis', 'observasi'));
    }

    public function observasi_mulai(Request $request)
    {
        if ($request->jenis == 'wawancara') {

            $anak = Anak::where('id', $request->anak_id)->first();
            $jenis = $request->input('jenis');

            return view('observasi.wawancara', compact('anak', 'jenis'));
        }

        if ($request->jenis == 'atec') {
            $anak = Anak::where('id', $request->anak_id)->first();
            $jenis = $request->jenis;
            return view('observasi.atec', compact('anak', 'jenis'));
        }
    }

    public function observasi_atec(Request $request)
    {
        $validateData = $request->validate([
            'anak_id' => 'required|exists:App\Models\Anak,id',
            'jenis' => 'required',
            'gambar_atec' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // upload gambar hasil atec
        if ($request->file('gambar_atec')) {
            $file = $request->file('gambar_atec');
            $extFile = $file->getClientOriginalExtension();
            $namaFile =
                "gambar-" . time() . "." . $extFile;
            $path = 'atec/' . $namaFile;
            Storage::disk('public')->put($path, file_get_contents($file));
            $data['gambar_atec'] = $namaFile;
        }


        $data['anak_id'] = $request->anak_id;
        $data['jenis'] = $request->jenis;

        $atec = Observasi::create($data);
        Alert::toast("data Observasi berhasil di Tambahkan", 'success');
        return redirect()->route('observasi.index');
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

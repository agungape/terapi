<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Tarif;
use App\Models\Terapis;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PencarianController extends Controller
{
    public function proses(Request $request): View
    {
        $terapis = Terapis::where('status', 'aktif')->get();
        $jenisTerapi = [
            'fisioterapi' => 'Fisioterapi & Sensor Integrasi',
            'terapi_perilaku' => 'Terapi Perilaku'
        ];

        $result = Anak::where('nama', 'LIKE', '%' . $request->s . '%')
            ->orderBy('nama')->paginate(10);

        return view('kunjungan.index', [
            'result' => $result,
            's' => $request->s,
            'terapis' => $terapis,
            'jenisTerapi' => $jenisTerapi
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Assessment;
use App\Models\Psikolog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AssessmentController extends Controller
{
    public function index()
    {
        $assessment = Assessment::latest()->paginate(10);
        return view('assessment.index', compact('assessment'));
    }

    public function create()
    {
        $anaks = Anak::latest()->get();
        $psikologs = Psikolog::latest()->get();
        return view('assessment.create', compact('anaks', 'psikologs'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validateData = $request->validate([
            'anak_id' => 'required|exists:App\Models\Anak,id',
            'psikolog_id' => 'required|exists:App\Models\Psikolog,id',
            'file_assessment' =>  'required|file|mimes:pdf|max:2048',
        ]);

        $namaAnak = Anak::findorFail($request->anak_id);

        if ($request->file('file_assessment')) {
            $file = $request->file('file_assessment');
            $extFile = $file->getClientOriginalExtension();
            $namaFile =
                "hasil-assessment-" . $namaAnak->nama . "." . $extFile;
            $path = 'hasil-assessment/' . $namaFile;
            Storage::disk('public')->put($path, file_get_contents($file));
            $validateData['file_assessment'] = $namaFile;
        }

        $assessment = Assessment::create($validateData);
        Alert::success('Berhasil', "Data Assessment $namaAnak->nama berhasil dibuat");
        return redirect("/assessment");
    }
}

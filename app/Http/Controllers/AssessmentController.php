<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Assessment;
use App\Models\Psikolog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $user = Auth::user();
        $roles = $user->getRoleNames();

        $anaks = Anak::where('status', 'aktif')->latest()->paginate(10);

        if ($roles->contains('psikolog')) {
            $psikologs = Psikolog::where('nama', $user->name)->first();
            return view('assessment.create', compact('anaks', 'psikologs', 'roles'));
        } else {
            $psikologs = Psikolog::latest()->get();
            return view('assessment.create', compact('anaks', 'psikologs', 'roles'));
        }
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

    public function edit(Assessment $assessment)
    {
        $anaks = Anak::latest()->get();
        $psikologs = Psikolog::latest()->get();
        return view('assessment.edit', compact('assessment', 'anaks', 'psikologs'));
    }

    public function update(Request $request, Assessment $assessment): RedirectResponse
    {
        $validateData = $request->validate([
            'anak_id' => 'required|exists:App\Models\Anak,id',
            'psikolog_id' => 'required|exists:App\Models\Psikolog,id',
            'file_assessment' =>  'nullable|file|mimes:pdf|max:2048',
        ]);

        $namaAnak = Anak::findorFail($request->anak_id);

        if ($request->hasFile('file_assessment')) {

            if ($assessment->file_assessment) {
                Storage::disk('public')->delete('hasil-assessment/' . $assessment->file_assessment);
            }

            $file = $request->file('file_assessment');
            $extFile = $file->getClientOriginalExtension();
            $namaFile =
                "hasil-assessment-" . $namaAnak->nama . "." . $extFile;
            $path = 'hasil-assessment/' . $namaFile;
            Storage::disk('public')->put($path, file_get_contents($file));
            $validateData['file_assessment'] = $namaFile;
        } else {
            $validatedData['file_assessment'] = $assessment->file_assessment;
        }

        $assessment->update($validateData);
        Alert::success('Berhasil', "Data Assessment berhasil di Update");
        return redirect("/assessment");
    }
    public function destroy(Assessment $assessment)
    {
        Storage::disk('public')->delete('hasil-assessment/' . $assessment->file_assessment);
        $assessment->delete();
        Alert::success('Berhasil', "Data Assessment berhasil di Hapus");
        return redirect()->back();
    }
}

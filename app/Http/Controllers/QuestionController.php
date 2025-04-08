<?php

namespace App\Http\Controllers;

use App\Models\AgeGroup;
use App\Models\Question;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class QuestionController extends Controller
{
    public function index()
    {
        $ageGroups = AgeGroup::with('questions')->get();
        return view('q-pendengaran.index', compact('ageGroups'));
    }

    public function pendengaran_store(Request $request)
    {
        $validateData = $request->validate([
            'age_group_id' => 'required|exists:App\Models\AgeGroup,id',
            'question_text' => 'required',
        ]);

        $questions = Question::create($validateData);
        Alert::success('Berhasil', "Data Question berhasil dibuat");
        return redirect()->back();
    }

    public function hapus_pendengaran(Question $id)
    {
        $id->delete();
        Alert::success('Berhasil', "questions di hapus");
        return redirect()->back();
    }

    public function umur()
    {
        $ageGroups = AgeGroup::get();
        return view('q-pendengaran.umur', compact('ageGroups'));
    }

    public function umur_store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required',
        ]);
        $ageGroups = AgeGroup::create($validateData);
        Alert::success('Berhasil', "Data umur $request->nama berhasil dibuat");
        return redirect("/q-umur");
    }

    public function hapus_umur(AgeGroup $id)
    {
        $id->delete();
        Alert::success('Berhasil', "$id->nama telah di hapus");
        return redirect()->back();
    }
}

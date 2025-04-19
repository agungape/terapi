<?php

namespace App\Http\Controllers;

use App\Models\AgeGroup;
use App\Models\Question;
use App\Models\QuestionAutis;
use App\Models\QuestionPenglihatan;
use App\Models\QuestionPerilaku;
use App\Models\QuestionResponse;
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

    public function q_penglihatan()
    {
        $penglihatan = QuestionPenglihatan::latest()->paginate(10);
        $interpretasi = [
            'normal' => 'Normal',
            'gangguan' => 'Gangguan',
        ];

        return view('q-penglihatan.index', compact('penglihatan', 'interpretasi'));
    }

    public function penglihatan_store(Request $request)
    {
        $validateData = $request->validate([
            'question_text' => 'required',
            'interpretasi' => 'required',
        ]);

        $questions = QuestionPenglihatan::create($validateData);
        Alert::success('Berhasil', "Data Question berhasil dibuat");
        return redirect()->back();
    }

    public function penglihatan_destroy(QuestionPenglihatan $id)
    {
        $id->delete();
        Alert::success('Berhasil', "questions di hapus");
        return redirect()->back();
    }

    public function q_perilaku()
    {
        $perilaku = QuestionPerilaku::get();
        return view('q-perilaku.index', compact('perilaku'));
    }

    public function perilaku_store(Request $request)
    {
        $validateData = $request->validate([
            'question_text' => 'required',
        ]);

        $questions = QuestionPerilaku::create($validateData);
        Alert::success('Berhasil', "Data Question berhasil dibuat");
        return redirect()->back();
    }

    public function perilaku_destroy(QuestionPerilaku $id)
    {
        $id->delete();
        Alert::success('Berhasil', "questions di hapus");
        return redirect()->back();
    }

    public function q_autis()
    {
        $autis = QuestionAutis::orderBy('no_urut')->get();
        return view('q-autis.index', compact('autis'));
    }

    public function autis_store(Request $request)
    {
        $validateData = $request->validate([
            'question_text' => 'required',
            'no_urut' => 'required|integer|min:1',
        ]);

        // Geser urutan setelahnya
        QuestionAutis::where('no_urut', '>=', $validateData['no_urut'])->increment('no_urut');

        $questions = QuestionAutis::create($validateData);

        Alert::success('Berhasil', "Data Question berhasil dibuat");
        return redirect()->back();
    }

    public function autis_destroy(QuestionAutis $id)
    {
        $id->delete();
        Alert::success('Berhasil', "questions di hapus");
        return redirect()->back();
    }
}

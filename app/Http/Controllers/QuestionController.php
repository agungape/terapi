<?php

namespace App\Http\Controllers;

use App\Models\AgeGroup;
use App\Models\Question;
use App\Models\QuestionAutis;
use App\Models\QuestionGpph;
use App\Models\QuestionPenglihatan;
use App\Models\QuestionPerilaku;
use App\Models\QuestionResponse;
use App\Models\QuestionWawancara;
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
        return redirect()->back()->with('success', "Data Question berhasil dibuat");
    }

    public function hapus_pendengaran(Question $id)
    {
        $id->delete();
        return redirect()->back()->with('success', "questions di hapus");
    }

    public function qpendengaran_update(Request $request, $id)
    {
        $q = Question::findOrFail($id);
        $validateData = $request->validate([
            'age_group_id' => 'required|exists:App\Models\AgeGroup,id',
            'question_text' => 'required',
        ]);
        $q->update($validateData);
        return redirect()->back()->with('success', "Data Question berhasil di Update");
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
        return redirect("/q-umur")->with('success', "Data umur $request->nama berhasil dibuat");
    }

    public function hapus_umur(AgeGroup $id)
    {
        $id->delete();
        return redirect()->back()->with('success', "$id->nama telah di hapus");
    }

    public function age_update(Request $request, $id)
    {
        $age = AgeGroup::findOrFail($id);
        $validateData = $request->validate(['nama' => 'required']);
        $age->update($validateData);
        return redirect()->back()->with('success', "Data Umur berhasil di Update");
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
        return redirect()->back()->with('success', "Data Question berhasil dibuat");
    }

    public function penglihatan_destroy(QuestionPenglihatan $id)
    {
        $id->delete();
        return redirect()->back()->with('success', "questions di hapus");
    }

    public function qpenglihatan_update(Request $request, $id)
    {
        $q = QuestionPenglihatan::findOrFail($id);
        $validateData = $request->validate([
            'question_text' => 'required',
            'interpretasi' => 'required',
        ]);
        $q->update($validateData);
        return redirect()->back()->with('success', "Data Question berhasil di Update");
    }

    public function q_perilaku()
    {
        $perilaku = QuestionPerilaku::get();
        return view('q-perilaku.index', compact('perilaku'));
    }

    public function qperilaku_update(Request $request, $id)
    {
        $qperilaku = QuestionPerilaku::where('id', $id)->first();

        $validateData = $request->validate([
            'question_text' => 'required',
        ]);

        $qperilaku->update($validateData);
        return redirect()->back()->with('success', "Data Question berhasil di Update");
    }

    public function perilaku_store(Request $request)
    {
        $validateData = $request->validate([
            'question_text' => 'required',
        ]);

        $questions = QuestionPerilaku::create($validateData);
        return redirect()->back()->with('success', "Data Question berhasil dibuat");
    }

    public function perilaku_destroy(QuestionPerilaku $id)
    {
        $id->delete();
        return redirect()->back()->with('success', "questions di hapus");
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

        return redirect()->back()->with('success', "Data Question berhasil dibuat");
    }

    public function autis_destroy(QuestionAutis $id)
    {
        $id->delete();
        return redirect()->back()->with('success', "questions di hapus");
    }

    public function qautis_update(Request $request, $id)
    {
        $q = QuestionAutis::findOrFail($id);
        $validateData = $request->validate([
            'question_text' => 'required',
            'no_urut' => 'required|integer|min:1',
        ]);
        $q->update($validateData);
        return redirect()->back()->with('success', "Data Question berhasil di Update");
    }

    public function q_gpph()
    {
        $gpph = QuestionGpph::latest()->get();
        return view('q-gpph.index', compact('gpph'));
    }

    public function gpph_store(Request $request)
    {
        $validateData = $request->validate([
            'question_text' => 'required',
        ]);

        $questions = QuestionGpph::create($validateData);

        return redirect()->back()->with('success', "Data Question berhasil dibuat");
    }

    public function gpph_destroy(QuestionGpph $id)
    {
        $id->delete();
        return redirect()->back()->with('success', "questions di hapus");
    }

    public function qgpph_update(Request $request, $id)
    {
        $qgpph = QuestionGpph::findOrFail($id);
        $validateData = $request->validate(['question_text' => 'required']);
        $qgpph->update($validateData);
        return redirect()->back()->with('success', "Data Question berhasil di Update");
    }

    public function q_wawancara()
    {
        $wawancara = QuestionWawancara::latest()->get();
        return view('q-wawancara.index', compact('wawancara'));
    }

    public function wawancara_store(Request $request)
    {
        $validateData = $request->validate([
            'question_text' => 'required',
        ]);

        $questions = QuestionWawancara::create($validateData);

        return redirect()->back()->with('success', "Data Question Wawancara berhasil dibuat");
    }

    public function wawancara_destroy(QuestionWawancara $id)
    {
        $id->delete();
        return redirect()->back()->with('success', "Questions Wawancara di hapus");
    }

    public function qwawancara_update(Request $request, $id)
    {
        $qwawancara = QuestionWawancara::findOrFail($id);
        $validateData = $request->validate(['question_text' => 'required']);
        $qwawancara->update($validateData);
        return redirect()->back()->with('success', "Data Question berhasil di Update");
    }
}

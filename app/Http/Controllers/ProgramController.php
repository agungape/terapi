<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $program = Program::orderBy('deskripsi')->paginate(5);
        return view('program.index', compact('program'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('program.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'deskripsi' => 'required',
        ]);
        $program = Program::create($validateData);
        Alert::success('Berhasil', "Data program $request->deskripsi berhasil dibuat");
        return redirect("/program#card-{$program->id}");
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        $program->delete();
        Alert::success('Berhasil', "$program->nama telah di hapus");
        return redirect("/program");
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Terapis;
use Illuminate\Http\Request;

class TerapisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $terapis = Terapis::orderBy('nib')->paginate(5);
        return view('terapis.index', ['terapis' => $terapis]);
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
    public function show(Terapis $terapis)
    {
        //
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
}

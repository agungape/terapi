<?php

namespace App\Http\Controllers;

use App\Models\Terapis;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $terapis = Terapis::all();
        return view('frontend.index', compact('terapis'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Terapis;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $terapis = Terapis::all();
        $profile = Terapis::first();
        return view('frontend.master', compact('terapis', 'profile'));
    }
}

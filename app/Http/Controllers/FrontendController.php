<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Profile;
use App\Models\Psikolog;
use App\Models\Terapis;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $terapis = Terapis::where('status', 'aktif')->get();
        $profile = Profile::first();
        $anak = Anak::all()->count();
        return view('website.index', compact('terapis', 'profile', 'anak'));
    }
    public function services()
    {
        $terapis = Terapis::all();
        $profile = Profile::first();

        return view('website.services', compact('terapis', 'profile'));
    }
    public function about()
    {
        $terapis = Terapis::orderBy('created_at', 'asc')->take(3)->get();
        $psikolog = Psikolog::orderBy('created_at', 'asc')->take(3)->get();
        $profile = Profile::first();

        return view('website.about', compact('terapis', 'profile', 'psikolog'));
    }
    public function blog()
    {
        $terapis = Terapis::all();
        $profile = Profile::first();

        return view('website.blog', compact('terapis', 'profile'));
    }
    public function contact()
    {
        $terapis = Terapis::all();
        $profile = Profile::first();

        return view('website.contact', compact('terapis', 'profile'));
    }
    public function therapists()
    {
        $terapis = Terapis::where('status', 'aktif')->paginate(3);
        $profile = Profile::first();

        return view('website.therapists', compact('terapis', 'profile'));
    }
}

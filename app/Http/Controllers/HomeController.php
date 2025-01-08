<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Barang;
use App\Models\Detail_transaksi;
use App\Models\Province;
use App\Models\Terapis;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $anak = Anak::count();
        $terapis = Terapis::count();
        $user = User::count();

        return view('home', compact('anak', 'terapis', 'user'));
    }
}

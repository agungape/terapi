<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Detail_transaksi;
use App\Models\Province;
use App\Models\Upload;
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
        // return view('')
        // $totalUpload = Upload::count();
        // $totalKonfirm = Upload::where('status_konfirmasi', 'Confirmed')->count();
        // $totalPending = Upload::where('status_konfirmasi', 'Pending')->count();
        // $totalRejected = Upload::where('status_konfirmasi', 'Rejected')->count();
        return view('home');
    }
}

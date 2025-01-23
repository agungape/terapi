<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view profile', ['only' => ['index']]);
        $this->middleware('permission:create profile', ['only' => ['store', 'update']]);
    }

    public function index()
    {
        $profile = Profile::first();
        return view('profile.index', compact('profile'));
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
        $validateData = $request->validate([
            'nama' => 'required',
            'nama_apk' => 'required',
            'email' => 'nullable|email',
            'alamat' => 'required',
            'telepon' => 'required',
            'ketua' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = $request->file('logo');
        $extFile = $file->getClientOriginalExtension();
        $namaFile =
            "logo-" . time() . "." . $extFile;
        $path = 'logo/' . $namaFile;
        Storage::disk('public')->put($path, file_get_contents($file));

        $data['nama'] = $request->nama;
        $data['nama_apk'] = $request->nama_apk;
        $data['alamat'] = $request->alamat;
        $data['telepon'] = $request->telepon;
        $data['email'] = $request->email;
        $data['ketua'] = $request->ketua;
        $data['logo'] = $namaFile;


        $profile = Profile::create($data);
        Alert::toast("data Profile $request->nama berhasil di Perbaharui", 'success')->timerProgressBar();
        // Trik agar halaman kembali ke halaman asal
        return redirect("/profile");
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $validateData = $request->validate([
            'nama' => 'required',
            'nama_apk' => 'required',
            'email' => 'nullable|email',
            'alamat' => 'required',
            'telepon' => 'required',
            'ketua' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $data['nama'] = $request->nama;
        $data['nama_apk'] = $request->nama_apk;
        $data['alamat'] = $request->alamat;
        $data['telepon'] = $request->telepon;
        $data['email'] = $request->email;
        $data['ketua'] = $request->ketua;

        if ($request->file('logo')) {
            $file = $request->file('logo');
            $extFile = $file->getClientOriginalExtension();
            $namaFile =
                "logo-" . time() . "." . $extFile;
            $path = 'logo/' . $namaFile;
            Storage::disk('public')->put($path, file_get_contents($file));

            Storage::delete('public/logo/' . $profile->logo);

            $data['logo'] = $namaFile;
        }

        $profile->update($data);
        Alert::toast("data Profile $request->nama berhasil di Perbaharui", 'success');
        // Trik agar halaman kembali ke halaman asal
        return redirect("/profile");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Terapis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserAnakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = [
            'Admin' => 'Admin',
            'Terapis' => 'Terapis',
            'Anak' => 'Anak'
        ];
        $users = User::whereNotIn('role', ['Admin', 'Terapis'])->paginate(10);
        $anaks = Anak::orderBy('nama')->get();
        return view('userAnak.index', compact('users', 'anaks', 'role'));
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
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required',
        ]);

        $hashedPassword = Hash::make($request->password);
        $email = strtolower($request->username) . '@bright.com';

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => $request->role,
        ]);
        Alert::toast('data user berhasil di tambahkan', 'success')->timerProgressBar();
        return redirect()->route('useranak.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name_edit' => 'required|string|max:255|unique:users,name,' . $id,
            'username_edit' => 'required|string|max:255|unique:users,username,' . $id,
            'password_edit' => 'nullable|min:8|confirmed', // Password opsional saat edit
            'role_edit' => 'required',
        ]);

        // Mencari user berdasarkan ID
        $user = User::find($id);
        $user->name = $request->name_edit;
        $user->username = $request->username_edit;
        $user->role = $request->role_edit;

        // Jika password diisi, update password
        if ($request->filled('password_edit')) {
            $user->password = Hash::make($request->password_edit);
        }

        $user->save();

        Alert::toast('data user berhasil di perbarui', 'success')->timerProgressBar();
        return redirect()->route('useranak.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $useranak)
    {
        $useranak->delete();
        Alert::success('Berhasil', "data $useranak->name telah di hapus")->timerProgressBar();
        return redirect()->route('useranak.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Terapis;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
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
        $users = User::orderBy('role', 'ASC')->paginate(10);

        foreach ($users as $user) {
            if ($user->last_login) {
                $user->last_login_duration = Carbon::parse($user->last_login)->diffForHumans();
            } else {
                $user->last_login_duration = 'Never logged in';
            }
        }
        $terapis = Terapis::orderBy('nama')->get();
        return view('user.index', compact('users', 'terapis', 'role'));
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
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required',
        ]);

        $hashedPassword = Hash::make($request->password);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $hashedPassword,
            'role' => $request->role,
        ]);
        Alert::toast('data user berhasil di tambahkan', 'success')->timerProgressBar();
        return redirect()->route('user.index');
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
        $request->validate([
            'name_edit' => 'required|string|max:255|unique:users,name,' . $id,
            'username_edit' => 'required|string|max:255|unique:users,username,' . $id,
            'email_edit' => 'required|string|email|unique:users,email,' . $id,
            'password_edit' => 'nullable|min:8|confirmed', // Password opsional saat edit
            'role_edit' => 'required',
        ]);

        // Mencari user berdasarkan ID
        $user = User::find($id);
        $user->name = $request->name_edit;
        $user->email = $request->email_edit;
        $user->username = $request->username_edit;
        $user->role = $request->role_edit;

        // Jika password diisi, update password
        if ($request->filled('password_edit')) {
            $user->password = Hash::make($request->password_edit);
        }

        $user->save();

        Alert::toast('data user berhasil di perbarui', 'success')->timerProgressBar();
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        Alert::success('Berhasil', "data $user->name telah di hapus")->timerProgressBar();
        return redirect()->route('user.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Terapis;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view user', ['only' => ['index']]);
        $this->middleware('permission:create user', ['only' => ['create', 'store']]);
        $this->middleware('permission:update user', ['only' => ['update', 'edit']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }

    public function index()
    {
        $users = User::latest()->paginate(10);
        $terapis = Terapis::orderBy('nama')->get();
        $anaks = Anak::orderBy('nama')->get();
        $roles = Role::pluck('name', 'name')->all();
        foreach ($users as $user) {
            if ($user->last_login) {
                $user->last_login_duration = Carbon::parse($user->last_login)->diffForHumans();
            } else {
                $user->last_login_duration = 'Never logged in';
            }
        }
        return view('role-permission.user.index', ['users' => $users, 'roles' => $roles, 'anaks' => $anaks, 'terapis' => $terapis]);
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('role-permission.user.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required',
        ]);

        $hashedPassword = Hash::make($request->password);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $hashedPassword,
        ]);

        $user->syncRoles($request->roles);

        Alert::toast('data user berhasil di tambahkan', 'success')->timerProgressBar();
        return redirect('/users');
    }

    public function store_anak(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required',
        ]);

        $hashedPassword = Hash::make($request->password);
        $email = strtolower($request->name) . '@bright.com';

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $email,
            'password' => $hashedPassword,
        ]);

        $user->syncRoles($request->roles);

        Alert::toast('data user berhasil di tambahkan', 'success')->timerProgressBar();
        return redirect('/users');
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
        return view('role-permission.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'roles' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'email' => $request->email,
        ];

        if (!empty($request->password)) {
            $data += [
                'password' => Hash::make($request->password),
            ];
        }

        $user->update($data);
        $user->syncRoles($request->roles);
        Alert::toast('data user berhasil di perbarui', 'success')->timerProgressBar();
        return redirect('/users');
    }

    public function destroy($user)
    {
        $user = User::findOrFail($user);
        $user->delete();

        Alert::success('Berhasil', "Data User berhasil dihapus");
        return redirect('/users');
    }
}

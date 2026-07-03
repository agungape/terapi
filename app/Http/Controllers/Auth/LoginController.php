<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected $username = 'username';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function showLoginForm(Request $request)
    {
        $request->session()->put('view', 'admin');
        return view('auth.login');
    }


    protected function authenticated(Request $request, $user)
    {
        // Fitur Smart Login: arahkan pengguna ke tempat yang benar berdasarkan hak aksesnya (role)
        // terlepas dari halaman login mana (mobile/web) yang mereka gunakan.
        if ($user->hasRole('anak')) {
            return redirect()->route('app');
        }

        // Return null agar Laravel secara otomatis mengarahkan admin/staff ke halaman 
        // yang mereka tuju sebelumnya (intended URL) atau ke halaman Home default.
        return null;
    }

    public function logout(Request $request)
    {
        $user = auth()->user();
        $roles = $user ? $user->getRoleNames() : collect();

        $this->guard()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->forget('view');

        if ($roles->contains('anak')) {
            return redirect('/mobile');
        }
        return redirect('/login');
    }
}

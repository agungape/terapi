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

    public function logout(Request $request)
    {
        $user = auth()->user();
        $roles = $user->getRoleNames();
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($roles->contains('anak')) {
            return redirect('/mobile'); // Redirect ke login admin
        } else {
            return redirect('/login'); // Redirect ke login anak
        }

        // Default redirect jika tidak ada user (fallback)
        return redirect('/');
    }

    protected function authenticated(Request $request, $user)
    {
        // Ambil tampilan yang sedang digunakan dari session atau URL
        $view = $request->session()->get('view', 'admin');
        // Jika pengguna login dari tampilan mobile (anak)
        if ($view === 'anak') {
            if (!$user->hasRole('anak')) {
                // Jika bukan anak, logout dan kembali ke login mobile
                Auth::logout();
                // Alert::toast('', 'error');
                return redirect()->route('mobile.login')->with('error', 'Anda tidak memiliki akses ke tampilan Mobile.');
            }
            return redirect()->route('app');
        }

        // Jika pengguna login dari tampilan admin
        if ($view === 'admin' || $view === null) {
            if ($user->hasRole('anak')) {
                // Jika anak mencoba login ke tampilan admin, logout dan kembali ke login admin
                Auth::logout();
                Alert::toast('Anda tidak memiliki akses ke tampilan Website.', 'error');
                return redirect()->route('login');
            }
            return redirect(RouteServiceProvider::HOME);
        }

        // Default redirect jika tidak ada tampilan yang sesuai
        return redirect(RouteServiceProvider::HOME);
    }
}

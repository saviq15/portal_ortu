<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            switch ($user->role) {
                case 'admin':
                    return redirect()->intended('/admin/dashboard');
                case 'guru':
                case 'wali_kelas':
                    return redirect()->intended('/guru/dashboard');
                case 'pihak_yayasan':
                    return redirect()->intended('/tu/dashboard');
                case 'orang_tua':
                    return redirect()->intended('/wali/dashboard');
                default:
                    Auth::logout();
                    return redirect('/login')->withErrors(['username' => 'Role pengguna tidak valid.']);
            }
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

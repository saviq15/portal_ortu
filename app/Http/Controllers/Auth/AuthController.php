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
            'email' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            $redirectUrl = $this->getDashboardRoute($user->role);

            if (!$redirectUrl) {
                Auth::logout();
                return redirect('/login')->withErrors(['email' => 'Role pengguna tidak valid.']);
            }

            return redirect()->intended($redirectUrl);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Mapping rute dashboard berdasarkan role user.
     */
    protected function getDashboardRoute(string $role): ?string
    {
        return match ($role) {
            'admin' => '/admin/dashboard',
            'guru', 'wali_kelas' => '/guru/dashboard',
            'pihak_yayasan' => '/tu/dashboard',
            'orang_tua' => '/wali/dashboard',
            default => null,
        };
    }
}
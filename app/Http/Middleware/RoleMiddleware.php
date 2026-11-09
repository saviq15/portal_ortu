<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Jika role user diizinkan, lanjutkan request
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Redirect ke dashboard masing-masing jika tidak memiliki hak akses
        $redirectUrl = $this->getDashboardRoute($user->role);

        if (!$redirectUrl) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['email' => 'Role tidak dikenal. Akses ditolak.']);
        }

        return redirect($redirectUrl)->with('error', 'Anda tidak memiliki hak akses ke halaman tersebut.');
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
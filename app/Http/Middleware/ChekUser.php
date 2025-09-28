<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ChekUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek 1: Apakah user sudah login?
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Cek 2: Apakah rolenya adalah 'user'?
        if ($user->role !== 'user') {
            // Jika bukan user (misal: admin mencoba akses halaman user), tolak.
            abort(403, 'AKSES DITOLAK');
        }

        // =================================================================
        // === LOGIKA BARU: CEK KELENGKAPAN BIODATA (PENANDA: NIK) ===
        // =================================================================

        // Eager load relasi biodata untuk efisiensi
        $user->load('biodata');
        $biodataLengkap = $user->biodata && $user->biodata->nik;

        // Jika biodata TIDAK LENGKAP
        if (!$biodataLengkap) {
            // Beri PENGECUALIAN agar user tetap bisa mengakses halaman profilnya sendiri
            // dan tombol logout. Tanpa ini, akan terjadi redirect loop.
            if ($request->routeIs('UserProfile.*') || $request->routeIs('auth.logout')) {
                return $next($request); // Izinkan akses
            }
            
            // Jika user mencoba akses halaman lain, paksa redirect ke halaman profil
            return redirect()->route('UserProfile.index')
                   ->with('warning', 'Harap lengkapi biodata Anda terlebih dahulu sebelum dapat menggunakan layanan lain.');
        }
        
        // Jika semua pengecekan lolos (login, role user, dan biodata lengkap), izinkan akses.
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            // Jika tidak login, arahkan ke halaman login
            return redirect()->route('login'); // Ganti 'login' dengan nama rute login Anda
        }

        // Asumsi model User Anda memiliki kolom 'is_admin' (boolean)
        // Atau Anda memiliki relasi peran, dll.
        // Sesuaikan logika ini dengan cara Anda mengelola peran admin.
        if (Auth::user()->is_admin) { // Contoh: memeriksa kolom is_admin di tabel users
            return $next($request); // Lanjutkan permintaan jika pengguna adalah admin
        }

        // Jika pengguna login tetapi bukan admin, arahkan ke halaman yang tidak diizinkan
        // Atau kembali ke halaman sebelumnya dengan pesan error
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Pastikan ini diimpor untuk model User
use Illuminate\Support\Facades\Hash; // Pastikan ini diimpor untuk hashing password
use Illuminate\Validation\ValidationException; // Untuk penanganan error validasi
use App\UserRole; // IMPORT INI: Pastikan path ini benar sesuai lokasi enum Anda

class AuthController extends Controller
{
    // render login form
    public function login()
    {
        return view('login'); // Menggunakan 'login' sesuai dengan kode Anda
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Get the authenticated user
            $user = Auth::user();

            // Check if the user is an admin using the 'role' enum value
            // Pastikan 'Admin' adalah case yang benar di enum App\UserRole
            if ($user->role === UserRole::Admin->value) {
                return redirect()->intended(route('admin.dashboard')); // Redirect to admin dashboard
            }

            // If not an admin, redirect to the default intended page or homepage
            return redirect()->intended('/'); // Redirect to homepage for non-admins
        }

        // If authentication fails, redirect back with an error message
        return back()->withErrors([
            'login' => 'Invalid credentials', // Menggunakan 'login' sesuai dengan kode Anda
        ])->onlyInput('email'); // Tetap hanya input email yang di-flash
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // --- Metode Baru untuk Registrasi ---

    /**
     * Menampilkan form pendaftaran.
     *
     * @return \Illuminate\View\View
     */
    public function registerForm()
    {
        // Asumsi Anda memiliki view 'register.blade.php' di folder 'resources/views'
        return view('register');
    }

    /**
     * Memproses permintaan pendaftaran pengguna baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request): RedirectResponse
    {
        // Validasi data input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // 'confirmed' akan mencari field 'password_confirmation'
        ]);

        // Buat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password sebelum menyimpan
            // Menggunakan nilai dari enum untuk role default
            // Pastikan 'Member' adalah case yang benar di enum App\UserRole untuk pengguna biasa
            'role' => UserRole::Member->value, // Default to 'Member' role for new registrations
        ]);

        // Opsional: Loginkan pengguna secara otomatis setelah pendaftaran berhasil
        Auth::login($user);

        // Redirect ke halaman utama atau halaman lain setelah pendaftaran
        return redirect()->intended('/');
    }
}

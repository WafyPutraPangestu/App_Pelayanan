<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerStore(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'nomor_telepon' => 'nullable|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::create([
            'name' => $request->name,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user',
            'aktif' => true,
        ]);
        
        return redirect()->route('guest.auth.login')->with('success', 'Registration successful!');
    }
    public function login()
    {
        return view('auth.login');
    }
    public function loginStore(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user(); // Ambil data user yang baru saja login

            // Cek role user
            if ($user->role === 'admin') {
                // Jika admin, arahkan ke dashboard admin
                return redirect()->route('dashboard')->with('success', 'Selamat datang kembali, Admin!');
            } else {
                // Jika bukan admin (berarti user biasa), arahkan ke dashboard user
                return redirect()->route('UserDashboard.index')->with('success', 'Login berhasil!');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}

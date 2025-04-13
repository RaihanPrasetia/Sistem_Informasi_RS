<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Pastikan model User diimpor

class AuthController extends Controller
{
    /**
     * Display the login form.
     */
    public function index()
    {
        return view('auth.login'); // Menampilkan halaman login
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cari user berdasarkan username
        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Jika username dan password cocok
            Auth::login($user); // Login user
            $request->session()->regenerate(); // Regenerasi session
            return redirect()->route('dashboard.index'); // Arahkan ke dashboard
        }

        // Jika gagal login
        return back()->withErrors([
            'Error' => 'Username atau password salah.',
        ])->onlyInput('username');
    }
}

<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\User;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;

// class AuthController extends Controller
// {
//     // Menampilkan form registrasi
//     public function showRegisterForm()
//     {
//         return view('auth.register');
//     }

//     // Proses registrasi pengguna
//     public function register(Request $request)
// {
//     $request->validate([
//         'name' => 'required|string|max:255',
//         'email' => 'required|string|email|max:255|unique:users',
//         'password' => 'required|string|min:6|confirmed',
//     ]);

//     // Simpan user dengan status belum diverifikasi
//     $user = User::create([
//         'name' => $request->name,
//         'email' => $request->email,
//         'password' => Hash::make($request->password),
//         'is_verified' => false, // user belum diverifikasi
//     ]);

//     // Tidak langsung login
//     return redirect()->route('login')->with('success', 'Registrasi berhasil! Tunggu verifikasi admin.');
// }


//     // Menampilkan form login
//     public function showLoginForm()
//     {
//         return view('auth.login');
//     }

//     // Proses login pengguna
//     public function login(Request $request)
//     {
//         $credentials = $request->only('email', 'password');
    
//         if (Auth::attempt($credentials)) {
//             $user = Auth::user();
    
//             if ($user->role === 'kasir' && $user->status !== 'verified') {
//                 Auth::logout();
//                 return redirect()->back()->withErrors(['email' => 'Akun Anda belum diverifikasi admin.']);
//             }
    
//             return redirect()->intended('/home');
//         }
    
//         return redirect()->back()->withErrors(['email' => 'Email atau password salah.']);
//     }    

//     // Proses logout pengguna
//     public function logout(Request $request)
//     {
//         Auth::logout();

//         // Hapus sesi dan set pesan logout sukses
//         $request->session()->invalidate();
//         $request->session()->regenerateToken();

//         return redirect()->route('home')->with('success', 'Anda telah logout.');
//     }
// }


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan form registrasi
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses registrasi pengguna
    public function register(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Simpan ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Login otomatis setelah register
        Auth::login($user);

        // Redirect ke halaman dashboard atau home dengan pesan sukses
        return redirect()->route('home')->with('success', 'Registrasi berhasil! Selamat datang, ' . Auth::user()->name);
    }

    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login pengguna
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Simpan pesan sukses di session
        return redirect()->route('dashboard')->with('success', 'Anda berhasil login!');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
}


    // Proses logout pengguna
    public function logout(Request $request)
    {
        Auth::logout();

        // Hapus sesi dan set pesan logout sukses
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Anda telah logout.');
    }
}


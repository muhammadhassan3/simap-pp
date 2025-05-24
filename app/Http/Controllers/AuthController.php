<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
         $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = User::where('email', $request->email)->first();
            Auth::login($user);
            return redirect('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Logout user
        public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect()->route('login');
    }


    // Menampilkan data user yang sedang login
    public function profile()
    {
        $user = Auth::user();
        return view('auth.profilemanagement', compact('user'));
    }

    // Update data user yang sedang login
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $pengguna = User::find($user->id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
        ]);
        $pengguna->username = $request->name;
        $pengguna->email = $request->email;

        $pengguna->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

     // Update password hanya jika password lama benar
    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $pengguna = User::find($user->id);

        // Validasi input
        $request->validate([
            'currentpassword' => ['required'],
            'newpassword' => ['required', 'confirmed'],
        ]);
        // Cek apakah password lama cocok dengan yang ada di database
        if (!Hash::check($request->currentpassword, $pengguna->password)) {
            return back()->withErrors(['currentpassword' => 'Password lama tidak sesuai.']);
        }

        // Update password baru jika valid
        $pengguna->password = Hash::make($request->newpassword);
        $pengguna->save();

        return redirect()->back()->with('success', 'Password berhasil diperbarui!');
    }

    // Hapus akun user yang sedang login dan logout otomatis
    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            Auth::logout(); // Logout user sebelum dihapus
            $user->delete(); // Hapus user dari database

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/')->with('success', 'Akun Anda telah dihapus.');
        }

        return redirect()->back()->with('error', 'Gagal menghapus akun.');
    }





}



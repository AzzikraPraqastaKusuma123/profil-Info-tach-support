<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        if (session()->has('admin_id')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        // SECURITY: Always run Hash::check() even if admin not found
        // This prevents timing attacks (attacker can't detect valid usernames by response time)
        $passwordToCheck = $admin ? $admin->password : '$2y$12$nO4D3Q1gO5b6oF7e8r9t0uP1q2w3e4r5t6y7u8i9o0p1q2w3e4r5t';
        $passwordValid = Hash::check($request->password, $passwordToCheck);

        if ($admin && $passwordValid) {
            // Update last login timestamp
            $admin->update(['last_login_at' => now()]);

            $request->session()->regenerate();
            session([
                'admin_id'       => $admin->id,
                'admin_name'     => $admin->name,
                'admin_username' => $admin->username
            ]);
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang kembali, ' . $admin->name);
        }

        return back()->withErrors(['login' => 'Username atau Password salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        if (session()->has('admin_id')) {
            Admin::where('id', session('admin_id'))->update(['last_logout_at' => now()]);
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'Anda telah berhasil keluar.');
    }
}

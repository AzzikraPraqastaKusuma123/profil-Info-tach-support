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
        $passwordToCheck = $admin ? $admin->password : '$2y$12$dummyhashpaddingtomakeconstanttime....................';
        $passwordValid = Hash::check($request->password, $passwordToCheck);

        if ($admin && $passwordValid) {
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
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'Anda telah berhasil keluar.');
    }
}

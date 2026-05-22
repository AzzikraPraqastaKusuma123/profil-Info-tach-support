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
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            session([
                'admin_id' => $admin->id,
                'admin_name' => $admin->name,
                'admin_username' => $admin->username
            ]);
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang kembali, ' . $admin->name);
        }

        return back()->withErrors(['login' => 'Username atau Password salah.'])->withInput();
    }

    public function logout()
    {
        session()->forget(['admin_id', 'admin_name', 'admin_username']);
        return redirect()->route('admin.login')->with('success', 'Anda telah berhasil keluar.');
    }
}

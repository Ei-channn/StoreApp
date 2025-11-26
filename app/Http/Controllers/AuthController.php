<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);

        // set session
        session([
            'user_id' => $user->id,
            'user_role' => $user->role,
            'user_name' => $user->name,
        ]);

        return redirect()->route('user.index')->with('success', 'Registrasi berhasil.');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return redirect()->back()->with('error', 'Email atau password salah.');
        }

        session([
            'user_id' => $user->id,
            'user_role' => $user->role,
            'user_name' => $user->name,
        ]);

        if ($user->role === 'admin') {
            return redirect()->route('admin.index');
        }

        return redirect()->route('user.index');
    }

    public function logout(Request $request)
    {
        session()->forget(['user_id', 'user_role', 'user_name']);
        return redirect()->route('login')->with('success', 'Logout berhasil.');
    }
}

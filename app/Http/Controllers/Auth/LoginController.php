<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect(route('logout'));
        }
        return view('auth.Login');
    }

    public function loginProcess(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'min:3', 'max:20'],
            'password' => ['required', 'min:5', 'max:20'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect(route('task.index'));
        }

        return back()->with('status', 'Username atau password tidak ditemukan');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('login'))->with('status', 'Anda telah berhasil logout');
    }
}

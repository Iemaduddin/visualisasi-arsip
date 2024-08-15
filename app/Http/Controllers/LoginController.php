<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);

        if (
            Auth::attempt(['email' => $credentials['login'], 'password' => $credentials['password']]) ||
            Auth::attempt(['username' => $credentials['login'], 'password' => $credentials['password']])
        ) {
            $request->session()->regenerate();
            if ($request->has('rememberMe')) {
                Cookie::queue('userUsername', $request->input('login'), 1440); // Gunakan 'login' di sini
                Cookie::queue('userPassword', $request->input('password'), 1440);
            }
            $user = auth()->user()->role_id;
            if ($user == 1) {
                return redirect()->route('dashboard_admin');
            } else {
                return redirect()->route('dashboard_operator');
            }
        }
        return back()->withErrors([
            'login' => 'Username/Email atau Password Anda Salah!',
        ])->withInput();
    }



    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

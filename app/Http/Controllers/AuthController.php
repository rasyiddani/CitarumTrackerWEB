<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|string',
        ]);

        try {
            Auth::attempt([
                'username'  => $request->username,
                'password'  => $request->password,
            ]);

            if (Auth::check()) {
                return redirect()->to('/');
            } else {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['error' => 'Password Salah']);
            }
        } catch (AuthException $e) {
            Log::error($e);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Kredensial Tidak ditemukan']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->to('/auth/login');
    }
}

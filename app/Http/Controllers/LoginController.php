<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt([
            'name' => $credentials['username'],
            'password' => $credentials['password'],
        ])) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->hasRole('ADMIN')) {
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('auth.login');
            } else {
                return redirect()->route('home');
            }
        }

        return back()->withErrors([
            'username' => 'Username tidak ditemukan',
        ])->onlyInput('username');
    }
}

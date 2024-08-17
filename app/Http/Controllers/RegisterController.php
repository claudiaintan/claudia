<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        if ($user->pelanggan()->create(['alamat' => $data['alamat'], 'no_telp' => $data['no_telp']])) {
            return redirect()->route('auth.login')->with('message', 'Berhasil register, silahkan login');
        }

        return redirect()->back()->withErrors(['registrasi gagal']);
    }
}

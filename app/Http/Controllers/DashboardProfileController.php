<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileAdminRequest;
use App\Models\User;
use App\Services\RajaOngkirService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardProfileController extends Controller
{
    public function edit()
    {
        return view('dashboard.profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileAdminRequest $request)
    {
        $data = $request->validated();
        $id = Auth::id();
        $user = User::find($id);
        $user->update([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => $data['password'] ? Hash::make($data['password']) : $user->password,
        ]);
        if ($user) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            Auth::login($user);
            return redirect()->back()->with('message', 'Data Berhasil di update');
        }

        return redirect()->back()->withErrors(["Data gagal ditambah!"]);
    }
}

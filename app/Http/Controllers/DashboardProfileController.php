<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileAdminRequest;
use Illuminate\Http\Request;

class DashboardProfileController extends Controller
{
    public function edit()
    {
        return view('dashboard.profile.edit', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileAdminRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();
        $user->fill($data);
        if ($user->save()) {
            $request->session()->invalidate();
            $request->session()->regenerate();
            return redirect()->back()->with('message', 'Data Berhasil di update');
        }

        return redirect()->back()->withErrors(["Data gagal ditambah!"]);
    }
}

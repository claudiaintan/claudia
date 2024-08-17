<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Http\Requests\StorePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;
use App\Models\User;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('master.pelanggan.index', [
            'user' => User::has('pelanggan')->with('pelanggan')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePelangganRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['nama'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        if (!$user) {
            return redirect()->back()->withErrors(['User gagal dibuat!']);
        }

        $pelanggan = $user->pelanggan()->create([
            'alamat' => $data['alamat'],
            'no_telp' => $data['no_telp'],
        ]);

        if (!$pelanggan) {
            return redirect()->back()->withErrors(['Pelanggan gagal dibuat!']);
        }

        return redirect()->back()->with('message', 'Pelanggan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $pelanggan)
    {
        $pelanggan->load('pelanggan');
        return view('master.pelanggan.edit', [
            'user' => $pelanggan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePelangganRequest $request, User $pelanggan)
    {
        $data = $request->validated();

        $pelanggan->load('pelanggan');
        $pelanggan->fill([
            'name' => $data['nama'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $pelanggan->pelanggan->fill([
            'alamat' => $data['alamat'],
            'no_telp' => $data['no_telp'],
        ]);

        if ($pelanggan->save() && $pelanggan->pelanggan->save()) {
            return redirect()->back()->with('message', 'Pelanggan berhasil diedit!');
        }

        return redirect()->back()->withErrors(['Pelanggan gagal diedit!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $pelanggan)
    {
        if (User::destroy($pelanggan->id)) {
            return redirect()->back()->with('message', 'Data berhasil dihapus!');
        }

        return redirect()->back()->with('message', 'Data gagal dihapus!');
    }
}

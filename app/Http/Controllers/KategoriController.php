<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('master.kategori.index', [
            'kategori' => Kategori::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKategoriRequest $request)
    {
        $data = $request->validated();
        if (Kategori::create($data)) {
            return redirect()->route('master.kategori.index')->with('message', 'Data berhasil ditambah!');
        }
        return redirect()->back()->withErrors(["Data gagal ditambah!"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        $produk = Produk::where('kategori_id', $kategori->id)->paginate(12);
        return view('kategori.show', compact('kategori', 'produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view('master.kategori.edit', [
            'kategori' => $kategori,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriRequest $request, Kategori $kategori)
    {
        $data = $request->validated();
        $kategori->fill($data);
        if ($kategori->save()) {
            return redirect()->route('master.kategori.index')->with('message', 'Data berhasil diupdate!');
        }
        return redirect()->back()->withErrors(["Data gagal diupdate!"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        try {
            $kategori->delete();
            return redirect()->back()->with('message', 'data berhasil dihapus dari kategori');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['Gagal menghapus data dari kategori']);
        }
    }
}

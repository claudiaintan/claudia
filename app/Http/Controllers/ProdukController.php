<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('master.produk.index', [
            'produk' => Produk::with('kategori')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.produk.create', [
            'kategori' => Kategori::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProdukRequest $request)
    {
        $data = $request->validated();
        $data['harga'] = intval(str_replace('.', '', $data['harga']));
        $data['gambar'] = $request->file('gambar')->storePublicly('public/produk');
        $data['gambar'] = str_replace('public/', 'storage/', $data['gambar']);
        if (Produk::create($data)) {
            return redirect()->route('master.produk.index')->with('message', 'Data berhasil ditambah!');
        }
        return redirect()->back()->withErrors(["Data gagal ditambah!"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        return view('master.produk.edit', [
            'produk' => $produk,
            'kategori' => Kategori::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProdukRequest $request, Produk $produk)
    {
        $data = $request->validated();
        $data['harga'] = intval(str_replace('.', '', $data['harga']));

        $data['gambar'] = $request->file('gambar')->storePublicly('public/produk');
        $data['gambar'] = str_replace('public/', 'storage/', $data['gambar']);
        $produk->fill($data);

        if ($produk->save()) {
            return redirect()->route('master.produk.index')->with('message', 'Data berhasil disimpan!');
        }
        return redirect()->back()->withErrors(["Data gagal disimpan!"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        try {
            $produk->delete();
            return redirect()->back()->with('message', 'Item berhasil dihapus dari produk');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['Gagal menghapus item dari produk']);
        }
    }
}

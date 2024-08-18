<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class TampilProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = strtoupper($request->search);
        $produk = Produk::whereRaw('nama LIKE ?', ["%".$search."%"])
            ->orWhereHas('kategori', function ($q) use ($search) {
                $q->whereRaw('nama LIKE ?', ["%".$search."%"]);
            })
            ->paginate(5);
        return view('produk.index', [
            'produk' => $produk,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        $produk->load('kategori');
        return view('produk.show', [
            'produk' => $produk,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function byKategori($kategoriId)
        {
            $kategori = Kategori::findOrFail($kategoriId);
            $produk = Produk::where('kategori_id', $kategoriId)->paginate(10);

            return view('kategori.index', [
                'kategori' => $kategori,
                'produk' => $produk
            ]);
        }
}

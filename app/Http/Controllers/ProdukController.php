<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Inisialisasi query produk dengan eager loading kategori
        $query = Produk::with('kategori');

        // Cek apakah ada parameter sorting dari request
        if ($request->has('sort_by') && $request->has('sort_order')) {
            $sortBy = $request->input('sort_by');
            $sortOrder = $request->input('sort_order');

            // Sorting berdasarkan kolom yang dipilih
            $query->orderBy($sortBy, $sortOrder);
        }

        // Paginate hasil query dengan 10 item per halaman
        $produk = $query->paginate(10);

        // Kembalikan view dengan data produk yang telah diurutkan dan dipaginate
        return view('master.produk.index', [
            'produk' => $produk,
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
    
        if (isset($data['harga'])) {
            $data['harga'] = intval(str_replace('.', '', $data['harga']));
        }
    
        if (isset($data['stok'])) {
            $data['stok'] = intval(str_replace('.', '', $data['stok']));
        }
    
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->storePublicly('public/produk');
            $data['gambar'] = str_replace('public/', 'storage/', $data['gambar']);
        } else {
            $data['gambar'] = null; 
        }
    
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
        $data['stok'] = intval(str_replace('.', '', $data['stok']));
    
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->storePublicly('public/produk');
            $data['gambar'] = str_replace('public/', 'storage/', $data['gambar']);
        } else {
            $data['gambar'] = $produk->gambar;
        }
    
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

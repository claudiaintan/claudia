<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Http\Requests\StoreKeranjangRequest;
use App\Http\Requests\UpdateKeranjangRequest;
use App\Models\Ongkir;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keranjang = auth()->user()->pelanggan->keranjang()->with('produk')->paginate(10);
        $total = $keranjang->reduce(function ($total, $item) {
            return $item->jumlah * $item->produk->harga + $total;
        }, 0);
        $bobot = $keranjang->reduce(function ($total, $item) {
            return $item->jumlah * $item->produk->bobot + $total;
        }, 0);

        return view('pelanggan.keranjang.index', [
            'keranjang' => $keranjang,
            'total' => $total,
            'bobot' => $bobot,
            'ongkir' => Ongkir::all(),
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
    public function store(StoreKeranjangRequest $request)
    {
        $data = $request->validated();
        $data['file'] = $request->file('file')->storePublicly('public/file');
        $data['file'] = str_replace('public/', 'storage/', $data['file']);
        if (auth()->user()->pelanggan->keranjang()->create($data)) {
            return redirect()->back()->with('message', 'Berhasil masuk keranjang');
        }
        return redirect()->back()->withErrors(["Gagal masuk keranjang"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Keranjang $keranjang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keranjang $keranjang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKeranjangRequest $request, Keranjang $keranjang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keranjang $keranjang)
    {
        //
    }
}

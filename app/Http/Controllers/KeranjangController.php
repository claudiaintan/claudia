<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Http\Requests\StoreKeranjangRequest;
use App\Http\Requests\UpdateKeranjangRequest;
use App\Models\Ongkir;
use App\Models\Produk;
use App\Services\RajaOngkirService;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    protected $rajaOngkirService;

    public function __construct(RajaOngkirService $rajaOngkirService)
    {
        $this->rajaOngkirService = $rajaOngkirService;
    }
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

        $city_id = Auth::user()->pelanggan->city_id;
        $city = $this->rajaOngkirService->getCity($city_id);
        $city = $city['rajaongkir']['results'];
        return view('pelanggan.keranjang.index', [
            'keranjang' => $keranjang,
            'total' => $total,
            'bobot' => $bobot,
            'ongkir' => Ongkir::all(),
            'city'  => $city,
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

        $produk = Produk::findOrFail($data['produk_id']);

        if ($data['jumlah'] > $produk->stok) {
            return redirect()->back()->withErrors(["jumlah" => "Jumlah pembelian melebihi stok yang tersedia!"]);
        }

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->storePublicly('public/file');
            $data['file'] = str_replace('public/', 'storage/', $data['file']);
        } else {
            $data['file'] = null; // Set file ke null jika tidak ada file yang diupload
        }

        if (auth()->user()->pelanggan->keranjang()->create($data)) {
            // Kurangi stok produk
            $produk->stok -= $data['jumlah'];
            $produk->save();

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


    public function destroy(keranjang $keranjang)
    {
        if (keranjang::destroy($keranjang->id)) {
            return redirect()->back()->with('message', 'Data berhasil dihapus!');
        }

        return redirect()->back()->with('message', 'Data gagal dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\User;
use App\Services\RajaOngkirService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    protected $rajaOngkirService;

    public function __construct(RajaOngkirService $rajaOngkirService)
    {
        $this->rajaOngkirService = $rajaOngkirService;
    }

    public function edit(string $id)
    {
        $user = User::find($id);
        $provinces = $this->rajaOngkirService->getProvinces();
        $provinces = $provinces['rajaongkir']['results'];
        return view('dashboard.profile.edit', compact('user', 'provinces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = User::find($request->user_id);
        $pelanggan = Pelanggan::where('user_id', $user->id);
        $pelanggan->update([
            'province_id'   => $request->province_id,
            'city_id'       => $request->city_id,
            'alamat'        => $request->alamat,
            'no_telp'       => $request->no_telp,
        ]);

        if ($pelanggan) {
            $request->session()->invalidate();
            $request->session()->regenerate();
            return redirect()->back()->with('message', 'Data Berhasil di update');
        }

        return redirect()->back()->withErrors(["Data gagal ditambah!"]);

    }

    public function cities(Request $request)
    {
        $id = $request->id;
        $cities = $this->rajaOngkirService->getCities($id);
        $cities = $cities['rajaongkir']['results'];
        return response()->json($cities);
    }

    public function cost(Request $request)
    {
        $courier = $request->kurir;
        $keranjang = Auth::user()->pelanggan->keranjang()->with('produk')->get();
        $bobot = $keranjang->reduce(function ($total, $item) {
            return $item->jumlah * $item->produk->bobot + $total;
        }, 0);
        $destination = Auth::user()->pelanggan->city_id;
        $cost = $this->rajaOngkirService->getShippingCost(427, $destination, $bobot, $courier);
        $cost = $cost['rajaongkir']['results'];
        return response()->json($cost);
    }
}

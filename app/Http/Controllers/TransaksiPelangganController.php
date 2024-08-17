<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiPelangganRequest;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiPelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $transaksi = $user->pelanggan->transaksi()->with('buktiPembayaran', 'ongkir', 'barangTransaksi.produk')->paginate(10);
        return view('pelanggan.transaksi.index', [
            'transaksi' => $transaksi,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransaksiRequest $request)
    {
        $data = $request->validated();
    
        if (!auth()->user()->pelanggan->keranjang()->exists()) {
            return redirect()->back()->withErrors(['Keranjang kosong']);
        }
    
        $transaksi = auth()->user()->pelanggan->transaksi()->create([
            'alamat' => $data['alamat'],
            'catatan' => $data['catatan'],
            'kodepos' => $data['kodepos'],
            'ongkir_id' => $data['ongkir'],
        ]);

        $barang = auth()->user()->pelanggan->keranjang;
        $barang->load('produk');
        $barang->map(function ($item) use ($transaksi) {
            $transaksi->barangTransaksi()->create([
                'produk_id' => $item->produk->id,
                'file' => $item->file,
                'jumlah' => $item->jumlah
            ]);
            $item->delete();
        });

        if (isset($data['bayar'])) {
            $gambar = $request->file('bayar')->storePublicly('public/bukti');
            $gambar = str_replace('public/', 'storage/', $gambar);
            $transaksi->buktiPembayaran()->create([
                'gambar' => $gambar
            ]);
        }

        return redirect()->route('pelanggan.transaksi.index')->with('message', 'Produk berhasil dibeli');
    }

    // Other methods

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        $transaksi->load('buktiPembayaran');
        $transaksi->load('barangTransaksi.produk');
        $transaksi->load('pelanggan.user');
        $transaksi->load('ongkir');
        $total = 0;
        $totalItem = 0;
        $bobotBersih = 0;
        foreach ($transaksi->barangTransaksi as $item) {
            $total += $item->jumlah * $item->produk->harga;
            $totalItem += $item->jumlah;
            $bobotBersih = $item->jumlah * $item->produk->bobot;
        }

        $bobot = $bobotBersih < 1000 ? 1 : $bobotBersih / 1000;
        return view('pelanggan.transaksi.show', [
            'transaksi' => $transaksi,
            'ongkir' => ($bobot * $transaksi->ongkir->harga),
            'total' => $total + ($bobot * $transaksi->ongkir->harga),
            'bobot' => $bobotBersih,
            'totalItem' => $totalItem,
            'totalBersih' => $total,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        $transaksi->load('buktiPembayaran');
        $transaksi->load('barangTransaksi.produk');
        $transaksi->load('pelanggan.user');
        $transaksi->load('ongkir');
        $total = 0;
        $totalItem = 0;
        $bobotBersih = 0;
        foreach ($transaksi->barangTransaksi as $item) {
            $total += $item->jumlah * $item->produk->harga;
            $totalItem += $item->jumlah;
            $bobotBersih = $item->jumlah * $item->produk->bobot;
        }

        $bobot = $bobotBersih < 1000 ? 1 : $bobotBersih / 1000;
        return view('pelanggan.transaksi.edit', [
            'transaksi' => $transaksi,
            'ongkir' => ($bobot * $transaksi->ongkir->harga),
            'total' => $total + ($bobot * $transaksi->ongkir->harga),
            'bobot' => $bobotBersih,
            'totalItem' => $totalItem,
            'totalBersih' => $total,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransaksiPelangganRequest $request, Transaksi $transaksi)
    {
        $data['gambar'] = $request->file('bukti')->storePublicly('public/file');
        $data['gambar'] = str_replace('public/', 'storage/', $data['gambar']);
        if ($transaksi->buktiPembayaran) {
            $transaksi->buktiPembayaran->fill($data);
            if ($transaksi->buktiPembayaran->save()) {
                return redirect()->route('pelanggan.transaksi.show', ['transaksi' => $transaksi->id])->with('message', 'Berhasil diupdate');
            }
            return redirect()->back()->withErrors(["gagal diupdate"]);
        }

        if ($transaksi->buktiPembayaran()->create($data)) {
            return redirect()->route('pelanggan.transaksi.show', ['transaksi' => $transaksi->id])->with('message', 'Berhasil diupdate');
        }
        return redirect()->back()->withErrors(["gagal diupdate"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

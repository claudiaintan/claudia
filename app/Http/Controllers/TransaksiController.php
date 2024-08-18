<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('master.transaksi.index', [
            'transaksi' => Transaksi::with('pelanggan.user')->with('buktiPembayaran')->latest()->paginate(10),
        ]);
    }

    public function download($id)
    {
        $transaksi = Transaksi::find($id);

        // Generate PDF using Barryvdh\DomPDF\Facade\Pdf
        $pdf = Pdf::loadView('pdf.history', compact('transaksi'));

        // Stream the PDF
        return $pdf->stream('nota-transaksi-'.$id.'.pdf');
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
    public function store(StoreTransaksiRequest $request)
    {
        //
    }

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
        return view('master.transaksi.show', [
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
        return view('master.transaksi.edit', [
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
    public function update(UpdateTransaksiRequest $request, Transaksi $transaksi)
    {
        $data = $request->validated();
        $transaksi->buktiPembayaran->fill([
            'status' => $data['statusPembayaran'],
        ]);
        $transaksi->fill([
            'status' => $data['statusPengiriman'],
        ]);

        if ($transaksi->save() && $transaksi->buktiPembayaran->save()) {
            return redirect()->route('master.transaksi.index')->with('message', 'Data berhasil diupdate!');
        }

        return redirect()->back()->withErrors(["Data gagal diupdate!"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }

    public function cetak()
    {
        ini_set('max_execution_time', 300);
        $transaksi = Transaksi::with(['pelanggan.user', 'barangTransaksi.produk', 'buktiPembayaran'])->latest()->get();
        $pdf = Pdf::loadView('pdf.history', [
            'transaksi' => $transaksi
        ]);

        return $pdf->download('transaksi.pdf');
    }
}

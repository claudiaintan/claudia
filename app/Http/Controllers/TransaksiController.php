<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Services\RajaOngkirService;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class TransaksiController extends Controller
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
        return view('master.transaksi.index', [
            'transaksi' => Transaksi::with('pelanggan.user')->with('buktiPembayaran')->latest()->paginate(10),
        ]);
    }

    public function download($id)
    {
        $transaksi = Transaksi::with(['pelanggan.user', 'barangTransaksi.produk', 'buktiPembayaran', 'ongkir'])->find($id);


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
        $total = 0;
        $totalItem = 0;
        $bobotBersih = 0;
        foreach ($transaksi->barangTransaksi as $item) {
            $total += $item->jumlah * $item->produk->harga;
            $totalItem += $item->jumlah;
            $bobotBersih += $item->jumlah * $item->produk->bobot;
        }
        $city_id = $transaksi->pelanggan->city_id;
        $city = $this->rajaOngkirService->getCity($city_id);
        $city = $city['rajaongkir']['results'];
        return view('master.transaksi.show', [
            'transaksi' => $transaksi,
            'bobot' => $bobotBersih,
            'totalItem' => $totalItem,
            'totalBersih' => $total,
            'city' => $city,
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
        $total = 0;
        $totalItem = 0;
        $bobotBersih = 0;
        foreach ($transaksi->barangTransaksi as $item) {
            $total += $item->jumlah * $item->produk->harga;
            $totalItem += $item->jumlah;
            $bobotBersih += $item->jumlah * $item->produk->bobot;
        }

        return view('master.transaksi.edit', [
            'transaksi' => $transaksi,
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
        try {
            $transaksi->delete();
            return redirect()->back()->with('message', 'data berhasil dihapus dari transaksi');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['Gagal menghapus data dari transaksi']);
        }
    }

    public function cetak()
    {
        ini_set('max_execution_time', 300);
        $transaksi = Transaksi::with(['pelanggan.user', 'barangTransaksi.produk', 'buktiPembayaran', 'ongkir'])->latest()->get();
    
        // Ensure the view file path and variable name are correct
        $pdf = Pdf::loadView('pdf.transaksi', [
            'transaksi' => $transaksi
        ]);
    
        $filename = 'transaksi_' . now()->format('Ymd_His') . '.pdf';
    
        return $pdf->download($filename);
    }
}

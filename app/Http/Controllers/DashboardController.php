<?php

namespace App\Http\Controllers;

use App\Enums\StatusKirim;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('dashboard', [
            'pelanggan' => Pelanggan::count(),
            'transaksi' => Transaksi::count(),
            'transaksiBerhasil' => Transaksi::where('status', StatusKirim::SAMPAI->name)->count(),
        ]);
    }
}

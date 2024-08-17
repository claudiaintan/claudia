<x-layout-home>
    <x-slot:title>
        Detail Histori Transaksi
    </x-slot:title>

    @if(session()->get('message'))
        <div class="alert alert-success w-100">
            {{ session()->get('message') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger pt-3">
            @foreach ($errors->all() as $error)
                <p class="m-0 p-0">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="container mt-4">
        <!-- Header Section -->
        <div class="mb-4">
            <h3 class="text-center">Nota Transaksi</h3>
        </div>

        <!-- Transaction Details -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Transaksi</h5>
                <div class="d-flex justify-content-between mb-3">
                    <span>ID: {{ $transaksi->id }}</span>
                    <a href="{{ route('pelanggan.transaksi.edit', ['transaksi' => $transaksi->id]) }}" class="btn btn-success text-white">Update</a>
                </div>
                <p><strong>Nama Pelanggan:</strong> {{ $transaksi->pelanggan->user->name }}</p>
                <p><strong>Kodepos:</strong> {{ $transaksi->kodepos }}</p>
                <p><strong>Alamat:</strong> {{ $transaksi->alamat }}</p>
                <p><strong>Status Pengiriman:</strong> {{ $transaksi->status->display() }}</p>
                <p><strong>Status Pembayaran:</strong> {{ $transaksi->buktiPembayaran ? $transaksi->buktiPembayaran->status->display() : "Belum Bayar" }}</p>

                @if ($transaksi->buktiPembayaran)
                    <a class="btn btn-primary" href="/{{ $transaksi->buktiPembayaran->gambar }}" target="_blank">
                        <svg width="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                    </a>
                @endif

                <p><strong>Ongkir:</strong> {{ $transaksi->ongkir->nama }} - Rp {{ number_format($transaksi->ongkir->harga, 0, ',', '.') }}/kg</p>
                <p><strong>Ongkir Total:</strong> Rp {{ number_format($ongkir, 0, ',', '.') }}</p>
                <p><strong>Total Bayar:</strong> Rp {{ number_format($total, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Item Details -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Barang</h5>
                @if($transaksi->barangTransaksi->isEmpty())
                    <p class="text-center">Tidak ada barang dalam transaksi ini.</p>
                @else
                    @foreach ($transaksi->barangTransaksi as $item)
                        <div class="mb-3">
                            <h6 class="font-weight-bold">{{ $item->produk->nama }}</h6>
                            <p>ID: {{ $item->produk->id }}</p>
                            <p>Jumlah: {{ $item->jumlah }}</p>
                            <p>Bobot: {{ $item->produk->bobot }} gr</p>
                            <p>Harga: Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</p>
                            @if($item->file)
                                <a href="/{{ $item->file }}" class="btn btn-primary">
                                    <svg width='24' fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    @endforeach
                @endif

                <div class="mt-4 border-top pt-2">
                    <div class="d-flex justify-content-between">
                        <strong>Total</strong>
                        <span>{{ $totalItem }} barang - {{ $bobot }} gr</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <strong>Total Bersih</strong>
                        <span>Rp {{ number_format($totalBersih, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout-home>

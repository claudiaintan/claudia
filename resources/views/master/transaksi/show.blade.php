<x-dashboard-template>
    <x-slot:title>
        Detail Transaksi
    </x-slot:title>

    <x-slot:dropdownTransaksi>
        1
    </x-slot:dropdownTransaksi>

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

    <div class="shadow rounded p-3 d-flex flex-column">
        <div class="d-flex">
            <h3 >Transaksi</h3>
            <a href="{{ route('master.transaksi.edit', ['transaksi' => $transaksi->id]) }}" class="ms-auto btn btn-success text-white">Update</a>
        </div>

        <table class="table align-middle">
            <tr>
                <td>ID</td>
                <td>
                    {{ $transaksi->id }}
                </td>
            </tr>

            <tr>
                <td>Nama Pelanggan</td>
                <td>
                    {{ $transaksi->pelanggan->user->name }}
                </td>
            </tr>

            <tr>
                <td>Kota/Kabupaten</td>
                <td>
                    {{ $city['city_name'] }}
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>
                    {{ $transaksi->pelanggan->alamat }}
                </td>
            </tr>

            <td>Catatan</td>
                <td>
                    {{ $transaksi->catatan }}
                </td>
            </tr>

            <tr>
                <td>Status Pengiriman</td>
                <td>
                    {{ $transaksi->status->display() }}
                </td>
            </tr>

            <tr>
                <td>Status Pembayaran</td>
                <td class="d-flex justify-items-center gap-2">
                    <span class="d-flex justify-content-center justify-content-center align-items-center">
                        {{ $transaksi->buktiPembayaran ? $transaksi->buktiPembayaran->status->display() : "Belum Bayar" }}
                    </span>

                    @if ($transaksi->buktiPembayaran)
                    <a class="btn btn-primary" href="/{{ $transaksi->buktiPembayaran->gambar }}" target="_blank">
                        <svg width="24"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                    </a>
                    @endif
                </td>
            </tr>

            <tr>
                <td>Jenis Pengiriman</td>
                @php
                    $kurir = strtoupper($transaksi->kurir);
                    if ($transaksi->kurir = 'pos') {
                        $kurir = 'POS Indonesia';
                    }
                @endphp
                <td>
                    {{ $kurir }} ({{ $transaksi->layanan }})
                </td>
            </tr>

            <tr>
                <td>Total Bayar</td>
                <td>
                    Rp {{ number_format($transaksi->total, 0, ',', '.') }}
                </td>
            </tr>
        </table>

        <h3>Barang</h3>

        <table class="table table-bordered align-middle">
            <tr>
                <td class="text-center">No.</td>
                <td>Nama Barang</td>
                <td class="text-end">Jumlah</td>
                <td class="text-end">Bobot</td>
                <td class="text-end">Harga</td>
                <td class="text-center">File</td>
            </tr>
            @foreach ($transaksi->barangTransaksi as $item)
            <tr>
                <td class="text-center">
                    {{ $loop->iteration }}
                </td>

                <td>
                    {{ $item->produk->nama }}
                </td>

                <td class="text-end">
                    {{ $item->jumlah }}
                </td>

                <td class="text-end">
                    {{ $item->produk->bobot * $item->jumlah }}
                </td>

                <td class="text-end">
                    Rp {{ number_format($item->produk->harga * $item->jumlah, 0, ',', '.') }}
                </td>
                <td class="text-center">
                    <a href="/{{ $item->file }}" class="btn btn-primary">
                        <svg width='24'  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                    </a>
                </td>
            </tr>
            @endforeach
                <tr class="table-dark">
                    <td colspan="2">
                        Total
                    </td>
                    <td class="text-end">{{ $totalItem }}</td>
                    <td class="text-end">{{ $bobot }} gr</td>

                    <td class="text-end">Rp {{ number_format($totalBersih, 0, ',', '.') }}</td>
                    <td></td>
                </tr>
        </table>
    </div>

</x-dashboard-template>


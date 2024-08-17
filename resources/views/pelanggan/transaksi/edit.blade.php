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

    <form enctype="multipart/form-data" action="{{ route('pelanggan.transaksi.update', ['transaksi' => $transaksi->id]) }}" method="post" class="shadow rounded p-3 d-flex flex-column">
    @csrf
    @method('put')
        <div class="d-flex">
            <h3>Update Transaksi</h3>
            <button type="submit" class="ms-auto btn btn-success text-white">Simpan</button>
        </div>

        <table class="table">
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
                <td>Kodepos</td>
                <td>
                    {{ $transaksi->kodepos }}
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>
                    {{ $transaksi->alamat }}
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
                    <input type="file" class="form-control" name="bukti" placeholder="Bukti Pembayaran">
                </td>
            </tr>

            <tr>
                <td>Ongkir</td>
                <td>
                    {{ $transaksi->ongkir->nama }} - Rp {{ number_format($transaksi->ongkir->harga, 0, ',', '.') }}/kg
                </td>
            </tr>

            <tr>
                <td>Ongkir Total</td>
                <td>
                    Rp {{ number_format($ongkir, 0, ',', '.') }}
                </td>
            </tr>

            <tr>
                <td>Total Bayar</td>
                <td>
                    Rp {{ number_format($total, 0, ',', '.') }}
                </td>
            </tr>
        </table>

        <h3>Barang</h3>

        <table class="table table-bordered">
            <tr>
                <td>Id</td>
                <td>Nama Barang</td>
                <td>Jumlah</td>
                <td>Bobot</td>
                <td>Harga</td>
                <td>File</td>
            </tr>
            @foreach ($transaksi->barangTransaksi as $item)
            <tr>
                <td>
                    {{ $item->produk->id }}
                </td>

                <td>
                    {{ $item->produk->nama }}
                </td>

                <td>
                    {{ $item->jumlah }}
                </td>

                <td>
                    {{ $item->produk->bobot }} gr
                </td>

                <td>
                     Rp {{ number_format($item->produk->harga, 0, ',', '.') }}
                </td>
                <td>
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
                    <td>{{ $totalItem }}</td>
                    <td>{{ $bobot }} gr</td>

                    <td>Rp {{ number_format($totalBersih, 0, ',', '.') }}</td>
                    <td></td>
                </tr>
        </table>
    </form>
</x-layout-home>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
<style>
h4 {
    margin: 0;
}

.w-full {
    width: 100%;
}

.w-half {
    width: 50%;
}

.margin-top {
    margin-top: 1.25rem;
}

.footer {
    font-size: 0.875rem;
    padding: 1rem;
    background-color: rgb(241 245 249);
}

table {
    width: 100%;
    border-spacing: 0;
}

table.products {
    font-size: 0.875rem;
}

table.products tr {
    background-color: rgb(96 165 250);
}

table.products th {
    color: #ffffff;
    padding: 0.5rem;
}

table tr.items {
    background-color: rgb(241 245 249);
}

table tr.items td {
    padding: 0.5rem;
}

.total {
    text-align: right;
    margin-top: 1rem;
    font-size: 0.875rem;
}

.text-center {
    text-align: center;
}
</style>
    <h1 class="text-center">Laporan Transaski</h1>
    <p class="text-center">Alamat</p>
    <div class="w-full" style="border: 0 0 1px 0 solid black; padding: 1px;"></div>

    <p>Tanggal : {{ now() }}</p>
    <table class="w-full products">
        <tr class="products">
        <td>No</td>
        <td>Nama Pelanggan</td>
        <td>Tanggal</td>
        <td>Ongkir</td>
        <td>Status Pembayaran</td>
        <td>Total</td>
        </tr>

        @foreach($transaksi as $key => $item)
        <tr class="items">
            <td>{{ $key }}</td>
            <td>{{ $item->pelanggan->user->name }}</td>
            <td>{{ $item->created_at }}</td>
            <td>{{ $item->ongkir->nama }}</td>
            <td>{{ $item->buktiPembayaran ? $item->buktiPembayaran->status->display() : "Belum Bayar" }}</td>
            <td>Rp {{ number_format($item->harga() + $item->ongkir->harga, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>

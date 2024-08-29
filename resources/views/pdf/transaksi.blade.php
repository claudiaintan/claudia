<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
        }
        p {
            text-align: center;
            margin: 0;
        }
        .divider {
            border-bottom: 1px solid black;
            margin: 1rem 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 0.5rem;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .text-center {
            text-align: center;
        }
        .total {
            text-align: right;
            margin-top: 1rem;
        }
        .footer {
            font-size: 0.875rem;
            padding: 1rem;
            background-color: rgb(241, 245, 249);
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>Laporan Transaksi</h1>
    <div class="divider"></div>

    <p>Tanggal: {{ now()->format('d-m-Y H:i:s') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal</th>
                <th>Jenis Pengiriman</th>
                <th>Status Pembayaran</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi as $key => $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->pelanggan->user->name }}</td>
                <td>{{ $item->created_at->format('d-m-Y H:i:s') }}</td>
                <td>{{ $item->layanan }}</td>
                <td>{{ $item->buktiPembayaran ? $item->buktiPembayaran->status->display() : 'Belum Bayar' }}</td>
                <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        <p>Terima kasih atas kepercayaan Anda</p>
    </div>
</body>
</html>
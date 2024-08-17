<!DOCTYPE html>
<html>
<head>
    <title>Nota Transaksi</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }
        .container {
            width: 100%;
            max-width: 400px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border: 1px solid #ddd;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 100px;
            margin-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            color: #333;
        }
        .header p {
            margin: 5px 0;
            font-size: 12px;
            color: #666;
        }
        .details {
            margin-bottom: 20px;
            border-bottom: 2px dashed #333;
            padding-bottom: 10px;
        }
        .details p {
            margin: 5px 0;
            font-size: 12px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: none;
            padding: 8px 0;
            text-align: left;
            font-size: 12px;
        }
        th {
            color: #333;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }
        .footer p {
            margin: 5px 0;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <!-- <img src="{{ asset('image/footer-logo.jpg') }}" alt="Logo"> -->
            <h1>Nota Transaksi</h1>
            <p>Terima kasih atas pesanan Anda!</p>
        </div>

        <div class="details">
            <p><strong>ID Transaksi:</strong> {{ $transaksi->id }}</p>
            <p><strong>Tanggal:</strong> {{ $transaksi->created_at }}</p>
        </div>

        <table>
            <tr>
                <th>Status Pengiriman</th>
                <td>{{ $transaksi->status->display() }}</td>
            </tr>
            <tr>
                <th>Status Pembayaran</th>
                <td>{{ $transaksi->buktiPembayaran ? $transaksi->buktiPembayaran->status->display() : "Belum Bayar" }}</td>
            </tr>
            <tr>
                <th>Ongkir</th>
                <td>{{ $transaksi->ongkir->nama }}</td>
            </tr>
            <tr>
                <th>Bobot</th>
                <td>{{ $transaksi->bobot() }} gr</td>
            </tr>
            <tr>
                <th>Total Bayar</th>
                <td>Rp {{ number_format($transaksi->harga(), 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="footer">
            <p>Powered by DPC Rumah Qeeta</p>
            <p>Instagram: @dpcrumahqeeta | 081277197385 | Email: dpc.rumahqeeta@gmail.com</p>
        </div>
    </div>
</body>
</html>

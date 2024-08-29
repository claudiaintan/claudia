<!DOCTYPE html>
<html>
<head>
    <title>Nota Transaksi</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            margin: 0;
            padding: 0;
            background-color: #F4F4F4;
        }
        .container {
            position: relative;
            width: 100%;
            max-width: 400px;
            margin: 20px auto;
            background: #FFF;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border: 1px solid #ddd;
            overflow: hidden; 
        }
        .watermark {
            position: absolute;
            top: 19%;
            left: 33%; 
            transform: translate(-20%, -15%) rotate(0deg); 
            font-size: 50px;
            font-weight: bold;
            color: rgba(255, 0, 0, 0.2); 
            white-space: nowrap;
            pointer-events: none; 
            text-align: center;
            z-index: 0; 
            border: 2px solid rgba(255, 0, 0, 0.2); 
            padding: 10px;
            box-sizing: border-box; 
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            background-color: #FFA726;
            padding: 10px;
            border-radius: 8px 8px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            color: #fff;
        }
        .header p {
            margin: 5px 0;
            font-size: 12px;
            color: #fff;
        }
        .details {
            margin-bottom: 20px;
            border-bottom: 2px dashed #FFA726;
            padding-bottom: 10px;
        }
        .details p {
            margin: 5px 0;
            font-size: 12px;
            color: #333;
        }
        .details .order-id {
            font-weight: bold;
            font-size: 14px;
            color: #FFA726;
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
            color: #333;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            background-color: #FFA726;
            padding: 10px;
            border-radius: 0 0 8px 8px;
        }
        .footer p {
            margin: 5px 0;
            font-size: 12px;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="watermark">
            {{ $transaksi->buktiPembayaran && $transaksi->buktiPembayaran->status->display() == "Lunas" ? "LUNAS" : "BELUM LUNAS" }}
        </div>
        
        <div class="header">
            <h1>Nota Transaksi</h1>
            <p>Terima kasih atas pesanan Anda!</p>
        </div>

        <div class="details">
            <p><strong>ID Transaksi:</strong> {{ $transaksi->id }}</p>
            <p><strong>ID Pesanan:</strong> <span class="order-id">{{ strtoupper(uniqid('ORDER')) }}</span></p>
            <p><strong>Tanggal:</strong> {{ $transaksi->created_at->format('d-m-Y') }}</p>
            <p><strong>Waktu:</strong> {{ $transaksi->created_at->format('H:i') }}</p>
            <p><strong>Admin:</strong> Bella</p>
        </div>

        <table>
            <tr>
                <th>Jenis Layanan</th>
                <td>{{ $transaksi->layanan }}</td>
            </tr>
            <tr>
                <th>Bobot</th>
                <td>{{ $transaksi->bobot() }} gr</td>
            </tr>
            <tr>
                <th>Total Bayar</th>
                <td>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="footer">
            <p>Powered by DPC Rumah Qeeta</p>
            <p>Instagram: @dpcrumahqeeta | 081277197385 | Email: dpc.rumahqeeta@gmail.com</p>
        </div>
    </div>
</body>
</html>

</html>

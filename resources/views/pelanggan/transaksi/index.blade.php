<x-layout-home>
    <x-slot:title>
        Histori Transaksi
    </x-slot:title>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .container {
            margin-top: 20px;
        }
        .table {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        .table th {
            background-color: #343a40;
            color: #fff;
            text-align: center;
        }
        .table td {
            vertical-align: middle;
            text-align: center;
        }
        .btn {
            padding: 8px 12px;
            border-radius: 4px;
            text-decoration: none;
            color: #fff;
            font-size: 14px;
        }
        .btn-secondary {
            background-color: #6c757d;
        }
        .alert {
            border-radius: 4px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Histori Transaksi</h1>

        @if(session()->get('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p class="m-0">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Status Pengiriman</th>
                        <th>Status Bayar</th>
                        <th>Jenis Layanan</th>
                        <th>Catatan</th>
                        <th>Bobot</th>
                        <th>Total Bayar</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->status->display() }}</td>
                        <td>{{ $item->buktiPembayaran ? $item->buktiPembayaran->status->display() : "Belum Bayar" }}</td>
                        <td>{{ $item->layanan }}</td>
                        <td>{{ $item->catatan }}</td>
                        <td>{{ $item->bobot() }} gr</td>
                        <td>Rp {{ number_format($item->harga(), 0, ',', '.') }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a href="{{ route('transaksi.download', ['transaksi' => $item->id]) }}" class="btn btn-secondary">Unduh Nota</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-4">
                {{ $transaksi->links() }}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</x-layout-home>

<x-layout-home>
    <x-slot name="title">
        Produk - {{ $produk->nama }}
    </x-slot>

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

    <div class="container d-flex flex-sm-column flex-md-row gap-4 py-5">
        <div class="w-100">
            <img src="{{ asset('storage/produk/' . basename($produk->gambar)) }}" alt="{{ $produk->nama }}" class="img-fluid">
        </div>

        <div class="w-50 shadow rounded p-2 h-50 gap-4 p-5">
            <h1>{{ $produk->nama }}</h1>
            <table class="table">
                <tr>
                    <td>Kategori</td>
                    <td>{{ $produk->kategori->nama }}</td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Bobot</td>
                    <td>{{ $produk->bobot }} gr</td>
                </tr>
                <tr>
                    <td>Stok Barang</td>
                    <td>{{ $produk->stok }}</td>
                </tr>
            </table>

            @auth
            <h4 class="mt-5 mb-2">Beli</h4>
            <div class="d-flex">
                <form action="{{ route('pelanggan.keranjang.store') }}" class="d-flex flex-column gap-4 w-100" enctype='multipart/form-data' method="post">
                    @csrf
                    <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" max="{{ $produk->stok }}" oninput="updateTotalBayar(this)">
                    </div>
                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" name="file" id="file" class="form-control">
                    </div>
                    <div class="form-group d-flex">
                        <p>
                            Total Bayar : Rp.<span id="totalBayar">0</span>
                        </p>
                    </div>
                    <button type="submit" class="btn btn-primary">Masukan Keranjang</button>
                </form>
            @endauth
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const produkHarga = {{ $produk->harga }};
            const stokAwal = {{ $produk->stok }};

            function updateTotalBayar(input) {
                let jumlah = parseInt(input.value);

                if (isNaN(jumlah) || jumlah < 1) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        text: 'Jumlah pembelian harus minimal 1!',
                        confirmButtonText: 'OK'
                    });
                    input.value = 1;
                    jumlah = 1;
                }

                if (jumlah > stokAwal) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        text: 'Jumlah pembelian melebihi stok yang tersedia!',
                        confirmButtonText: 'OK'
                    });
                    input.value = stokAwal;
                    jumlah = stokAwal;
                }

                const totalBayar = produkHarga * jumlah;
                document.getElementById("totalBayar").innerText = totalBayar.toLocaleString('id-ID');
            }

            // Tambahkan event listener untuk jumlah input
            document.getElementById('jumlah').addEventListener('input', function() {
                updateTotalBayar(this);
            });
        });
    </script>
</x-layout-home>

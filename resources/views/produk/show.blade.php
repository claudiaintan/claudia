<x-layout-home>
    <x-slot:title>
        Produk - {{ $produk->nama }}
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
            </table>
            @auth
            <h4 class="mt-5 mb-2">Beli</h4>
            <div class="d-flex">
            <form action="{{ route('pelanggan.keranjang.store') }}" class="d-flex flex-column gap-4 w-100" enctype='multipart/form-data' method="post">
                @csrf
                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" oninput="updateTotalBayar(this, { $produkharga })">
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
</x-layout-home>

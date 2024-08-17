<x-layout-home>
    <x-slot:title>
        Keranjang
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

            <h1 class="my-5 text-center">Keranjang</h1>
    <div class="container d-flex flex-sm-column flex-md-row gap-4">
        <div class="w-100">
            <table class="table table-bordered">
                <tr class="table-primary">
                    <td>#</td>
                    <td>Nama Produk</td>
                    <td>Jumlah</td>
                    <td>Bobot</td>
                    <td>Catatan</td>
                    <td>Harga</td>
                    <td>Aksi</td>
                </tr>
                @foreach($keranjang as $key => $item)
                <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $item->produk->nama }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->catatan }}</td>
                    <td>{{ $item->produk->bobot }}</td>
                    <td>Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                    <td>
                        <form action="{{  route('pelanggan.keranjang.destroy', ['keranjang' => $item->id]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                <tr class="table-dark">
                    <td colspan="2">
                        Total
                    </td>
                    <td>{{ $keranjang->sum('jumlah') }}</td>
                    <td>{{ $bobot }}</td>

                    <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                    <td></td>
                </tr>
            </table>

            {{ $keranjang->links() }}
        </div>
        <div class="w-50 shadow rounded p-2 h-50 d-flex gap-4">
            <form action="{{ route('pelanggan.transaksi.store') }}" class="d-flex flex-column gap-4 w-100" enctype='multipart/form-data' method="post">
                @csrf
                <div class="form-group">
                    <label for="ongkir">Ongkir</label>
                    <select name="ongkir" id="ongkir" class='form-control' onchange="updateOngkir({{ $total }}, {{ $bobot }})">
                        <option value="-0" selected hidden> -- Pilih -- </option>
                        @foreach($ongkir as $item)
                            <option data-harga="{{ $item->harga }}" value="{{ $item->id }}">{{ $item->nama }} - Rp {{ number_format($item->harga, 0, ',', '.') }}/kg</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="kodepos">Kodepos</label>
                    <input type="text" name="kodepos" id="kodepos" class="form-control">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control">
                </div>
                <div class="form-group">
                    <label for="catatan">Catatan</label>
                    <input type="text" name="catatan" id="alamat" class="form-control">
                </div>
                <div class="form-group">
                    <label for="bayar">Bukti Bayar</label>
                    <input type="file" name="bayar" id="bayar" class="form-control">
                </div>
                <div class="form-group d-flex">
                    <p>
                        Total Bayar : Rp.<span id="totalBayar">0</span>
                    </p>
                </div>
                <button type="submit" class="btn btn-primary">Beli</button>
            </form>
        </div>
    </div>
</x-layout-home>

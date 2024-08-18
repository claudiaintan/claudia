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
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->produk->nama }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->produk->bobot }}</td>
                    <td>{{ $item->catatan }}</td>
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
                    <td></td>
                    <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                    <td></td>
                </tr>
            </table>

            {{ $keranjang->links() }}
        </div>
        <div class="w-50 shadow rounded p-2 h-50 d-flex gap-4">
            <form action="{{ route('pelanggan.transaksi.store') }}" class="d-flex flex-column gap-4 w-100" enctype='multipart/form-data' method="post">
                @csrf
                @method('POST')
                {{-- <div class="form-group">
                    <label for="kodepos">Kodepos</label>
                    <input type="text" name="kodepos" id="kodepos" class="form-control">
                </div> --}}
                <div class="form-group">
                    <label for="origin">Alamat Pengirim</label>
                    <input type="text" name="origin" id="origin" value="Sragen" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat Penerima</label>
                    <select name="destination" id="destination" class="form-control">
                        <option value="{{ Auth::user()->pelanggan->city_id }}">{{ $city['city_name'] ?? '' }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="catatan">Catatan</label>
                    <input type="text" name="catatan" id="catatan" class="form-control">
                </div>
                <div class="form-group">
                    <label for="kurir">Pengiriman</label>
                    <select name="kurir" id="kurir" class="form-select" required>
                        <option value="" hidden>Pilih Kurir</option>
                        <option value="jne">JNE</option>
                        <option value="pos">POS Indonesia</option>
                        <option value="tiki">TIKI</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ongkir">Jenis Layanan</label>
                    <select id="layanans" class="form-select" disabled required></select>
                    <input type="hidden" name="layanan" id="layanan">
                </div>
                <div class="form-group">
                    <label for="bayar">Bukti Bayar</label>
                    <input type="file" name="bayar" id="bayar" class="form-control">
                </div>
                <div class="form-group d-flex">
                    <p>
                        Total Bayar : <span id="totalBayar">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </p>
                    <input type="hidden" name="total" id="total">
                </div>
                <button type="submit" class="btn btn-primary">Beli</button>
            </form>
        </div>
    </div>
    @slot('scripts')
        <script>
            $(function () {
                $('#layanans').change(function (e) {
                    e.preventDefault();
                    var text = $('#layanans option:selected').text();
                    var value = $(this).val();
                    var total = '{{ $total }}';
                    var payment = parseFloat(value) + parseFloat(total);

                    if (value != '') {
                        $('#layanan').val(text);
                        $('#totalBayar').html(formatter.format(payment));
                        $('#total').val(payment);
                    } else {
                        $('#totalBayar').html(formatter.format(payment));
                        $('#total').val(payment);
                    }

                });

                $('#kurir').change(function (e) {
                    e.preventDefault();
                    var value = $(this).val();
                    if (value != '') {
                        $('#layanans').removeAttr('disabled');
                        getCost(value)
                    } else {
                        $('#layanans').attr('disabled', true);
                        $('#layanans').html('');
                    }
                });
            });

            var formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0,
            });

            function getCost(kurir) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('cost') }}",
                    data: {
                        kurir: kurir,
                    },
                    cache: false,
                    success: function(response) {
                        var costs = response[0].costs
                        var text = '<option value="" hidden>Pilih Layanan</option>';
                        $.each(costs, function (i, v) {
                            var value = formatter.format(v.cost[0].value)
                            text += `<option value="${v.cost[0].value}">${v.service} - ${value}</option>`
                        });
                        $('#layanans').html(text);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        </script>
    @endslot
</x-layout-home>

<x-layout-home>
    <x-slot:title>
        Keranjang Belanja
    </x-slot:title>

    @if(session()->get('message'))
        <div class="alert alert-success w-100 animate__animated animate__fadeIn">
            <i class="fas fa-check-circle"></i> {{ session()->get('message') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger pt-3 animate__animated animate__fadeIn">
            <i class="fas fa-exclamation-circle"></i>
            @foreach ($errors->all() as $error)
                <p class="m-0 p-0">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <h1 class="my-5 text-center text-orange" style="font-weight: 700; letter-spacing: 2px;">Keranjang Belanja</h1>

    <div class="container d-flex flex-sm-column flex-md-row gap-4">
        <div class="w-100">
            <table class="table table-bordered table-hover shadow-sm rounded animate__animated animate__fadeInUp" style="border-color: #ffa500;">
                <thead class="table-warning text-center">
                    <tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Bobot</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($keranjang as $key => $item)
                    <tr class="animate__animated animate__fadeInUp">
                        <td>{{ ($keranjang->currentpage()-1) * $keranjang->perpage() + $loop->index + 1 }}</td>
                        <td>{{ $item->produk->nama }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ $item->produk->bobot }} kg</td>
                        <td>Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <form action="{{ route('pelanggan.keranjang.destroy', ['keranjang' => $item->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-dark text-center">
                    <tr>
                        <td colspan="2"><strong>Total</strong></td>
                        <td>{{ $keranjang->sum('jumlah') }}</td>
                        <td>{{ $bobot }} kg</td>
                        <td></td>
                        <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            {{ $keranjang->appends(request()->query())->links() }}
        </div>

        <div class="w-50 shadow-lg rounded p-4 h-50 d-flex flex-column gap-4 bg-light animate__animated animate__fadeInRight" style="border-left: 5px solid #ffa500;">
            <form action="{{ route('pelanggan.transaksi.store') }}" class="d-flex flex-column gap-4 w-100" enctype='multipart/form-data' method="post">
                @csrf
                @method('POST')

                <div class="form-group">
                    <label for="origin" class="text-orange" style="font-weight: 600;">Alamat Pengirim</label>
                    <input type="text" name="origin" id="origin" value="Sragen" class="form-control" readonly style="background-color: #fff8e1; border-color: #ffa500;">
                </div>
                <div class="form-group">
                    <label for="alamat" class="text-orange" style="font-weight: 600;">Alamat Penerima</label>
                    <select name="destination" id="destination" class="form-control" style="background-color: #fff8e1; border-color: #ffa500;">
                        <option value="{{ Auth::user()->pelanggan->city_id }}">{{ $city['city_name'] ?? '' }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="catatan" class="text-orange" style="font-weight: 600;">Catatan</label>
                    <input type="text" name="catatan" id="catatan" class="form-control" style="background-color: #fff8e1; border-color: #ffa500;">
                </div>
                <div class="form-group">
                    <label for="kurir" class="text-orange" style="font-weight: 600;">Pengiriman</label>
                    <select name="kurir" id="kurir" class="form-select" required style="background-color: #fff8e1; border-color: #ffa500;">
                        <option value="" hidden>Pilih Kurir</option>
                        <option value="jne">JNE</option>
                        <option value="pos">POS Indonesia</option>
                        <option value="tiki">TIKI</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ongkir" class="text-orange" style="font-weight: 600;">Jenis Layanan</label>
                    <select id="layanans" class="form-select" disabled required style="background-color: #fff8e1; border-color: #ffa500;"></select>
                    <input type="hidden" name="layanan" id="layanan">
                </div>
                <div class="form-group">
                    <label for="bayar" class="text-orange" style="font-weight: 600;">Bukti Bayar</label>
                    <input type="file" name="bayar" id="bayar" class="form-control" style="background-color: #fff8e1; border-color: #ffa500;">
                </div>
                <div class="form-group d-flex justify-content-between">
                    <p class="m-0 text-orange" style="font-weight: 700;">
                        Total Bayar : <span id="totalBayar">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </p>
                    <input type="hidden" name="total" id="total">
                </div>
                <button type="submit" class="btn btn-orange btn-lg btn-block" style="background-color: #ffa500; color: white; font-weight: 600;">Beli Sekarang</button>
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
                    var costs = response[0].costs;
                    var text = '<option value="" hidden>Pilih Layanan</option>';
                    $.each(costs, function (i, v) {
                        var value = formatter.format(v.cost[0].value);
                        text += `<option value="${v.cost[0].value}">${v.service} - ${value}</option>`;
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

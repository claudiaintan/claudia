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
                        <th></th>
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
                        <td>{{ $item->produk->bobot }} gr</td>
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
                        <td>{{ $bobot }} gr</td>
                        <td></td>
                        <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            {{ $keranjang->appends(request()->query())->links() }}
        </div>

        <div class="w-50 shadow-lg rounded p-4 h-50 d-flex flex-column gap-4 bg-light animate__animated animate__fadeInRight" style="border-left: 5px solid #ffa500;">
            <form id="checkout-form" class="d-flex flex-column gap-4 w-100" enctype='multipart/form-data'>
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

                <!-- Section for total payment and order button -->
                <div class="form-group d-flex justify-content-between align-items-center">
                    <p class="m-0 text-orange" style="font-weight: 700;">
                        Total Bayar: <span id="totalBayar">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </p>
                    <button type="button" class="btn btn-orange btn-lg btn-block" style="background-color: #ffa500; color: white; font-weight: 600;" data-bs-toggle="modal" data-bs-target="#paymentModal">
                        Pesan Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for uploading payment proof -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Detail Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('pelanggan.transaksi.store') }}" method="POST" enctype="multipart/form-data" id="payment-form">
                    @csrf
                    <div class="modal-body">
                        <p id="deliveryEstimate"></p>
                        <div class="form-group">
                            <label for="bayar" class="text-orange" style="font-weight: 600;">Upload Bukti Pembayaran</label>
                            <input type="file" name="bayar" id="bayar" class="form-control" required style="background-color: #fff8e1; border-color: #ffa500;">
                        </div>
                        <div class="form-group mt-3">
                            <label for="orderDetails" class="text-orange" style="font-weight: 600;">Detail Pesanan</label>
                            <ul id="orderDetails" class="list-unstyled">
                                <!-- Detail pesanan akan diisi dengan JavaScript -->
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Pesan</button>
                    </div>
                </form>
            </div>
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
                    getCost(value);
                } else {
                    $('#layanans').attr('disabled', true);
                    $('#layanans').html('');
                }
            });

            $('#paymentModal').on('show.bs.modal', function () {
                var totalItems = {{ $keranjang->sum('jumlah') }};
                var estimate = getDeliveryEstimate(totalItems);
                $('#deliveryEstimate').text('Estimasi pengerjaan: ' + estimate);

                // Detail pesanan
                var items = @json($keranjang); // Mengambil data keranjang dalam format JSON
                var destination = $('#destination option:selected').text();
                var courier = $('#kurir option:selected').text();
                var totalPayment = $('#totalBayar').text();

                var orderDetails = items.map(item => `
                    <li>
                        <strong>Nama Produk:</strong> ${item.produk.nama} <br>
                        <strong>Jumlah:</strong> ${item.jumlah} <br>
                        <strong>Harga:</strong> Rp ${item.produk.harga.toLocaleString('id-ID')} <br>
                    </li>
                `).join('');

                $('#orderDetails').html(`
                    <li><strong>Alamat Penerima:</strong> ${destination}</li>
                    <li><strong>Pengiriman:</strong> ${courier}</li>
                    <li><strong>Total Bayar:</strong> ${totalPayment}</li>
                    ${orderDetails}
                `);
            });

            function getDeliveryEstimate(totalItems) {
                if (totalItems <= 20) return '1-2 hari';
                if (totalItems <= 30) return '2-3 hari';
                if (totalItems <= 40) return '3-4 hari';
                return 'Lebih dari 4 hari';
            }

            // Initialize payment formatter
            const formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
            });

            // Handle file input changes if needed (you might add validation here)
            $('#bayar').change(function (e) {
                // Handle file selection if necessary
            });

            // Function to fetch and populate delivery cost
            function getCost(courier) {
                // Example AJAX request for fetching delivery cost
                $.ajax({
                    url: '/get-cost', // Adjust this URL to your API endpoint
                    type: 'POST',
                    data: {
                        courier: courier,
                        // Add any other necessary parameters
                    },
                    success: function (response) {
                        // Populate the service options
                        $('#layanans').html(response.services);
                        $('#layanans').prop('disabled', false);
                    },
                    error: function (error) {
                        console.error('Error fetching cost:', error);
                    }
                });
            }
        });
    </script>
    @endslot
</x-layout-home>

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
            <form action="{{ route('pelanggan.transaksi.store') }}" class="d-flex flex-column gap-4 w-100" enctype='multipart/form-data' method="post" id="mainForm">
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
                <div class="form-group d-flex justify-content-between align-items-center">
                    <p class="m-0 text-orange" style="font-weight: 700;">
                        Total Bayar : <span id="totalBayar">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </p>
                    <input type="hidden" name="total" id="total">
                    <button type="button" class="btn btn-orange btn-lg" style="background-color: #ffa500; color: white; font-weight: 600;" data-bs-toggle="modal" data-bs-target="#modalBuktiBayar">
                        Pesan sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>

    @slot('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
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

        $(document).ready(function() {
            // Fungsi untuk menghitung estimasi pengerjaan
            function hitungEstimasi(jumlah) {
                if (jumlah < 10) {
                    return '1 hari'; // Minimal 1 hari untuk < 10 item
                } else if (jumlah >= 10 && jumlah <= 20) {
                    return '1-2 hari';
                } else if (jumlah > 20 && jumlah <= 30) {
                    return '2-3 hari';
                } else if (jumlah > 30 && jumlah <= 40) {
                    return '3-4 hari';
                } else {
                    var tambahanHari = Math.ceil((jumlah - 40) / 10);
                    return (3 + tambahanHari) + '-' + (4 + tambahanHari) + ' hari';
                }
            }

            // Event handler untuk membuka modal
            $('#modalBuktiBayar').on('show.bs.modal', function (e) {
                // Ambil data dari form
                var daftarProduk = '';
                var totalBayar = $('#totalBayar').text();
                
                // Ambil data produk dari keranjang
                @foreach($keranjang as $item)
                    daftarProduk += '<li>' + '{{ $item->produk->nama }}' + ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ' + '{{ $item->jumlah }}' + ' pcs</li>';
                @endforeach

                // Hitung estimasi pengerjaan berdasarkan jumlah produk
                var jumlahTotalItem = {{ $keranjang->sum('jumlah') }};
                var estimasiPengerjaan = hitungEstimasi(jumlahTotalItem);

                // Update informasi di modal
                $('#estimasiPengerjaan').text(estimasiPengerjaan);
                $('#daftarProduk').html(daftarProduk);
                $('#totalBayarModal').text(totalBayar);
            });
        });

        function submitForm() {
        // Mengambil formulir utama dan formulir modal
        var mainForm = document.getElementById('mainForm');
        var modalForm = document.getElementById('modalForm');
        
        // Mengambil data dari form utama
        var formData = new FormData(mainForm);

        // Menambahkan data dari form utama ke form modal
        for (var pair of formData.entries()) {
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = pair[0];
            input.value = pair[1];
            modalForm.appendChild(input);
        }
        
        // Menyubmit formulir modal
        modalForm.submit();
    }

    </script>
    @endslot

    <!-- Modal Bukti Pembayaran -->
    <div class="modal fade" id="modalBuktiBayar" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Bukti Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Informasi Estimasi Pengerjaan -->
                    <div class="alert alert-info">
                        Estimasi Pengerjaan: <span id="estimasiPengerjaan"></span>
                    </div>

                    <!-- Daftar Produk dan Jumlah -->
                    <div class="mb-3">
                        <strong>Pesanan Produk:</strong>
                        <ul id="daftarProduk" class="list-unstyled"></ul>
                    </div>

                    <!-- Total Bayar -->
                    <div class="mb-3">
                        <strong>Total Bayar:</strong> <span id="totalBayarModal"></span>
                    </div>

                    <form action="{{ route('pelanggan.transaksi.store') }}" method="post" enctype="multipart/form-data" id="modalForm">
                        @csrf
                        <div class="form-group">
                            <label for="bayar" class="text-orange" style="font-weight: 600;">Unggah Bukti Bayar</label>
                            <input type="file" name="bayar" id="bayar" class="form-control" style="background-color: #fff8e1; border-color: #ffa500;">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-orange" style="background-color: #ffa500; color: white;" onclick="submitForm()">Pesan</button>
                </div>
            </div>
        </div>
    </div>

</x-layout-home>

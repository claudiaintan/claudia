<x-layout-home>
    <x-slot:title>
        Profil
    </x-slot:title>
    <style>
        /* Ensure no text decoration for specific links */
        .no-decoration a {
            text-decoration: none;
        }

        .icon-circle {
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            background-color: #007bff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .icon-circle span {
            font-weight: bold;
            font-size: 1.5rem;
            color: white;
        }

        /* Add hover effect for a more dynamic appearance */
        .icon-circle:hover {
            transform: scale(1.1);
        }
    </style>
    <section class="bg-dark text-white my-4 p-5">
        <div class="container p-5">
            <h1 class="text-center mb-4">Cara Pemesanan</h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex mb-4">
                        <div class="icon-circle me-3">
                            <span>1</span>
                        </div>
                        <div>
                            <h4>Login</h4>
                            <p>Masuk ke akun Anda untuk mengakses fitur pemesanan.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="icon-circle me-3">
                            <span>2</span>
                        </div>
                        <div>
                            <h4>Klik Produk</h4>
                            <p>Pilih produk yang ingin Anda beli dari daftar yang tersedia.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="icon-circle me-3">
                            <span>3</span>
                        </div>
                        <div>
                            <h4>Ketik Jumlah</h4>
                            <p>Masukkan jumlah produk yang ingin Anda beli.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="icon-circle me-3">
                            <span>4</span>
                        </div>
                        <div>
                            <h4>Tambah ke Keranjang</h4>
                            <p>Tambahkan produk yang dipilih ke keranjang belanja Anda.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex mb-4">
                        <div class="icon-circle me-3">
                            <span>5</span>
                        </div>
                        <div>
                            <h4>Masuk ke Icon Keranjang</h4>
                            <p>Akses keranjang belanja Anda untuk memeriksa item yang telah ditambahkan.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="icon-circle me-3">
                            <span>6</span>
                        </div>
                        <div>
                            <h4>Pilih Ongkir</h4>
                            <p>Pilih metode pengiriman yang sesuai untuk pesanan Anda.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="icon-circle me-3">
                            <span>7</span>
                        </div>
                        <div>
                            <h4>Upload Bukti Pembayaran</h4>
                            <p>Unggah bukti pembayaran jika sudah ada, atau cek histori transaksi jika belum.</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="icon-circle me-3">
                            <span>8</span>
                        </div>
                        <div>
                            <h4>Klik Beli</h4>
                            <p>Setelah semua langkah selesai, klik beli untuk menyelesaikan pesanan Anda.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout-home>

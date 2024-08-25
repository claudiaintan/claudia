<x-layout-home>
    <x-slot:title>
        Home
    </x-slot:title>

    <style>
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

        .icon-circle:hover {
            transform: scale(1.1);
        }

        /* Tentang Kami Styling */
        .about-us-section {
            max-width: 800px;
            margin: auto;
            text-align: center;
            position: relative;
            color: #333;
            font-family: 'Poppins', sans-serif;
        }

        .about-us-text {
            background: linear-gradient(135deg, rgba(255, 140, 0, 0.2), rgba(0, 123, 255, 0.2));
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            font-size: 1.2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 40px;
        }

        .about-us-text:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .highlight {
            color: #ff8c00;
            font-weight: bold;
        }

        /* Navbar for Tentang Kami */
        .about-us-navbar {
            background-color: #007bff;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 30px;
            text-align: center;
        }

        .about-us-navbar-item {
            color: #fff;
            font-size: 1.2rem;
            font-weight: bold;
            margin: 0 15px;
            display: inline-block;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .about-us-navbar-item i {
            font-size: 2rem;
            margin-right: 10px;
        }

        .about-us-navbar-item:hover {
            color: #ff8c00;
            transform: scale(1.1);
        }

        /* Promotional Section */
        .promotional-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 50px;
        }

        .promotional-title {
            font-size: 2rem;
            color: #007bff;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .promotional-icons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .promotional-icon {
            font-size: 2.5rem;
            color: #007bff;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .promotional-icon:hover {
            color: #ff8c00;
            transform: scale(1.1);
        }

        /* Produk Kami Styling */
        .product-scroll-container {
            overflow: hidden;
            position: relative;
            width: 100%;
            perspective: 1000px;
            margin-top: 50px; /* Adjusted spacing between sections */
        }

        .product-scroll-content {
            display: flex;
            white-space: nowrap;
            animation: scroll-left 20s linear infinite;
            transition: transform 0.3s ease;
        }

        .product-card {
            flex: 0 0 auto;
            margin-right: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 10px;
            background-color: rgba(255, 140, 0, 0.8);
            color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            text-decoration: none;
            transform: perspective(1000px) rotateY(0deg);
        }

        .product-card:hover {
            transform: perspective(1000px) rotateY(-15deg);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
        }

        .product-name {
            color: #fff;
            font-size: 1.25rem;
        }

        .product-price {
            color: #ffeb3b;
            font-size: 1.5rem;
        }

        @keyframes scroll-left {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }
    </style>

    <div style="height: 500px; position: relative;" class="d-flex flex-column justify-content-center align-items-center text-white">
        <div class="banner"></div>
        <h1 class="text-center">Rumah Qeeta</h1>
        <p>Digital Printing Cepat</p>
    </div>

    <section class="container my-4 about-us-section">
        <h1 style="font-weight: bold; font-size: 2.5rem; color: #ff8c00; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);">Tentang Kami</h1>

        <div class="about-us-text">
            <p>Mewujudkan <span class="highlight">kreativitas</span> Anda sejak tahun 2016. Kami siap membantu Anda dengan solusi percetakan yang cepat, tepat, dan berkualitas tinggi. Percayakan kebutuhan percetakan Anda Ke DPC RUMAH QEETA!</p>
        </div>
    </section>

    <section class="container my-4">
        <h1 class="text-center" style="font-weight: bold; font-size: 2.5rem; color: #ff8c00; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); letter-spacing: 2px;">
            Produk Kami
        </h1>
        <div class="product-scroll-container">
            <div class="product-scroll-content">
                @foreach($produk as $item)
                <a href="{{ route('produk.show', ['produk' => $item->id]) }}" class="product-card d-flex flex-column gap-2 p-3 rounded">
                    <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama }}" class="img-fluid" style="width: 300px; height: 300px; object-fit: cover">
                    <div>
                        <h4 class="product-name text-center">{{ $item->nama }}</h4>
                        <p class="product-price text-center">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                    </div>
                </a>
                @endforeach
                @foreach($produk as $item) <!-- Duplikat produk untuk pengulangan -->
                <a href="{{ route('produk.show', ['produk' => $item->id]) }}" class="product-card d-flex flex-column gap-2 p-3 rounded">
                    <img src="{{ $item->gambar }}" alt="{{ $item->nama }}" class="img-fluid" style="width: 300px; height: 300px; object-fit: cover">
                    <div>
                        <h4 class="product-name text-center">{{ $item->nama }}</h4>
                        <p class="product-price text-center">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-center my-4 w-100">
            <a href="{{ route('produk.index') }}" class="btn btn-primary">Lihat Semua</a>
        </div>
    </section>
</x-layout-home>

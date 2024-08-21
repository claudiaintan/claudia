<x-layout-home>
    <x-slot:title>
        Home
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

    <div style="height: 500px; position: relative;" class="d-flex flex-column justify-content-center align-items-center text-white">
        <div class="banner"></div>
        <h1 class="text-center">Rumah Qeeta</h1>
        <p>
            Digital Printing Cepat
        </p>
    </div>

    <section class="container my-4" style="font-family: 'Poppins', sans-serif; color: #333; text-align: center;">
        <h1 style="font-weight: bold;">Tentang Kami</h1>
        <div style="text-align: justify; display: inline-block; max-width: 800px;">
            <p style="line-height: 1.6;">
                <strong>Selamat datang di DPC Rumah Qeeta</strong>, tempat di mana kualitas dan kreativitas berpadu untuk menghasilkan produk percetakan terbaik. Sejak 2016, kami telah menjadi mitra terpercaya bagi masyarakat dan pelaku bisnis, menawarkan solusi percetakan yang cepat, tepat, dan berkualitas.
            </p>
            <p style="line-height: 1.6;">
                Berlokasi di Sukorejo, Karangmalang, Sragen, kami menyediakan beragam produk seperti spanduk, banner, stiker, mug, kartu nama, dan banyak lagi. Setiap produk kami dibuat dengan perhatian penuh pada detail untuk memastikan kepuasan pelanggan.
            </p>
            <p style="line-height: 1.6;">
                Kami percaya bahwa percetakan bukan sekadar mencetak, melainkan menghidupkan ide-ide Anda. Dengan komitmen pada hasil berkualitas tinggi, kami siap menjadi partner utama Anda dalam memenuhi semua kebutuhan percetakan.
            </p>
            <p class="text-center mx-auto" style="font-style: italic; margin-top: 20px;">
                Terima kasih telah memilih DPC Rumah Qeeta.
            </p>
        </div>
    </section>

    <section class="container my-4">
    <h1 class="text-center">Produk Kami</h1>
    <div class="d-flex flex-sm-column flex-md-row justify-content-center align-items-center gap-4">
        @foreach($produk as $item)
        <a href="{{ route('produk.show', ['produk' => $item->id]) }}" class="product-card d-flex flex-column gap-2 p-3 rounded" style="text-decoration: none;">
            <img src="{{ $item->gambar }}" alt="{{ $item->nama }}" class="img-fluid" style="width: 300px; height: 300px; object-fit: cover">
            <div>
                <h4 class="product-name text-center">
                    {{ $item->nama }}
                </h4>
                <p class="product-price text-center">
                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                </p>
            </div>
        </a>
        @endforeach
    </div>
    <div class="d-flex align-items-center justify-content-center my-4 w-100">
        <a href="{{ route('produk.index') }}" class="btn btn-primary">Lihat Semua</a>
    </div>
</section>

<style>
    .product-card {
        background-color: rgba(255, 140, 0, 0.8); /* Dark orange with transparency */
        color: #fff; /* White text color for contrast */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Subtle shadow effect */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        text-decoration: none;
    }

    .product-card:hover {
        transform: translateY(-5px); /* Lift the card up on hover */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4); /* Enhance the shadow on hover */
    }

    .product-card img {
        border-radius: 0.25rem;
    }

    .product-name {
        color: #fff; /* White text for the product name */
        font-size: 1.25rem; /* Slightly larger text size */
    }

    .product-price {
        color: #ffeb3b; /* Yellow color for the price to make it stand out */
        font-size: 1.5rem; /* Slightly larger text size for price */
    }
</style>

    <h1 class="text-center mt-5">Layanan Kami</h1>
    <section class="d-flex flex-sm-column flex-md-row justify-content-center align-items-center gap-4 my-5 no-decoration">
        <div class="shadow p-4 rounded d-flex flex-column justify-content-center align-items-center">
            <img src="{{ asset('image/Whatsapp.jpeg') }}" alt="Whatsapp" width="100" height="100">
            <a href="https://wa.me/081277197385"><h3 class="text-dark">Whatsapp</h3></a>
        </div>
        <div class="shadow p-4 rounded d-flex flex-column justify-content-center align-items-center">
            <img src="{{ asset('image/Instagram.jpeg') }}" alt="Instagram" width="100" height="100">
            <a href="https://www.instagram.com/dpcrumahqeeta/"><h3 class="text-dark">Instagram</h3></a>
        </div>
        <div class="shadow p-4 rounded d-flex flex-column justify-content-center align-items-center">
            <img src="{{ asset('image/bri.png') }}" alt="BRI" width="100" height="100">
            <h6>211001000210533</h6>
        </div>
        <div class="shadow p-4 rounded d-flex flex-column justify-content-center align-items-center">
            <img src="{{ asset('image/bni.png') }}" alt="BNI" width="100" height="100">
            <h6>0443421980</h6>
        </div>
    </section>
</x-layout-home>

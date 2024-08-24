<x-layout-home>
    <x-slot:title>
        Produk - {{ $kategori->nama }}
    </x-slot:title>
<!-- Kategori Navbar -->
<section class="container my-4">
        <div class="d-flex justify-content-around overflow-auto">
            <a href="{{ route('produk.byKategori', ['kategoriId' => 6]) }}" class="text-center text-decoration-none kategori-item">
                <div class="kategori-image-wrapper">
                    <img src="{{ asset('image/banner.gif') }}" alt="Spanduk dan banner" class="img-fluid  kategori-image">
                </div>
                <p class="mt-2 text-dark">Banner</p>
            </a>
            <a href="{{ route('produk.byKategori', ['kategoriId' => 1]) }}" class="text-center text-decoration-none kategori-item">
                <div class="kategori-image-wrapper">
                    <img src="{{ asset('image/sticker.gif') }}" alt="Stiker dan label" class="img-fluid  kategori-image">
                </div>
                <p class="mt-2 text-dark">Stiker dan Label</p>
            </a>
            <a href="{{ route('produk.byKategori', ['kategoriId' => 4]) }}" class="text-center text-decoration-none kategori-item">
                <div class="kategori-image-wrapper">
                    <img src="{{ asset('image/bag.gif') }}" alt="Merchandise dan souvenir" class="img-fluid  kategori-image">
                </div>
                <p class="mt-2 text-dark">Merchandise dan Souvenir</p>
            </a>
            <a href="{{ route('produk.byKategori', ['kategoriId' => 3]) }}" class="text-center text-decoration-none kategori-item">
                <div class="kategori-image-wrapper">
                    <img src="{{ asset('image/printer.gif') }}" alt="Print kertas" class="img-fluid  kategori-image">
                </div>
                <p class="mt-2 text-dark">Print Kertas</p>
            </a>
            <a href="{{ route('produk.byKategori', ['kategoriId' => 2]) }}" class="text-center text-decoration-none kategori-item">
                <div class="kategori-image-wrapper">
                    <img src="{{ asset('image/banner2.gif') }}" alt="Spanduk dan banner" class="img-fluid  kategori-image">
                </div>
                <p class="mt-2 text-dark">Spanduk</p>
            </a>
        </div>
    </section>

    <section class="container">
        <h1 class="text-center">Produk Kategori {{ $kategori->nama }}</h1>
        <div class="row justify-content-center gap-4">
            @foreach($produk as $item)
            <a href="{{ route('produk.show', ['produk' => $item->id]) }}" class="col-md-3 col-sm-12 product-card d-flex justify-content-center align-items-center flex-column gap-2 p-3 rounded" style="text-decoration: none;">
                <img src="{{ asset('storage/produk/' . basename($item->gambar)) }}" alt="{{ $item->nama }}" class="img-fluid" style="width: 300px; height: 300px; object-fit: cover">
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

        {{ $produk->links() }}
    </section>

    <style>
        .product-card {
            background-color: rgba(255, 140, 0, 0.8); 
            color: #fff; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); 
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
        }

        .product-card:hover {
            transform: translateY(-5px); 
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4); 
        }

        .product-name {
            color: #fff; 
            font-size: 1.25rem; 
            font-weight: bold;
        }

        .product-price {
            color: #ffeb3b;
            font-size: 1.5rem; 
            font-weight: bold; 
        }
        
    .kategori-item {
        display: flex;
        flex-direction: column;
        align-items: center; 
        justify-content: center;
    }

    .kategori-item:hover {
        transform: translateY(-5px);
        box-shadow:  10 10px 10px rgba(0, 0, 0, 0.2);
    }

    .kategori-image-wrapper {
        width: 60px;
        height: 60px;
        padding: 5px;
        border: 2px solid #ddd;
        border-radius: 10px; /* Sudut kotak */
        background-color: #fff;
        transition: border-color 0.3s ease, box-shadow 0.3s ease, width 0.3s ease, height 0.3s ease, border-radius 0.3s ease;
        margin-top: 10px;
    }

    .kategori-item:hover .kategori-image-wrapper {
        border-color: #007bff;
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.2);
        width: 80px;
        height: 80px;
    }

    .kategori-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
        transition: transform 0.3s ease;
    }

    .kategori-item:hover .kategori-image {
        transform: scale(1.1);}
</style>

</x-layout-home>

<x-layout-home>
    <x-slot:title>
        Produk
    </x-slot:title>

    <section class="container">
        <div class="row justify-content-center gap-4">
            @foreach($produk as $item)
            <a href="{{ route('produk.show', ['produk' => $item->id]) }}" class="col-md-3 col-sm-12 product-card d-flex justify-content-center align-items-center flex-column gap-2 p-3 rounded" style="text-decoration: none;">
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
        }

        .product-price {
            color: #ffeb3b; 
            font-size: 1.5rem; 
        }
    </style>
</x-layout-home>

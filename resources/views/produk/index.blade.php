<x-layout-home>
    <x-slot:title>
        Produk
    </x-slot:title>
    <style>
        .link-product.active {
            text-decoration: underline !important;
        }
    </style>
    <section class="container py-5">
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Kategori</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        @php
                            $kategoriId = request()->get('kategori_id');
                        @endphp
                        @foreach ($kategori as $kat)
                        <li class="list-group-item">
                            <a href="{{ route('produk.index') }}?kategori_id={{$kat->id}}" class="text-decoration-none text-black link-product @if ($kategoriId == $kat->id) active @endif">{{ $kat->nama }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-9">
                <div class="row row-cols-5 row-cols-md-3 mb-3">
                    @foreach($produk as $item)
                    <div class="col mb-3">
                        <a href="{{ route('produk.show', ['produk' => $item->id]) }}" class="product-card d-flex justify-content-center align-items-center flex-column gap-2 p-3 rounded" style="text-decoration: none;">
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
                    </div>
                    @endforeach
                </div>

                {{ $produk->appends(request()->query())->links() }}
            </div>
        </div>
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

<x-dashboard-template>
    <x-slot:title>
        Produk
    </x-slot:title>

    <x-slot:dropdownMaster>
        1
    </x-slot:dropdownMaster>

    @if ($errors->any())
        <div class="alert alert-danger w-100">
            @foreach ($errors->all() as $error)
                <p class="m-0 p-0">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if(session()->get('message'))
        <div class="alert alert-success w-100">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="border shadow p-4 d-flex flex-column gap-4">
        <h2 class="text-center">Produk</h2>

        <div>
            <a href="{{ route('master.produk.create') }}" class="btn btn-primary">Tambah</a>
        </div>

        <table class="table table-bordered">
        <tr>
            <th style="font-weight: bold;">Id</th>
            <th style="font-weight: bold;">Gambar</th>
            <th style="font-weight: bold;">Nama Produk</th>
            <th style="font-weight: bold;">Kategori</th>
            <th style="font-weight: bold;">Harga</th>
            <th style="font-weight: bold;">Bobot</th>
            <th>
                <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'stok', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}" 
                style="text-decoration: none; font-weight: bold; color: #000;">
                    Stok
                    @if(request('sort_by') == 'stok')
                        <i class="fas fa-sort-{{ request('sort_order') == 'asc' ? 'up' : 'down' }}" 
                        style="font-size: 1.2rem;" 
                        title="Urutkan berdasarkan Stok"></i>
                    @else
                        <i class="fas fa-sort" style="font-size: 1.2rem;" title="Klik untuk mengurutkan berdasarkan Stok"></i>
                    @endif
                </a>
            </th>
            <th style="font-weight: bold;">Aksi</th>
        </tr>
            @foreach ($produk as $item)
            <tr>
                <td>{{ ($produk->currentpage()-1) * $produk->perpage() + $loop->index + 1 }}</td>
                <td>
                    <img src="{{ asset('storage/produk/' . basename($item->gambar)) }}" alt="" width="100">
                </td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->kategori->nama }}</td>
                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td>{{ $item->bobot }} gr</td>
                <td>{{ $item->stok }}</td>
                <td>
                    <form action="{{  route('master.produk.destroy', ['produk' => $item->id]) }}" method="post">
                        @csrf
                        @method('delete')
                        <a href="{{ route('master.produk.edit', ['produk' => $item->id]) }}" class="btn btn-primary">Edit</a>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>

        {{ $produk->appends(request()->query())->links() }}
    </div>
</x-dashboard-template>

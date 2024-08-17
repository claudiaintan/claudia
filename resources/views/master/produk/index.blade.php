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
                <td>Id</td>
                <td>Gambar</td>
                <td>Nama Produk</td>
                <td>Kategori</td>
                <td>Harga</td>
                <td>Bobot</td>
                <td>Aksi</td>
            </tr>
            @foreach ($produk as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>
                    <img src="/{{ $item->gambar }}" alt="" width="100">
                </td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->kategori->nama }}</td>
                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td>{{ $item->bobot }} gr</td>
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

        {{ $produk->links() }}
    </div>
</x-dashboard-template>

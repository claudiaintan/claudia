<x-dashboard-template>
    <x-slot:title>
        Edit Produk
    </x-slot:title>

    <x-slot:dropdownMaster>
        1
    </x-slot:dropdownMaster>


    <div class="border shadow rounded p-4">
        <h1 class="text-center">Edit Produk</h1>

        <form action="{{ route('master.produk.update', ['produk' => $produk->id]) }}" method="post" class="d-flex flex-column gap-2 p-2" enctype='multipart/form-data'>
            @csrf
            @method('put')

            <div class="form-group">
                <label for="username" class="form-label">Nama Produk</label>
                <input type="text" name="nama" id="username" placeholder="Nama Produk" class="form-control" value="{{ $produk->nama }}">
            </div>

            <div class="form-group">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" name="harga" id="harga" placeholder="Harga" class="form-control" data-format-number  oninput="formatNumber(this)" value="{{ $produk->harga }}">
            </div>

            <div class="form-group">
                <label for="bobot" class="form-label">Bobot</label>
                <div class="input-group">
                <input type="number" name="bobot" id="bobot" placeholder="Bobot" class="form-control" min="0" value="{{ $produk->bobot }}">
                <span class="input-group-text">gr</span>
                </div>
            </div>

            <div class="form-group">
                <label for="kategori" class="form-label">Kategori</label>
                <select name="kategori_id" id="kategori" class="form-control">
                @foreach($kategori as $item)
                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="file" name="gambar" id="gambar" placeholder="Gambar" class="form-control">
            </div>

            @if(session()->get('message'))
                <div class="alert alert-success w-100">
                    {{ session()->get('message') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger pt-3">
                    @foreach ($errors->all() as $error)
                        <p class="m-0 p-0">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="form-group w-100 pt-3">
                <input type="submit" value="Edit" class="btn btn-primary w-100">
            </div>
        </form>
    </div>
</x-dashboard-template>


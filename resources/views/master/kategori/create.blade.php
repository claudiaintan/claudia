<x-dashboard-template>
    <x-slot:title>
        Tambah Kategori
    </x-slot:title>

    <x-slot:dropdownMaster>
        1
    </x-slot:dropdownMaster>


    <div class="border shadow rounded p-4">
        <h1 class="text-center">Tambah Kategori</h1>

        <form action="{{ route('master.kategori.store') }}" method="post" class="d-flex flex-column gap-2 p-2" enctype='multipart/form-data'>
            @csrf

            <div class="form-group">
                <label for="nama" class="form-label">Nama Kategori</label>
                <input type="text" name="nama" id="nama" placeholder="Nama Kategori" class="form-control">
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
                <input type="submit" value="Tambah" class="btn btn-primary w-100">
            </div>
        </form>
    </div>
</x-dashboard-template>


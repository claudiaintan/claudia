<x-dashboard-template>
    <x-slot:title>
        Tambah Pelanggan
    </x-slot:title>

    <x-slot:dropdownMaster>
        1
    </x-slot:dropdownMaster>


    <div class="border shadow rounded p-4">
        <h1 class="text-center">Tambah Pelanggan</h1>

        <form action="{{ route('master.pelanggan.store') }}" method="post" class="d-flex flex-column gap-2 p-2">
            @csrf

            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="nama" id="username" placeholder="Username" class="form-control">
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" class="form-control">
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" class="form-control">
            </div>

            <div class="form-group">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" name="alamat" id="alamat" placeholder="Alamat" class="form-control">
            </div>

            <div class="form-group">
                <label for="no_telp" class="form-label">No Telp</label>
                <input type="text" name="no_telp" id="no_telp" placeholder="No Telpon" class="form-control">
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


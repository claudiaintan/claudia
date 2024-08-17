<x-dashboard-template>
    <x-slot:title>
        Pelanggan
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
        <h2 class="text-center">Pelanggan</h2>

        <div>
            <a href="{{ route('master.pelanggan.create') }}" class="btn btn-primary">Tambah</a>
        </div>

        <table class="table table-bordered">
            <tr>
                <td>Id</td>
                <td>Nama</td>
                <td>Email</td>
                <td>Alamat</td>
                <td>No Telp</td>
                <td>Aksi</td>
            </tr>
            @foreach ($user as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->pelanggan->alamat }}</td>
                <td>{{ $item->pelanggan->no_telp }}</td>
                <td>
                    <form action="{{  route('master.pelanggan.destroy', ['pelanggan' => $item->id]) }}" method="post">
                        @csrf
                        @method('delete')
                        <a href="{{ route('master.pelanggan.edit', ['pelanggan' => $item->id]) }}" class="btn btn-primary">Edit</a>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>

        {{ $user->links() }}
    </div>
</x-dashboard-template>

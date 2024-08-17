<x-dashboard-template>
    <x-slot:title>
        Kategori
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
        <h2 class="text-center">Kategori</h2>

        <div>
            <a href="{{ route('master.kategori.create') }}" class="btn btn-primary">Tambah</a>
        </div>

        <table class="table table-bordered">
            <tr>
                <td>Id</td>
                <td>Nama Kategori</td>
                <td>Aksi</td>
            </tr>
            @foreach ($kategori as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama }}</td>
                <td>
                    <form action="{{  route('master.kategori.destroy', ['kategori' => $item->id]) }}" method="post">
                        @csrf
                        @method('delete')
                        <a href="{{ route('master.kategori.edit', ['kategori' => $item->id]) }}" class="btn btn-primary">Edit</a>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>

        {{ $kategori->links() }}
    </div>
</x-dashboard-template>

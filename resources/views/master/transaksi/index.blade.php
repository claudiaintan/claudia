<x-dashboard-template>
    <x-slot:title>
        Daftar Transaksi
    </x-slot:title>

    <x-slot:dropdownTransaksi>
        1
    </x-slot:dropdownTransaksi>

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
        <h2 class="text-center">Daftar Transaksi</h2>
        <div>
        <a href="{{ route('master.transaksi.cetak') }}" target="_blank" class="btn btn-primary">Cetak</a>
        </div>

        <table class="table table-bordered">
            <tr>
                <td>Id</td>
                <td>Pelanggan</td>
                <td>Status Pengiriman</td>
                <td>Status Bayar</td>
                <td>Tanggal</td>
                <td>Aksi</td>
            </tr>
            @foreach ($transaksi as $item)
            <tr>
                <td>{{ ($transaksi->currentpage()-1) * $transaksi->perpage() + $loop->index + 1 }}</td>
                <td>
                    {{ $item->pelanggan->user->name }}
                </td>
                <td>{{ $item->status->display() }}</td>
                <td>{{ $item->buktiPembayaran ? $item->buktiPembayaran->status->display() : "Belum Bayar" }}</td>
                <td>{{ $item->created_at }}</td>
                <td>
                    <form action="{{  route('master.transaksi.destroy', ['transaksi' => $item->id]) }}" method="post">
                        @csrf
                        @method('delete')
                        <a href="{{ route('master.transaksi.edit', ['transaksi' => $item->id]) }}" class="btn btn-primary">Update</a>
                        <a href="{{ route('master.transaksi.show', ['transaksi' => $item->id]) }}" class="btn btn-primary">Detail</a>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>

        {{ $transaksi->appends(request()->query())->links() }}
    </div>
</x-dashboard-template>

<x-dashboard-template>
    <x-slot:title>
        Dashboard
    </x-slot:title>

    <style>
        .bg-blue {
            background-color: blue;
        }
        .bg-orange {
            background-color: orange;
        }
        .bg-red {
            background-color: red;
        }
        .icon-size {
            width: 42px;
            height: 42px;
        }
    </style>

    <h1 class="text-center my-4">Selamat datang {{ auth()->user()->name }}</h1>
    <div class="d-flex flex-column gap-4">
        <div class="d-flex gap-1 md-flex-column">
            <!-- Pelanggan Card -->
            <div class="d-flex shadow rounded gap-2 w-100">
                <div class="d-flex justify-content-center align-items-center bg-blue rounded p-3">
                    <svg class="text-white icon-size" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
                        <path stroke="none" d="M0 0h24v24H0z"/>  
                        <circle cx="12" cy="7" r="4" />  
                        <path d="M5.5 21v-2a6.5 6.5 0 0 1 13 0v2" />
                    </svg>
                </div>
                <a class="nav-link {{ Route::currentRouteName() == 'master.pelanggan.index' ? 'active' : '' }}" href="{{ route('master.pelanggan.index') }}">
                    <div class="d-flex flex-column justify-content-between py-2 pe-4">
                        <h6 class="m-0 p-0">Pelanggan</h6>
                        <p class="m-0 p-0">{{ $pelanggan }}</p>
                    </div>
                </a>
            </div>
            <!-- Transaksi Card -->
            <div class="d-flex shadow rounded gap-2 w-100">
                <div class="d-flex justify-content-center align-items-center bg-orange rounded p-3">
                    <svg class="text-white icon-size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">  
                        <circle cx="9" cy="21" r="1" />  
                        <circle cx="20" cy="21" r="1" />  
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                    </svg>
                </div>
                <a class="nav-link {{ Route::currentRouteName() == 'master.transaksi.index' ? 'active' : '' }}" href="{{ route('master.transaksi.index') }}">
                    <div class="d-flex flex-column justify-content-between py-2 pe-4">
                        <h6 class="m-0 p-0">Transaksi</h6>
                        <p class="m-0 p-0">{{ $transaksi }}</p>
                    </div>
                </a>
            </div>
            <!-- Transaksi Berhasil Card -->
            <div class="d-flex shadow rounded gap-2 w-100">
                <div class="d-flex justify-content-center align-items-center bg-red rounded p-3">
                    <svg class="text-white icon-size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2a9 9 0 0 0-9 9v1h18v-1a9 9 0 0 0-9-9zm0 14.5a4.5 4.5 0 0 1-4.5-4.5H7a3.5 3.5 0 1 0 7 0h1.5a4.5 4.5 0 0 1-4.5 4.5zm0-7a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5z"/>
                    </svg>
                </div>
                <a class="nav-link {{ Route::currentRouteName() == 'master.transaksi.index' ? 'active' : '' }}" href="{{ route('master.transaksi.index') }}">
                    <div class="d-flex flex-column justify-content-between py-2 pe-4">
                        <h6 class="m-0 p-0">Transaksi Berhasil</h6>
                        <p class="m-0 p-0">{{ $transaksiBerhasil }}</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-dashboard-template>
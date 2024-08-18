<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Title' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        .sidebar {
            background: #333;
            color: white;
            min-height: 100vh;
            width: 250px;
            position: fixed;
            font-weight: bold;
            transition: transform 0.3s ease;
            transform: translateX(0);
        }
        .sidebar.collapsed {
            transform: translateX(-250px);
        }
        .sidebar .nav-link {
            color: white;
            font-weight: bold;
            display: flex;
            align-items: center;
            padding: 10px;
            text-decoration: none;
        }
        .sidebar .nav-link .fa {
            margin-right: 20px;
        }
        .sidebar .nav-link.active {
            background-color: #444;
            color: white;
        }
        .topbar {
            background: #ff6600;
            color: white;
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            font-weight: bold;
        }
        .topbar img {
            height: 42px;
        }
        .topbar .profile {
            border-radius: 50%;
            height: 32px;
            width: 32px;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            font-weight: normal;
            color: #333;
            transition: margin-left 0.3s ease;
        }
        .content.shifted {
            margin-left: 0;
        }
        .dropdown-menu {
            font-weight: normal;
        }

        .select2-container {
            width: 100% !important;
        }
    </style>
</head>
<body>

<div class="topbar d-flex align-items-center p-2">
    <div class="d-flex align-items-center">
        <img src="{{ asset('image/footer-logo.jpg') }}" alt="Logo">
        <button class="btn btn-outline-light ms-2" id="sidebar-hamburger">
            <svg class="text-white" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>
    <div class="d-flex ms-auto">
        <div class="nav-item dropdown">
            <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ auth()->user()->name }}
                <img src="{{ asset('image/default-profile.png') }}" alt="Profile" class="profile">
            </a>
            <ul class="dropdown-menu">
                <li>
                    <form action="{{ route('auth.logout') }}" method="post" class="dropdown-item">
                        @csrf
                        <button type="submit" class="text-danger" style="border: 0; background: transparent;">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="sidebar d-flex flex-column p-3">
    @if (auth()->user()->hasRole('ADMIN'))
    <h5>Dashboard</h5>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="fas fa-tachometer-alt"></i>
                Dashboard
            </a>
        </li>
    </ul>

    <h5>Management</h5>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#masterMenu" role="button" aria-expanded="false" aria-controls="masterMenu">
                <i class="fas fa-database"></i>
                Data Keseluruhan
            </a>
            <div class="collapse" id="masterMenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'master.produk.index' ? 'active' : '' }}" href="{{ route('master.produk.index') }}">
                            <i class="fas fa-box"></i>
                            Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'master.kategori.index' ? 'active' : '' }}" href="{{ route('master.kategori.index') }}">
                            <i class="fas fa-tags"></i>
                            Kategori
                        </a>
                    </li>
                    @if(auth()->user()->hasRole('ADMIN'))
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'master.pelanggan.index' ? 'active' : '' }}" href="{{ route('master.pelanggan.index') }}">
                            <i class="fas fa-users"></i>
                            Pelanggan
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </li>
    </ul>

    <h5>Transaksi</h5>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#transaksiMenu" role="button" aria-expanded="false" aria-controls="transaksiMenu">
                <i class="fas fa-exchange-alt"></i>
                Transaksi
            </a>
            <div class="collapse" id="transaksiMenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'master.transaksi.index' ? 'active' : '' }}" href="{{ route('master.transaksi.index') }}">
                            <i class="fas fa-receipt"></i>
                            Transaksi
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
    @endif

    <h5>Pengaturan</h5>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'profile.edit' ? 'active' : '' }}" href="{{ route('dashboard.profile.edit') }}">
                <i class="fas fa-cogs"></i>
                Pengaturan User
            </a>
        </li>
    </ul>
</div>

<div class="content">
    {{ $slot }}
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script>
    document.getElementById('sidebar-hamburger').addEventListener('click', function() {
        const sidebar = document.querySelector('.sidebar');
        const content = document.querySelector('.content');
        sidebar.classList.toggle('collapsed');
        content.classList.toggle('shifted');
    });
    $(function () {
        $('.select2').select2({
            allowClear: true,
        })
    });
</script>
@isset($scripts)
    {{ $scripts }}
@endisset
</body>
</html>

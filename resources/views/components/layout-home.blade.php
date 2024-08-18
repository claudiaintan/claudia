<x-layout>
    <x-slot:title>
        {{ $title ?? "Title" }}
    </x-slot:title>

    <x-slot:head>
        {{ $head ?? "" }}
    </x-slot:head>

    <style>
        body {
            grid-template-rows: auto 1fr;
            display: grid;
            height: 100vh;
            margin: 0;
        }
        .footer {
            background-color: rgba(255, 165, 0, 0.8); /* Light orange with transparency */
            color: #fff; /* White text color */
            padding: 40px 0;
        }
        .footer-logo {
            max-width: 250px;
        }
        .footer-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .footer-list li {
            margin-bottom: 10px;
        }
        .footer-link {
            color: #fff; /* White text color */
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s;
        }
        .footer-link:hover {
            color: #ff9f00; /* Adjust hover color as needed */
        }
        .footer-info {
            font-size: 16px;
            line-height: 1.5;
        }
        .footer-info h4 {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .search-form {
            display: flex;
            align-items: center;
        }
        .search-input {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            padding: 0.5rem 1rem;
            width: 200px;
        }
        .search-button {
            background: #ff9f00; /* Matching color */
            border: none;
            border-radius: 0.25rem;
            color: #fff;
            padding: 0.5rem 1rem;
            margin-left: -1px; /* To merge with input field */
            cursor: pointer;
        }
        .search-button:hover {
            background: #e68a00;
        }
        .navbar-custom {
            background-color: rgba(255, 165, 0, 0.8); /* Transparent orange */
        }
        .navbar-nav .nav-item .nav-link {
            padding: 0.5rem 1rem; /* Adjust padding */
        }
        .navbar-brand img {
            height: 32px;
        }
    </style>

    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('image/logo.jpeg') }}" alt="Logo" class="img-fluid rounded-circle">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : ''}}" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'produk.index' ? 'active' : ''}}" href="{{ route('produk.index') }}">Produk</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Route::is('produk.byKategori') ? 'active' : ''}}" href="#" id="kategoriDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kategori
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="kategoriDropdown">
                            <li><a class="dropdown-item" href="{{ route('produk.byKategori', ['kategoriId' => 1]) }}">Stiker dan label</a></li>
                            <li><a class="dropdown-item" href="{{ route('produk.byKategori', ['kategoriId' => 2]) }}">Print kertas - Print on paper</a></li>
                            <li><a class="dropdown-item" href="{{ route('produk.byKategori', ['kategoriId' => 3]) }}">Merchandise dan souvenir</a></li>
                            <li><a class="dropdown-item" href="{{ route('produk.byKategori', ['kategoriId' => 4]) }}">Spanduk dan banner</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- Search Form -->
                <form class="search-form ms-auto" action="{{ route('produk.index') }}" method="get">
                    <input type="text" name="search" class="search-input" placeholder="Search products...">
                    <button type="submit" class="search-button">
                        <svg width="24" height="24" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.742a5.5 5.5 0 1 0-1.414 1.414A5.48 5.48 0 0 0 11.742 10.742zM12 5.5a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0z"/>
                        </svg>
                    </button>
                </form>

                @auth
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex gap-2">
                    <li class="nav-item">
                        <a href="{{ route('pelanggan.keranjang.index') }}" class="nav-link">
                            <svg class="text-white" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"/>
                                <circle cx="9" cy="19" r="2" />
                                <circle cx="17" cy="19" r="2" />
                                <path d="M3 3h2l2 12a3 3 0 0 0 3 2h7a3 3 0 0 0 3 -2l1 -7h-15.2" />
                            </svg>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            @if(auth()->user()->hasRole('ADMIN'))
                            <li><a class="dropdown-item" href="{{  route('dashboard')  }}">Dashboard</a></li>
                            @else
                            <li><a class="dropdown-item" href="{{  route('profile.edit', Auth::id())  }}">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="{{  route('pelanggan.transaksi.index')  }}">Histori Transaksi</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('auth.logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                @endauth
                @guest
                    <a href="{{ route('auth.login') }}" class="btn btn-outline-light">Login</a>
                    <a href="{{ route('auth.register') }}" class="btn btn-primary">Sign up</a>
                @endguest
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer class="footer">
        <div class="container d-flex flex-md-row flex-column align-items-start gap-4">
            <div class="w-100">
                <img src="{{ asset('image/footer-logo.jpg') }}" alt="Footer Logo" class="img-fluid footer-logo">
            </div>
            <div class="w-100">
                <h3 class="mb-4">About</h3>
                <ul class="footer-list">
                    <li><a href="{{ route('home') }}" class="footer-link">Home</a></li>
                    <li><a href="{{ route('produk.index') }}" class="footer-link">Produk</a></li>
                </ul>
            </div>
            <div class="w-100">
                <h3 class="mb-4">Sosmed</h3>
                <ul class="footer-list">
                    <li><a href="https://wa.me/081277197385" class="footer-link">WhatsApp</a></li>
                    <li><a href="https://www.instagram.com/dpcrumahqeeta/" class="footer-link">Instagram</a></li>
                </ul>
            </div>
            <div class="w-100 footer-info">
            <h4>Contact Us</h4>
            <p><strong>Email:</strong> <a href="mailto:dpc.rumahqeeta@gmail.com" class="footer-link">dpc.rumahqeeta@gmail.com</a></p>
            <p><strong>Address:</strong>
            <a href="https://maps.app.goo.gl/LW2YCLYPFQMXgmD6A" target="_blank" class="footer-link" style="display: block; text-align: justify;">
                Sukorejo RT 26/RW 09, Gang 1, Kroyo, Kec. Karangmalang, Kabupaten Sragen, Jawa Tengah 57221
            </a>
            </p>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @isset($scripts)
        {{ $scripts }}
    @endisset
</x-layout>

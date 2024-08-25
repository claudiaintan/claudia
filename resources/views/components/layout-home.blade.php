<x-layout>
    <x-slot:title>
        {{ $title ?? "Title" }}
    </x-slot:title>

    <x-slot:head>
        {{ $head ?? "" }}
    </x-slot:head>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        body {
            grid-template-rows: auto 1fr;
            display: grid;
            height: 100vh;
            margin: 0;
        }
        .footer {
            background-color: rgba(255, 165, 0, 0.8);
            color: #fff;
            padding: 40px 0;
            border-top: 1px solid #e68a00;
        }
        .footer-logo {
            max-width: 250px;
            margin-bottom: 20px;
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
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s, text-shadow 0.3s;
        }
        .footer-link:hover {
            color: #ff9f00;
            text-shadow: 0 0 5px #ff9f00;
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
            transition: background 0.3s;
        }
        .search-button:hover {
            background: #e68a00;
        }
        .navbar-custom {
            background-color: rgba(255, 165, 0, 0.8);
            border-bottom: 1px solid #e68a00;
        }
        .navbar-nav .nav-item .nav-link {
            padding: 0.5rem 1rem;
            transition: color 0.3s, text-shadow 0.3s;
        }
        .navbar-nav .nav-item .nav-link:hover {
            color: #ff9f00;
            text-shadow: 0 0 5px #ff9f00;
        }
        .navbar-brand img {
            height: 32px;
        }
        .select2-container {
            width: 100% !important;
        }
        footer {
            background-color: rgba(255, 165, 0, 0.8);
            color: #fff;
            padding: 20px;
        }
    </style>

    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('image/dpc.png') }}" alt="Logo" class="img-fluid rounded-circle" style="width: 110px; height: 50px;">
            </a>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : ''}}" aria-current="page" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'produk.index' ? 'active' : ''}}" href="{{ route('produk.index') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'cara-pemesanan' ? 'active' : ''}}" href="{{ route('cara-pemesanan') }}">Cara Pemesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#contactUsModal">Kontak Kami</a>
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
                    <li><a href="https://wa.me/6281277197385" class="footer-link">WhatsApp</a></li>
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
    <div class="modal fade" id="contactUsModal" tabindex="-1" aria-labelledby="contactUsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactUsModalLabel">Kontak Kami</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card shadow-sm border-0" style="background-color: rgba(255, 223, 186, 0.5); border-radius: 8px;">
                    <div class="card-body">
                        <h6 class="text-muted">Alamat Toko</h6>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.2590104399114!2d111.02524327402568!3d-7.43656647326663!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a03e77ab7f251%3A0xaa714efff552c20d!2sRUMAH%20QEETA%20DIGITAL%20PRINTING!5e0!3m2!1sid!2sid!4v1724200697169!5m2!1sid!2sid" width="100%" height="200" style="border:0; border-radius: 5px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                        <h6 class="mt-4 text-muted">Kirim Pesan Disini</h6>
                        <form id="contactUsForm" action="#" method="get" onsubmit="sendMessage(); return false;">
                            <div class="mb-3">
                                <label for="name" class="form-label">Masukkan Nama Anda</label>
                                <input type="text" class="form-control shadow-sm" id="name" name="name" placeholder="Enter your name" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Masukkan Pesan Anda</label>
                                <textarea class="form-control shadow-sm" id="message" name="message" rows="4" placeholder="Enter your message" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-warning w-100 shadow-sm">Kirim</button>
                            <div id="responseMessage" class="mt-3"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    function sendMessage() {
        var name = encodeURIComponent(document.getElementById('name').value);
        var message = encodeURIComponent(document.getElementById('message').value);
        var whatsappNumber = '628812985315';
        var url = `https://wa.me/${whatsappNumber}?text=Hello,%20my%20name%20is%20${name}%20and%20my%20message%20is:%20${message}`;

        // Redirect to WhatsApp
        window.location.href = url;

        // Show a success message
        document.getElementById('responseMessage').innerHTML = '<div class="alert alert-success">Pesan telah dikirim</div>';
    }
</script>

    @isset($scripts)
        {{ $scripts }}
    @endisset
</x-layout>

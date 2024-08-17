<x-layout-home>
    <x-slot:title>
        Registrasi
    </x-slot:title>

    <style>
        .registration-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            max-width: 300px;
            width: 100%;
            margin: 20px;
        }
        .registration-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 15px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .form-label {
            font-weight: 600;
            font-size: 14px;
        }
        .form-control {
            border-radius: 4px;
            border: 1px solid #ccc;
            padding: 8px;
            font-size: 14px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            padding: 10px;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .alert {
            border-radius: 4px;
            font-size: 14px;
            padding: 8px;
            margin-bottom: 10px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .login-link {
            color: #007bff;
            text-decoration: none;
        }
        .login-link:hover {
            text-decoration: underline;
        }
    </style>

    <div class="d-flex justify-content-center align-items-center" style="width: 100vw; height: 100vh">
        <div class="registration-container">
            <h1 class="registration-title">Registrasi</h1>

            <form action="{{ route('auth.post-signup') }}" method="post" class="d-flex flex-column">
                @csrf

                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="name" id="username" placeholder="Username" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email" class="form-control">
                </div>

                <div class="form-group">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" name="alamat" id="alamat" placeholder="Alamat" class="form-control">
                </div>

                <div class="form-group">
                    <label for="notelp" class="form-label">No Telpon</label>
                    <input type="text" name="no_telp" id="notelp" placeholder="No Telpon" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                </div>

                <p class="text-center mb-3">
                    Sudah Memiliki Akun? <a href="{{ route('auth.login') }}" class="login-link">Login</a>
                </p>

                @if(session()->get('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p class="m-0">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div class="form-group">
                    <input type="submit" value="Register" class="btn btn-primary w-100">
                </div>
            </form>
        </div>
    </div>
</x-layout-home>

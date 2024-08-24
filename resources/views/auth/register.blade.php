<x-layout-home>
    <x-slot:title>
        Registrasi
    </x-slot:title>

    <style>
        body {
            background: linear-gradient(135deg, #ffe29f, #ffa751);
        }
        .registration-container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            padding: 30px;
            max-width: 400px;
            width: 100%;
            margin: 20px;
            border: 2px solid #ffa751;
        }
        .registration-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
            color: #ff8c00;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-label {
            font-weight: 600;
            font-size: 16px;
            color: #ff8c00;
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            border-color: #ffa751;
            box-shadow: 0 0 0 3px rgba(255, 167, 81, 0.3);
        }
        .btn-primary {
            background-color: #ffa751;
            border: none;
            border-radius: 8px;
            color: #fff;
            padding: 12px;
            font-size: 16px;
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .btn-primary:hover {
            background-color: #ff8c00;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .alert {
            border-radius: 8px;
            font-size: 16px;
            padding: 12px;
            margin-bottom: 20px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-left: 5px solid #28a745;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 5px solid #dc3545;
        }
        .login-link {
            color: #ff8c00;
            text-decoration: none;
            font-weight: 600;
        }
        .login-link:hover {
            text-decoration: underline;
        }
    </style>

    <div class="d-flex justify-content-center align-items-center" style="width: 100vw; height: 100vh;">
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

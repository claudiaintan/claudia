<x-layout-home>
    <x-slot:title>
        Login
    </x-slot:title>

    <style>
        body {
            background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
        }
        .login-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            padding: 40px;
            max-width: 400px;
            width: 100%;
            margin: 20px;
        }
        .login-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: 600;
            color: #555;
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(38, 143, 255, 0.2);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            color: #fff;
            padding: 12px;
            font-size: 16px;
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .register-link {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
        }
        .register-link:hover {
            text-decoration: underline;
        }
    </style>

    <div class="d-flex justify-content-center align-items-center" style="width: 100vw; height: 100vh">
        <div class="login-container">
            <h1 class="login-title">Login</h1>

            <form action="{{ route('auth.post-login') }}" method="post" class="d-flex flex-column">
                @csrf

                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" placeholder="Username" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                </div>

                <p class="text-center">
                    Belum Memiliki Akun? <a href="{{ route('auth.register') }}" class="register-link">Register</a>
                </p>

                @if(session()->get('message'))
                    <div class="alert alert-success w-100">
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

                <div class="form-group pt-3">
                    <input type="submit" value="Login" class="btn btn-primary w-100">
                </div>
            </form>
        </div>
    </div>
</x-layout-home>

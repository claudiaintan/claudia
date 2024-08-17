<x-layout-home>
    <x-slot:title>
        Admin Login
    </x-slot:title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap');
        body {
            background: url('path-to-your-background-image.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .login-container {
            background: rgba(255, 87, 34, 0.9);
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            color: #fff;
            max-width: 350px;
            width: 100%;
            padding: 25px;
            margin: 20px;
        }
        .login-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 20px;
            margin-bottom: 15px;
        }
        .login-form {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .login-input {
            border-radius: 4px;
            border: 1px solid #ccc;
            color: #333;
            padding: 10px;
            font-size: 14px;
        }
        .login-button {
            background-color: #333;
            border: none;
            border-radius: 4px;
            color: #fff;
            padding: 10px;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        .login-button:hover {
            background-color: #555;
        }
        .alert {
            border-radius: 4px;
            font-size: 14px;
            padding: 10px;
        }
        .show-password-container {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
        }
        .show-password-container input[type="checkbox"] {
            cursor: pointer;
        }
    </style>

    <div class="d-flex justify-content-center align-items-center" style="width: 100vw; height: 100vh">
        <div class="login-container">
            <h1 class="text-center login-title">Admin Login</h1>

            <form action="{{ route('auth.post-admin-login') }}" method="post" class="d-flex flex-column gap-3 login-form">
                @csrf

                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" placeholder="Username" class="form-control login-input">
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control login-input">
                    <div class="show-password-container">
                        <input type="checkbox" id="show-password">
                        <label for="show-password" class="form-label text-white">Show Password</label>
                    </div>
                </div>

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
                    <input type="submit" value="Login" class="btn btn-primary w-100 login-button">
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('show-password').addEventListener('change', function() {
            const passwordInput = document.getElementById('password');
            passwordInput.type = this.checked ? 'text' : 'password';
        });
    </script>
</x-layout-home>

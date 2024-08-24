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
            background: rgba(255, 152, 0, 0.9); /* Orange-yellow background */
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4); /* Enhanced shadow */
            color: #fff;
            max-width: 350px;
            width: 100%;
            padding: 25px;
            margin: 20px;
            transition: transform 0.3s;
        }
        .login-container:hover {
            transform: scale(1.02); /* Slight zoom effect on hover */
        }
        .login-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 24px; /* Larger title for better visibility */
            margin-bottom: 20px;
            text-align: center;
        }
        .login-form {
            display: flex;
            flex-direction: column;
            gap: 15px; /* Increased gap for better spacing */
        }
        .login-input {
            border-radius: 8px; /* Rounded corners */
            border: 1px solid #fff; /* White border */
            color: #333;
            padding: 12px; /* More padding for comfort */
            font-size: 16px; /* Larger font size for readability */
            transition: border-color 0.3s;
        }
        .login-input:focus {
            border-color: #ffeb3b; /* Yellow border on focus */
            outline: none;
        }
        .login-button {
            background-color: #ff5722; /* Orange button */
            border: none;
            border-radius: 8px;
            color: #fff;
            padding: 12px;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.2s;
        }
        .login-button:hover {
            background-color: #e64a19; /* Darker orange on hover */
            transform: scale(1.05); /* Slightly bigger button on hover */
        }
        .alert {
            border-radius: 4px;
            font-size: 14px;
            padding: 10px;
            margin-top: 10px;
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
            <h1 class="login-title">Admin Login</h1>

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

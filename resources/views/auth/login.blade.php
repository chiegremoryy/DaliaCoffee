<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Sign In | Dalia Coffee</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #d7ccc8, #a1887f);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-wrapper {
            background-color: #fff8f0;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            max-width: 900px;
            width: 100%;
            display: flex;
            overflow: hidden;
        }

        .login-illustration {
            background: linear-gradient(to top, #6d4c41, #4e342e);
            color: white;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .login-illustration img {
            width: 100%;
            max-width: 500px;
            margin-bottom: 20px;
        }

        .login-form {
            flex: 1;
            padding: 40px;
            background-color: #fff8f0;
        }

        .login-form img.logo {
            max-width: 200px;
            display: block;
            margin: 0 auto 20px;
        }

        .login-form h2 {
            font-weight: 600;
            color: #4e342e;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-label {
            color: #5d4037;
        }

        .form-control {
            height: 48px;
            font-size: 16px;
            background-color: #fbe9e7;
            border: 1px solid #d7ccc8;
            color: #4e342e;
        }

        .form-control::placeholder {
            color: #a1887f;
            opacity: 1;
        }

        .form-control:focus {
            border-color: #a1887f;
            box-shadow: 0 0 0 0.15rem rgba(161, 136, 127, 0.25);
        }

        .btn-primary {
            background-color: #6d4c41;
            border: none;
        }

        .btn-primary:hover {
            background-color: #5d4037;
        }

        .register-link {
            margin-top: 20px;
            text-align: center;
            color: #6d4c41;
        }

        .register-link a {
            color: #8d6e63;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
            }

            .login-form {
                padding: 20px;
            }

            .login-illustration {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <!-- Side Illustration -->
        <div class="login-illustration text-center">
            <img src="{{ asset('images/ilustrasi-kopi.png') }}" alt="Coffee Art">
            <p>Welcome back to your cozy corner!☕</p>
        </div>

        <!-- Login Form -->
        <div class="login-form">
            <!-- Logo -->
            <img src="{{ asset('images/dalia-coffee.png') }}" alt="Coffee Shop Logo" class="logo">

            <h2>Sign In</h2>

            @if ($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required placeholder="e.g. barista@coffee.com">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required placeholder="••••••••">
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Admin Login</title>
    <style>
        body {
            background-color: #f5f5f5;
        }
        .box-area {
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .left-box {
            background-color: #FFFFFF;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
        }
        .right-box {
            padding: 40px;
        }
        .header-text h2 {
            font-size: 28px;
            font-weight: 600;
        }
        .header-text p {
            font-size: 16px;
            color: #6c757d;
        }
        .form-control {
            font-size: 16px;
            padding: 12px 16px;
        }
        .btn-primary {
            font-size: 16px;
            padding: 12px 0;
        }
        .form-check-label {
            font-size: 14px;
        }
        .forgot a {
            font-size: 14px;
            color: #6c757d;
            text-decoration: none;
        }
        .forgot a:hover {
            color: #103cbe;
        }
        h2{
            color: #145DA0;
        }
    </style>
</head>
<body>
    <!----------------------- Main Container -------------------------->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <!----------------------- Login Container -------------------------->
        <div class="row box-area">
            <!--------------------------- Left Box ----------------------------->
            <div class="col-md-6 left-box d-flex justify-content-center align-items-center flex-column">
                <div class="featured-image mb-3">
                    <img src="{{ asset('images/admin.png') }}" class="img-fluid" style="width: 400px;">
                </div>
            </div>
            <!-------------------- ------ Right Box ---------------------------->
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Hello, Again!</h2>
                        <p>Welcome back</p>
                    </div>
                    <form method="POST" action="{{ route('dashboard') }}">
                        @csrf
                        <div class="mb-3">
                            <input id="email" type="email" class="form-control form-control-lg bg-light" name="email" value="{{ old('email') }}" placeholder="Email address" required autocomplete="email" autofocus>
                        </div>
                        <div class="mb-3">
                            <input id="password" type="password" class="form-control form-control-lg bg-light" placeholder="Password" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4 d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember" class="form-check-label text-secondary">{{ __('Remember Me') }}</label>
                            </div>
                            <div class="forgot">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-lg btn-primary w-100">{{ __('Login') }}</button>
                        </div>
                        <div class="row">
                            @if (Route::has('register.admin'))
                            <small>Don't have an account? <a href="{{ route('register.admin') }}">{{ __('Register') }}</a></small>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
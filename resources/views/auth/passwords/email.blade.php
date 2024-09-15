<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title of the page -->
    <title>Forgot Password</title>
    <!-- Link to your CSS file -->
    <link rel="stylesheet" href="{{ asset('css/otp.css') }}">
    <!-- Bootstrap CSS (ensure Bootstrap 5 is being used) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @extends('layouts.app')

    @section('content')
        <section class="forgot-password-section d-flex align-items-center justify-content-center min-vh-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-5">
                        <div class="card border-0 otp-verification-card">
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <img src="{{ asset('images/codesent.png') }}" width="350" height="auto" alt="Reset Password">
                                    <h3 class="mt-3 text-title">{{ __('Forgot Password') }}</h3>
                                    <p class="text-muted">Enter your email to reset your password</p>

                                    @if (session('status'))
                                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                            {{ session('status') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="mb-4">
                                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter your email address" required autocomplete="email" autofocus>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">{{ __('Send Password Reset Link') }}</button>
                                    </div>
                                </form>

                                <div class="text-center mt-3">
                                    <a href="{{ route('login') }}" class="text-decoration-none">Back to Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
</body>
</html>

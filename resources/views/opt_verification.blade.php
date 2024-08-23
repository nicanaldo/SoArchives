<link rel="stylesheet" href="{{ asset('css/otp.css') }}">
@extends('layouts.app')
@section('content')
    <section class="otp-verification-section vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-5">
                    <div class="card otp-verification-card border-0">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <!-- Optional logo image -->
                                <img src="{{ asset('images/codesent.png') }}" width="300" height="auto"
                                    alt="Verification">
                                <h3 class="text-title">Email Verification</h3>
                                <p class="text-muted">Enter the 6-digit code we sent to your email</p>
                                @if (session('activated'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('activated') }}
                                    </div>
                                @endif
                                @if (session('incorrect'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('incorrect') }}
                                    </div>
                                @endif
                            </div>
                            <form action="{{ route('verifyotp') }}" method="POST" class="needs-validation">
                                @csrf
                                <div class="mb-4 d-flex justify-content-center">
                                    <!-- OTP input fields -->
                                    <input type="number" name="token" class="form-control text-center fs-1"
                                        placeholder="XXXXXX">
                                    <div class="invalid-feedback">
                                        Please enter the 6-digit code.
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-primary text-light" type="submit"
                                        name="btnSubmit">Submit</button>
                                </div>
                                <div class="text-center mt-3">
                                    <a href="" class="text-decoration-none">Resend Code</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

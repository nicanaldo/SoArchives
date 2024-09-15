<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/logins/login-9/assets/css/login-9.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Login to SOARchives</title>

    <!-- Tab Logo -->
    <link rel="shortcut icon" href="{{ asset('images/tab-logo.ico') }}" type="image/x-icon">

    <!-- CSS File -->
    <link rel="stylesheet" href="{{ asset('css/logReg.css') }}">

    <!-- Include SweetAlert CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('showLogoutConfirm'))
                Swal.fire({
                    title: 'Logout',
                    text: 'You are already logged in. Do you want to log out?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Logout',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Perform logout if confirmed
                        window.location.href = "{{ route('logout') }}";
                    } else {
                        // Redirect to home or another page if canceled
                        window.location.href = "{{ url('/home') }}"; // Adjust this URL as needed
                    }
                });
            @endif
        });


    </script>


<script>
    if (window.history && window.history.pushState) {
        window.history.pushState(null, null, window.location.href);
        window.onpopstate = function() {
            window.location.assign('/login'); // Redirect to login if back button is pressed after logout
        };
    }
</script>

    @include('header_and_footer.header')

    <section class="bg-bg py-3 py-md-5 py-xl-8">
        <div class="container">
            <div class="row gy-4 align-items-center">
                <div class="col-12 col-md-6 col-xl-7">
                    <div class="d-flex justify-content-center text-light">
                        <div class="col-12 col-xl-9 bg-transparent">
                            <!-- SOARchives Logo -->
                            <img class="img-fluid rounded" loading="lazy" src="{{ asset('images/finallogo.png') }}"
                                width="300" height="100" alt="SOARchives Logo">
                            <hr class="border-primary-subtle mb-4">
                            <p class="lead mb-5 text-dark">SOARchives is the premier platform dedicated to spotlighting the
                                exceptional talent of artisans and craftsmen from Adamson University.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-5">
                    <div class="card shadow border-0 rounded-5">
                        <div class="card-body p-5 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <h3 class="fw-bold text-color">Welcome back!</h3>
                                        <p class="text-muted mb-5">Login to your account</p>
                                    </div>

                                    @if (session('message'))
                                    <div class="alert alert-info">
                                        {{ session('message') }}
                                    </div>
                                    @endif

                                    @if (session('sessionExpired'))
                                    <div class="alert alert-danger">
                                        {{ session('sessionExpired') }}
                                    </div>
                                    @endif

                                </div>
                            </div>

                            <!-- Display Error Messages -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('login') }}" method="POST" class="needs-validation" novalidate
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row gy-3 overflow-hidden">
                                    <!-- Email Password -->
                                    <div class="col-12">
                                        <label for="validationEmail" class="form-label lead">Email address</label>
                                        <input type="email" class="form-control p-2" id="validationEmail"
                                            name="email" placeholder="Enter email address" required
                                            value="{{ old('email') }}">
                                        <div class="invalid-feedback">
                                            Please provide a valid email address.
                                        </div>
                                    </div>

                                    <div class="col-12 position-relative">
                                        <label for="validationPassword" class="form-label lead">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="validationPassword" name="password"
                                                   placeholder="Enter password" required>
                                            <button class="btn-eye" type="button" id="togglePasswordCreate">
                                                <i class="fa fa-eye-slash"></i>
                                            </button>
                                            <div class="invalid-feedback">
                                                Please provide your password.
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Checkbox and Forgot Password -->
                                    <div class="col-12 d-flex justify-content-between align-items-center mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="rememberMe"
                                                name="rememberMe" {{ old('rememberMe') ? 'checked' : '' }}>
                                            <label class="form-check-label text-muted" for="rememberMe">Remember
                                                Me</label>
                                        </div>
                                        <a href="{{ route('password.request') }}" class="login-a text-decoration-none">Forgot
                                            Password?</a>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn button-color btn-lg text-light" type="submit"
                                                name="btnSubmit">Log in</button>
                                        </div>
                                        <p class="mt-3 text-muted text-center">Don't have an account? <a
                                                href="{{ route('register.seller') }}" class="login-a text-decoration-none">Sign
                                                up</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        // Validation
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        // Eye Icon for Password Hiding
        document.addEventListener('DOMContentLoaded', function() {
            const togglePasswordCreate = document.getElementById('togglePasswordCreate');
            const passwordInputCreate = document.getElementById('validationPassword');

            togglePasswordCreate.addEventListener('click', function() {
                const type = passwordInputCreate.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInputCreate.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        });
    </script>
</body>

</html>

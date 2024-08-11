<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/logins/login-9/assets/css/login-9.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Login as Seller | SOARchives</title>
    <link rel="shortcut icon" href="{{ asset('images/tab-logo.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /* Button for eye */
        .btn-outline-secondary {
            border-width: 1px 1px 1px 0;
            border-color: #ced4da;
            box-shadow: none;
            background-color: none;
        }

        .btn-eye:hover {
            background-color: none;
        }
    </style>

    {{-- @vite('resources/js/app.js') --}}
</head>

<body>

    <!-- Retailer Login -->
    <section class="bg-bg py-3 py-md-5 py-xl-8">
        <div class="container">
            <div class="row gy-4 align-items-center">
                <div class="col-12 col-md-6 col-xl-7">
                    <div class="d-flex justify-content-center text-light">
                        <div class="col-12 col-xl-9">
                            <img class="img-fluid rounded" loading="lazy" src="{{ asset('images/sellerLogo.png') }}" width="300" height="100" alt="BootstrapBrain Logo">
                            <p></p>
                            <hr class="border-primary-subtle mb-4">
                            <p class="lead mb-5">Soarchives is the premier platform dedicated to spotlighting the exceptional talent of artisans and craftsmen from Adamson University.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-5">
                    <div class="card border-0 rounded-5">
                        <div class="card-body p-5 p-md-4 p-xl-5 ">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <h3 class="fw-bold text-color">Welcome back, Klasmeyt!</h3>
                                        <p class="text-muted mb-5">Login to your account</p>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('login') }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                                @csrf
                                <div class="row gy-3 overflow-hidden">

                                    <!-- Email Address -->
                                    <div class="col-12">
                                        <label for="validationEmail" class="form-label">Email address</label>
                                        <input type="email" class="form-control p-2" id="validationEmail" name="email" placeholder="example@adamson.edu.ph" required>
                                        <div class="invalid-feedback">
                                            Please provide a valid Adamson email address.
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div class="col-12 position-relative">
                                        <label for="floatingInput" class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" style="border-width: 1px 0 1px 1px;" class="form-control pe-5" id="floatingInput" name="password" placeholder="********" required>
                                            <button class="btn btn-outline-secondary btn-eye" type="button" id="togglePasswordCreate">
                                                <i class="fa fa-eye-slash"></i>
                                            </button>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please provide your password.
                                        </div>
                                    </div>

                                    <!-- Checkbox and Forgot Password -->
                                    <div class="col-12 d-flex justify-content-between align-items-center mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe" {{ old('rememberMe') ? 'checked' : '' }}>
                                            <label class="form-check-label text-muted" for="rememberMe">Remember Me</label>
                                        </div>
                                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot Password?</a>
                                    </div>

                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn button-color btn-lg text-light" type="submit" name="btnSubmit">Log in</button>
                                        </div>
                                        <p class="mt-3 text-muted text-center">Don't have an account? <a href="{{ route('register.seller') }}" class="text-decoration-none">Sign up</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
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

        document.getElementById('validationEmail').addEventListener('input', function() {
            var emailField = this;
            var emailPattern = /^[a-zA-Z0-9._-]+@adamson\.edu\.ph$/;

            if (emailPattern.test(emailField.value)) {
                emailField.classList.remove('is-invalid');
                emailField.classList.add('is-valid');
            } else {
                emailField.classList.remove('is-valid');
                emailField.classList.add('is-invalid');
            }
        });

        let isDirty = false;

        function markDirty() {
            isDirty = true;
        }

        window.onbeforeunload = function(event) {
            if (isDirty) {
                const message = "You have unsaved changes. Are you sure you want to leave?";
                event.returnValue = message;
                return message;
            }
        };

        window.onload = function() {
            const inputs = document.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.addEventListener('input', markDirty);
            });
        };

        document.addEventListener('DOMContentLoaded', function() {
            const togglePasswordCreate = document.getElementById('togglePasswordCreate');
            const passwordInputCreate = document.getElementById('floatingInput');

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


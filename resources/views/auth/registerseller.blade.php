<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Require meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/logins/login-9/assets/css/login-9.css">
    <title>Register as Seller | SOARchives</title>

    {{-- Tab Logo --}}
    <link rel="shortcut icon" href="{{ asset('images/tab-logo.ico') }}" type="image/x-icon">

    <!-- eye -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <!-- Password Strength Meter -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js'></script>

    <!--Style CSS -->
    <link rel="stylesheet" href="{{ asset('css/logReg.css') }}">

</head>

<body>
    <section class="bg-bg py-3 py-md-5 py-xl-8 ">
        <div class="container">
            <div class="row gy-4 align-items-center">
                <div class="col-12 col-md-6 col-xl-6">
                    <div class="d-flex justify-content-center text-light">
                        <div class="col-12 col-xl-9 bg-transparent">
                            <img class="img-fluid rounded" loading="lazy" src="{{ asset('images/sellerLogo.png') }}"
                                width="300" height="100" alt="BootstrapBrain Logo">
                            <hr class="border-primary-subtle mb-4">
                            <p class="lead mb-5">Soarchives is the premier platform dedicated to spotlighting the
                                exceptional talent of artisans and craftsmen from Adamson University.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-6">
                    <div class="card border-0 rounded-4">
                        <div class="card-body p-5 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <h3 class="fw-bold text-color">Register na, Klasmeyt!</h3>
                                        <p class="text-muted mb-5">Let's setup your account</p>
                                    </div>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('register.seller') }}" class="needs-validation"
                                novalidate enctype="multipart/form-data">
                                @csrf
                                <div class="row gy-3 overflow-hidden">

                                    <!-- First Name -->
                                    <div class="col-lg-6 col-sm-12">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" name="FName" class="form-control p-2" id="firstName"
                                            placeholder="Enter First Name" required>
                                        <div class="invalid-feedback">
                                            Please provide your first name.
                                        </div>
                                    </div>

                                    <!-- Last Name -->
                                    <div class="col-lg-6 col-sm-12">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" name="LName" class="form-control p-2" id="lastName"
                                            placeholder="Enter Last Name" required>
                                        <div class="invalid-feedback">
                                            Please provide your last name.
                                        </div>
                                    </div>

                                    <!-- Email Address -->
                                    <div class="col-12">
                                        <label for="validationEmail" class="form-label">Email address</label>
                                        <input type="email" name="email" class="form-control p-2"
                                            id="validationEmail" placeholder="example@adamson.edu.ph" required>
                                        <div class="invalid-feedback">
                                            Please provide a valid adamson email address.
                                        </div>
                                    </div>

                                    <!-- Create Password -->
                                    <div class="col-lg-6 col-sm-12">
                                        <label for="password-input" class="form-label">Create Password</label>
                                        <div class="input-group">
                                            <input type="password" name="password" style="border-width: 1px 0 1px 1px;"
                                                class="form-control" id="password-input" autocomplete="off"
                                                aria-autocomplete="list" aria-label="Password"
                                                aria-describedby="passwordHelp" placeholder="Create Password" required>
                                            <button class="btn btn-outline-secondary btn-eye" type="button"
                                                id="togglePasswordCreate">
                                                <i class="fa fa-eye-slash"></i>
                                            </button>
                                            <div class="invalid-feedback">
                                                Please create a password.
                                            </div>
                                        </div>
                                        <div class="password-meter" id="password-meter">
                                            <div class="meter-section rounded me-2"></div>
                                            <div class="meter-section rounded me-2"></div>
                                            <div class="meter-section rounded me-2"></div>
                                            <div class="meter-section rounded"></div>
                                        </div>
                                        <div id="passwordHelp" class="form-text text-muted">Use 8 or more characters
                                            with a mix of letters, numbers & symbols.</div>
                                        <div id="passwordEmptyFeedback" class="invalid-feedback"
                                            style="display: none;">Please enter a password.</div>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="col-lg-6 col-sm-12">
                                        <label for="confirm-password-input" class="form-label">Confirm
                                            Password</label>
                                        <div class="input-group">
                                            <input type="password" name="password_confirmation"
                                                style="border-width: 1px 0 1px 1px ;" class="form-control"
                                                id="confirm-password-input" autocomplete="off"
                                                aria-autocomplete="list" aria-label="Confirm Password"
                                                placeholder="Confirm Password" required>
                                            <button class="btn btn-outline-secondary" type="button"
                                                id="togglePasswordConfirm">
                                                <i class="fa fa-eye-slash"></i>
                                            </button>
                                            <div class="invalid-feedback">
                                                Please confirm your password.
                                            </div>
                                        </div>
                                        <div id="passwordMatchMessage" class="form-text text-success"
                                            style="display: none;">Passwords match.</div>
                                        <div id="passwordNoMatchMessage" class="form-text text-danger"
                                            style="display: none;">Passwords do not match.</div>
                                        <div id="confirmPasswordEmptyFeedback" class="invalid-feedback"
                                            style="display: none;">Please confirm your password.</div>
                                    </div>


                                    <!-- Student Number -->
                                    <div class="col-lg-6 col-sm-12">
                                        <label for="studentNumber" class="form-label">Student Number</label>
                                        <input type="number" name="StudentNo" class="form-control p-2"
                                            id="studentNumber" placeholder="123456789" required>
                                        <div class="invalid-feedback">
                                            Please provide your student number.
                                        </div>
                                    </div>

                                    <!-- Date of Birth -->
                                    <div class="col-lg-6 col-sm-12">
                                        <label for="dateOfBirth" class="form-label">Date of Birth</label>
                                        <input type="date" name="Birthdate" class="form-control p-2"
                                            id="dateOfBirth" placeholder="Date of Birth" max="" required>
                                        <div class="invalid-feedback">
                                            Please select your date of birth.
                                        </div>
                                    </div>

                                    <!-- Select Year Level -->
                                    <div class="col-12">
                                        <label for="selectYearLevel" class="form-label">Select Year Level</label>
                                        <select class="form-select form-control-lg p-2" name="Year"
                                            id="selectYearLevel" aria-label="Select Year Level" required>
                                            <option class="" value="" selected>Select Year Level</option>
                                            <option value="4th">4th</option>
                                            <option value="3rd">3rd</option>
                                            <option value="2nd">2nd</option>
                                            <option value="1st">1st</option>
                                            <option value="SHS">Senior High School</option>
                                            <option value="JHS">Junior High School</option>
                                            <option value="GS">Grade School</option>
                                            <option value="PS">Pre-School</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select your year level.
                                        </div>
                                    </div>

                                    <!-- Select Course -->
                                    <div class="col-12">
                                        <label for="CourseID" class="form-label">Select Course</label>
                                        <select name="CourseID" id="CourseID" class="form-select" required>
                                            <option value="" disabled selected>Select Course</option>
                                            @foreach ($courses as $courseID => $courseName)
                                                <option value="{{ $courseID }}">{{ $courseName }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select your course.
                                        </div>
                                    </div>


                                    <!-- Terms and Conditions -->
                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="termsCheckbox"
                                                name="termsCheckbox" required>
                                            <label class="form-check-label text-muted" for="termsCheckbox">I agree to
                                                the <a href="{{ route('terms.conditions') }}" target="_blank">Terms
                                                    and Conditions</a></label>
                                            <div class="invalid-feedback">
                                                You must agree to the terms and conditions.
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Login Button -->
                                    <div class="col-12">
                                        <div class="d-grid">
                                            {{-- <input type="submit" value="{{ __('Register') }}"> --}}
                                            <button class="btn button-color btn-lg text-light mt-3" type="submit"
                                                name="btnSubmit" value="{{ __('Register') }}">Sign Up</button>
                                        </div>
                                        <p class="mt-3 text-muted text-center">Already a member? <a
                                                href="{{ route('login') }}" class="text-decoration-none">Login</a></p>
                                        <p class="mt-3 text-muted text-center">Sign up as<a
                                                href="{{ route('register.buyer') }}" class="text-decoration-none">
                                                Buyer</a></p>
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
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            // Para hindi ma-erase lahat ng inputs after submitting merong field ang invalid
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

        // Additional JavaScript to validate email format
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

        // Set max date for date of birth input
        document.addEventListener('DOMContentLoaded', function() {
            var dateOfBirthInput = document.getElementById('dateOfBirth');
            var today = new Date().toISOString().split('T')[0];
            dateOfBirthInput.setAttribute('max', today);
        });




        // Password Strength Meter
        document.addEventListener('DOMContentLoaded', (event) => {
            const passwordInput = document.getElementById('password-input');
            const passwordMeter = document.getElementById('password-meter');
            const passwordEmptyFeedback = document.getElementById('passwordEmptyFeedback');
            const confirmPasswordEmptyFeedback = document.getElementById('confirmPasswordEmptyFeedback');

            // Function to check if the confirm password field is empty
            function validateConfirmPassword() {
                if (confirmPasswordInput.value.trim() === '') {
                    confirmPasswordEmptyFeedback.style.display = 'block';
                } else {
                    confirmPasswordEmptyFeedback.style.display = 'none';
                }
            }


            // Function to check if password field is empty
            function validatePassword() {
                if (passwordInput.value.trim() === '') {
                    passwordEmptyFeedback.style.display = 'block';
                } else {
                    passwordEmptyFeedback.style.display = 'none';
                }
            }
            const passwordHelp = document.getElementById('passwordHelp');

            passwordInput.addEventListener('focus', () => {
                passwordMeter.style.display = 'flex'; // Show password meter
                passwordHelp.style.display = 'block'; // Show help text
            });

            passwordInput.addEventListener('blur', () => {
                passwordMeter.style.display = 'none'; // Hide password meter
                passwordHelp.style.display = 'none'; // Hide help text
            });


            passwordInput.addEventListener('focus', () => {
                passwordMeter.style.display = 'flex'; // Show password meter
            });

            passwordInput.addEventListener('blur', () => {
                passwordMeter.style.display = 'none'; // Hide password meter
            });
        });


        const passwordInput = document.getElementById('password-input');
        const meterSections = document.querySelectorAll('.meter-section');

        passwordInput.addEventListener('input', updateMeter);

        function updateMeter() {
            const password = passwordInput.value;
            let strength = calculatePasswordStrength(password);

            // Remove all strength classes
            meterSections.forEach((section) => {
                section.classList.remove('weak', 'medium', 'strong', 'very-strong');
            });

            // Add the appropriate strength class based on the strength value
            if (strength >= 1) {
                meterSections[0].classList.add('weak');
            }
            if (strength >= 2) {
                meterSections[1].classList.add('medium');
            }
            if (strength >= 3) {
                meterSections[2].classList.add('strong');
            }
            if (strength >= 4) {
                meterSections[3].classList.add('very-strong');
            }
        }

        function calculatePasswordStrength(password) {
            const lengthWeight = 0.2;
            const uppercaseWeight = 0.5;
            const lowercaseWeight = 0.5;
            const numberWeight = 0.7;
            const symbolWeight = 1;

            let strength = 0;

            // Calculate the strength based on the password length
            strength += password.length * lengthWeight;

            // Calculate the strength based on uppercase letters
            if (/[A-Z]/.test(password)) {
                strength += uppercaseWeight;
            }

            // Calculate the strength based on lowercase letters
            if (/[a-z]/.test(password)) {
                strength += lowercaseWeight;
            }

            // Calculate the strength based on numbers
            if (/\d/.test(password)) {
                strength += numberWeight;
            }

            // Calculate the strength based on symbols
            if (/[^A-Za-z0-9]/.test(password)) {
                strength += symbolWeight;
            }

            return strength;
        }

        // Confirm Password
        document.addEventListener('DOMContentLoaded', (event) => {
            const passwordInput = document.getElementById('password-input');
            const confirmPasswordInput = document.getElementById('confirm-password-input');
            const passwordMeter = document.getElementById('password-meter');
            const passwordHelp = document.getElementById('passwordHelp');
            const passwordMatchMessage = document.getElementById('passwordMatchMessage');
            const passwordNoMatchMessage = document.getElementById('passwordNoMatchMessage');

            // Show/hide password meter and help text
            passwordInput.addEventListener('focus', () => {
                passwordMeter.style.display = 'flex'; // Show password meter
                passwordHelp.style.display = 'block'; // Show help text
            });

            passwordInput.addEventListener('blur', () => {
                passwordMeter.style.display = 'none'; // Hide password meter
                passwordHelp.style.display = 'none'; // Hide help text
            });

            // Check password match
            function checkPasswordMatch() {
                if (passwordInput.value === confirmPasswordInput.value && confirmPasswordInput.value !== '') {
                    passwordMatchMessage.style.display = 'block';
                    passwordNoMatchMessage.style.display = 'none';
                } else {
                    passwordMatchMessage.style.display = 'none';
                    passwordNoMatchMessage.style.display = 'block';
                }
            }

            confirmPasswordInput.addEventListener('input', checkPasswordMatch);
        });

        // Terms and Conditions
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registrationForm');
            const termsCheckbox = document.getElementById('termsCheckbox');

            form.addEventListener('submit', function(event) {
                if (!termsCheckbox.checked) {
                    event.preventDefault(); // Prevent form submission
                    termsCheckbox.classList.add('is-invalid'); // Add invalid class to checkbox
                } else {
                    termsCheckbox.classList.remove('is-invalid'); // Remove invalid class
                }
            });

            // Optional: Add real-time validation feedback
            termsCheckbox.addEventListener('change', function() {
                if (termsCheckbox.checked) {
                    termsCheckbox.classList.remove('is-invalid');
                } else {
                    termsCheckbox.classList.add('is-invalid');
                }
            });
        });

        // Page Refresh
        let isDirty = false;

        // Function to mark the form as dirty when input changes
        function markDirty() {
            isDirty = true;
        }

        // Function to confirm on page unload
        window.onbeforeunload = function(event) {
            if (isDirty) {
                const message = "You have unsaved changes. Are you sure you want to leave?";
                event.returnValue = message; // For most browsers
                return message; // For some browsers
            }
        };

        // Add event listeners to input fields
        window.onload = function() {
            const inputs = document.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.addEventListener('input', markDirty);
            });

            // Add event listener to the form
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity()) {
                        isDirty = false; // Reset the flag when form is valid and submitted
                    } else {
                        isDirty = true; // Keep the flag true if form has validation errors
                    }
                });
            }
        };

        // Eye icon for hiding password
        document.addEventListener('DOMContentLoaded', function() {
            const togglePasswordCreate = document.getElementById('togglePasswordCreate');
            const passwordInputCreate = document.getElementById('password-input');

            togglePasswordCreate.addEventListener('click', function() {
                const type = passwordInputCreate.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInputCreate.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });

            const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
            const passwordInputConfirm = document.getElementById('confirm-password-input');

            togglePasswordConfirm.addEventListener('click', function() {
                const type = passwordInputConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInputConfirm.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        });
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Reset Password | SOARchives</title>
    <link rel="shortcut icon" href="images/tab-logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">

    <style>
        .password-meter {
            display: flex;
            height: 5px;
            margin-top: 10px;
        }

        .meter-section {
            flex: 1;
            background-color: #ddd;
            margin-right: 2px;
        }

        .weak {
            background-color: #ff4d4d;
        }

        .medium {
            background-color: #ffd633;
        }

        .strong {
            background-color: #00b300;
        }

        .very-strong {
            background-color: #009900;
        }

        #passwordHelp {
            display: none;
        }

        #passwordMatchMessage {
            color: green;
        }

        #passwordNoMatchMessage {
            color: red;
        }

        .input-group {
            position: relative;
        }

        .input-group .form-control {
            padding-right: 2.5rem;
            /* Space for the eye icon */
        }

        .input-group .input-group-text {
            position: absolute;
            top: 50%;
            right: 0.5rem;
            transform: translateY(-50%);
            cursor: pointer;
            background-color: transparent;
            border: none;
            font-size: 1rem;
            line-height: 1.5;
        }

        .form-control.is-valid,
        .was-validated .form-control:valid {
            border: 1px solid #ced4da;
            padding-right: calc(1.5em + .75rem);
            background-image: none;
            background-repeat: no-repeat;
            background-position: right calc(.375em + .1875rem) center;
            background-size: calc(.75em + .375rem) calc(.75em + .375rem);
        }

    
    </style>
</head>

<body>

    <section class="reset-password-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card reset-password-card border-0">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <h3 class="text-color">Enter New Password</h3>
                                <p class="text-muted">Please choose a strong password that you haven't used before. Ensure it includes a mix of letters, numbers, and symbols.</p>
                            </div>
                            <form action="" method="POST" class="needs-validation" novalidate>
                                <div class="mb-3">
                                    <label for="newPassword" class="form-label">New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="newPassword" placeholder="New Password" required>
                                        <span class="input-group-text" id="toggleNewPassword">
                                            <i class="fas fa-eye-slash"></i>
                                        </span>
                                    </div>
                                    <div class="password-meter" id="password-meter">
                                        <div class="meter-section rounded me-2"></div>
                                        <div class="meter-section rounded me-2"></div>
                                        <div class="meter-section rounded me-2"></div>
                                        <div class="meter-section rounded"></div>
                                    </div>
                                    <div id="passwordHelp" class="form-text text-muted">Use 8 or more characters with a mix of letters, numbers & symbols.</div>
                                    <div class="invalid-feedback">Please enter a new password.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Confirm New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm New Password" required>
                                        <span class="input-group-text" id="toggleConfirmPassword">
                                            <i class="fas fa-eye-slash"></i>
                                        </span>
                                    </div>
                                    <div id="passwordMatchMessage" class="form-text text-success" style="display: none;">Passwords match.</div>
                                    <div id="passwordNoMatchMessage" class="form-text text-danger" style="display: none;">Passwords do not match.</div>
                                    <div class="invalid-feedback">Please confirm your new password.</div>
                                </div>
                                <div class="d-grid">
                                    <button class="btn button-color text-light" type="submit" name="btnSubmit">Reset Password</button>
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

            var forms = document.querySelectorAll('.needs-validation')
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

        document.getElementById('newPassword').addEventListener('input', function() {
            updateMeter();
        });

        document.getElementById('confirmPassword').addEventListener('input', function() {
            checkPasswordMatch();
        });

        function updateMeter() {
            const passwordInput = document.getElementById('newPassword');
            const password = passwordInput.value;
            const meterSections = document.querySelectorAll('.meter-section');
            let strength = calculatePasswordStrength(password);

            meterSections.forEach((section) => {
                section.classList.remove('weak', 'medium', 'strong', 'very-strong');
            });

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

            const passwordMeter = document.getElementById('password-meter');
            const passwordHelp = document.getElementById('passwordHelp');
            passwordMeter.style.display = 'flex';
            passwordHelp.style.display = 'block';
        }

        function calculatePasswordStrength(password) {
            const lengthWeight = 0.2;
            const uppercaseWeight = 0.5;
            const lowercaseWeight = 0.5;
            const numberWeight = 0.7;
            const symbolWeight = 1;
            let strength = 0;

            strength += password.length * lengthWeight;
            if (/[A-Z]/.test(password)) strength += uppercaseWeight;
            if (/[a-z]/.test(password)) strength += lowercaseWeight;
            if (/\d/.test(password)) strength += numberWeight;
            if (/[^A-Za-z0-9]/.test(password)) strength += symbolWeight;

            return strength;
        }

        function checkPasswordMatch() {
            const passwordInput = document.getElementById('newPassword');
            const confirmPasswordInput = document.getElementById('confirmPassword');
            const passwordMatchMessage = document.getElementById('passwordMatchMessage');
            const passwordNoMatchMessage = document.getElementById('passwordNoMatchMessage');

            if (passwordInput.value === confirmPasswordInput.value && confirmPasswordInput.value !== '') {
                passwordMatchMessage.style.display = 'block';
                passwordNoMatchMessage.style.display = 'none';
            } else {
                passwordMatchMessage.style.display = 'none';
                passwordNoMatchMessage.style.display = 'block';
            }
        }

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
        };

        // Toggle password visibility
        function togglePasswordVisibility(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId).querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        }

        document.getElementById('toggleNewPassword').addEventListener('click', function() {
            togglePasswordVisibility('newPassword', 'toggleNewPassword');
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            togglePasswordVisibility('confirmPassword', 'toggleConfirmPassword');
        });
    </script>
</body>

</html>
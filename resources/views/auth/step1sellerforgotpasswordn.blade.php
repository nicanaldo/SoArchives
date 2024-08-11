<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Forgot Password | SOARchives</title>
    <link rel="shortcut icon" href="images/tab-logo.ico" type="image/x-icon">

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <section class="forgot-password-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card forgot-password-card border-0">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="images/forgotpass.png" width="300" height="300" alt="">
                                <h3 class="text-color">Forgot Password?</h3>
                                <p class="text-muted">Enter your email address and we'll send you a link to reset your password.</p>
                            </div>
                            <form action="includes/forgot_password.inc.php" method="POST" class="needs-validation" novalidate>
                                <div class="mb-3">
                                    <label for="validationEmail" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="validationEmail" placeholder="example@adamson.edu.ph" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid email address ending with adamson.edu.ph.
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button class="btn button-color text-light" type="submit" name="btnSubmit">Send Reset Link</button>
                                </div>
                            </form>
                            <div class="text-center mt-3">
                                <a href="login.php" class="text-decoration-none">Back to Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
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
    </script>
</body>

</html>
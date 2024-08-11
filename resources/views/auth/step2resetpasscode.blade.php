<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Reset Password | SOARchives</title>
    <link rel="shortcut icon" href="images/tab-logo.ico" type="image/x-icon">

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <section class="reset-password-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card reset-password-card border-0">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="images/codesent.png" width="300" height="auto" alt="">
                                <h3 class="text-color">Reset Your Password</h3>
                                <p class="text-muted">Enter the 6-digit code we sent to your email</p>
                            </div>
                            <form action="includes/reset_password.inc.php" method="POST" class="needs-validation" novalidate>
                                <div class="mb-4 text-center">
                                    <input type="text" class="code-input" maxlength="1" required>
                                    <input type="text" class="code-input" maxlength="1" required>
                                    <input type="text" class="code-input" maxlength="1" required>
                                    <input type="text" class="code-input" maxlength="1" required>
                                    <input type="text" class="code-input" maxlength="1" required>
                                    <input type="text" class="code-input" maxlength="1" required>
                                    <div class="invalid-feedback">
                                        Please enter the 6-digit code.
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button class="btn button-color text-light" type="submit" name="btnSubmit">Reset Password</button>
                                </div>
                            </form>
                            <div class="text-center mt-3">
                                <a href="" class="text-decoration-none">Resend Code</a>
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

        // Handling code inputs
        const codeInputs = document.querySelectorAll('.code-input');
        codeInputs.forEach((input, index) => {
            input.addEventListener('input', (event) => {
                if (event.target.value.length > 0 && index < codeInputs.length - 1) {
                    codeInputs[index + 1].focus();
                }
            });
            input.addEventListener('keydown', (event) => {
                if (event.key === 'Backspace' && input.value === '' && index > 0) {
                    codeInputs[index - 1].focus();
                }
            });
        });

        // Page Refresh
        let isDirty = false;

        function markDirty() {
            isDirty = true;
        }

        window.addEventListener('beforeunload', function(event) {
            if (isDirty) {
                const message = "You have unsaved changes. Are you sure you want to leave?";
                event.preventDefault();
                event.returnValue = message;
                return message;
            }
        });

        window.addEventListener('load', function() {
            const inputs = document.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.addEventListener('input', markDirty);
            });
        });
    </script>
</body>

</html>

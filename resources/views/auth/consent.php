<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Upload Consent File | SOARchives</title>
    <link rel="shortcut icon" href="images/tab-logo.ico" type="image/x-icon">

    <link rel="stylesheet" href="style.css">

    <style>
        body {
            background-color: #145DA0;
        }

        .consent-upload-section {
            background-color: #145DA0;
            padding: 3rem 1.5rem;
            border-radius: 0.5rem;
        }
    </style>
</head>

<body>

    <section class="consent-upload-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card border-0 rounded-4 shadow-sm">
                        <div class="card-body p-5 text-center">
                            <img src="images/consent.png" width="200" height="200" alt="">
                            <h3 class="card-title mb-4 text-color">Upload Consent File</h3>
                            <p class="card-text mb-4">As a minor registering as a seller on SOARchives, you are required to upload a consent form from your parent or guardian. Please use the form below to upload the file.</p>

                            <form action="includes/upload-consent.inc.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                <div class="mb-3">
                                    <label for="consentFile" class="form-label">Consent File</label>
                                    <input type="file" class="form-control" id="consentFile" name="consentFile" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required>
                                    <div class="invalid-feedback">
                                        Please upload a valid file (PDF, DOC, DOCX, JPG, JPEG, PNG).
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <p class="text-muted">Please ensure that the consent file is clear and legible. The document should include the signature of your parent or guardian and their contact information.</p>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn button-color text-light" name="submitConsent">Upload Consent File</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS Bundle with Popper -->
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
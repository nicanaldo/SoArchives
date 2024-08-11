<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registration Confirmation') }}</div>

                    <div class="card-body">
                        <h1 class="card-title">Hi {{ $get_f_name }} {{ $get_l_name }}</h1>
                        <h3>Thank you for registering with SOARchives! To complete your sign-up, please use this One-Time Password (OTP):</h3>
                        <h3>{{$validToken}}</h3>
                        {{-- <p class="card-text">Hi {{ $get_f_name }} {{ $get_l_name }}! Below is your OTP for the confirmation of email in SOARchives website.</p>

                        <h4>Your OTP is: {{$validToken}}</h4> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
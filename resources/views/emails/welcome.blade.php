<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>

        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .card {
            border-radius: 8px;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #145DA0;
            color: white;
            font-size: 24px;
            text-align: center;
            padding: 20px;
            border-bottom: none;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card-body {
            padding: 30px;
            text-align: center;
        }

        .card-title {
            font-size: 28px;
            color: #333;
        }

        .otp-code {
            font-size: 32px;
            color: #145DA0;
            font-weight: bold;
            margin: 20px 0;
        }

        .footer {
            margin-top: 10px;
            text-align: center;
            font-size: 14px;
            color: #6c757d;
        }

    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registration Confirmation') }}</div>
                    <div class="card-body">
                        <h1 class="card-title">Hi {{ $get_f_name }} {{ $get_l_name }}</h1>
                        <p class="lead">Thank you for registering with SOARchives!</p>
                        <p>To complete your sign-up, please use this One-Time Password (OTP):</p>
                        <div class="otp-code">{{ $validToken }}</div>
                        <p>Please use the above OTP to complete your registration. If you didn't request this, please
                            ignore this email.</p>
                    </div>
                </div>
                <div class="footer">
                    © {{ date('Y') }} SOARchives. All rights reserved.
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

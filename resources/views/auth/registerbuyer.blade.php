<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/reg.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>SOARchives</title>
</head>
<body>
<div class="main-container">
    <div class="container-left mb-3">
        <img src="{{ asset('images/reg.jpg') }}" class="bg-image" alt="...">
    </div>

    <div class="container-right">
        <h1 class="form-title">Sign Up</h1>
        <h4 class="form-subtitle">as buyer</h1>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        <form method="POST" action="{{ route('register.buyer') }}" class="reg-form" onsubmit="return validateForm()">
            @csrf
            
                <div class="col-md-12">
                     <input id="FName" type="text" class="form-control @error('FName') is-invalid @enderror" name="FName" value="{{ old('FName') }}" required autocomplete="FName" autofocus placeholder="{{ __('First Name') }}">
                        @error('FName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                    <input id="LName" type="text" class="form-control @error('LName') is-invalid @enderror" name="LName" value="{{ old('LName') }}" required autocomplete="LName" autofocus placeholder="{{ __('Last Name') }}">

                        @error('LName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror  
                    
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('Email Address') }}">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                                        
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                    

                    <!-- Privacy Policy Modal -->
                    <div class="modal fade" id="privacyPolicyModal" tabindex="-1" role="dialog" aria-labelledby="privacyPolicyModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="privacyPolicyModalLabel">Privacy Policy</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Buyer Privacy Agreement
                                        <br><br>
                                        This agreement governs how personal information is handled on SOARchives. By using the platform, you agree to these terms.
                                        <br>
                                        1.Collection: We collect personal information provided during registration. <br>
                                        2.Security: Users are responsible for protecting their account credentials. <br>
                                        3.User Rights: Users can access and correct their personal information. <br>
                                        <br>
                                        This Agreement governs content interaction on SOARchives as a buyer.
                                        <br>
                                        1.Content Usage: Buyers may access and consume content for personal use and purchasing decisions. <br>
                                        2.Feedback: Buyers may provide reviews to aid other buyers. <br>
                                        3.Prohibited Actions: Buyers must not misuse SOARchives for unlawful purposes. <br>
                                        4.User Responsibilities: Feedback must be truthful and relevant. <br>
                                        5.Respect: Interactions must adhere to community standards. <br>
                                        <br>
                                        We may update this agreement, and your continued use constitutes acceptance.
                                        Contact us at <a href="mailto:soarchives11@gmail.com">soarchives11@gmail.com</a> for inquiries.
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Privacy Policy Checkbox -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="privacyPolicyCheckbox" required>
                        <label class="form-check-label" for="privacyPolicyCheckbox">
                            I agree <span>to the <a href="#" data-toggle="modal" data-target="#privacyPolicyModal">Privacy Policy</a></span>
                        </label>
                    </div>

                    <br><br>
                    
                    <input type="submit" value="{{ __('Register') }}">
                </div>

                <div class="col-md-6">
                    <div class="login">
                        <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                        <p><a href="{{ route('register.seller') }}">Signup as a Seller</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                alert("Passwords do not match");
                return false;
            }

            // You can add additional validation here if needed

            return true;
        }
    </script>
</body>
</html>



        



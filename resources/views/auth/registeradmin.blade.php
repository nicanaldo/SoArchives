
<link href="{{ asset('css/reg.css') }}" rel="stylesheet">
<div class="main-container">
    <div class="container-left mb-3">
        <img src="{{ asset('images/reg.jpg') }}" class="bg-image" alt="...">
    </div>

    <div class="container-right">
        <h1 class="form-title">Sign Up</h1>
        <h4 class="form-subtitle">as admin</h1>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        <form method="POST" action="{{ route('register.admin') }}" class="reg-form" onsubmit="return validateForm()">
            @csrf
            
                <div class="col-md-6">
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
                    <input type="submit" value="{{ __('Register') }}">
                </div>

                {{-- <div class="col-md-6">
                    <div class="login">
                        <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                        <p><a href="{{ route('register.seller') }}">Signup as a Seller</a></p>
                    </div>
                </div> --}}
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
        



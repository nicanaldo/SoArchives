<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/css_reg.css') }}">
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
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <h1 class="form-title" style="margin-bottom: -7px;">Sign  Up</h1>
            <h4 class="form-subtitle">as seller</h1>
            <form method="POST" action="{{ route('register.seller') }}" id="signupForm" class="reg-form" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <input type="text" name="FName" placeholder="First Name" value="{{ old('FName') }}" required>
                </div>

                <div class="col-md-6">
                <input type="text" name="LName" placeholder="Last Name" value="{{ old('LName') }}" required>
                </div>

                <div class="col-md-12">
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"required>
                </div>

                <div class="col-md-6">
                    <input type="password" id="password" name="password" placeholder="Create Password" required>
                </div>

                <div class="col-md-6">
                    <input type="password" id="confirmPassword" name="password_confirmation" placeholder="Confirm Password" required>
                </div>

                <div class="col-md-12">
                    <input type="text" name="StudentNo" placeholder="StudentNo" id="StudentNo" value="{{ old('StudentNo') }}" required>
                    <input type="date" class="bday" name="Birthdate" id="Birthdate" value="{{ old('Birthdate') }}" required>
                                         
                </div>

                <div class="col-md-6">
                    {{-- Course --}}
                        {{-- Course --}}
                    <div class="select-wrapper">
                        <select name="CourseID" id="CourseID" class="course-select" required style="width: 180px;">
                            <option value="">Select Course</option>
                            @foreach($courses as $courseID => $courseName)
                                <option value="{{ $courseID }}">{{ $courseName }}</option>
                            @endforeach
                        </select>                                
                    </div>
                </div>

                <div class="col-md-6">
                    {{-- Level --}}
                    <select name="Year" id="Year" class="level-select" value="{{ old('Year') }}" required>
                        <option value="" disabled selected>Select Level</option>
                        <option value="4th">4th</option>
                        <option value="3rd">3rd</option>
                        <option value="2nd">2nd</option>
                        <option value="1st">1st</option>
                        <option value="SHS">Senior High School</option>
                        <option value="JHS">Junior High School</option>
                        <option value="GS">Grade School</option>
                        <option value="PS">Pre-School</option>
                    </select>
                </div>
                

                    <!-- Eye icon to show an example of a consent form -->
                    
                
                <div class="col-md-12">
                    <input type="file" name="Consent" id="Consent" accept="image/*" class="consent-input @if ($errors->has('Consent')) is-invalid @endif">
                        @if ($errors->has('Consent'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('Consent') }}</strong>
                            </span>
                        @endif

                        <!-- Eye icon to show an example of a consent form -->
                        <i class="fas fa-eye consent-icon" style="cursor: pointer;"></i>
                </div>
                    

                    <!-- Modal for consent form example -->
                    <div class="modal fade" id="consentModal" tabindex="-1" role="dialog" aria-labelledby="consentModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="consentModalLabel">Sample Consent Form</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img src="images/crochet.png" alt="Sample Consent Form" class="img-fluid">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function() {
                            $(".consent-icon").click(function() {
                                $("#consentModal").modal("show");
                            });
                        });
                    </script>


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

                                        Privacy Agreement
                                        <br><br>
                                        This agreement governs how personal information is handled on SOARchives. By using the platform, you agree to these terms.

                                        1.Collection: We collect personal information provided during registration. <br>
                                        2.Security: Users are responsible for protecting their account credentials. <br>
                                        3.User Rights: Users can access and correct their personal information. <br>

                                        <br>
                                        This agreement governs content creation and sharing on SOARchives. <br>

                                        1.Content Standards: Users must comply with laws and ensure originality. <br>
                                        2.Prohibited Content: Offensive material is not allowed. <br>
                                        3.User Responsibilities: Content must be accurate and respect others' rights. <br>
                                        4.Moderation: We reserve the right to review and remove inappropriate content. <br>
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
                
                    <input type="submit" value="{{ __('Register') }}">
                    <div class="col-md-6">
                    <div class="login">
                        <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                        <p  style="margin-top: -14px;"><a href="{{ route('register.buyer') }}">Signup as a Buyer</a></p>
                    </div>
                </div>                   
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


<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    margin-bottom: 0;
}

.main-container {
    display: flex;
    flex-wrap: wrap;
    position: relative;
    padding: 0;
    margin: 0;
    height: auto;
}

.container-left {
    width: 50%;
    height: 60%;
    max-width: 100%;
    max-height: 90%;
    flex-shrink: 0;
    margin-bottom: 0;
}

.bg-image {
    width: 100%;
    height: auto;
    position: relative;
}

.form-title {
    line-height: 1.66;
    margin-top: 40px;
    margin-top: 30px;
    font-weight: 700;
    color: #145DA0;
    font-family: Helvetica;
    font-size: 36px;
    margin-bottom: 10px;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
}

.form-subtitle {
    line-height: 1.66;
    font-weight: 300;
    color: #145DA0;
    font-family: Helvetica;
    margin-bottom: 33px;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
}

.container-right {
    width: 50%;
    margin: 0 auto;
    max-width: 100%;
}

.reg-form {
    display: flex;
    justify-content: space-between;
    margin-top: 5px;
    display: flex;
    flex-wrap: wrap;
    position: relative;
    width: 70%;
    margin: 0 auto;
}

.reg-form .col-md-6 {
    width: 80%;
    margin-left: auto;
    margin-right: auto;
}

.reg-form input {
    width: 100%;
    margin-bottom: 8px;
    margin-left: auto;
    margin-right: auto;
    padding: 10px;
    border-radius: 0px;
    box-sizing: border-box;
    display: block;
    border: none;
    border-bottom: 1px solid #999;
    outline: none;
    font-family: Helvetica;
    color: #343434;
    font-size: 14px; /* Adjust the size as needed */
}

.reg-form input[type="submit"] {
    background-color: #FFC107;
    color: #FFC107;
    cursor: pointer;
    display: inline-block;
    background: #FFC107;
    color: #343434;
    border-bottom: none;
    width: 95%; /* Make button full width */
    padding: 15px 0; /* Adjust padding */
    border-radius: px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    -o-border-radius: 5px;
    -ms-border-radius: 5px;
    margin-top: -5px;
    cursor: pointer;
    padding: 8px 8px;
    margin-bottom: 10px;
}

.reg-form input[type="submit"]:hover {
    background-color: #145DA0;
    color: #F3F5FA;
}

.login {
    font-size: 12px;
    font-weight: normal;
    font-family: Helvetica;
    text-align: center;
    margin-top: 10px !important;
}

.bday{
    margin-bottom: 20px !important;
    color: #999;
}

.select-wrapper {
    position: relative;
    display: inline-block;
    width: 30%;
}

.select-wrapper select {
    width: 100%;
    box-sizing: border-box;
}

.select-wrapper select option{
    font-size: 10px;
}

.course-select {
    width: 100%; /* Adjust padding if needed */
    margin: 0; /* Remove margins for better layout */
    padding: 4px 5px;
    border-radius: 0px;
    box-sizing: border-box;
    display: block;
    border: none;
    border-bottom: 1px solid #999;
    outline: none;
    font-family: Helvetica;
    color: #787878 !important;
    font-size: 14px;
}

.level-select {
    width: 100%; /* Adjust padding if needed */
    margin: 0; /* Remove margins for better layout */
    padding: 4px 5px;
    border-radius: 0px;
    box-sizing: border-box;
    display: block;
    border: none;
    border-bottom: 1px solid #999;
    outline: none;
    font-family: Helvetica;
    font-size: 14px;
    color: #787878 !important;

}

.login {
    font-size: 12px;
    font-weight: normal;
    font-family: Helvetica;
    text-align: center;
    margin-top: -10px;
}

.consent-input {
    /* Your custom styling for the file input */
    /* Example styles */
    padding: 6px 10px;
    width: 100%; /* Set width to 100% initially */
    font-size: 12px !important;
    margin-top: 10px !important;

}

.consent-icon {
    /* Your custom styling for the eye icon */
    /* Example styles */
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
    color: #145DA0;
}

.form-check-label{
    font-size: 14px !important;
    margin-left: 15px;
}

.form-check-input {
    /* Your custom styling for the checkbox */
    /* Example styles */
    width: auto;
    margin-top: 8px;
    margin-right: 10px;
    margin-left: -100px !important;

}


/* Media Queries for responsiveness */
@media screen and (max-width: 768px) {
    .container {
        flex-direction: column;
    }
    .container-left {
        width: 100%;
    }
    .bg-image {
        width: 100%;
    }
    .container-right {
        width: 100%;
    }
    .reg-form .col-md-6 {
        width: 100%;
        margin-bottom: 20px;
    }

    /* Adjust the width and margin of the select elements */
    .course-select select,
    .level-select select {
        width: 100%;
  }  

  .consent-input {
        width: calc(100% - 40px); /* Adjust as needed */
        margin-top: -5px !important;
    }
}
</style>

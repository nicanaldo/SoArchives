
<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Modal -->
     <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Your form for editing profile goes here -->
                    <form>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username">
                        </div>
                        <!-- Add more fields as needed -->
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile Modal</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        .btn-custom {
            background-color: #FFC107; /* Your desired color */
            color: #343434; /* Text color */
        }
        .btn-custom:focus {
            box-shadow: none; /* Remove focus shadow */
        }
    </style>
</head>
<body>
    <div class="logosec"> 
        <img src="{{ asset('images/logo.png') }}" alt="" width="35" height="30" class="d-inline-block align-text-top">
        <h2 style="color: #145DA0; font-weight:bold; font-size: 20px; margin-left: -55px; margin-top: 10px;">SOARCHIVES</h2>
    </div>
    
    @csrf
    {{-- @if (Auth::check() && Auth::user()->UserTypeID === 1) <!-- Check if the user is logged in and is an admin --> --}}
        <div class="dropdown">
            <button class="btn btn-custom dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Admin{{-- {{ Auth::user()->FName }} <!-- Display admin's first name --> --}}
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Edit Profile</a></li>
                <li><a class="dropdown-item" href="{{ route('chatify') }}">Inbox</a></li>
                <li><a class="dropdown-item" href="{{ route('adminlogin1') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                <form id="logout-form" action="{{ route('adminlogin1') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </div>
    {{-- @endif --}}


   
</body>
</html>





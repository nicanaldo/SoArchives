<link rel="stylesheet" href="css/main.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<style>

  .navbar-toggler {
    border: none; /* Remove the border */
  }
  
    /* Navbar */
  .navbar{
    padding-top: 1rem;
    padding-bottom: 1rem;
    border: none;
  }
  
  .navbar-brand a{
    color: #145DA0;
  }
  
  .navbar-light{
    background-color: white;
  }
  
  .navbar-light .navbar-brand  {
    color: #145DA0;
  }
  
  .navbar-toggler:focus {
      outline: none; /* Remove the outline */
      box-shadow: none; /* Remove the box-shadow */
  }
  
  </style>


@csrf

<nav class="navbar navbar-expand-lg navbar-light bg-transparent">
  <div class="container">
    <a class="navbar-brand" aria-current="page" href="{{ route('welcome') }}"> <img src="{{ asset('images/logo.png') }}" alt="" width="30" height="24" class="d-inline-block align-text-top"><strong>SOARCHIVES</strong></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav mx-auto">

         <!-- <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>  -->

  
        <li class="nav-item" style="width: 100px;">
          <a class="nav-link" href="{{ route('artisan') }}">Artisans</a>
        </li>

        {{-- <li class="nav-item" style="width: 90px;">
          <a class=nav-link" href="{{ route('Event.BuyerEvents') }}">Events</a>
        </li> --}}

        {{-- <li class="nav-item" style="width: 90px;">
          <a class="nav-link" href="{{ route('events') }}">Events</a>
        </li> --}}
        
        @if(Auth::user() && Auth::user()->usertypeID == 2)
        <li class="nav-item" style="width: 90px;"><a class="nav-link" href="{{ route('events') }}">Events</a></li>
        @elseif(Auth::user() && Auth::user()->usertypeID == 3)
            <li class="nav-item" style="width: 90px;"><a class="nav-link" href="{{ route('Event.BuyerEvents') }}">Events</a></li>
        @else
            <li class="nav-item" style="width: 90px;"><a class="nav-link" href="{{ route('Event.BuyerEvents') }}">Events</a></li>
        @endif

        <li class="nav-item" style="width: 90px;">
          <a class="nav-link" href="{{ route('about') }}">About</a>
        </li>

        @if(Auth::user() && Auth::user()->usertypeID == 2)
        <li class="nav-item" style="width: 90px;"><a class="nav-link" href="{{ route('community.index') }}">Community</a></li>
        @elseif(Auth::user() && Auth::user()->usertypeID == 3)
            <li class="nav-item" style="width: 90px;"><a class="nav-link" href="{{ route('community.index') }}">Community</a></li>
        @else
            <li class="nav-item" style="width: 90px;"><a class="nav-link" href="{{ route('community.visitor') }}">Community</a></li>
        @endif
        
      </ul>
      
      {{-- <form class="d-flex">
        @if (Route::has('register'))
            <button id="registerButton" class="btn btn-warning" type="button">Join / Sign Up</button>
        @endif
      </form> --}}

      @if (Auth::check()) <!-- Check if the user is logged in -->
        <div class="dropdown">
            <button class="btn btn-warning dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->fname }} <!-- Display user's name -->
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                @if(Auth::user()->usertypeID == 2)
                    <li><a class="dropdown-item" href="{{ route('products-seller.index') }}">Profile</a></li>
                @elseif(Auth::user()->usertypeID == 3)
                    <li><a class="dropdown-item" href="{{ route('profile-buyer') }}">Profile</a></li>
                @endif
                <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Edit Profile</a></li>
                <li><a class="dropdown-item" href="{{ route('chatify') }}" >Inbox</a></li> 
                <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); logoutConfirmation(event);">Logout</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </div>
      @else
          <form class="d-flex">
              @if (Route::has('login'))
                  <button id="loginButton" class="btn btn-warning" type="button">Join / Sign Up</button>
              @endif
          </form>
      @endif


    
      <script>

        // Logout Sweet Alert
        function logoutConfirmation(event) {
                event.preventDefault();
                swal({
                    title: "Logout",
                    text: "Are you sure you want to logout?",
                    icon: "warning",
                    buttons: {
              cancel: "Cancel", // Change text for the cancel button
              confirm: {
                  text: "Logout", // Change text for the confirm button
                  value: true,
                  className: "btn-danger", // Optional: add a class to the confirm button
              },
          },
          dangerMode: true,
      })
                .then((willLogout) => {
                    if (willLogout) {
                        document.getElementById('logout-form').submit(); // Submit the logout form
                    }
                });
            }
            // Use jQuery document ready function
            $(document).ready(function() {
                // Add event listener to the button
                $("#loginButton").on("click", function() {
                    // Redirect to the registration page
                    window.location.href = "{{ route('login') }}";
                });
            });
  
  
          // Use jQuery document ready function
          $(document).ready(function() {
              // Add event listener to the button
              $("#loginButton").on("click", function() {
                  // Redirect to the registration page
                  window.location.href = "http://127.0.0.1:8000/login";
              });
          });
      </script>
    
      
    </div>
  </div>
</nav> 

 

  
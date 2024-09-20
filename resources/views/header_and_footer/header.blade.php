<link rel="stylesheet" href="{{ asset('css/main.css') }}" />

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

@csrf


<nav class="navbar navbar-expand-lg py-4 py-lg-0 bg-transparent">
    <div class="container px-4">


        <a class="navbar-brand" aria-current="page" href="{{ route('welcome') }}">
            <img src="{{ asset('images/finallogo.png') }}" alt="" width="190" height="50"
                class="d-inline-block align-text-top">
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#top-navbar"
            aria-controls="top-navbar">
            <i class="lni lni-grid-alt"></i>
        </button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="top-navbar" aria-labelledby="top-navbarLabel">


            <!-- Navigation Bar Content -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#top-navbar" aria-controls="top-navbar">
                <div class="d-flex justify-content-between p-3">
                    <a class="navbar-brand" aria-current="page" href="{{ route('welcome') }}">
                        <img src="{{ asset('images/finallogo.png') }}" alt="" width="190" height="50"
                            class="d-inline-block align-text-top">
                    </a>
                    <i class="lni lni-cross-circle"></i>
                </div>
            </button>


            <ul class="navbar-nav ms-lg-auto p-4 p-lg-0">

                <li class="nav-item px-3 px-lg-0 py-1 py-lg-4">
                    <a class="nav-link {{ request()->routeIs('artisan') ? 'active' : '' }}"
                        href="{{ route('artisan') }}">Artisans</a>
                </li>

                <li class="nav-item px-3 px-lg-0 py-1 py-lg-4">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                        href="{{ route('about') }}">About</a>
                </li>


                @if (Auth::user())
                    @if (Auth::user()->usertypeID == 2)
                        <li class="nav-item px-3 px-lg-0 py-1 py-lg-4">
                            <a class="nav-link {{ request()->routeIs('events') ? 'active' : '' }}"
                                href="{{ route('events') }}">Events</a>
                        </li>

                        <li class="nav-item px-3 px-lg-0 py-1 py-lg-4">
                            <a class="nav-link {{ request()->routeIs('community.index') ? 'active' : '' }}"
                                href="{{ route('community.index') }}">Community</a>
                        </li>
                    @elseif(Auth::user()->usertypeID == 3)
                        <li class="nav-item px-3 px-lg-0 py-1 py-lg-4">
                            <a class="nav-link {{ request()->routeIs('Event.BuyerEvents') ? 'active' : '' }}"
                                href="{{ route('Event.BuyerEvents') }}">Events</a>
                        </li>

                        <li class="nav-item px-3 px-lg-0 py-1 py-lg-4">
                            <a class="nav-link {{ request()->routeIs('community.index') ? 'active' : '' }}"
                                href="{{ route('community.index') }}">Community</a>
                        </li>
                    @else
                        <li class="nav-item px-3 px-lg-0 py-1 py-lg-4">
                            <a class="nav-link {{ request()->routeIs('community.visitor') ? 'active' : '' }}"
                                href="{{ route('community.visitor') }}">Community</a>
                        </li>

                        <li class="nav-item px-3 px-lg-0 py-1 py-lg-4">
                            <a class="nav-link {{ request()->routeIs('Event.BuyerEvents') ? 'active' : '' }}"
                                href="{{ route('Event.BuyerEvents') }}">Events</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item px-3 px-lg-0 py-1 py-lg-4">
                        <a class="nav-link {{ request()->routeIs('Event.BuyerEvents') ? 'active' : '' }}"
                            href="{{ route('Event.BuyerEvents') }}">Events</a>
                    </li>

                    <li class="nav-item px-3 px-lg-0 py-1 py-lg-4">
                        <a class="nav-link {{ request()->routeIs('community.visitor') ? 'active' : '' }}"
                            href="{{ route('community.visitor') }}">Community</a>
                    </li>
                @endif


                 <!-- Inside your dropdown for logged-in users -->
                @if (Auth::check())
                    <!-- Dropdown for logged-in users -->
                    <div class="dropdown">
                        <button class="btn btn-warning dropdown-toggle mt-4" type="button" id="userDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false" style="margin-left: 20px;">
                            {{ Auth::user()->fname }} <!-- Display user's name -->
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="userDropdown">
                            @if (Auth::user()->usertypeID == 2)
                                <li><a class="dropdown-item" href="{{ route('products-seller.index') }}">Profile</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('profile.settings') }}">Settings</a>
                                    {{-- <li><a class="dropdown-item" href="{{ route('profile.edit-profile') }}">Change Password</a> --}}
                                </li> <!-- Edit Profile Link -->
                            @elseif(Auth::user()->usertypeID == 3)
                                <li><a class="dropdown-item"
                                        href="{{ route('profile-buyer', ['slug' => Auth::user()->slug]) }}">Profile</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('profile.buyer-settings') }}">Settings</a>
                                </li> <!-- Edit Profile Link -->
                                <li><a class="dropdown-item" href="{{ route('profile-buyer') }}">Profile</a></li>
                            @endif

                            <li><a class="dropdown-item" href="{{ route('chatify') }}">Inbox</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); logoutConfirmation(event);">Logout</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </div>
                @else
                    <form class="d-flex">
                        @if (Route::has('login'))
                            <button id="loginButton" class="btn btn-warning mt-4" style="margin-left: 20px;"
                                type="button">Join / Login</button>
                        @endif
                    </form>
                @endif



            </ul>
        </div>


        </ul>
    </div>
</nav>





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


    // // Use jQuery document ready function
    // $(document).ready(function() {
    //     // Add event listener to the button
    //     $("#loginButton").on("click", function() {
    //         // Redirect to the registration page
    //         window.location.href = "http://127.0.0.1:8000/login";
    //     });
    // });
</script>



</nav>
</div>

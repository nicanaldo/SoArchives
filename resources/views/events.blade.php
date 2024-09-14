<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>

    <!-- Bootstrap CSS -->
    <link href="/bootstrap-5.3.3-dist/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Your custom JS file (if needed) -->
    @vite(['resources/js/app.js'])
</head>

<body>

    <div class="container-fluid custom-shadow rounded-0 z-0">
        @include('header_and_footer.header')
    </div>

    <div class="container custom-container custom-shadow p-2 mb-4">
        <!-- Carousel for Events -->
        <div class="carousel-container">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @php
                        $filteredEvents = $events->filter(function ($event) {
                            return in_array($event->Status, ['Approved', 'OnGoing']);
                        });
                    @endphp

                    @if ($filteredEvents->isNotEmpty())
                        @foreach ($filteredEvents as $event)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $event->EventImage) }}"
                                    class="d-block w-100 carousel-image" alt="Event Image">
                            </div>
                        @endforeach
                    @else
                        <div class="carousel-item active">
                            <img src="{{ asset('images/No_Events.jpg') }}" class="d-block w-100 carousel-image"
                                alt="Events Header">
                        </div>
                    @endif
                </div>

                @if ($filteredEvents->isNotEmpty())
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                @endif
            </div>
        </div>

    </div>

    <!-- New Container Below Carousel -->
    <div class="overlay-container p-4 mt-n4 text-center">
        <h1>Join and Explore Exciting Events!</h1>
        <p class="text-muted">Be inspired by our Klasmeyts who had their successful events by viewing their event
            gallery!</p>
        <ul class="navbar-nav d-inline-flex justify-content-center">
            <li class="nav-item">
                <a class="btn btn-primary" href="{{ route('gallery') }}">
                    See Events Gallery <i class="fa fa-arrow-right ms-1"></i>
                </a>
            </li>
        </ul>
    </div>



    <!-- Events Section -->
    <div class="container event-section mt-1 p-3 mb-5">
        {{-- @include('header_and_footer.eventsHeader') --}}

        {{-- @if ($filteredEvents->isEmpty())
            <div class="d-flex flex-column align-items-center justify-content-center min-vh-100 text-center">
                <img src="{{ asset('images/Calendar.png') }}" class="mb-3">
                <h4 class="mt-3">No Events Available</h4>
                <p>It looks like there are no events available at the moment. Be the first to create an event!</p>
                <a href="{{ route('events.create') }}" class="btn btn-primary mt-3">
                    <i class="fa fa-plus-circle me-2"></i> Create an Event
                </a>
            </div>
        @else
            <div class="row-cols-12" style="padding-left: 1rem; margin-bottom: 1rem;">
                <a href="{{ route('events.create') }}" class="btn btn-primary mt-3">
                    <i class="fa fa-plus-circle me-2"></i> Create an Event
                </a>
                <a href="{{ route('events.ended') }}" class="text-link">Ended Events</a>
            </div>
        @endif --}}

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-left p-3">
            @foreach ($filteredEvents as $event)
                <div class="col mb-4">
                    <!-- Wrap the entire card with anchor to make it clickable -->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#eventModal{{ $event->EventID }}"
                        class="text-decoration-none">
                        <div class="card custom-shadow rounded-4">
                            <img src="{{ asset('storage/' . $event->EventImage) }}" class="card-img-top"
                                alt="Event Image">

                            <div class="card-body">
                                <!-- Date and Time Section -->
                                <div class="d-flex justify-content-left align-items-center mb-2">
                                    <div class="date-time me-3">
                                        <span
                                            class="date-day">{{ \Carbon\Carbon::parse($event->Date)->format('d') }}</span>
                                        <span
                                            class="date-month">{{ \Carbon\Carbon::parse($event->Date)->format('M Y') }}</span>
                                    </div>

                                    <div class="d-block">
                                        <h5 class="card-title fw-bold">{{ $event->EventName }}</h5>
                                        <p class="card-tex text-muted truncate-description-card pt-2">{{ $event->EventDescription }}</p>
                                        {{-- <p class="card-text mb-0">Created By:
                                            {{ $event->user ? $event->user->fname . ' ' . $event->user->lname : 'Unknown' }}
                                        </p> --}}
                                    </div>

                                </div>

                                @if (Auth::id() == $event->UserID)
                                    <span class="badge">Created by You</span>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="eventModal{{ $event->EventID }}" tabindex="-1"
                    aria-labelledby="eventModalLabel{{ $event->EventID }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="eventModalLabel{{ $event->EventID }}">
                                    {{ $event->EventName }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ asset('storage/' . $event->EventImage) }}"
                                    class="img-fluid modal-img mb-3" alt="Event Image">
                                <h5 class="modal-title">{{ $event->EventName }}</h5>
                                <p class="modal-text">Description: {{ $event->EventDescription }}</p>
                                <p class="modal-text">Date:
                                    {{ \Carbon\Carbon::parse($event->Date)->format('F j, Y') }}
                                </p>
                                <p class="modal-text">Time:
                                    {{ \Carbon\Carbon::parse($event->StartTime)->format('g:i A') }} -
                                    {{ \Carbon\Carbon::parse($event->EndTime)->format('g:i A') }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="card-text">Location:
                                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($event->Location) }}"
                                            class="btn btn-outline-primary" target="_blank">
                                            <i class="fas fa-map-marker-alt"></i> {{ $event->Location }}
                                        </a>
                                    </p><br>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('header_and_footer.footer')

    <!-- Bootstrap JS (ensure this is at the bottom for proper functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>




<style>
    * {
        font-family: 'Helvetica', sans-serif;
    }

    .event-section {
        width: 100%;
        max-width: 80rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, #145DA0, #1a76cc) !important;
        border: 1px solid #145DA0 !important;
        color: white;
        /* Ensure text is readable on gradient */
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #1a76cc, #145DA0) !important;
        border: 1px solid #1a76cc !important;
        color: white;
        /* Ensure text is readable on gradient */
    }

    .text-center {
        /* margin-top: 1rem; */
        color: #145DA0;
        /* font-weight: bold; */
        /* margin-bottom: 50px; */
    }

    .custom-shadow {
        box-shadow: 0px 0 25px 0 rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .custom-container {
        border-radius: 0 !important;
    }

    .carousel-image {
        height: 400px;
        width: auto;
        object-fit: cover;
        border-radius: 8px;
    }

    .carousel-container {
        position: relative;
        z-index: 1;
        /* Ensures the carousel is below the overlay */
    }

    .overlay-container {
        position: relative;
        z-index: 2;
        /* Ensures the overlay is above the carousel */
        background-color: #ffffff;
        /* Background color */
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Shadow effect */
        margin-top: -110px;
        /* Adjust this value to control the overlap */
        padding: 20px;
        max-width: 76rem;
        /* Set the maximum width of the overlay */
        width: 100%;
        /* Make the overlay responsive */
        margin-left: auto;
        /* Center the overlay horizontally */
        margin-right: auto;
        /* Center the overlay horizontally */
        text-align: center;
        /* Optional: center text inside the overlay */
        margin-bottom: 4rem;
    }

    .card-title,
    .card-text {
        margin-bottom: 0 !important;
    }

    .card {
        position: relative;
        border: none !important;
        height: 100%; /* Ensure card takes full height of its container */
        /* Ensure proper positioning for badges */
    }

    .card-img-top {
        height: 250px;
        /* Adjust this value as needed */
        object-fit: cover;
        /* Ensure the image covers the container */
    }

    .card-body {
        padding: 1.25rem;
        /* Adjust padding as needed */
        flex: 1; /* Allow the body to expand and fill available space */
    }

    .date-time {
        text-align: center;
        /* background-color: #f8f9fa; */
        /* Light background for the date section */
        border-radius: 5px;
        padding: 10px;
        /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); */
        /* Subtle shadow */
    }

    .date-day {
        display: block;
        font-size: 1.5rem;
        font-weight: bold;
        color: #145DA0;
    }

    .date-month {
        display: block;
        font-size: 0.875rem;
        color: #6c757d;
        /* Subtle color for month and year */
    }


    .badge {
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 0.75rem;
        background: linear-gradient(135deg, rgba(255, 202, 134, 0.8), rgba(255, 145, 0, 0.8));
        /* Semi-transparent blue background */
        color: white;
        /* Text color for contrast */
        padding: 6px;
        /* Padding for better appearance */
        border-radius: 8px;
        /* Rounded corners */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        /* Subtle shadow for depth */
        font-weight: 600;
        /* Slightly bolder text */
    }



    .modal-img {
        width: 100%;
        height: 300px;
        /* Adjust this value as needed */
        object-fit: cover;
        /* Ensures the image covers the area without distortion */
    }

    .row-cols-12 {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .text-link {
        color: #4a4a4a;
        font-size: 1rem;
        transition: color 0.3s ease;
        text-decoration: none;
        padding-right: 1rem
    }

    .text-link:hover {
        color: #000000;
        text-decoration: underline;
    }

    .truncate-description-card {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: auto; /* Push description down to ensure card height consistency */
}

</style>
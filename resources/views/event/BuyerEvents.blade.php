<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>

    <!-- Bootstrap CSS -->
    <link href="/bootstrap-5.3.3-dist/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href={{ asset('css/events.css')}}>
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

    <div class="container-fluid custom-shadow rounded-0">
        @include('header_and_footer.header')
    </div>

    <div class="container custom-container custom-shadow p-2 mb-4">
        <!-- Carousel for Events -->
        <div class="carousel-container">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @php
                    use Carbon\Carbon;

                    $now = Carbon::now();

                    $filteredEvents = $events->filter(function ($event) use ($now) {
                        $eventDate = Carbon::parse($event->Date);
                        $eventEndTime = Carbon::parse($event->EndTime);

                        $statusCheck = in_array($event->Status, ['Approved', 'OnGoing']);
                        $dateCheck = $eventDate->gt($now->toDateString()) ||
                                     ($eventDate->isSameDay($now->toDateString()) && $eventEndTime->gt($now->toTimeString()));


                        return $statusCheck && $dateCheck;
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
                            <img src="{{ asset('images/No_Events.png') }}" class="d-block w-100 carousel-image"
                                alt="No Events Available">
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
                                        <p class="card-tex text-muted truncate-description-card pt-2">
                                            {{ $event->EventDescription }}</p>
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
                <div class="modal fade dynamic-modal" id="eventModal{{ $event->EventID }}" tabindex="-1"
                    aria-labelledby="eventModalLabel{{ $event->EventID }}" aria-hidden="true" data-bs-backdrop="static"
                    data-bs-keyboard="false">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <!-- Full Image on Top with Overlay for Edit/Delete Menu -->
                            <div class="modal-body p-0 position-relative">
                                <img src="{{ asset('storage/' . $event->EventImage) }}" class="img-fluid w-100"
                                    alt="Event Image" style="object-fit: cover; height: 250px;">
                            </div>
                            <!-- Event Details Below -->
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Event Date and Time and Link Button Container -->
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <!-- Event Date and Time -->
                                            <p class="event-date-time text-muted mb-0">
                                                {{ \Carbon\Carbon::parse($event->Date)->format('l F j, Y') }}
                                                |
                                                {{ \Carbon\Carbon::parse($event->StartTime)->format('g:i A') }}
                                                -
                                                {{ \Carbon\Carbon::parse($event->EndTime)->format('g:i A') }}
                                            </p>

                                            <!-- Link Button -->
                                            @if ($event->Link)
                                                <a href="{{ $event->Link }}" class="btn btn-primary-link" target="_blank">
                                                    <i class="fas fa-link me-2"></i> Link to Join
                                                </a>
                                            @endif
                                        </div>

                                        <!-- Event Name -->
                                        <h5 class="modal-title fw-bold mt-3">
                                            {{ $event->EventName }}
                                        </h5>

                                        <!-- Event Description -->
                                        <p class="modal-text mb-3 text-muted">
                                            {{ $event->EventDescription }}
                                        </p>

                                        <!-- Location with Icon -->
                                        <p class="modal-text mb-3">
                                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($event->Location) }}"
                                                class="btn btn-primary" target="_blank">
                                                <i class="fas fa-map-marker-alt me-2"></i>
                                                {{ $event->Location }}
                                            </a>
                                        </p>
                                    </div>

                                </div>
                            </div>
                            <!-- Modal Footer (Optional, can be removed if not needed) -->
                            <div class="modal-footer">
                                <!-- Close button aligned to the right -->
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



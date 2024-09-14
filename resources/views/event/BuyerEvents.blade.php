<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>

    <link href="/bootstrap-5.3.3-dist/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- to work the toggle in the navbar -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/regular.min.css" integrity="sha512-KYEnM30Gjf5tMbgsrQJsR0FSpufP9S4EiAYi168MvTjK6E83x3r6PTvLPlXYX350/doBXmTFUEnJr/nCsDovuw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-...your-integrity-hash..." crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])

</head>

<body>
    <!-- Header -->
    <header>
        @include('header_and_footer.header')
    </header>

    <!-- Carousel -->
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($events as $event)
                @if(in_array($event->Status, ['Approved', 'OnGoing']))
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $event->EventImage) }}" class="d-block w-100 carousel-image" alt="Event Image">
                    </div>
                @endif
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Tabs -->
    @include('header_and_footer.eventsBuyerHeader')

    <div class="container custom-shadow mt-3 p-3 mb-5 animate__animated animate__slideInUp">
        <ul class="nav nav-pills user-profile-tab justify-content-start mt-2 bg-light-info rounded-2" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-6" id="pills-approved-tab" data-bs-toggle="pill" data-bs-target="#pills-approved" type="button" role="tab" aria-controls="pills-approved" aria-selected="true">
                    <i class="fa fa-calendar me-2 fs-6"></i>
                    <span class="d-none d-md-block">Events</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6" id="pills-ended-tab" data-bs-toggle="pill" data-bs-target="#pills-ended" type="button" role="tab" aria-controls="pills-ended" aria-selected="false" tabindex="-1">
                    <i class="fa fa-calendar-check me-2 fs-6"></i>
                    <span class="d-none d-md-block">Ended Events</span>
                </button>
            </li>
        </ul>

        <!-- Events Tab -->
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-approved" role="tabpanel" aria-labelledby="pills-approved-tab">
                <h1 class="text-center mb-4">Events</h1>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
                    @php
                        $ongoingEvents = [];
                        $endedEvents = [];
                    @endphp
                    @foreach($events as $event)
                        @php
                            $eventEndDate = \Carbon\Carbon::parse($event->Date . ' ' . $event->EndTime);
                            $now = \Carbon\Carbon::now();
                            if($now->gt($eventEndDate)) {
                                $event->Status = 'Ended';
                                $endedEvents[] = $event;
                            } else {
                                $ongoingEvents[] = $event;
                            }
                        @endphp
                        @if($event->Status === 'Approved' || $event->Status === 'OnGoing')
                            <div class="col mb-4">
                                <div class="card" data-bs-toggle="modal" data-bs-target="#eventModal{{ $event->EventID }}">
                                    <img src="{{ asset('storage/' . $event->EventImage) }}" class="card-img-top" alt="Event Image">
                                    @if($event->Link)
                                        @php
                                            $statusColor = '';
                                            switch($event->Status) {
                                                case 'Approved':
                                                    $statusColor = 'btn-success';
                                                    break;
                                                case 'Pending':
                                                    $statusColor = 'btn-warning';
                                                    break;
                                                case 'OnGoing':
                                                    $statusColor = 'btn-info';
                                                    break;
                                                case 'Rejected':
                                                    $statusColor = 'btn-danger';
                                                    break;
                                                case 'Ended':
                                                    $statusColor = 'btn-secondary';
                                                    break;
                                            }
                                        @endphp
                                        <!-- <button type="button" style="border-radius: 0;" class="btn {{ $statusColor }}" disabled>{{ $event->Status }}</button> -->
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $event->EventName }}</h5>
                                        <p class="card-text">{{ $event->EventDescription }}</p>
                                        <p class="card-text">Created By: {{ $event->user ? $event->user->fname . ' ' . $event->user->lname : 'Unknown' }}</p>
                                        <!-- <p class="modal-text">Date: {{ \Carbon\Carbon::parse($event->Date)->format('F j, Y') }}</p>
                                        <p class="modal-text">Time:
                                            {{ \Carbon\Carbon::parse($event->StartTime)->format('g:i A') }} - 
                                            {{ \Carbon\Carbon::parse($event->EndTime)->format('g:i A') }}
                                        </p>
                                        <p class="card-text" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Location: {{ $event->Location }}</p> -->
                                        <!-- <a href="{{ $event->Link }}" class="btn btn-primary" target="_blank">Link to Join</a> -->
                                        <!-- Modal Button -->
                                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal{{ $event->EventID }}">View Details</button> -->
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Ended Events Tab -->
            <div class="tab-pane fade" id="pills-ended" role="tabpanel" aria-labelledby="pills-ended-tab">
                <h1 class="text-center mb-4">Ended Events</h1>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
                    @foreach($endedEvents as $event)
                        <div class="col mb-4">
                            <div class="card" data-bs-toggle="modal" data-bs-target="#eventModal{{ $event->EventID }}">
                                <img src="{{ asset('storage/' . $event->EventImage) }}" class="card-img-top" alt="Event Image">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $event->EventName }}</h5>
                                    <p class="card-text">{{ $event->EventDescription }}</p>
                                    <p class="card-text">Created By: {{ $event->user ? $event->user->fname . ' ' . $event->user->lname : 'Unknown' }}</p>
                                    <!-- <p class="modal-text">Date: {{ \Carbon\Carbon::parse($event->Date)->format('F j, Y') }}</p>
                                    <p class="modal-text">Time:
                                        {{ \Carbon\Carbon::parse($event->StartTime)->format('g:i A') }} - 
                                        {{ \Carbon\Carbon::parse($event->EndTime)->format('g:i A') }}
                                    </p>
                                    <p class="card-text" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Location: {{ $event->Location }}</p> -->
                                    <!-- @if($event->Link)
                                        <a href="{{ $event->Link }}" class="btn btn-primary" target="_blank">Link to Join</a>
                                    @endif -->
                                    <!-- Modal Button -->
                                    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal{{ $event->EventID }}">View Details</button> -->
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    @foreach($events as $event)
        <div class="modal fade" id="eventModal{{ $event->EventID }}" tabindex="-1" aria-labelledby="eventModalLabel{{ $event->EventID }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventModalLabel{{ $event->EventID }}">{{ $event->EventName }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('storage/' . $event->EventImage) }}" class="img-fluid mb-3" alt="Event Image">
                        <p><strong>Description:</strong> {{ $event->EventDescription }}</p>
                        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->Date)->format('F j, Y') }}</p>
                        <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($event->StartTime)->format('g:i A') }} - {{ \Carbon\Carbon::parse($event->EndTime)->format('g:i A') }}</p>
                        <p><strong>Location:</strong> {{ $event->Location }}</p>
                        @if($event->Link)
                            <a href="{{ $event->Link }}" class="btn btn-primary" target="_blank">Link to Join</a>
                        @endif
                        <p><strong>Created By:</strong> {{ $event->user ? $event->user->fname . ' ' . $event->user->lname : 'Unknown' }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach




    @yield('content')


<footer>
    @include('header_and_footer.footer')
</footer>

    
</body>

</html>

<style>
      *{
        font-family: 'Helvetica', sans-serif; 
    }

    .text-center {
        /* margin-top: 1rem; */
        color: #145DA0;
        /* font-weight: bold; */
        /* margin-bottom: 50px; */
    }

    .custom-shadow {
        box-shadow: 0px 0 25px 0 rgba(0, 0, 0, 0.1);
    }

    .card-img-top {
        height: 300px;
        object-fit: cover;
    }

    .carousel-image {
        height: 470px;
        width: auto;
        object-fit: cover;
    }

    .card-title{
        color: black;
        font-weight: 600;
    }

    .card {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .card-body {
        flex: 1 1 auto;
    }

    .card-img-top {
        height: 180px;
        object-fit: cover;
    }

    .card-title, .card-text {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
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



        
    .user-profile-tab .nav-item .nav-link.active {
        color: #FFC107;
        border-bottom: 2px solid #FFC107;
    }

    .user-profile-tab .nav-item .nav-link {
        color: #343434;
    }

    .overflow-hidden {
        overflow: hidden !important;
    }
</style>
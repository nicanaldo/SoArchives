<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>

    <link href="/bootstrap-5.3.3-dist/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">



    <!-- to work the toggle in the navbar -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <!-- soarchive file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/regular.min.css" integrity="sha512-KYEnM30Gjf5tMbgsrQJsR0FSpufP9S4EiAYi168MvTjK6E83x3r6PTvLPlXYX350/doBXmTFUEnJr/nCsDovuw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Animate CSS -->
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Scripts -->
    @vite(['resources/js/app.js'])


</head>



<body>
    <header>
        @include('header_and_footer.header')
  </header>



<!-- <div class="container-fluid" style="padding: 0;">
    <div class="event-banner">
        <img src="/images/ev.png" alt="">
        <div class="banner-content">
            <h1 class="banner-text">Mark your Calendars!</h1>
        </div>
    </div>
</div> -->



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

        <!-- Event updated successfully. -->
    <div class="container custom-shadow mt-5 p-3 mb-5 ">

    <div class="row-cols-12" style="padding-left: 1rem; margin-bottom: 1rem;" >
        <a href="{{ route('events.try') }}" class="btn btn-primary mt-3">Create an Event</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif


        <!-- Events Created by Sellers -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 justify-content-left p-3">
            
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
            @endforeach

            <!-- Ongoing or Accepted Events -->
            @foreach($ongoingEvents as $event)
                <div class="col mb-4">
                    <div class="card">
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
                            <button type="button" style="border-radius: 0;" class="btn {{ $statusColor }}" disabled>{{ $event->Status }}</button>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $event->EventName }}</h5>
                            <p class="card-text" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $event->EventDescription }}</p>
                            <p class="card-text">Date: {{ $event->Date }}</p>
                            <p class="card-text">Time: {{ $event->StartTime }} - {{ $event->EndTime }}</p>
                            <p class="card-text" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Location: {{ $event->Location }}</p>
                            <!-- <a href="{{ $event->Link }}" class="btn btn-primary" target="_blank">Link to Join</a> -->
                            <!-- Modal Button -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal{{ $event->EventID }}">View Details</button>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Ended Events -->
            @foreach($endedEvents as $event)
                <div class="col mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $event->EventImage) }}" class="card-img-top" alt="Event Image">
                        @if($event->Link)
                            @php
                                $statusColor = '';
                                switch($event->Status) {
                                    case 'Accepted':
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
                            <button type="button" class="btn {{ $statusColor }}" disabled>{{ $event->Status }}</button>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->EventName }}</h5>
                            <p class="card-text">{{ $event->EventDescription }}</p>
                            <p class="card-text">Date: {{ $event->Date }}</p>
                            <p class="card-text">Time: {{ $event->StartTime }} - {{ $event->EndTime }}</p>
                            <p class="card-text">Location: {{ $event->Location }}</p>
                            <a href="{{ $event->Link }}" class="btn btn-primary" target="_blank">Link to Join</a>
                            <!-- Modal Button -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal{{ $event->EventID }}">View Details</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

            <!-- Modal for View Details -->
            @foreach($events as $event)
            <div class="modal fade" id="eventModal{{ $event->EventID }}" tabindex="-1" aria-labelledby="eventModalLabel{{ $event->EventID }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $event->EventName }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 text-center mb-2">
                                    <img src="{{ asset('storage/' . $event->EventImage) }}" class="card-img-top" alt="Event Image" style="height: 400px; object-fit: relative;">
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="modal-text"><strong>Description:</strong> <br> {{ $event->EventDescription }}</p>
                                    <p class="modal-text"><strong>Date:</strong> <br>{{ $event->Date }}</p>
                                    <p class="modal-text"><strong>Time:</strong> <br>{{ $event->StartTime }} - {{ $event->EndTime }}</p>
                                    <p class="modal-text"><strong>Location:</strong> <br>{{ $event->Location }}</p>
                                    
                                    @if($event->Link)
                                    <div class="col-md-12">
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
                                        <!-- Event Status -->
                                        <button type="button" class="btn {{ $statusColor }} mr-2 text-left" disabled>{{ $event->Status }}</button>

                                        <!-- Link of Form or Meeting -->
                                        <a href="{{ $event->Link }}" class="btn btn-primary" target="_blank">Link to Join</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">

                            <!-- Edit button -->
                            <button type="button" class="btn btn-primary edit-event" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#editEventModal{{ $event->EventID }}">Edit</button>
                            <!-- Delete button -->
                            <button type="button" class="btn btn-danger delete-event" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $event->EventID }}">Delete</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach



        <!-- Modal for Editing Events -->
        @foreach($events as $event)
        <div class="modal fade" id="editEventModal{{ $event->EventID }}" tabindex="-1" aria-labelledby="editEventModalLabel{{ $event->EventID }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                    <div style="text-align: center;">
                        <h1 for="header" class="form-name fs-5">Edit Event</h1>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <!-- Event edit form content -->
                        <form action="{{ route('events.update', $event->EventID) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="eventImage" class="form-label">Event Image</label>
                                <input type="file" class="form-control" id="eventImage" name="EImage">
                            </div>
                            <div class="mb-3">
                                <label for="eventName" class="form-label">Event Name</label>
                                <input type="text" class="form-control" id="eventName" name="EName" value="{{ $event->EventName }}">
                            </div>
                            <div class="mb-3">
                                <label for="eventDescription" class="form-label">Description</label>
                                <input class="form-control" id="eventDescription" name="EDescription" value="{{ $event->EventDescription }}">
                            </div>
                            <div class="row">
                            <div class="col-md-4">
                                <label for="eventDate" class="form-label">Date</label>
                                <input type="date" class="form-control" id="eventDate" name="EDate" value="{{ $event->Date }}">
                            </div>
                            <div class="col-md-4">
                                <label for="eventStartTime" class="form-label">Start Time</label>
                                <input type="time" class="form-control" id="eventStartTime" name="EStartTime" value="{{ $event->StartTime }}">
                            </div>
                            <div class="col-md-4">
                                <label for="eventEndTime" class="form-label">End Time</label>
                                <input type="time" class="form-control" id="eventEndTime" name="EEndTime" value="{{ $event->EndTime }}">
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6">
                                <label for="eventLocation" class="form-label">Location</label>
                                <input type="text" class="form-control" id="eventLocation" name="ELocation" value="{{ $event->Location }}">
                            </div>
                            <div class="col-md-6">
                                <label for="eventLink" class="form-label">Link</label>
                                <input type="url" class="form-control" id="eventLink" name="ELink" value="{{ $event->Link }}">
                            </div>
                            </div>
                            <div style="margin-top: 9px;">
                            <button style="margin-right:9px;" type="submit" class="btn btn-primary">Update</button>
                        </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>    
                    </div>
                    </div>
                </div>
            </div>
        </div>
        


        <!-- Confirmation Modal for Deleting Event -->
        <div class="modal fade" id="confirmDeleteModal{{ $event->EventID }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel{{ $event->EventID }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel{{ $event->EventID }}">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">Are you sure you want to delete this event?</div>
                    <div class="modal-footer">
                        <form action="{{ route('events.destroy', $event->EventID) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    

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
        height: 550px;
        width: auto;
        object-fit: cover;
    }

</style>
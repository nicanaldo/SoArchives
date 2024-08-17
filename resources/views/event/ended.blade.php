<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ended Events</title>
    <link href="/bootstrap-5.3.3-dist/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/js/app.js'])
</head>
<body>
    <header>
        @include('header_and_footer.header')
    </header>

    <div class="container custom-shadow mt-1 p-3 mb-5 ">
        <div class="container mt-3">
            <a href="{{ route('events') }}" class="btn shadow" style="background-color: #fff;">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <h1 class="text-center mb-4">Ended Events</h1>

        @if($endedEvents->isEmpty())
            <p class="text-center">No ended events to display.</p>
        @else
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
                @foreach($endedEvents as $event)
                    <div class="col mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $event->EventImage) }}" class="card-img-top" alt="Event Image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $event->EventName }}</h5>
                                <p class="card-text">{{ $event->EventDescription }}</p>
                                <p class="card-text">Date: {{ \Carbon\Carbon::parse($event->Date)->format('F j, Y') }}</p>
                                <p class="card-text">Time: {{ \Carbon\Carbon::parse($event->StartTime)->format('g:i A') }} - {{ \Carbon\Carbon::parse($event->EndTime)->format('g:i A') }}</p>
                                <p class="card-text">Location: {{ $event->Location }}</p>
                                <!-- Modal Button -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal{{ $event->EventID }}">View Details</button>
                            </div>
                        </div>
                    </div>
                @endforeach

            <!-- Modal for View Details -->
            @foreach($endedEvents as $event)
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
                                    <p class="modal-text">Description: <br> {{ $event->EventDescription }}</p>
                                    <p class="modal-text">Date: {{ \Carbon\Carbon::parse($event->Date)->format('F j, Y') }}</p>
                                    <p class="modal-text">Time:
                                        {{ \Carbon\Carbon::parse($event->StartTime)->format('g:i A') }} - 
                                        {{ \Carbon\Carbon::parse($event->EndTime)->format('g:i A') }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="card-text">Location:
                                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($event->Location) }}" class="btn btn-outline-primary" target="_blank">
                                            <i class="fas fa-map-marker-alt"></i> {{ $event->Location }}
                                        </a></p><br>
                                    </div>     
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            </div>
        @endif
    </div>

    <footer>
        @include('header_and_footer.footer')
    </footer>
</body>

<style>
    .card {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .card-body {
        flex: 1 1 auto;
    }

    .card-img-top {
        height: 180px; /* Adjust based on your image size */
        object-fit: cover;
    }

    .card-title, .card-text {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
</html>

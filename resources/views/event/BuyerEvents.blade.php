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


    <!-- soarchive file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/regular.min.css" integrity="sha512-KYEnM30Gjf5tMbgsrQJsR0FSpufP9S4EiAYi168MvTjK6E83x3r6PTvLPlXYX350/doBXmTFUEnJr/nCsDovuw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/js/app.js'])


</head>



<body>

     <!-- Modal for View Details -->
     @foreach($events as $event)
     @if(in_array($event->Status, ['Approved', 'OnGoing']))
     <div class="modal fade" id="eventModal{{ $event->EventID }}" tabindex="-1" aria-labelledby="eventModalLabel{{ $event->EventID }}" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content">
                 <div class="modal-body">
                 <h1 class="modal-title fs-5" style="text-align: center;" id="eventModalLabel{{ $event->EventID }}">Event Details</h1>
                     <div class="row">
                         <div class="col-md-12 text-center mb-2">
                             <img src="{{ asset('storage/' . $event->EventImage) }}" class="card-img-top" alt="Event Image" style="height: 300px; object-fit: cover;">
                         </div>
                         <h5 class="modal-title">{{ $event->EventName }}</h5>
                         <p class="modal-text">{{ $event->EventDescription }}</p>
                         <p class="modal-text">Date: {{ $event->Date }} Time: {{ $event->StartTime }} - {{ $event->EndTime }}</p>
                         <p class="modal-text">Location: {{ $event->Location }}</p>
                     </div>
                     <div style="margin-right:9px;" class="d-flex justify-content-between align-items-center">
                     <a href="{{ $event->Link }}" class="btn btn-primary" target="_blank">Link to Join</a>
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                 </div>
                 </div>
             </div>
         </div>
     </div>
     @endif
     @endforeach
 </div>
    <header>
        @include('header_and_footer.header')
  </header>


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


    <div class="container custom-shadow mt-5 p-3 mb-5 animate__animated animate__slideInUp ">
       

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 justify-content-left p-3">
            @foreach($events as $event)
            @if(in_array($event->Status, ['Approved', 'OnGoing']))
            <div class="col mb-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $event->EventImage) }}" class="card-img-top" alt="Event Image" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $event->EventName }}</h5>
                        <p class="card-description" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $event->EventDescription }}</p>
                        <p class="card-date">Date: {{ $event->Date }}</p>
                        <p class="card-StartTime">Time: {{ $event->StartTime }} - {{ $event->EndTime }}</p>
                        <p class="card-EndTime" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Location: {{ $event->Location }}</p>
                        {{-- <a href="{{ route('home') }}" class="btn btn-primary" target="_blank">Link to Join</a>  --}}

                        <!-- Modal Button -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal{{ $event->EventID }}">View Details</button>
                    </div>
                </div>
            </div>
            @endif
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
        height: 470px;
        width: auto;
        object-fit: cover;
    }

.card-title{
    color: black;
    font-weight: 600;
}
</style>
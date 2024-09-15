<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Gallery</title>

    <link href="/bootstrap-5.3.3-dist/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href={{ asset('css/style.css')}}>

    <!-- to work the toggle in the navbar -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>

<body>

    <header>
        @include('header_and_footer.header')
    </header>


    <div class="gallery-title mt-5">
        <h1>A Showcase of Memories: Events Gallery</h1>
        <p class="gallery-desc mb-5 lh-2">Discover the creativity and craftsmanship of Adamsonian artisans,
            showcased through unforgettable events <br> that celebrate their passion, talent, and unique artistry.</p>
        <ul class="navbar-nav d-inline-flex justify-content-center">
            <li class="nav-item">
                <a class="btn btn-primary" href="{{ route('events') }}">
                    <i class="fa fa-arrow-left me-1"></i> Go back to events
                </a>
            </li>
        </ul>
    </div>

    <div class="container mt-1 p-3 mb-1">

        @if (count($events) === 0)
            <div class="d-flex flex-column align-items-center justify-content-center text-center">
                <img src="{{ asset('images/No_Images.png') }}" style="width: 400px;" class="mb-3">
                <h4 class="mt-3">No Image Available</h4>
                <p>It looks like there are no images available at the moment.</p>

            </div>
        @endif

        <div class="row">
            @foreach ($events as $event)
                <div class="col-md-3 mb-4">
                    <a href="{{ route('gallery.showEventImages', ['eventId' => $event->EventID]) }}" class="card-link">
                        <div class="card position-relative">
                            @if ($event->UserID === $currentUserId)
                                <div class="badge-container">
                                    <span class="badge">Created by You</span>
                                </div>
                            @endif
                            <!-- Image with shadow overlay -->
                            <div class="image-wrapper">
                                <img src="{{ asset('storage/' . $event->EventImage) }}" class="card-img-top"
                                    alt="Event Image">
                                <div class="image-shadow-overlay"></div>
                            </div>

                            <!-- Event title -->
                            <div class="event-title-overlay">
                                <h5 class="card-title fw-normal">{{ $event->EventName }}</h5>
                                <span
                                    class="date-day text-white fw-light">{{ \Carbon\Carbon::parse($event->Date)->format('d') }}</span>
                                <span
                                    class="date-month text-white fw-light">{{ \Carbon\Carbon::parse($event->Date)->format('M Y') }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>


    <!-- Upload Image Modal -->
    <div class="modal fade" id="UploadImageModal" tabindex="-1" aria-labelledby="UploadImageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="UploadImageModalLabel">Upload Images</h1>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('gallery.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="EventID" id="uploadEventId">
                        <div class="mb-3">
                            <label for="gallery" class="form-label">Click here to add Images:</label>
                            <input type="file" class="form-control" id="gallery" name="gallery[]" accept="image/*"
                                multiple required>
                            <p class="text-muted">Accepted image formats: .jpeg, .jpg, .png, with a maximum size of 2MB
                                per image.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-primary').forEach(function(button) {
                button.addEventListener('click', function() {
                    var eventId = button.getAttribute('data-event-id');
                    document.getElementById('uploadEventId').value = eventId;
                });
            });

            document.querySelectorAll('.btn-secondary').forEach(function(button) {
                button.addEventListener('click', function() {
                    var url = button.getAttribute('data-url');
                    if (url) {
                        window.location.href = url;
                    } else {
                        console.error('No URL found for button');
                    }
                });
            });
        });
    </script>


    <footer>
        @include('header_and_footer.footer')
    </footer>
</body>

<style>
    * {
        font-family: 'Helvetica'
    }

    .gallery-title {
        text-align: center;
        /* Center the text and the button */
    }

    .navbar-nav {
        display: flex;
        justify-content: center;
        /* Center the button horizontally */
        padding: 0;
        /* Remove any default padding */
        margin: 0;
        /* Remove any default margin */
        list-style: none;
        /* Remove default list styling */
    }

    .nav-item {
        display: flex;
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

    .btn {
        margin: 0;
        /* Ensure no extra margin around the button */
    }


    .card-img-top {
        width: 100%;
        /* Make sure the image fills the width of the card */
        height: 300px;
        /* Fixed height for equal image sizes */
        object-fit: cover;
        /* Ensure the image covers the area while maintaining aspect ratio */

    }

    .card {
        position: relative;
        overflow: hidden;
        border-radius: 10px !important;
        /* Ensure any overflow is hidden */
    }

    .image-wrapper {
        position: relative;
    }

    .image-shadow-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0) 50%);
        pointer-events: none;
        /* Ensures the shadow overlay doesn't block clicks */
    }

    .event-title-overlay {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        text-align: center;
    }

    .event-title-overlay h5 {
        font-size: 1.5rem;
        color: white;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8);
        font-weight: bold;
    }

    .gallery-title h1 {
        color: #145DA0;
        font-weight: 700;
        font-size: 4rem;
    }

    .gallery-desc {
        line-height: 2.5rem !important;
    }

    .card-link {
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 0.25rem;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
        position: relative;
    }

    .card-link:hover .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transform: scale(1.02);
    }

    .card-link:hover {
        transform: scale(1.05);
    }

    .badge-container {
        background: linear-gradient(135deg, rgba(255, 202, 134, 0.8), rgba(255, 145, 0, 0.8));
        /* Text color for contrast */
        padding: 1px;
        /* Padding for better appearance */
        border-radius: 8px;
        /* Semi-transparent blue background */
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 10;
    }

    .card-img-top {
        transition: transform 0.3s ease;
    }

    .card-body {
        padding: 1rem;
    }
</style>

</html>

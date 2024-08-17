<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Gallery</title>

    <link href="/bootstrap-5.3.3-dist/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">

    <!-- to work the toggle in the navbar -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font Awesome -->
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

    @include('header_and_footer.eventsBuyerHeader')

    <div class="container custom-shadow mt-1 p-3 mb-1">
        <h2>Gallery</h2>
        <div class="row">
            @foreach($events as $event)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $event->EventImage) }}" class="card-img-top" alt="Event Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->EventName }}</h5>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewImagesModal" data-event-id="{{ $event->EventID }}">
                                View Event Images
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- View Images Modal -->
    <div class="modal fade" id="viewImagesModal" tabindex="-1" aria-labelledby="viewImagesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="viewImagesModalLabel">Event Images</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalImagesBody">
                    <!-- Images will be dynamically inserted here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var viewImagesModal = document.getElementById('viewImagesModal');
        viewImagesModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var eventId = button.getAttribute('data-event-id'); // Extract info from data-* attributes

            var modalBody = viewImagesModal.querySelector('#modalImagesBody');
            modalBody.innerHTML = '<p>Loading images...</p>';

            // Fetch images for the selected event
            fetch(`/api/events/${eventId}/images`)
                .then(response => response.json())
                .then(data => {
                    if (data.images.length > 0) {
                        modalBody.innerHTML = '';
                        data.images.forEach(image => {
                            var imgElement = document.createElement('img');
                            imgElement.src = `/storage/${image.path}`;
                            imgElement.alt = 'Event Image';
                            imgElement.className = 'img-fluid mb-2';
                            modalBody.appendChild(imgElement);
                        });
                    } else {
                        modalBody.innerHTML = '<p>No images found for this event.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching images:', error);
                    modalBody.innerHTML = '<p>Error loading images.</p>';
                });
        });
    });
    </script>

    <footer>
        @include('header_and_footer.footer')
    </footer>
</body>
</html>

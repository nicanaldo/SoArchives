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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-...your-integrity-hash..." crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
   
</head>

<body>
    <header>
        @include('header_and_footer.header')
    </header>

    <div class="container-fluid" style="padding: 0;">
        <div class="event-banner">
            <img src="{{ asset('images/ev.png') }}" alt="">
            <div class="banner-content">
                <h1 class="banner-text">Create exciting events!</h1>
            </div>
        </div>
    </div> 
   


    <div class="container mt-5">
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form id="eventForm" method="POST" action="{{ route('create.event.submit') }}" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div style="text-align: center;">
                                <label for="header" class="form-name">Create an Event Form</label>
                            </div>
                            <div class="mb-3">
                                <input type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#instructionsModal" value="How to Create Events?">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Upload Event Banner</label>
                                <input type="file" class="form-control" id="EventImage" name="EventImage" accept="image/*" required>
                                <div class="invalid-feedback">Please upload a banner for the event.</div>
                                <p class="text-muted">Accepted image formats: .jpeg, .jpg, .png, with a maximum size of 2MB per image. <br>Recommended image size: 1905px x 600px</p>
                            </div>
                            <div class="mb-3">
                                <label for="EventName" class="form-label">Event Name</label>
                                <input type="text" class="form-control" id="EventName" name="EventName" placeholder="Event Name" required>
                                <div class="invalid-feedback">Please provide the event name.</div>
                            </div>
                            <div class="mb-3">
                                <label for="Description" class="form-label">Description</label>
                                <input type="text" class="form-control" id="Description" name="EventDescription" placeholder="Event Description" required >
                                <div class="invalid-feedback">Please provide a description for the event.</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="datetime" class="form-label">Event Date</label>
                                    <input style="margin-bottom:10px;" type="date" class="form-control" id="Date" name="Date" required min="<?php echo date('Y-m-d'); ?>">
                                    <div class="invalid-feedback">Please provide the event date.</div>
                                </div>
                                <div class="col-md-4">
                                    <label for="start-time" class="form-label">Start Time</label>
                                    <input type="time" class="form-control" id="StartTime" name="StartTime" required>
                                    <div class="invalid-feedback">Please provide the start time.</div>
                                </div>
                                <div class="col-md-4">
                                    <label for="end-time" class="form-label">End Time</label>
                                    <input type="time" class="form-control" id="EndTime" name="EndTime" required>
                                    <div class="invalid-feedback">Please provide the end time.</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" class="form-control" id="Location" name="Location" required placeholder="Location">
                                    <div class="invalid-feedback">Please provide the event location.</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="link" class="form-label">Link for Registration</label>
                                    <input type="url" class="form-control" id="Link" name="Link" required placeholder="Link">
                                    <div class="invalid-feedback">Please provide a link for registration.</div>
                                </div>
                            </div>
                            <div style="margin-top:9px;" class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary me-md-2">Create</button>
                                <a href="{{ route('events') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Instructions Modal -->
    <div class="modal fade" id="instructionsModal" tabindex="-1" aria-labelledby="instructionsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h2 class="modal-title" id="instructionsModalLabel">How to Create Events?</h2>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <p class="text-center">Here’s a quick overview of the process, from start to finish.</p>
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="card Instructions">
                                    <img src="{{ asset('images/event_banner.png') }}" class="card-img-top" alt="Instructions 1">
                                    <div class="card-body">
                                        <h5 class="card-title">Event Banner</h5>
                                        <p class="card-text">The banner image should have a recommended size of 580px x 600px.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card Instructions">
                                    <img src="{{ asset('images/form_link.png') }}" class="card-img-top" alt="Instructions 1">
                                    <div class="card-body">
                                        <h5 class="card-title">Form Link for Registration</h5>
                                        <p class="card-text">Provide a Form Link where users can register for the event.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card Instructions">
                                    <img src="{{ asset('images/field_form.png') }}" class="card-img-top" alt="Instructions 1">
                                    <div class="card-body">
                                        <h5 class="card-title">Form Validation</h5>
                                        <p class="card-text">Ensure all required fields are filled out and valid before submitting the form.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Let's Create Events!</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

        <!-- Sweet alert -->
        @if (Session::has('message'))
            @if (Session::get('type') === 'success')
                <script>
                    swal("Success", "{{ Session::get('message') }}", 'success', {
                        text: "You will be redirected to the events page shortly.",
                        button: "OK",
                        timer: 3000,
                    }).then(function() {
                        
                        window.location.href = "{{ route('events.index') }}";
                    });
                </script>
                @elseif (Session::get('type') === 'error')
                <script>
                    swal("Error", "{{ Session::get('message') }}", 'error', {
                        button: "OK",
                    });
                </script>
            @endif
        @endif

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('eventForm');

        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                form.classList.add('was-validated');
            }
        });
    });
    </script>


    <footer>
        @include('header_and_footer.footer')
    </footer>
    
</body>

</html>

<style>
    .card-header {
        color: #00A6ED;
        border-bottom: none;
        font-size: 30px;
        font-weight: bolder;
        text-align: center;
    }

    .card {
        background-color: #FFFFFF;
    }

    body {
     
        box-shadow: 2px 4px 6px rgba(20, 93, 160, 0.2);
    }

    .form-name {
        color: #145DA0;
        font-weight: bold;
        font-family: Helvetica, Arial, sans-serif;
        font-size: 20px;
    }

    .event-banner img{
        position: relative;
        width: 100%;
        height: 250px;
    }

    .event-banner {
    position: relative;

    }

    .banner-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .banner-text {
        color: white;
        font-size: 36px;

    }
        .modal-header {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .modal-title {
        color: #145DA0;
        font-weight: bold;
        letter-spacing: 1px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        margin: 0;
    }

    .card-img-top {
        width: 100%;
        position: center;
        height: auto;
    }

    .card.Instructions {
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 100%;
        border: 1px solid #ddd;
        border-radius: 0.25rem;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin: 10px;
    }

</style>
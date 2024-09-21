<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <!-- Rest of your template content -->
</head>

<body>


    <div class="container-fluid custom-shadow">

        @include('header_and_footer.header')


        {{-- Cover Photo --}}
        <div class="container-fluid custom-shadow-profile">
            <div class="container cover">
                <div class="header__wrapper d-flex justify-content-center position-relative">
                    <img id="coverImage"
                        src="{{ asset($user->cover_photo ? 'storage/cover_photos/' . $user->id . '/' . basename($user->cover_photo) : 'images/finalcover.png') }}"
                        alt="Cover Photo" class="cover-photo" />
                    <div class="upload-overlay d-flex flex-column align-items-center">
                        <input type="file" id="coverUpload" accept="image/*" style="display: none;" />
                        <button type="button" class="btn btn-light mt-2" id="uploadButton"><i
                                class="fas fa-upload"></i> Change Cover Photo</button>
                        <button type="button" class="btn btn-primary mt-2" id="saveButton"
                            style="display: none;">Save</button>
                        <button type="button" class="btn btn-danger mt-2" id="deleteButton"><i
                                class="fas fa-trash"></i> Delete</button>
                    </div>
                </div>
            </div>
    
            <script>
                // Uploading of photo preview and action confirmation
                let originalCoverImageSrc = document.getElementById('coverImage').src;
    
                document.getElementById('uploadButton').addEventListener('click', function() {
                    document.getElementById('coverUpload').click();
                });
    
                document.getElementById('coverUpload').addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('coverImage').src = e.target.result;
                            document.getElementById('saveButton').style.display = 'block'; // Show save button
                        };
                        reader.readAsDataURL(file);
                    }
                });
    
                document.getElementById('saveButton').addEventListener('click', function() {
                    swal({
                        title: "Are you sure?",
                        text: "Do you want to save this cover photo?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willSave) => {
                        if (willSave) {
                            const fileInput = document.getElementById('coverUpload');
                            const formData = new FormData();
                            formData.append('cover_photo', fileInput.files[0]);
    
                            fetch('{{ route('seller.cover-photo') }}', {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                }).then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        originalCoverImageSrc = data.image_path; // Update original image source
                                        document.getElementById('saveButton').style.display = 'none';
                                        swal({
                                            title: "Success!",
                                            text: "Cover photo saved successfully!",
                                            icon: "success",
                                            buttons: "OK", // Ensures user confirms the alert
                                        });
                                    } else {
                                        swal("Error!", "Failed to save cover photo.", "error");
                                    }
                                }).catch(error => {
                                    console.error('Error:', error);
                                    swal("Error!", "Something went wrong.", "error");
                                });
                        } else {
                            // Revert to original image if user cancels saving
                            document.getElementById('coverImage').src = originalCoverImageSrc;
                            document.getElementById('saveButton').style.display = 'none';
                        }
                    });
                });
    
                document.getElementById('deleteButton').addEventListener('click', function() {
                    swal({
                        title: "Are you sure?",
                        text: "Do you want to delete your cover photo?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            fetch('{{ route('seller.cover-photo.delete') }}', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json',
                                    },
                                }).then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        swal({
                                            title: "Deleted!",
                                            text: "Cover photo deleted successfully!",
                                            icon: "success",
                                            buttons: "OK"
                                        }).then(() => {
                                            window.location
                                        .reload(); // Refresh the page after success alert
                                        });
                                    } else {
                                        swal("Error!", "Failed to delete cover photo.", "error");
                                    }
                                }).catch(error => {
                                    console.error('Error:', error);
                                    swal("Error!", "Something went wrong.", "error");
                                });
                        }
                    });
                });
            </script>
    
    
            {{-- Profile Picture --}}
            <div class="container d-flex justify-content-center align-items-center">
                <div class="img__container position-relative thick-border-container">
                    <img id="profileImage"
                        src="{{ asset($user->profile_photo ? 'storage/profile_photos/' . $user->id . '/' . basename($user->profile_photo) : 'images/defuser.png') }}"
                        alt="Profile Picture" class="thick-border-buyer profile-picture" />
    
                    <!-- Hover Overlay for Uploading a New Profile Picture -->
                    <div
                        class="profile-upload-overlay d-flex flex-column align-items-center justify-content-center">
                        <input type="file" id="profileUpload" accept="image/*" style="display: none;" />
                        <button type="button" class="btn btn-light" id="profileUploadButton"><i
                                class="fas fa-upload"></i> Change</button>
                        <button type="button" class="btn btn-success mt-2" id="profileSaveButton"
                            style="display: none;">Save</button>
                        <button type="button" class="btn btn-danger mt-2" id="profileDeleteButton"><i
                                class="fas fa-trash"></i> Delete</button>
                    </div>
                </div>
            </div>
    
            <script>
                // Uploading photo preview
                let originalProfileImageSrc = document.getElementById('profileImage').src;
    
                document.getElementById('profileUploadButton').addEventListener('click', function() {
                    document.getElementById('profileUpload').click();
                });
    
                document.getElementById('profileUpload').addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('profileImage').src = e.target.result;
                            document.getElementById('profileSaveButton').style.display = 'block'; // Show save button
                        };
                        reader.readAsDataURL(file);
                    }
                });
    
                document.getElementById('profileSaveButton').addEventListener('click', function() {
                    swal({
                        title: "Are you sure?",
                        text: "Do you want to save this profile picture?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willSave) => {
                        if (willSave) {
                            const fileInput = document.getElementById('profileUpload');
                            const formData = new FormData();
                            formData.append('profile_photo', fileInput.files[0]);
    
                            fetch('{{ route('seller.profile-photo') }}', {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                }).then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        originalProfileImageSrc = data
                                        .image_path; // Update original image source
                                        document.getElementById('profileSaveButton').style.display = 'none';
                                        swal({
                                            title: "Success!",
                                            text: "Profile photo saved successfully!",
                                            icon: "success",
                                            buttons: "OK", // Ensures user confirms the alert
                                        });
                                    } else {
                                        swal("Error!", "Failed to save profile photo.", "error");
                                    }
                                }).catch(error => {
                                    console.error('Error:', error);
                                    swal("Error!", "Something went wrong.", "error");
                                });
                        } else {
                            // Revert to original image if user cancels saving
                            document.getElementById('profileImage').src = originalProfileImageSrc;
                            document.getElementById('profileSaveButton').style.display = 'none';
                        }
                    });
                });
    
                document.getElementById('profileDeleteButton').addEventListener('click', function() {
                    swal({
                        title: "Are you sure?",
                        text: "Do you want to delete your profile photo?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            fetch('{{ route('seller.profile-photo.delete') }}', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json',
                                    },
                                }).then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        swal({
                                            title: "Deleted!",
                                            text: "Profile photo deleted successfully!",
                                            icon: "success",
                                            buttons: "OK"
                                        }).then(() => {
                                            window.location
                                        .reload(); // Refresh the page after success alert
                                        });
                                    } else {
                                        swal("Error!", "Failed to delete profile photo.", "error");
                                    }
                                }).catch(error => {
                                    console.error('Error:', error);
                                    swal("Error!", "Something went wrong.", "error");
                                });
                        }
                    });
                });
            </script>


            {{-- Tags --}}
            <div class="name text-center">
                <h2 class="card-title text-center mb-3 p-4" style="color:#343434;"> {{ $user->fname }} {{ $user->lname }}
                </h2>
                <div class="pb-5">

                    <button type="button" class="btn btn-outline-success btn-rounded me-1" data-mdb-ripple-init><i
                            class="fas fa-message"></i> Inbox</button>

                </div>

            </div>




            {{--
        <div class="container text-center mt-2 pb-5">
            <button type="button" class="btn btn-danger btn-md"><i class="fas fa-exclamation-circle"
                    style="margin-right: 5px;"></i>Report this user</button>
            <button type="button" class="btn btn-warning btn-md"><i class="fas fa-pencil-alt"
                    style="margin-right: 5px;"></i>Write a review</button>
        </div> --}}


        </div>

        <div class="container mt-5 mb-5 " style="padding: 2rem;">

            <div class="row">
                <!-- Left Side Container -->
                <div class="col-md-4 mb-3">
                    <div class="custom-shadow p-4 d-flex flex-wrap justify-content-center">
                        <div class="text-muted small text-center align-self-center m-2">
                            <h2>427</h2>
                            <span class=" d-sm-inline-block">
                                <h5>Commendations</h5>
                            </span>
                        </div>
                        <div class="text-muted small text-center align-self-center m-2">
                            <h2> {{ $feedbackCount}} </h2>
                            <span class=" d-sm-inline-block">
                                <h5>Feedbacks</h5>
                            </span>
                        </div>
                    </div>
                </div>


                <div class="col-md-8 mb-3">
                    <div class="custom-shadow p-4">

                        <!-- Feedbacks -->
                        <div class="feedbacks">
                            <h2 style="color: #145DA0;">Feedbacks</h2>
                        </div>
                    </div>


                        {{-- Feedback --}}
                        <div class="container">
                            <div class="feedbacks mt-5">
                                <h2 style="color: #145DA0;">Feedbacks</h2>
                            </div>
                        </div>

                        <div class="container custom-shadow">
                            <div id="feedbackCarousel" class="carousel slide mt-5" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @if ($feedbacks->isEmpty())
                                        <div class="carousel-item active">
                                            <div class="container custom-shadow p-3">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="mb-1">No feedbacks available yet.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        @foreach ($feedbacks as $key => $feedback)
                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                <div class="container custom-shadow p-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <!-- Star Rating -->
                                                            <div class="mb-2">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <i class="fa fa-star{{ $i <= $feedback->rating ? '' : '-o' }}"
                                                                        style="color: #ffc107; font-size: 20px;"></i>
                                                                @endfor
                                                            </div>
                                                            <!-- Feedback Content -->
                                                            <p class="mb-1">{{ $feedback->feedback }}</p>
                                                            <!-- User and Timestamp -->
                                                            <p class="text-muted mb-0">-
                                                                {{ $feedback->user->name ?? 'Anonymous' }}</p>
                                                            <p class="text-muted small">Posted on:
                                                                {{ $feedback->created_at->format('F d, Y') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <!-- Carousel Controls -->
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#feedbackCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#feedbackCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <footer>
        @include('header_and_footer.footer')
    </footer>

    <!-- multiple upload of image -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>

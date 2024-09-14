<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Images</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
    <style>
        .image-box {
            width: 100%;
            padding-top: 75%;
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .image-box img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #preview-container img {
            max-width: 100px;
            max-height: 100px;
            margin: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .gallery-title {
            /* Set the background image */
            background-image: url("{{ asset('images/gallery.png') }}");
            /* Path to your background image */
            background-size: cover;
            /* Ensure the image covers the entire container */
            background-position: center;
            /* Center the image */

            color: white;
            /* Ensure text is readable */
            height: 350px;
            padding: 5% 2%;
            /* Adjust padding as needed */
            text-align: center;
            /* Center the text */
            position: relative;
            /* Ensure proper positioning of child elements */
            overflow: hidden;
            /* Hide overflow content if any */

        }

        .gallery-title h1,
        .gallery-title p {
            position: relative;
            /* Ensure proper stacking context for text */
        }

        .btn-primary {
            background: linear-gradient(135deg, #145DA0, #1a76cc) !important;
            border: 1px solid #145DA0 !important;
            color: white;
            /* Ensure text is readable on gradient */
        }

    </style>
</head>

<body>
    <header>
        @include('header_and_footer.header')
    </header>


    <div class="gallery-title p-5">
        <div class="text-center pt-5">
            @if (isset($event))
                <h1 class="mb-4">Images for {{ $event->EventName }}</h1>
            @else
                <p>Event not found.</p>
            @endif
        </div>
    </div>



    <div class="container mt-3 p-5 mb-5">
        <a href="{{ route('gallery') }}" class="btn btn-custom shadow">
            <i class="fas fa-arrow-left"></i> Back
        </a>

        <div class="d-flex justify-content-end mb-3">
            <!-- upload modal -->
            @if (Auth::check() && Auth::id() === $event->UserID)
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                    data-bs-target="#UploadImageModal">
                    <i class="fas fa-upload"></i> Upload Event Images
                </button>
            @endif
        </div>

        <!-- Upload Image Modal -->
        <div class="modal fade" id="UploadImageModal" tabindex="-1" aria-labelledby="UploadImageModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="UploadImageModalLabel">Upload Images</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('gallery.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="EventID" id="uploadEventId" value="{{ $event->EventID }}">
                            <div class="mb-3">
                                <label for="gallery" class="form-label">Click here to add Images:</label>
                                <input type="file" class="form-control" id="gallery" name="gallery[]"
                                    accept="image/*" multiple required>
                                <p class="text-muted">Accepted image formats: .jpeg, .jpg, .png, with a maximum size of
                                    2MB per image.</p>
                            </div>
                            <div id="preview-container" class="d-flex flex-wrap"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($images as $image)
                <div class="col-md-3 mb-4">
                <div class="image-container position-relative">
                    <a href="{{ asset('storage/' . $image->path) }}" data-fancybox="event-images"
                        data-caption="Image of {{ $event->EventName }}">
                        <div class="image-box">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="Event Image">
                        </div>
                    </a>
                    
                        @if(Auth::check() && Auth::id() === $event->UserID)
                            <form action="{{ route('gallery.delete', $image->idgallery) }}" method="POST" class="position-absolute top-0 end-0 p-2">
                                @csrf
                                @method('DELETE')

                                <button type="button" class="btn btn-danger position-absolute top-0 end-0 p-2 delete-image" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $image->idgallery }}">
                                    <i class="fas fa-trash-alt"></i></button>

                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Confirmation Modal for Deleting Event -->
        @foreach ($images as $image)
        <div class="modal fade" id="confirmDeleteModal{{ $image->idgallery }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel{{ $image->idgallery }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel{{ $image->idgallery }}">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">Are you sure you want to delete this image?</div>
                    <div class="modal-footer">
                        <form action="{{ route('gallery.delete', $image->idgallery) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
        @if (count($images) === 0)
            <div class="d-flex flex-column align-items-center justify-content-center text-center">
                <h4 class="mt-3">No Image Available</h4>
                <p>It looks like there are no images available at the moment.</p>
            </div>
        @endif
    </div>

    <!-- Sweet alert -->
    @if (Session::has('message'))
            @if (Session::get('type') === 'success')
                <script>
                    swal("Success", "{{ Session::get('message') }}", 'success', {
                        button: "OK",
                        timer: 3000,
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

    <footer>
        @include('header_and_footer.footer')
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-fancybox="event-images"]').fancybox();

            $('#gallery').on('change', function(event) {
                handleFiles(event);
            });

            // Form submission alert (for debugging)
            // $('form').on('submit', function(e) {
            //     alert("Are you sure you want to delete this image?");
            // });
        });

        function handleFiles(event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('preview-container');

            previewContainer.innerHTML = "";

            if (files.length > 15) {
                alert("You can only upload a maximum of 15 images.");
                event.target.value = "";
                return;
            }

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const fileReader = new FileReader();

                fileReader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = "100px";
                    img.style.height = "100px";
                    img.style.objectFit = "cover";
                    img.style.border = "1px solid #ccc";
                    img.style.margin = "5px";
                    img.style.boxSizing = "border-box";
                    previewContainer.appendChild(img);
                };

                fileReader.readAsDataURL(file);
            }
        }
    </script>
</body>

</html>
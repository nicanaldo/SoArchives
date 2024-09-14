<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Images</title>
    <link href="/bootstrap-5.3.3-dist/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-...your-integrity-hash..." crossorigin="anonymous"></script>
    @vite(['resources/js/app.js'])
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
    </style>
</head>
<body>
    <header>
        @include('header_and_footer.header')
    </header>

    <div class="container mt-3" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <a href="{{ route('galleryBuyer') }}" class="btn btn-custom shadow">
            <i class="fas fa-arrow-left"></i> Back
        </a>

        <div class="text-center">
            @if(isset($event))
                <h1 class="mb-4">Images for {{ $event->EventName }}</h1>
            @else
                <p>Event not found.</p>
            @endif
        </div>

        <div class="d-flex justify-content-end mb-3">
            <!-- upload modal -->
            @if (Auth::check() && Auth::id() === $event->UserID)
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#UploadImageModal">
                    <i class="fas fa-upload"></i> Upload Event Images
                </button>
            @endif
        </div>

        <div class="row">
            @foreach($images as $image)
                <div class="col-md-4 mb-4">
                    <a href="{{ asset('storage/' . $image->path) }}" data-fancybox="event-images" data-title="Image of {{ $event->EventName }}">
                        <div class="image-box">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="Event Image">
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        
        @if(count($images) === 0)
            <div class="d-flex flex-column align-items-center justify-content-center text-center">
                <img src="{{ asset('images/No_Images.png') }}" style="width: 400px;" class="mb-3">
                <h4 class="mt-3">No Image Available</h4>
                <p>It looks like there are no images available at the moment.</p>
            </div>
        @endif
    </div>

    <!-- Upload Image Modal -->
    <div class="modal fade" id="UploadImageModal" tabindex="-1" aria-labelledby="UploadImageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="UploadImageModalLabel">Upload Images</h1>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('gallery.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="EventID" id="uploadEventId" value="{{ $event->EventID }}">
                        <div class="mb-3">
                            <label for="gallery" class="form-label">Click here to add Images:</label>
                            <input type="file" class="form-control" id="gallery" name="gallery[]" accept="image/*" multiple required onchange="handleFiles(event)">
                            <p class="text-muted">Accepted image formats: .jpeg, .jpg, .png, with a maximum size of 2MB per image.</p>
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

    <footer>
        @include('header_and_footer.footer')
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script>
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

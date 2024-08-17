
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
    @vite(['resources/js/app.js'])
    
</head>
<body>
    <header>
        @include('header_and_footer.header')
    </header>

    <div class="container mt-3">
        <a href="{{ route('gallery') }}" class="btn shadow" style="background-color: #fff;">
            <i class="fas fa-arrow-left"></i> Back
        </a>

        @if(isset($event))
            <h1 class="mb-4">Images for {{ $event->EventName }}</h1>
        @else
            <p>Event not found.</p>
        @endif

        @if(isset($images) && $images->isNotEmpty())
            <div class="row">
                @foreach($images as $image)
                    <div class="col-md-4 mb-4">
                        <img src="{{ asset('storage/' . $image->path) }}" class="img-fluid rounded mb-3" alt="Event Image">
                    </div>
                @endforeach
            </div>
        @else
            <p>No images available for this event.</p>
        @endif
    </div>

    

    <footer>
        @include('header_and_footer.footer')
    </footer>
</body>
</html>

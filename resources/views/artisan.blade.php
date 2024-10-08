<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artisans</title>

    {{-- Tab Logo --}}
    <link rel="shortcut icon" href="{{ asset('images/tab-logo.ico') }}" type="image/x-icon">

    {{-- Animate CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- CSS file under Public Folder --}}
    <link rel="stylesheet" href="{{ asset('css/artisan.css') }}" />

    {{-- To make the toggle in the navbar work --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>

</head>


<body>

    <!-- Navbar -->

    <div class="container-fluid">
        <header>
            @include('header_and_footer.header')
        </header>
    </div>


    <!-- Banner -->
    <div class="banner" style="background-image: url('images/artis.png'); height:400px">

        <div class="container">

            <h1 style="color: #FEFEFE; font-weight: 500;">Artisans are crafting wonders for
                you!
            </h1>

            <div class="search-container container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        {{-- sa action gumana --}}
                        <form class="d-flex mb-3" method="post" action="/artisan">
                            @csrf
                            <input class="form-control me-1 search-input" type="search" name="search"
                                placeholder="Search for artisans..." aria-label="Search"
                                value="{{ isset($search) ? $search : '' }}">


                            <!-- Categories -->
                            <div class="dropdown ms-1 z-1">
                                <a class="btn btn-warning dropdown-toggle" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Categories
                                </a>

                                <ul class="dropdown-menu">
                                    @foreach ($tags as $tag)
                                        <li>
                                            <a class="dropdown-item {{ $selectedTags == $tag->name ? 'active' : '' }}"
                                                href="{{ route('artisan', ['tag' => $selectedTags == $tag->name ? null : $tag->name]) }}">
                                                {{ $tag->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>


                        </form>
                    </div>
                </div>
            </div>

        </div>



    <div class="container artisan-con p-4 custom-shadow mb-5  animate__animated animate__slideInUp ">

        {{-- Artisan Card --}}
        <div class="row justify-content-left ">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Check if profiles are empty and display a message if true -->
            @if (isset($search) && $profiles->isEmpty())
                <div class="text-center w-100 pb-2">
                    <h2> No artisans found matching your search criteria.</h2>
                </div>
            @else
                <div class="row">
                    @foreach ($profiles as $seller)
                        <div class="col-lg-3 col-md-6 mb-4">
                            <a href="{{ route('seller.profile', ['slug' => $seller->slug]) }}" class="card-link"
                                style="text-decoration: none;">
                                <div class="card">
                                    <!-- Cover photo -->
                                    <img src="{{ asset($seller->cover_photo ? 'storage/cover_photos/' . $seller->id . '/' . basename($seller->cover_photo) : 'images/finalcover.png') }}"
                                        class="card-img-top" style="height:200px; object-fit: cover;" alt="Cover Photo">

                                    <!-- Profile pic -->
                                    <div class="container d-flex justify-content-center align-items-center">
                                        <div class="img__container">
                                            <img src="{{ asset($seller->profile_photo ? 'storage/profile_photos/' . $seller->id . '/' . basename($seller->profile_photo) : 'images/defuser.png') }}"
                                                alt="Profile Picture" class="border-white thick-border" />
                                            <span class="badge pro-badge fs-10 text-center"><i class="fas fa-star"></i>
                                                PRO</span>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title text-center fw-bold"
                                            style="color: #343434; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                            {{ $seller->fname }} {{ $seller->lname }}
                                        </h5>

                                        <!-- Display tags associated with the seller -->
                                        <p class="card-text text-muted text-center"
                                            style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                            @if (isset($sellersWithTags[$seller->id]))
                                                @foreach ($sellersWithTags[$seller->id] as $tag)
                                                    <a href="#" class="btn bg-flairs btn-lg disabled"
                                                        style="font-size: small;" role="button"
                                                        aria-disabled="true">{{ $tag }}</a>
                                                @endforeach
                                            @endif
                                        </p>
                                    </div>

                                </div>
                            </a>

                            <!-- Input field for user_id -->
                            <input type="hidden" name="user_id"
                                value="{{ auth()->check() ? auth()->user()->UserID : '' }}">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>


        {{-- UI: Pagination --}}
        <nav aria-label="Page navigation" class="mt-3">
            <ul class="pagination justify-content-end">
                <!-- Previous Page Link -->
                @if ($profiles->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $profiles->previousPageUrl() }}">Previous</a>
                    </li>
                @endif

                <!-- Page Number Links -->
                @foreach ($profiles->links()->elements[0] as $page => $url)
                    @if ($page == $profiles->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

                <!-- Next Page Link -->
                @if ($profiles->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $profiles->nextPageUrl() }}">Next</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">Next</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>





    <footer>
        @include('header_and_footer.footer')
    </footer>



    <!-- Categories JS Toggle -->
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>


</html>

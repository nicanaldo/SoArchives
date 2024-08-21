<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>

    {{-- Tab Logo --}}
    <link rel="shortcut icon" href="{{ asset('images/tab-logo.ico') }}" type="image/x-icon">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

    {{-- CSS file under Public Folder --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    {{-- Sweet Alert --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</head>




<div class="container-fluid custom-shadow">

    @include('header_and_footer.header')

    <div class="container-fluid custom-shadow-profile">
        <div class="container cover">
            <div class="header__wrapper d-flex justify-content-center">
                <img src="{{ asset('images/finalcover.png') }}" alt="..." />
            </div>
        </div>


        {{-- Profile Picture --}}
        <div class="container d-flex justify-content-center align-items-center">
            <div class="img__container">
                <img src="{{ asset('images/defuser.png') }}" alt="..." class="border-white thick-border" />
                <span></span>
            </div>
        </div>


        {{-- Tags --}}
        <div class="name text-center">
            <h2 class="card-title text-center mb-3 p-4" style="color:#343434;">{{ $user->fname }}
                {{ $user->lname }} </h2>
            <div class="pb-5">
                <button type="button" class="btn btn-lg btn-primary btn-rounded border-0 me-1"
                    style="background: linear-gradient(45deg, #6a11cb, #2575fc);" data-mdb-ripple-init><i
                        class="fas fa-hand-sparkles"></i> Commend</button>
                <button type="button" class="btn btn-lg btn-outline-success btn-rounded me-1" data-mdb-ripple-init><i
                        class="fas fa-message"></i> Message</button>
                {{-- <button type="button" class="btn btn-warning btn-rounded text-white me-2" data-mdb-ripple-init><i
                        class="fas fa-star"></i> </button> --}}
                <button type="button" class="btn btn-lg btn-danger btn-rounded me-1" data-mdb-ripple-init><i
                        class="fas fa-exclamation-circle"></i> </button>


            </div>

        </div>

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
                        <h2>24</h2>
                        <span class=" d-sm-inline-block">
                            <h5>Feedbacks</h5>
                        </span>
                    </div>
                    <!-- Content for the left side -->
                    <div class="col-12 text-center d-flex justify-content-center p-3">

                    </div>

                    <div class="d-flex flex-wrap justify-content-center">
                        <button type="button" class="btn btn-sm btn-primary mb-2 me-2" disabled>Handmade
                            Jewelry</button>
                        <button type="button" class="btn btn-sm btn-primary mb-2 me-2" disabled>Mixed Media
                            Art</button>
                        <button type="button" class="btn btn-sm btn-primary mb-2 me-2" disabled>Yarn
                            Crafts</button>
                    </div>
                </div>
            </div>

            <div class="col-md-8 mb-3">
                <div class="custom-shadow p-4">


                    <ul class="nav nav-pills user-profile-tab justify-content-start mt-2 bg-light-info rounded-2"
                        id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button
                                class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                                id="pills-products-tab" data-bs-toggle="pill" data-bs-target="#pills-products"
                                type="button" role="tab" aria-controls="pills-products" aria-selected="true">
                                <i class="fa fa-image me-2 fs-6"></i>
                                <span class="d-none d-md-block">Products</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button
                                class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                                id="pills-events-tab" data-bs-toggle="pill" data-bs-target="#pills-events"
                                type="button" role="tab" aria-controls="pills-events" aria-selected="false"
                                tabindex="-1">
                                <i class="fa fa-calendar me-2 fs-6"></i>
                                <span class="d-none d-md-block">Events</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button
                                class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                                id="pills-archives-tab" data-bs-toggle="pill" data-bs-target="#pills-archives"
                                type="button" role="tab" aria-controls="pills-archives" aria-selected="false"
                                tabindex="-1">
                                <i class="fa fa-box me-2 fs-6"></i>
                                <span class="d-none d-md-block">Archives</span>
                            </button>
                        </li>
                    </ul>



                    {{-- Products --}}

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-products" role="tabpanel"
                            aria-labelledby="pills-products-tab" tabindex="0">

                            <div class="row">
                                <div class="col-md-6 mt-5">
                                    {{-- <button type="button" class="btn btn-warning btn-add-buttons" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Add new product</button> --}}
                                    {{-- <button type="button" class="btn btn-primary btn-add-buttons" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Create an event</button> --}}
                                </div>

                                {{-- Search bar --}}
                                <div class="col-md-6 mt-5">
                                    <form method="post" action="{{ route('products-search') }}">
                                        <div class="input-group rounded-pill overflow-hidden">
                                            @csrf
                                            <input type="search" name="search" class="form-control border-0"
                                                placeholder="Search crafts or products" aria-label="Search"
                                                value="{{ isset($search) ? $search : '' }}">
                                            <button class="btn border-0 bg-white" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <!-- Product Cards -->
                            <div class="row justify-content-left" style="margin-top: 3rem;">
                                @foreach ($products as $product)
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                        <div class="card" data-bs-toggle="modal"
                                            data-bs-target="#productModal{{ $product->ProductID }}">
                                            <div id="carouselProduct{{ $product->ProductID }}" class="carousel slide"
                                                data-bs-ride="false">
                                                <div class="carousel-inner">
                                                    @foreach (explode(',', $product->ProductImage) as $image)
                                                        <div
                                                            class="carousel-item @if ($loop->first) active @endif">
                                                            <img src="{{ asset('storage/products/' . $user->id . '/' . basename($image)) }}"
                                                                class="d-block w-100 card-img-top"
                                                                alt="Product Image">
                                                        </div>

                                                        {{-- <button
                                            class="carousel-control-prev @if (count(explode(',', $product->ProductImage)) <= 1) d-none @endif"
                                            type="button" data-bs-target="#carouselProduct{{ $product->ProductID }}"
                                            data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button
                                            class="carousel-control-next @if (count(explode(',', $product->ProductImage)) <= 1) d-none @endif"
                                            type="button" data-bs-target="#carouselProduct{{ $product->ProductID }}"
                                            data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button> --}}
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title"
                                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-transform: capitalize;">
                                                    {{ $product->ProductName }}</h5>
                                                <p class="card-text text-muted"
                                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                    {{ $product->ProductDescription }}</p>
                                                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal{{ $product->ProductID }}">View Details</button> --}}
                                                <p class="card-text text-muted">₱ {{ $product->Price }}</p>
                                                <div class="text-muted small text-end align-self-end">
                                                    <span class="d-none d-sm-inline-block"><i class="far fa-eye"></i>
                                                        18</span>
                                                    <span><i class="far fa-heart ml-2"></i> 7</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>



                                    {{-- View Details Modal --}}
                                    <div class="modal fade" id="productModal{{ $product->ProductID }}"
                                        tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <p class="card-text text-muted mb-0 d-flex align-items-center">
                                                        <img src="{{ asset('images/janica.png') }}" alt="User Image"
                                                            class="user-image ms-2 me-2">
                                                        {{ $user->fname }} {{ $user->lname }}
                                                    </p>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <!-- Left column -->
                                                        <div class="col-md-6">
                                                            <div id="carouselProductModal{{ $product->ProductID }}"
                                                                class="carousel slide" data-bs-interval="false">
                                                                <div class="carousel-inner">
                                                                    @foreach (explode(',', $product->ProductImage) as $image)
                                                                        <div
                                                                            class="carousel-item @if ($loop->first) active @endif">
                                                                            <div class="zoom-container">
                                                                                <img src="{{ asset('storage/products/' . $user->id . '/' . basename($image)) }}"
                                                                                    class="d-block w-100 card-img-top"
                                                                                    alt="Product Image"
                                                                                    style="height: 400px;">
                                                                            </div>

                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                {{-- <button
                                                    class="carousel-control-prev @if (count(explode(',', $product->ProductImage)) <= 1) d-none @endif"
                                                    type="button"
                                                    data-bs-target="#carouselProductModal{{ $product->ProductID }}"
                                                    data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon"
                                                        aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button
                                                    class="carousel-control-next @if (count(explode(',', $product->ProductImage)) <= 1) d-none @endif"
                                                    type="button"
                                                    data-bs-target="#carouselProductModal{{ $product->ProductID }}"
                                                    data-bs-slide="next">
                                                    <span class="carousel-control-next-icon"
                                                        aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button> --}}
                                                            </div>

                                                            <!-- Thumbnails -->
                                                            <div class="mt-3">
                                                                <div class="row">
                                                                    @foreach (explode(',', $product->ProductImage) as $index => $image)
                                                                        <div class="col-3">
                                                                            <img src="{{ asset('storage/products/' . $user->id . '/' . basename($image)) }}"
                                                                                class="img-thumbnaill"
                                                                                alt="Product Thumbnail"
                                                                                data-bs-target="#carouselProductModal{{ $product->ProductID }}"
                                                                                data-bs-slide-to="{{ $index }}"
                                                                                onclick="selectThumbnail(this)">
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>

                                                            <script>
                                                                function selectThumbnail(element) {
                                                                    // Remove 'selected' class from all thumbnails
                                                                    document.querySelectorAll('.img-thumbnaill').forEach(img => img.classList.remove('selected'));

                                                                    // Add 'selected' class to the clicked thumbnail
                                                                    element.classList.add('selected');
                                                                }
                                                            </script>


                                                        </div>
                                                        <!-- Right column -->
                                                        <div class="col-md-6">
                                                            <h2 class="modal-title fs-5 mb-3 fw-bold"
                                                                id="productModalLabel"
                                                                style="text-transform: capitalize;">
                                                                {{ $product->ProductName }}</h2>
                                                            <p class="card-text text-muted">
                                                                {{ $product->ProductDescription }}</p>
                                                            <p class="card-text text-muted">Price: ₱
                                                                {{ $product->Price }}</p>
                                                            <p class="card-text text-muted">Quantity:
                                                                {{ $product->Quantity }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer d-flex justify-content-end align-items-end">
                                                    <button type="button"
                                                        class="btn btn-lg btn-outline-danger border-0 heart-button">
                                                        <i class="fas fa-heart"></i> 18
                                                    </button>
                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                    {{-- Zooming of image when hovered --}}
                                    <script>
                                        document.querySelectorAll('.zoom-container').forEach(container => {
                                            const img = container.querySelector('img');

                                            container.addEventListener('mousemove', e => {
                                                const rect = container.getBoundingClientRect();
                                                const x = e.clientX - rect.left;
                                                const y = e.clientY - rect.top;

                                                img.style.transformOrigin =
                                                    `${(x / container.offsetWidth) * 100}% ${(y / container.offsetHeight) * 100}%`;
                                            });

                                            container.addEventListener('mouseleave', () => {
                                                img.style.transformOrigin = 'center center'; // Reset zoom origin when not hovering
                                            });
                                        });
                                    </script>
                                @endforeach
                            </div>

                            {{-- Pagination --}}
                            <nav aria-label="..." class="mt-3">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1"
                                            aria-disabled="true">Previous</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item" aria-current="page">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    {{-- Events --}}
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show" id="pills-events" role="tabpanel"
                            aria-labelledby="pills-events-tab" tabindex="0">

                            <div class="row">
                                <div class="col-md-6 mt-5">
                                    <button type="button" class="btn btn-warning btn-add-buttons"
                                        data-bs-toggle="modal" data-bs-target="#">Create an event</button>
                                    {{-- <button type="button" class="btn btn-primary btn-add-buttons" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Create an event</button> --}}
                                </div>

                                {{-- Search bar --}}
                                <div class="col-md-6 mt-5">
                                    <form method="post" action="{{ route('products-search') }}">
                                        <div class="input-group rounded-pill overflow-hidden">
                                            @csrf
                                            <input type="search" name="search" class="form-control border-0"
                                                placeholder="Search crafts or products" aria-label="Search"
                                                value="{{ isset($search) ? $search : '' }}">
                                            <button class="btn border-0 bg-white" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- Archives --}}
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show" id="pills-archives" role="tabpanel"
                            aria-labelledby="pills-archives-tab" tabindex="0">

                            <h1>Archives</h1>

                        </div>
                    </div>
                </div>



                <div class="container custom-shadow mt-5">

                    {{-- <h1 class="text-start pt-3">My Events</h1> --}}
                    {{-- padisplay dito yung mga created events ng user na to --}}

                </div>








                <div class="container">
                    <div class="feedbacks mt-5">
                        <h2 style="color: #145DA0;">Feedbacks</h2>
                    </div>
                </div>

                <div class="container custom-shadow mt-5 p-3">
                    <div class="row">
                        <div class="col-12">
                            <br>
                            <p>I appreciate the creativity and originality you bring to your projects. Your unique style
                                sets your
                                work apart and makes it memorable.</p>
                            <p class="text-muted">- Jane Dela Guzman </p>
                        </div>
                    </div>
                </div>

                <div class="container custom-shadow mt-5 p-3 mb-5">
                    <div class="row">
                        <div class="col-12">
                            <br>
                            <p>I'm impressed by the high quality of craftsmanship evident in your creations. The
                                materials you used
                                are top-notch, and the finished product exceeded my expectations.</p>
                            <p class="text-muted">- Juan Dela Cruz </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    {{-- UI: Back to top button --}}
    <button type="button" class="btn btn-primary btn-floating btn-lg" id="btn-back-to-top">
        <i class="fas fa-arrow-up"></i>
    </button>



    {{-- JS: Back to top button --}}
    <script>
        //Get the button
        let mybutton = document.getElementById("btn-back-to-top");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            if (
                document.body.scrollTop > 20 ||
                document.documentElement.scrollTop > 20
            ) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }
        // When the user clicks on the button, scroll to the top of the document
        mybutton.addEventListener("click", backToTop);

        function backToTop() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>


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

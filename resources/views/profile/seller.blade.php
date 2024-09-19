<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $user->fname }} {{ $user->lname }} </title>

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

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X4ubT2s5C/yyce6ytH4K6zPYUO4+3i7mGGjN5F/X+R47S6p13Xrx5Hh4Z7+" crossorigin="anonymous">

    <!-- MDB CSS -->
    <link href="https://cdn.jsdelivr.net/npm/mdbootstrap@5.0.0/dist/css/mdb.min.css" rel="stylesheet">

    <!-- FontAwesome CSS (for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>

    <div class="container-fluid custom-shadow">

        @include('header_and_footer.header')

        <div class="container-fluid custom-shadow-profile">
            <div class="container cover">
                <div class="header__wrapper d-flex justify-content-center">
                    <img src="{{ asset($user->cover_photo ? 'storage/cover_photos/' . $user->id . '/' . basename($user->cover_photo) : 'images/finalcover.png') }}"
                        alt="..." />
                </div>
            </div>


            {{-- Profile Picture --}}
            <div class="container d-flex justify-content-center align-items-center">
                <div class="img__container">
                    <img src="{{ asset($user->profile_photo ? 'storage/profile_photos/' . $user->id . '/' . basename($user->profile_photo) : 'images/defuser.png') }}"
                        alt="Profile Picture" class="border-white thick-border-pro" />
                    <span></span>
                </div>
            </div>


            {{-- Tags --}}
            <div class="name text-center">
                <h2 class="card-title text-center d-inline-block mb-3" style="color:#343434;">
                    {{ $user->fname }} {{ $user->lname }}
                    <span class="badge pro-badge ms-2 fs-6 align-middle">
                        <i class="fas fa-star"></i> PRO
                    </span>

                    {{-- VIP
                    <span class="badge vip-badge ms-2 fs-6 align-middle">
                        <i class="fas fa-crown"></i> VIP
                    </span> --}}
                </h2>
                <div class="pb-5">
                    <button type="button" class="btn btn-primary btn-rounded border-0 me-1"
                        style="background: linear-gradient(45deg, #6a11cb, #2575fc);" data-mdb-ripple-init><i
                            class="fas fa-hand-sparkles"></i> Commend</button>
                            <a href="{{ route('chatify') }}" class="btn btn-outline-dark btn-rounded me-1" data-mdb-ripple-init>
                                <i class="fas fa-message"></i> Message
                            </a>

                    {{-- <button type="button" class="btn btn-warning btn-rounded text-white me-2" data-mdb-ripple-init><i
                        class="fas fa-star"></i> </button> --}}
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger btn-rounded me-1" data-bs-toggle="modal"
                        data-bs-target="#reportModal">
                        <i class="fas fa-exclamation-circle"></i>
                    </button>

                    <!-- Report Modal -->
                    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="reportModalLabel">Report User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>


                                <div class="modal-body">
                                    <form id="reportForm" novalidate>
                                        <div class="mb-3">
                                            <h6 class="text-start">Reason for reporting</h6>
                                            <select class="form-select" id="reportReason" required>
                                                <option value="" disabled selected>Select a reason</option>
                                                <option value="spam">Spam or Fake Content</option>
                                                <option value="harassment">Harassment or Abusive Behavior</option>
                                                <option value="hate-speech">Hate Speech or Discrimination</option>
                                                <option value="misinformation">Misinformation or Fake News</option>
                                                <option value="violence">Violence or Threats</option>
                                            </select>
                                            <div class="invalid-feedback text-start">
                                                Please select a reason for reporting
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <h6 class="text-start">Additional details (optional)</h6>
                                            <textarea class="form-control" id="reportDetails" rows="2"></textarea>
                                        </div>

                                        <div class="col-12">
                                            <div class="alert alert-secondary alert-dismissible fade show"
                                                role="alert">
                                                <h5 class="alert-heading text-start">
                                                    &#x1F6A8; Report Reminder
                                                </h5>
                                                <p class="text-start">
                                                    Please provide a valid reason when reporting a user. Ensure you are
                                                    not
                                                    making false claims or reporting out of spite. Use the report
                                                    function
                                                    responsibly to help us maintain a respectful community.
                                                </p>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>


                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-secondary me-2"
                                                id="discardButton">Discard</button>
                                            <button type="submit" class="btn btn-danger">Submit Report</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Bootstrap JS -->
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
                        integrity="sha384-oBqDVmMz4fnFO9yp0TO/kx1EBc0g2L0z9e6D36kkA1OwhwB25NO3d2MCm8fLEd2F" crossorigin="anonymous">
                    </script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
                        integrity="sha384-pprnP5s9N9tB9P8t1gV4Rtb/x5V2x5OoF2QW+Lnw+Ob+RfU1lFqU1Kqln5KH+cU2" crossorigin="anonymous">
                    </script>
                    <!-- MDB JS -->
                    <script src="https://cdn.jsdelivr.net/npm/mdbootstrap@5.0.0/dist/js/mdb.min.js"></script>

                </div>

            </div>

        </div>


        <div class="container mt-1 mb-5 " style="padding: 2rem;">

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

                    <div class="container mt-3 custom shadow p-3">
                        <h4 class="p-2"> &#128204 Upcoming Events</h4>

                        @php
                            // Filter the events before the loop to include only Approved and OnGoing events and exclude events where the date has passed
                            $filteredEvents = $events->filter(function ($event) {
                                return in_array($event->Status, ['Approved', 'OnGoing']) &&
                                    \Carbon\Carbon::parse($event->Date)->isFuture();
                            });
                        @endphp

                        @if ($filteredEvents->isEmpty())
                            @if (!empty($search))
                                <h1 class="text-center text-muted">No search results found</h1>
                            @else
                                <h1 class="text-center text-muted">No events yet</h1>
                            @endif
                        @else
                            <!-- Display Events Based on Status -->
                            @foreach ($filteredEvents as $event)
                                @if ($event->Status == 'Approved' || $event->Status == 'Ongoing')
                                    <div class="col-12 mb-3">
                                        <div class="event-side">
                                            <div class="card-body d-flex align-items-center">
                                                <!-- Calendar-like Date Display -->
                                                <div
                                                    class="date-card d-flex flex-column align-items-center justify-content-center me-4">
                                                    <div class="day" style="font-size: 2rem; font-weight: bold;">
                                                        {{ \Carbon\Carbon::parse($event->Date)->format('j') }}
                                                    </div>
                                                    <div class="date-month text-muted me-5 ms-5">
                                                        {{ \Carbon\Carbon::parse($event->Date)->format('M Y') }}
                                                    </div>
                                                </div>

                                                <!-- Event Details -->
                                                <div>
                                                    <h5 class="card-title m-0">{{ $event->EventName }}</h5>
                                                    <p class="card-text text-muted m-0 truncate-description">
                                                        {{ $event->EventDescription }}</p>
                                                    <p class="modal-text m-0"><i class="far fa-clock"></i>
                                                        {{ \Carbon\Carbon::parse($event->StartTime)->format('g:i A') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($event->EndTime)->format('g:i A') }}
                                                    </p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p class="card-text"><i
                                                                class="fas fa-map-marker-alt text-primary"></i>
                                                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($event->Location) }}"
                                                                class="location-icon" target="_blank">
                                                                {{ $event->Location }}
                                                            </a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
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
                                    type="button" role="tab" aria-controls="pills-products"
                                    aria-selected="true">
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
                        </ul>


                        {{-- Products --}}

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-products" role="tabpanel"
                                aria-labelledby="pills-products-tab" tabindex="0">

                                <div class="row">
                                    <div class="col-md-6 mt-5">
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
                                    @foreach ($activeProducts->reverse() as $product)
                                        @php
                                            // Assuming 'created_at' is the date the product was uploaded
                                            $isNew = \Carbon\Carbon::parse($product->created_at)->greaterThanOrEqualTo(
                                                \Carbon\Carbon::now()->subDay(),
                                            );
                                        @endphp
                                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                            <!-- ADD CODES FOR VIEWS -->
                                            <div class="card" data-bs-toggle="modal" data-bs-target="#productModal{{ $product->ProductID }}" onclick="incrementViews('{{ $product->ProductID }}')">
                                            <!--END....  ADD CODES FOR VIEWS -->
                                                <div id="carouselProduct{{ $product->ProductID }}"
                                                    class="carousel slide" data-bs-ride="false">
                                                    <div class="carousel-inner">
                                                        @foreach (explode(',', $product->ProductImage) as $file)
                                                            <div
                                                                class="carousel-item @if ($loop->first) active @endif">
                                                                @if (Str::endsWith($file, ['.jpg', '.jpeg', '.png', '.gif']))
                                                                    <img src="{{ asset('storage/products/' . $user->id . '/' . basename($file)) }}"
                                                                        class="d-block w-100 card-img-top"
                                                                        alt="Product Image">
                                                                @elseif (Str::endsWith($file, ['.mp4', '.webm', '.ogg']))
                                                                    <video
                                                                        src="{{ asset('storage/products/' . $user->id . '/' . basename($file)) }}"
                                                                        class="d-block w-100 card-img-top" controls
                                                                        autoplay muted loop></video>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="card-body d-flex flex-column">
                                                    <h5 class="card-title"
                                                        style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-transform: capitalize;">
                                                        @if ($isNew)
                                                            <span class="badge badge-gradient me-1">NEW!</span>
                                                        @endif

                                                        {{ $product->ProductName }}
                                                    </h5>

                                                    <p class="card-text text-muted "
                                                        style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                        {{ $product->ProductDescription }}
                                                    </p>

                                                    <!-- Pricing section -->
                                                    <div class="d-flex align-items-center mb-auto">
                                                        <!-- Price Drop Badge -->
                                                        <div class="badge-placeholder">
                                                            @if ($product->Price < $product->old_price)
                                                                <span class="badge price-drop-badge me-2">Price
                                                                    Drop!</span>
                                                            @endif
                                                        </div>

                                                        <!-- Old Price and Current Price -->
                                                        @if ($product->old_price && $product->old_price != $product->Price)
                                                            <span
                                                                style="text-decoration: line-through; color: red; margin-right: 0.5em;">
                                                                ₱ {{ $product->old_price }}
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <!-- Pricing section -->
                                                    <p class="card-text text-muted">


                                                        Price:
                                                        <span>₱ {{ $product->Price }}</span>
                                                    </p>

                                                    <!-- Like Count -->
                                                    <div class="text-muted small text-end mt-auto">
                                                        <!-- ADD CODES FOR VIEWS -->
                                                        <span class="d-none d-sm-inline-block"><i class="far fa-eye"></i> {{ $product->views }}</span>
                                                        <!-- END... ADD CODES FOR VIEWS -->
                                                        <span class="btn btn-light disabled like-count"><i
                                                                class="fas fa-heart ml-2" style="color: red;"></i>
                                                            {{ $product->likes()->count() }} </span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- ADD CODES FOR VIEWS -->
                                        <script>
                                            function incrementViews(productId) {
                                                fetch(`/products/${productId}/increment-views`, {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/json',
                                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                    },
                                                }).then(response => {
                                                    if (response.ok) {
                                                        console.log('Views incremented successfully');
                                                    }
                                                }).catch(error => {
                                                    console.error('Error incrementing views:', error);
                                                });
                                            }
                                        </script>
                                        <!-- END... ADD CODES FOR VIEWS -->

                                        {{-- View Details Modal --}}
                                        <div class="modal fade" id="productModal{{ $product->ProductID }}"
                                            tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <!-- User Info and Image -->
                                                        <p class="card-text text-muted mb-0 d-flex align-items-center responsive-text">
                                                            <img src="{{ asset($user->profile_photo ? 'storage/profile_photos/' . $user->id . '/' . basename($user->profile_photo) : 'images/defuser.png') }}"
                                                                alt="User Image" class="user-image ms-1 me-2">
                                                            <span class="user-name">{{ $user->fname }} {{ $user->lname }} •</span>
                                                        </p>

                                                        <!-- Post Date Info -->
                                                        <p class="card-text text-muted mb-0 d-flex align-items-center ms-2 responsive-text">
                                                            @if ($product->created_at->diffInHours() < 24)
                                                                <span>Posted {{ $product->created_at->diffForHumans() }}</span>
                                                            @else
                                                                <span>Posted on {{ $product->created_at->format('g:iA • m/d/Y') }}</span>
                                                            @endif
                                                        </p>

                                                        <!-- Close Button -->
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <!-- Left column -->
                                                            <div class="col-md-6">
                                                                <div id="carouselProductModal{{ $product->ProductID }}"
                                                                    class="carousel slide" data-bs-interval="false">
                                                                    <div class="carousel-inner">
                                                                        @foreach (explode(',', $product->ProductImage) as $media)
                                                                            <div
                                                                                class="carousel-item @if ($loop->first) active @endif">
                                                                                <div class="zoom-container">
                                                                                    @if (Str::endsWith($media, ['.jpg', '.jpeg', '.png', '.gif']))
                                                                                        <img src="{{ asset('storage/products/' . $user->id . '/' . basename($media)) }}"
                                                                                            class="d-block w-100 card-img-top"
                                                                                            alt="Product Image"
                                                                                            style="height: 400px;">
                                                                                    @elseif(Str::endsWith($media, ['.mp4', '.webm', '.ogg']))
                                                                                        <video
                                                                                            src="{{ asset('storage/products/' . $user->id . '/' . basename($media)) }}"
                                                                                            class="d-block w-100 card-img-top"
                                                                                            style="height: 400px;"
                                                                                            controls autoplay muted
                                                                                            loop></video>
                                                                                    @else
                                                                                        <p class="text-muted">
                                                                                            Unsupported media format
                                                                                        </p>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>

                                                                <!-- Thumbnails -->
                                                                <div class="mt-3">
                                                                    <div class="row">
                                                                        @foreach (explode(',', $product->ProductImage) as $index => $media)
                                                                            <div class="col-3">
                                                                                @if (Str::endsWith($media, ['.jpg', '.jpeg', '.png', '.gif']))
                                                                                    <img src="{{ asset('storage/products/' . $user->id . '/' . basename($media)) }}"
                                                                                        class="img-thumbnail img-thumbnaill"
                                                                                        alt="Product Thumbnail"
                                                                                        data-bs-target="#carouselProductModal{{ $product->ProductID }}"
                                                                                        data-bs-slide-to="{{ $index }}"
                                                                                        onclick="selectThumbnail(this)">
                                                                                @elseif(Str::endsWith($media, ['.mp4', '.webm', '.ogg']))
                                                                                    <div class="video-thumbnail img-thumbnaill"
                                                                                        data-bs-target="#carouselProductModal{{ $product->ProductID }}"
                                                                                        data-bs-slide-to="{{ $index }}"
                                                                                        onclick="selectThumbnail(this)">
                                                                                        {{-- Image with default fallback --}}
                                                                                        <img src="{{ asset('storage/products/' . $user->id . '/' . basename($media)) }}"
                                                                                            onerror="this.onerror=null;this.src='{{ asset('images/video-def.png') }}';"
                                                                                            class="video-thumbnail-img"
                                                                                            alt="Media">
                                                                                    </div>
                                                                                @else
                                                                                    <p class="text-muted">
                                                                                        Unsupported media format</p>
                                                                                @endif
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
                                                                <p class="card-text text-muted ">
                                                                    {{ $product->ProductDescription }}</p>
                                                                <p class="card-text text-muted">
                                                                    Price:
                                                                    @if ($product->old_price && $product->old_price != $product->Price)
                                                                        <span
                                                                            style="text-decoration: line-through; color: {{ $product->Price > $product->old_price ? 'green' : 'red' }};">
                                                                            ₱ {{ $product->old_price }}
                                                                        </span>
                                                                    @endif
                                                                    <span>
                                                                        ₱ {{ $product->Price }}
                                                                    </span>
                                                                </p>
                                                                <p class="card-text text-muted">Quantity:
                                                                    {{ $product->Quantity }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="modal-footer d-flex justify-content-between align-items-end">
                                                        <p
                                                            class="card-text text-muted mb-0 d-flex align-items-start ms-2 mb-2">
                                                            @if ($product->updated_at->diffInHours() < 24)
                                                                Updated {{ $product->updated_at->diffForHumans() }}
                                                            @else
                                                                Updated on
                                                                {{ $product->updated_at->format('g:iA m/d/Y') }}
                                                            @endif
                                                        </p>
                                                        <div class="text-muted small text-end align-self-end">
                                                            <!-- <span class="d-none d-sm-inline-block"><i class="far fa-eye"></i> 18</span> -->
                                                            <form
                                                                action="{{ route('product.like', $product->ProductID) }}"
                                                                method="POST" style="display: inline;">
                                                                @csrf
                                                                @php
                                                                    $isLiked = $product->likes->contains(
                                                                        'user_id',
                                                                        Auth::id(),
                                                                    );
                                                                @endphp
                                                                <button type="submit" class="btn btn-light">
                                                                    <i
                                                                        class="fas fa-heart {{ $isLiked ? 'text-danger' : 'far' }}"></i>
                                                                    <span
                                                                        class="like-count">{{ $product->likes()->count() }}</span>
                                                                </button>
                                                            </form>
                                                        </div>
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
                                <nav aria-label="Page navigation" class="mt-3">
                                    <ul class="pagination justify-content-end">
                                        {{-- Previous Page Link --}}
                                        @if ($activeProducts->onFirstPage())
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1"
                                                    aria-disabled="true">Previous</a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $activeProducts->previousPageUrl() }}"
                                                    tabindex="-1">Previous</a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @foreach ($activeProducts->getUrlRange(1, $activeProducts->lastPage()) as $page => $url)
                                            <li
                                                class="page-item {{ $activeProducts->currentPage() == $page ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($activeProducts->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ $activeProducts->nextPageUrl() }}">Next</a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#">Next</a>
                                            </li>
                                        @endif
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
                                        <!-- <button type="button" class="btn btn-warning btn-add-buttons" data-bs-toggle="modal" data-bs-target="#">Create an event</button> -->
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

                                {{-- Events Content --}}
                                <div class="events-section mt-5">
                                    <div class="row">
                                        @php
                                            // Filter the events to include Approved, OnGoing, and Ended events
                                            $filteredEvents = $events->filter(function ($event) {
                                                return in_array($event->Status, ['Approved', 'OnGoing', 'Ended']);
                                            });
                                        @endphp

                                        @forelse ($filteredEvents as $event)
                                            @php
                                                $isEnded =
                                                    \Carbon\Carbon::parse($event->Date)->isPast() ||
                                                    $event->Status === 'Ended';
                                            @endphp
                                            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                                                <!-- Display event details -->
                                                <div class="card position-relative {{ $isEnded ? 'ended-event' : '' }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#eventModal{{ $event->EventID }}">
                                                    @if ($isEnded)
                                                        <div class="badge ended-badge bg-danger position-absolute">
                                                            Ended
                                                        </div>
                                                    @endif
                                                    <img src="{{ $event->EventImage ? asset('storage/' . $event->EventImage) : 'default-image.jpg' }}"
                                                        class="card-img-top" alt="{{ $event->EventName }}">
                                                    <div class="card-body">
                                                        <!-- Date and Time Section -->
                                                        <div
                                                            class="d-flex justify-content-left align-items-center mb-2">
                                                            <div class="date-time me-3">
                                                                <span
                                                                    class="date-day">{{ \Carbon\Carbon::parse($event->Date)->format('d') }}</span>
                                                                <span
                                                                    class="date-month">{{ \Carbon\Carbon::parse($event->Date)->format('M Y') }}</span>
                                                            </div>

                                                            <div class="d-block">
                                                                <h5 class="card-title fw-bold">{{ $event->EventName }}
                                                                </h5>
                                                                <p
                                                                    class="card-text text-muted truncate-description-card pt-2">
                                                                    {{ $event->EventDescription }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12 text-center mt-5">
                                                <p class="text-muted">No events created yet. Start by creating your
                                                    first event!</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>



                                 <!-- Modal for View Details -->
                                 @foreach ($events as $event)
                                 <div class="modal fade dynamic-modal" id="eventModal{{ $event->EventID }}"
                                     tabindex="-1" aria-labelledby="eventModalLabel{{ $event->EventID }}"
                                     aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                                     <div class="modal-dialog modal-lg">
                                         <div class="modal-content">
                                             <!-- Full Image on Top with Overlay for Edit/Delete Menu -->
                                             <div class="modal-body p-0 position-relative">
                                                 <img src="{{ asset('storage/' . $event->EventImage) }}"
                                                     class="img-fluid w-100" alt="Event Image"
                                                     style="object-fit: cover; height: 200px;">



                                                 <!-- Edit/Delete Menu Overlay -->
                                                 @if (Auth::id() == $event->UserID)
                                                     @php
                                                         $eventDate = \Carbon\Carbon::parse($event->Date);
                                                         $currentDate = \Carbon\Carbon::now();
                                                     @endphp
                                                     @if (Auth::id() == $event->UserID)
                                                         @php
                                                             $eventDate = \Carbon\Carbon::parse($event->Date);
                                                             $currentDate = \Carbon\Carbon::now();
                                                         @endphp

                                                         <div class="position-absolute top-0 end-0 p-3">
                                                             <div class="dropdown-bar">
                                                                 <button class="btn btn-option dropdown-bar"
                                                                     type="button"
                                                                     id="dropdownMenuButton{{ $event->EventID }}"
                                                                     data-bs-toggle="dropdown"
                                                                     aria-expanded="false">
                                                                     <i class="fas fa-ellipsis-v"></i>
                                                                 </button>
                                                                 <button type="button" class="btn-close"
                                                                     data-bs-dismiss="modal"
                                                                     aria-label="Close"></button>
                                                             </div>
                                                         </div>
                                                     @endif
                                                 @endif
                                             </div>

                                             <!-- Event Details Below -->
                                             <div class="modal-body">
                                                 <div class="row">
                                                     <div class="col-md-12">
                                                         <!-- Event Date and Time -->
                                                         <div
                                                             class="d-flex justify-content-between align-items-center mb-3">
                                                             <!-- Event Date and Time -->
                                                             <p class="event-date-time text-muted mb-0">
                                                                 {{ \Carbon\Carbon::parse($event->Date)->format('l F j, Y') }}
                                                                 |
                                                                 {{ \Carbon\Carbon::parse($event->StartTime)->format('g:i A') }}
                                                                 -
                                                                 {{ \Carbon\Carbon::parse($event->EndTime)->format('g:i A') }}
                                                             </p>

                                                             <!-- Link Button -->
                                                             @if ($event->Link)
                                                             <a href="{{ $event->Link }}" class="btn btn-primary-link" target="_blank">
                                                                 <!-- Icon always visible -->
                                                                 <i class="fas fa-link"></i>
                                                                 <!-- Text hidden on small screens, shown on larger screens -->
                                                                 <span class="d-none d-sm-inline">Link to Join</span>
                                                             </a>

                                                             @endif
                                                         </div>
                                                         <!-- Event Name -->
                                                         <h5 class="modal-title fw-bold mt-3">
                                                             {{ $event->EventName }}</h5>
                                                         <!-- Event Description -->
                                                         <p class="modal-text mb-3 text-muted">
                                                             {{ $event->EventDescription }}</p>
                                                         <!-- Location with Icon -->
                                                         <div class="d-flex align-items-center mb-3">
                                                             @if ($event->Link)
                                                                 @php
                                                                     $statusColor = '';
                                                                     switch ($event->Status) {
                                                                         case 'Approved':
                                                                             $statusColor = 'btn-success';
                                                                             break;
                                                                         case 'Pending':
                                                                             $statusColor = 'btn-warning';
                                                                             break;
                                                                         case 'OnGoing':
                                                                             $statusColor = 'btn-info';
                                                                             break;
                                                                         case 'Rejected':
                                                                             $statusColor = 'btn-danger';
                                                                             break;
                                                                         case 'Ended':
                                                                             $statusColor = 'btn-secondary';
                                                                             break;
                                                                     }
                                                                 @endphp

                                                                 @if (Auth::id() == $event->UserID)
                                                                     <button type="button"
                                                                         class="btn {{ $statusColor }} me-3"
                                                                         disabled>
                                                                         {{ $event->Status }}
                                                                     </button>
                                                                 @endif
                                                             @endif

                                                             <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($event->Location) }}"
                                                                 class="btn btn-primary" target="_blank">
                                                                 <i class="fas fa-map-marker-alt"></i>
                                                                 {{ $event->Location }}
                                                             </a>
                                                         </div>


                                                     </div>
                                                 </div>
                                             </div>

                                         </div>
                                     </div>
                                 </div>
                             @endforeach

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

                    </div>


                    {{-- Feedbacks --}}
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
                            <button class="carousel-control-prev" type="button" data-bs-target="#feedbackCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#feedbackCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>




                    <!-- Feedback Form -->
                    <div class="container custom-shadow mt-5 p-4">
                        <h3 style="color: #145DA0;">Write Your Feedback</h3>
                        <form action="{{ route('ratings.store') }}" method="post">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- <input type="hidden" name="userID" value="{{ auth()->id() }}"> <!-- Add this line --> --}}
                            {{-- <input type="hidden" name="sellerID" value="{{$seller->id }}"> <!-- Add this line, assuming $sellerID is defined --> --}}
                            <input type="hidden" name="sellerID" value="{{ $sellerID }}">

                            <div class="mb-3">
                                <label class="form-label">Rating</label>
                                <div class="d-flex">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star rating-star" data-rating="{{ $i }}"
                                            style="color: #ccc; font-size: 24px;"></i>
                                    @endfor
                                    <input type="hidden" name="rating" id="rating" value="0">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="feedbackText" class="form-label">Your Feedback</label>
                                <textarea id="feedbackText" name="feedback" class="form-control" rows="4" required></textarea>
                                <div class="col-12 mt-3">
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <h5 class="alert-heading text-start">
                                            &#x1F4DD; Feedback Reminder
                                        </h5>
                                        <p class="text-start">
                                            Please ensure your feedback is constructive and respectful. Honest and
                                            thoughtful feedback helps us improve our products and services. Avoid using
                                            inappropriate language or personal attacks. Thank you for contributing to
                                            our community!
                                        </p>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-warning text-white"
                                style="padding: 10px 20px; font-size: 16px;">
                                <i class="fa fa-paper-plane" style="margin-right: 8px;"></i> Submit Feedback
                            </button>
                        </form>
                    </div>


                </div>

            </div>
        </div>

        {{-- UI: Back to top button --}}
        <button type="button" class="btn btn-primary btn-floating btn-lg" id="btn-back-to-top">
            <i class="fas fa-arrow-up"></i>
        </button>


        <script>
            //Back to top button
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


            // Report button validation
            (function() {
                'use strict';

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.querySelectorAll('#reportForm');

                // Detect if form has been changed
                var formChanged = false;
                var reportReason = document.getElementById('reportReason');
                var reportDetails = document.getElementById('reportDetails');

                // Mark form as changed if input is detected
                reportReason.addEventListener('change', function() {
                    formChanged = true;
                });

                reportDetails.addEventListener('input', function() {
                    formChanged = true;
                });

                // Handle form validation and submission
                Array.prototype.slice.call(forms).forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }

                        form.classList.add('was-validated');
                    }, false);
                });

                // Handle discard button click
                var discardButton = document.getElementById('discardButton');
                discardButton.addEventListener('click', function(event) {
                    if (formChanged) {
                        var confirmDiscard = confirm("You have unsaved changes. Are you sure you want to discard?");
                        if (!confirmDiscard) {
                            event.preventDefault();
                        } else {
                            // Reset form fields
                            var form = document.querySelector('#reportForm');
                            form.reset();
                            form.classList.remove('was-validated');
                            formChanged = false;

                            // Close modal if confirmed
                            var modal = bootstrap.Modal.getInstance(document.querySelector('.modal'));
                            modal.hide();
                        }
                    } else {
                        // Close modal directly if no changes
                        var modal = bootstrap.Modal.getInstance(document.querySelector('.modal'));
                        modal.hide();
                    }
                });

            })();
        </script>



        <footer>
            @include('header_and_footer.footer')
        </footer>

        <!-- multiple upload of image -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>

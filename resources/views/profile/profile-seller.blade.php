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

    {{-- Cover Photo --}}
    <div class="container-fluid custom-shadow-profile">
        <div class="container cover">
        <div class="header__wrapper d-flex justify-content-center">
            <img src="{{ asset('images/sampleC.png') }}" alt="..."/>
        </div>
    </div>


    <!-- for full width // tsaka na to pag may edit profile na -->
    {{-- <div class="container-fluid custom-shadow mb-5" style="padding-left: 0; padding-right: 0;">
        <img src="path_to_your_image.jpg" class="img-fluid" alt="Your Image Description">
    </div> --}}


    {{-- Profile Picture --}}
    <div class="container d-flex justify-content-center align-items-center">
        <div class="img__container">
            <img src="{{ asset('images/def.png') }}" alt="..." class="border-white thick-border"
                style="width:250px; height: 250px; margin-top: -100px; border-radius: 100%; object-fit: cover; margin-left:15px" />
            <span></span>
        </div>
    </div>


    {{-- Tags --}}
    <div class="name text-center">
        <h2 class="card-title text-center mb-5" style="margin-top: 1rem; color:#343434;">{{ $user->FName }}
            {{ $user->LName }}</h2>
        <button type="button" class="btn btn-sm btn-primary mb-5" disabled>Handmade Jewelry</button>
        <button type="button" class="btn btn-sm btn-danger mb-5" disabled>Mixed Media Art</button>
        <button type="button" class="btn btn-sm btn-success mb-5" disabled>Yarn Crafts</button>
    </div>



    {{-- Hidden in buyers' POV --}}
    {{-- <div class="container text-center pb-5">
                    <button type="button" class="btn btn-danger btn-md"><i class="fas fa-exclamation-circle"
                            style="margin-right: 5px;"></i>Report this user</button>
                    <button type="button" class="btn btn-warning btn-md"><i class="fas fa-pencil-alt"
                            style="margin-right: 5px;"></i>Write a review</button>
                </div> --}}

</div>


{{-- Add new product --}}
<div class="container mt-5 custom-shadow" style="padding: 2rem;">

    {{-- Tabs --}}
    <ul class="nav nav-pills user-profile-tab justify-content-start mt-2 bg-light-info rounded-2" id="pills-tab"
        role="tablist">
        <li class="nav-item" role="presentation">
            <button
                class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                id="pills-products-tab" data-bs-toggle="pill" data-bs-target="#pills-products" type="button"
                role="tab" aria-controls="pills-products" aria-selected="true">
                <i class="fa fa-image me-2 fs-6"></i>
                <span class="d-none d-md-block">Products</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button
                class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                id="pills-events-tab" data-bs-toggle="pill" data-bs-target="#pills-events" type="button" role="tab"
                aria-controls="pills-events" aria-selected="false" tabindex="-1">
                <i class="fa fa-calendar me-2 fs-6"></i>
                <span class="d-none d-md-block">Events</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button
                class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                id="pills-archives-tab" data-bs-toggle="pill" data-bs-target="#pills-archives" type="button"
                role="tab" aria-controls="pills-archives" aria-selected="false" tabindex="-1">
                <i class="fa fa-box me-2 fs-6"></i>
                <span class="d-none d-md-block">Archives</span>
            </button>
        </li>
    </ul>

    {{-- Add new product Modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Left column -->
                            <form method="post" action="{{ route('products-seller.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <input type="hidden" name="user_id" value="{{ auth()->user()->UserID }}">
                                <div class="mb-3">
                                    <label for="productName" class="form-label">Product
                                        Name</label>
                                    <input type="text" class="form-control" id="productName" name="name"
                                        placeholder="Input Product Name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" placeholder="Input Product Description" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" name="qty"
                                        placeholder="Input Product Quantity" required>
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="price" name="price"
                                        placeholder="0" required>
                                </div>

                                <div class="mb-3">
                                    <label for="prodimg" class="form-label">Product Images</label>
                                    <input type="file" class="form-control" id="prodimg" name="prodimg[]"
                                        accept="image/*" multiple onchange="handleFiles(event)" required>
                                    <p class="text-muted">Accepted image formats: .jpeg, .jpg, .png, with a maximum
                                        size of 2MB per image.</p>
                                </div>

                                <script>
                                    function handleFiles(event) {
                                        const files = event.target.files;
                                        const previewContainer = document.getElementById('preview-container');

                                        // Clear previous previews and input if more than 4 files selected
                                        if (files.length > 4) {
                                            alert("You can only upload a maximum of 4 images.");
                                            event.target.value = "";
                                            previewContainer.innerHTML = "";
                                            return;
                                        }

                                        // Clear previous previews
                                        previewContainer.innerHTML = "";

                                        // Loop through the files and create image previews
                                        for (let i = 0; i < files.length; i++) {
                                            const file = files[i];
                                            const fileReader = new FileReader();

                                            fileReader.onload = function(e) {
                                                const img = document.createElement('img');
                                                img.src = e.target.result;
                                                img.style.width = "200px";
                                                img.style.height = "200px"; // Set a fixed height
                                                img.style.objectFit = "cover"; // Ensure the image covers the area without distorting
                                                img.style.border = "1px solid #ccc"; // Light border
                                                img.style.margin = "10px";
                                                img.style.boxSizing = "border-box"; // Include border in the width/height calculation
                                                previewContainer.appendChild(img);
                                            };

                                            fileReader.readAsDataURL(file);
                                        }
                                    }
                                </script>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save a new
                                        Product</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 d-flex align-items-center justify-content-center mb-5">
                            <!-- Right column -->
                            <div class="mb-3">
                                <label for="preview-container" class="form-label">Image Preview</label>
                                <div id="preview-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Products --}}

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-products" role="tabpanel"
            aria-labelledby="pills-products-tab" tabindex="0">

            <div class="row">
                <div class="col-md-6 mt-5">
                    <button type="button" class="btn btn-warning btn-add-buttons" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Add new product</button>
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
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card" data-bs-toggle="modal"
                            data-bs-target="#productModal{{ $product->ProductID }}">
                            <div id="carouselProduct{{ $product->ProductID }}" class="carousel slide"
                                data-bs-ride="false">
                                <div class="carousel-inner">
                                    @foreach (explode(',', $product->ProductImage) as $image)
                                        <div class="carousel-item @if ($loop->first) active @endif">
                                            <img src="{{ asset('storage/products/' . $user->UserID . '/' . basename($image)) }}"
                                                class="d-block w-100 card-img-top" alt="Product Image">
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
                            </div>

                        </div>
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




                    {{-- View Details Modal --}}
                    <div class="modal fade" id="productModal{{ $product->ProductID }}" tabindex="-1"
                        aria-labelledby="productModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title fs-5" id="productModalLabel"
                                        style="text-transform: capitalize;">
                                        {{ $product->ProductName }}</h2>
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
                                                                <img src="{{ asset('storage/products/' . $user->UserID . '/' . basename($image)) }}"
                                                                    class="d-block w-100 card-img-top"
                                                                    alt="Product Image" style="height: 400px;">
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
                                                            <img src="{{ asset('storage/products/' . $user->UserID . '/' . basename($image)) }}"
                                                                class="img-thumbnaill" alt="Product Thumbnail"
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
                                            <p class="card-text text-muted">Description:
                                                {{ $product->ProductDescription }}</p>
                                            <p class="card-text text-muted">Price: ₱ {{ $product->Price }}</p>
                                            <p class="card-text text-muted">Quantity: {{ $product->Quantity }}</p>
                                            <p class="card-text text-muted">Category: Mixed Media Art</p>
                                            <p class="card-text text-muted mt-5"><strong>Product by:</strong> <br>
                                                <img src="{{ asset('images/janica.png') }}" alt="User Image"
                                                    class="user-image">
                                                {{ $user->FName }} {{ $user->LName }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $product->ProductID }}">Delete</button>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $product->ProductID }}">Edit</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

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



                    <!-- Delete modal -->
                    <div class="modal fade" id="deleteModal{{ $product->ProductID }}" tabindex="-1"
                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title fs-5" id="deleteModalLabel">Delete item?</h2>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete? This action cannot be undone.
                                </div>
                                <div class="modal-footer">
                                    <form id="delete-form-{{ $product->ProductID }}"
                                        action="{{ route('products-seller.destroy', ['product' => $product->ProductID]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Yes</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">No</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        function deleteProduct(productId) {
                            // Submit the form corresponding to the productId
                            document.getElementById('delete-form-' + productId).submit();
                        }
                    </script>



                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $product->ProductID }}" tabindex="-1"
                        aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form for editing product content -->
                                    <form method="post"
                                        action="{{ route('products-seller.update', ['product' => $product->ProductID]) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <!-- Input fields for editing product details -->
                                        <div class="mb-3">
                                            <label for="productImage" class="form-label">Product Image</label>
                                            <input type="file" class="form-control" id="productImage"
                                                accept="image/*" value="{{ $product->ProductImage }}"
                                                name="PImage">
                                        </div>
                                        <div class="mb-3">
                                            <label for="productName" class="form-label">Product Name</label>
                                            <input type="text" name="Pname" class="form-control"
                                                id="productName" value="{{ $product->ProductName }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="productDescription" class="form-label">Product
                                                Description</label>
                                            <input type="text" class="form-control" id="productName"
                                                value="{{ $product->ProductDescription }}" name="Pdescription">

                                            {{-- <textarea class="form-control" id="productDescription" value="{{$product->ProductDescription}}" name="Pdescription"></textarea> --}}
                                        </div>
                                        <div class="mb-3">
                                            <label for="productPrice" class="form-label">Product Price</label>
                                            <input type="text" class="form-control" id="productName"
                                                value="{{ $product->Price }}" name="Pprice">
                                            {{-- <textarea class="form-control" id="productPrice" value="{{$product->Price}}"></textarea> --}}
                                        </div>
                                        <div class="mb-3">
                                            <label for="productPrice" class="form-label">Product Quantity</label>
                                            <input type="text" class="form-control" id="productName"
                                                value="{{ $product->Quantity }}" name="Pqty">
                                            {{-- <textarea class="form-control" id="productPrice" value="{{$product->ProductQuantity}}"></textarea> --}}
                                        </div>
                                        <div class="mb-3">
                                            <label for="productCategory" class="form-label">Product
                                                Category</label>
                                            <select class="form-control" id="productCategory">
                                                <option value="electronics">Painting</option>
                                                <option value="clothing">Crochet</option>
                                                <option value="accessories">Bracelets</option>
                                                <!-- Add more options for other categories -->
                                            </select>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary mr-auto"
                                                data-bs-toggle="modal"
                                                data-bs-target="#unsavedEditModal">Cancel</button>

                                            <!-- ADDED: class - para sa styling ng update button -->
                                            <input type="submit" value="Update" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <nav aria-label="..." class="mt-3">
                <ul class="pagination justify-content-end">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
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
        <div class="tab-pane fade show" id="pills-events" role="tabpanel" aria-labelledby="pills-events-tab"
            tabindex="0">

            <div class="row">
                <div class="col-md-6 mt-5">
                    <button type="button" class="btn btn-warning btn-add-buttons" data-bs-toggle="modal"
                        data-bs-target="#">Create an event</button>
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
        <div class="tab-pane fade show" id="pills-archives" role="tabpanel" aria-labelledby="pills-archives-tab"
            tabindex="0">

            <h1>Archives</h1>

        </div>
    </div>
</div>



<div class="container custom-shadow mt-5">

    {{-- <h1 class="text-start pt-3">My Events</h1> --}}
    {{-- padisplay dito yung mga created events ng user na to --}}

</div>



</div>
</div>
</div>
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
            <p>I appreciate the creativity and originality you bring to your projects. Your unique style sets your
                work apart and makes it memorable.</p>
            <p class="text-muted">- Jane Dela Guzman </p>
        </div>
    </div>
</div>

<div class="container custom-shadow mt-5 p-3 mb-5">
    <div class="row">
        <div class="col-12">
            <br>
            <p>I'm impressed by the high quality of craftsmanship evident in your creations. The materials you used
                are top-notch, and the finished product exceeded my expectations.</p>
            <p class="text-muted">- Juan Dela Cruz </p>
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

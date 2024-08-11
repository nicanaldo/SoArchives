<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile</title>

  <!-- Font Awesome -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/main.css') }}"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  

<!-- Rest of your template content -->
</head>

<body>
 

<div class="container-fluid custom-shadow mb-5">


  <header>
    @include('header_and_footer.header')
  </header>



  <!-- Cover photo -->
  <div class="header__wrapper d-flex justify-content-center">
    <div class="container">
      <header></header>
    </div>
  </div>


  <!-- for full width // tsaka na to pag may edit profile na -->
      <!-- <div class="container-fluid custom-shadow mb-5" style="padding-left: 0; padding-right: 0;">
         <img src="path_to_your_image.jpg" class="img-fluid" alt="Your Image Description">
      </div> -->


  <!-- Profile pic -->
  <div class="container d-flex justify-content-center align-items-center">
    <div class="img__container">
      <img src="{{ asset('images/default.png') }}" alt="..." class="border-white thick-border" style="width:250px; height: 250px; margin-top: -100px; border-radius: 100%; object-fit: cover; margin-left:15px" />
      <span></span>
    </div> 
  </div>


  <!-- Tags -->
  <div class="name text-center">
    <h2 class="card-title text-center" style="margin-top: 1rem; color:#343434;">{{ $user->fname }} {{ $user->lname }}</h2>
    <p style="margin-bottom: 1rem; padding-bottom:3rem; padding-top: 10px;" class="text-muted">Stickers | Prints | Keychain</p>
  </div>

<!-- Hidden in buyers' POV -->

<!-- 
  <div class="container text-center pb-5">
    <button type="button" class="btn btn-danger btn-md"><i class="fas fa-exclamation-circle" style="margin-right: 5px;"></i>Report this user</button>
    <button type="button" class="btn btn-warning btn-md"><i class="fas fa-pencil-alt" style="margin-right: 5px;"></i>Write a review</button>
  </div> -->

  
</div>

                          <!-- Add Item -->
                          <div class="container mt-5 custom-shadow" style="padding: 2rem;">
                              <div class="row justify-content-end mb-3">
                                  <!-- Add item -->
                                  <div class="col-md-6 mt-5">
                                      <button type="button" class="btn btn-warning btn-add-buttons" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus-circle" style="margin-right: 5px;"></i>Add Item</button>
                                      <!-- Modal -->
                                      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-lg">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                  </div>
                                                  <div class="modal-body">
                                                      <div class="row">
                                                          <div class="col-md-6">
                                                              <!-- Left column -->
                                                              <form method="post" action="{{route('products-seller.store')}}" enctype="multipart/form-data">
                                                                  @csrf
                                                                  @method('post')
                                                                  <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                                  <div class="mb-3">
                                                                      <label for="productName" class="form-label">Product Name:</label>
                                                                      <input type="text" class="form-control" id="productName" name="name" placeholder="Name" required>
                                                                  </div>
                                                                  <div class="mb-3">
                                                                      <label for="quantity" class="form-label">Quantity:</label>
                                                                      <input type="number" class="form-control" id="quantity" name="qty" placeholder="Qty" required>
                                                                  </div>
                                                                  <div class="mb-3">
                                                                      <label for="price" class="form-label">Price:</label>
                                                                      <input type="number" class="form-control" id="price" name="price" placeholder="Price" required>
                                                                  </div>
                                                                  <div class="mb-3">
                                                                      <label for="description" class="form-label">Description:</label>
                                                                      <input type="text" class="form-control" id="description" name="description" placeholder="Description" required>
                                                                  </div>
                                                                  <div class="mb-3">
                                                                      <label for="prodimg" class="form-label">Product Images:</label>                                       
                                                                      <input type="file" class="form-control" id="prodimg" name="prodimg[]" accept="image/*" multiple onchange="previewImages(event)" required>
                                                                      <p class="text-muted">Accepted image formats: .jpeg, .jpg, .png, with a maximum size of 2MB per image.</p>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                      <button type="submit" class="btn btn-primary">Save a new Product</button>
                                                                  </div>
                                                              </form>
                                                          </div>
                                                          <div class="col-md-6 d-flex align-items-center justify-content-center mb-5">
                                                              <!-- Right column -->
                                                              <div class="mb-3">
                                                                  <label for="imagePreview" class="form-label">Image Preview</label>
                                                                  <div id="imagePreview"></div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                  <script>
                                    function previewImages(event) {
                                        var preview = document.getElementById('imagePreview');
                                        preview.innerHTML = '';
                                        var files = event.target.files;

                                        for (var i = 0; i < files.length; i++) {
                                            var file = files[i];

                                            if (!file.type.match('image.*')) {
                                                continue;
                                            }

                                            var reader = new FileReader();

                                            reader.onload = function(event) {
                                                var img = document.createElement('img');
                                                img.src = event.target.result;
                                                img.style.width = '150px';
                                                img.style.height = '150px';
                                                preview.appendChild(img);
                                            }

                                            reader.readAsDataURL(file);
                                        }
                                    }
                                  </script>


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

                                


                                  <!-- Search bar -->
                                <div class="col-md-6 mt-5">
                                    <form class="" style="" method="post" action="{{ route('products-search')}}">
                                        <div class="input-group">
                                        
                                            @csrf
                                            <input type="search" name="search" class="form-control" placeholder="Search crafts or products" aria-label="Search" value="{{isset($search) ? $search : ''}}">
                                        
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                </div>


                                <!-- Product Cards -->
                                <div class="row justify-content-left" style="margin-top: 3rem;">
                                  @foreach($products as $product)
                                    <div class="col-lg-3 col-md-6 mb-4">
                                        <div class="card">
                                            <div id="carouselProduct{{ $product->ProductID }}" class="carousel slide" data-bs-ride="false"> 
                                                <div class="carousel-inner">
                                                    @foreach(explode(',', $product->ProductImage) as $image)

                                                    

                                                        <div class="carousel-item @if($loop->first) active @endif">
                                                            <img src="{{ asset('storage/products/' . $user->id . '/' . basename($image)) }}" class="d-block w-100 card-img-top" alt="Product Image">
                                                        </div>

                                                        <button class="carousel-control-prev @if(count(explode(',', $product->ProductImage)) <= 1) d-none @endif" type="button" data-bs-target="#carouselProduct{{ $product->ProductID }}" data-bs-slide="prev" >
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Previous</span>
                                                        </button>
                                                        <button class="carousel-control-next @if(count(explode(',', $product->ProductImage)) <= 1) d-none @endif" type="button" data-bs-target="#carouselProduct{{ $product->ProductID }}" data-bs-slide="next">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Next</span>
                                                        </button>       

                                  @endforeach                                 
                                              </div> 
                                          </div>
                                          <div class="card-body">
                                              <h5 class="card-title" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-transform: capitalize;">{{ $product->ProductName }}</h5>
                                              <p class="card-text text-muted" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $product->ProductDescription }}</p>
                                              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal{{ $product->ProductID }}">View Details</button>
                                          </div>
                                      </div>
                                </div>




                         <!-- View Modal -->
                         <div class="modal fade" id="productModal{{ $product->ProductID }}" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title fs-5" id="productModalLabel" style="text-transform: capitalize;">{{ $product->ProductName }}</h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                            <div class="row">

                                                <!-- Carousel inside the view details modal -->
                                                <!-- Left column -->
                                                <div class="col-md-6">
                                                    <div id="carouselProductModal{{ $product->ProductID }}" class="carousel slide" data-bs-ride="false">
                                                        <div class="carousel-inner">
                                                            @foreach(explode(',', $product->ProductImage) as $image)
                                                            <div class="carousel-item @if($loop->first) active @endif">
                                                                <img src="{{ asset('storage/products/' . $user->id . '/' . basename($image)) }}" class="d-block w-100 card-img-top" alt="Product Image">
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                        <button class="carousel-control-prev @if(count(explode(',', $product->ProductImage)) <= 1) d-none @endif" type="button" data-bs-target="#carouselProductModal{{ $product->ProductID }}" data-bs-slide="next">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Previous</span>
                                                        </button>
                                                        <button class="carousel-control-next @if(count(explode(',', $product->ProductImage)) <= 1) d-none @endif" type="button" data-bs-target="#carouselProductModal{{ $product->ProductID }}" data-bs-slide="next">
                                                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                          <span class="visually-hidden">Next</span>
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- Right column -->
                                                <div class="col-md-6">
                                                    <h5 class="card-title">Description</h5>
                                                    <p class="card-text text-muted">{{ $product->ProductDescription }}</p>
                                                    <h5 class="card-title">Price</h5>
                                                    <p class="card-text text-muted">{{ $product->Price }}</p>
                                                    <h5 class="card-title">Quantity</h5>
                                                    <p class="card-text text-muted">{{ $product->Quantity }}</p>
                                                    <h5 class="card-title">Category</h5>
                                                    <p class="card-text text-muted">Cellphone Holder</p>
                                                </div>
                                            </div>
                                        </div>


                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $product->ProductID }}">Delete</button>
                                        <!-- Edit button -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $product->ProductID }}">Edit</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <!-- Delete modal -->
                        <div class="modal fade" id="deleteModal{{ $product->ProductID }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h2 class="modal-title fs-5" id="deleteModalLabel">Delete item?</h2>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                              Are you sure you want to delete? This action cannot be undone.
                                          </div>
                                          <div class="modal-footer">
                                              <form id="delete-form-{{ $product->ProductID }}" action="{{ route('products-seller.destroy', ['product' => $product->ProductID]) }}" method="POST">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit" class="btn btn-danger">Yes</button>
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>                                              </form>
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
                          <div class="modal fade" id="editModal{{ $product->ProductID }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                          <!-- Form for editing product content -->
                                          <form method="post" action="{{ route('products-seller.update', ['product' => $product->ProductID]) }}" enctype="multipart/form-data">
                                              @csrf
                                              @method('put')
                                              <!-- Input fields for editing product details -->
                                              <div class="mb-3">
                                                  <label for="productImage" class="form-label">Product Image</label>
                                                  <input type="file" class="form-control" id="productImage" accept="image/*" value="{{$product->ProductImage}}" name="PImage">
                                              </div>
                                              <div class="mb-3">
                                                  <label for="productName" class="form-label">Product Name</label>
                                                  <input type="text" name="Pname" class="form-control" id="productName" value="{{$product->ProductName}}">
                                              </div>
                                              <div class="mb-3">
                                                  <label for="productDescription" class="form-label">Product Description</label>
                                                  <input type="text" class="form-control" id="productName" value="{{$product->ProductDescription}}" name="Pdescription">
                                                  {{-- <textarea class="form-control" id="productDescription" value="{{$product->ProductDescription}}" name="Pdescription"></textarea> --}}
                                              </div>
                                              <div class="mb-3">
                                                  <label for="productPrice" class="form-label">Product Price</label>
                                                  <input type="text" class="form-control" id="productName" value="{{$product->Price}}" name="Pprice">
                                                  {{-- <textarea class="form-control" id="productPrice" value="{{$product->Price}}"></textarea> --}}
                                              </div>
                                              <div class="mb-3">
                                                  <label for="productPrice" class="form-label">Product Quantity</label>
                                                  <input type="text" class="form-control" id="productName" value="{{$product->Quantity}}" name="Pqty">
                                                  {{-- <textarea class="form-control" id="productPrice" value="{{$product->ProductQuantity}}"></textarea> --}}
                                              </div>
                                              <div class="mb-3">
                                                  <label for="productCategory" class="form-label">Product Category</label>
                                                  <select class="form-control" id="productCategory">
                                                      <option value="electronics">Painting</option>
                                                      <option value="clothing">Crochet</option>
                                                      <option value="accessories">Bracelets</option>
                                                      <!-- Add more options for other categories -->
                                                  </select>
                                              </div>

                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary mr-auto" data-bs-toggle="modal" data-bs-target="#unsavedEditModal">Cancel</button>

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
                      
                        
                  </div>
                </div>
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
      <p>I appreciate the creativity and originality you bring to your projects. Your unique style sets your work apart and makes it memorable.</p>
      <p class="text-muted">- Jane Dela Guzman </p>
    </div>
  </div>
</div>

<div class="container custom-shadow mt-5 p-3 mb-5">
  <div class="row">
    <div class="col-12">
      <br>
      <p>I'm impressed by the high quality of craftsmanship evident in your creations. The materials you used are top-notch, and the finished product exceeded my expectations.</p>
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

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
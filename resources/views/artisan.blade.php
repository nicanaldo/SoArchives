<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artisans</title>

    <link href="/bootstrap-5.3.3-dist/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />



    <!-- to work the toggle in the navbar -->
  
   

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <!-- soarchive file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/regular.min.css" integrity="sha512-KYEnM30Gjf5tMbgsrQJsR0FSpufP9S4EiAYi168MvTjK6E83x3r6PTvLPlXYX350/doBXmTFUEnJr/nCsDovuw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  </head>

<style>
    *{
        font-family: 'Helvetica', sans-serif; 
    }
</style>
 

<body>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    
<!-- Navbar -->


    <header>
        @include('header_and_footer.header')
    </header>


<!-- Banner -->
<div class="banner" style="background-image: url('images/banner.png'); height:400px">
    <div class="container">
      <h1 style="margin-bottom: -3rem; color: #FEFEFE; font-weight: 500;">Artisans are crafting wonders for you!</h1>
      <div class="search-container" style=" display: flex; justify-content: center;">

        {{-- sa action gumana --}}
        <form class="d-flex mb-10" style="width: 60%;" method="post" action="/artisan">
            @csrf
          <input class="form-control me-1 search-input" type="search" name="search" placeholder="Search for artisans..." aria-label="Search" value="{{isset($search) ? $search : ''}}">

          <!-- Categories -->
          <div class="dropdown">           
            <a class="btn btn-warning dropdown-toggle" style="margin-left: 3px;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Categories
            </a>
        
            <ul class="dropdown-menu">
                @foreach($tags as $tag)
                    <li><a class="dropdown-item" href="#">{{ $tag->name }}</a></li>
                @endforeach
            </ul>
        </div>
        

        </form>
      </div>
    </div>
  </div>


<div class="container p-4 custom-shadow mt-5 mb-5  animate__animated animate__slideInUp ">

    <!-- Product Cards -->
    <div class="row justify-content-left" style="margin-top: 2rem;">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="row">
            @foreach($profiles as $seller)
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="{{ route('seller.profile', ['user' => $seller->id]) }}" class="card-link" style="text-decoration: none;">
                        <div class="card">
                            <!-- Cover photo -->
                            <img src="{{ asset('images/defaultCover.png') }}" class="card-img-top" style="height:200px; object-fit: cover;" alt="Cover Photo">
        
                            <!-- Profile pic -->
                            <div class="container d-flex justify-content-center align-items-center">
                                <div class="img__container">
                                    <img src="{{ asset('images/default.png') }}" alt="..." class="border-white thick-border" style="width:120px; height: 120px; margin-top: -50px; border-radius: 100%; object-fit: cover; margin-left:15px" />
                                    <span></span>
                                </div>
                            </div>
        
                            <div class="card-body">
                                <h5 class="card-title text-center" style="color: #343434; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-decoration: none;">
                                    {{ $seller->fname }} {{ $seller->lname }}
                                </h5>
                                <p class="card-text text-muted text-center" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-decoration: none;">
                                    <a href="#" class="btn btn-danger btn-lg p-1 disabled" style="font-size: small;" role="button" aria-disabled="true">Fiber Arts</a>
                                    <a href="#" class="btn btn-primary btn-lg p-1 disabled" style="font-size: small;" role="button" aria-disabled="true">Home Decor</a>
                                    <a href="#" class="btn btn-success btn-lg p-1 disabled" style="font-size: small;" role="button" aria-disabled="true">Yarn Crafts</a>
                                </p>
                            </div>
                        </div>
                    </a>
                    <!-- Input field for user_id -->
                    <input type="hidden" name="user_id" value="{{ auth()->check() ? auth()->user()->id : '' }}">
                </div>
            @endforeach
        </div>
        
        
        
        

        {{-- <div class="col-lg-3 col-md-6 mb-4">
                <a href="{{ route('products.index')}}" class="card-link" style="text-decoration: none;">
                    @php
                        $sellers = \App\Models\User::where('UserTypeID', '=', '2')->get(); // Assuming '2' is the user type for sellers
                    @endphp

                    @foreach($sellers as $seller)
                        <div class="card">
                            <!-- Cover photo -->
                            <img src="images/2.png" class="card-img-top" style="height:200px; object-fit: cover;" alt="Cover Photo">

                            <!-- Profile pic -->
                            <div class="container d-flex justify-content-center align-items-center">
                                <div class="img__container">
                                    <img src="{{ asset('images/nica.jpg') }}" alt="..." class="border-white thick-border" style="width:120px; height: 120px; margin-top: -50px; border-radius: 100%; object-fit: cover; margin-left:15px" />
                                    <span></span>
                                </div> 
                            </div>

                            <div class="card-body">
                                <h5 class="card-title text-center" style="color: #343434; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-decoration: none;">{{ $seller->FName }} {{ $seller->LName }}</h5>
                                <p class="card-text text-muted text-center" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-decoration: none;">Lorem ipsum dolor sit amet consectetur.</p>
                            </div>
                        </div>
                    @endforeach

                </a>
        </div> --}}

        {{-- <div class="col-lg-3 col-md-6 mb-4">
                <a href="{{ route('products.index')}}" class="card-link" style="text-decoration: none;">
                    <div class="card">
                        <!-- Cover photo -->
                        <img src="images/2.png" class="card-img-top" style="height:200px; object-fit: cover;" alt="Cover Photo">

                        <!-- Profile pic -->
                        <div class="container d-flex justify-content-center align-items-center">
                        <div class="img__container">
                            <img src="{{ asset('images/nica.jpg') }}" alt="..." class="border-white thick-border" style="width:120px; height: 120px; margin-top: -50px; border-radius: 100%; object-fit: cover; margin-left:15px" />
                            <span></span>
                        </div> 
                        </div>

                        <div class="card-body">
                        <h5 class="card-title text-center" style="color: #343434; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-decoration: none;">Artisan Name</h5>
                        <p class="card-text text-muted text-center" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-decoration: none;">Lorem ipsum dolor sit amet consectetur.</p>
                        </div>
                    </div>
                </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
                <a href="#" class="card-link" style="text-decoration: none;">
                    <div class="card">
                        <!-- Cover photo -->
                        <img src="images/2.png" class="card-img-top" style="height:200px; object-fit: cover;" alt="Cover Photo">

                        <!-- Profile pic -->
                        <div class="container d-flex justify-content-center align-items-center">
                        <div class="img__container">
                            <img src="{{ asset('images/kylie.jpg') }}" alt="..." class="border-white thick-border" style="width:120px; height: 120px; margin-top: -50px; border-radius: 100%; object-fit: cover; margin-left:15px" />
                            <span></span>
                        </div> 
                        </div>

                        <div class="card-body">
                        <h5 class="card-title text-center" style="color: #343434; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-decoration: none;">Artisan Name</h5>
                        <p class="card-text text-muted text-center" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-decoration: none;">Lorem ipsum dolor sit amet consectetur.</p>
                        </div>
                    </div>
                </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
                <a href="#" class="card-link" style="text-decoration: none;">
                    <div class="card">
                        <!-- Cover photo -->
                        <img src="images/3.png" class="card-img-top" style="height:200px; object-fit: cover;" alt="Cover Photo">

                        <!-- Profile pic -->
                        <div class="container d-flex justify-content-center align-items-center">
                        <div class="img__container">
                            <img src="{{ asset('images/kylie.jpg') }}" alt="..." class="border-white thick-border" style="width:120px; height: 120px; margin-top: -50px; border-radius: 100%; object-fit: cover; margin-left:15px" />
                            <span></span>
                        </div> 
                        </div>

                        <div class="card-body">
                        <h5 class="card-title text-center" style="color: #343434; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-decoration: none;">Artisan Name</h5>
                        <p class="card-text text-muted text-center" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-decoration: none;">Lorem ipsum dolor sit amet consectetur.</p>
                        </div>
                    </div>
                </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
                <a href="#" class="card-link" style="text-decoration: none;">
                    <div class="card">
                        <!-- Cover photo -->
                        <img src="images/2.png" class="card-img-top" style="height:200px; object-fit: cover;" alt="Cover Photo">

                        <!-- Profile pic -->
                        <div class="container d-flex justify-content-center align-items-center">
                        <div class="img__container">
                            <img src="{{ asset('images/kylie.jpg') }}" alt="..." class="border-white thick-border" style="width:120px; height: 120px; margin-top: -50px; border-radius: 100%; object-fit: cover; margin-left:15px" />
                            <span></span>
                        </div> 
                        </div>

                        <div class="card-body">
                        <h5 class="card-title text-center" style="color: #343434; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-decoration: none;">Artisan Name</h5>
                        <p class="card-text text-muted text-center" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-decoration: none;">Lorem ipsum dolor sit amet consectetur.</p>
                        </div>
                    </div>
                </a>
        </div> --}}

      

    </div>
</div>




    <footer>
    @include('header_and_footer.footer')
    </footer>



  <!-- Categories JS Toggle -->
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>



</body>

</body>
</html>
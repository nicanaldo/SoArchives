<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SOARchives</title>

    <link href="/bootstrap-5.3.3-dist/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  {{-- Tab Logo --}}
  <link rel="shortcut icon" href="{{ asset('images/tab-logo.ico') }}" type="image/x-icon">

    <!-- to work the toggle in the navbar -->
  
   

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <!-- soarchive file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/regular.min.css" integrity="sha512-KYEnM30Gjf5tMbgsrQJsR0FSpufP9S4EiAYi168MvTjK6E83x3r6PTvLPlXYX350/doBXmTFUEnJr/nCsDovuw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  </head>


 

<body>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    
<!-- Navbar -->


<header>
  @include('header_and_footer.header')
</header>



<!-- carousel -->

{{-- <div class="container"> --}}
  <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/Sophia.png" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Sophia Lorraine</h5>
          <p>"Crochet by Pey is back at it again! Looking for heartfelt gifts? Crochet by Pey has you covered!"</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="images/Jian.png" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Jian Victorino</h5>
          <p>"artista ng bayan, saan ka ba dapat lulugar?"</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="images/Janica.png" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Janica Naldo</h5>
          <p>"Crafting bracelets is my passion. Each piece tells a unique story of style and elegance, meticulously crafted to reflect your individuality and charm."</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
{{-- </div> --}}




  <!-- sub banner -->

  <div class="container">
    <div class="row">

      <div class="col-12 col-md-6 col-lg-4 mt-4 animate__animated animate__slideInUp">
        <div class="card-sub">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="images/a.png" class="img-fluid rounded-start d-none d-md-block" alt="...">
            </div>
            <div class="col-md-8 d-flex align-items-center">
              <div class="card-body">
                <h5 class="card-title">Showcase</h5>
                <p class="card-text">Share your handmade creations and receive recognition for your craftsmanship.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <div class="col-12 col-md-6 col-lg-4 mt-4 animate__animated animate__slideInUp">
        <div class="card-sub">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="images/b.png" class="img-fluid rounded-start d-none d-md-block" alt="...">
            </div>
            <div class="col-md-8 d-flex align-items-center">
              <div class="card-body">
                <h5 class="card-title">Become a seller</h5>
                <p class="card-text">Promote your handcrafted items and drive sales to grow your business..</p>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <div class="col-12 col-md-6 col-lg-4 mt-4 animate__animated animate__slideInUp">
        <div class="card-sub">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="images/c.png" class="img-fluid rounded-start d-none d-md-block" alt="...">
            </div>
            <div class="col-md-8 d-flex align-items-center">
              <div class="card-body">
                <h5 class="card-title">Support</h5>
                <p class="card-text">Buy artisans' handmade crafts and attend exciting events hosted by them. </p>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
</div>
  


   
<!-- Support our Makers -->

<section id="artisans" class="artisans section-bg">
  <div class="container my-4">

    <div class="row showcase gx-10 justify-content-evenly align-items-center">
      <div class="col-sm-12 col-md-6 col-lg-5 order-sm-1"> <img src="images/crochet.png" class="img-fluid mx-auto d-block"></div>
      <div class="col-sm-12 col-md-6 col-lg-7 order-md-1 d-flex justify-content-center flex-column"> 
        <h2>Support our Makers</h2>
        <p>
          Showcasing Adamson University's student artisans and craftsmen on a web-based social commerce site that provides a centralized platform where students can market their handicrafts or artworks by posting and listing their products on the web portal.
        </p>

        <div class="d-flex justify-content-center justify-content-lg-start">
          {{-- <a href="{{route('artisan')}}" class="btn-homepage-buttons scrollto">Discover Artisans</a> --}}
        </div>

        

      </div>
    </div>
    
  </div>
</section>


<!-- End of Support our Makers -->






      
<!-- Services -->

<div class="container my-5 text-center  animate__animated animate__slideInUp">
    <section id="services" class="services section-bg">
    
            <div class="container" data-aos="fade-up">
              <div class="services-title col-12">
                  <h2>Services</h2>
                  <p>Discover the diverse range of products and services we provide.</p>
                  <br>
              </div>
            </div>

            <div class="row">
                <div class="col-xl-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                <div class="icon-box">
                    <div class="icon"><i class="fa-solid fa-person-rays" style="color: #FFC107;"></i></div>
                    <h4>Artisan Profile</h4>
                    <p>Your online portfolio. Showcase your talent, share your story, and connect with a global audience.</p>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
                <div class="icon-box">
                    <div class="icon"><i class="fa-brands fa-rocketchat" style="color: #FFC107;"></i></div>
                    <h4>Instant Chat</h4>
                    <p>Instantly chat with Artisans and stay in touch throughout the whole transaction.</p>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
                <div class="icon-box">
                    <div class="icon"><i class="fa-regular fa-comments" style="color: #FFC107;"></i></div>
                    <h4>Community Building</h4>
                    <p>Join our thriving community of like-minded individuals committed to collaboration and support. </p>
                </div>
            </div>

            

            <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-4 mt-xl-4" data-aos="zoom-in" data-aos-delay="300">
              <div class="icon-box">
                  <div class="icon"><i class='fa-solid fa-store' style="color: #FFC107;"></i></div>
                  
                  <h4>Artisan Marketplace</h4>
                  <p>Discover and showcase handmade creations whether you're a buyer looking for handicrafts or a seller looking to reach a wider audience.</p>
              </div>
          </div>

          <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-4 mt-xl-4" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
                <div class="icon"><i class="fa-solid fa-chart-line" style="color: #FFC107;"></i></div>
                <h4>Dashboard</h4>
                <p>Take control and manage your transactions with our intuitive Dashboard feature. </p>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-4 mt-xl-4" data-aos="zoom-in" data-aos-delay="300">
          <div class="icon-box">
              <div class="icon"><i class="fa-regular fa-calendar-check " style="color: #FFC107;"></i></div>
              <h4>Event Hosting</h4>
              <p>Host unforgettable events with our Event Hosting feature. Events will captivate a wider audience, accessible to all. </p>
          </div>
      </div>

    </section>
  </div>
  








  <!-- Events -->

  <section id="artisans" class="artisans section-bg  animate__animated animate__slideInUp">
    <div class="container my-4 mb-lg-5">
      <div class="row showcase gx-10 justify-content-evenly align-items-center">
        <div class="col-sm-12 col-md-6 col-lg-5 order-sm-1"> <img src="images/event.png" class="img-fluid mx-auto d-block"></div>
        <div class="col-sm-12 col-md-6 col-lg-7 order-md-1 d-flex justify-content-center flex-column"> 
          <h2>Join Event</h2>
          <p>
          Experience our Artisan-hosted events, where you can shop for handmade crafts, attend tutorials, and join exciting workshops. Whether it's face-to-face booths or online sessions, enrich your journey with us!
          </p>
  
          {{-- <div class="d-flex justify-content-center justify-content-lg-start">
            @if(Auth::user() && Auth::user()->UserTypeID == 2)
          <a href="{{route('events')}}" class="btn-homepage-buttons scrollto">See Events</a>
          @elseif(Auth::user() && Auth::user()->UserTypeID == 3)
          <a href="{{route('Event.BuyerEvents')}}" class="btn-homepage-buttons scrollto">See Events</a>
          @else
          <a href="{{route('Event.BuyerEvents')}}" class="btn-homepage-buttons scrollto">See Events</a>
          @endif
            
          </div> --}}

          
  
        </div>
        
      </div>
      
    </div>
  </section>

  <!-- End of Events -->
  







<!-- About Us -->

<div class="about  animate__animated animate__slideInUp">
<section id="about" class=" section-bg">
  <div class="container">
    <div class="row col-12 text-left">
      <div class="col-sm-12 col-md-6 col-lg-6">
        <h2>About Us</h2>
        <p>
        We are a third-year IT college at Adamson University in Manila, Philippines. Our website aims to showcase talented artisans and help them reach a broader audience.
        </p>
      </div>
      <div class="col-sm-12 col-md-6 col-lg-6 ">
        <p>Get to know us and our core values. We prioritize transparency, excellence, and innovation, striving to exceed expectations and foster meaningful connections</p>

        <div class="d-flex justify-content-sm-start justify-content-lg-start justify-content-sm-center ">
          <a href="{{route('about')}}" class="btn-homepage-buttons scrollto">Learn more</a>
          
        </div>
      </div>

    </div>
  </div>
</section>
</div>









<!-- Connect with Community -->

<section id="artisans" class="artisans section-bg">
  <div class="container my-5">
    <div class="row showcase gx-10 justify-content-evenly align-items-center">
      <div class="col-sm-12 col-md-6 col-lg-5 order-sm-1"> <img src="images/community.png" class="img-fluid mx-auto d-block"></div>
      <div class="col-sm-12 col-md-6 col-lg-7 order-md-1 d-flex justify-content-center flex-column"> 
        <h2>Connect with Community</h2>
        <p>
          Showcasing Adamson University's student artisans and craftsmen on a web-based social commerce site that provides a centralized platform where students can market their handicrafts or artworks by posting and listing their products on the web portal.
        </p>

        <div class="d-flex justify-content-center justify-content-lg-start">
          <a href="{{route('community.visitor')}}" class="btn-homepage-buttons scrollto">Join Community Forum</a>
          
        </div>

        

      </div>
    </div>
    
  </div>
</section>





@yield('content')



<footer>
  {{-- @include('header_and_footer.footer') --}}
</footer>







</body>
</html>
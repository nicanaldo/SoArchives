<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home | SOARchives</title>

    {{-- Tab Logo --}}
    <link rel="shortcut icon" href="{{ asset('images/tab-logo.ico') }}" type="image/x-icon">

    {{-- CSS file under Public Folder --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

    <!-- Navbar -->
    @include('header_and_footer.header')

    <section id="artisans" class="artisans section-bg mb-5">
        <div class="container my-4">
            <div class="row showcase gx-10 justify-content-evenly align-items-center">
                <div class="col-sm-12 col-md-12 col-lg-6 order-md-1 d-flex flex-column">
                    <p style="color: #FFC107; font-weight: bold;">ADAMSON UNIVERSITY'S ARTISANS AND CRAFTSMEN</p>
                    <h1 style="text-align: start; padding-bottom: 0px;padding-top: 0px;font-size: 3.8rem;"
                        class="">
                        Discover. Connect. Support. SOARchives: Unveiling Adamsonian's Artistic Talent!
                    </h1>
                    <p>
                        Soarchives is the premier platform dedicated to spotlighting the exceptional talent of artisans
                        and craftsmen from Adamson University.
                    </p>
                    <div class="d-flex d-flex justify-content-center justify-content-lg-start">
                        <a href="" class="btn-homepage-buttons scrollto fw-normal">How this works?</a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 order-sm-1">
                    <img src="images/homepage.png" class="img-fluid mx-auto d-block" alt="Artisans">
                </div>
            </div>
        </div>
    </section>

    {{-- Sub Banner --}}
    <div class="container">
        <div class="row">

            <div class="col-12 col-md-6 col-lg-4 mt-4 animate__animated animate__slideInUp">
                <div class="card-sub">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="images/a.png" class="img-fluid rounded-start d-none d-md-block" alt="...">
                        </div>
                        <div class="col-md-8 d-flex align-items-center">
                            <div class="card-body p-3">
                                <h5 class="card-title">Showcase</h5>
                                <p class="card-text">Share your handmade creations and receive recognition for your
                                    craftsmanship.</p>
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
                            <div class="card-body p-3">
                                <h5 class="card-title">Become a seller</h5>
                                <p class="card-text">Promote your handcrafted items and drive sales to grow your
                                    business.</p>
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
                            <div class="card-body p-3">
                                <h5 class="card-title">Support</h5>
                                <p class="card-text">Buy artisans' handmade crafts and attend exciting events hosted by
                                    them. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




    {{-- Support our Makers --}}
    <section id="artisans" class="artisans section-bg">
        <div class="container my-4">

            <div class="row showcase gx-10 justify-content-evenly align-items-center">
                <div class="col-sm-12 col-md-6 col-lg-5 order-sm-1"> <img src="images/crochet.png"
                        class="img-fluid mx-auto d-block"></div>
                <div class="col-sm-12 col-md-6 col-lg-7 order-md-1 d-flex justify-content-center flex-column">
                    <h2>Support our Makers</h2>
                    <p>
                        Showcasing Adamson University's student artisans and craftsmen on a web-based social commerce
                        site that provides a centralized platform where students can market their handicrafts or
                        artworks by posting and listing their products on the web portal.
                    </p>

                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="" class="btn-homepage-buttons scrollto fw-normal">Discover Artisans</a>
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
                        <p>Your online portfolio. Showcase your talent, share your story, and connect with a global
                            audience.</p>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in"
                    data-aos-delay="200">
                    <div class="icon-box">
                        <div class="icon"><i class="fa-brands fa-rocketchat" style="color: #FFC107;"></i></div>
                        <h4>Instant Chat</h4>
                        <p>Instantly chat with Artisans and stay in touch throughout the whole transaction.</p>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in"
                    data-aos-delay="300">
                    <div class="icon-box">
                        <div class="icon"><i class="fa-regular fa-comments" style="color: #FFC107;"></i></div>
                        <h4>Community Building</h4>
                        <p>Join our thriving community of like-minded individuals committed to collaboration and
                            support. </p>
                    </div>
                </div>



                <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-4 mt-xl-4" data-aos="zoom-in"
                    data-aos-delay="300">
                    <div class="icon-box">
                        <div class="icon"><i class='fa-solid fa-store' style="color: #FFC107;"></i></div>

                        <h4>Artisan Marketplace</h4>
                        <p>Discover and showcase handmade creations whether you're a buyer looking for handicrafts or a
                            seller looking to reach a wider audience.</p>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-4 mt-xl-4" data-aos="zoom-in"
                    data-aos-delay="300">
                    <div class="icon-box">
                        <div class="icon"><i class="fa-regular fa-calendar-check " style="color: #FFC107;"></i>
                        </div>
                        <h4 class="d-inline-block">
                            Event Hosting
                            <span class="badge pro-badge ms-1 fs-6 align-middle">
                                <i class="fas fa-crown"></i> PRO
                            </span>
                        </h4>

                        <p>Host unforgettable events with our Event Hosting feature. Events will captivate a wider
                            audience, accessible to all. </p>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-4 mt-xl-4" data-aos="zoom-in"
                    data-aos-delay="300">
                    <div class="icon-box">
                        <div class="icon"><i class="fas fa-hand-sparkles" style="color: #FFC107;"></i></div>
                        <h4>Commend Artisans</h4>
                        <p>Show appreciation by our commend feature! Leave positive feedback and support their growth.</p>
                    </div>
                </div>


        </section>
    </div>









    <!-- Events -->

    <section id="artisans" class="artisans section-bg  animate__animated animate__slideInUp">
        <div class="container my-4 mb-lg-5">
            <div class="row showcase gx-10 justify-content-evenly align-items-center">
                <div class="col-sm-12 col-md-6 col-lg-5 order-sm-1"> <img src="images/event.png"
                        class="img-fluid mx-auto d-block"></div>
                <div class="col-sm-12 col-md-6 col-lg-7 order-md-1 d-flex justify-content-center flex-column">
                    <h2>Join Event</h2>
                    <p>
                        Experience our Artisan-hosted events, where you can shop for handmade crafts, attend tutorials,
                        and join exciting workshops. Whether it's face-to-face booths or online sessions, enrich your
                        journey with us!
                    </p>

                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="" class="btn-homepage-buttons scrollto fw-normal">See Events</a>

                    </div>

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
                            We are a third-year IT college at Adamson University in Manila, Philippines. Our website
                            aims to showcase talented artisans and help them reach a broader audience.
                        </p>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 ">
                        <p>Get to know us and our core values. We prioritize transparency, excellence, and innovation,
                            striving to exceed expectations and foster meaningful connections</p>

                        <div
                            class="d-flex justify-content-sm-start justify-content-lg-start justify-content-sm-center ">
                            <a href="/about" class="btn-homepage-buttons scrollto fw-normal">Learn more</a>

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
                <div class="col-sm-12 col-md-6 col-lg-5 order-sm-1"> <img src="images/community.png"
                        class="img-fluid mx-auto d-block"></div>
                <div class="col-sm-12 col-md-6 col-lg-7 order-md-1 d-flex justify-content-center flex-column">
                    <h2>Connect with Community</h2>
                    <p>
                        Showcasing Adamson University's student artisans and craftsmen on a web-based social commerce
                        site that provides a centralized platform where students can market their handicrafts or
                        artworks by posting and listing their products on the web portal.
                    </p>

                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="" class="btn-homepage-buttons scrollto fw-normal">Join Community Forum</a>

                    </div>

                </div>
            </div>

        </div>
    </section>





    @yield('content')



    <footer>
        @include('header_and_footer.footer')
    </footer>




    <!-- Categories JS Toggle -->
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>



</body>

</html>

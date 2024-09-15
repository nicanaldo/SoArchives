<!-- Footer -->
<footer class="text-center text-lg-start bg-body-tertiary text-muted">
    <section class="d-flex justify-content-center justify-content-lg-between p-3 border-bottom">
    </section>

    <style>
        /* Footer */
        .footer {
            background-color: #145DA0;
            display: block;
        }

        .container-footer .container-fluid {
            padding-left: 0;
            padding-right: 0;
        }

        .text-muted h6 {
            color: #145DA0;
        }

        .text-muted h6, .text-muted {
            text-decoration: none;
            font-weight: 400;
        }

        /* Responsive styling */
        @media (max-width: 576px) {
            .footer .row {
                text-align: center;
            }
            .footer .col-md-3 {
                margin-bottom: 1rem;
            }
            .footer .contact p {
                margin-bottom: 0.5rem;
            }
        }

        @media (min-width: 576px) and (max-width: 992px) {
            .footer .row {
                justify-content: center;
            }
        }
    </style>

    <!-- Section: Links  -->
    <section>
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3" data-aos="zoom-in">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <!-- Content -->
                    <h6 class="text-uppercase">
                        <i><img src="{{ asset('images/finallogo.png') }}" alt="" width="150" height="40" class="d-inline-block align-text-center mb-2"></i>
                    </h6>
                    <p class="text-muted">
                        Join Handmade Haven today and experience the best of social commerce for handmade treasures!
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4 mt-2 pt-2">
                        Marketplace
                    </h6>
                    <p>
                        <a href="{{ route('artisan') }}" class="text-muted">Artisans</a>
                    </p>
                    <p>
                        <a href="#!" class="text-muted">Services</a>
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4 mt-2 pt-2">
                        For Artisans
                    </h6>
                    <p>
                        <a href="{{ route('register.seller') }}" class="text-muted">Become a seller</a>
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4 mt-2 pt-2">
                        Contact
                    </h6>
                    <div class="contact text-muted">
                        <p>
                            <a>Manila, Philippines</a>
                        </p>
                        <p>
                            <a>soarchives11@gmail.com</a>
                        </p>
                    </div>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>

    <!-- Copyright -->
    <div class="container-footer">
        <footer class="footer text-light text-center py-2">
            <div class="container-fluid">
                <p style="margin-bottom: 0px;">&copy; 2024 SOARchives. All rights reserved.</p>
            </div>
        </footer>
    </div>
</footer>

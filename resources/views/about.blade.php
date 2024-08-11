<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>

    <link href="/bootstrap-5.3.3-dist/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />



    <!-- to work the toggle in the navbar -->
  
   

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <!-- soarchive file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/regular.min.css" integrity="sha512-KYEnM30Gjf5tMbgsrQJsR0FSpufP9S4EiAYi168MvTjK6E83x3r6PTvLPlXYX350/doBXmTFUEnJr/nCsDovuw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

<!-- for the toggle to work -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    

<header>
    @include('header_and_footer.header')
</header>

<div class="about-title mt-5">
    <h1>Hello, We are the Developers.</h1>
    <p class="text-center mb-5">a little bit about us and what matters to us</p>
</div>

<div class="container  animate__animated animate__slideInUp ">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <div class="col about-card">
                <div class="card h-100 border-0 custom-shadow">
                    <img src="images/jenn.png" class="card-img-top " alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Jenny Marinay</h5>
                        <p class="card-text text-muted">Frontend Developer</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 border-0 custom-shadow">
                    <img src="images/naldo.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Janica Naldo</h5>
                        <p class="card-text text-muted">Frontend Developer</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 border-0 custom-shadow">
                    <img src="images/kylie.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Christine Kylie Oroga</h5>
                        <p class="card-text text-muted">Backend Developer</p>
                    </div>
                </div>
            </div>

        <div class="col">
            <div class="card h-100 border-0 custom-shadow">
                <img src="images/abbeyA.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Maria Isabel Santos</h5>
                    <p class="card-tex text-muted">Backend Developer</p>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- nica -->

<div class="about-title" style="margin-top: 7rem;">
    <h1>Behind this Project...</h1>
    <p class="text-center mb-5">We developed this project to give recognitions to the artisans of Adamson University</p>
</div>

<div class="container  animate__animated animate__slideInUp ">
    <div class="row row-cols-1 row-cols-lg-2">
        <!-- Mission Card -->
       
        <div class="col">
            <div class="card mb-3 border-0 custom-shadow">
                <div class="card-body p-4">
                    <h5 class="card-title">Mission</h5>
                    <p class="card-text">At our core, we are committed to celebrating and promoting the art of artisanal craftsmanship. We strive to provide a supportive and inspiring environment where artisans can showcase their talents, connect with a community that values their work, and grow both personally and professionally.</p>
                </div>
            </div>
        </div>


        <!-- Vision Card -->
        <div class="col">
            <div class="card mb-5 border-0 custom-shadow">
                <div class="card-body p-4">
                    <h5 class="card-title">Vision</h5>
                    <p class="card-text">At our core, we are committed to celebrating and promoting the art of artisanal craftsmanship. We strive to provide a supportive and inspiring environment where artisans can showcase their talents, connect with a community that values their work, and grow both personally and professionally.</p>
                </div>
            </div>
        </div>
    </div>
</div>


@yield('content')


<footer>
    @include('header_and_footer.footer')
</footer>







</body>
</html>
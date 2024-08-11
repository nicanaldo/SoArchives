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
  <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
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


 <!-- Profile pic -->
 <div class="container d-flex justify-content-center align-items-center">
  <div class="img__container">
    <img src="{{ asset('images/default.png') }}" alt="..." class="border-white thick-border" style="width:250px; height: 250px; margin-top: -100px; border-radius: 100%; object-fit: cover; margin-left:15px" />
    <span></span>
  </div> 
</div>

  <!-- Tags -->
  <div class="name text-center">
    <h2 class="card-title text-center" style="margin-top: 1rem; color:#343434;">
        {{ auth()->user()->FName }} {{ auth()->user()->LName }}
    </h2>
    <p class="text-muted" style="margin-bottom: 1rem; padding-bottom:3rem; padding-top: 10px;">Member since 2021</p>
  </div>



  <div class="container text-center mt-5 pb-5">
    <button type="button" class="btn btn-danger btn-md"><i class="fas fa-exclamation-circle" style="margin-right: 5px;"></i>Report this user</button>
    <button type="button" class="btn btn-warning btn-md"><i class="fas fa-pencil-alt" style="margin-right: 5px;"></i>Write a review</button>
  </div>
  
</div>
  

<!-- Feedbacks -->
<div class="container">
  <div class="feedbacks mt-5">
    <h2 style="color: #145DA0;">Feedbacks</h2>
  </div>
</div>

<div class="container custom-shadow mt-5 p-3">
  <div class="row">
    <div class="col-12">
      <br>
      <p>"Thank you for being such a fantastic buyer! Your appreciation for our handicrafts truly shines through in your thoughtful selection and support. We're thrilled to have connected with someone who values craftsmanship and creativity as much as we do. Looking forward to serving you again soon!"</p>
      <p class="text-muted">- Abbey Santos </p>
    </div>
  </div>
</div>

<div class="container custom-shadow mt-5 p-3 mb-5">
  <div class="row">
    <div class="col-12">
      <br>
      <p>"Working with you has been an absolute pleasure. Your enthusiasm for our handicrafts is infectious, and it's truly gratifying to see them find a home with someone who appreciates their beauty and craftsmanship. Thank you for being such a wonderful supporter of our work. We're already looking forward to our next opportunity to create something special for you!"</p>
      <p class="text-muted">- Sooyoung Ha </p>
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

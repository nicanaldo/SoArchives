<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Forum</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>

<header>
    @include('header_and_footer.header')
</header>

<div class="row">
    <div class="col-md-12 text-center">
        <h3 class="card-title1 mt-2 mb-3">Welcome to Community Forum</h3>
        <img src="{{asset('images/community1.jpg')}}" class="img-fluid" alt="Community Image">
    </div>
</div>



{{-- <footer>
    @include('header_and_footer.footer')
</footer> --}}


<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>
</body>
</html>



<style>
    #postInput {
        height: 50px;
        border: 1px solid;
    }
    #text-center {
        font-family: Helvetica;
        color: #05A6ED;
        font-size: 35px;
        font-weight: bolder;
        height: 500px;
    }
    .form-group textarea {
        border: 1px solid;
    }
    .card{
        border: 1px solid;
    }
    .card-title1 {
        font-family: 'Helvetica', sans-serif;
        color: #05A6ED;
        text-align: center;
        font-weight: bolder;
        text-decoration: none;
    }
    .custom-button {
    margin-right: 10px;
    }
</style>

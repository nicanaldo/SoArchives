<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buttons</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/main.css">


<style>
  .nav-item {
            margin: 0 10px;
        }
        .nav-link.custom-button:hover {
            background-color: #0cb2b2;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .nav-link.custom-button i {
            font-size: 20px;
            margin-right: 8px;
        }
  .navbar-toggler {
    border: none; 
  }

.navbar{
    padding-top: 1rem;
    padding-bottom: 1rem;
    border: none;
}

.navbar-brand a{
  color: #145DA0;
}

.navbar-light .navbar-brand  {
  color: #145DA0;
}

.navbar-toggler:focus {
    outline: none;
    box-shadow: none;
}

.custom-nav-link {
  background-color: palevioletred;
  padding: 10px;
  border-radius: 5px;
  text-align: center;
}

.custom-button {
  background-color: #a4eeee;
  color: white;
  padding: 10px 20px;
  border-radius: 20px;
  text-align: center;
  display: inline-block;
  border: none;
}

</style>

</head>

<body>


@csrf

<nav class="navbar navbar-expand-lg navbar-light bg-transparent">
  <div class="container">
      <ul class="navbar-nav mx-auto">


  
        <li class="nav-item">
          <a class="nav-link custom-button" href="{{ route('events')}}">
          <i class="fa fa-calendar me-2"></i> Events</a>
        </li>

        <li class="nav-item">
          <a class="nav-link custom-button" href="{{ route('gallery') }}">
          <i class="fa fa-image me-2"></i> Gallery</a>
        </li>
        
      </ul>
      
    
  </div>
</nav> 

 
</body>
</html>
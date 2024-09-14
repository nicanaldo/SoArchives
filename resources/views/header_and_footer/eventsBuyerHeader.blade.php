<link rel="stylesheet" href="css/main.css">


<style>
  .navbar-toggler {
    border: none; /* Remove the border */
  }

  /* Navbar */
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
    outline: none; /* Remove the outline */
    box-shadow: none; /* Remove the box-shadow */
}

.custom-nav-link {
  background-color: palevioletred;
  padding: 10px;
  border-radius: 5px;
  text-align: center;
}

.custom-button {
  background-color: #17c8c8;
  color: white;
  padding: 10px 20px;
  border-radius: 20px;
  text-align: center;
  display: inline-block;
  border: none;
}

</style>


@csrf

<nav class="navbar navbar-expand-lg navbar-light bg-transparent">
  <div class="container">
      <ul class="navbar-nav mx-auto">


  
        <li class="nav-item" style="width: 90px;">
          <a class="nav-link custom-button" href="{{ route('Event.BuyerEvents')}}">
          <i class="fa fa-calendar me-2"></i> Events</a>
        </li>

        <li class="nav-item" style="width: 90px;">
          <a class="nav-link custom-button" href="{{ route('galleryBuyer') }}">
          <i class="fa fa-image me-2"></i> Gallery</a>
        </li>
        
      </ul>
      
    
  </div>
</nav> 

 

  
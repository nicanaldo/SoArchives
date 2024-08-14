<link href="{{asset('css/maindash.css')}}" rel="stylesheet">

<!DOCTYPE html> 
<html lang="en"> 

<head> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<meta charset="UTF-8"> 
	<meta http-equiv="X-UA-Compatible"
		content="IE=edge"> 
	<meta name="viewport"
		content="width=device-width, 
				initial-scale=1.0"> 
	<title>Dashboard</title> 
	<link rel="stylesheet"
		href="style.css"> 
	{{-- <link rel="stylesheet" href="responsive.css">  --}}
</head> 

<body> 

 <!-- Edit profile Modal -->
 <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="username" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="username">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="username">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Email</label>
                            <input type="text" class="form-control" id="username">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Password</label>
                            <input type="text" class="form-control" id="username">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
     <!-- End modal edit profile-->

	
	<header> 
		
	 @include('admin.header')
	</header> 

	<div class="main-container"> 
		<div class="navcontainer"> 
			<nav class="nav"> 
				<div class="nav-upper-options"> 
					<div class="nav-option option1"> 
                    <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/dashboard.png" alt="dashboard"/>
                    <h3 style="font-size: 15px; color: #F3F5FA; font-family: Helvetica; margin-top: 10px;">Dashboard</h3>
					</div> 

					<div class="option2 nav-option"> 
                    <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/paycheque.png" alt="paycheque"/>
						<h3 style="font-size: 15px; color: #F3F5FA; font-family: Helvetica; margin-top: 10px;"> Earnings</h3> 
					</div> 

					<div class="nav-option option3"> 
                    <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/reseller.png" alt="reseller"/>
						<h3 style="font-size: 15px; color: #F3F5FA; font-family: Helvetica; margin-top: 10px;"> Sellers</h3> 
					</div> 

					<div class="nav-option option4"> 
                    <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/budget.png" alt="budget"/>
						<h3 style="font-size: 15px; color: #F3F5FA; font-family: Helvetica; margin-top: 10px;"> Buyers</h3> 
                
					</div> 

					<div class="nav-option option5"> 
                    <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/package.png" alt="package"/>
						<h3 style="font-size: 15px; color: #F3F5FA; font-family: Helvetica; margin-top: 10px;"> Products</h3> 
					</div> 

					<div class="nav-option option6"> 
                    <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/event-accepted.png" alt="event-accepted"/>
						<h3 style="font-size: 15px; color: #F3F5FA; font-family: Helvetica; margin-top: 10px;"> Events</h3> 
					</div> 

					<div class="nav-option logout"> 
                    <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/guarantee--v1.png" alt="guarantee--v1"/>
						<h3 style="font-size: 15px; color: #F3F5FA; font-family: Helvetica; margin-top: 10px;">Subscription</h3> 
					</div> 

				</div> 
			</nav> 
		</div> 
		<div class="main"> 


			<div class="box-container"> 

				<div class="box box1"> 
					<div class="text"> 
						<h2 class="topic-heading" style="font-size: 40px; color: #F3F5FA; font-family: Helvetica; font-weight: normal;">₱ 0</h2> 
						<h3 style="font-size: 15px; color: #F3F5FA; font-family: Helvetica;  font-weight: normal;"> Earnings</h3> 
					</div> 
                    <img width="50" height="40" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/dashboard.png" alt="dashboard"/>
				</div> 

				<div class="box box2"> 
					<div class="text"> 
					<h2 class="topic-heading" style="font-size: 40px; color: #F3F5FA; font-family: Helvetica; font-weight: normal;">{{$sellersCount}}</h2> 
						<h3 style="font-size: 15px; color: #F3F5FA; font-family: Helvetica; font-weight: normal;"> Sellers</h3> 
					</div> 
                    <img width="50" height="40" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/paycheque.png" alt="paycheque"/>
				</div> 

				<div class="box box3"> 
					<div class="text"> 
						<h2 class="topic-heading" style="font-size: 40px; color: #F3F5FA; font-family: Helvetica; font-weight: normal;">{{$buyersCount}}</h2> 
						<h3 style="font-size: 15px; color: #F3F5FA; font-family: Helvetica; font-weight: normal;"> Buyers</h3> 
					</div> 
                    <img width="50" height="40" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/budget.png" alt="budget"/>
				</div> 

				<div class="box box4"> 
					<div class="text"> 
					<h2 class="topic-heading" style="font-size: 40px; color: #F3F5FA; font-family: Helvetica; font-weight: normal;">{{$productsCount}}</h2> 
						<h3 style="font-size: 15px; color: #F3F5FA; font-family: Helvetica; font-weight: normal;"> Products</h3> 
					</div> 
                    <img width="50" height="40" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/package.png" alt="package"/>
				</div> 
			
                <div class="box box5"> 
					<div class="text"> 
						<h2 class="topic-heading" style="font-size: 40px; color: #F3F5FA; font-family: Helvetica; font-weight: normal;">{{$eventsCount}}</h2> 
						<h3 style="font-size: 15px; color: #F3F5FA; font-family: Helvetica; font-weight: normal;"> Events</h3> 
					</div> 
                    <img width="50" height="40" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/event-accepted.png" alt="event-accepted"/>
				</div> 
			
                <div class="box box6"> 
					<div class="text"> 
						<h2 class="topic-heading" >0</h2> 
						<h3 style="font-size: 15px; color: #F3F5FA; font-family: Helvetica; font-weight: normal;" >Subscription</h3> 
					</div> 
                    <img width="50" height="40" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/guarantee--v1.png" alt="guarantee--v1"/>
				</div> 
			</div> 

            
	<script>

		// <!-- MODAL -->

		//Main Dash option
		document.querySelector(".option1").addEventListener("click", function() {
    	window.location.href = "dashboard";
		});

		
		//Earnings option
		// document.querySelector(".option2").addEventListener("click", function() {
    	// window.location.href = "earnings";
		// });

		// Seller option
		document.querySelector(".option3").addEventListener("click", function() {
    	window.location.href = "listseller";
		});

		//Buyers option
		document.querySelector(".option4").addEventListener("click", function() {
    	window.location.href = "listbuyer";
		});


		//Products option
		document.querySelector(".option5").addEventListener("click", function() {
    	window.location.href = "listproducts";
		});

	
		// Events option
		document.querySelector(".option6").addEventListener("click", function() {
    	window.location.href = "listevent";
		});

			// <!-- END OF MODAL -->



			// <!-- BOX DASH -->

		//seller box
		document.querySelector(".box2").addEventListener("click", function() {
    	window.location.href = "listseller";
		});

		//buyer box
		document.querySelector(".box3").addEventListener("click", function() {
    	window.location.href = "listbuyer";
		});

		//products box
		document.querySelector(".box4").addEventListener("click", function() {
    	window.location.href = "listproducts";
		});

		//events box
		document.querySelector(".box5").addEventListener("click", function() {
    	window.location.href = "listevent";
		});
	</script> 

            

			
	<script src="./index.js"></script> 
</body> 
</html>


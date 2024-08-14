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
	<title>Events</title> 
	<link rel="stylesheet"
		href="style.css"> 
	<link rel="stylesheet"
		href="responsive.css"> 

		 
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


 <!-- Delete modal -->
 @foreach ($events as $eventitem)
 <div class="modal fade" id="deleteModal{{ $eventitem->EventID }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h2 class="modal-title fs-5" id="deleteModalLabel">Delete item?</h2>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                              Are you sure you want to delete? This action cannot be undone.
                                          </div>
                                          <div class="modal-footer">
										  <form id="delete-form-{{ $eventitem->EventID}}" action="{{ route('event.destroy', ['event' => $eventitem->EventID ]) }}" method="POST">
											@csrf
											@method('DELETE')
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
											<button type="submit" class="btn btn-primary">Yes</button>
											</form>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <script>
                                  function deleteEvent(evendId) {
                                      // Submit the form corresponding to the productId
                                      document.getElementById('delete-form-' + eventId).submit();
                                  }
                              </script>
                 @endforeach  
             <!-- End Delete Modal -->
	
	<!-- for header part -->
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

					<div class="nav-option option4" id="buyers"> 
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
		<div class="container">
        <h2 style="margin-left: 8px;">Events</h2>
		<table class="table" style="margin-left: 8px; margin-top: 30px;">
			<thead class="table-light">

                <tr>
                    <th>ID</th>
                    <th>Event Name</th>
        			<th >Description</th>
                    <th>Start Time </th>
                    <th>Location </th>
                    <th>End TIme</th>
                    <th style="width: 100px;">Date</th>
                    <th>Link</th>
                    <th>Event Image</th>
					<th>Status</th>
					<th>Action</th>

                </tr>
            </thead>
            <tbody>
			@foreach ($events->reverse() as $eventitem)
		
				<tr>	
					<td>{{ $eventitem->EventID }}</td>
					<td>{{ $eventitem->EventName }}</td>
					<td>{{ $eventitem->Description }}</td>
					<td>{{ $eventitem->StartTime }}</td>
					<td>{{ $eventitem->Location }}</td>
					<td>{{ $eventitem->EndTime }}</td>
					<td>{{ $eventitem->Date }}</td>
					<td>
						<div class="link-wrapper">
							{{ $eventitem->Link }}
						</div>
                    </td>
					<td> @if($eventitem->EventImage)
						<img src="{{ asset('storage/' . $eventitem->EventImage) }}" alt="Event Image" width="100" height="100">
					@else
						<p>No image available</p>
					@endif</td>					
					<td>
						@if ( $eventitem->Status == 'Accepted')
						<span style="color:#145DA0; font-weight:600; ">Accepted</span>

						@endif
						@if ( $eventitem->Status == 'Rejected')
						<span style="color:red; font-weight:600;">Rejected</span>

						@endif
						@if ( $eventitem->Status == 'Pending')
						<span style="color:#ffc107; font-weight:600;">Pending</span>

						@endif
						
						@if ( $eventitem->Status == 'Ended')
						<span style="color:#71706e; font-weight:600;">Ended</span>

						@endif
					
					</td>

					<td>
					<div class="d-flex justify-content-between" >
						<form method="POST" action="{{ url('accept_event', $eventitem->EventID) }}">
							@csrf
							<button type="submit" class="btn btn-primary" style=" margin-right: 5px; padding: 0.1rem 0.2rem; font-size: 0.6rem;">Accept</button>
						</form>

						<form method="POST" action="{{ url('reject_event', $eventitem->EventID) }}">
							@csrf
							<button type="submit" class="btn btn-danger" style=" margin-right: 5px; padding: 0.1rem 0.3rem; font-size: 0.6rem;">Reject</button>
						</form>

							<button href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{  $eventitem->EventID }}" style="margin-right: 2px; padding: 0.1rem 0.10rem; font-size: 0.6rem; width: 50px;">Delete</button>
					</div>
				</td>
				</tr>
				@endforeach

            </tbody>
        </table>
    </div>
</div>

	<script>
		/// <!-- MODAL -->

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
	</script> 

	
</body> 
</html>
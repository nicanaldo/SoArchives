<!DOCTYPE html> 
<html lang="en"> 

<head> 
<link href="{{asset('css/maindash.css')}}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


	<meta charset="UTF-8"> 
	<meta http-equiv="X-UA-Compatible"
		content="IE=edge"> 
	<meta name="viewport"
		content="width=device-width, 
				initial-scale=1.0"> 
	<title>Seller</title> 
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
@foreach ($users as $item)
    @if ($item->UserTypeID === 2)
        <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                    <form id="delete-form-{{ $item->id }}" method="POST" action="{{ route('sellers.destroy', ['user' => $item->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this buyer?');">Yes</button> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
<!-- End Modal delete-->


	
<!-- Edit Modal -->
@foreach ($users as $item)
    @if ($item->UserTypeID === 2)
        <div class="modal fade" id="editModalbuyer{{ $item->id }}" tabindex="-1" aria-labelledbsy="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('sellers.update', ['user' => $item->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <!-- Form for editing product content -->
                            <div class="mb-3">
                                <label for="fname" class="form-label">First Name</label>
                                <input type="text" name="FName" class="form-control" id="fname" value="{{$item->fname}}"  >
                            </div>
                            <div class="mb-3">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" name="LName" class="form-control" id="lname" value="{{$item->lname}}"  >
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" class="form-control" id="email" value="{{$item->email}}"  >
                            </div>
                            <div class="mb-3">
                                <label for="violation" class="form-label">Violation</label>
                                <input type="text" name="violation" class="form-control" id="violation" value="{{$item->Violation}}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endforeach
<!-- End Modal edit -->

    
                            
<!-- Modal View -->
@foreach ($users as $item)
    @if ($item->UserTypeID === 2)
        <div class="modal fade" id="viewModal{{ $item->id }}" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="font-family: Arial, sans-serif; font-size: 15px;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewModalLabel">Seller Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('sellers.get', ['user' => $item->id]) }}">
                            @csrf
                            @method('GET')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">ID</label>
                                    <input id="userID" type="text" class="form-control border" value="{{ $item->id }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Violation</label>
                                    <input id="violation" type="text" class="form-control" value="{{ $item->Violation }}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">First Name</label>
                                    <input id="firstName" type="text" class="form-control" value="{{ $item->fname }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Last Name</label>
                                    <input id="lastName" type="text" class="form-control" value="{{ $item->lname }}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Email</label>
                                    <input id="email" type="text" class="form-control" value="{{ $item->email }}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Created At</label>
                                    <input id="created" type="text" class="form-control" value="{{ $item->created_at }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Updated At</label>
                                    <input id="update" type="text" class="form-control" value="{{ $item->updated_at }}" readonly>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
<!-- for header part -->

	<header> 
    @include('admin.header')


    
	</header> 


    <div class="main-container"> 
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
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
        <h2 style="margin-left: 8px;">Sellers</h2>  
        <table id="datatable" class="table" style="margin-left: 8px; margin-top: 30px;" >
            <thead class="table-light">
                <tr>
                    <th  >ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th >Violation</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users->reverse() as $item)
                    @if ($item->UserTypeID === 2)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->fname }}</td>
                            <td>{{ $item->lname }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <div class="link-wrapper" style="margin-left:40px;">
                                    {{ $item->password }}
                                </div>
                            <td>
                                @foreach ($sellers as $seller)
                                    @if ($seller->user_id === $item->id)
                                        {{ $seller->Violation }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                    <button href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal{{ $item->id }}" style="margin-right: 2px; padding: 0.1rem 0.9rem; font-size: 0.6rem; width: 50px; " modal-backdrop="static">View</button>
                                    <button href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editModalbuyer{{ $item->id }}" style="margin-right: 2px; padding: 0.1rem 0.9rem; font-size: 0.6rem; width: 50px;">Edit</button>
                                    <button href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}" style="margin-right: 2px; padding: 0.1rem 0.10rem; font-size: 0.6rem; width: 50px;">Delete</button>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>


 

     
                    

                       

                    
    
        



        <script>


        //Sellers option
		document.querySelector(".option3").addEventListener("click", function() {
    	window.location.href = "listseller";
		});

        
        //Products option
		document.querySelector(".option5").addEventListener("click", function() {
    	window.location.href = "listproducts";
		});

		//Buyers option
		document.querySelector(".option4").addEventListener("click", function() {
    // Redirect to the desired page
    	window.location.href = "listbuyer";
		});

        // Dashboard option
		document.querySelector(".option1").addEventListener("click", function() {
    	window.location.href = "dashboard";
		});

		//Events option
		document.querySelector(".option6").addEventListener("click", function() {
    	window.location.href = "listevent";
		});
	</script> 




</body> 
</html>

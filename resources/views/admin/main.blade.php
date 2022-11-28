@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Home</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partials.alert')
                </div>
            </div>

			<div class="row">
				<div class="col-md-8">
					<div class="col-md-12"> 
						<div class="card">
							<div class="card-header bg-dark">
								<h3 class="card-title"><i class="fa fa-bolt"></i> Quick Access</h3>
							</div>

							<div class="card-body bg-light">
								<div class="row justify-content-center p-1 text-white">
									
									<div class="col-12 text-white mb-3">
										<a class="btn btn-success btn-sm col-md-2 col-12"><i class="fa fa-play mr-1"></i> Start Production</a>
									</div>
										
									<!-- <div class="col-3 bg-info border border-light rounded">
										<a href="{{ action('SalesController@main') }}" class="btn btn-info" width="100vw" height="100vh"><i class="nav-icon fas fa-cash-register"></i></a></button><br><small>Point of Sale</small>
									</div>
									<div class="col-3 bg-info border border-light rounded">
										<a href="{{ action('ProductController@manage') }}" class="btn btn-info" width="100vw" height="100vh"><i class="fa fa-box-open"></i></a></button><br><small>Products</small>
									</div>
									<div class="col-3 bg-info border border-light rounded">
										<a href="{{ action('SupplierController@manage') }}" class="btn btn-info" width="100vw" height="100vh"><i class="fa fa-warehouse"></i></a></button><br><small>Suppliers</small>
									</div>
									<div class="col-3 bg-info border border-light rounded">
										<a href="{{ action('SalesController@main') }}" class="btn btn-info" width="100vw" height="100vh"><i class="nav-icon fa fa-bar-chart"></i></a></button><br><small>Sales Report</small>
									</div>
									<div class="col-3 bg-info border border-light rounded">
										<a href="{{ action('ProductionController@tank') }}" class="btn btn-info" width="100vw" height="100vh"><i class="nav-icon fa fa-gas-pump"></i></a></button><br><small>Tank</small>
									</div>
									<div class="col-3 bg-info border border-light rounded">
										<a href="{{ action('ProductionController@manage') }}" class="btn btn-info" width="100vw" height="100vh"><i class="nav-icon fas fa-pallet"></i></a></button><br><small>Production</small>
									</div>
									<div class="col-3 bg-info border border-light rounded">
										<a href="{{ action('UserController@user') }}" class="btn btn-info" width="100vw" height="100vh"><i class="fa fa-id-card"></i></a></button><br><small>Users</small>
									</div>
									<div class="col-3 bg-info border border-light rounded">
										<a href="{{ action('CustomerController@manage') }}" class="btn btn-info" width="100vw" height="100vh"><i class="nav-icon fas fa-user-tag"></i></a></button><br><small>Customers</small>
									</div>
									
									<a class="btn btn-info rounded-circle mr-1" width="100vw" height="100vh"><i class="fa fa-box-open"></i></a>
									<a class="btn btn-info rounded-circle mr-1" width="100vw" height="100vh"><i class="fa fa-warehouse"></i></a>
									<a class="btn btn-info rounded-circle mr-1" width="100vw" height="100vh"><i class="fa fa-address-card"></i></a>
									<a class="btn btn-info rounded-circle mr-1" width="100vw" height="100vh"><i class="fa fa-users"></i></a><br> -->

								</div>
							</div>
						</div>
					</div>

					<div class="col-md-12"> 
						<div class="card">
							<div class="card-header">
								<h3 class="card-title"><i class="fa fa-bullhorn"></i> News and Announcements</h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
								</div>
							</div>

							<div class="card-body">
								<div class="timeline">
									<div class="time-label">
										<span class="text-gray ml-4"><i class="fa fa-thumbtack"></i></span>
										<button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#createNews"><i class="fa fa-pen mr-2"></i>Compose</button>
									</div>
									<div>
										<i class="fas fa-newspaper bg-blue"></i>
										<div class="timeline-item">
											<span class="time"><i class="fas fa-clock"></i> 6 days ago</span>
											<h3 class="timeline-header"><strong>Welcome</strong></h3>
											<div class="timeline-body">
												<div class="thumbnail">
													<div class="caption ml-3 mt-3">
														<p>Hello, everyone!.</p>
													</div>
													<div class="col-12 text-center">
														<a href="{{-- asset('images/news/' . $news_item->nws_image) --}}">
															<img src="{{ asset('img/landing/logo-1.png') }}" alt="ss" style="width:50%"/>
														</a>
													</div>
												</div>
											</div>
											<div class="timeline-footer">
													<a style="color:#dc3545;" href="javascript:void(0)" data-toggle="modal" data-target="#removeNews"><i class="fa fa-trash"></i></a>
											
											</div>
										</div>
										<div class="modal fade" id="removeNews">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title">Confirm Deletion</h4>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													</div>
													<div class="modal-body">
														<p>Are you sure you want to delete this news/announcement?</p>
													</div>
													<div class="modal-footer justify-content-between">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														<a class="btn btn-danger btn-sm" href=""><i class="fa fa-trash"></i> Delete</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-4"> 
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-clock"></i> Production Summary</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <!-- Opening -->
                        <div class="card-body" style="overflow-x:auto;">
                            <div class="row mb-3">
                                <div class="col-7">
                                    <small class="text-success">Opening Operations</small>
                                </div>
                            </div>
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="50px">#</th>
                                        <th>Tank Name</th>
                                        <th>Time Start</th>
                                        <th>Tank Opening</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl-products">
                                    <tr>
                                        <td class="text-danger">1</td>
                                        <td>Tank 1</td>
                                        <td>6:00 AM</td>
                                        <td>5000 kgs</td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <hr>
                        <!-- Closing -->
                        <div class="card-body" style="overflow-x:auto;">
                            <div class="row mb-3">
                                <div class="col-8">
                                    <small class="text-danger">Closing Operations</small>
                                </div>
                            </div>
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="50px">#</th>
                                        <th>Tank Name</th>
                                        <th>Time End</th>
                                        <th>Tank Closing</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl-products">
                                    <tr>
                                        <td class="text-danger">1</td>
                                        <td>Tank 1</td>
                                        <td>3:00 PM</td>
                                        <td>2567 kgs</td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
	</section>

	<div class="modal fade" id="createNews">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Compose Announcement</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<form action="" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
					<div class="modal-body">
						<div class="form-group">
							<div class="row">
								<div class="col-md-12 mb-3">
									<label for="nws_title">Title <span style="color:red;">*</span></label>
									<input type="text" class="form-control" id="nws_title" name="nws_title" placeholder="Title" value="" required>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 mb-3">
									<label for="nws_content">Message Content <span style="color:red;">*</span></label>
									<textarea class="form-control" id="nws_content" name="nws_content" rows="4"></textarea>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 mb-3"> 
									<label for="nws_image">Image</label>
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="nws_image" name="nws_image" value="" aria-describedby="inputGroupFileAddon01">
										<label class="custom-file-label" for="nws_image">Choose file</label>
									</div>
									<small id="fileHelp" class="form-text text-muted">Please upload a valid image file in jpg or png format. Size of image should not be more than 1MB.</small>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary"><span class="fas fa-save"></span> Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

<script>
	var myInput = document.getElementById("new_password");
	var letter = document.getElementById("letter");
	var capital = document.getElementById("capital");
	var number = document.getElementById("number");
	var length = document.getElementById("length");

	// When the user clicks on the password field, show the message box
	myInput.onfocus = function() {
		document.getElementById("message").style.display = "block";
	}

	// When the user clicks outside of the password field, hide the message box
	myInput.onblur = function() {
		document.getElementById("message").style.display = "none";
	}

	// When the user starts to type something inside the password field
	myInput.onkeyup = function() {
	// Validate lowercase letters
		var lowerCaseLetters = /[a-z]/g;
		if(myInput.value.match(lowerCaseLetters)) {  
			letter.classList.remove("invalid");
			letter.classList.add("valid");
		} else {
			letter.classList.remove("valid");
			letter.classList.add("invalid");
		}
		
		// Validate capital letters
		var upperCaseLetters = /[A-Z]/g;
		if(myInput.value.match(upperCaseLetters)) {  
			capital.classList.remove("invalid");
			capital.classList.add("valid");
		} else {
			capital.classList.remove("valid");
			capital.classList.add("invalid");
		}

		// Validate numbers
		var numbers = /[0-9]/g;
		if(myInput.value.match(numbers)) {  
			number.classList.remove("invalid");
			number.classList.add("valid");
		} else {
			number.classList.remove("valid");
			number.classList.add("invalid");
		}
		
		// Validate length
		if(myInput.value.length >= 8) {
			length.classList.remove("invalid");
			length.classList.add("valid");
		} else {
			length.classList.remove("valid");
			length.classList.add("invalid");
		}
	}
</script>
@endsection
@extends('layouts.themes.admin.main')
@section('content')
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">User Account</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
							<li class="breadcrumb-item">User Account</li>
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
					<div class="col-md-3">
						
						<div class="card card-primary card-outline">
							<div class="card-body box-profile">
								<div class="row mt-3">
									<div class="col-12 text-center">
										<a href="javascript:void(0)" data-toggle="modal" data-target="#img-user-modal">
											@if(session('usr_image') <> '')
												<img class="img-fluid img-circle elevation-2" src="{{ asset('img/users/' . session('usr_image')) }}" alt="{{ session('usr_image') }}" style="max-height:200px; max-width:200px; min-height:200px; min-width:200px; object-fit:cover;"/>
											@else
												<img class="img-fluid img-circle elevation-2" src="{{ asset('img/users/default.png') }}" alt="User Image" style="max-height:200px; max-width:200px; min-height:200px; min-width:200px; object-fit:cover;"/>
											@endif
										</a>
									</div>
									<div class="col-12 text-center mb-4">
										<form id="uploadAvatarForm" class="form-horizontal" method="POST" action="{{ action('UserController@uploadAvatar', [session('usr_id')]) }}" enctype="multipart/form-data">
										@csrf
											<label class="btn btn-transparent btn-file">
												<i class="fa fa-solid fa-camera mr-2"></i><small>Upload Photo</small>
                                            	<input type="file" class="custom-file-input" id="usr_image" name='usr_image' value="{{ old('usr_image') }}" aria-describedby="inputGroupFileAddon01" style="display: none;" onchange="form.submit()">
											</label>
										</form>
									</div>
									<div class="col-12 text-center mb-3">
										<h3 class="profile-username text-center"><strong>{{ session('usr_full_name') }}</strong></h3>
										<i>{{ session('typ_name') }}</i>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-9">
						<div class="card">
							<div class="card-body">
								<div class="tab-content">
									<div class="active tab-pane" id="personal">
										<form class="form-horizontal" method="POST" action="{{-- action('UserController@savePersonal') --}}">
										{{ csrf_field() }} 
											<div class="form-group row">
												<label for="emp_last_name" class="col-sm-2 col-form-label">Full Name</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="usr_full_name" name="usr_full_name" value="{{$user_details->usr_full_name }}" placeholder="Full Name" required disabled/>
												</div>
											</div>
											<div class="form-group row">
												<label for="emp_middle_name" class="col-sm-2 col-form-label">Address</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="usr_address" name="usr_address" value="{{$user_details->usr_address }}" placeholder="Address" />
												</div>
											</div>
											<div class="form-group row">
												<label for="emp_middle_name" class="col-sm-2 col-form-label">Username</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="usr_name" name="usr_name" value="{{$user_details->usr_name }}" placeholder="Address" required disabled/>
												</div>
											</div>
											<div class="form-group row">
												<div class="offset-lg-2 col-12">
													<a class="btn btn-warning col-md-2 col-12 mb-2" href="javascript:void(0);" data-toggle="modal" data-target="#changePasswordModal"><span class="fa fa-key"></span> Change Password</a>
													<button type="submit" class="btn btn-success col-md-2 col-12 mb-2"><span class="fa fa-save"></span> Save Changes</button>
													<input type="hidden" name="usr_uuid" value="$user_details->usr_uuid">
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<div id="changePasswordModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Change Password</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<form method="POST" action="{{-- action('UserController@savePassword') --}}">
				{{ csrf_field() }} 
					<div class="modal-body">
						<div class="col-md-12">
							<label for="usr_password">Old Password <span style="color:red;">*</span></label>
							<input type="password" class="form-control" name="usr_password" id="emp_password" placeholder="Old Password" required/>
						</div>
						<div class="col-md-12">
							<label for="new_password">New Password <span style="color:red;">*</span></label>
							<input type="password" class="form-control" name="new_password" id="new_password" placeholder="Retype Password" required>
						</div>
						<div class="col-md-12">
							<label for="new_password2">Retype Password <span style="color:red;">*</span></label>
							<input type="password" class="form-control" name="new_password2" id="new_password2" placeholder="Retype Password" required/>
						</div>

						<div class="col-md-12" id="message">
							<div class="alert alert-warning">
								<small><strong><span class="fa fa-info-circle"></span></strong> A strong password must contain the following:</small>
							</div>
							<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
							<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
							<p id="number" class="invalid">A <b>number</b></p>
							<p id="length" class="invalid">Minimum <b>8 characters</b></p>
						</div>

					</div>
					<div class="modal-footer">
						<input type="hidden" name="usr_uuid" value="$user_details->usr_uuid">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Save</button> 
					</div>
				</form>
			</div>
		</div>
	</div>

	<!--User-Profile Modal -->
	<div class="modal fade" id="img-user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content bg-transparent">
				<div class="modal-body">
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				
					<div class="row">
						<div class="col-12 text-center">
							<a href="javascript:void(0);" data-toggle="modal" data-target="#avatarUploadModal">
								@if(session('usr_image') <> '')
									<img src="{{ asset('img/users/' . session('usr_image')) }}" alt="{{ session('usr_image') }}" style="max-height:100%; max-width:100%; min-height:100%; min-width:100%; object-fit: contain;">
								@else
									<img class="img-fluid img-circle elevation-2" src="{{ asset('img/users/default.png') }}" alt="User Image" style="max-height:200px; max-width:200px; min-height:200px; min-width:200px; object-fit:cover;"/>
								@endif
							</a>
						</div>
					</div>
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

		$('#btn_choose_file').click(function(){
			$('#choose_file').click();
		});

		
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

		// document.getElementById("usr_image").onchange = function() {
		// 	// alert(document.getElementById("usr_image").value);
		// 	document.getElementById("form").submit();
		// };
	</script>
@endsection
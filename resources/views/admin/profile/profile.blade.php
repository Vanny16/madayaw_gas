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
							<div class="text-center">
								<a href="javascript:void(0);" data-toggle="modal" data-target="#avatarUploadModal">
									<img class="profile-user-img img-fluid img-circle" src="" alt="User profile picture" />
								</a>
							</div>
							<div class="text-center">
								 <p class="text-muted text-center"><em><small>(upload)</small></em></p>
								<h3 class="profile-username text-center">{{ session('usr_full_name') }}</h3>
							</div>
                        </div>
                    </div>
      
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Contact Details</h3>
                        </div>
                        <div class="card-body">
							<strong><i class="fa fa-map-marker mr-1"></i> Address</strong>
                            <p class="text-muted">{{ $user_details->usr_address }}</p>
                            <hr>
							<a class="btn btn-warning btn-block" href="javascript:void(0);" data-toggle="modal" data-target="#changePasswordModal"><span class="fa fa-key"></span> Change Password</a>
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
												<input type="text" class="form-control" id="usr_address" name="usr_address" value="{{$user_details->usr_address }}" placeholder="Address" required disabled/>
											</div>
										</div>
                                        <div class="form-group row">
											<label for="emp_middle_name" class="col-sm-2 col-form-label">Username</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="usr_name" name="usr_name" value="{{$user_details->usr_name }}" placeholder="Address" required disabled/>
											</div>
										</div>
										<div class="form-group row">
											<div class="offset-sm-2 col-sm-10">
												<input type="hidden" name="emp_uuid" value="">
												<button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Save Changes</button>
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

<div id="avatarUploadModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Upload Profile Photo</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form method="POST" action="{{-- action('UserController@uploadAvatar') --}}" enctype="multipart/form-data">
            {{ csrf_field() }} 
				<div class="modal-body">
					<label for="emp_image">Attach File</label>
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="emp_image" name="emp_image" value="{{ old('emp_image') }}" aria-describedby="inputGroupFileAddon01" required>
						<label class="custom-file-label" for="emp_image">Choose file</label>
					</div>
					<small id="fileHelp" class="form-text text-muted">Please upload a valid file in jpg, png, or gif format. Size of image should not be more than 3MB.</small>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="emp_id" value="{{-- $employee->emp_id --}}">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Save</button> 
				</div>
			</form>
		</div>
	</div>
</div>

<div id="changePasswordModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Change Password</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form method="POST" action="{{-- action('UserController@updatePassword') --}}">
            {{ csrf_field() }} 
				<div class="modal-body">
					<div class="col-md-12">
						<label for="emp_password">Old Password <span style="color:red;">*</span></label>
						<input type="password" class="form-control" name="emp_password" id="emp_password" placeholder="Old Password" required/>
					</div>
					<div class="col-md-12">
						<label for="new_password">New Password <span style="color:red;">*</span></label>
						<input type="password" class="form-control" name="new_password" id="new_password" placeholder="Retype Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
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
					<input type="hidden" name="emp_uuid" value="{{-- $employee->emp_uuid --}}">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Save</button> 
				</div>
			</form>
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
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
                <div class="col-md-9"> 
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
                                    <span class="bg-danger"><i class="fa fa-bullhorn"></i> News and Announcements</span>
                                    @if(session('mod_news') == '1')  
                                        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#createNews"><i class="fa fa-comment"></i> Compose</button>
                                    @endif
                                </div>
                                    <div>
                                        <i class="fas fa-newspaper bg-blue"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock"></i> </span>
                                            <h3 class="timeline-header"></h3>
                                            <div class="timeline-body">
                                                
                                                    <div class="thumbnail">
                                                        <a href="">
                                                            <img src="" alt="" style="width:100%">
                                                        </a>
                                                        <div class="caption">
                                                            <p></p>
                                                        </div>
                                                    </div>
                                                    <p></p>
                                            </div>
                                            <div class="timeline-footer">
                                                    {{-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeNews"><i class="fa fa-trash"></i> Delete</button> --}}
                                                    {{--<a style="color:#dc3545;" href="javascript:void(0)" data-toggle="modal" data-target="#removeNews"><i class="fa fa-trash"></i></a>--}}
                                            
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

		<!-- Customer Modal -->
		<div class="modal fade" id="customer-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Employee Form</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form method="POST" action="">
					{{ csrf_field() }} 
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="cus_name">Full Name <span style="color:red">*</span></label>
										<input type="text" class="form-control" name="cus_name" placeholder="Enter Full Name" value="" required/>
									</div>

									<div class="form-group">
										<label for="cus_address">Address <span style="color:red">*</span></label>
										<input type="email" class="form-control" name="cus_address" placeholder="Enter Address" value="" required/>
									</div>

									<div class="form-group">
										<label for="cus_address">Contact # <span style="color:red">*</span></label>
										<input type="email" class="form-control" name="cus_address" placeholder="Enter Contact #" value="" required/>
									</div>

									<div class="form-group">
										<label for="cus_address">Notes <span style="color:red">*</span></label>
										<textarea name="cus_notes" placeholder="Additional notes ..." class="form-control" required></textarea>
									</div>
								</div>
							</div>
							
							<hr/>
							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>

	</section>

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
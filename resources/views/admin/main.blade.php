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
							<div class="card-header">
								<h3 class="card-title"><i class="fa fa-bolt"></i> Quick Buttons</h3>
							</div>

							<div class="card-body bg-light">
								<div class="row">
									@if($pdn_flag)
										<div class="col-12 text-white mb-3">
											<a class="btn btn-success col-lg-2 col-md-3 col-12" href= "{{ action('MainController@toggleProduction')}}"><i class="fa fa-play mr-1"></i> Start Production</a>
										</div>
									@else
										<div class="col-12 text-white mb-3">
											<a class="btn btn-danger col-lg-2 col-md-3 col-12" href= "{{ action('MainController@toggleProduction')}}"><i class="fa fa-stop mr-1"></i> End Production</a>
										</div>
									@endif
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

									@foreach($news as $news_item)
									<?php 
										$createdAt = new DateTime($news_item->news_datetime);
										$now = new DateTime();
										$diff = $now->diff($createdAt);

										// Use the $diff object to format the time passed since the post was created
										if ($diff->y > 0) {
											$timePassed = $diff->y . ' year' . ($diff->y > 1 ? 's' : '') . ' ago';
										} elseif ($diff->m > 0) {
											$timePassed = $diff->m . ' month' . ($diff->m > 1 ? 's' : '') . ' ago';
										} elseif ($diff->d > 0) {
											$timePassed = $diff->d . ' day' . ($diff->d > 1 ? 's' : '') . ' ago';
										} elseif ($diff->h > 0) {
											$timePassed = $diff->h . ' hour' . ($diff->h > 1 ? 's' : '') . ' ago';
										} elseif ($diff->i > 0) {
											$timePassed = $diff->i . ' minute' . ($diff->i > 1 ? 's' : '') . ' ago';
										} else {
											$timePassed = 'just now';
										}
									?>
										<div>
											<i class="fas fa-newspaper bg-blue"></i>
											<div class="timeline-item">
												<span class="time"><i class="fas fa-clock"></i> {{ $timePassed }}</span>
												<h3 class="timeline-header"><strong>{{ $news_item->news_title }}</strong></h3>
												<div class="timeline-body">
													<div class="thumbnail">
														<div class="caption ml-3 mt-3">
															<p>{{ $news_item->news_content }}</p>
														</div>
														<div class="col-12 text-center">
															@if($news_item->news_img != null)
															<a href="{{-- asset('images/news/' . $news_item->nws_image) --}}">
																<img src="{{ asset('img/news/' .$news_item->news_img) }}" style="width:50%"/>
															</a>
															@endif
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
															<a class="btn btn-danger btn-sm" href="{{ action('MainController@removeNews',[$news_item->news_id]) }}"><i class="fa fa-trash"></i> Delete</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									@endforeach		

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
				<form action="{{ action('MainController@createNews') }}" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
					<div class="modal-body">
						<div class="form-group">
							<div class="row">
								<div class="col-md-12 mb-3">
									<label for="nws_title">Title <span style="color:red;">*</span></label>
									<input type="text" class="form-control" id="news_title" name="news_title" placeholder="Title" value="" required>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 mb-3">
									<label for="nws_content">Message Content <span style="color:red;">*</span></label>
									<textarea class="form-control" id="news_content" name="news_content" rows="4"></textarea>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 mb-3"> 
									<label for="nws_image">Image</label>
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="news_image" name="news_image" value="" aria-describedby="inputGroupFileAddon01">
										<label class="custom-file-label" for="news_image">Choose file</label>
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
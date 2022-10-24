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
									@if($employee->emp_image <> '')
										<img class="profile-user-img img-fluid img-circle" src="{{ asset('images/employees/' . $employee->emp_image) }}" alt="User profile picture" />
									@else
										<img class="profile-user-img img-fluid img-circle" src="{{ asset('images/employees/default.png') }}" alt="User profile picture" />
									@endif
								</a>
							</div>
							<div class="text-center">
								 <p class="text-muted text-center"><em><small>(upload)</small></em></p>
							</div>
                            <h3 class="profile-username text-center">{{ session('emp_full_name') }}</h3>
                            {{-- <p class="text-muted text-center">{{ $employee->pos_name }}</p> --}}
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Employed Since</b> <a class="float-right">{{ $employee->emp_date_employment }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Years in Service</b> 
									<a class="float-right">
										{{ $employ_years }} 
										@if($employ_years <= 1)
											year
										@else 
											years
										@endif
									</a>
                                </li>
                            </ul>
                        </div>
                    </div>
      
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Contact Details</h3>
                        </div>
                        <div class="card-body">
                            <strong><i class="fa fa-envelope mr-1"></i> E-mail</strong>
                            <p class="text-muted">{{ $employee->emp_email }}</p>
                            <hr>

                            <strong><i class="fa fa-phone mr-1"></i> Mobile</strong>
                            <p class="text-muted">{{ $employee->emp_mobile }}</p>
                            <hr>

                            <strong><i class="fa fa-map-marker mr-1"></i> Address</strong>
                            <p class="text-muted">{{ $employee->emp_address }}</p>
                            <hr>

							<a class="btn btn-warning btn-block" href="javascript:void(0);" data-toggle="modal" data-target="#changePasswordModal"><span class="fa fa-key"></span> Change Password</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
					<div class="card">
						<div class="card-header p-2">
							<ul class="nav nav-pills">
								<li class="nav-item"><a class="nav-link active" href="#personal" data-toggle="tab">Personal Details</a></li>
								<li class="nav-item"><a class="nav-link" href="#family" data-toggle="tab">Family Background</a></li>
								<li class="nav-item"><a class="nav-link" href="#education" data-toggle="tab">Education</a></li>
								<li class="nav-item"><a class="nav-link" href="#eligibility" data-toggle="tab">Eligibility/Certifications</a></li>
								<li class="nav-item"><a class="nav-link" href="#training" data-toggle="tab">Trainings/Seminars</a></li>
								<li class="nav-item"><a class="nav-link" href="#employment" data-toggle="tab">Employment History</a></li>
							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content">
								<div class="active tab-pane" id="personal">
									<form class="form-horizontal" method="POST" action="{{ action('UserController@savePersonal') }}">
									{{ csrf_field() }} 
										<div class="form-group row">
											<label for="emp_last_name" class="col-sm-2 col-form-label">Last Name</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="emp_last_name" name="emp_last_name" value="{{ $employee->emp_last_name}}" placeholder="Last Name" required disabled/>
											</div>
										</div>
										<div class="form-group row">
											<label for="emp_first_name" class="col-sm-2 col-form-label">First Name</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="emp_first_name" name="emp_first_name" value="{{ $employee->emp_first_name}}" placeholder="First Name" required disabled/>
											</div>
										</div>
										<div class="form-group row">
											<label for="emp_middle_name" class="col-sm-2 col-form-label">Middle Name</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="emp_middle_name" name="emp_middle_name" value="{{ $employee->emp_middle_name}}" placeholder="Middle Name" required disabled/>
											</div>
										</div>
										<div class="form-group row">
											<label for="emp_address" class="col-sm-2 col-form-label">Address</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="emp_address" id="emp_address" placeholder="Current Address" value="{{ $employee->emp_address}}" required/>
											</div>
										</div>
										<div class="form-group row">
											<label for="emp_birthdate" class="col-sm-2 col-form-label">Date of Birth</label>
											<div class="col-sm-4">
												<input type="date" class="form-control" id="emp_birthdate" name="emp_birthdate" value="{{ $employee->emp_birthdate}}" placeholder="Date of Birth" required disabled/>
											</div>
											<label for="emp_birthplace" class="col-sm-2 col-form-label">Place of Birth</label>
											<div class="col-sm-4">
												<input type="text" class="form-control" id="emp_birthplace" name="emp_birthplace" value="{{ $employee->emp_birthplace}}" placeholder="Place of Birth" required/>
											</div>
										</div>
										<div class="form-group row">
											<label for="emp_sex" class="col-sm-2 col-form-label">Sex</label>
											<div class="col-sm-4">
												<select class="form-control" name="emp_sex" disabled>
													@if($employee->emp_sex == 'M')
														<option value="M" selected>Male</option>
														<option value="F">Female</option>
													@else  
														<option value="M">Male</option>
														<option value="F" selected>Female</option>
													@endif
												</select> 
											</div>
											<label for="emp_civil_status_id" class="col-sm-2 col-form-label">Status</label>
											<div class="col-sm-4">
												<select class="form-control" name="emp_civil_status_id">
													@if($employee->emp_civil_status_id == '')
														<option value="" selected>Not Specified</option>
													@else
														<option value="">Not Specified</option>
													@endif
													@foreach($civil_statuses as $civil_status)
														@if($employee->emp_civil_status_id == $civil_status->sta_id)
															<option value="{{ $civil_status->sta_id }}" selected>{{ $civil_status->sta_value }}</option>
														@else
															<option value="{{ $civil_status->sta_id }}">{{ $civil_status->sta_value }}</option>
														@endif
													@endforeach
												</select> 
											</div>
										</div>
										<div class="form-group row">
											<label for="emp_height" class="col-sm-2 col-form-label">Height</label>
											<div class="col-sm-4">
												<input type="text" class="form-control" id="emp_height" name="emp_height" value="{{ $employee->emp_height}}" placeholder="Height in cm." />
											</div>
											<label for="emp_weight" class="col-sm-2 col-form-label">Weight</label>
											<div class="col-sm-4">
												<input type="text" class="form-control" id="emp_weight" name="emp_weight" value="{{ $employee->emp_weight}}" placeholder="Weight in kg." />
											</div>
										</div>

										<div class="form-group row">
											<label for="emp_blood_type_id" class="col-sm-2 col-form-label">Blood Type</label>
											<div class="col-sm-4">
												<select class="form-control" name="emp_blood_type_id">
													@if($employee->emp_blood_type_id == '')
														<option value="" selected>Not Specified</option>
													@else
														<option value="">Not Specified</option>
													@endif
													@foreach($blood_types as $blood_type)
														@if($employee->emp_blood_type_id == $blood_type->bld_id)
															<option value="{{ $blood_type->bld_id }}" selected>{{ $blood_type->bld_value }}</option>
														@else
															<option value="{{ $blood_type->bld_id }}">{{ $blood_type->bld_value }}</option>
														@endif
													@endforeach
												</select> 
											</div>
										</div>

										<div class="form-group row">
											<label for="emp_tin" class="col-sm-2 col-form-label">TIN</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="emp_tin" id="emp_tin" placeholder="TIN" value="{{ $employee->emp_tin}}" />
											</div>
										</div>

										<div class="form-group row">
											<label for="emp_sss" class="col-sm-2 col-form-label">SSS</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="emp_sss" id="emp_sss" placeholder="SSS" value="{{ $employee->emp_sss}}" />
											</div>
										</div>

										<div class="form-group row">
											<label for="emp_hdmf" class="col-sm-2 col-form-label">HDMF</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="emp_hdmf" id="emp_hdmf" placeholder="HDMF" value="{{ $employee->emp_hdmf}}" />
											</div>
										</div>

										<div class="form-group row">
											<label for="emp_phic" class="col-sm-2 col-form-label">PHIC</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="emp_phic" id="emp_phic" placeholder="PHIC" value="{{ $employee->emp_phic}}" />
											</div>
										</div>

										<div class="form-group row">
											<label for="emp_email" class="col-sm-2 col-form-label">Email</label>
											<div class="col-sm-10">
												<input type="email" class="form-control" name="emp_email" id="emp_email" placeholder="Email" value="{{ $employee->emp_email}}" required/>
											</div>
										</div>

										<div class="form-group row">
											<label for="emp_mobile" class="col-sm-2 col-form-label">Mobile No.</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="emp_mobile" id="emp_mobile" placeholder="Mobile Number (eg. 9109005555)" value="{{ $employee->emp_mobile}}" required/>
											</div>
										</div>

										<div class="form-group row">
											<div class="offset-sm-2 col-sm-10">
												<input type="hidden" name="emp_uuid" value="{{ $employee->emp_uuid }}">
												<button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Save Changes</button>
											</div>
										</div>
									</form>
								</div>
                  	
								<div class="tab-pane" id="family">
									<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#familyAdd"><span class="fa fa-plus-circle"></span> Add Record</button>
									<table class="table table-hover table-condensed">
										<thead>
											<tr>
												<th>Name</th>
												<th>Relationship</th>
												<th width="80px" class="text-center"><i class="fa fa-cog"></i></th>
											</tr>
										</thead>
										<tbody>
											@foreach($employee_family_members as $employee_family_member)
												<tr>
													<td>
														{{ $employee_family_member->efm_name }}
													</td>
													<td>
														{{ $employee_family_member->ftyp_name }} 
													</td>
													<td class="text-center">
														<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#familyRemove-{{$employee_family_member->efm_id}}"><span class="fa fa-trash"></span></button>
													</td>
												</tr> 
												<div id="familyRemove-{{$employee_family_member->efm_id}}" class="modal fade" role="dialog">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title">Remove Family Member</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<div class="col-md-12">
																	<p>Are you sure you want to remove {{ $employee_family_member->efm_name }} from list of family members?</p>
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																<a class="btn btn-danger" href="{{ action('UserController@familyRemove',[$employee_family_member->efm_uuid]) }}"><span class="fa fa-trash"></span> Remove</a>
															</div>
														</div>
													</div>
												</div>
											@endforeach
										</tbody>
									</table>
								</div>

								<div class="tab-pane" id="education">
									<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#educationAdd"><span class="fa fa-plus-circle"></span> Add Record</button>
									<table class="table table-hover table-condensed">
										<thead>
											<tr>
												<th>Level</th>
												<th>School</th>
												<th>Degree/Concentration</th>
												<th>Year Graduated</th>
												<th width="80px" class="text-center"><i class="fa fa-cog"></i></th>
											</tr>
										</thead>
										<tbody>
											@foreach($employee_educations as $employee_education)
												<tr>
													<td>
														{{ $employee_education->etyp_name }}
													</td>
													<td>
														{{ $employee_education->edu_school }} 
													</td>
													<td>
														{{ $employee_education->edu_concentration }} 
													</td>
													<td>
														@if($employee_education->edu_year_graduate <> '')
															{{ $employee_education->edu_year_graduate }}
														@else
															Ongoing/Unfinished
														@endif
													</td>
													<td class="text-center">
														<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#educationRemove-{{$employee_education->edu_id}}"><span class="fa fa-trash"></span></button>
													</td>
												</tr> 
												<div id="educationRemove-{{$employee_education->edu_id}}" class="modal fade" role="dialog">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title">Remove Education Detail</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<div class="col-md-12">
																	<p>Are you sure you want to remove {{ $employee_education->edu_school }} from list of educational background?</p>
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																<a class="btn btn-danger" href="{{ action('UserController@educationRemove',[$employee_education->edu_uuid]) }}"><span class="fa fa-trash"></span> Remove</a>
															</div>
														</div>
													</div>
												</div>
											@endforeach
										</tbody>
									</table>
								</div>

								<div class="tab-pane" id="eligibility">
									<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#eligibilityAdd"><span class="fa fa-plus-circle"></span> Add Record</button>
									<table class="table table-hover table-condensed">
										<thead>
											<tr>
												<th>Eligibility (Board/Bar/CS/Examinations/Certifications Passed)</th>
												<th>Date</th>
												<th>Expiry</th>
												<th>Remarks</th>
												<th width="80px" class="text-center"><i class="fa fa-cog"></i></th>
											</tr>
										</thead>
										<tbody>
											@foreach($eligibilities as $eligibility)
												<tr>
													<td>
														{{ $eligibility->elg_name }}
													</td>
													<td>
														{{ $eligibility->elg_date }} 
													</td>
													<td>
														{{ $eligibility->elg_date_expiry }} 
													</td>
													<td>
														{{ $eligibility->elg_remarks }}
													</td>
													<td class="text-center">
														<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eligibilityRemove-{{$eligibility->elg_id}}"><span class="fa fa-trash"></span></button>
													</td>
												</tr> 
												<div id="eligibilityRemove-{{$eligibility->elg_id}}" class="modal fade" role="dialog">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title">Remove Eligibility</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<div class="col-md-12">
																	<p>Are you sure you want to remove {{ $eligibility->elg_name }} from list of eligibilities?</p>
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																<a class="btn btn-danger" href="{{ action('UserController@eligibilityRemove',[$eligibility->elg_uuid]) }}"><span class="fa fa-trash"></span> Remove</a>
															</div>
														</div>
													</div>
												</div>
											@endforeach
										</tbody>
									</table>
								</div>

								<div class="tab-pane" id="training">
									<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#trainingAdd"><span class="fa fa-plus-circle"></span> Add Record</button>
									<table class="table table-hover table-condensed">
										<thead>
											<tr>
												<th>Training/Seminar Attended</th>
												<th>Date</th>
												<th>Remarks</th>
												<th width="80px" class="text-center"><i class="fa fa-cog"></i></th>
											</tr>
										</thead>
										<tbody>
											@foreach($trainings as $training)
												<tr>
													<td>
														{{ $training->trn_name }}
													</td>
													<td>
														{{ $training->trn_date }} 
													</td>
													<td>
														{{ $training->trn_remarks }} 
													</td>
													<td class="text-center">
														<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#trainingRemove-{{$training->trn_id}}"><span class="fa fa-trash"></span></button>
													</td>
												</tr> 
												<div id="trainingRemove-{{$training->trn_id}}" class="modal fade" role="dialog">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title">Remove Training/Seminar</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<div class="col-md-12">
																	<p>Are you sure you want to remove {{ $training->trn_name }} from list of trainings/seminars?</p>
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																<a class="btn btn-danger" href="{{ action('UserController@trainingRemove',[$training->trn_uuid]) }}"><span class="fa fa-trash"></span> Remove</a>
															</div>
														</div>
													</div>
												</div>
											@endforeach
										</tbody>
									</table>
								</div>

								<div class="tab-pane" id="employment">
									<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#employmentAdd"><span class="fa fa-plus-circle"></span> Add Record</button>
									<table class="table table-hover table-condensed">
										<thead>
											<tr>
												<th>Company</th>
												<th>Position</th>
												<th>Date (from - to)</th>
												<th width="80px" class="text-center"><i class="fa fa-cog"></i></th>
											</tr>
										</thead>
										<tbody>
											@foreach($employments as $employment)
												<tr>
													<td>
														{{ $employment->emh_company }}
													</td>
													<td>
														{{ $employment->emh_position }} 
													</td>
													<td>
														{{ $employment->emh_date }} 
													</td>
													<td class="text-center">
														<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#employmentRemove-{{$employment->emh_id}}"><span class="fa fa-trash"></span></button>
													</td>
												</tr> 
												<div id="employmentRemove-{{$employment->emh_id}}" class="modal fade" role="dialog">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title">Remove Employment History</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<div class="col-md-12">
																	<p>Are you sure you want to remove {{ $employment->emh_company }} from list of employment history?</p>
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																<a class="btn btn-danger" href="{{ action('UserController@employmentRemove',[$employment->emh_uuid]) }}"><span class="fa fa-trash"></span> Remove</a>
															</div>
														</div>
													</div>
												</div>
											@endforeach
										</tbody>
									</table>
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
			<form method="POST" action="{{ action('UserController@uploadAvatar') }}" enctype="multipart/form-data">
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
					<input type="hidden" name="emp_id" value="{{ $employee->emp_id }}">
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
			<form method="POST" action="{{ action('UserController@updatePassword') }}">
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
					<input type="hidden" name="emp_uuid" value="{{ $employee->emp_uuid }}">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Save</button> 
				</div>
			</form>
		</div>
	</div>
</div>

<div id="familyAdd" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Family Member</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form method="POST" action="{{ action('UserController@saveFamily') }}">
            {{ csrf_field() }} 
				<div class="modal-body">
					<div class="col-md-12">
						<label for="efm_name">Family Member's Name <span style="color:red;">*</span></label>
						<input type="text" class="form-control" name="efm_name" id="efm_name" placeholder="Last Name, First Name M.I." required/>
					</div>
					<div class="col-md-12">
						<label for="ftyp_id">Relationship</label>		
						<select class="form-control" name="ftyp_id">
							@foreach($family_types as $family_type)
								<option value="{{ $family_type->ftyp_id }}">{{ $family_type->ftyp_name }}</option>
							@endforeach
						</select> 
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Save</button> 
				</div>
			</form>
		</div>
	</div>
</div>

<div id="educationAdd" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Education Details</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form method="POST" action="{{ action('UserController@saveEducation') }}">
            {{ csrf_field() }} 
				<div class="modal-body">
					<div class="col-md-12 mb-3">
						<label for="etyp_id">Select Education Type <span style="color:red;">*</span></label>		
						<select class="form-control" name="etyp_id">
							@foreach($education_types as $education_type)
								<option value="{{ $education_type->etyp_id }}">{{ $education_type->etyp_name }}</option>
							@endforeach
						</select> 
					</div>
					<div class="col-md-12 mb-3">
						<label for="edu_school">Name of School <span style="color:red;">*</span></label>
						<input type="text" class="form-control" name="edu_school" id="edu_school" placeholder="Name of School" required/>
					</div>
					<div class="col-md-12 mb-3">
						<label for="edu_concentration">Degree/Concentration</label>
						<input type="text" class="form-control" name="edu_concentration" id="edu_concentration" placeholder="Degree/Concentration"/>
					</div>
					<div class="col-md-12">
						<label for="edu_year_graduate">Year Graduated (Leave blank if not not yet graduate)</label>
						<input type="text" class="form-control" name="edu_year_graduate" id="edu_year_graduate" placeholder="Year Graduated"/>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Save</button> 
				</div>
			</form>
		</div>
	</div>
</div>

<div id="eligibilityAdd" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Eligibility</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form method="POST" action="{{ action('UserController@saveEligibility') }}">
            {{ csrf_field() }} 
				<div class="modal-body">
					<div class="col-md-12 mb-3">
						<label for="elg_name">Eligibility <span style="color:red;">*</span></label>
						<input type="text" class="form-control" name="elg_name" id="elg_name" placeholder="Name of eligibility" required/>
					</div>
					<div class="col-md-12 mb-3">
						<label for="elg_date">Exam/passed/awarded date</label>
						<input type="date" class="form-control" name="elg_date" id="elg_date" />
					</div>
					<div class="col-md-12">
						<label for="elg_date_expiry">Expiry date (if applicable)</label>
						<input type="date" class="form-control" name="elg_date_expiry" id="elg_date_expiry" />
					</div>
					<div class="col-md-12 mb-3">
						<label for="elg_remarks">Remarks</label>
						<input type="text" class="form-control" name="elg_remarks" id="elg_remarks" placeholder="Remarks/Notes"/>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Save</button> 
				</div>
			</form>
		</div>
	</div>
</div>

<div id="trainingAdd" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Training/Seminar</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form method="POST" action="{{ action('UserController@saveTraining') }}">
            {{ csrf_field() }} 
				<div class="modal-body">
					<div class="col-md-12 mb-3">
						<label for="trn_name">Training/Seminar Attended <span style="color:red;">*</span></label>
						<input type="text" class="form-control" name="trn_name" id="trn_name" placeholder="Name of training/seminar" required/>
					</div>
					<div class="col-md-12 mb-3">
						<label for="trn_date">Date</label>
						<input type="date" class="form-control" name="trn_date" id="trn_date" />
					</div>
					<div class="col-md-12 mb-3">
						<label for="trn_remarks">Remarks</label>
						<input type="text" class="form-control" name="trn_remarks" id="trn_remarks" placeholder="Remarks/Notes"/>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Save</button> 
				</div>
			</form>
		</div>
	</div>
</div>

<div id="employmentAdd" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Employment Record</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form method="POST" action="{{ action('UserController@saveEmployment') }}">
            {{ csrf_field() }} 
				<div class="modal-body">
					<div class="col-md-12 mb-3">
						<label for="emh_company">Company <span style="color:red;">*</span></label>
						<input type="text" class="form-control" name="emh_company" id="emh_company" placeholder="Company Name" required/>
					</div>
					<div class="col-md-12 mb-3">
						<label for="emh_position">Remarks</label>
						<input type="text" class="form-control" name="emh_position" id="emh_position" placeholder="Position"/>
					</div>
					<div class="col-md-12 mb-3">
						<label for="emh_date">Date (from - to)</label>
						<input type="text" class="form-control" name="emh_date" id="emh_date" />
					</div>
				</div>
				<div class="modal-footer">
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
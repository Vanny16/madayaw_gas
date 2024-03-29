@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Manage User</li>
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
                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-search"></i> Find User</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="{{ action('UserController@searchUser') }}">
                            {{ csrf_field() }} 
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="search_string">Find User</label>
                                            <input id="search-users" type="text" class="form-control" name="search_string" placeholder="Search ..."/>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="filter_type">User Type</label>
                                            <select class="form-control" id="filter_type" name="filter_type" required>
                                                <option value="0" selected>All</option>
                                                @foreach($user_types as $user_type)
                                                    @if($typ_id == $user_type->typ_id)
                                                        <option value="{{ $user_type->typ_id }}" selected>{{ $user_type->typ_name }}</option>
                                                    @else
                                                        <option value="{{ $user_type->typ_id }}">{{ $user_type->typ_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select> 
                                        </div>

                                        <div class="col-md-2">
                                            <label for="filter_status">User Status</label>
                                            <select class="form-control" id="filter_status" name="filter_status" required>
                                                @foreach($statuses as $status)
                                                    @if($status == $default_status)
                                                        <option value="{{ $status }}" selected>{{ $status }}</option>
                                                    @else
                                                        <option value="{{ $status }}">{{ $status }}</option>
                                                    @endif
                                                @endforeach   
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12 mt-2">
                                            <button type="submit" class="btn btn-success col-md-3 col-12"><span class="fa fa-search"></span> Find</button> 
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @if(session('typ_id') == '1')
                <div class="col-md-12 mb-3"> 
                    <a class="btn btn-primary col-md-2 col-12" href="javascript:void(0)" data-toggle="modal" data-target="#user-modal"><d class="fa fa-user-plus"></d> New User</a>
                @endif
                    <a class="btn btn-info col-md-1 col-12 float-right" href="{{ action('PrintController@alluserDetails') }}" target="_BLANK"><i class="fa fa-print"></i> Print</a>
                </div>
               
                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-users"></i> Users</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="50px"></th>
                                        <th>Full Name</th>
                                        <th>Username</th>
                                        <th>Address</th>
                                        <th>User Type</th>
                                        <th width="100px">Status</th>
                                        @if(session('typ_id') == '1')
                                        <th width="10px"></th>
                                        <th width="70px"></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody id="tbl-users">
                                    @if(isset($users))
                                        @if(session('typ_id') == '1')
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>
                                                    @if($user->usr_image <> '')
                                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#img-user-modal-{{$user->usr_id}}"><img class="img-fluid img-circle elevation-2" src="{{ asset('img/users/' . $user->usr_image) }}" alt="{{ $user->usr_image }}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                    @else
                                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#img-user-modal-{{$user->usr_id}}"><img class="profile-user-img img-fluid img-circle" src="{{ asset('img/users/default.png') }}" alt="{{ $user->usr_image }}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                    @endif
                                                    </td>
                                                    <td>
                                                        {{ $user->usr_full_name }}
                                                    </td>
                                                    <td>
                                                        {{ $user->usr_name }}
                                                    </td>
                                                    <td>
                                                        {{ $user->usr_address }}
                                                    </td>
                                                    @foreach($user_types as $user_type)
                                                        @if($user->typ_id == $user_type->typ_id)
                                                            <td>{{ $user_type->typ_name }}</td>
                                                        @elseif($user->typ_id == null)
                                                            <td>-</td>    
                                                        @endif
                                                    @endforeach
                                                    @if($user->usr_active == 0)
                                                        <td>
                                                            <span class="badge badge-danger">Inactive</span>
                                                            @if(session('typ_id') == '1' || session('type_id') == '2')
                                                            <a class="fa fa-toggle-off" type="button" href="{{ action('UserController@reactivateUser',[$user->usr_id]) }}" aria-hidden="true"></a>
                                                            @endif
                                                        </td>
                                                    @else
                                                        <td>
                                                            <span class="badge badge-success">Active</span>
                                                            @if(session('typ_id') == '1' || session('type_id') == '2')
                                                            <a class="fa fa-toggle-on" type="button" href="{{ action('UserController@deactivateUser',[$user->usr_id]) }}" aria-hidden="true"></a>
                                                            @endif
                                                        </td> 
                                                    @endif

                                                
                                                    <td>
                                                    @if($user->usr_active == 0)
                                                        @if(session('typ_id') == '1')
                                                        <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" disabled><i class="fa fa-ellipsis-vertical"></i></button>
                                                        @endif
                                                    @else   
                                                        @if(session('typ_id') == '1')
                                                            <div class="dropdown">
                                                                <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" data-toggle="dropdown"><i class="fa fa-ellipsis-vertical"></i></button>
                                                                <ul class="dropdown-menu">
                                                                @if(session('typ_id') == '1')
                                                                    <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#edit-modal-{{$user->usr_id}}"><i class="fa fa-edit mr-2" aria-hidden="true"></i>Edit Info</a></li>
                                                                @endif
                                                                </ul>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @foreach($reset_passwords as $reset_password)
                                                            @if($reset_password->usr_id == $user->usr_id)
                                                                <button class="btn btn-transparent text-warning btn-sm" data-toggle="modal" data-target="#resetPasswordModal{{$user->usr_id}}"><i class="fa fa-key"></i><i class="fa fa-unlock fa-sm"></i></button>
                                                                
                                                                <!--Reset Password Modal-->
                                                                <div id="resetPasswordModal{{$user->usr_id}}" class="modal fade" role="dialog">
                                                                    <form method="POST" action="{{action('UserController@resetPassword')}}">
                                                                    {{ csrf_field() }} 
                                                                        <div class="modal-dialog modal-sm">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="text-warning"><span class="fa fa-warning"></span> Warning</5>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p><strong>Confirm reset password for {{$user->usr_full_name}}?</strong> <br><br>Username: <strong>{{$user->usr_name}}</strong><br>Password: <strong>{{$user->usr_name}}</strong><br><br>Please click '<span class="fa fa-key"></span> RESET' button to confirm.</p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <input type="hidden" name="rst_id" value="{{$reset_password->rst_id}}"/>
                                                                                    <input type="hidden" name="usr_id" value="{{$reset_password->usr_id}}"/>
                                                                                    <input type="hidden" name="usr_name" value="{{$reset_password->usr_name}}"/>
                                                                                    <button type="submit" class="btn btn-default"><span class="fa fa-key"></span> RESET</button> 
                                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times-circle"></span> BACK</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    @endif

                                                    <!--Edit User Modal-->
                                                    <div class="modal fade" id="edit-modal-{{$user->usr_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-md" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit User Info</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form method="POST" action=" {{ action('UserController@editUser',[$user->usr_id]) }} ">
                                                                {{ csrf_field() }} 
                                                                    <div class="modal-body">

                                                                        <div class="row mb-2" style="box-shadow: 0 0 2px black; padding: 10px;">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label for="usr_full_name">Full Name <span style="color:red">*</span></label>
                                                                                    <input type="text" class="form-control" name="usr_full_name" placeholder="Fullname" value="{{ $user->usr_full_name }}" required/>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label for="usr_address">Address <span style="color:red">*</span></label>
                                                                                    <input type="text" class="form-control" name="usr_address" placeholder="Address" value="{{ $user->usr_address }}" required/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row" style="box-shadow: 0 0 2px black; padding: 10px;">
                                                                            <div class="col-md-12">
                                                                                <label for="typ_id">User Type<span style="color:red;">*</span></label>
                                                                                    <select class="form-control" name="typ_id" required>
                                                                                    @foreach($user_types as $user_type)
                                                                                        @if($user->typ_id == $user_type->typ_id)
                                                                                            <option value="{{ $user_type->typ_id }}" selected>{{ $user_type->typ_name }}</option>
                                                                                        @else
                                                                                            <option value="{{ $user_type->typ_id }}">{{ $user_type->typ_name }}</option>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </select> 
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label for="usr_name">Username <span style="color:red">*</span></label>
                                                                                    <input type="text" class="form-control" name="usr_name" value="{{ $user->usr_name }}" readonly/>
                                                                                </div>
                                                                            </div>    
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label for="usr_password">Reset Password <span style="color:red">*</span></label>
                                                                                    <input type="password" class="form-control" name="usr_password" id="usr_password" value=""/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input type="text" class="form-control" name="usr_uuid" value="{{ $user->usr_uuid }}"  hidden/> 
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--User-Profile Modal -->
                                                    <div class="modal fade" id="img-user-modal-{{$user->usr_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content bg-transparent">
                                                                <div class="modal-body">
                                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                
                                                                    <div class="row">
                                                                        <div class="col-12 text-center">
                                                                            @if($user->usr_image <> '')
                                                                                <img src="{{ asset('img/users/' . $user->usr_image) }}" alt="{{ $user->usr_image }}"  style="max-height:100%; max-width:100%; min-height:100%; min-width:100%; object-fit: contain;">
                                                                            @else
                                                                            <img src="{{ asset('img/users/default.png') }}" alt="{{ $user->usr_image }}" style="max-height:100%; max-width:100%; min-height:100%; min-width:100%; object-fit: contain;">
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>				
                                                    </div>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>    
            </div>
            
            <!--Create User Modal-->
            <div class="modal fade" id="user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create New User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action=" {{ action('UserController@createUser') }} ">
                        {{ csrf_field() }} 
                            <div class="modal-body">
                                <div class="row mb-2" style="box-shadow: 0 0 2px black; padding: 10px;">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="usr_full_name">Full Name <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="usr_full_name" placeholder="Enter Fullname" value="{{ old('usr_full_name') }}" required/>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="usr_address">Address <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="usr_address" placeholder="Enter Address" value="{{ old('usr_address') }}" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="box-shadow: 0 0 2px black; padding: 10px;">
                                    <div class="col-md-12">
                                        <label for="typ_id">User Type<span style="color:red;">*</span></label>
                                        <select class="form-control" name="typ_id" required>
                                            @foreach($user_types as $user_type)
                                                @if($typ_id == $user_type->typ_id)
                                                    <option value="{{ $user_type->typ_id }}" selected>{{ $user_type->typ_name }}</option>
                                                @else
                                                    <option value="{{ $user_type->typ_id }}">{{ $user_type->typ_name }}</option>
                                                @endif
                                            @endforeach
                                        </select> 
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="usr_name">Username <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="usr_name" placeholder="Enter Username" value="{{ old('usr_name') }}" required/>
                                        </div>
                                    </div>    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="usr_password">Password <span style="color:red">*</span></label>
                                            <input type="password" class="form-control" name="usr_password" placeholder="Enter Password" value="{{ old('usr_password') }}" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
</div>

<script>

$(document).ready(function(){
    $("#search-users").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tbl-users tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

$('#btn_choose_file').click(function(){
    $('#choose_file').click();
});

$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

</script>

@endsection

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
                            <h3 class="card-title"><i class="fas fa-user"></i> Find User</h3>
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
                                            <select class="form-control" if="filter_type" name="filter_type" required>
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
                                            <select class="form-control" if="filter_status" name="filter_status" required>
                                                @foreach($statuses as $status)
                                                    @if($typ_i == $user_type->typ_id)
                                                        <option value="{{ $user_type->typ_id }}" selected>{{ $user_type->typ_name }}</option>
                                                    @else
                                                        <option value="{{ $user_type->typ_id }}">{{ $user_type->typ_name }}</option>
                                                    @endif
                                                @endforeach    
                                            
                                            <option value="1" selected>All</option>
                                                <option value="2">Active</option>
                                                <option value="2">Inactive</option>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-success"><span class="fa fa-search"></span> Find</button> 
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3"> 
                    <a class="btn btn-primary col-md-2 col-12" href="javascript:void(0)" data-toggle="modal" data-target="#user-modal"><i class="fa fa-user-plus"></i> New User</a>
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
                                        <th>User Type</th>
                                        <th width="100px">Status</th>
                                        <th width="100px"></th>
                                    </tr>
                                </thead>
                                <tbody id="tbl-users">
                                    @if(isset($users))
                                        @foreach($users as $user)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('images/employees/default.png') }}" class="img-circle elevation-2" alt="Customer Image">
                                                </td>
                                                <td>
                                                    {{ $user->usr_full_name }}
                                                </td>
                                                <td>
                                                    {{ $user->usr_name }}
                                                </td>
                                                @if($user->typ_id == 1)
                                                    <td>Administrator</td>
                                                @elseif($user->typ_id == 2)
                                                    <td>Employee</td>
                                                @elseif($user->typ_id == 3)
                                                    <td>Observer</td>
                                                @elseif($user->typ_id == null)
                                                <td>-</td>    
                                                @endif
                                                @if($user->usr_active == 0)
                                                    <td>
                                                        <span class="badge badge-danger">Inactive</span>
                                                        <a class="fa fa-toggle-off" type="button" href="{{ action('UserController@reactivateUser',[$user->usr_id]) }}" aria-hidden="true"></a>
                                                    </td>
                                                @elseif($user->usr_active == 1)
                                                    @if($user->usr_id == session('usr_id'))
                                                        <td>
                                                            <span class="badge badge-success">Active</span>
                                                        </td>
                                                    @else
                                                    <td>
                                                        <span class="badge badge-success">Active</span>
                                                        <a class="fa fa-toggle-on" type="button" href="{{ action('UserController@deactivateUser',[$user->usr_id]) }}" aria-hidden="true"></a>
                                                    </td>
                                                @endif
                                                @if($user->usr_active == 0)
                                                <td>-</td>
                                                @else
                                                <td>
                                                    <div class="btn btn-default bg-transparent btn-outline-trasparent dropdown" data-toggle="dropdown" style="border: transparent;">
                                                        <i class="fa fa-ellipsis-vertical"></i>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#edit-modal-{{$user->usr_id}}"><i class="fa fa-edit mr-2" aria-hidden="true"></i>Edit Info</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                @endif
                                                <!--Edit User Modal-->
                                                <div class="modal fade" id="edit-modal-{{$user->usr_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Create New User</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="POST" action=" {{ action('UserController@editUser',[$user->usr_id]) }} ">
                                                            {{ csrf_field() }} 
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="usr_full_name">Full Name <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="usr_full_name" placeholder="Fullname" value="{{ $user->usr_full_name }}" readonly/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="usr_address">Address <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="usr_address" placeholder="Address" value="{{ $user->usr_address }}" readonly/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <label for="typ_id">User Type<span style="color:red;">*</span></label>
                                                                            <select class="form-control" name="typ_id" required>
                                                                            @foreach($user_types as $user_type)
                                                                                @if($user->usr_id == $user_type->typ_id)
                                                                                    <option value="{{ $user_type->typ_id }}" selected>{{ $user_type->typ_name }}</option>
                                                                                @else
                                                                                    <option value="{{ $user_type->typ_id }}">{{ $user_type->typ_name }}</option>
                                                                                @endif
                                                                            @endforeach
                                                                            </select> 
                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <label for="usr_name">Username <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="usr_name" value="{{ $user->usr_name }}" readonly/>
                                                                            </div>
                                                                        </div>    
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <label for="usr_password">Password</label>
                                                                                <input type="password" class="form-control" name="usr_password" value=""/>
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
                                            </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>    
            </div>
            
            <!--Create User Modal-->
            <div class="modal fade" id="user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="usr_full_name">Full Name <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="usr_full_name" placeholder="Enter Fullname" value="{{ old('usr_full_name') }}" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="usr_address">Address <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="usr_address" placeholder="Enter Address" value="{{ old('usr_address') }}" required/>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="typ_id">User Type<span style="color:red;">*</span></label>
                                        <select class="form-control" name="typ_id" required>
                                            <option value="1" selected>Admin</option>
                                            <option value="2">Employee</option>
                                            <option value="3">Observer</option>
                                        </select> 
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="usr_name">Username <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="usr_name" placeholder="Enter Username" value="{{ old('usr_name') }}" required/>
                                        </div>
                                    </div>    
                                    <div class="col-md-5">
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

</script>

@endsection
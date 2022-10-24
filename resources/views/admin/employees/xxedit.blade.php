@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('AdminController@main') }}">Home</a></li>
                        <li class="breadcrumb-item">Users</li>
                        <li class="breadcrumb-item">Update</li>
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
                            <h3 class="card-title"><span class="fa fa-user-plus"></span> Create New User</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ action('UserController@update') }}">
                            {{ csrf_field() }} 
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="usr_code">ID Number<span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" name="usr_code" value="{{ $user->usr_code }}" required/>
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <label for="usr_name">Name (Last Name, First name & Middle Initial)<span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" name="usr_name" value="{{ $user->usr_name }}" required/>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="rol_id">Select User Role(s):</label>
                                        <select class="select2" multiple="multiple" data-placeholder="Select role(s)" style="width:100%;" name="rol_id[]" required>
                                            @foreach($roles as $role)
                                                @if(checkUserRole($user->usr_id,$role->rol_id) == true)
                                                    <option value="{{ $role->rol_id }}" selected>{{ $role->rol_name }}</option>
                                                @else 
                                                    <option value="{{ $role->rol_id }}">{{ $role->rol_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="dep_id">Select User Department(s):</label>
                                        <select class="select2" multiple="multiple" data-placeholder="Select department(s)" style="width:100%;" name="dep_id[]" required>
                                            @foreach($departments as $department)
                                                @if(checkUserDepartment($user->usr_id,$department->dep_id) == true)
                                                    <option value="{{ $department->dep_id }}" selected>{{ $department->dep_name }}</option>
                                                @else 
                                                    <option value="{{ $department->dep_id }}">{{ $department->dep_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <input type="hidden" name="usr_id" value="{{ $user->usr_id }}">
                                       <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Save Changes</button> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@extends('layouts.themes.admin.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">User Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                            <li class="breadcrumb-item active">User Form</li>
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
                                <h3 class="card-title"><i class="fa fa-file-text"></i> User Form</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                                {{ csrf_field() }} 
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="search_string">Find User</label>
                                                @if(isset($search_string))
                                                    <input type="text" class="form-control" name="search_string" placeholder="Full Name" value="{{ $search_string }}" required/>
                                                @else
                                                    <input type="text" class="form-control" name="search_string" placeholder="Full Name" required/>
                                                @endif
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
                </div>
            </div>
        </section>
        <div class="col-md-12"> 
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users"></i> Users</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th width="50px"></th>
                                <th> Name</th>
                                <th>Username</th>
                                <th width="100px">Status</th>
                                <th width="100px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($employees))
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>
                                            @if($employee->emp_image <> '')
                                                <div class="user-panel">
                                                    <div class="image">
                                                        <img src="{{ asset('images/employees/' . $employee->emp_image) }}" class="img-circle elevation-2" alt="User Image">
                                                    </div>
                                                </div>
                                            @else
                                                <div class="user-panel">
                                                    <div class="image">
                                                        <img src="{{ asset('images/employees/default.png') }}" class="img-circle elevation-2" alt="User Image">
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                        <td>   
                                            <a href="#">
                                                {{ $employee->emp_last_name }}, {{ $employee->emp_first_name }} {{ $employee->emp_middle_name }}
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td>{{ $employee->emp_email }}</td>
                                        <td>
                                            @if($employee->emp_active == '1')
                                                <span class="badge badge-success">Active</span>
                                                <i class="fa fa-toggle-on" aria-hidden="true"></i>
                                            @else 
                                                <span class="badge badge-danger">Inactive</span>
                                                <i class="fa fa-toggle-off" aria-hidden="true"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-default btn-sm" href="javascript:void(0)"><i class="fa fa-key" aria-hidden="true"></i> Reset</a>
                                        </td>
                                    </tr> 
                                
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
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
                <div class="col-md-12 mb-2">
                    <a class="btn btn-primary" href="{{ action('UserController@create') }}"><span class="fa fa-plus-circle"></span> Create New</a>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><span class="fa fa-users"></span> System Users</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="120px">Last Active</th>
                                        <th>Name</th>
                                        <th width="120px" class="text-center"><i class="fa fa-cog"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                @if(getLastUserLogin($user->usr_id) == '')
                                                    <small>never</small>
                                                @else
                                                    <small>{{ \Carbon\Carbon::parse(getLastUserLogin($user->usr_id))->addHour(-8)->diffForHumans() }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $user->usr_name }} 
                                                @if($user->usr_active == '1')
                                                    <span class="badge badge-success">Active</span>
                                                @else 
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                                <br/>
                                                <small><span class="text-muted"></span>Role(s):</small><br/>
                                                @if(checkUserRole($user->usr_id,'1') == true)
                                                    <span class="badge badge-info"><span class="fa fa-user-secret"></span> Admin</span>
                                                @endif
                                                @if(checkUserRole($user->usr_id,'2') == true)
                                                    <span class="badge badge-info">Validator</span>
                                                @endif
                                                @if(checkUserRole($user->usr_id,'3') == true)
                                                    <span class="badge badge-info">Department Head</span>
                                                @endif
                                                @if(checkUserRole($user->usr_id,'4') == true)
                                                    <span class="badge badge-info">Verifier</span>
                                                @endif
                                                @if(checkUserRole($user->usr_id,'5') == true)
                                                    <span class="badge badge-info">Encoder</span>
                                                @endif
                                                @if(checkUserRole($user->usr_id,'6') == true)
                                                    <span class="badge badge-info">Report Viewing</span>
                                                @endif

                                                @if(isUserDeptHead($user->usr_id) == true)
                                                    <br/>
                                                    <small><span class="text-muted"></span>Department(s):</small><br/>
                                                    @foreach(getUserDepartments($user->usr_id) AS $dep_id)
                                                        <span class="badge badge-warning">{{ getDepartmentShortName($dep_id) }}</span>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->usr_active == '1')
                                                    <a class="btn btn-danger btn-sm" href="{{ action('UserController@deactivate',[$user->usr_id]) }}"><span class="fa fa-user-minus"></span></a>
                                                @else 
                                                    <a class="btn btn-success btn-sm" href="{{ action('UserController@activate',[$user->usr_id]) }}"><span class="fa fa-user-plus"></span></a>
                                                @endif
                                                <a class="btn btn-info btn-sm" href="{{ action('UserController@view',[$user->usr_id]) }}"><span class="fa fa-eye"></span></a>
                                            </td>
                                        </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
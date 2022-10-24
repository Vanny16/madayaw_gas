@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Employees</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Manage Employees</li>
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
                            <h3 class="card-title"><i class="fas fa-user"></i> Find Employee</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="{{ action('EmployeeController@manage2') }}">
                            {{ csrf_field() }} 
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="search_string">Find Employee</label>
                                            @if(isset($search_string))
                                                <input type="text" class="form-control" name="search_string" placeholder="Last Name" value="{{ $search_string }}" required/>
                                            @else
                                                <input type="text" class="form-control" name="search_string" placeholder="Last Name" required/>
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

                <div class="col-md-12 mb-3"> 
                    <a class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#addEmployeeModal"><i class="fa fa-user-plus"></i> New Employee</a>
                </div>

                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-users"></i> Employees</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="50px"></th>
                                        <th>Employee Name</th>
                                        <th>Username</th>
                                        <th width="100px">Status</th>
                                        <th width="100px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($users))
                                        @foreach($users as $user)
                                            <tr>
                                                <td>
                                                     @if($user->emp_image <> '')
                                                        <div class="user-panel">
                                                            <div class="image">
                                                                <img src="{{ asset('images/employees/' . $user->usr_image) }}" class="img-circle elevation-2" alt="User Image">
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
                                                        {{ $user->usr_full_name }}
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                                <td>{{ $user->usr_name }}</td>
                                                <td>
                                                    @if($user->usr_active == '1')
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
                                            {{-- <div id="remarksModal-{{$dtr_record->tme_id}}" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Set Remarks</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <form method="POST" action="{{ action('DTRController@setRemarks') }}">
                                                        {{ csrf_field() }} 
                                                            <div class="modal-body">
                                                                <div class="col-md-12 mb-3">
                                                                    <label for="tme_remarks">Remarks<span style="color:red;">*</span></label>
                                                                    <input class="form-control" type="text" name="tme_remarks" value="{{ $dtr_record->tme_remarks }}" required/>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="tme_id" value="{{ $dtr_record->tme_id }}" required/>
                                                                @if(isset($date_from))
                                                                <input type="hidden" name="date_from" value="{{ $date_from }}" required/>
                                                                <input type="hidden" name="date_to" value="{{ $date_to }}" required/>
                                                                @endif
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Save</button> 
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ action('EmployeeController@save') }}">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="emp_last_name">Full Name <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="usr_full_name" placeholder="Full Name" value="{{ old('usr_full_name') }}" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="usr_name">Username <span style="color:red">*</span></label>
                                <input type="email" class="form-control" name="usr_name" value="{{ old('emp_email') }}" required/>
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

@endsection
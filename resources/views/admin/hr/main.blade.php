@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Leave Processing</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Processing</li>
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
        <form class="form-horizontal" method="POST" action="{{ action('LeaveController@leaveprocessing') }}">
        {{ csrf_field() }}     
            <div class="row">
                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-address-card"></i> Approving Officer</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="120px">Employees</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Type of Leave</th>
                                        <th>Date File</th>
                                        <th>Approving Officer</th>
                                        <th>Route</th>
                                        <th width="20px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($leave_process))
                                        @foreach($leave_process as $process)
                                            <tr>
                                            @if($process->lve_active == 0)
                                                @continue
                                            @else
                                                @if($process->lve_created_by == null)
                                                <td>-</td>
                                                @else
                                                <td>{{ $process->emp_last_name . ', ' . $process->emp_first_name }}</td>
                                                @endif
                                                @if($process->lve_date_from == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{{ \Carbon\Carbon::parse($process->lve_date_from)->format('Y-m-d') }}</td>
                                                @endif
                                                @if($process->lve_date_to == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{{ \Carbon\Carbon::parse($process->lve_date_to)->format('Y-m-d') }}</td>
                                                @endif
                                                @if($process->lvet_id == null && $process->lve_attach_name == null)
                                                    <td>-</td>
                                                @elseif($process->lvet_id != null && $process->lve_attach_name == null)
                                                <td>{{ $process->lvet_type }}</td>
                                                @else
                                                    <td>{{ $process->lvet_type }} <a class="btn-sm float-center" href="{{ action('LeaveController@download',[$process->lve_attach_name]) }}"><span class="fa fa-paperclip" aria-hidden="true"></span></td>
                                                @endif
                                                @if($process->lve_date_created == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{{ \Carbon\Carbon::parse($process->lve_date_created)->format('Y-m-d') }}</td>
                                                @endif
                                                @if($process->lve_approving_officer == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{{ $process->emp_last_name . ', ' . $process->emp_first_name }}</td>
                                                @endif
                                                @if(is_null($process->route_id))
                                                    <td>-</td>
                                                @else
                                                    @if($process->route_id == -1)
                                                    <td><span class="badge badge-danger">Disapproved</span></td>
                                                    @elseif($process->route_id == 0)
                                                    <td><span class="badge badge-warning">For Approval Supervisor</span></td>
                                                    @elseif($process->route_id == 1)
                                                    <td><span class="badge badge-warning">For Approval HR</span></td>
                                                    @elseif($process->route_id == 2)
                                                    <td><span class="badge badge-success">Approved</span></td>
                                                    @endif
                                                    <td><a class="btn btn-success btn-sm" href="{{ action('LeaveController@leaveapproval', $process->lve_id) }}"><span class="fa fa-check"></span></button></td>
                                                    <td><a class="btn btn-danger btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#reasonModal-{{$process->lve_id}}"><span class="fa fa-times"></span></button></td>
                                                @endif
                                            @endif    
                                                
                                            </tr>
                    
                                            <div id="reasonModal-{{$process->lve_id}}" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Disapproved</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <form method="POST" action="{{ action('LeaveController@leavedisapproved', $process->lve_id) }}">
                                                        {{ csrf_field() }} 
                                                            <div class="modal-body">
                                                                <div class="col-md-12 mb-3">
                                                                    <label for="lve_reason">Reason<span style="color:red;">*</span></label>
                                                                    <input class="form-control" type="text" name="lve_reason" value="{{ $process->lve_reason }}" required/>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="close" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-address-card"></i> HR Approval</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="120px">Employees</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Type of Leave</th>
                                        <th>Date File</th>
                                        <th>Approving Officer</th>
                                        <th>Route</th>
                                        <th width="20px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($lve_hr_process))
                                        @foreach($lve_hr_process as $hr_process)
                                            <tr>
                                            @if($hr_process->lve_active == 0)
                                                @continue
                                            @else
                                                @if($hr_process->lve_created_by == null)
                                                <td>-</td>
                                                @else
                                                <td>{{ $hr_process->emp_last_name . ', ' . $hr_process->emp_first_name }}</td>
                                                @endif
                                                @if($hr_process->lve_date_from == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{{ \Carbon\Carbon::parse($hr_process->lve_date_from)->format('Y-m-d') }}</td>
                                                @endif
                                                @if($process->lve_date_to == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{{ \Carbon\Carbon::parse($hr_process->lve_date_to)->format('Y-m-d') }}</td>
                                                @endif
                                                @if($hr_process->lvet_id == null && $hr_process->lve_attach_name == null)
                                                    <td>-</td>
                                                @elseif($hr_process->lvet_id != null && $hr_process->lve_attach_name == null)
                                                <td>{{ $hr_process->lvet_type }}</td>
                                                @else
                                                    <td>{{ $hr_process->lvet_type }} <a class="btn-sm float-center" href="{{ action('LeaveController@download',[$hr_process->lve_attach_name]) }}"><span class="fa fa-paperclip" aria-hidden="true"></span></td>
                                                @endif
                                                @if($hr_process->lve_date_created == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{{ \Carbon\Carbon::parse($hr_process->lve_date_created)->format('Y-m-d') }}</td>
                                                @endif
                                                @if($hr_process->lve_approving_officer == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{{ $hr_process->emp_last_name . ', ' . $hr_process->emp_first_name }}</td>
                                                @endif
                                                @if(is_null($hr_process->route_id))
                                                    <td>-</td>
                                                @else
                                                    @if($hr_process->route_id == -1)
                                                    <td><span class="badge badge-danger">Disapproved</span></td>
                                                    @elseif($hr_process->route_id == 0)
                                                    <td><span class="badge badge-warning">For Approval Supervisor</span></td>
                                                    @elseif($hr_process->route_id == 1)
                                                    <td><span class="badge badge-warning">For Approval HR</span></td>
                                                    @elseif($hr_process->route_id == 2)
                                                    <td><span class="badge badge-success">Approved</span></td>
                                                    @endif
                                                    <td><a class="btn btn-success btn-sm" href="{{ action('LeaveController@leaveapproval', $hr_process->lve_id) }}"><span class="fa fa-check"></span></button></td>
                                                    <td><a class="btn btn-danger btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#reasonModal-{{$hr_process->lve_id}}"><span class="fa fa-times"></span></button></td>
                                                @endif
                                            @endif    
                                                
                                            </tr>
                    
                                            <div id="reasonModal-{{$hr_process->lve_id}}" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Disapproved</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <form method="POST" action="{{ action('LeaveController@leavedisapproved', $hr_process->lve_id) }}">
                                                        {{ csrf_field() }} 
                                                            <div class="modal-body">
                                                                <div class="col-md-12 mb-3">
                                                                    <label for="lve_reason">Reason<span style="color:red;">*</span></label>
                                                                    <input class="form-control" type="text" name="lve_reason" value="{{ $hr_process->lve_reason }}" required/>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="close" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>

@endsection
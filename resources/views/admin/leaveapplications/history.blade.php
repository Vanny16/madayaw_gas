@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Leave History</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item active">History</li>
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
        <form class="form-horizontal" method="POST" action="{{ action('LeaveController@history') }}">
        {{ csrf_field() }}     
            <div class="row">
                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-address-card"></i> Leave History</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <div class="card-body overflow-auto"   style="overflow-x: auto;">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="120px">ID</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Type of Leave</th>
                                        <th>Date File</th>
                                        <th>Remaining Leave</th>
                                        <th>Approving Officer</th>
                                        <th>Route</th>
                                        <th width="20px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($leave_history))
                                        @foreach($leave_history as $history)
                                            <tr>
                                                @if($history->lve_active == 0)
                                                    @continue
                                                @else
                                                    @if($history->lve_id == null)
                                                        <td>-</td>
                                                    @else
                                                        <td>{{ $history->lve_id }}</td>
                                                    @endif
                                                    @if($history->lve_date_from == null)
                                                        <td>-</td>
                                                    @else
                                                        <td>{{ \Carbon\Carbon::parse($history->lve_date_from)->format('Y-m-d') }}</td>
                                                    @endif
                                                    @if($history->lve_date_to == null)
                                                        <td>-</td>
                                                    @else
                                                        <td>{{ \Carbon\Carbon::parse($history->lve_date_to)->format('Y-m-d') }}</td>
                                                    @endif
                                                    @if($history->lvet_id == null && $history->lve_attach_name == null)
                                                        <td>-</td>
                                                    @elseif($history->lvet_id != null && $history->lve_attach_name == null)
                                                        <td>{{ $history->lvet_type }}</td>
                                                    @else
                                                        <td>{{ $history->lvet_type }} <a class="btn-sm float-center" href="{{ action('LeaveController@download',[$history->lve_attach_name]) }}"><span class="fa fa-paperclip" aria-hidden="true"></span></button></td>
                                                    @endif
                                                    @if($history->lve_date_created == null)
                                                        <td>-</td>
                                                    @else
                                                        <td>{{ \Carbon\Carbon::parse($history->lve_date_created)->format('Y-m-d') }}</td>
                                                    @endif
                                                    @if($history->lve_remaining == null)
                                                        <td><span class="badge badge-primary">10</span></td>
                                                    @else
                                                        <td>{{$history->lve_remaining}}</td>
                                                    @endif
                                                    @if($history->lve_approving_officer == null)
                                                        <td>-</td>
                                                    @else
                                                        <td>{{ $history->emp_last_name . ', ' . $history->emp_first_name }}</td>
                                                    @endif
                                                    @if(is_null($history->route_id))
                                                        <td>-</td>
                                                    @else
                                                        @if($history->route_id == -1)
                                                        <td><span class="badge badge-danger">Disapproved</span></td>
                                                        @elseif($history->route_id == 0)
                                                        <td><span class="badge badge-warning">For Approval Supervisor</span></td>
                                                        @elseif($history->route_id == 1)
                                                        <td><span class="badge badge-warning">For Approval HR</span></td>
                                                        @elseif($history->route_id == 2)
                                                        <td><span class="badge badge-success">Approved</span></td>
                                                        @endif
                                                    @endif
                                                    @if($history->route_id == 1 || $history->route_id == 0)
                                                    <td><a class="btn btn-danger btn-sm" href="{{ action('LeaveController@remove',[$history->lve_id]) }}"><span class="fa fa-trash"></span></td>
                                                    @elseif($history->route_id == -1)
                                                    <td><small><a class="btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#reasonModal-{{$history->lve_id}}"><span class="fa fa-comment-alt" style="font-size:20px;color:red"></span></button></small></td>
                                                    @endif
                                                @endif
                                            </tr>
                                            <div id="reasonModal-{{$history->lve_id}}" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Disapproved</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-12 mb-3">
                                                                <label for="lve_reason">Reason<span style="color:red;">*</span></label>
                                                                <input class="form-control" type="text" name="lve_reason" value="{{ $history->lve_reason }}" readonly required/>
                                                            </div>
                                                        </div>
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
@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">DTR</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item active">DTR</li>
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
                            <h3 class="card-title"><i class="fas fa-calendar"></i> Select Date</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="{{ action('DTRController@timecardAll2') }}">
                            {{ csrf_field() }} 
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="date_from">From</label>
                                            @if(isset($date_from))
                                                <input type="date" class="form-control" name="date_from" value="{{ Carbon\Carbon::parse($date_from)->format('Y-m-d') }}" required/>
                                            @else
                                                <input type="date" class="form-control" name="date_from" required/>
                                            @endif
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="date_to">To</label>
                                            @if(isset($date_from))
                                                <input type="date" class="form-control" name="date_to" value="{{ Carbon\Carbon::parse($date_to)->format('Y-m-d') }}" required/>
                                            @else
                                                <input type="date" class="form-control" name="date_to" required/>
                                            @endif
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="emp_id">Employee</label>
                                            <select class="form-control" name="emp_id" required>
                                                @foreach($employees as $employee)
                                                    @if(isset($emp_id))
                                                        @if($emp_id == $employee->emp_id)
                                                            <option value="{{ $employee->emp_id }}" selected>{{ $employee->emp_last_name }}, {{ $employee->emp_first_name }} {{ $employee->emp_middle_name }}</option>
                                                        @else 
                                                            <option value="{{ $employee->emp_id }}">{{ $employee->emp_last_name }}, {{ $employee->emp_first_name }} {{ $employee->emp_middle_name }}</option>
                                                        @endif
                                                    @else
                                                        <option value="{{ $employee->emp_id }}">{{ $employee->emp_last_name }}, {{ $employee->emp_first_name }} {{ $employee->emp_middle_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <button type="submit" class="btn btn-success"><span class="fa fa-search"></span> Find</button> 
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-clock"></i> Daily Time Record</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="120px">Date</th>
                                        <th>AM IN</th>
                                        <th>AM OUT</th>
                                        <th>PM IN</th>
                                        <th>PM OUT</th>
                                        <th>OT IN</th>
                                        <th>OT OUT</th>
                                        <th>REG HRS.</th>
                                        <th>OT HRS.</th>
                                        <th>REMARKS</th>
                                        <th width="20px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($dtr_records))
                                        @foreach($dtr_records as $dtr_record)
                                            <tr>
                                                <td>{{ $dtr_record->tme_date }}</td>
                                                @if($dtr_record->tme_am_in == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{{ \Carbon\Carbon::parse($dtr_record->tme_am_in)->format('h:i A') }}</td>
                                                @endif
                                                @if($dtr_record->tme_am_out == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{{ \Carbon\Carbon::parse($dtr_record->tme_am_out)->format('h:i A') }}</td>
                                                @endif
                                                @if($dtr_record->tme_pm_in == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{{ \Carbon\Carbon::parse($dtr_record->tme_pm_in)->format('h:i A') }}</td>
                                                @endif
                                                @if($dtr_record->tme_pm_out == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{{ \Carbon\Carbon::parse($dtr_record->tme_pm_out)->format('h:i A') }}</td>
                                                @endif
                                                @if($dtr_record->tme_ot_in == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{{ \Carbon\Carbon::parse($dtr_record->tme_ot_in)->format('h:i A') }}</td>
                                                @endif
                                                @if($dtr_record->tme_ot_out == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{{ \Carbon\Carbon::parse($dtr_record->tme_ot_out)->format('h:i A') }}</td>
                                                @endif

                                                <td>{{ $dtr_record->tme_reg_total }}</td>
                                                <td>{{ $dtr_record->tme_ot_total }}</td>
                                                <td><small>{{ $dtr_record->tme_remarks }}</small></td>
                                                <td>
                                                    @if($dtr_record->tme_is_closed == '0')
                                                        <small><a href="javascript:void(0)" data-toggle="modal" data-target="#remarksModal-{{$dtr_record->tme_id}}"><span class="fa fa-edit"></span></button></small>
                                                    @endif
                                                </td>
                                            </tr> 
                                            <div id="remarksModal-{{$dtr_record->tme_id}}" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Set Remarks</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <form method="POST" action="{{ action('DTRController@setAllRemarks') }}">
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
                                                                <input type="hidden" name="emp_id" value="{{ $emp_id }}" required/>
                                                                @endif
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                @if(isset($dtr_records))
                    <div class="col-md-12">
                        <a class="btn btn-info" href="{{ action('PrintController@dtr',[$date_from,$date_to,$emp_id]) }}" target="_BLANK"><i class="fa fa-print"></i> Print</a>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection
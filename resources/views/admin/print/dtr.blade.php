@extends('layouts.themes.admin.print')
@section('content')
<div class="row">
    <div class="col-md-12"> 
        <img src="{{ asset('images/accounts/' . get_company_image($employee->acc_id)) }}" class="brand-image img-circle">
        <h3 style="text-align:center;">{{ get_company_name($employee->acc_id) }}</h3>
        <p style="text-align:center;">{{ $employee->emp_last_name }}, {{ $employee->emp_first_name }} {{ $employee->emp_middle_name }}</p>
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
</div>
<script type="text/javascript"> 
    window.addEventListener("load", window.print());
</script>
@endsection
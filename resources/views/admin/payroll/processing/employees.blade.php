@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Payroll Processing</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item">Payroll</li>
                        <li class="breadcrumb-item">Processing</li>
                        <li class="breadcrumb-item active">Employees</li>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal"><span class="fa fa-plus-circle"></span> New Employee Payroll</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-users" aria-hidden="true"></i> Payroll Accounts Created - {{ get_year_name($yr_id) }} / {{ get_month_name($mos_id) }} / {{ get_term_name($trm_id) }}</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>Employee</th>
                                        <th>Income</th>
                                        <th>Deductions</th>
                                        <th>Net</th>
                                        <th width="150px" class="text-center"><i class="fa fa-cog"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($payrolls as $payroll)
                                        <tr>
                                            <td>{{ $payroll->emp_last_name }}, {{ $payroll->emp_first_name }} {{ $payroll->emp_middle_name }}</td>
                                            <td>{{ number_format($payroll->pay_income,2) }}</td>
                                            <td>{{ number_format($payroll->pay_deductions,2) }}</td>
                                            <td>{{ number_format($payroll->pay_income-$payroll->pay_deductions,2) }}</td>
                                            <td>
                                                <a class="btn btn-info btn-sm" href="{{ action('PrintController@payslip',[$payroll->pay_uuid]) }}" target="_BLANK"><i class="fa fa-print"></i></a>
                                                <a class="btn btn-warning btn-sm" href="{{ action('PayrollController@editEmployeePayroll',[$payroll->pay_id]) }}"><span class="fa fa-edit"></span></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-{{$payroll->pay_uuid}}"><span class="fa fa-trash"></span></button>
                                            </td>
                                        </tr>
                                        <div id="deleteModal-{{$payroll->pay_uuid}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Please Confirm!</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to remove <strong>{{ $payroll->emp_last_name }}, {{ $payroll->emp_first_name }} {{ $payroll->emp_middle_name }}'s </strong> payroll account?<p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <a class="btn btn-danger" href="{{ action('PayrollController@removePayroll',[$payroll->pay_uuid,$yr_id,$mos_id,$trm_id]) }}"><span class="fa fa-trash"></span> Delete</a> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
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

<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Employee Payroll</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="{{ action('PayrollController@createEmployeePayroll') }}">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="emp_id" class="col-md-12 col-form-label">Employee</label>
                        <div class="col-md-12">
                            <select class="select2" name="emp_id" required>
                                @foreach($employees as $employee)
                                    @if(is_employee_payroll_active($employee->emp_id,$yr_id,$mos_id,$trm_id) ==  false)
                                        <option value="{{ $employee->emp_id }}">{{ $employee->emp_last_name }}, {{ $employee->emp_first_name }} {{ $employee->emp_middle_name }}</option>
                                    @endif
                                @endforeach
                            </select> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="yr_id" value="{{ $yr_id }}" required />
                    <input type="hidden" name="mos_id" value="{{ $mos_id }}" required />
                    <input type="hidden" name="trm_id" value="{{ $trm_id }}" required />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span> Create</button> 
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
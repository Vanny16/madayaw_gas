@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Payslip</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Payslip</li>
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
                            <h3 class="card-title"><i class="fa fa-calendar" aria-hidden="true"></i> Select Payroll Period</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ action('PayrollController@payslipMain2') }}">
                            {{ csrf_field() }} 
                                <div class="form-group row">
                                    <label for="yr_id" class="col-sm-2 col-form-label">Year</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="yr_id" required>
                                            @foreach($period_years as $period_year)
                                                @if(isset($yr_id))
                                                    @if($yr_id == $period_year->yr_id)
                                                        <option value="{{ $period_year->yr_id }}" selected>{{ $period_year->yr_name }}</option>
                                                    @else 
                                                        <option value="{{ $period_year->yr_id }}">{{ $period_year->yr_name }}</option>
                                                    @endif
                                                @else
                                                    <option value="{{ $period_year->yr_id }}">{{ $period_year->yr_name }}</option>
                                                @endif
                                            @endforeach
                                        </select> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="mos_id" class="col-sm-2 col-form-label">Month</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="mos_id" required>
                                            @foreach($period_months as $period_month)
                                                @if(isset($mos_id))
                                                    @if($mos_id == $period_month->mos_id)
                                                        <option value="{{ $period_month->mos_id }}" selected>{{ $period_month->mos_name }}</option>
                                                    @else 
                                                        <option value="{{ $period_month->mos_id }}">{{ $period_month->mos_name }}</option>
                                                    @endif
                                                @else
                                                    <option value="{{ $period_month->mos_id }}">{{ $period_month->mos_name }}</option>
                                                @endif
                                            @endforeach
                                        </select> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="trm_id" class="col-sm-2 col-form-label">Term</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="trm_id" required>
                                            @foreach($period_terms as $period_term)
                                                @if(isset($trm_id))
                                                    @if($trm_id == $period_term->trm_id)
                                                        <option value="{{ $period_term->trm_id }}" selected>{{ $period_term->trm_name }}</option>
                                                    @else 
                                                        <option value="{{ $period_term->trm_id }}">{{ $period_term->trm_name }}</option>
                                                    @endif
                                                @else
                                                    <option value="{{ $period_term->trm_id }}">{{ $period_term->trm_name }}</option>
                                                @endif
                                            @endforeach
                                        </select> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-arrow-circle-right"></i> Proceed</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if(isset($payroll))
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-user" aria-hidden="true"></i> Payroll Account</h3>
                            </div>
                            <div class="card-body">
                                <p>Employee: <strong>{{ $payroll->emp_last_name }} , {{ $payroll->emp_first_name }} {{ $payroll->emp_middle_name }}</strong></p>
                                <p>Pay Period: <strong>{{ get_year_name($payroll->yr_id) }} / {{ get_month_name($payroll->mos_id) }} / {{ get_term_name($payroll->trm_id) }}</strong></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Income</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-condensed">
                                    <tbody>
                                        @foreach($payroll_incomes as $payroll_income)
                                            <tr>
                                                <td>{{ $payroll_income->inc_name }}</td>
                                                <td style="text-align:right">{{ number_format($payroll_income->pin_amount,2) }} </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td><strong>Total</strong></td>
                                            <td style="text-align:right"><strong>{{ number_format($payroll->pay_income,2) }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Deductions</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-condensed">
                                    <tbody>
                                        @foreach($payroll_deductions as $payroll_deduction)
                                            <tr>
                                                <td>{{ $payroll_deduction->ded_name }}</td>
                                                <td style="text-align:right">{{ number_format($payroll_deduction->pde_amount,2) }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td><strong>Total</strong></td>
                                            <td style="text-align:right"><strong>{{ number_format($payroll->pay_deductions,2) }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Net</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-condensed">
                                    <tbody>
                                        <tr>
                                            <td>Income</td>
                                            <td style="text-align:right"><strong>{{ number_format($payroll->pay_income,2) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Deductions</td>
                                            <td style="text-align:right"><strong>-{{ number_format($payroll->pay_deductions,2) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Net Total</strong></td>
                                            <td style="text-align:right"><strong>{{ number_format($payroll->pay_income-$payroll->pay_deductions,2) }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <a class="btn btn-info" href="{{ action('PrintController@payslip',[$payroll->pay_uuid]) }}" target="_BLANK"><i class="fa fa-print"></i> Print</a>
                    </div>
                </div>
            @endif
            
        </div>
    </section>
</div>
@endsection
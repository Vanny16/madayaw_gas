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
                        <li class="breadcrumb-item active">Edit</li>
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
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
							<div class="text-center">
								<a href="javascript:void(0);" data-toggle="modal" data-target="#avatarUploadModal">
									<img class="profile-user-img img-fluid img-circle" src="{{ asset('images/employees/' . get_employee_image($payroll->emp_id)) }}" alt="User profile picture" />
								</a>
							</div>
                            <h3 class="profile-username text-center">{{ $payroll->emp_last_name }} , {{ $payroll->emp_first_name }} {{ $payroll->emp_middle_name }}</h3>
                            <p class="text-muted text-center">{{ get_year_name($payroll->yr_id) }} / {{ get_month_name($payroll->mos_id) }} / {{ get_term_name($payroll->trm_id) }}</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <p><strong>Income</strong> <a style="color:green;" href="javascript:void(0)" data-toggle="modal" data-target="#addIncomeModal"><i class="fa fa-plus-circle"></i></a></p>                                  
                                            <table class="table table-condensed">
                                                <tbody>
                                                    @foreach($payroll_incomes as $payroll_income)
                                                        <tr>
                                                            <td>
                                                                <a style="color:red;" href="javascript:void(0)" data-toggle="modal" data-target="#deleteIncomeModal-{{$payroll_income->pin_uuid}}"><span class="fa fa-minus-circle"></span></a>
                                                                {{ $payroll_income->inc_name }}
                                                                </td>
                                                            <td style="text-align:right">{{ number_format($payroll_income->pin_amount,2) }} </td>
                                                        </tr>
                                                        <div id="deleteIncomeModal-{{$payroll_income->pin_uuid}}" class="modal fade" role="dialog">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Please Confirm!</h4>
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Are you sure you want to remove <strong>{{ $payroll_income->inc_name }} </strong>?<p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        <a class="btn btn-danger" href="{{ action('PayrollController@removeIncome',[$payroll_income->pin_uuid,$payroll_income->pin_amount,$payroll->pay_id]) }}"><span class="fa fa-trash"></span> Delete</a> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    @endforeach
                                                    {{-- <tr>
                                                        <td><strong>Total</strong></td>
                                                        <td style="text-align:right"><strong>{{ number_format($payroll->pay_income,2) }}</strong></td>
                                                    </tr> --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <p><strong>Deductions</strong> <a style="color:green;" href="javascript:void(0)" data-toggle="modal" data-target="#addDeductionModal"><i class="fa fa-plus-circle"></i></a></p>
                                            <table class="table table-condensed">
                                                <tbody>
                                                    @foreach($payroll_deductions as $payroll_deduction)
                                                        <tr>
                                                            <td>
                                                                <a style="color:red;" href="javascript:void(0)" data-toggle="modal" data-target="#deleteDeductionModal-{{$payroll_deduction->pde_uuid}}"><span class="fa fa-minus-circle"></span></a>
                                                                {{ $payroll_deduction->ded_name }}
                                                            </td>
                                                            <td style="text-align:right">{{ number_format($payroll_deduction->pde_amount,2) }}</td>
                                                        </tr>
                                                        <div id="deleteDeductionModal-{{$payroll_deduction->pde_uuid}}" class="modal fade" role="dialog">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Please Confirm!</h4>
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Are you sure you want to remove <strong>{{ $payroll_deduction->ded_name }} </strong>?<p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        <a class="btn btn-danger" href="{{ action('PayrollController@removeIncome',[$payroll_deduction->pde_uuid,$payroll_deduction->pde_amount,$payroll->pay_id]) }}"><span class="fa fa-trash"></span> Delete</a> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    @endforeach
                                                    {{-- <tr>
                                                        <td><strong>Total</strong></td>
                                                        <td style="text-align:right"><strong>{{ number_format($payroll->pay_deductions,2) }}</strong></td>
                                                    </tr> --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="card">
                                        <div class="card-body">                           
                                            <p><strong>Net Income</strong></p>
                                            <table class="table table-condensed">
                                                <tbody>
                                                    <tr>
                                                        <td>Total Income</td>
                                                        <td style="text-align:right"><strong>{{ number_format($payroll->pay_income,2) }}</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Deductions</td>
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
                        </div>
                    </div>
                </div>

                {{-- <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Income <a style="color:green;" href="javascript:void(0)" data-toggle="modal" data-target="#addIncomeModal"><i class="fa fa-plus-circle"></i></a></h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-condensed">
                                <tbody>
                                    @foreach($payroll_incomes as $payroll_income)
                                        <tr>
                                            <td>
                                                <a style="color:red;" href="javascript:void(0)" data-toggle="modal" data-target="#deleteIncomeModal-{{$payroll_income->pin_uuid}}"><span class="fa fa-minus-circle"></span></a>
                                                {{ $payroll_income->inc_name }}
                                                </td>
                                            <td style="text-align:right">{{ number_format($payroll_income->pin_amount,2) }} </td>
                                        </tr>
                                        <div id="deleteIncomeModal-{{$payroll_income->pin_uuid}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Please Confirm!</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to remove <strong>{{ $payroll_income->inc_name }} </strong>?<p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <a class="btn btn-danger" href="{{ action('PayrollController@removeIncome',[$payroll_income->pin_uuid,$payroll_income->pin_amount,$payroll->pay_id]) }}"><span class="fa fa-trash"></span> Delete</a> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
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
                            <h3 class="card-title">Deductions <a style="color:green;" href="javascript:void(0)" data-toggle="modal" data-target="#addDeductionModal"><i class="fa fa-plus-circle"></i></a></h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-condensed">
                                <tbody>
                                    @foreach($payroll_deductions as $payroll_deduction)
                                        <tr>
                                            <td>
                                                <a style="color:red;" href="javascript:void(0)" data-toggle="modal" data-target="#deleteDeductionModal-{{$payroll_deduction->pde_uuid}}"><span class="fa fa-minus-circle"></span></a>
                                                {{ $payroll_deduction->ded_name }}
                                            </td>
                                            <td style="text-align:right">{{ number_format($payroll_deduction->pde_amount,2) }}</td>
                                        </tr>
                                        <div id="deleteDeductionModal-{{$payroll_deduction->pde_uuid}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Please Confirm!</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to remove <strong>{{ $payroll_deduction->ded_name }} </strong>?<p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <a class="btn btn-danger" href="{{ action('PayrollController@removeIncome',[$payroll_deduction->pde_uuid,$payroll_deduction->pde_amount,$payroll->pay_id]) }}"><span class="fa fa-trash"></span> Delete</a> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
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
                </div> --}}
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <a class="btn btn-info" href="{{ action('PrintController@payslip',[$payroll->pay_uuid]) }}" target="_BLANK"><i class="fa fa-print"></i> Print</a>
                    <a class="btn btn-info" href="{{ action('DTRController@timecardAll') }}" target="_BLANK"><i class="fa fa-calendar"></i> View DTR</a>
                </div>
            </div>
        </div>
    </section>
</div>

<div id="addIncomeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Employee Income</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="{{ action('PayrollController@saveIncome') }}">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="inc_id" class="col-md-12 col-form-label">Income</label>
                        <div class="col-md-12">
                            <select class="select2" name="inc_id" required>
                                @foreach($payroll_income_accounts as $payroll_income_account)
                                    <option value="{{ $payroll_income_account->inc_id }}">{{ $payroll_income_account->inc_name }}</option>
                                @endforeach
                            </select> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pin_amount" class="col-md-12 col-form-label">Amount</label>
                        <div class="col-md-12">
                            <input class="form-control" type="number" step="0.01" name="pin_amount" value="0.00" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="pay_id" value="{{ $payroll->pay_id }}" required />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Save</button> 
                </div>
            </form>
        </div>
    </div>
</div>

<div id="addDeductionModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Employee Deduction</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="{{ action('PayrollController@saveDeduction') }}">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="ded_id" class="col-md-12 col-form-label">Deduction</label>
                        <div class="col-md-12">
                            <select class="select2" name="ded_id" required>
                                @foreach($payroll_deduction_accounts as $payroll_deduction_account)
                                    <option value="{{ $payroll_deduction_account->ded_id }}">{{ $payroll_deduction_account->ded_name }}</option>
                                @endforeach
                            </select> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pde_amount" class="col-md-12 col-form-label">Amount</label>
                        <div class="col-md-12">
                            <input class="form-control" type="number" step="0.01" name="pde_amount" value="0.00" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="pay_id" value="{{ $payroll->pay_id }}" required />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Save</button> 
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
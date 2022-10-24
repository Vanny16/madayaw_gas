@extends('layouts.themes.admin.print')
@section('content')

<table class="table table-condensed">
    <tr>
        <td>
            <img src="{{ asset('images/accounts/' . get_company_image($payroll->acc_id)) }}" class="brand-image img-circle">
        </td>
    </tr>
    <tr>
        <td colspan="3" style="text-align:center;">
            <h3>{{ get_company_name($payroll->acc_id) }}</h3>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <p>Employee: <strong>{{ $payroll->emp_last_name }} , {{ $payroll->emp_first_name }} {{ $payroll->emp_middle_name }}</strong></p>
            <p>Payroll Period: <strong>{{ get_year_name($payroll->yr_id) }} / {{ get_month_name($payroll->mos_id) }} / {{ get_term_name($payroll->trm_id) }}</strong></p>
        </td>
    </tr>
    <tr>
        <td>
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
        </td>
        <td>
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
        </td>
        <td>
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
        </td>
    </tr>
    <tr>
        <td colspan="3" style="text-align:center;"><small class="text-muted"><em>--- This is a system generated payslip ---</em></small></td>
    </tr>
</table>
<script type="text/javascript"> 
    window.addEventListener("load", window.print());
</script>
@endsection
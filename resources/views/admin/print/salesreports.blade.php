@extends('layouts.themes.admin.print')
@section('content')
<div class="row">
    <div class="col-md-12"> 
        <h3 style="text-align:center;"></h3>
        <p style="text-align:center;"></p>
    </div>
    <div class="col-md-12"> 
        <div class="card">
            <div class="card-header">
            
            <h3 class="card-title"><i class="fa fa-bar-chart"></i> Sales  Reports</h3>
           
        </div>
            <div class="card-body">
                <table class="table table-hover table-condensed">

               
                    <thead>
                        <tr>
                            <th>Reference ID</th>
                            <th>User</th>
                            <th>Customer</th>
                            <th>Date & Time</th>
                            <th>Total Sale</th>
                            <th>Amount Received</th>
                            <th>Balance</th>
                            <th width="20px"></th>
                        </tr>
                        <tr>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_sales_reports as $all_sales_report)
                        <tr>
                            <td>{{$all_sales_report->trx_ref_id}}</td>
                            <td>{{$all_sales_report->usr_name}}</td>
                            <td>{{$all_sales_report->cus_name}}</td>
                            <td>{{$all_sales_report->trx_datetime}}</td>
                            <td>₱ {{ number_format($all_sales_report->trx_total, 2, '.', ',')}}</td>
                            <td>₱ {{ number_format($all_sales_report->trx_amount_paid, 2, '.', ',')}}</td>
                            <td>₱ {{ number_format($all_sales_report->trx_balance, 2, '.', ',')}}</td>
                        </tr> 
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"> 
    window.addEventListener("load", window.print());
    // window.location.href = "{{ action('ReportsController@sales') }}";
</script>
@endsection
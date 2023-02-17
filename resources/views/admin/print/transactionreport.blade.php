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
            @if(isset($all_transaction_reports))    
            <h3 class="card-title"><i class="fa fa-bar-chart"></i> Transaction  Reports</h3>
            @else
            <h3 class="card-title"><i  class="fa fa-bar-chart"></i> Transaction Report</h3>
            @endif
        </div>
            <div class="card-body">
                <table class="table table-hover table-condensed">

                @if(isset($all_transaction_reports))
                    <thead>
                        <tr>
                            <th>Reference ID</th>
                            <th>User</th>
                            <th>Customer</th>
                            <th>Date & Time</th>
                            <th>Total Sale</th>
                            <th>Amount Received</th>
                            <th>Change</th>
                            <th width="20px"></th>
                        </tr>
                        <tr>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_transaction_reports as $all_transaction_report)
                        <tr>
                            <td>{{$all_transaction_report->trx_ref_id}}</td>
                            <td>{{$all_transaction_report->usr_name}}</td>
                            <td>{{$all_transaction_report->cus_name}}</td>
                            <td>{{$all_transaction_report->trx_datetime}}</td>
                            <td>₱ {{$all_transaction_report->trx_total}}</td>
                            <td>₱ {{$all_transaction_report->trx_amount_paid}}</td>
                            <td>₱ {{$all_transaction_report->trx_balance}}</td>
                        </tr> 
                        @endforeach
                    </tbody>

                @elseif(isset($transaction_reports))
                    <thead>
                        <tr>
                            <th>Reference ID</th>
                            <th>User</th>
                            <th>Customer</th>
                            <th>Date & Time</th>
                            <th>Total Sale</th>
                            <th>Amount Received</th>
                            <th>Change</th>
                            <th width="20px"></th>
                        </tr>
                        <tr>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction_reports as $transaction_report)
                        <tr>
                            <td>{{$all_transaction_report->trx_ref_id}}</td>
                            <td>{{$all_transaction_report->usr_name}}</td>
                            <td>{{$all_transaction_report->cus_name}}</td>
                            <td>{{$all_transaction_report->trx_datetime}}</td>
                            <td>{{$all_transaction_report->trx_total}}</td>
                            <td>{{$all_transaction_report->trx_amount_paid}}</td>
                            <td>{{$all_transaction_report->trx_balance}}</td>
                        </tr> 
                        @endforeach
                    </tbody>
                @endif
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"> 
    window.addEventListener("load", window.print());
    window.location.href = "{{ action('ReportsController@transactions') }}";
</script>
@endsection
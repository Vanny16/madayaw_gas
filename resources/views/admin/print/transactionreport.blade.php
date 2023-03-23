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
  
            <h3 class="card-title"><i class="fa fa-bar-chart"></i> Transaction  Reports</h3>
         
        </div>
            <div class="card-body">
                <table class="table table-hover table-condensed">


                        <thead>
                            <tr>
                                <th>Reference ID</th>
                                <th>User</th>
                                <th>Customer</th>
                                <th>Date & Time</th>
                                <th>Product Name</th>
                                <th>Crate</th>
                                <th>Loose</th>
                                <th width="20px"></th>
                            </tr>
                            <tr>
                            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_transaction_reports as $all_transaction_report)
                                @foreach($purchases as $purchase)
                                    @if($purchase->trx_id == $all_transaction_report->trx_id)
                                    <tr>
                                        <td>{{ $all_transaction_report->trx_ref_id }}</td>
                                        <td>{{ $all_transaction_report->usr_full_name }}</td>
                                        <td>{{ $all_transaction_report->cus_name }}</td>
                                        <td>{{ $all_transaction_report->trx_datetime }}</td>
                                        <td>{{ $purchase->prd_name }}</td>
                                        <td>{{ number_format($purchase->pur_crate, 0, '', ',') }}</td>
                                        <td>{{ number_format($purchase->pur_loose, 0, '', ',') }}</td>
                                    </tr>
                                    @endif
                                @endforeach  
                            @endforeach 
                        </tbody>  
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
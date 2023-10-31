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
                @if($transactions_date_from != "" && $transactions_date_to != "")
                    @if($transactions_date_from == date('Y-m-d') && $transactions_date_to == date('Y-m-d'))
                        @php
                            $date_from = Carbon\Carbon::parse()->format('Y-m-d');
                            $date_to = Carbon\Carbon::parse()->format('Y-m-d');
                            $date_label = "Today's Transactions";
                        @endphp
                    @else
                        @php
                            $date_from = $transactions_date_from;
                            $date_to = $transactions_date_to;
                            $date_label = "Transactions from ". $date_from ." to ". $date_to;
                        @endphp
                    @endif
                @else
                    @php
                        $date_from = Carbon\Carbon::parse()->format('Y-m-d');
                        $date_to = Carbon\Carbon::parse()->format('Y-m-d');
                        $date_label = "All Transactions";
                    @endphp
                @endif
                <div class="row">
                    <div class="col-md-12">
                        
                        <table>
                            <tr>
                                <td><img src="{{ asset('img/accounts/logo-1.jpg' ) }}" style="width:70px;"></td>
                                <td colspan="2">&nbsp; </td>
                                <td>
                                    <p class="ml-2">
                                        <strong>MADAYAW PETROLEUM AND GAS CORPORATION</strong><br>
                                        <small>Park Avenue Cor. Lakatan St., Brgy. Wilfredo Aquino, Agdao, Davao City</small>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <hr><br>
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title"><i class="fa fa-bar-chart"></i> Transaction Reports</h3><br>
                    </div>
                    <div class="col-md-6">
                        <small class="float-right">{{ $date_label }}</small>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Reference ID</th>
                            <th>Date & Time</th>
                            <th>Item (IN)</th>
                            <th>Qty (IN)</th>
                            <th>Item (OUT)</th>
                            <th>Qty (OUT)</th>
                            <th>Bad Order</th>
                            <th>User</th>
                            <th>Customer</th>
                        </tr>
                    </thead>
                    <tbody id="tbl-transactions">
                        @foreach($transactions as $transaction)
                            <tr class='clickable-row' data-toggle="modal" data-target="#purchases-modal{{ $transaction->trx_ref_id }}" >
                                <td>{{ $transaction->trx_ref_id }}</td>
                                <td>{{ $transaction->trx_datetime }}</td>

                                @php($prd_name = "")
                                @php($pur_qty_in = ($transaction->pur_crate_in * 12) + $transaction->pur_loose_in)
                                @if($transaction->can_type_in == 0 || $transaction->can_type_in == 1)
                                    @if($pur_qty_in == 0)
                                        @php($pur_qty_in = "-")
                                        @php($prd_name = "-")
                                    @else
                                        @php($prd_name = $transaction->prd_name)
                                    @endif
                                @else
                                    @foreach($ops_ins as $ops_in)
                                        @if($ops_in->ops_id == $transaction->prd_id_in)
                                            @php($prd_name = $ops_in->ops_name)
                                        @endif
                                    @endforeach
                                    @if($pur_qty_in == 0)
                                        @php($pur_qty_in = "-")
                                    @endif
                                @endif

                                
                                @php($bo_count = 0)
                                @foreach($bad_orders as $bad_order)
                                    @if($bad_order->trx_id == $transaction->trx_id && $bad_order->prd_id == $transaction->prd_id)
                                        @php($bo_count += ($bad_order->bo_crates * 12) + $bad_order->bo_loose)
                                    @endif
                                @endforeach

                                {{-- @if($bo_count > 0)
                                    @foreach($bad_orders as $bad_order)
                                        @if($bad_order->trx_id == $transaction->trx_id && $bad_order->prd_id == $transaction->prd_id)
                                            <hr>
                                            <div class="row">
                                                <div class="col text-warning">{{ $bad_order->bo_ref_id }}</div>
                                                <div class="col">{{ $bad_order->prd_name }}</div>
                                                <div class="col">{{ ($bad_order->bo_crates * 12) + $bad_order->bo_loose }}</div>
                                                <div class="col">{{ $bad_order->bo_datetime }}</div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <p class="text-secondary text-center mt-3 mb-3">No bad orders for this transaction</p>
                                @endif --}}
                                

                                <td>{{ $prd_name }}</td>
                                <td>{{ $pur_qty_in }}</td>
                                <td>{{ $transaction->prd_name }}</td>
                                <td>{{ $transaction->pur_qty }}</td>
                                <td>{{ $bo_count }}</td>
                                <td>{{ $transaction->usr_full_name }}</td>
                                <td>{{ $transaction->cus_name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</div>
<script type="text/javascript">
    // Define a function to handle the beforeprint event
    function handleBeforePrint() {
        // Remove the event listener to prevent an infinite loop
        window.removeEventListener("beforeprint", handleBeforePrint);

        // Display a confirmation dialog to allow the user to select print settings
        if (confirm("Click 'OK' to show preview")) {
            // Open the print dialog
            setTimeout(function() {
                window.print();
            }, 500);
        }
        else{
            window.location.href = "{{ action('ReportsController@transactionsToday') }}";
        }
    }

    // Add an event listener for the beforeprint event
    window.addEventListener("beforeprint", handleBeforePrint);

    // Call the print method when the page finishes loading
    window.addEventListener("load", function() {
        setTimeout(function() {
            window.print();
            window.location.href = "{{ action('ReportsController@transactionsToday') }}";
        }, 500);
    });
</script>
@endsection
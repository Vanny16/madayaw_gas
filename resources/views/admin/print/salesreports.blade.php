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
                @if($sales_date_from != "" && $sales_date_to != "")
                    @if($sales_date_from == date('Y-m-d') && $sales_date_to == date('Y-m-d'))
                        @php
                            $date_from = Carbon\Carbon::parse()->format('Y-m-d');
                            $date_to = Carbon\Carbon::parse()->format('Y-m-d');
                            $date_label = "Today's Sales";
                        @endphp
                    @else
                        @php
                            $date_from = $sales_date_from;
                            $date_to = $sales_date_to;
                            $date_label = "Sales from ". $date_from ." to ". $date_to;
                        @endphp
                    @endif
                @else
                    @php
                        $date_from = Carbon\Carbon::parse()->format('Y-m-d');
                        $date_to = Carbon\Carbon::parse()->format('Y-m-d');
                        $date_label = "All Sales";
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
                        <h3 class="card-title"><i class="fa fa-bar-chart"></i> Sales Reports</h3><br>
                    </div>
                    <div class="col-md-6">
                        <small class="float-right">{{ $date_label }}</small>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover table-condensed">
                    <thead>
                        @if(session('tbl_sales_form') == "sales_summary")
                            <tr>
                                <th>Reference ID</th>
                                <th>Date & Time</th>
                                <th>Total Sale</th>
                                <th>Total Paid</th>
                                <th>Balance</th>
                                <th>Cashier</th>
                                <th>Customer</th>
                            </tr>
                            
                        @elseif(session('tbl_sales_form') == "sales")
                            <tr>
                                <th>Reference ID</th>
                                <th>Date & Time</th>
                                <th>Item</th>
                                <th>IN</th>
                                <th>OUT</th>
                                <th>Net Sale</th>
                                <th>Cashier</th>
                                <th>Customer</th>
                            </tr>

                        @elseif(session('tbl_sales_form') === "salesAll")
                            <tr>
                                <th>askljdbuiabf</th>
                                <th>Reference ID</th>
                                <th>Date & Time</th>
                                <th>Item</th>
                                <th>IN</th>
                                <th>OUT</th>
                                <th>Net Sale</th>
                                <th>Cashier</th>
                                <th>Customer</th>
                            </tr>
                        
                        @elseif(session('tbl_sales_form') == "products")
                            <tr>
                                <th>Item</th>
                                <th>Total (IN)</th>
                                <th>Total (OUT)</th>
                                <th>Total Sales</th>
                            </tr>
                    
                        @elseif(session('tbl_sales_form') == "customers")
                            <tr>
                                <th>Customer</th>
                                <th>Total Canister (IN)</th>
                                <th>Total Canister (OUT)</th>
                                <th>Total Sales</th>
                                <th>Total Balance</th>
                                <th>Total Payment</th>
                            </tr>
                    
                        @elseif(session('tbl_sales_form') == "cashiers")
                            <tr>
                                <th>Cashier</th>
                                <th>Total Collection</th>
                                <th>Transaction Count</th>
                            </tr>
                        @endif
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                            @php($total_discount = 0)

                            
                            @if(session('tbl_sales_form') == "sales" || session('tbl_sales_form') == "sales_summary")
                                @foreach($purchases as $purchase)
                                    @if($purchase->trx_id == $sale->trx_id)
                                        @php($total_discount += $purchase->pur_discount)
                                    @endif
                                @endforeach
                            @endif

                            @if(session('tbl_sales_form') == "sales_summary")
                                <tr class='clickable-row' data-toggle="modal" data-target="#purchases-modal{{ $sale->trx_ref_id }}" >
                                    <td>{{ $sale->trx_ref_id }}</td>
                                    <td>{{ $sale->trx_datetime }}</td>
                                    <td>₱ {{ number_format($sale->trx_total, 2, '.', ',') }}</td>
                                    <td>₱ {{ number_format($sale->trx_amount_paid, 2, '.', ',') }}</td>
                                    <td>₱ {{ number_format($sale->trx_balance, 2, '.', ',') }}</td>
                                    <td>{{ $sale->usr_full_name }}</td>
                                    <td>{{ $sale->cus_name }}</td>
                                </tr>
                            
                            @elseif(session('tbl_sales_form') == "sales")
                                <tr class='clickable-row' data-toggle="modal" data-target="#purchases-modal{{ $sale->trx_ref_id }}" >
                                    <td>{{ $sale->trx_ref_id }}</td>
                                    <td>{{ $sale->trx_datetime }}</td>
                                    <td>{{ $sale->prd_name }}</td>
                                    <td>{{ ($sale->pur_crate_in * 12) + $sale->pur_loose_in}}</td>
                                    <td>{{ $sale->pur_qty }}</td>
                                    <td>₱ {{ number_format($sale->pur_total, 2, '.', ',') }}</td>
                                    <td>{{ $sale->usr_full_name }}</td>
                                    <td>{{ $sale->cus_name }}</td>
                                </tr>

                            @elseif(session('tbl_sales_form') === "salesAll")
                                <tr class='clickable-row' data-toggle="modal" data-target="#purchases-modal{{ $sale->trx_ref_id }}">
                                    <td>{{ $sale->trx_ref_id }}</td>
                                    <td>{{ $sale->trx_datetime }}</td>
                                    <td>{{ $sale->prd_name }}</td>
                                    <td>{{ ($sale->pur_crate_in * 12) + $sale->pur_loose_in}}</td>
                                    <td>{{ $sale->pur_qty }}</td>
                                    <td>₱ {{ number_format($sale->pur_total, 2, '.', ',') }}</td>
                                    <td>{{ $sale->usr_full_name }}</td>
                                    <td>{{ $sale->cus_name }}</td>
                                </tr>
                                
                            @elseif(session('tbl_sales_form') == "products")
                                <tr>
                                    <td>{{ $sale->prd_name }}</td>
                                    <td>{{ $sale->pur_qty_in }}</td>
                                    <td>{{ $sale->pur_qty_out }}</td>
                                    <td>₱ {{ number_format($sale->pur_total, 2, '.', ',') }}</td>
                                </tr>

                            @elseif(session('tbl_sales_form') == "customers")
                                <tr>
                                    <td>{{ $sale->cus_name }}</td>
                                    <td>{{ $sale->pur_qty_in }}</td>
                                    <td>{{ $sale->pur_qty_out }}</td>
                                    <td>₱ {{ number_format($sale->trx_total, 2, '.', ',') }}</td>
                                    <td>₱ {{ number_format($sale->trx_balance, 2, '.', ',') }}</td>
                                    <td>₱ {{ number_format($sale->trx_amount_paid, 2, '.', ',') }}</td>
                                </tr>

                            @elseif(session('tbl_sales_form') == "cashiers")
                                <tr>
                                    <td>{{ $sale->usr_full_name }}</td>
                                    <td>₱ {{ number_format($sale->trx_total, 2, '.', ',') }}</td>
                                    <td>{{ $sale->trx_count }}</td>
                                </tr>
                            @endif
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
            window.location.href = "{{ action('ReportsController@salesToday') }}";
        }
    }

    // Add an event listener for the beforeprint event
    window.addEventListener("beforeprint", handleBeforePrint);

    // Call the print method when the page finishes loading
    window.addEventListener("load", function() {
        setTimeout(function() {
            window.print();
            window.location.href = "{{ action('ReportsController@salesToday') }}";
        }, 500);
    });
</script>
@endsection
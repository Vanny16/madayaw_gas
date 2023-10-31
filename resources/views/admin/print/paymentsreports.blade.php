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
                @if($payments_date_from != "" && $payments_date_to != "")
                    @if($payments_date_from == date('Y-m-d') && $payments_date_to == date('Y-m-d'))
                        @php
                            $date_from = Carbon\Carbon::parse()->format('Y-m-d');
                            $date_to = Carbon\Carbon::parse()->format('Y-m-d');
                            $date_label = "Today's Transactions";
                        @endphp
                    @else
                        @php
                            $date_from = $payments_date_from;
                            $date_to = $payments_date_to;
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
                        <h3 class="card-title"><i class="fa fa-bar-chart"></i> Payments Reports</h3><br>
                    </div>
                    <div class="col-md-6">
                        <small class="float-right">{{ $date_label }}</small>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover table-condensed">
                    <thead>
                        @if(session('select_show') == "Transactions")
                            <tr>
                                <th>Reference #</th>
                                <th>Customer</th>
                                <th>Transaction Date</th>
                                <th>Amount Payable</th>
                                <th>Amount Paid</th>
                                <th>Balance</th>
                                <th>Status</th>
                            </tr>
                        @else
                            <tr>
                                <th>Payment #</th>
                                <th>Transaction #</th>
                                <th>Customer</th>
                                <th>Payment Date</th>
                                <th>Amount Paid</th>
                                <th>Payment Type</th>
                                <th>Cashier</th>
                            </tr>
                        @endif
                    </thead>
                    <tbody id="tbl-payments">
                        @foreach($transactions as $transaction)
                            @if($transaction->trx_balance > 0)
                                @php($status = '<badge class="badge badge-sm">PENDING<badge>')
                                @php($text_color = "text-danger")
                                @php($btn_action = '<button class="btn btn-sm btn-light text-warning" data-toggle="modal" data-target="#payment_modal' . $transaction->trx_id . '"><i class="fa fa-coins"></i></button>')
                            @else
                                @php($status = '<badge class="badge badge-sm">PAID<badge>')
                                @php($text_color = "text-success")
                                @php($btn_action = '<button class="btn btn-sm btn-light text-success"><i class="fa fa-check"></i></button>')
                            @endif

                            @if(session('select_show') == "Transactions")
                                <tr>
                                    <td>{{ $transaction->trx_ref_id }}</td>
                                    <td>{{ $transaction->cus_name }}</td>
                                    <td>{{ $transaction->trx_datetime }}</td>
                                    <td>₱ {{ number_format($transaction->trx_total, 2, '.', ',') }}</td>
                                    <td>₱ {{ number_format($transaction->trx_amount_paid, 2, '.', ',') }}</td>
                                    <td>₱ {{ number_format($transaction->trx_balance, 2, '.', ',') }}</td>
                                    <td class="{{ $text_color }}">{!! $status !!}</td>
                                </tr>
                            @else
                                <tr>
                                    <td>{{ $transaction->pmnt_ref_id }}</td>
                                    <td>{{ $transaction->trx_ref_id }}</td>
                                    <td>{{ $transaction->cus_name }}</td>
                                    <td>{{ $transaction->pmnt_date .' '. $transaction->pmnt_time }}</td>
                                    <td>₱ {{ number_format($transaction->pmnt_amount, 2, '.', ',') }}</td>
                                    <td>{{ $transaction->payment_name }}</td>
                                    <td>{{ $transaction->usr_full_name }}</td>
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
            window.location.href = "{{ action('ReportsController@paymentsToday') }}";
        }
    }

    // Add an event listener for the beforeprint event
    window.addEventListener("beforeprint", handleBeforePrint);

    // Call the print method when the page finishes loading
    window.addEventListener("load", function() {
        setTimeout(function() {
            window.print();
            window.location.href = "{{ action('ReportsController@paymentsToday') }}";
        }, 500);
    });
</script>
@endsection
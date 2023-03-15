@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Payments</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Payments</li>
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
                            <h3 class="card-title"><i class="fas fa-filter"></i> Filters</h3>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="search_string">Find</label>
                                        <input type="text" class="form-control" id="search_payments" name="search_payments" placeholder="Search">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label>Status</label>
                                    <select id="status_filter" class="form-control">
                                        <option value="POS">All</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Paid">Paid</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="date_from">From</label>
                                    <input type="date" class="form-control" name="payments_date_from" value="{{ date('Y-m-d') }}" required/>     
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="date_to">To</label>
                                    <input type="date" class="form-control" name="payments_date_to" value="{{ date('Y-m-d') }}" required/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-coins"></i> Transaction Payments</h3>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <div class="row">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Reference #</th>
                                            <th>Customer</th>
                                            <th>Date & Time</th>
                                            <th>Amount Payable</th>
                                            <th>Amount Paid</th>
                                            <th>Balance</th>
                                            <th>Status</th>
                                            <th width="35px"></th>
                                            <th width="35px"></th>
                                        </tr>
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
                                            <tr class='clickable-row' >
                                                <td>{{ $transaction->trx_ref_id }}</td>
                                                <td>{{ $transaction->cus_name }}</td>
                                                <td>{{ $transaction->trx_datetime }}</td>
                                                <td>₱ {{ number_format($transaction->trx_total, 2, '.', ',') }}</td>
                                                <td>₱ {{ number_format($transaction->trx_amount_paid, 2, '.', ',') }}</td>
                                                <td>₱ {{ number_format($transaction->trx_balance, 2, '.', ',') }}</td>
                                                <td class="{{ $text_color }}">{!! $status !!}</td>
                                                <td>{!! $btn_action !!}</td>
                                                <td><button class="btn btn-sm btn-light text-secondary" data-toggle="modal" data-target="#history_modal{{ $transaction->trx_id }}"><i class="fa fa-history"></i></button></td>
                                            </tr>

                                            <!-- History Modal -->
                                            <div class="modal fade show" id="history_modal{{ $transaction->trx_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl show" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-history"> </i> Payments History</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="container">
                                                                        <div class="row header">
                                                                            <div class="col"><strong>Payment #</strong></div>
                                                                            <div class="col"><strong>Date</strong></div>
                                                                            <div class="col"><strong>Time</strong></div>
                                                                            <div class="col"><strong>Amount Paid</strong></div>
                                                                            <div class="col"><strong>Payment Type</strong></div>
                                                                            <div class="col"><strong>Cashier</strong></div>
                                                                        </div>
                                                                        @foreach($payments as $payment)
                                                                            @if($payment->trx_id == $transaction->trx_id)
                                                                                <hr>
                                                                                <div class="row">
                                                                                    <div class="col">{{ $payment->pmnt_ref_id }}</div>
                                                                                    <div class="col">{{ $payment->pmnt_date }}</div>
                                                                                    <div class="col">{{ $payment->pmnt_time }}</div>
                                                                                    <div class="col">₱ {{ number_format($payment->pmnt_amount, 2, '.', ',') }}</div>
                                                                                    <div class="col">
                                                                                        @if($payment->pmnt_attachment <> '')
                                                                                            <!--Product-Profile Modal -->
                                                                                            <div class="modal fade" id="pmnt_attachment-modal-{{$payment->pmnt_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                <div class="modal-dialog modal-lg" role="document">
                                                                                                    <div class="modal-content bg-transparent">
                                                                                                        <div class="modal-body">
                                                                                                            <button type="button" class="close text-white" data-dismiss="modal" data-target="#pmnt_attachment-modal-{{$payment->pmnt_id}}" aria-label="Close">
                                                                                                                <span aria-hidden="true">&times;</span>
                                                                                                            </button>
                                                                                                        
                                                                                                            <div class="row">
                                                                                                                <div class="col-12 text-center">
                                                                                                                    <img src="{{ asset('img/payments/' . $payment->pmnt_attachment) }}" style="max-height:100%; max-width:100%; min-height:100%; min-width:100%; object-fit: contain;">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#pmnt_attachment-modal-{{$payment->pmnt_id}}">{{ $payment->payment_name }}</a>
                                                                                        @else
                                                                                            {{ $payment->payment_name }}
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="col">{{ $payment->usr_full_name }}</div>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <hr>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Payment Modal -->
                                            <div class="modal fade show" id="payment_modal{{ $transaction->trx_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm show" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-coins text-warning"> </i> Payment Form</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST" action="{{ action('SalesController@payPending') }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }} 
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="cus_address">Mode of Payment</label><br>
                                                                            <button id="btn_cash{{ $transaction->trx_id }}" type="button" value="1" class="btn btn-lg btn-dark text-warning btn-payment"><i class="fa fa-coins"></i></button>
                                                                            <button id="btn_gcash{{ $transaction->trx_id }}" type="button" value="3" class="btn btn-lg btn-dark btn-payment"><img src="{{ asset('img/res/gcash.ico') }}" width="28rem"/></button>
                                                                            <input type="hidden" id="mode_of_payment" name="mode_of_payment" class="form-control"></input>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="prd_name">Balance <span style="color:red">*</span></label>
                                                                            <input type="text" class="form-control" name="trx_balance" value="{{ number_format($transaction->trx_balance, 2, '.', ',') }}" readonly/>
                                                                        </div>
                                                                        <div class="form-group" id="payment_input{{ $transaction->trx_id }}">
                                                                            <label for="cus_address" id="payment_label">Received Amount <span style="color:red">*</span></label>
                                                                            <input type="text" class="form-control" name="pmnt_amount" placeholder="Enter Amount"  onkeypress="return isNumberKey(this, event);" required/>
                                                                            <input type="text" class="form-control" name="trx_id" value="{{ $transaction->trx_id }}" onkeypress="return isNumberKey(this, event);" hidden/>
                                                                            <input type="hidden" id="mode_of_payment{{ $transaction->trx_id }}" name="mode_of_payment" class="form-control"></input>
                                                                        </div>
                                                                        <div class="form-group" id="pmnt_attachment{{ $transaction->trx_id }}">
                                                                            <label for="cus_address" id="payment_label">Attachment <span style="color:red">*</span></label>
                                                                            <div class="custom-file">
                                                                                <label class="custom-file-label" for="inputGroupFile01{{ $transaction->trx_id }}">Choose file</label>
                                                                                <input type="file" class="custom-file-input" id="inputGroupFile01{{ $transaction->trx_id }}" name="pmnt_attachment" aria-describedby="inputGroupFileAddon01{{ $transaction->trx_id }}" >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success"><i class="fa fa-wallet"></i> Pay</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <script>
                                                $(document).ready(function() {
                                                    $("#btn_cash{{ $transaction->trx_id }}").css("border-bottom", "4px solid green");
                                                    $("#pmnt_attachment{{ $transaction->trx_id }}").hide();
                                                    $("#mode_of_payment{{ $transaction->trx_id }}").val("1");

                                                    $("#btn_cash{{ $transaction->trx_id }}").on("click", function() {
                                                        $("#mode_of_payment{{ $transaction->trx_id }}").val("1");
                                                        $("#pmnt_attachment{{ $transaction->trx_id }}").hide();
                                                        $(".btn-payment").css("border-bottom", "none");
                                                        $(this).css("border-bottom", "4px solid green");
                                                    });
                                                    $("#btn_gcash{{ $transaction->trx_id }}").on("click", function() {
                                                        $("#mode_of_payment{{ $transaction->trx_id }}").val("3");
                                                        $("#pmnt_attachment{{ $transaction->trx_id }}").show();
                                                        $(".btn-payment").css("border-bottom", "none");
                                                        $(this).css("border-bottom", "4px solid green");
                                                    });
                                                });
                                            </script>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
$("#status_filter, #search_payments").on("change keyup", function() {
    var searchValue = $("#search_payments").val().toLowerCase();
    var statusValue = $("#status_filter").val().toLowerCase();
    
    $("#tbl-payments tr").filter(function() {
        var rowText = $(this).text().toLowerCase();
        var statusMatch = rowText.indexOf(statusValue) > -1;
        var searchMatch = rowText.indexOf(searchValue) > -1;
        $(this).toggle(statusMatch && searchMatch);
    });
});
</script>
@endsection 

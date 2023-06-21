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
                                $date_label = "Payments from ". $date_from ." to ". $date_to;
                            @endphp
                        @endif
                    @else
                        @php
                            $date_from = Carbon\Carbon::parse()->format('Y-m-d');
                            $date_to = Carbon\Carbon::parse()->format('Y-m-d');
                            $date_label = "All Transactions";
                        @endphp
                    @endif
                    
                    @if(session('status_filter') == "POS")
                        @php
                            $select_all = "selected";
                            $select_pending = "";
                            $select_paid = "";
                        @endphp
                    @elseif(session('status_filter') == "Pending")
                        @php
                            $select_all = "";
                            $select_pending = "selected";
                            $select_paid = "";
                        @endphp
                    @elseif(session('status_filter') == "Paid")
                        @php
                            $select_all = "";
                            $select_pending = "";
                            $select_paid = "selected";
                        @endphp
                    @else
                        @php
                            $select_all = "";
                            $select_pending = "";
                            $select_paid = "";
                        @endphp
                    @endif
                    
                    @if(session('search_payments'))
                        @php($search_payments = session('search_payments'))
                    @else
                        @php($search_payments = "")
                    @endif

                    @if(session('paginate_row'))
                        @php($paginate_row = session('paginate_row'))
                    @else
                        @php($paginate_row = "10")
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-filter"></i> Filters</h3>
                        </div>
                        <form id="filter_form" method="GET" action="{{ route('payments-filter')}}">
                        {{ csrf_field() }} 
                            <div class="card-body" style="overflow-x:auto;">
                                <div class="row">
                                    <div class="col-md-2 mb-3">
                                        <label for="search_string">Find</label>
                                        <input type="text" class="form-control" id="search_payments" name="search_payments" onclick="select()" value="{{ $search_payments }}" placeholder="Search">
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="date_from">From</label>
                                        <input type="date" class="form-control" id="payments_date_from" name="payments_date_from" value="{{ $date_from }}" required/>     
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="date_to">To</label>
                                        <input type="date" class="form-control" id="payments_date_to" name="payments_date_to" value="{{ $date_to }}" required/>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label>Show by</label>
                                        <select id="select_show" name="select_show" class="form-control">
                                            <option value="Transactions">Transactions</option>
                                            <option value="Payments">Payments</option>
                                        </select>
                                    </div>

                                    <div id="select_status" class="col-md-2 mb-3">
                                        <label>Status</label>
                                        <select id="status_filter" name="status_filter" class="form-control">
                                            <option value="POS" {{$select_all}}>All</option>
                                            <option value="Pending" {{$select_pending}}>Pending</option>
                                            <option value="Paid" {{$select_paid}}>Paid</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-1 mb-3">
                                        <label for="search_string">Rows</label>
                                        <input type="number" class="form-control" id="paginate_row" name="paginate_row" value="{{ $paginate_row }}" min="1" onkeypress="return isNumberKey(this, event);" onclick="select()" onkeyup="setToDefault(this.id)" onchange="setToDefault(this.id)">
                                    </div>
                                    <div class="col-md-1 mb-3">
                                        <label for="">&nbsp;</label>
                                        <button type="submit" name="filter_btn" value="find" class="btn btn-success form-control"><span class="fa fa-search"></span> Find</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1 mb-3">
                                        <button type="submit" name="filter_btn" value="print" class="btn btn-light text-success form-control"><span class="fa fa-print"></span> Print</button>
                                    </div>
                                    <div class="col-md-1 mb-3">
                                        <button type="submit" name="filter_btn" value="export" class="btn btn-light text-success form-control"><span class="fa fa-file-export"></span> Export</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" style="background-color:#ececec;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <span>{{ $date_label }}</span>
                                    </div>

                                    <div class="col-md-8">
                                        <button  href="#" onclick="submitFilter()" name="quick_btn" value="all" class="bg-transparent float-right text-danger ml-2 mr-2" style="border: none;"> All Transactions</button>
                                        <span class="float-right">|</span>
                                        <button href="#" onclick="submitFilter()" name="quick_btn" value="today" class="bg-transparent float-right text-danger ml-2 mr-2" style="border: none;"> Today's Transactions</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card">
                        <div class="card-body" style="overflow-x:auto;">
                            <div class="row">

                                @php($total_sales=0)
                                @php($total_balance=0)
                                    
                                @foreach($transactions as $transaction)
                                    @php($total_sales += $transaction->trx_amount_paid)
                                    @php($total_balance += $transaction->trx_balance)
                                @endforeach

                                <div class="card col-md-3 col-12 ml-md-2 mr-md-2 border">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <i class="fas fa-coins text-warning fa-2x"></i>
                                            </div>
                                            <div class="col">
                                                <h2 style="color:#238ab2;">₱ {{ number_format($total_sales, 2, '.', ',') }}</h2>
                                                <p>Total Sales</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card col-md-3 col-12 ml-md-2 mr-md-2 border">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <i class="fas fa-credit-card text-secondary fa-2x"></i>
                                            </div>
                                            <div class="col">
                                                <h2 style="color:#238ab2;">₱ {{ number_format($total_balance, 2, '.', ',') }}</h2>
                                                <p>Total Pending Payments</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-coins"></i> Transaction Payments History</h3>
                            <div class="card-tools">{{ $transactions->links() }}</div>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <div class="row">
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
                                                <th width="35px"></th>
                                                <th width="35px"></th>
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

                                                @if($transaction->trx_confirm == 0)
                                                    @php($btn_action = '<button class="btn btn-sm border-info btn-light text-info" data-toggle="modal" data-target="#trx_confirm_modal' . $transaction->trx_id . '">Confirm</button>')
                                                @else
                                                    @php($btn_action = '<button class="btn btn-sm btn-light text-success"><i class="fa fa-check"></i></button>')
                                                @endif
                                            @endif
                                            
                                            @if(session('select_show') == "Transactions")
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
                                            @else
                                                <tr class='clickable-row' >
                                                    <td>{{ $transaction->pmnt_ref_id }}</td>
                                                    <td>{{ $transaction->trx_ref_id }}</td>
                                                    <td>{{ $transaction->cus_name }}</td>
                                                    <td>{{ $transaction->pmnt_date .' '. $transaction->pmnt_time }}</td>
                                                    <td>₱ {{ number_format($transaction->pmnt_amount, 2, '.', ',') }}</td>
                                                    <td>
                                                        @if($transaction->pmnt_attachment <> '')
                                                            <!--Attachment Modal -->
                                                            <div class="modal fade" id="pmnt_attachment-modal-{{$transaction->pmnt_ref_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-md" role="document">
                                                                    <div class="modal-content bg-transparent">
                                                                        <div class="modal-body">
                                                                            <button type="button" class="close text-dark" data-dismiss="modal" data-target="#pmnt_attachment-modal-{{$transaction->pmnt_ref_id}}" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        
                                                                            <div class="row">
                                                                                <div class="col-12 text-center">
                                                                                    <img src="{{ asset('img/payments/' . $transaction->pmnt_attachment) }}" style="max-height:100%; max-width:100%; min-height:100%; min-width:100%; object-fit: contain;">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#pmnt_attachment-modal-{{$transaction->pmnt_ref_id}}">{{ $transaction->payment_name }}</a>
                                                        @else
                                                            {{ $transaction->payment_name }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $transaction->usr_full_name }}</td>
                                                </tr>
                                            @endif

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
                                                                                            <!--Attachment Modal -->
                                                                                            <div class="modal fade" id="pmnt_attachment-modal-{{$payment->pmnt_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                <div class="modal-dialog modal-md" role="document">
                                                                                                    <div class="modal-content bg-transparent">
                                                                                                        <div class="modal-body">
                                                                                                            <button type="button" class="close text-dark" data-dismiss="modal" data-target="#pmnt_attachment-modal-{{$payment->pmnt_id}}" aria-label="Close">
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

                                            <!-- Payment Confirmation Modal -->
                                            <div class="modal fade show" id="trx_confirm_modal{{ $transaction->trx_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm show" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-danger" id="exampleModalLabel"><i class="fa fa-check"></i> Confirmation</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST" action="{{ action('LoginController@confirmTransaction') }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }} 
                                                            <div class="modal-body">
                                                                <p class="mb-4">Please enter your password to verify.</p>
                                                                <div class="row">
                                                                    <div class="form-group col-12">
                                                                        <label for="">Enter Password <span style="color:red">*</span></label>
                                                                        <input type="password" class="form-control" name="usr_password" placeholder="Enter Password" required/>
                                                                        <input type="hidden" class="form-control" name="trx_id" value="{{$transaction->trx_id}}" required/>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-default"><i class="fa fa-key"></i> Confirm Password</button>
                                                                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </form>
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
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    Reference:
                                                                                </div>
                                                                                <div class="col-6 text-danger">
                                                                                    {{ $transaction->trx_ref_id }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    Customer:
                                                                                </div>
                                                                                <div class="col-6 text-danger">
                                                                                    {{ $transaction->cus_name }}
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="cus_address">Payment Date <span style="color:red">*</span></label>
                                                                            <input type="date" id="pmnt_date{{ $transaction->trx_id }}" name="pmnt_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="cus_address">Mode of Payment: <i id="mop_lbl{{ $transaction->trx_id }}" class="text-info">Cash</i></label><br>
                                                                            <button id="btn_cash{{ $transaction->trx_id }}" type="button" value="1" class="btn btn-lg btn-light text-warning btn-payment"><i class="fa fa-coins"></i></button>
                                                                            <button id="btn_gcash{{ $transaction->trx_id }}" type="button" value="3" class="btn btn-lg btn-light text-dark btn-payment"><img src="{{ asset('img/res/gcash.png') }}" width="22px"/></button>
                                                                            <button id="btn_check{{ $transaction->trx_id }}" type="button" value="4" class="btn btn-lg btn-light text-dark btn-payment"><i class="fa fa-landmark"></i></button>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="prd_name">Balance <span style="color:red">*</span></label>
                                                                            <input type="text" class="form-control" name="trx_balance" value="{{ number_format($transaction->trx_balance, 2, '.', ',') }}" readonly/>
                                                                        </div>
                                                                        <div class="form-group" id="payment_check{{ $transaction->trx_id }}">
                                                                            <label for="cus_address">Check No. <span style="color:red">*</span></label>
                                                                            <input type="text" id="pmnt_check_no{{ $transaction->trx_id }}" name="pmnt_check_no" class="form-control" onclick="select()" required></input>
                                                                        </div>
                                                                        <div class="form-group" id="payment_check_date{{ $transaction->trx_id }}">
                                                                            <label for="cus_address">Check Date <span style="color:red">*</span></label>
                                                                            <input type="date" id="pmnt_check_date{{ $transaction->trx_id }}" name="pmnt_check_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                                                                        </div>
                                                                        <div class="form-group" id="payment_input{{ $transaction->trx_id }}">
                                                                            <label for="cus_address" id="payment_label">Received Amount <span style="color:red">*</span></label>
                                                                            <input type="text" class="form-control" id="pmnt_amount_cash{{ $transaction->trx_id }}" name="pmnt_amount_cash" placeholder="Enter Amount" onkeyup="noNegativeValue(this.id)" onkeypress="return isNumberKey(this, event);" value="0" onclick="select()" required/>
                                                                            <input type="text" class="form-control" id="pmnt_amount_gcash{{ $transaction->trx_id }}" name="pmnt_amount_gcash" placeholder="Enter Amount" onkeyup="noNegativeValue(this.id)" onkeypress="return isNumberKey(this, event);" value="0" onclick="select()" required/>
                                                                            <input type="text" class="form-control" id="pmnt_amount_check{{ $transaction->trx_id }}" name="pmnt_amount_check" placeholder="Enter Amount" onkeyup="noNegativeValue(this.id)" onkeypress="return isNumberKey(this, event);" value="0" onclick="select()" required/>
                                                                            <input type="text" class="form-control" id="pmnt_amount{{ $transaction->trx_id }}" name="pmnt_amount" placeholder="Enter Amount"  onkeypress="return isNumberKey(this, event);" value="0" required hidden/>
                                                                            <input type="hidden" class="form-control" name="trx_id" value="{{ $transaction->trx_id }}" onkeypress="return isNumberKey(this, event);"/>
                                                                            <input type="hidden" id="mode_of_payment{{ $transaction->trx_id }}" name="mode_of_payment" class="form-control"></input>
                                                                        </div>
                                                                        <div class="form-group" id="pmnt_attachment_gcash{{ $transaction->trx_id }}">
                                                                            <label for="cus_address" id="payment_label">Attachment <span style="color:red">*</span></label>
                                                                            <div class="custom-file">
                                                                                <label class="custom-file-label" for="inputGroupFile01{{ $transaction->trx_id }}">Choose file</label>
                                                                                <input type="file" class="custom-file-input" id="inputGroupFile01{{ $transaction->trx_id }}" id="pmnt_attachment_gcash{{ $transaction->trx_id }}" name="pmnt_attachment_gcash" aria-describedby="inputGroupFileAddon01{{ $transaction->trx_id }}" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group" id="pmnt_attachment_check{{ $transaction->trx_id }}">
                                                                            <label for="cus_address" id="payment_label">Attachment <span style="color:red">*</span></label>
                                                                            <div class="custom-file">
                                                                                <label class="custom-file-label" for="inputGroupFile01{{ $transaction->trx_id }}">Choose file</label>
                                                                                <input type="file" class="custom-file-input" id="inputGroupFile01{{ $transaction->trx_id }}" id="pmnt_attachment_check{{ $transaction->trx_id }}" name="pmnt_attachment_check" aria-describedby="inputGroupFileAddon01{{ $transaction->trx_id }}" >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success" onclick="this.disabled=true; this.innerHTML='Saving...'; this.form.submit();"><i class="fa fa-wallet"></i> Pay</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <script>
                                                $(document).ready(function() {
                                                    $("#btn_cash{{ $transaction->trx_id }}").css("border-bottom", "4px solid green");
                                                    $("#payment_check{{ $transaction->trx_id }}").hide();
                                                    $("#payment_check_date{{ $transaction->trx_id }}").hide();
                                                    $("#pmnt_attachment_gcash{{ $transaction->trx_id }}").hide();
                                                    $("#pmnt_attachment_check{{ $transaction->trx_id }}").hide();
                                                    $("#mode_of_payment{{ $transaction->trx_id }}").val("1");
                                                    $("#pmnt_amount_cash{{ $transaction->trx_id }}").show();
                                                    $("#pmnt_amount_gcash{{ $transaction->trx_id }}").hide();
                                                    $("#pmnt_amount_check{{ $transaction->trx_id }}").hide();

                                                    $("#btn_cash{{ $transaction->trx_id }}").on("click", function() {
                                                        setPaymentType(1);
                                                        $("#payment_check{{ $transaction->trx_id }}").hide();
                                                        $("#payment_check_date{{ $transaction->trx_id }}").hide();
                                                        $("#pmnt_attachment_gcash{{ $transaction->trx_id }}").hide();
                                                        $("#pmnt_attachment_check{{ $transaction->trx_id }}").hide();
                                                        $("#pmnt_amount_cash{{ $transaction->trx_id }}").show();
                                                        $("#pmnt_amount_gcash{{ $transaction->trx_id }}").hide();
                                                        $("#pmnt_amount_check{{ $transaction->trx_id }}").hide();
                                                        $(".btn-payment").css("border-bottom", "none");
                                                        $(this).css("border-bottom", "4px solid green");
                                                    });
                                                    $("#btn_gcash{{ $transaction->trx_id }}").on("click", function() {
                                                        setPaymentType(3);
                                                        $("#payment_check{{ $transaction->trx_id }}").hide();
                                                        $("#payment_check_date{{ $transaction->trx_id }}").hide();
                                                        $("#pmnt_attachment_gcash{{ $transaction->trx_id }}").show();
                                                        $("#pmnt_attachment_check{{ $transaction->trx_id }}").hide();
                                                        $("#pmnt_amount_cash{{ $transaction->trx_id }}").hide();
                                                        $("#pmnt_amount_gcash{{ $transaction->trx_id }}").show();
                                                        $("#pmnt_amount_check{{ $transaction->trx_id }}").hide();
                                                        $(".btn-payment").css("border-bottom", "none");
                                                        $(this).css("border-bottom", "4px solid green");
                                                    });
                                                    $("#btn_check{{ $transaction->trx_id }}").on("click", function() {
                                                        setPaymentType(4);
                                                        $("#payment_check{{ $transaction->trx_id }}").show();
                                                        $("#payment_check_date{{ $transaction->trx_id }}").show();
                                                        $("#pmnt_attachment_gcash{{ $transaction->trx_id }}").hide();
                                                        $("#pmnt_attachment_check{{ $transaction->trx_id }}").show();
                                                        $("#pmnt_amount_cash{{ $transaction->trx_id }}").hide();
                                                        $("#pmnt_amount_gcash{{ $transaction->trx_id }}").hide();
                                                        $("#pmnt_amount_check{{ $transaction->trx_id }}").show();
                                                        $(".btn-payment").css("border-bottom", "none");
                                                        $(this).css("border-bottom", "4px solid green");
                                                    });

                                                    function setPaymentType(pmnt_type){
                                                        var pmnt_amount_cash = parseFloat(document.getElementById("pmnt_amount_cash{{ $transaction->trx_id }}").value);
                                                        var pmnt_amount_gcash = parseFloat(document.getElementById("pmnt_amount_gcash{{ $transaction->trx_id }}").value);
                                                        var pmnt_amount_check = parseFloat(document.getElementById("pmnt_amount_check{{ $transaction->trx_id }}").value);
                                                        
                                                        if(pmnt_type == 1){
                                                            if(pmnt_amount_gcash > 0 || pmnt_amount_check > 0){
                                                                $("#mop_lbl{{ $transaction->trx_id }}").text("Split Payment");
                                                                $("#mode_of_payment{{ $transaction->trx_id }}").val("5");
                                                            }
                                                            else{
                                                                $("#mop_lbl{{ $transaction->trx_id }}").text("Cash");
                                                                $("#mode_of_payment{{ $transaction->trx_id }}").val("1");
                                                            }
                                                        }
                                                        else if(pmnt_type == 3){
                                                            if(pmnt_amount_cash > 0 || pmnt_amount_check > 0){
                                                                $("#mop_lbl{{ $transaction->trx_id }}").text("Split Payment");
                                                                $("#mode_of_payment{{ $transaction->trx_id }}").val("5");
                                                            }
                                                            else{
                                                                $("#mop_lbl{{ $transaction->trx_id }}").text("G-Cash");
                                                                $("#mode_of_payment{{ $transaction->trx_id }}").val("3");
                                                            }
                                                        }
                                                        else if(pmnt_type == 4){
                                                            if(pmnt_amount_cash > 0 || pmnt_amount_gcash > 0){
                                                                $("#mop_lbl{{ $transaction->trx_id }}").text("Split Payment");
                                                                $("#mode_of_payment{{ $transaction->trx_id }}").val("5");
                                                            }
                                                            else{
                                                                $("#mop_lbl{{ $transaction->trx_id }}").text("Check");
                                                                $("#mode_of_payment{{ $transaction->trx_id }}").val("4");
                                                            }
                                                        }
                                                        else{
                                                            if(pmnt_amount_cash > 0 || pmnt_amount_gcash > 0 || pmnt_amount_check > 0){
                                                                $("#mop_lbl{{ $transaction->trx_id }}").text("Split Payment");
                                                                $("#mode_of_payment{{ $transaction->trx_id }}").val("5");
                                                            }
                                                            else{
                                                                $("#mop_lbl{{ $transaction->trx_id }}").text("Invalid");
                                                                $("#mode_of_payment{{ $transaction->trx_id }}").val("5");
                                                            }
                                                        }
                                                    }
                                                });

                                                $(document).ready(function() {
                                                    function setTransactionAmount() {
                                                        var pmnt_amount_cash = $("#pmnt_amount_cash{{ $transaction->trx_id }}").val();
                                                        var pmnt_amount_gcash = $("#pmnt_amount_gcash{{ $transaction->trx_id }}").val();
                                                        var pmnt_amount_check = $("#pmnt_amount_check{{ $transaction->trx_id }}").val();

                                                        $("#pmnt_amount{{ $transaction->trx_id }}").val(parseFloat(pmnt_amount_cash) + parseFloat(pmnt_amount_gcash) + parseFloat(pmnt_amount_check));
                                                    }

                                                    $("#pmnt_amount_cash{{ $transaction->trx_id }}, #pmnt_amount_gcash{{ $transaction->trx_id }}, #pmnt_amount_check{{ $transaction->trx_id }}").on("change keyup", function() {
                                                        setTransactionAmount();
                                                    });
                                                });

                                            </script>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="card-tools">{{ $transactions->links() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    
@if(session('select_show') == "Transactions")
    $("#select_show").val("Transactions");
    $("#select_status").show();
@else
    $("#select_show").val("Payments");
    $("#select_status").hide();
@endif

$("#select_show").on("load change", function() {
    if($("#select_show").val() == "Transactions"){
        $("#select_status").show();
    }
    else{
        $("#select_status").hide();
    }
});

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

function noNegativeValue(id){
    $("#"+id).on("input", function() {
        if (/^0/.test(this.value)) {
            this.value = this.value.replace(/^0/, "")
        }
    });

    var value = document.getElementById(id).value;
    if(value < 0 || value == ""){
        document.getElementById(id).value ="0";
    }
}

function setToDefault(id){
    $("#"+id).on("input", function() {
        if (/^0/.test(this.value)) {
            this.value = this.value.replace(/^0/, "")
        }
    });

    var value = document.getElementById(id).value;
    if(value < 0 || value == ""){
        document.getElementById(id).value ="10";
    }
}

function submitFilter() {
  document.getElementById("filter_form").submit();
}
</script>
@endsection 

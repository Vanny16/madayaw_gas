@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Transaction Reports</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Reports / Transactions</li>
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

            @if($transactions_date_from != "" && $transactions_date_to != "")
                @php
                    $date_from = $transactions_date_from;
                    $date_to = $transactions_date_to;
                @endphp
            @else
                @php
                    $date_from = Carbon\Carbon::parse()->format('Y-m-d');
                    $date_to = Carbon\Carbon::parse()->format('Y-m-d');
                @endphp
            @endif
            
            <div class="row">
                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-calendar"></i> Selected Date</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ action('ReportsController@transactionsFilter')}}">
                            {{ csrf_field() }} 
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="date_from">From</label>
                                        <input type="date" class="form-control" name="transactions_date_from" value="{{ $date_from }}" required/>     
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="date_to">To</label>
                                        <input type="date" class="form-control" name="transactions_date_to" value="{{ $date_to }}" required/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="search_string">Find</label>
                                        <input type="text" class="form-control" id="search_transactions" name="search_transactions" placeholder="Search">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <button type="submit" class="btn btn-success"><span class="fa fa-search"></span> Find</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">

                                @if($transactions_date_from != "" && $transactions_date_to != "")
                                    @if($transactions_date_from == Carbon\Carbon::parse()->format('Y-m-d'))
                                        <h4>Today's transactions</h4>
                                    @else
                                        <h4>Transactions from <span class="text-info">{{ \Carbon\Carbon::parse($transactions_date_from)->format('F d, Y') }}</span> to <span class="text-info">{{ \Carbon\Carbon::parse($transactions_date_to)->format('F d, Y') }}</span></h4>
                                    @endif
                                @else
                                    <h4>All time transactions</h4>
                                @endif
                                </div>
                                <div class="col-6">
                                    <a href="{{ action('ReportsController@transactions') }}"><button type="submit" class="btn btn-danger float-right"><span class="fa fa-table"></span> Show all time sales</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3"> 
                            <form method="POST" action="{{ action('PrintController@alltransactionReports')}}">
                            {{ csrf_field() }}
                                <button type="submit" class="btn btn-info col-md-1 col-12 float-left" href="" target="_BLANK"><i class="fa fa-print"></i> Print</button>
                                <input type="date_from" class="form-control" id="transactions_date_from" name="transactions_date_from" value="{{ $date_from }}" hidden/>
                                <input type="date_to" class="form-control" id="transactions_date_to" name="transactions_date_to" value="{{ $date_to }}" hidden/>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-bar-chart"></i> Transaction Reports</h3>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <div class="row">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Reference ID</th>
                                            <th>User</th>
                                            <th>Customer</th>
                                            <th>Date & Time</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl-transactions">
                                        @foreach($transactions as $transaction)
                                            <tr class='clickable-row' data-toggle="modal" data-target="#purchases-modal{{ $transaction->trx_ref_id }}" >
                                                <td>{{ $transaction->trx_ref_id }}</td>
                                                <td>{{ $transaction->usr_full_name }}</td>
                                                <td>{{ $transaction->cus_name }}</td>
                                                <td>{{ $transaction->trx_datetime }}</td>
                                            </tr>
                                                    {{--<tr class="text-success bg-white">
                                                            <td colspan="5"></td>
                                                            <td class="text-success"><strong>Total</strong></td>
                                                            <td class="text-success"><strong id="lbl_total" class="fa fa-2x">0.00</strong></td>
                                                        </tr>--}}
                                           

                                            <!-- Purchases Modal -->
                                            <div class="modal fade" id="purchases-modal{{ $transaction->trx_ref_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-info">
                                                            <h5 class="modal-title"><i class="fa fa-info mr-2"> </i>Transaction Details</h5>
                                                            <p class="text-danger mr-2">{{ $transaction->trx_ref_id }}</p>
                                                        </div> 
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6 col-12">
                                                                    <h5><i class="fa fa-exchange"> </i> Declarations</h5><hr>
                                                                    <div class="row">
                                                                        <div class="container">
                                                                            <div class="row header">
                                                                                <div class="col"><strong>Unit</strong></div>
                                                                                <div class="col"><strong>Item</strong></div>
                                                                                <div class="col"><strong>Crate</strong></div>
                                                                                <div class="col"><strong>Loose</strong></div>
                                                                                <div class="col"><strong>Quantity</strong></div>
                                                                            </div>
                                                                            @foreach($pur_ins as $pur_in)
                                                                                @if($pur_in->trx_id == $transaction->trx_id)
                                                                                    @if($pur_in->prd_id_in <> '0')
                                                                                        @if($pur_in->can_type_in == 1)
                                                                                            @php($prd_name = $pur_in->prd_name)
                                                                                        @else
                                                                                            @foreach($ops_ins as $ops_in)
                                                                                                @if($ops_in->ops_id == $pur_in->prd_id)
                                                                                                    @php($prd_name = $ops_in->ops_name)
                                                                                                @endif
                                                                                            @endforeach
                                                                                        @endif
                                                                                        <hr>
                                                                                        <div class="row">
                                                                                            <div class="col text-info">IN</div>
                                                                                            <div class="col">{{ $prd_name }}</div>
                                                                                            <div class="col">{{ $pur_in->pur_crate_in }}</div>
                                                                                            <div class="col">{{ $pur_in->pur_loose_in }}</div>
                                                                                            <div class="col">{{ ($pur_in->pur_crate_in * 12) + $pur_in->pur_loose_in }}</div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach
                                                                            <hr>
                                                                            @foreach($purchases as $purchase)
                                                                                @if($purchase->trx_id == $transaction->trx_id)
                                                                                    <hr>
                                                                                    <div class="row">
                                                                                        <div class="col text-success">OUT</div>
                                                                                        <div class="col">{{ $purchase->prd_name }}</div>
                                                                                        <div class="col">{{ $purchase->pur_crate }}</div>
                                                                                        <div class="col">{{ $purchase->pur_loose }}</div>
                                                                                        <div class="col">
                                                                                            @if($purchase->prd_is_refillable == 1)
                                                                                                {{ ($purchase->pur_crate * 12) + $purchase->pur_loose }}
                                                                                            @else
                                                                                                {{ $purchase->pur_loose }}
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endforeach
                                                                            <hr><hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-12 border-left pl-2">
                                                                    <h5><i class="fa fa-undo"></i> Bad Orders</h5><hr>
                                                                    <div class="row">
                                                                        <div class="container">
                                                                            <div class="row header">
                                                                                <div class="col"><strong>Reference ID</strong></div>
                                                                                <div class="col"><strong>Item</strong></div>
                                                                                <div class="col"><strong>Quantity</strong></div>
                                                                                <div class="col"><strong>Date & Time</strong></div>
                                                                            </div>
                                                                            @php($bo_count = 0)
                                                                            @foreach($bad_orders as $bad_order)
                                                                                @if($bad_order->trx_id == $transaction->trx_id)
                                                                                    @php($bo_count++)
                                                                                @endif
                                                                            @endforeach

                                                                            @if($bo_count > 0)
                                                                                @foreach($bad_orders as $bad_order)
                                                                                    @if($bad_order->trx_id == $transaction->trx_id)
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
                                                                                <p class="text-secondary text-center mt-3 mb-3">No bad orders for this transactions</p>
                                                                            @endif
                                                                            <hr><hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="POST" action="{{ action('PrintController@allpurchasesReports')}}">
                                                            {{ csrf_field() }}
                                                                <!-- <button type="submit" class="btn btn-info float-left" href="" target="_BLANK"><i class="fa fa-print"></i> Print</button> -->
                                                                <input type="date_from" class="form-control" id="transactions_date_from" name="transactions_date_from" value="{{ $date_from }}" hidden/>
                                                                <input type="date_to" class="form-control" id="transactions_date_to" name="transactions_date_to" value="{{ $date_to }}" hidden/>
                                                            </form>
                                                            <button type="submit" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times mr-1"> </i> Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <tr class="bg-light" height="1px">
                                            <td colspan="7"></td>
                                        </tr>
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
$("#search_transactions").on("change keyup", function() {
    var searchValue = $("#search_transactions").val().toLowerCase();
    
    $("#tbl-transactions tr").filter(function() {
        var rowText = $(this).text().toLowerCase();
        var searchMatch = rowText.indexOf(searchValue) > -1;
        $(this).toggle(searchMatch);
    });
});
</script>
@endsection 

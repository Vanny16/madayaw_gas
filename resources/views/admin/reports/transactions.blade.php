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
                                    <tbody>
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
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="modal-header text-info">
                                                                        <h5 class="modal-title"><i class="fa fa-receipt mr-2"> </i>Transactions</h5>
                                                                        <p class="text-info mr-2">{{ $transaction->trx_ref_id }}</p>
                                                                    </div>
                                                                    <div class="row"> 
                                                                        <div class="modal-body">
                                                                            <div class="col-12">
                                                                                <div class="row">
                                                                                    <div class="container">
                                                                                        <div class="row header">
                                                                                            <div class="col"><strong>Unit</strong></div>
                                                                                            <div class="col"><strong>Item</strong></div>
                                                                                            <div class="col"><strong>Crates</strong></div>
                                                                                            <div class="col"><strong>Loose</strong></div>
                                                                                            <div class="col"><strong>QTY</strong></div>
                                                                                        </div>
                                                                                        @foreach($purchases as $purchase)
                                                                                            @if($purchase->trx_id == $transaction->trx_id)
                                                                                                <hr>
                                                                                                <div class="row">
                                                                                                    <div class="col">IN</div>
                                                                                                    <div class="col">{{ $purchase->prd_name }}</div>
                                                                                                    <div class="col">{{ number_format($purchase->pur_crate_in, 0, '', ',') }}</div>
                                                                                                    <div class="col">{{ number_format($purchase->pur_loose_in, 0, '', ',') }}</div>
                                                                                                    <div class="col">{{ ($purchase->pur_crate_in * 12) + $purchase->pur_loose_in }}</div>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div><hr></div>
                                                                        <div class="modal-body">
                                                                            <div class="col-12">
                                                                                <div class="row">
                                                                                    <div class="container">
                                                                                        <div class="row header">
                                                                                            <div class="col"><strong>Unit</strong></div>
                                                                                            <div class="col"><strong>Item</strong></div>
                                                                                            <div class="col"><strong>Crates</strong></div>
                                                                                            <div class="col"><strong>Loose</strong></div>
                                                                                            <div class="col"><strong>QTY</strong></div>
                                                                                        </div>
                                                                                        @foreach($purchases as $purchase)
                                                                                            @if($purchase->trx_id == $transaction->trx_id)
                                                                                                <hr>
                                                                                                <div class="row">
                                                                                                    <div class="col">OUT</div>
                                                                                                    <div class="col">{{ $purchase->prd_name }}</div>
                                                                                                    <div class="col">{{ number_format($purchase->pur_crate, 0, '', ',') }}</div>
                                                                                                    <div class="col">{{ number_format($purchase->pur_loose, 0, '', ',') }}</div>
                                                                                                    <div class="col">{{ ($purchase->pur_crate * 12) + $purchase->pur_loose }}</div>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                               
                                                                <div class="col-md-6">
                                                                    @foreach($bad_orders as $bad_order)
                                                                    <div class="modal-header text-danger">
                                                                        <h5 class="modal-title"><i class="fa fa-receipt mr-2"> </i>Bad Orders</h5>
                                                                        <p class="text-danger mr-2">{{ $bad_order->bo_ref_id  }}</p>
                                                                    </div>
                                                                    @endforeach
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="row">
                                                                                    <div class="container">
                                                                                        <div class="row header">
                                                                                            <div class="col"><strong>Unit</strong></div>
                                                                                            <div class="col"><strong>Item</strong></div>
                                                                                            <div class="col"><strong>Crates</strong></div>
                                                                                            <div class="col"><strong>Loose</strong></div>
                                                                                            <div class="col"><strong>QTY</strong></div>
                                                                                        </div>
                                                                                        @foreach($bad_orders as $bad_order)
                                                                                            @if($bad_order->trx_id == $transaction->trx_id)
                                                                                                <hr>
                                                                                                <div class="row">
                                                                                                    <div class="col">IN</div>
                                                                                                    <div class="col">{{ $bad_order->prd_name }}</div>
                                                                                                    <div class="col">{{ number_format($bad_order->bo_crates, 0, '', ',') }}</div>
                                                                                                    <div class="col">{{ number_format($bad_order->bo_loose, 0, '', ',') }}</div>
                                                                                                    <div class="col">{{ ($bad_order->bo_crates * 12) + $bad_order->bo_loose }}</div>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </div>        
                                                                                </div>
                                                                            </div>
                                                                        </div>     
                                                                    </div>   
                                                                </div>                        
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="POST" action="{{ action('PrintController@allpurchasesReports')}}">
                                                            {{ csrf_field() }}
                                                                <button type="submit" class="btn btn-info float-left" href="" target="_BLANK"><i class="fa fa-print"></i> Print</button>
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
@endsection 

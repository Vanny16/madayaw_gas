@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Sales Reports</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Reports / Sales</li>
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

            @if($sales_date_from != "" && $sales_date_to != "")
                @php
                    $date_from = $sales_date_from;
                    $date_to = $sales_date_to;
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
                            <form method="POST" action="{{ action('ReportsController@salesFilter')}}">
                            {{ csrf_field() }} 
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="date_from">From</label>
                                        <input type="date" class="form-control" name="sales_date_from" value="{{ $date_from }}" required/>     
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="date_to">To</label>
                                        <input type="date" class="form-control" name="sales_date_to" value="{{ $date_to }}" required/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="search_string">Find</label>
                                        <input type="text" class="form-control" id="search_sales" name="search_sales" placeholder="Search">
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

                                @if($sales_date_from != "" && $sales_date_to != "")
                                    @if($sales_date_from == Carbon\Carbon::parse()->format('Y-m-d'))
                                        <h4>Today's sales</h4>
                                    @else
                                        <h4>Sales from <span class="text-info">{{ \Carbon\Carbon::parse($sales_date_from)->format('F d, Y') }}</span> to <span class="text-info">{{ \Carbon\Carbon::parse($sales_date_to)->format('F d, Y') }}</span></h4>
                                    @endif
                                @else
                                    <h4>All time sales</h4>
                                @endif
                                </div>
                                <div class="col-6">
                                    <a href="{{ action('ReportsController@sales') }}"><button type="submit" class="btn btn-danger float-right"><span class="fa fa-table"></span> Show all time sales</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3"> 
                            <form method="POST" action="{{ action('PrintController@allsalesReports')}}">
                            {{ csrf_field() }}
                                <button type="submit" class="btn btn-info col-md-1 col-12 float-left" href="" target="_BLANK"><i class="fa fa-print"></i> Print</button>
                                <input type="date_from" class="form-control" id="sales_date_from" name="sales_date_from" value="{{ $date_from }}" hidden/>
                                <input type="date_to" class="form-control" id="sales_date_to" name="sales_date_to" value="{{ $date_to }}" hidden/>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-bar-chart"></i> Sales Reports</h3>
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
                                            <th>Total Sale</th>
                                            <th>Total Discount</th>
                                            <th>Amount Received</th>
                                            <th>Change</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl-sales">
                                        @foreach($sales as $sale)
                                            @php($total_discount = 0)

                                            @foreach($purchases as $purchase)
                                                @if($purchase->trx_id == $sale->trx_id)
                                                     @php($total_discount += $purchase->pur_discount)
                                                @endif
                                            @endforeach

                                            <tr class='clickable-row' data-toggle="modal" data-target="#purchases-modal{{ $sale->trx_ref_id }}" >
                                                <td>{{ $sale->trx_ref_id }}</td>
                                                <td>{{ $sale->usr_full_name }}</td>
                                                <td>{{ $sale->cus_name }}</td>
                                                <td>{{ $sale->trx_datetime }}</td>
                                                <td>₱ {{ number_format($sale->trx_total, 2, '.', ',') }}</td>
                                                <td>₱ {{ number_format($total_discount, 2, '.', ',') }}</td>
                                                <td>₱ {{ number_format($sale->trx_amount_paid, 2, '.', ',') }}</td>
                                                <td>₱ {{ number_format($sale->trx_balance, 2, '.', ',') }}</td>
                                            </tr>

                                            <!-- Purchases Modal -->
                                            <div class="modal fade" id="purchases-modal{{ $sale->trx_ref_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-info">
                                                            <h5 class="modal-title"><i class="fa fa-receipt mr-2"> </i>Purchases</h5>
                                                            <p class="text-danger mr-2">{{ $sale->trx_ref_id }}</p>
                                                        </div> 
                                                        <div class="modal-body">
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="container">
                                                                        <div class="row header">
                                                                            <div class="col"><strong>Product</strong></div>
                                                                            <div class="col"><strong>Price</strong></div>
                                                                            <div class="col"><strong>Crates</strong></div>
                                                                            <div class="col"><strong>Loose</strong></div>
                                                                            <div class="col"><strong>Deposit</strong></div>
                                                                            <div class="col"><strong>Discount</strong></div>
                                                                            <div class="col"><strong>Subtotal</strong></div>
                                                                        </div>
                                                                        @foreach($purchases as $purchase)
                                                                            @if($purchase->trx_id == $sale->trx_id)
                                                                                <hr>
                                                                                <div class="row">
                                                                                    <div class="col">{{ $purchase->prd_name }}</div>
                                                                                    <div class="col">₱ {{ number_format($purchase->prd_price, 2, '.', ',') }}</div>
                                                                                    <div class="col">{{ number_format($purchase->pur_crate, 0, '', ',') }}</div>
                                                                                    <div class="col">{{ number_format($purchase->pur_loose, 0, '', ',') }}</div>
                                                                                    <div class="col">₱ {{ number_format($purchase->pur_deposit, 2, '.', ',') }}</div>
                                                                                    <div class="col">₱ {{ number_format($purchase->pur_discount, 2, '.', ',') }}</div>
                                                                                    <div class="col">₱ {{ number_format($purchase->pur_total, 2, '.', ',') }}</div>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="POST" action="{{ action('PrintController@allpurchasesReports')}}">
                                                            {{ csrf_field() }}
                                                                <button type="submit" class="btn btn-info float-left" href="" target="_BLANK"><i class="fa fa-print"></i> Print</button>
                                                                <input type="date_from" class="form-control" id="sales_date_from" name="sales_date_from" value="{{ $date_from }}" hidden/>
                                                                <input type="date_to" class="form-control" id="sales_date_to" name="sales_date_to" value="{{ $date_to }}" hidden/>
                                                            </form>
                                                            <button type="submit" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times mr-1"> </i> Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <tr class="bg-light" height="1px">
                                            <td colspan="8"></td>
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
$("#search_sales").on("change keyup", function() {
    var searchValue = $("#search_sales").val().toLowerCase();
    
    $("#tbl-sales tr").filter(function() {
        var rowText = $(this).text().toLowerCase();
        var searchMatch = rowText.indexOf(searchValue) > -1;
        $(this).toggle(searchMatch);
    });
});
</script>
@endsection 
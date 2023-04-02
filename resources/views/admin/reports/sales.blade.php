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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-filter"></i> Filters</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ action('ReportsController@salesFilter')}}">
                            {{ csrf_field() }} 
                                <div class="row">
                                    <div class="col-md-2 mb-3">
                                        <label for="search_string">Find</label>
                                        <input type="text" class="form-control" id="search_sales" name="search_sales" placeholder="Search">
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="date_from">From</label>
                                        <input type="date" class="form-control" name="sales_date_from" value="{{ $date_from }}" required/>     
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="date_to">To</label>
                                        <input type="date" class="form-control" name="sales_date_to" value="{{ $date_to }}" required/>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="">Group by</label>
                                        <select id="select_grp" name="select_grp" class="form-control">
                                            <option value="-1">None</option>
                                            <option value="0">Transaction</option>
                                            <option value="1">Customer</option>
                                            <option value="2">Cashier</option>
                                            <option value="3">Product</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-3" id="select_set">
                                        <label id="grp_lbl" for="">Select</label>
                                        <input list="trx_options" id="select_trx" name="select_set[]" class="form-control" autocomplete="off"/>
                                        <datalist id="trx_options">
                                            <option value="ALL"></option>
                                            @foreach($transactions as $transaction)
                                                <option value="{{ $transaction->trx_ref_id }}"></option>
                                            @endforeach
                                        </datalist>

                                        <input list="cus_options" id="select_cus" name="select_set[]" class="form-control" autocomplete="off"/>
                                        <datalist id="cus_options">
                                            <option value="ALL"></option>
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->cus_name }}"></option>
                                            @endforeach
                                        </datalist>

                                        <input list="usr_options" id="select_usr" name="select_set[]" class="form-control" autocomplete="off"/>
                                        <datalist id="usr_options">
                                            <option value="ALL"></option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->usr_full_name }}"></option>
                                            @endforeach
                                        </datalist>

                                        <input list="prd_options" id="select_prd" name="select_set[]" class="form-control" autocomplete="off"/>
                                        <datalist id="prd_options">
                                            <option value="ALL"></option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->prd_name }}"></option>
                                            @endforeach
                                        </datalist>
                                    </div>
                                    <div class="col-md-1 mb-3">
                                        <label for="">&nbsp;</label>
                                        <button type="submit" class="btn btn-success form-control"><span class="fa fa-search"></span> Find</button>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <label for="">Choose Columns: </label>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="">Reference ID
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="">Cashier
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="">Customer
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="">Date & Time
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-4">
                                    <span>{{ $date_label }}</span>
                                </div>

                                <div class="col-md-8">
                                    <a href="{{ action('ReportsController@sales') }}" class="float-right text-danger ml-2 mr-2"> All Sales</a>
                                    <span class="float-right">|</span>
                                    <a href="{{ action('ReportsController@salesToday') }}" class="float-right text-danger ml-2 mr-2"> Today's Sales</a>
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
                                            <th>Date & Time</th>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Net Sale</th>
                                            <th>Cashier</th>
                                            <th>Customer</th>
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
                                                <td>{{ $sale->trx_datetime }}</td>
                                                <td>{{ $sale->prd_name }}</td>
                                                <td>{{ $sale->pur_qty }}</td>
                                                <td>₱ {{ number_format($sale->pur_total, 2, '.', ',') }}</td>
                                                <td>{{ $sale->usr_full_name }}</td>
                                                <td>{{ $sale->cus_name }}</td>
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
                                                                <!-- <button type="submit" class="btn btn-info float-left" href="" target="_BLANK"><i class="fa fa-print"></i> Print</button> -->
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
    
function hideGroupSelection(){
    $("#select_set").show();
    $("#select_trx").hide();
    $("#select_cus").hide();
    $("#select_usr").hide();
    $("#select_prd").hide();
}

$("#select_set").hide();
$("#select_grp").on("change keyup", function() {
    hideGroupSelection();
    var select_val = $("#select_grp").val().toLowerCase();

    if(select_val == -1){
        $("#select_set").hide();
    }
    else if(select_val == 0){
        hideGroupSelection();
        $("#select_trx").show();
    }
    else if(select_val == 1){
        hideGroupSelection();
        $("#select_cus").show();
    }
    else if(select_val == 2){
        hideGroupSelection();
        $("#select_usr").show();
    }
    else if(select_val == 3){
        hideGroupSelection();
        $("#select_prd").show();
    }
    
});

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
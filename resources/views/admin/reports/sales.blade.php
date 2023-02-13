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
                        <li class="breadcrumb-item active">Reports</li>
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
                            <h3 class="card-title"><i class="fas fa-calendar"></i> Selected Date</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="date_from">From</label>
                                    <input type="date" class="form-control" name="date_from" value="{{ Carbon\Carbon::parse()->format('Y-m-d') }}" required/>     
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="date_to">To</label>
                                    <input type="date" class="form-control" name="date_to" value="{{ Carbon\Carbon::parse()->format('Y-m-d') }}" required/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <button type="submit" class="btn btn-success"><span class="fa fa-search"></span> Find</button> 
                                </div>
                            </div>
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
                                            <th>Product Name</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Quantity Sold</th>
                                            <th>Total Sales</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl-cart">
                                        @php($total_sold = 0)
                                        @php($total_sales = 0)
                                        @foreach($sales as $sale)
                                        
                                           @if($sale->total_sold != null)
                                                @php($total_sold += $sale->total_sold)
                                            @endif
                                            @if($sale->total_sales != null)
                                                @php($total_sales += $sale->total_sales)
                                            @endif

                                            @if($sale->total_sold == null)
                                                @php($sale->total_sold = "0")
                                            @endif
                                            @if($sale->total_sales == null)
                                                @php($sale->total_sales = "0")
                                            @endif
                                            
                                            <tr>
                                                <td>{{ $sale->prd_name }}</td>
                                                <td>{{ $sale->prd_description }}</td>
                                                <td>{{ $sale->prd_price }}</td>
                                                <td>{{ $sale->total_sold }}</td>
                                                <td>₱ {{ number_format($sale->total_sales, 2, '.', ',') }}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                        <tr class="bg-light" height="1px">
                                            <td colspan="6"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class=""><strong class="fa-2x">Total</strong></td>
                                            <td><strong class="fa-2x text-success">{{ $total_sold }}</strong></td>
                                            <td><strong class="fa-2x text-success">₱ {{ number_format($total_sales, 2, '.', ',') }}</strong></td>
                                            <td></td>
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
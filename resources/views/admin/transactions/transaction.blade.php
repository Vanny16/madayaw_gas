@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Manage Products</li>
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
                            <h3 class="card-title"><i class="fas fa-box-open"></i> Find Product</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="{{ action('ProductController@searchProduct') }}">
                            {{ csrf_field() }} 
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="search_string">Find Product</label>
                                                <input type="text" class="form-control" id="search_products" name="search_string" placeholder="Product Name">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="filter_status">Status</label>
                                            <select class="form-control" id="filter_status" name="filter_status">
                                                @foreach($statuses as $status)
                                                    @if($status == $default_status) 
                                                        <option value="{{ $status }}" selected>{{ $status }}</option>
                                                    @else
                                                        <option value="{{ $status }}">{{ $status }}</option>
                                                    @endif
                                                @endforeach   
                                                {{--<option value="">All</option>
                                                <option value="">Active</option>
                                                <option value="">Inactive</option>--}}
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12 mt-2">
                                            <button type="submit" class="btn btn-success"><span class="fa fa-search"></span> Find</button> 
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3"> 
                    <a class="btn btn-primary col-md-2 col-12 mb-1" href="javascript:void(0)" data-toggle="modal" data-target="#product-modal"><i class="fa fa-dolly"></i> New Product</a>

                    <a class="btn btn-info col-md-1 col-12 float-right" href="{{ action('PrintController@allproductDetails') }}" target="_BLANK"><i class="fa fa-print"></i> Print</a>
                </div>

                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-boxes"></i> Products</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="50px"></th>
                                        <th>Product Name</th>
                                        <th>SKU</th>
                                        <th>Price</th>
                                        <th style="text-align: center">Quantity</th>
                                        <th>Description</th>
                                        <th>Supplier</th>
                                        <th width="120px"></th>
                                        <th width="120px"></th>
                                        <th width="100px"></th>
                                    </tr>
                                </thead>
                                <tbody id="tbl-products">
                                @if(isset($products))
                                    @foreach($products as $product)
                                        @if($product->prd_quantity < $product->prd_reorder_point)
                                            @php($reorder_indicator = "table-danger" )
                                        @else
                                            @php($reorder_indicator = "")
                                        @endif
                                        <tr class="{{ $reorder_indicator }}">
                                            <td>
                                                @if($product->prd_image <> '')
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#img-product-modal-{{$product->prd_id}}"><img class="img-fluid img-circle elevation-2" src="{{ asset('img/products/' . $product->prd_image) }}" alt="{{ $product->prd_image }}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                @else
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#img-product-modal-{{$product->prd_id}}"><img class="profile-user-img img-fluid img-circle" src="{{ asset('img/products/default.png') }}" alt="{{ $product->prd_image }}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                @endif
                                            </td>   
                                            @if($product->prd_name)
                                                <td>   
                                                    {{$product->prd_name}}
                                                </td>
                                            @else
                                                <td>-</td>
                                            @endif
                                            @if($product->prd_sku)
                                                <td>   
                                                    {{$product->prd_sku}}
                                                </td>
                                            @else
                                                <td>-</td>
                                            @endif
                                            <td>-</td>
                                            <td style="text-align: center">   
                                                {{$product->prd_quantity}}
                                                <br>
                                                @if($reorder_indicator != "") 
                                                    @if($product->prd_quantity == 0)
                                                        <span class="badge badge-danger">Restock now</span>
                                                    @elseif($product->prd_quantity < $product->prd_reorder_point)
                                                        <span class="badge badge-warning">Request for restock</span>
                                                    @endif
                                                @endif
                                            </td>
                                            @if($product->prd_description)
                                                <td>   
                                                    {{$product->prd_description}}
                                                </td>
                                            @else
                                                <td>-</td>
                                            @endif
                                            @if($product->sup_name)
                                                <td>   
                                                    {{$product->sup_name}}
                                                </td>
                                            @else
                                                <td>-</td>
                                            @endif
                                                <td>
                                                    <a class="btn btn-default btn-sm text-primary" href="javascript:void(0)" data-toggle="modal" data-target="#product-stockin-modal-{{$product->prd_id}}"><i class="fa fa-plus mr-1" aria-hidden="true"></i> Stock-in</a>
                                                </td>
                                                <td>
                                                    @if($product->prd_active == 1) 
                                                    <span class="badge badge-success">Active</span>
                                                    <a class="fa fa-toggle-on" type="button" href="{{ action('ProductController@deactivateProduct',[$product->prd_id])}}" aria-hidden="true"></a>
                                                    @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                    <a class="fa fa-toggle-off" type="button" href="{{ action('ProductController@reactivateProduct',[$product->prd_id])}}" aria-hidden="true"></a>
                                                    @endif
                                                </td>
                                                <td>
                                                @if($product->prd_active == 0)
                                                    <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" disabled><i class="fa fa-ellipsis-vertical"></i></button>
                                                @else   
                                                    <div class="dropdown">
                                                        <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" data-toggle="dropdown"><i class="fa fa-ellipsis-vertical"></i></button>
                                                        <ul class="dropdown-menu">
                                                            @if(session('typ_id') == '1' || session('typ_id') == '2')
                                                            <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#edit-product-modal-{{$product->prd_id}}"><i class="fa fa-edit mr-2" aria-hidden="true"></i>Edit Info</a></li>
                                                            @endif
                                                            <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#print-product-modal-{{$product->prd_id}}"><i class="fa fa-print mr-2" aria-hidden="true"></i>Print Info</a></li>
                                                        </ul>
                                                    </div>
                                                @endif
                                                </td> 
                                        </tr> 
                                 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
</div>




@endsection
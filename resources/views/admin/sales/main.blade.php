@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Point of Sale</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item active">POS</li>
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
                            <div class="row">
                                <h3 class="card-title col-6"><i class="fas fa-cash-register"></i> Transaction</h3>
                                <div class="col-md-6 text-right text-gray order-lg-2 order-1 mb-3">
                                    <small>
                                        <i id="current-date-now"><?php echo date(" F d, Y"); ?> </i>
                                        <i id="current-time-now" class="text-info ml-1" data-start="<?php echo time(); ?>"></i>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 order-lg-2 order-1 mb-3 text-right">
                                    @if($transaction_id == null)
                                        @php($transaction_id = 1)
                                    @else
                                        @php($transaction_id += 1)
                                    @endif
                                    <label>Transaction</label>
                                    <p class="text-danger fa-2x mr-2">TRX 20230131-{{ $transaction_id }}</p>
                                </div>
                                <div class="col-md-9 order-lg-1 order-2">
                                    <label>Customer Name</label>
                                    <select class="form-control col-md-5 col-12" id="client_id" name="client_id" required="">
                                        <option value="-1">-NOT SPECIFIED-</option>
                                        <option value="0">-WALK IN-</option>
                                        @if(isset($customers))
                                            @foreach($customers as $customer)
                                                @if(session('new_client') == $customer->cus_name )
                                                    @php($selected = "selected")
                                                @else
                                                    @php($selected = "")
                                                @endif
                                                <option value="{{ $customer->cus_id }}" {{ $selected }}>{{ $customer->cus_name }} </option>
                                            @endforeach
                                        @endif            
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 col-12 mb-3">
                        <button type="button" class="btn btn-default bg-danger form-control" data-toggle="modal" data-target="#order-modal"><i class="fa fa-plus-circle"></i> Select Products</button>
                    </div>

                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class="card-title"><i class="fa fa-cart-arrow-down"></i> Canisters In</h3>
                            <div class="col-md-12 text-right text-white order-lg-2 order-1 mb-1">
                            </div>   
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <div class="row">
                                <table class="table table-lg table-borderless text-left">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th></th>
                                            <th>Crates</th>
                                            <th>Loose</th>
                                            <th width="50"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl-prd-in">
                                    </tbody>
                                    <tbody>
                                        <tr class="bg-light" height="1px">
                                            <td colspan="6"></td>
                                        </tr>
                                        <tr class="text-success bg-white">
                                            <td colspan="1"></td>
                                            <td class="text-info"><strong>Total</strong></td>
                                            <td class="text-info"><strong id="lbl_total_crates" class="fa fa-2x">0</strong></td>
                                            <td class="text-info"><strong id="lbl_total_loose" class="fa fa-2x">0</strong></td>                           
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-success">
                            <h3 class="card-title"><i class="fa fa-shopping-cart"></i> Selected Products</h3>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <div class="row">
                                <table class="table table-lg table-borderless text-left">
                                    <thead>
                                        <tr>
                                            <th width="1"></th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Crates</th>
                                            <th>Loose</th>
                                            <th>Discount</th>
                                            <th>Subtotal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl-cart">
                                    </tbody>
                                    <tbody>
                                        <tr class="bg-light" height="1px">
                                            <td colspan="10"></td>
                                        </tr>
                                        <tr class="text-success bg-white">
                                            <td colspan="5"></td>
                                            <td class="text-success"><strong>Total</strong></td>
                                            <td class="text-success"><strong id="lbl_total" class="fa fa-2x">0.00</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 col-12 mb-3">
                            <button type="button" class="btn btn-success form-control" data-toggle="modal" data-target="#payment-modal" onclick="receivePayment()"><i class="fa fa-wallet"></i> Receive Payment</button>
                        </div>
                        <div class="col-md-2 col-12 mb-3">
                            <button type="button" class="btn btn-default form-control" data-toggle="modal" data-target="#void-prompt-modal"><i class="fa fa-ban"></i> Void Transaction</button>
                        </div>
                        <div class="col-md-2 col-12 mb-3">
                            <a class="btn btn-info col-md-12 col-12 form-control" href="{{ action('PrintController@receiptDetails') }}" target="_BLANK"><i class="fa fa-print"></i> Print Receipt</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Order Modal -->
<div class="modal fade" id="order-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-sm fa-shopping-cart"></i> Select Products</h5>
            </div>
           
            <!-- <div class="col-12 mt-2"> 
                <small><i class="fa fa-sm fa-search ml-2"></i> Search Product</small>
                <input id="search_products" type="text" class="form-control col-md-12 col-12 mt-2 bg-light" name="search_string" placeholder="Search ..."/>
            </div> -->
       
            <form method="POST" action="{{ action('CustomerController@createCustomer')}}" enctype="multipart/form-data">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="col-12" style="height:350px; overflow-x:auto;">
                        <div class="row">
                            @if(isset($products))
                                @foreach($products as $product)
                                <div class="col bg-image hover-zoom" data-toggle="modal" data-target="#order_details_modal{{$product->prd_id}}">
                                    <div class="card">
                                        <img class="img-fluid" src="{{ asset('img/products/default.png') }}" style="max-height:50px; max-width:180px; min-height:150px; min-width:150px;">
                                        <div class="container">
                                            <b>{{$product->prd_name}}</b>
                                            <p>{{$product->prd_price}}</p>
                                            <p>{{$product->prd_quantity}} available</p>
                                        </div>    
                                    </div>
                                </div>
                                <!-- Order Details Modal -->
                                <div class="modal fade" id="order_details_modal{{$product->prd_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-sm fa-info-circle"></i> Order Details</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">

                                                    <div class="col-5">
                                                        @if($product->prd_is_refillable == '0')
                                                        @php($addCanistersIn = "")
                                                        @php($in_crate_value = "0")
                                                        @php($in_crate_value = "0")
                                                        <h5 class="text-center mt-5">{{$product->prd_name}} is a non-refillable item.</h5>
                                                        @else
                                                        @php($addCanistersIn = "addCanistersIn(in_crates$product->prd_id.id,in_loose$product->prd_id.id,canister_in$product->prd_id.id); ")
                                                        @php($in_crate_value = "in_crates$product->prd_id.value")
                                                        @php($in_loose_value = "in_loose$product->prd_id.value")
                                                        <h3 class="text-info mb-5"><i class="fa fa-arrow-down"></i> IN</h3>
                                                        <div class="form-group">
                                                            <label for="cus_name">Product Name <span style="color:red">*</span></label>
                                                            <div class="form-inline">
                                                                <select class="form-control col-7" id="canister_in{{$product->prd_id}}" name="canister_in" required>
                                                                    @foreach($products as $in_product)
                                                                        @if($in_product->prd_id == $product->prd_id)
                                                                            @php($select_prd_in = "selected")
                                                                        @else
                                                                            @php($select_prd_in = "")
                                                                        @endif
                                                                        <option value="1,{{ $in_product->prd_id }},{{ $in_product->prd_name }}" {{ $select_prd_in }}>{{ $in_product->prd_name }} </option>
                                                                    @endforeach 
                                                                    @foreach($oppositions as $opposition)
                                                                        <option value="2,{{ $opposition->ops_id }},{{ $opposition->ops_name }}">{{ $opposition->ops_name }} </option>
                                                                    @endforeach 
                                                                </select>
                                                                <button type="button" class="btn btn-info form-control col-md-4 col-12 ml-md-4 mt-md-0 mx-sm-0 mt-3" data-toggle="modal" data-target="#opposite-modal"><i class="fa fa-plus-circle"></i> Add Canister</button>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="cus_address"># of Crates <span style="color:red">*</span></label>
                                                            <input type="number" class="form-control" id="in_crates{{$product->prd_id}}" value="0" min="" max="" onclick="this.select()" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue('in_crates{{$product->prd_id}}')" onkeyup="noNegativeValue('in_crates{{$product->prd_id}}'); set_onkeyup(in_crates{{$product->prd_id}}.value,crates_amount{{$product->prd_id}}.id); getTotal(prd_price{{$product->prd_id}}.id, crates_amount{{$product->prd_id}}.id, loose_amount{{$product->prd_id}}.id, temp_discount{{$product->prd_id}}.id, sub_total{{$product->prd_id}}.id);" required></input>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="cus_address"># of Loose <span style="color:red">*</span></label>
                                                            <input type="number" class="form-control" id="in_loose{{$product->prd_id}}" value="0" min="" max="" onclick="this.select()" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue('in_loose{{$product->prd_id}}')" onkeyup="noNegativeValue('in_loose{{$product->prd_id}}'); set_onkeyup(in_loose{{$product->prd_id}}.value,loose_amount{{$product->prd_id}}.id); getTotal(prd_price{{$product->prd_id}}.id, crates_amount{{$product->prd_id}}.id, loose_amount{{$product->prd_id}}.id, temp_discount{{$product->prd_id}}.id, sub_total{{$product->prd_id}}.id);" required/></input>
                                                        </div>
                                                        @endif
                                                    </div>

                                                    <div class="col-1 bg-light text-center align-items-center">
                                                        <i class="fa fa-arrow-right text-danger mt-5" height="100%"></i>
                                                    </div>

                                                    <div class="col-6">
                                                        <h3 class="text-success mb-5"><i class="fa fa-arrow-up"></i> OUT</h3>
                                                        <div class="form-group">
                                                            <label for="cus_name">Product Name <span style="color:red">*</span></label>
                                                            <input type="text" class="form-control" id="prd_name{{$product->prd_id}}" value="{{$product->prd_name}}" required readonly/>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label for="cus_address">Price <span style="color:red">*</span></label>
                                                            <input type="number" class="form-control" id="prd_price{{$product->prd_id}}" value="{{$product->prd_price}}" onkeyup="getTotal(prd_price{{$product->prd_id}}.id, prd_quantity{{$product->prd_id}}.id, temp_discount{{$product->prd_id}}.id, sub_total{{$product->prd_id}}.id)" onkeypress="return isNumberKey(this, event);" onclick="this.select()" required></input>
                                                        </div>
                                                       
                                                        <div class="row">
                                                            @if($product->prd_is_refillable == 1)
                                                                <div class="form-group col-6">
                                                                    <label for="cus_address"># of Crates <span style="color:red">*</span></label>
                                                                    <input type="number" class="form-control" id="crates_amount{{$product->prd_id}}" value="0" min="" max="{{$product->prd_quantity}}" onchange="noNegativeValue('crates_amount{{$product->prd_id}}')" onkeyup="noNegativeValue('crates_amount{{$product->prd_id}}'); getTotal(prd_price{{$product->prd_id}}.id, crates_amount{{$product->prd_id}}.id, loose_amount{{$product->prd_id}}.id, temp_discount{{$product->prd_id}}.id, sub_total{{$product->prd_id}}.id);" onkeypress="return isNumberKey(this, event);" onclick="this.select()" required></input>
                                                                </div>

                                                                <div class="form-group col-6">
                                                                    <label for="cus_address"># of Loose <span style="color:red">*</span></label>
                                                                    <input type="number" class="form-control" id="loose_amount{{$product->prd_id}}" value="0" min="" max="{{$product->prd_quantity}}" onchange="noNegativeValue('loose_amount{{$product->prd_id}}')" onkeyup="noNegativeValue('loose_amount{{$product->prd_id}}'); getTotal(prd_price{{$product->prd_id}}.id, crates_amount{{$product->prd_id}}.id, loose_amount{{$product->prd_id}}.id, temp_discount{{$product->prd_id}}.id, sub_total{{$product->prd_id}}.id);" onkeypress="return isNumberKey(this, event);" onclick="this.select()" required></input>
                                                                </div>
                                                            @else
                                                                <input type="hidden" class="form-control" id="crates_amount{{$product->prd_id}}" value="0" min="" max="{{$product->prd_quantity}}" onchange="noNegativeValue('crates_amount{{$product->prd_id}}')" onkeyup="noNegativeValue('crates_amount{{$product->prd_id}}'); getTotal(prd_price{{$product->prd_id}}.id, crates_amount{{$product->prd_id}}.id, loose_amount{{$product->prd_id}}.id, temp_discount{{$product->prd_id}}.id, sub_total{{$product->prd_id}}.id);" onkeypress="return isNumberKey(this, event);" onclick="this.select()" required></input>

                                                                <div class="form-group col-12">
                                                                    <label for="cus_address">Quantity<span style="color:red">*</span></label>
                                                                    <input type="number" class="form-control" id="loose_amount{{$product->prd_id}}" value="0" min="" max="{{$product->prd_quantity}}" onchange="noNegativeValue('loose_amount{{$product->prd_id}}')" onkeyup="noNegativeValue('loose_amount{{$product->prd_id}}'); getTotal(prd_price{{$product->prd_id}}.id, crates_amount{{$product->prd_id}}.id, loose_amount{{$product->prd_id}}.id, temp_discount{{$product->prd_id}}.id, sub_total{{$product->prd_id}}.id);" onkeypress="return isNumberKey(this, event);" onclick="this.select()" required></input>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        {{--<div class="form-group">
                                                            <label for="cus_address">Quantity <span style="color:red">*</span></label>
                                                            <input type="number" class="form-control" id="prd_quantity{{$product->prd_id}}" value="0" min="1" max="{{$product->prd_quantity}}" onchange="noNegativeValue('prd_quantity{{$product->prd_id}}')" onkeyup="noNegativeValue('prd_quantity{{$product->prd_id}}'); getTotal(prd_price{{$product->prd_id}}.id, prd_quantity{{$product->prd_id}}.id, temp_discount{{$product->prd_id}}.id, sub_total{{$product->prd_id}}.id)" onkeypress="return isNumberKey(this, event);" onclick="this.select()" required></input>
                                                        </div>--}}

                                                        <div class="form-group">
                                                            <label for="cus_address">Discount (Amount in Peso) <span style="color:red">*</span></label>
                                                            <input type="number" class="form-control" id="temp_discount{{$product->prd_id}}" value="0.00" onkeyup="getTotal(prd_price{{$product->prd_id}}.id, prd_quantity{{$product->prd_id}}.id, temp_discount{{$product->prd_id}}.id, sub_total{{$product->prd_id}}.id)" onkeypress="return isNumberKey(this, event);" onclick="this.select()" required></input>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label for="cus_address">Total Amount <span style="color:red">*</span></label>
                                                            <input type="text" class="form-control" id="sub_total{{$product->prd_id}}" value="0.00" onkeypress="return isNumberKey(this, event);" readonly></input>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#order_details_modal{{$product->prd_id}}">Cancel</button>
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#order_details_modal{{$product->prd_id}}" onclick="{{$addCanistersIn}} addToCart({{$product->prd_id}},prd_name{{$product->prd_id}}.value, prd_price{{$product->prd_id}}.value, crates_amount{{$product->prd_id}}.value, loose_amount{{$product->prd_id}}.value, temp_discount{{$product->prd_id}}.value, {{$in_crate_value}}, {{$in_loose_value}}, order_details_modal{{$product->prd_id}}.id);"><i class="fa fa-plus-circle"></i> Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Done</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Opposite Cans -->
<div class="modal fade show" id="opposite-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md show" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ action('SalesController@addCanister') }}" enctype="multipart/form-data">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 text-center">
                                <img class="img-circle elevation-2" src="{{ asset('img/products/default.png') }}" alt="{{-- $product->prd_image --}}" style="max-height:150px; max-width:150px; min-height:150px; min-width:150px; object-fit:cover;"/>
                            <div class="col-12 text-center mb-4">
                            <a href="javascript:void(0);" class="">
                                <label class="btn btn-transparent btn-file">
                                    <i id="btn_choose_file" class="fa fa-solid fa-camera mr-2"></i><small>Upload Photo</small>
                                    <input type="file" class="custom-file-input" id="choose_file" name='ops_image' value="{{-- old('prd_image') --}}" aria-describedby="inputGroupFileAddon01" style="display: none;">
                                </label>
                            </a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="prd_name">Product Name <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="ops_name" placeholder="Enter Product Name" value="" required/>
                            </div>
                            <div class="form-group">
                                <label for="prd_sku">SKU <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="ops_sku" placeholder="Enter SKU" value="" required/>
                            </div>
                            <div class="form-group">
                                <label for="prd_description">Description <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="ops_description" placeholder="Enter Description" value="" required/>
                            </div>
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea name="ops_notes" placeholder="Additional notes ..." class="form-control"></textarea>
                            </div>
                        </div>
                    </div>   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Void Transaction Modal -->
<div class="modal fade" id="void-prompt-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header text-danger">
                <h5 class="modal-title"><i class="fa fa-exclamation mr-2 text-danger"> </i>Warning</h5>
            </div> 
            <div class="modal-body">
                <div class="col-12">
                    Are you sure you want to end the transaction?
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ action('SalesController@main') }}" type="button" class="btn btn-default text-danger"><i class="fa fa-ban mr-1 text-danger"> </i>Void Transaction</a>
                <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Payment Modal -->
<div class="modal fade" id="payment-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ action('SalesController@paymentSales')}}" enctype="multipart/form-data">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="modal-header text-info">
                                <h5 class="modal-title"><i class="fa fa-receipt mr-2"> </i>Receipt</h5>
                            </div>  
                            <div class="row">
                                <table class="table table-striped table-hover ml-2 table-borderless text-left">
                                    <thead>
                                        <th>Qty</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th></th>
                                    </thead>
                                    <tbody id="tbl-rct">
                                        <tr class="bg-light" height="1px">
                                            <td colspan="6"></td>
                                        </tr>
                                        {{--<tr class="text-success bg-white">
                                            <td colspan="3"></td>
                                            <td class="text-success"><strong>Total</strong></td>
                                            <td class="text-success"><strong id="lbl_rct_total" class="fa fa-3x">0.00</strong></td>
                                            <td></td>
                                        </tr>--}}
                                    </tbody>
                                </table>
                                <table class="table table-lg table-borderless text-left">
                                    <tbody>
                                        <tr>
                                            <td colspan="2"><hr></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Gross Total</strong></td>
                                            <td><a id="rct_gross_total">0.00</a></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Discount</strong></td>
                                            <td><a id="rct_discount">0.00</a></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Amount Payable</strong></td>
                                            <td><a id="rct_amount_payable">0.00</a></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Amount Paid</strong></td>
                                            <td><a id="rct_amount_paid">0.00</a></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Change</strong></td>
                                            <td><a id="rct_change">0.00</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="modal-header text-success">
                                <h5 class="modal-title"><i class="fa fa-wallet mr-2"> </i>Payment</h5>
                            </div>
                            <div class="form-group">
                                <label for="cus_address">Amount Payable <span style="color:red">*</span></label>
                                <input type="text" id="amount_payable" name="trx_total" class="form-control" readonly></input>
                            </div>
                            <div class="form-group">
                                <label for="cus_address">Received Amount <span style="color:red">*</span></label>
                                <input type="text" id="received_amount" name="trx_amount_paid" class="form-control" placeholder="Enter Amount" onchange="noNegativeValue('received_amount')"  onkeypress="return isNumberKey(this, event)" onkeyup="noNegativeValue('received_amount'); enterPayable();" required></input>
                                <input type="hidden" id="purchases" name="purchases" class="form-control" value=""></input>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-money-bill mr-1"> </i>Pay</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
                <div class="col-md-2 col-12 mb-3">
                    <a class="btn btn-info col-md-12 col-12 form-control" href="{{ action('PrintController@receiptDetails') }}" target="_BLANK"><i class="fa fa-print"></i> Print Receipt</a>
                </div>
            </form>
        </div>  
    </div>
</div>

<!-- Receipt Modal -->
<div class="modal fade" id="receipt-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header text-info">
                <h5 class="modal-title"><i class="fa fa-receipt mr-2"> </i>Receipt</h5>
            </div> 
            <div class="modal-body">
                <div class="col-12">
                    <div class="row">
                        <table class="table table-sm table-borderless text-left">
                            <thead>
                                <th>Qty</th>
                                <th>Description</th>
                                <th>Price</th>
                            </thead>
                            
                            <tbody>
                                <tr class="card-header">
                                    <td colspan="6"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-sm table-borderless text-left">                   
                            <tbody>
                                <tr>
                                    <td>Gross Total</td>
                                    <td>20.00</td>
                                </tr>
                                <tr>
                                    <td>Discount</td>
                                    <td>50.00</td>
                                </tr>
                                <tr>
                                    <td>Amount Payable</td>
                                    <td>20.00</td>
                                </tr>
                                <tr>
                                    <td>Amount Paid</td>
                                    <td>20.00</td>
                                </tr>
                                <tr>
                                    <td>Change</td>
                                    <td>20.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ action('SalesController@main') }}" type="button" class="btn btn-info"><i class="fa fa-print mr-1"> </i>Print</a>
                <button type="submit" class="btn btn-default" data-dismiss="modal"><i class="fa fa-check mr-1"> </i> Finish</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    //get new date from timestamp in data-start attr
    var freshTime = new Date(parseInt($("#current-time-now").attr("data-start"))*1000);
    //loop to tick clock every second
    var func = function myFunc() {
        //set text of clock to show current time
        $("#current-time-now").text(freshTime.toLocaleTimeString());
        //add a second to freshtime var
        freshTime.setSeconds(freshTime.getSeconds() + 1);
        //wait for 1 second and go again
        setTimeout(myFunc, 1000);
    };
    func();

    $(document).ready(function(){
        $("#search_products").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tbl-products tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    function getTotal(prd_price_id, crates_id, loose_id, temp_discount_id, txt_sub_total){
        var prd_price = parseFloat(document.getElementById(prd_price_id).value);
        var crates_amount = parseFloat(document.getElementById(crates_id).value);
        var loose_amount = parseFloat(document.getElementById(loose_id).value);

        var total_quantity = ((crates_amount * 12));
        total_quantity = parseInt(total_quantity) + parseInt(loose_amount);
        
        var temp_discount = document.getElementById(temp_discount_id).value;
        var sub_total = (prd_price * total_quantity) - temp_discount;

        if(prd_price == "" || prd_price < 1){
            document.getElementById(prd_price_id).value = "0.00";
            document.getElementById(temp_discount_id).value = "0.00";
            sub_total = 0;
        }
        // if(prd_quantity == "" || prd_quantity < 1 || crates_amount < 1 || loose_amount < 1){
        //     alert("Quantity cannot be zero");
        //     document.getElementById(prd_quantity_id).value = "1";
        // }

        document.getElementById(txt_sub_total).value = sub_total.toFixed(2);
    }

    //Initialize Array for Sales Report in Add to Cart Function
    var total_discount = parseFloat(0);
    var details = new Array();

    function addToCart(prd_id, prd_name, prd_price, crates_amount, loose_amount, temp_discount, in_crate_val, in_loose_val, modal) {
        
        var crates_amount = parseInt(crates_amount);
        var loose_amount = parseInt(loose_amount);
        var prd_quantity = parseInt((crates_amount * 12) + loose_amount);
        
        if(prd_quantity != "" || prd_quantity > 0){
            //Calculations
            var total = document.getElementById("lbl_total").innerHTML;
            var gross_total = (prd_price * prd_quantity);
            var sub_total = gross_total - temp_discount;
            total = parseFloat(total) + sub_total;
            
            // Setter For Price
            if(prd_price == "" || prd_price < 1){
                prd_price = "<small class='bg-warning badge'>Free</small>";
            }
            else{
                prd_price = parseFloat(prd_price).toFixed(2);
            }
            
            // Setter For Discount
            if(temp_discount == ""){
                temp_discount = 0.00;
            }
            total_discount = total_discount + temp_discount;

            //Setter For Amount to be Paid
            var client_id = document.getElementById("client_id").value;
            var amount = document.getElementById("amount_payable");
            amount.value = total.toFixed(2);

            //For Populating Selected Products Table 

            var table = document.getElementById("tbl-cart");
            var row_count = (table.rows.length);
            var row = table.insertRow(0);
            row.id = "row"+row_count;
            row.insertCell(0).innerHTML = "<label hidden>" +prd_id+ "</label>";
            row.insertCell(1).innerHTML = prd_name;
            row.insertCell(2).innerHTML = prd_price;
            row.insertCell(3).innerHTML = parseFloat(crates_amount);
            row.insertCell(4).innerHTML = parseFloat(loose_amount);
            row.insertCell(5).innerHTML = parseFloat(temp_discount).toFixed(2);
            row.insertCell(6).innerHTML = sub_total.toFixed(2);
            row.insertCell(7).innerHTML = "<label hidden>" +in_crate_val+ "</label>";
            row.insertCell(8).innerHTML = "<label hidden>" +in_loose_val+ "</label>";
            row.insertCell(9).innerHTML = "<a href='javascript:void()' onclick='removeFromCart(" +row.id+ "," +sub_total+ ")'><i class='fa fa-trash text-warning'></i></a>";

            
            var received = document.getElementById("received_amount").value;

            document.getElementById("rct_gross_total").innerHTML = gross_total.toFixed(2);
            document.getElementById("rct_discount").innerHTML = parseFloat(temp_discount).toFixed(2);
            document.getElementById("rct_amount_payable").innerHTML = sub_total.toFixed(2);
            document.getElementById("rct_amount_paid").innerHTML = received;
            document.getElementById("lbl_total").innerHTML = total.toFixed(2);
            modal.hidden = true;
            
            alert(prd_quantity+ " " +prd_name+ " has been added to cart");
            // session()->flash('successMessage','Transaction complete!');
        }
        else{
            alert("Please input quantity");
        }
    }

    function addCanistersIn(in_crate_id, in_loose_id, select_id){

        try{
            var in_crate = parseInt(document.getElementById(in_crate_id).value);
            var in_loose = parseInt(document.getElementById(in_loose_id).value);
            var total_crates = parseInt(document.getElementById("lbl_total_crates").innerHTML) + in_crate;
            var total_loose = parseInt(document.getElementById("lbl_total_loose").innerHTML) + in_loose;
            var sub_total = 0;
            
            var canister_id = document.getElementById(select_id).value;
            
            if((in_crate + in_loose) != "" || (in_crate + in_loose) > 0){
                //Set Empty Values to 0 for Displaying in Table
                
                if(in_crate == "" || in_crate < 0){
                    in_crate = 0;
                }
                if((in_loose) == "" || (in_loose) < 0){
                    in_loose = 0;
                }
                
                //Calculations
                var total = (in_crate * 12) + in_loose;
                var display_crates = in_crate + " pc/s";
                var display_loose = in_loose + " pc/s";

                //Setter For Canister in Name
            
                var holder = canister_id.split(",");
                var item_name = "";
                var flag = 1;
                if(holder[0] == "1")
                {
                    item_name = holder[2];
                    var badge_type = "badge-primary";
                }
                else
                {
                    flag = 2;
                    item_name = holder[2];
                    var badge_type = "badge-warning";
                }

                //For Adding Quantity to Canisters Already in the Table


                //For Populating Selected Products Table 
                var table = document.getElementById("tbl-prd-in");
                var row_count = (table.rows.length);
                var row = table.insertRow(0);
                row.id = "row_in"+row_count;
                row.insertCell(0).innerHTML = "<span class='lead'> <span class='badge badge-pill "+badge_type+"'>"+item_name+"</span></span>";
                row.insertCell(1).innerHTML = "";
                row.insertCell(2).innerHTML = "<span class='lead'> <span class='badge badge-pill badge-info'>"+display_crates+"</span></span>";
                row.insertCell(3).innerHTML = "<span class='lead'> <span class='badge badge-pill badge-info'>"+display_loose+"</span></span>";
                // row.insertCell(4).innerHTML = "<a href='javascript:void()' onclick='removeFromCanisterIn(" +row.id+ "," +total_crates+ ","+total_loose+")'><i class='fa fa-trash text-warning'></i></a>";
                
                document.getElementById("lbl_total_crates").innerHTML = total_crates;
                document.getElementById("lbl_total_loose").innerHTML = total_loose;
                
                alert(display_crates+" Crate/s and "+display_loose+" Loose of "+item_name+ " has been added");

            }
            else{
                alert("No canisters were in for this item");
            }
        }
        catch(e){
            alert("Item has been added");
        }
    }

    function enterPayable(){
        // alert("test");
        //Change AMOUNT PAID and CHANGE in Modal when KeyPressed on amount_payable input
        var amount = document.getElementById("amount_payable").value;
        var received = parseFloat(document.getElementById("received_amount").value);
        var change = document.getElementById("rct_change").value;
        document.getElementById("rct_amount_paid").innerHTML = received.toFixed(2);


        if(amount = ""){
            amount = 0;
        }
        else{
            parseFloat(amount);
        }

        var final_change = received - amount;

        // if(final_change != "" || final_change > 0){
            document.getElementById("rct_change").innerHTML = final_change.toFixed(2);
        // }
        // else{
        //     alert();
        // }
    }

    function removeFromCart(row, sub_total) {
        var total = document.getElementById("lbl_total").innerHTML; 
        total = parseFloat(total) - sub_total;
        
        document.getElementById("lbl_total").innerHTML = total.toFixed(2);
        document.getElementById("amount_payable").value = total.toFixed(2);

        var deleteRow = document.getElementById(row.id);
        row.parentElement.removeChild(deleteRow);
    }

    function removeFromCanisterIn(row, crate, loose){
        var total_crate = document.getElementById("lbl_total_crates").innerHTML; 
        var total_loose = document.getElementById("lbl_total_loose").innerHTML; 
        total_crate = parseFloat(total_crate) - crate;
        total_loose = parseFloat(total_loose) - loose;

        document.getElementById("lbl_total_crates").innerHTML = total_crate;
        document.getElementById("lbl_total_loose").innerHTML = total_loose;

        var deleteRow = document.getElementById(row.id);
        row.parentElement.removeChild(deleteRow); 
    }

    $(document).ready(function(){
        $("#receipt-modal").modal('hide');
    });

    function noNegativeValue(id){
        var value = document.getElementById(id).value;
        if(value < 0 || value == ""){
            document.getElementById(id).value ="0";
        }
    }

   function  receivePayment(){

        var client_id = document.getElementById("client_id").value;
        var convertedIntoArray = [];
        $("#tbl-cart tr").each(function() {
            var rowDataArray = [];
            var actualData = $(this).find('td');
             
            if (actualData.length > 0) {
                actualData.each(function() {
                    rowDataArray.push($(this).text());
                });
                convertedIntoArray.push(rowDataArray+client_id+",#");
            }
        });

        document.getElementById("purchases").value = convertedIntoArray;
        
        //For Receipt
        let cart_text = convertedIntoArray.toString();
        const cart_item = cart_text.split(",#,");
        
        var rct_table = document.getElementById("tbl-rct");
        $("#tbl-rct tr").remove(); 
        
        var item_qty = "";
        var item_des = "";
        var item_tot = "";

        for(let i=0; i <= (cart_item.length)-1; i++){
            let row_text = cart_item[i];
            const row_item = row_text.split(",");

            var rct_row = rct_table.insertRow(0);

            for(let j=0; j < row_item.length; j++){
                //For Populating Receipt Table 
                var prd_quantity = parseInt((row_item[3] * 12) + parseInt(row_item[4]));
                
                item_qty = prd_quantity;
                item_des = row_item[1];
                item_tot = row_item[6];
        
            }

            try{
                rct_row.insertCell(0).innerHTML = item_qty;
                rct_row.insertCell(1).innerHTML = item_des;
                rct_row.insertCell(2).innerHTML = item_tot;
            }
            catch(e){
                alert("Please select products first");
            }
        }

   }

    function set_onkeyup(orig,copy){
        
        if(orig < 0 || orig == ""){
            document.getElementById(copy).value ="0";
        }
        else{
            document.getElementById(copy).value = orig;
        }
    }
</script>

@endsection
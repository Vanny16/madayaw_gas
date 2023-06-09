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
                                    <p class="text-danger fa-2x mr-2">POS-<?php echo date("Y").date("m").date("d"); ?>-{{ $transaction_id }}</p>
                                </div>
                                <div class="col-md-9 order-lg-1 order-2">
                                    <form id="cus_form" method="POST" action="{{ action('SalesController@selectCustomer')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }} 
                                        <label>Customer Name</label>
                                        <!-- <select class="form-control col-md-5 col-12" id="client_id" name="client_id" required="">
                                            <option value="0"></option>
                                            @if(isset($customers))
                                                @foreach($customers as $customer)
                                                    @if(session('new_client') == $customer->cus_name || session('selected_customer') == $customer->cus_id)
                                                        @php($selected = "selected")
                                                    @else
                                                        @php($selected = "")
                                                    @endif
                                                    <option value="{{ $customer->cus_id }}" {{ $selected }}>{{ $customer->cus_name }} </option>
                                                @endforeach
                                            @endif
                                        </select> -->
                                        
                                        <input list="cus_select" id="client_id" name="client_id[]" class="form-control col-md-5 col-12" autocomplete="off" onclick="select()" value="{{ session('client_id') }}"/>
                                        <datalist id="cus_select">
                                            <option></option>
                                            @if(isset($customers))
                                                @foreach($customers as $customer)
                                                    @if(session('new_client') == $customer->cus_name || session('selected_customer') == $customer->cus_id)
                                                        @php($selected = "selected")
                                                    @else
                                                        @php($selected = "")
                                                    @endif
                                                    <option data-value="{{ $customer->cus_name }}">{{ $customer->cus_name }}</option>
                                                @endforeach
                                            @endif
                                        </datalist>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 col-12 mb-3">
                            <button type="button" class="btn btn-default bg-danger form-control" onclick="selectUserFirst()"><i class="fa fa-plus-circle"></i> Select Products</button>
                        </div>

                        <div class="col-md-8 col-0"></div>

                        <div class="col-md-2 col-12 mb-3">
                            <div class="dropdown float-right">
                                <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu float-left dropdown-menu-right" style="left: auto; right: 0;">
                                    <li><a id="btn_bad_order" href="javascript:void(0)" data-toggle="modal" data-target="#bad-order-modal"><i class="fa fa-exchange ml-2"></i> Return Bad Order</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title"><i class="fa fa-arrow-down"></i> IN</h3>
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
                                            <td class="text-secondary"><strong>Per Item Total</strong></td>
                                            <td class="text-secondary"><strong id="lbl_total_crates" class="fa fa-2x">0</strong></td>
                                            <td class="text-secondary"><strong id="lbl_total_loose" class="fa fa-2x">0</strong></td>                           
                                        </tr>
                                        <tr class="text-success bg-white">
                                            <td colspan="1"></td>
                                            <td class="text-info"><strong>Obtained Total</strong></td>
                                            <td class="text-info"><strong id="lbl_obtain_crates" class="fa fa-2x">0</strong></td>
                                            <td class="text-info"><strong id="lbl_obtain_loose" class="fa fa-2x">0</strong></td> 
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-success">
                            <h3 class="card-title"><i class="fa fa-arrow-up"></i> OUT</h3>
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
                                            <th width="1"></th>
                                            <th>Subtotal</th>
                                            <th width="1"></th>
                                            <th width="1"></th>
                                            <th width="1"></th>
                                            <th width="1"></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl-cart">
                                    </tbody>
                                    <tbody>
                                        <tr class="bg-light" height="1px">
                                            <td colspan="13"></td>
                                        </tr>
                                        <tr class="text-success bg-white">
                                            <td colspan="5"></td>
                                            <td colspan="2" class="text-secondary">Deposit</td>
                                            <td class="text-secondary"><span id="lbl_total_deposit" class="fa fa-2x">0.00</span></td>
                                        </tr>
                                        <tr class="text-success bg-white">
                                            <td colspan="5"></td>
                                            <td colspan="2" class="text-success"><strong>Total</strong></td>
                                            <td class="text-success"><strong id="lbl_total" class="fa fa-2x">0.00</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 col-12 mb-3">
                            <button id="btn_rcv_pay" type="button" class="btn btn-success form-control" data-toggle="modal" data-target="#payment-modal" onclick="receivePayment()" disabled><i class="fa fa-wallet"></i> Receive Payment</button>
                        </div>
                        <div class="col-md-2 col-12 mb-3">
                            <button type="button" class="btn btn-default form-control" data-toggle="modal" data-target="#void-prompt-modal"><i class="fa fa-ban"></i> Void Transaction</button>
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
                                @if(property_exists($product, 'cus_accessibles_prices'))
                                    @php($prd_price = $product->cus_accessibles_prices)
                                @else
                                    @php($prd_price = $product->prd_price)
                                @endif
                                <div class="col bg-image hover-zoom" data-toggle="modal" data-target="#order_details_modal{{$product->prd_id}}" onclick="setMovementId()">
                                    <div class="card">
                                        <img class="img-fluid" src="{{ asset('img/products/default.png') }}" style="max-height:50px; max-width:180px; min-height:150px; min-width:150px;">
                                        <div class="container">
                                            <b>{{$product->prd_name}}</b>
                                            <p>₱ {{ number_format($prd_price, 2, '.', ',') }}</p>
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
                                                <h5>Remaining Stocks: <strong class="text-danger">{{$product->prd_quantity}}</strong></h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">   

                                                    <div class="col-md-5 col-12">
                                                        @if($product->prd_is_refillable == '0')
                                                            @php($addCanistersIn = "")
                                                            @php($select_in = "0")
                                                            @php($in_crate_value = "0")
                                                            @php($in_loose_value = "0")
                                                            <h5 class="text-center mt-5">{{$product->prd_name}} is a non-refillable item.</h5>
                                                        @else
                                                            @php($addCanistersIn = "addCanistersIn(in_crates$product->prd_id.id,in_loose$product->prd_id.id,canister_in$product->prd_id.id); ")
                                                            @php($select_in = "canister_in$product->prd_id.value")
                                                            @php($in_crate_value = "in_crates$product->prd_id.value")
                                                            @php($in_loose_value = "in_loose$product->prd_id.value")
                                                            <h3 class="text-info mb-5"><i class="fa fa-arrow-down"></i> IN</h3>
                                                            <div class="form-group">
                                                                <label for="cus_name">Product Name <span style="color:red">*</span></label>
                                                                <div class="form-inline"><!--MARKER-->
                                                                    <select class="form-control col-7" id="canister_in{{$product->prd_id}}" name="canister_in" required>
                                                                        @foreach($in_products as $in_product)
                                                                            @if($in_product->prd_is_refillable == '1')
                                                                                @if($in_product->prd_id == $product->prd_id)
                                                                                    @php($select_prd_in = "selected")
                                                                                @else
                                                                                    @php($select_prd_in = "")
                                                                                @endif
                                                                                <option value="1#{{ $in_product->prd_id }}#{{ $in_product->prd_name }}" {{ $select_prd_in }}>{{ $in_product->prd_name }} </option>
                                                                            @endif
                                                                        @endforeach 
                                                                        @foreach($oppositions as $opposition)
                                                                            <option value="2#{{ $opposition->ops_id }}#{{ $opposition->ops_name }}" style="background-color: yellow">{{ $opposition->ops_name }} </option>
                                                                        @endforeach 
                                                                    </select>
                                                                    <button type="button" class="btn btn-info form-control col-md-4 col-12 ml-md-4 mt-md-0 mx-sm-0 mt-3" data-toggle="modal" data-target="#opposite-modal"><i class="fa fa-plus-circle"></i> Add Canister</button>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="cus_address"># of Crates <span style="color:red">*</span></label>
                                                                <input type="number" class="form-control" id="in_crates{{$product->prd_id}}" value="0" min="" max="" onclick="this.select()" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue('in_crates{{$product->prd_id}}')" onkeyup="noNegativeValue('in_crates{{$product->prd_id}}'); set_onkeyup(in_crates{{$product->prd_id}}.value,crates_amount{{$product->prd_id}}.id); getTotal(prd_price{{$product->prd_id}}.id, crates_amount{{$product->prd_id}}.id, loose_amount{{$product->prd_id}}.id, temp_discount{{$product->prd_id}}.id, sub_total{{$product->prd_id}}.id, {{$product->prd_quantity}});" required></input>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="cus_address"># of Loose <span style="color:red">*</span></label>
                                                                <input type="number" class="form-control" id="in_loose{{$product->prd_id}}" value="0" min="" max="" onclick="this.select()" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue('in_loose{{$product->prd_id}}')" onkeyup="noNegativeValue('in_loose{{$product->prd_id}}'); set_onkeyup(in_loose{{$product->prd_id}}.value,loose_amount{{$product->prd_id}}.id); getTotal(prd_price{{$product->prd_id}}.id, crates_amount{{$product->prd_id}}.id, loose_amount{{$product->prd_id}}.id, temp_discount{{$product->prd_id}}.id, sub_total{{$product->prd_id}}.id, {{$product->prd_quantity}});" required/></input>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="col-md-1 col-12 bg-light text-center align-items-center">
                                                        &nbsp;
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <h3 class="text-success mb-5"><i class="fa fa-arrow-up"></i> OUT</h3>
                                                        <div class="form-group">
                                                            <label for="cus_name">Product Name <span style="color:red">*</span></label>
                                                            <input type="text" class="form-control" id="prd_name{{$product->prd_id}}" value="{{$product->prd_name}}" required readonly/>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label for="cus_address">Price <span style="color:red">*</span></label>
                                                            <input type="number" class="form-control" id="prd_price{{$product->prd_id}}" value="{{ number_format($prd_price, 2, '.', '') }}" onkeyup="getTotal(prd_price{{$product->prd_id}}.id, crates_amount{{$product->prd_id}}.id, loose_amount{{$product->prd_id}}.id, temp_discount{{$product->prd_id}}.id, sub_total{{$product->prd_id}}.id);" onkeypress="return isNumberKey(this, event);" onclick="this.select()" readonly hidden></input>
                                                            <input type="number" class="form-control" value="{{ number_format($prd_price, 2, '.', '') }}" readonly></input>
                                                        </div>
                                                       
                                                        <div class="row">
                                                            @if($product->prd_is_refillable == 1)
                                                                <div class="form-group col-6">
                                                                    <label for="cus_address"># of Crates <span style="color:red">*</span></label>
                                                                    <input type="number" class="form-control" id="crates_amount{{$product->prd_id}}" value="0" min="" max="{{$product->prd_quantity}}" onchange="noNegativeValue('crates_amount{{$product->prd_id}}')" onkeyup="noNegativeValue('crates_amount{{$product->prd_id}}'); getTotal(prd_price{{$product->prd_id}}.id, crates_amount{{$product->prd_id}}.id, loose_amount{{$product->prd_id}}.id, temp_discount{{$product->prd_id}}.id, sub_total{{$product->prd_id}}.id, {{$product->prd_quantity}});" onkeypress="return isNumberKey(this, event);" onclick="this.select()" required></input>
                                                                </div>

                                                                <div class="form-group col-6">
                                                                    <label for="cus_address"># of Loose <span style="color:red">*</span></label>
                                                                    <input type="number" class="form-control" id="loose_amount{{$product->prd_id}}" value="0" min="" max="{{$product->prd_quantity}}" onchange="noNegativeValue('loose_amount{{$product->prd_id}}')" onkeyup="noNegativeValue('loose_amount{{$product->prd_id}}'); getTotal(prd_price{{$product->prd_id}}.id, crates_amount{{$product->prd_id}}.id, loose_amount{{$product->prd_id}}.id, temp_discount{{$product->prd_id}}.id, sub_total{{$product->prd_id}}.id, {{$product->prd_quantity}});" onkeypress="return isNumberKey(this, event);" onclick="this.select()" required></input>
                                                                </div>
                                                            @else
                                                            
                                                                <input type="hidden" class="form-control" id="crates_amount{{$product->prd_id}}" value="0" min="" max="{{$product->prd_quantity}}" onchange="noNegativeValue('crates_amount{{$product->prd_id}}')" onkeyup="noNegativeValue('crates_amount{{$product->prd_id}}'); getTotal(prd_price{{$product->prd_id}}.id, crates_amount{{$product->prd_id}}.id, loose_amount{{$product->prd_id}}.id, temp_discount{{$product->prd_id}}.id, sub_total{{$product->prd_id}}.id, {{$product->prd_quantity}});" onkeypress="return isNumberKey(this, event);" onclick="this.select()" required></input>

                                                                <div class="form-group col-12">
                                                                    <label for="cus_address">Quantity<span style="color:red">*</span></label>
                                                                    <input type="number" class="form-control" id="loose_amount{{$product->prd_id}}" value="0" min="" max="{{$product->prd_quantity}}" onchange="noNegativeValue('loose_amount{{$product->prd_id}}')" onkeyup="noNegativeValue('loose_amount{{$product->prd_id}}'); getTotal(prd_price{{$product->prd_id}}.id, crates_amount{{$product->prd_id}}.id, loose_amount{{$product->prd_id}}.id, temp_discount{{$product->prd_id}}.id, sub_total{{$product->prd_id}}.id, {{$product->prd_quantity}});" onkeypress="return isNumberKey(this, event);" onclick="this.select()" required></input>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <div class="form-group" hidden>
                                                            <label for="cus_address">Discount (Amount in Peso) <span style="color:red">*</span></label>
                                                            <input type="number" class="form-control" id="temp_discount{{$product->prd_id}}" value="0.00" onchange="noNegativeValue('temp_discount{{$product->prd_id}}')" onkeyup="noNegativeValue('temp_discount{{$product->prd_id}}'); getTotal(prd_price{{$product->prd_id}}.id, crates_amount{{$product->prd_id}}.id, loose_amount{{$product->prd_id}}.id, temp_discount{{$product->prd_id}}.id, sub_total{{$product->prd_id}}.id, {{$product->prd_quantity}});" onkeypress="return isNumberKey(this, event);" onclick="this.select()" required></input>
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
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#order_details_modal{{$product->prd_id}}" onclick="{{$addCanistersIn}} addToCart({{$product->prd_id}},prd_name{{$product->prd_id}}.value, prd_price{{$product->prd_id}}.value, {{$product->prd_deposit}}, crates_amount{{$product->prd_id}}.value, loose_amount{{$product->prd_id}}.value, temp_discount{{$product->prd_id}}.value, {{$select_in}}, {{$in_crate_value}}, {{$in_loose_value}}, order_details_modal{{$product->prd_id}}.id);"><i class="fa fa-plus-circle"></i> Add</button>
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
                    <input class="form-control" type="text" id="movement_id" value="0" hidden/>
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
                <h5 class="modal-title" id="exampleModalLabel">Opposition Canister Form</h5>
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
                                <label for="prd_name">Opposition Canister Name <span style="color:red">*</span></label>
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
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form id="form_payment" method="POST" action="{{ action('SalesController@paymentSales')}}" enctype="multipart/form-data">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-header text-info">
                                <h5 class="modal-title"><i class="fa fa-receipt mr-2"> </i>Order Summary</h5>
                            </div>  
                            <div class="row">
                                <table class="table table-striped table-hover ml-2 table-borderless text-left">
                                    <thead>
                                        <th>Qty</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
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
                                            <input type="hidden" id="trx_gross" name="trx_gross">
                                        </tr>
                                        <tr>
                                            <td><strong>Discount</strong></td>
                                            <td><a id="rct_discount">0.00</a></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total Deposit</strong></td>
                                            <td><a id="rct_deposit">0.00</a></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Net Total</strong></td>
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
                                        <tr>
                                            <td><strong>Balance</strong></td>
                                            <td><a id="rct_balance">0.00</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-header text-success">
                                <h5 class="modal-title"><i class="fa fa-wallet mr-2"> </i>Payment</h5>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="cus_address">Transaction Date <span style="color:red">*</span></label>
                                <input type="date" id="trx_date" name="trx_date" class="form-control" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="form-group">
                                <label for="cus_address">Canister Declaration # <span style="color:red">*</span></label>
                                <input type="text" id="trx_can_dec" name="trx_can_dec" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label for="cus_address">Delivery Receipt # <span style="color:red">*</span></label>
                                <input type="text" id="trx_del_rec" name="trx_del_rec" class="form-control" required/>
                            </div><hr>
                            <div class="form-group">
                                <label for="cus_address">Mode of Payment: <i id="mop_lbl" class="text-info">Cash</i></label><br>
                                <button id="btn_cash" type="radio" value="1" class="btn btn-lg btn-light text-warning btn-payment"><i class="fa fa-coins"></i></button>
                                <button id="btn_gcash" type="radio" value="3" class="btn btn-lg btn-light text-dark btn-payment"><img src="{{ asset('img/res/gcash.png') }}" width="22px"/></button>
                                <button id="btn_check" type="radio" value="4" class="btn btn-lg btn-light text-dark btn-payment"><i class="fa fa-landmark"></i></button>
                                <button id="btn_credit" type="radio" value="2" class="btn btn-lg btn-light text-dark btn-payment"><i class="fa fa-credit-card"></i></button>
                                {{-- <button id="btn_split" type="radio" value="5" class="btn btn-lg btn-light text-dark btn-payment"><i class="fa fa-ellipsis"></i></button> --}}
                                <input type="hidden" id="mode_of_payment" name="mode_of_payment" class="form-control"></input>
                            </div>
                            <div class="form-group">
                                <label for="cus_address">Amount Payable</label>
                                <input type="text" id="amount_payable" name="trx_total" class="form-control" readonly></input>
                            </div>
                            <div class="form-group" id="payment_check">
                                <label for="cus_address">Check No. <span style="color:red">*</span></label>
                                <input type="text" id="pmnt_check_no" name="pmnt_check_no" class="form-control" onclick="select()" required></input>
                            </div>
                            <div class="form-group" id="payment_check_date">
                                <label for="cus_address">Check Date <span style="color:red">*</span></label>
                                <input type="date" id="pmnt_check_date" name="pmnt_check_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="form-group" id="payment_input">
                                <label for="cus_address" id="payment_label">Received Amount <span style="color:red">*</span></label>
                                <input type="text" id="received_cash" name="trx_amount_cash" class="form-control" value="0" onchange="noNegativeValue('received_cash'); setTransactionAmount();"  onkeypress="return isNumberKey(this, event)" onkeyup="noNegativeValue('received_cash'); setTransactionAmount();" onclick="select()" required></input>
                                <input type="text" id="received_credit" name="trx_amount_credit" class="form-control" value="0" onchange="noNegativeValue('received_credit'); setTransactionAmount();"  onkeypress="return isNumberKey(this, event)" onkeyup="noNegativeValue('received_credit'); setTransactionAmount();" onclick="select()" required></input>
                                <input type="text" id="received_gcash" name="trx_amount_gcash" class="form-control" value="0" onchange="noNegativeValue('received_gcash'); setTransactionAmount();"  onkeypress="return isNumberKey(this, event)" onkeyup="noNegativeValue('received_gcash'); setTransactionAmount();" onclick="select()" required></input>
                                <input type="text" id="received_check" name="trx_amount_check" class="form-control" value="0" onchange="noNegativeValue('received_check'); setTransactionAmount();"  onkeypress="return isNumberKey(this, event)" onkeyup="noNegativeValue('received_check'); setTransactionAmount();" onclick="select()" required></input>
                                <input type="text" id="received_amount" name="trx_amount_paid" class="form-control" value="0" onchange="noNegativeValue('received_amount');" onkeypress="return isNumberKey(this, event)" onkeyup="noNegativeValue('received_amount'); enterPayable(); setTransactionAmount();" onclick="select()" hidden required></input>
                                <input type="hidden" id="purchases" name="purchases" class="form-control" value=""></input>
                            </div>
                            <div class="form-group" id="payment_attachment_gcash"> 
                                <label for="cus_address">Attachment <span style="color:red">*</span></label>
                                <div class="custom-file">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="pmnt_attachment_gcash" aria-describedby="inputGroupFileAddon01" required>
                                </div>
                            </div>
                            <div class="form-group" id="payment_attachment_check"> 
                                <label for="cus_address">Attachment <span style="color:red">*</span></label>
                                <div class="custom-file">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="pmnt_attachment_check" aria-describedby="inputGroupFileAddon01" required>
                                </div>
                            </div>
                            <p class="mt-4 text-danger">NOTE: <i>Please check the values properly, transaction is unchangeable after POST.</i></p>
                        </div>
                    </div>
                </div>  
                <div class="modal-footer">
                    <button type="button" id="btn_pay" class="btn btn-success" onclick="noCredit()"><i class="fa fa-money-bill mr-1"></i>Pay</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>  
    </div>
</div>

<!-- Add Quantity Modal -->
<div class="modal fade" id="bad-order-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Quantity </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ action('ProductionController@addQuantity') }}">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">   
                                <div id="trx_ref_no">
                                    <label for="quantity" id="lbl-trx_ref_id">Transaction <span style="color:red">*</span></label>
                                    <table>
                                        <tr>
                                            <td width="90%"><input type="text" class="form-control" id="trx_ref_id" name="trx_ref_id" placeholder="ex. POS-00000000-0"/></td>   
                                            <td width="10%"><button type="button" onclick="verifyTransaction()" class="btn btn-info"><i class="fa fa-search"></i></button></td>    
                                        <tr>
                                    </table>
                                </div>
                                <div id="customer">
                                    <label for="cus_name">Customer <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="cus_name" name="cus_name" readonly/>
                                </div>
                                <div id="products">
                                    <label for="cus_name">Product <span style="color:red">*</span></label>
                                    <select class="form-control" id="pur_products" name="stockin_prd_id" required="">
                                    </select>
                                </div>
                                <div id="crate">
                                    <label for="quantity" id="lbl-crate">Crate <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="crate-quantity" name="crate_quantity" placeholder="Quantity" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)"/>
                                </div>
                                <label for="quantity"id="lbl-loose">Loose <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="text" class="form-control" id="set_stockin_flag" name="stockin_flag" value="3" hidden/>
                    <input type="text" class="form-control" id="return_page" name="return_page" value="pos" hidden/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.innerHTML='Saving...'; this.form.submit();"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#btn_cash").css("border-bottom", "4px solid green");
        $("#payment_check").hide();
        $("#payment_check_date").hide();
        $("#payment_attachment_gcash").hide();
        $("#payment_attachment_check").hide();
        $("#mode_of_payment").val("1");
        $("#received_cash").show();
        $("#received_credit").hide();
        $("#received_gcash").hide();
        $("#received_check").hide();

        $("#btn_cash").on("click", function() {
            $("#payment_label").text("Received Payment");
            $("#payment_check").hide();
            $("#payment_check_date").hide();
            $("#payment_attachment_gcash").hide();
            $("#payment_attachment_check").hide();
            $(".btn-payment").css("border-bottom", "none");
            $(this).css("border-bottom", "4px solid green");
            $("#received_cash").show();
            $("#received_credit").hide();
            $("#received_gcash").hide();
            $("#received_check").hide();
            setPaymentType(1);
        });
        $("#btn_credit").on("click", function() {
            $("#payment_label").text("Downpayment");
            $("#payment_check").hide();
            $("#payment_check_date").hide();
            $("#payment_attachment_gcash").hide();
            $("#payment_attachment_check").hide();
            $(".btn-payment").css("border-bottom", "none");
            $(this).css("border-bottom", "4px solid green");
            $("#received_cash").hide();
            $("#received_credit").show();
            $("#received_gcash").hide();
            $("#received_check").hide();
            setPaymentType(2);
        });
        $("#btn_gcash").on("click", function() {
            $("#payment_label").text("Received Payment");
            $("#payment_check").hide();
            $("#payment_check_date").hide();
            $("#payment_attachment_gcash").show();
            $("#payment_attachment_check").hide();
            $(".btn-payment").css("border-bottom", "none");
            $(this).css("border-bottom", "4px solid green");
            $("#received_cash").hide();
            $("#received_credit").hide();
            $("#received_gcash").show();
            $("#received_check").hide();
            setPaymentType(3);
        });
        $("#btn_check").on("click", function() {
            $("#payment_label").text("Received Payment");
            $("#payment_check").show();
            $("#payment_check_date").show();
            $("#payment_attachment_gcash").hide();
            $("#payment_attachment_check").show();
            $(".btn-payment").css("border-bottom", "none");
            $(this).css("border-bottom", "4px solid green");
            $("#received_cash").hide();
            $("#received_credit").hide();
            $("#received_gcash").hide();
            $("#received_check").show();
            setPaymentType(4);
        });
        $("#btn_split").on("click", function() {
            $("#payment_label").text("Received Payment");
            $("#payment_check").hide();
            $("#payment_check_date").hide();
            $("#payment_attachment_gcash").hide();
            $("#payment_attachment_check").hide();
            $(".btn-payment").css("border-bottom", "none");
            $(this).css("border-bottom", "4px solid green");
            $("#received_cash").hide();
            $("#received_credit").hide();
            $("#received_gcash").hide();
            $("#received_check").hide();
            setPaymentType(5);
        });
    });
    
    function setPaymentType(pmnt_type){
        var received_cash = parseFloat(document.getElementById("received_cash").value);
        var received_credit = parseFloat(document.getElementById("received_credit").value);
        var received_gcash = parseFloat(document.getElementById("received_gcash").value);
        var received_check = parseFloat(document.getElementById("received_check").value);
        
        if(pmnt_type == 1){
            if(received_credit > 0 || received_gcash > 0 || received_check > 0){
                $("#mop_lbl").text("Split Payment");
                $("#mode_of_payment").val("5");
            }
            else{
                $("#mop_lbl").text("Cash");
                $("#mode_of_payment").val("1");
            }
        }
        else if(pmnt_type == 2){
            if(received_cash > 0 || received_gcash > 0 || received_check > 0){
                $("#mop_lbl").text("Split Payment");
                $("#mode_of_payment").val("5");
            }
            else{
                $("#mop_lbl").text("Credit");
                $("#mode_of_payment").val("2");
            }
        }
        else if(pmnt_type == 3){
            if(received_cash > 0 || received_credit > 0 || received_check > 0){
                $("#mop_lbl").text("Split Payment");
                $("#mode_of_payment").val("5");
            }
            else{
                $("#mop_lbl").text("G-Cash");
                $("#mode_of_payment").val("3");
            }
        }
        else if(pmnt_type == 4){
            if(received_cash > 0 || received_credit > 0 || received_gcash > 0){
                $("#mop_lbl").text("Split Payment");
                $("#mode_of_payment").val("5");
            }
            else{
                $("#mop_lbl").text("Check");
                $("#mode_of_payment").val("4");
            }
        }
        else{
            if(received_cash > 0 || received_credit > 0 || received_gcash > 0 || received_check > 0){
                $("#mop_lbl").text("Split Payment");
                $("#mode_of_payment").val("5");
            }
            else{
                $("#mop_lbl").text("Invalid");
                $("#mode_of_payment").val("5");
            }
        }
    }
    
    function setTransactionAmount(){
        var received_cash = document.getElementById("received_cash").value;
        var received_credit = document.getElementById("received_credit").value;
        var received_gcash = document.getElementById("received_gcash").value;
        var received_check = document.getElementById("received_check").value;

        document.getElementById("received_amount").value = parseFloat(received_cash) + parseFloat(received_credit) + parseFloat(received_gcash) + parseFloat(received_check);
        
        var rec_amt = document.getElementById("received_amount");
        var event = new Event('keyup');
        rec_amt.dispatchEvent(event);
    }

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
    
    function set_onkeyup(orig,copy){
        if(orig < 0 || orig == ""){
            document.getElementById(copy).value ="0";
        }
        else{
            document.getElementById(copy).value = orig;
        }
    }

    function getTotal(prd_price_id, crates_id, loose_id, temp_discount_id, txt_sub_total, remaining_stocks){
        var prd_price = parseFloat(document.getElementById(prd_price_id).value);
        var crates_amount = parseFloat(document.getElementById(crates_id).value);
        var loose_amount = parseFloat(document.getElementById(loose_id).value);

        var total_quantity = ((crates_amount * 12));
        total_quantity = parseInt(total_quantity) + parseInt(loose_amount);

        if(total_quantity > remaining_stocks){
            document.getElementById(crates_id).value = Math.floor(remaining_stocks / 12);
            document.getElementById(loose_id).value = 0;
            alert("Order quantity must not exceed to the remaining stocks, " + remaining_stocks + " left.");
        }
        
        var temp_discount = document.getElementById(temp_discount_id).value;
        var temp_discount = document.getElementById(temp_discount_id).value;
        var sub_total = (prd_price * total_quantity) - temp_discount;

        if(prd_price == "" || prd_price < 1){
            document.getElementById(prd_price_id).value = "0.00";
            document.getElementById(temp_discount_id).value = "0.00";
            sub_total = 0;
        }
        document.getElementById(txt_sub_total).value = sub_total.toFixed(2);
    }

    function setMovementId(){
        var movement_id = document.getElementById("movement_id").value;
        document.getElementById("movement_id").value = parseInt(movement_id) + 1;
    }

    function addCanistersIn(in_crate_id, in_loose_id, select_id){

        try{
            var in_crate = parseInt(document.getElementById(in_crate_id).value);
            var in_loose = parseInt(document.getElementById(in_loose_id).value);
            var total_crates = parseInt(document.getElementById("lbl_total_crates").innerHTML) + in_crate;
            var total_loose = parseInt(document.getElementById("lbl_total_loose").innerHTML) + in_loose;
            var obtained_total_crates = parseInt(document.getElementById("lbl_obtain_crates").innerHTML) + total_crates;
            var obtained_total_loose = parseInt(document.getElementById("lbl_obtain_loose").innerHTML) + total_loose;
            var sub_total = 0;
            var product_id = select_id.replace(/\D+/g, '');
            var out_crate = parseInt(document.getElementById("crates_amount"+product_id).value);
            var out_loose = parseInt(document.getElementById("loose_amount"+product_id).value);

            var canister_id = document.getElementById(select_id).value;
            
            if(in_crate + in_loose > 0 && out_crate + out_loose == 0)
            {
               return;
            }            

            if((in_crate + in_loose) != "" || (in_crate + in_loose) > 0){
                //Set Empty Values to 0 for Displaying in Table
                
                if(in_crate == "" || in_crate < 0){
                    in_crate = 0;
                }
                if((in_loose) == "" || (in_loose) < 0){
                    in_loose = 0;
                }
                
                //Calculations
 
                var conversion_rate = 12; 

                var obtained_total = (total_crates * conversion_rate) + total_loose;
                var obtained_total_loose = obtained_total % conversion_rate;
                var obtained_total_crates = Math.floor(obtained_total / conversion_rate);
                
                // var total = Math.floor(display_crates / conversion_rate);
                // var display_loose = display_crates % conversion_rate;
                // var display_crates = (in_crate * conversion_rate) + in_loose;

                var total = (in_crate * 12) + in_loose;
                var display_loose = in_loose;
                var display_crates = in_crate;

                //Setter For Canister in Name
            
                var holder = canister_id.split("#");
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
                var isExisting = false;
                var existing_item_row = "";
                var new_crates_value = 0;
                var new_loose_value = 0;
                
                $("#tbl-prd-in tr").each(function() {
                    var existing_item_name = $(this).find("td:eq(0)").text();
                    var getRow = $(this).find("td:eq(1)").text();
                    var getCrate = $(this).find("td:eq(2)").text();
                    var getLoose = $(this).find("td:eq(3)").text();

                    if(existing_item_name == " "+item_name){
                        isExisting = true;
                        existing_item_row = getRow;
                        new_crates_value = parseInt(getCrate) + parseInt(in_crate);
                        new_loose_value = parseInt(getLoose) + parseInt(in_loose);
                    }
                });
                

                //For Populating Selected Products Table 
                if(isExisting){
                    var existingRow = document.getElementById(existing_item_row);
                    existingRow.cells[2].innerHTML = new_crates_value;
                    existingRow.cells[3].innerHTML = new_loose_value;
                }
                else{

                    var table = document.getElementById("tbl-prd-in");
                    var row_id = document.getElementById("movement_id").value;
                    var row = table.insertRow(0);

                    // row.id = "row_in"+row_id;
                    row.insertCell(0).innerHTML = "<span class='lead'> <span class='badge badge-pill "+badge_type+"'>"+item_name+"</span></span>";
                    row.insertCell(1).innerHTML = "<span hidden>"+row.id+"</span";
                    row.insertCell(2).innerHTML = display_crates;
                    row.insertCell(3).innerHTML = display_loose;
                    // row.insertCell(4).innerHTML = "<a href='javascript:void()' onclick='removeFromCanisterIn(" +row.id+ "," +total_crates+ ","+total_loose+")'><i class='fa fa-trash text-warning'></i></a>";
                    
                }
                document.getElementById("lbl_total_crates").innerHTML = total_crates;
                document.getElementById("lbl_total_loose").innerHTML = total_loose;
                document.getElementById("lbl_obtain_crates").innerHTML = obtained_total_crates;
                document.getElementById("lbl_obtain_loose").innerHTML = obtained_total_loose;
            }
            else{
                alert("No canisters were in for this item");
            }
        }
        catch(e){
            alert("Item has been added");
        }
    }

    //Initialize Array for Sales Report in Add to Cart Function
    var total_discount = 0;
    var details = new Array();

    function addToCart(prd_id, prd_name, prd_price, prd_deposit, crates_amount, loose_amount, temp_discount, select_in, in_crate_val, in_loose_val, modal) {

        var crates_amount = parseInt(crates_amount);
        var loose_amount = parseInt(loose_amount);
        var prd_quantity = parseInt((crates_amount * 12) + parseInt(loose_amount));
        var prd_in_quantity = parseInt((in_crate_val * 12) + parseInt(in_loose_val));
        var brd_new_prd_quantity = prd_quantity - prd_in_quantity;
        var prd_id_in ="";
        var can_type_in ="";

        if(select_in != "0"){
            var select_data = select_in.split("#");
            can_type_in = select_data[0];
            prd_id_in = select_data[1];
        }
        else{
            can_type_in = "0";
            prd_id_in = "0";
        }

        if(prd_quantity != "" || prd_quantity > 0){
            // if(prd_in_quantity > prd_quantity){
            //     alert("Canisters to be in must not be greater than quantity to be purchased");
            // }
            // else{
                //Calculations
                var get_total_deposit = document.getElementById("lbl_total_deposit").innerHTML;
                var sub_total_deposit = prd_deposit * brd_new_prd_quantity;
                var total_deposit = sub_total_deposit + parseFloat(get_total_deposit);
                var total = document.getElementById("lbl_total").innerHTML;
                var gross_total = (prd_price * prd_quantity);
                var sub_total = gross_total - temp_discount;
                total = parseFloat(total) + sub_total + sub_total_deposit;
            // }

            
            // Setter For Price
            if(prd_price == "" || prd_price < 1){
                prd_price = "<small class='bg-warning badge'>Free</small>";
            }
            else{
                prd_price = parseFloat(prd_price).toFixed(2);
            }

            var prd_deposit = ""

            if(!prd_deposit){
                prd_deposit = 60;
            }

            // Setter For Discount
            if(temp_discount == ""){
                temp_discount = 0.00;
            }
            else{
                total_discount = total_discount + parseFloat(temp_discount);
            }

            //Setter For Amount to be Paid
            var client_id = document.getElementById("client_id").value;
            var amount = document.getElementById("amount_payable");
            amount.value = total.toFixed(2);

            
            //For Adding Quantity to Canisters Already in the Table

            var isExisting = false;
            var existing_item_row = "";
            var new_crates_value = 0;
            var new_loose_value = 0;
            var new_in_crates_value = 0;
            var new__in_loose_value = 0;
            var new_sub_total = 0;

            $("#tbl-cart tr").each(function() {
                var getRow = $(this).attr('id');
                var existing_item_name = $(this).find("td:eq(1)").text();
                var getCrate = $(this).find("td:eq(3)").text();
                var getLoose = $(this).find("td:eq(4)").text();
                var getInCrate = $(this).find("td:eq(8)").text();
                var getInLoose = $(this).find("td:eq(9)").text();
                var getSubTotal = $(this).find("td:eq(7)").text();
                var getPrdIdIn = $(this).find("td:eq(10)").text();
                var getCanTypeIn = $(this).find("td:eq(11)").text();

                if(existing_item_name == prd_name && getCanTypeIn == can_type_in && getPrdIdIn == prd_id_in){
                    isExisting = true;
                    existing_item_row = getRow;
                    new_crates_value = parseInt(getCrate) + parseInt(crates_amount);
                    new_loose_value = parseInt(getLoose) + parseInt(loose_amount);
                    new_in_crates_value = parseInt(getInCrate) + parseInt(in_crate_val);
                    new__in_loose_value = parseInt(getInLoose) + parseInt(in_loose_val);
                    new_sub_total = parseFloat(getSubTotal) + parseFloat(sub_total);
                }
            });
            
            
            //For Populating Selected Products Table
            if(isExisting){
                var existingRow = document.getElementById(existing_item_row);
                existingRow.cells[3].innerHTML = new_crates_value;
                existingRow.cells[4].innerHTML = new_loose_value;
                existingRow.cells[8].innerHTML = "<label hidden>" +new_in_crates_value+ "</label>";
                existingRow.cells[9].innerHTML = "<label hidden>" +new__in_loose_value+ "</label>";
                existingRow.cells[7].innerHTML = new_sub_total.toFixed(2);
            }
            else{
                
                var row_id = document.getElementById("movement_id").value;
                var table = document.getElementById("tbl-cart");
                var row = table.insertRow(0);

                row.id = "row"+row_id;
                row.insertCell(0).innerHTML = "<label hidden>" +prd_id+ "</label>";
                row.insertCell(1).innerHTML = "<span class='lead'><span class='badge badge-pill badge-primary'>"+prd_name+"</span></span>";
                row.insertCell(2).innerHTML = prd_price;
                row.insertCell(3).innerHTML = parseFloat(crates_amount);
                row.insertCell(4).innerHTML = parseFloat(loose_amount);
                row.insertCell(5).innerHTML = parseFloat(temp_discount).toFixed(2);
                row.insertCell(6).innerHTML = "<label hidden>" +sub_total_deposit.toFixed(2)+ "</label>";
                row.insertCell(7).innerHTML = sub_total.toFixed(2);
                row.insertCell(8).innerHTML = "<label hidden>" +in_crate_val+ "</label>";
                row.insertCell(9).innerHTML = "<label hidden>" +in_loose_val+ "</label>";
                row.insertCell(10).innerHTML = "<label hidden>" +prd_id_in+ "</label>";
                row.insertCell(11).innerHTML = "<label hidden>" +can_type_in+ "</label>";
                row.insertCell(12).innerHTML = "<a href='javascript:void()' onclick='removeFromCart(" +row_id+ "," +sub_total_deposit+ "," +(sub_total + sub_total_deposit)+ "," +in_crate_val+ "," +in_loose_val+ ")'><i class='fa fa-trash text-warning'></i></a>";

            }

            var received = document.getElementById("received_amount").value;

            document.getElementById("rct_gross_total").innerHTML = gross_total.toFixed(2);
            document.getElementById("rct_discount").innerHTML = parseFloat(total_discount).toFixed(2);
            document.getElementById("rct_amount_payable").innerHTML = document.getElementById("amount_payable").value;
            document.getElementById("rct_amount_paid").innerHTML = received;
            document.getElementById("lbl_total_deposit").innerHTML = total_deposit.toFixed(2);
            document.getElementById("lbl_total").innerHTML = total.toFixed(2);
            modal.hidden = true;
            
            alert(prd_quantity+ " " +prd_name+ " has been added to cart");
            checkCart();
        }
        else{
            alert("Please input quantity");
        }
    }

    function removeFromCart(row, sub_total_deposit, sub_total, crate, loose) {

        var deleteRowIn = document.getElementById("row_in" + row);
        var deleteRow = document.getElementById("row" + row);

        if (deleteRow && deleteRowIn) { // add error handling to check for null or undefined variables
            
            //IN
            var total_crate = document.getElementById("lbl_total_crates").innerHTML; 
            var total_loose = document.getElementById("lbl_total_loose").innerHTML; 
            total_crate = parseFloat(total_crate) - crate;
            total_loose = parseFloat(total_loose) - loose;

            document.getElementById("lbl_total_crates").innerHTML = total_crate;
            document.getElementById("lbl_total_loose").innerHTML = total_loose;
            document.getElementById("lbl_obtain_crates").innerHTML = obtained_total_crates;
            document.getElementById("lbl_obtain_loose").innerHTML = obtained_total_loose;

            var parentElement1 = document.getElementById("tbl-prd-in");
            parentElement1.removeChild(deleteRowIn);
            
            //CART
            var get_total_deposit = document.getElementById("lbl_total_deposit").innerHTML;
            var total_deposit = parseFloat(get_total_deposit) - sub_total_deposit;

            var total = document.getElementById("lbl_total").innerHTML;
            total = parseFloat(total) - sub_total;

            document.getElementById("lbl_total_deposit").innerHTML = total_deposit.toFixed(2);
            document.getElementById("lbl_total").innerHTML = total.toFixed(2);
            document.getElementById("amount_payable").value = total.toFixed(2);

            var parentElement2 = document.getElementById("tbl-cart");
            parentElement2.removeChild(deleteRow);

        } else {
            
            //CART
            var total = document.getElementById("lbl_total").innerHTML;
            total = parseFloat(total) - sub_total;

            document.getElementById("lbl_total").innerHTML = total.toFixed(2);
            document.getElementById("amount_payable").value = total.toFixed(2);

            var parentElement2 = document.getElementById("tbl-cart");
            parentElement2.removeChild(deleteRow);
            
        }
    }

   function receivePayment(){

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
        var item_price = "";
        var item_tot = "";
        var gross_total = 0;

        for(let i=0; i <= (cart_item.length)-1; i++){
            let row_text = cart_item[i];
            const row_item = row_text.split(",");

            var rct_row = rct_table.insertRow(0);

            for(let j=0; j < row_item.length; j++){
                //For Populating Receipt Table 
                var prd_quantity = parseInt((row_item[3] * 12) + parseInt(row_item[4]));
                
                item_qty = prd_quantity;
                item_des = row_item[1];
                item_price = row_item[2];
                item_tot = row_item[7];
            }

            try{
                rct_row.insertCell(0).innerHTML = item_qty;
                rct_row.insertCell(1).innerHTML = item_des;
                rct_row.insertCell(2).innerHTML = item_price;
                rct_row.insertCell(3).innerHTML = item_tot;
                
                gross_total = gross_total + (parseFloat(row_item[2]) * prd_quantity);

                document.getElementById("trx_gross").value = gross_total;
                document.getElementById("rct_gross_total").innerHTML = gross_total.toFixed(2);
                document.getElementById("rct_deposit").innerHTML = document.getElementById("lbl_total_deposit").innerHTML;
            }
            catch(e){
                alert("Please select products first");
            }
        }

   }

   function enterPayable(){
        // alert("test");
        //Change AMOUNT PAID and CHANGE in Modal when KeyPressed on amount_payable input
        var amount = document.getElementById("amount_payable").value;
        var received = parseFloat(document.getElementById("received_amount").value);
        var change = document.getElementById("rct_change").value;
        var balance = document.getElementById("rct_balance").value;
        document.getElementById("rct_amount_paid").innerHTML = received.toFixed(2);


        if(amount = ""){
            amount = 0;
        }
        else{
            amount = parseFloat(document.getElementById("amount_payable").value);
        }

        var final_change = received - amount;
        var final_balance = amount - received;

        if(final_balance < 0){
            final_balance = 0;
        }

        if(final_change <= 0){
            final_change = 0;
        }

        document.getElementById("rct_change").innerHTML = final_change.toFixed(2);
        document.getElementById("rct_balance").innerHTML = final_balance.toFixed(2);
    }

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

    function selectUserFirst(){
        var client_id =  document.getElementById("client_id").value;

        if(client_id == 0){
            alert("Select customer first");
        }
        else{
            $("#order-modal").modal('show');
        }
    }

    function checkCart(){
        var table = document.getElementById("tbl-cart");
        var rowCount = table.rows.length;

        if(rowCount < 1){
            document.getElementById("btn_rcv_pay").disabled = true;
        }
        else{
            document.getElementById("btn_rcv_pay").disabled = false;
        }
    }

    function noCredit(){
        var total = parseFloat(document.getElementById("amount_payable").value);
        var payment = parseFloat(document.getElementById("received_amount").value);
        var mode_of_payment = document.getElementById("mode_of_payment").value;
        var trx_can_dec = document.getElementById("trx_can_dec").value;
        var trx_del_rec = document.getElementById("trx_del_rec").value;
        var pmnt_check_no = document.getElementById("pmnt_check_no").value;

        if(mode_of_payment == 1){
            if(payment == "" || total > payment){
            alert("Insufficient Payment");
            }
            else{
                if(trx_can_dec == "" || trx_del_rec == ""){
                alert("Canister Declaration and Delivery Receipt is required");
                }
                else{
                    document.getElementById("btn_pay").disabled = true; 
                    document.getElementById("btn_pay").innerHTML = 'Saving...'; 
                    document.getElementById("form_payment").submit(); 
                }
            }
        }
        else{
            if(mode_of_payment != 2 && payment <= 0){
                alert("Invalid Payment");
            }
            else{
                if(mode_of_payment == 4 && pmnt_check_no == ""){
                    alert("Input Check Number");
                }
                else{
                    if(trx_can_dec == "" || trx_del_rec == ""){
                        alert("Canister Declaration and Delivery Receipt is required");
                    }
                    else{
                        document.getElementById("btn_pay").disabled = true; 
                        document.getElementById("btn_pay").innerHTML = 'Saving...'; 
                        document.getElementById("form_payment").submit(); 
                    }
                }
            }
        }
        
    }

    document.getElementById("client_id").addEventListener("change", function() 
    {
        document.getElementById("cus_form").submit(); 
    });


    $("#btn_bad_order").on("click", function() {
        $("#bad-order-modal").find("#customer").hide();
        $("#bad-order-modal").find("#products").hide();
        $("#bad-order-modal").find("#lbl-crate").hide();
        $("#bad-order-modal").find("#lbl-loose").hide();
        $("#bad-order-modal").find("#quantity").hide();
        $("#bad-order-modal").find("#crate-quantity").hide();
    });

    function verifyTransaction(){
        var trx_ref_id = document.getElementById("trx_ref_id").value;
        var verified = false;

        @foreach($transactions as $transaction)
            if(trx_ref_id == "{{ $transaction->trx_ref_id }}"){
                verified = true;
                $("#cus_name").val("{{ $transaction->cus_name }}");

                $("#bad-order-modal").find("#customer").show();
                $("#bad-order-modal").find("#products").show();
                $("#bad-order-modal").find("#lbl-crate").show();
                $("#bad-order-modal").find("#lbl-loose").show();
                $("#bad-order-modal").find("#quantity").show();
                $("#bad-order-modal").find("#crate-quantity").show();

                $("#pur_products").empty();
                @foreach($purchased_products as $purchased_product)
                    @if($purchased_product->trx_id == $transaction->trx_id)
                        $("#pur_products").append("<option value='{{ $purchased_product->prd_id }}'>{{ $purchased_product->prd_name }}</option>");
                    @endif
                @endforeach
            }
        @endforeach

        if(!verified){
            if(trx_ref_id == ""){
                alert("Input required field");
            }
            else{
                alert("No transactions referenced to this code");
            }
            
            $("#bad-order-modal").find("#customer").hide();
            $("#bad-order-modal").find("#products").hide();
            $("#bad-order-modal").find("#lbl-crate").hide();
            $("#bad-order-modal").find("#lbl-loose").hide();
            $("#bad-order-modal").find("#quantity").hide();
            $("#bad-order-modal").find("#crate-quantity").hide();
        }
    }
    
</script>

@endsection
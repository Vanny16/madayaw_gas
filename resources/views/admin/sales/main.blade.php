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
                            <h3 class="card-title"><i class="fas fa-cash-register"></i> Transaction</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                
                                <div class="col-md-9 order-lg-1 order-2">
                                    <label>Customer Name</label>

                                    <select class="form-control col-md-7 col-12" id="client_id" name="client_id" required="">
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
                                    <button type="button" class="btn btn-default form-control col-md-4 col-12 mt-3" data-toggle="modal" data-target="#customer-modal"><i class="fa fa-user-plus"></i> New Customer</button>
                                </div>
                                <div class="col-md-3 text-right text-gray order-lg-2 order-1 mb-3">
                                    <small>
                                        <i id="current-date-now"><?php echo date(" F d, Y"); ?> </i>
                                        <i id="current-time-now" class="text-info ml-1" data-start="<?php echo time(); ?>"></i>
                                    </small>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-12 mb-3">
                        <button type="button" class="btn btn-default text-success form-control" data-toggle="modal" data-target="#order-modal"><i class="fa fa-plus-circle"></i> Select Products</button>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-shopping-cart"></i> Selected Products</h3>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <div class="row">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Discount</th>
                                            <th>Subtotal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl-cart">
                                        <tr class="bg-light" height="1px">
                                            <td colspan="6"></td>
                                        </tr>
                                        <tr class="text-success bg-white">
                                            <td colspan="3"></td>
                                            <td class="text-success"><strong>Total</strong></td>
                                            <td class="text-success"><strong id="lbl_total" class="fa fa-3x">0.00</strong></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-2 col-12 mb-3">
                            <button type="button" class="btn btn-success form-control" data-toggle="modal" data-target="#payment-modal"><i class="fa fa-wallet"></i> Receive Payment</button>
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


<!-- Customer Modal -->
<div class="modal fade" id="customer-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Customer Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ action('SalesController@createCustomer')}}" enctype="multipart/form-data">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 text-center">
                                <img class="img-circle elevation-2" src="{{ asset('img/customers/default.png') }}" alt="Add Picture" style="max-height:150px; max-width:150px; min-height:150px; min-width:150px; object-fit:cover;"/>
                            <div class="col-12 text-center mb-4">
                            <a href="javascript:void(0);" class="">
                                <label class="btn btn-transparent btn-file">
                                    <i id="btn_choose_file" class="fa fa-solid fa-camera mr-2"></i><small>Upload Photo</small>
                                    <input type="file" class="custom-file-input" id="choose_file" name='cus_image' value="{{ old('cus_image') }}" aria-describedby="inputGroupFileAddon01" style="display: none;">
                                </label>
                            </a>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="cus_name">Full Name <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="cus_name" placeholder="Enter Full Name" value="" required/>
                            </div>

                            <div class="form-group">
                                <label for="cus_address">Address <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="cus_address" placeholder="Enter Address" value="" required/>
                            </div>

                            <div class="form-group">
                                <label for="cus_address">Contact # <span style="color:red">*</span></label>
                                <input type="text" name="cus_contact" class="form-control" placeholder="Enter Contact #" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" minlength="11" maxlength="11" required></input>
                            </div>

                            <div class="form-group">
                                <label for="cus_notes">Notes</label>
                                <textarea name="cus_notes" placeholder="Additional notes ..." class="form-control"></textarea>
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

<!-- Order Modal -->
<div class="modal fade" id="order-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-sm fa-shopping-cart"></i> Select Products</h5>
            </div>
            <div class="col-12 mt-2"> 
                <small><i class="fa fa-sm fa-search ml-2"></i> Search Product</small>
                <input id="search_products" type="text" class="form-control col-md-12 col-12 mt-2 bg-light" name="search_string" placeholder="Search ..."/>
            </div>
            <form method="POST" action="{{ action('CustomerController@createCustomer')}}" enctype="multipart/form-data">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="col-12" style="height:350px; overflow-x:auto;">
                        <div class="row">
                            @if(isset($products))
                                @foreach($products as $product)
                                <div class="col bg-image hover-zoom" data-toggle="modal" data-target="#order_details_modal{{$product->prd_id}}"  >
                                    <div class="card">
                                        <img class="img-fluid" src="{{ asset('img/products/default.png') }}" style="max-height:50px; max-width:180px; min-height:150px; min-width:150px;">
                                        <div class="container">
                                            <b>{{$product->prd_name}}</b>
                                            <p>PHP 100.00</p>
                                            <p>100/pcs</p>
                                        </div>    
                                    </div>
                                </div>
                                <!-- Order Details Modal -->
                                <div class="modal fade" id="order_details_modal{{$product->prd_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-sm fa-info-circle"></i> Order Details</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="cus_name">Product <span style="color:red">*</span></label>
                                                            <input type="text" class="form-control" id="prd_name{{$product->prd_id}}" value="{{$product->prd_name}}" required readonly/>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label for="cus_address">Price <span style="color:red">*</span></label>
                                                            <input type="number" class="form-control" id="prd_price{{$product->prd_id}}" value="{{$product->prd_price}}" onkeyup="getTotal(prd_price{{$product->prd_id}}.id, prd_quantity{{$product->prd_id}}.id, temp_discount{{$product->prd_id}}.id, sub_total{{$product->prd_id}}.id)" onkeypress="return isNumberKey(this, event);" onclick="this.select()" required></input>
                                                        </div>
                                                        
                                                        {{--<div class="form-group">
                                                            <label for="cus_address">Quantity <span style="color:red">*</span></label>
                                                            <input type="number" class="form-control" id="prd_quantity{{$product->prd_id}}" value="1" min="1" max="{{$product->prd_quantity}}" onkeyup="getTotal(prd_price{{$product->prd_id}}.id, prd_quantity{{$product->prd_id}}.id, temp_discount{{$product->prd_id}}.id, sub_total{{$product->prd_id}}.id)" onkeypress="return isNumberKey(this, event);" onclick="this.select()" required></input>
                                                        </div>--}}

                                                        <div class="form-group">
                                                            <label for="cus_address">Quantity <span style="color:red">*</span></label>
                                                            <input type="number" class="form-control" id="prd_quantity{{$product->prd_id}}" value="1" min="1" max="{{$product->prd_quantity}}" onkeyup="getTotal(prd_price{{$product->prd_id}}.id, prd_quantity{{$product->prd_id}}.id, temp_discount{{$product->prd_id}}.id, sub_total{{$product->prd_id}}.id)" onkeypress="return isNumberKey(this, event);" onclick="this.select()" required></input>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="cus_address">Discount (Amount in Peso) <span style="color:red">*</span></label>
                                                            <input type="number" class="form-control" id="temp_discount{{$product->prd_id}}" value="0.00" onkeyup="getTotal(prd_price{{$product->prd_id}}.id, prd_quantity{{$product->prd_id}}.id, temp_discount{{$product->prd_id}}.id, sub_total{{$product->prd_id}}.id)" onkeypress="return isNumberKey(this, event);" onclick="this.select()" required></input>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label for="cus_address">Total Amount <span style="color:red">*</span></label>
                                                            <input type="text" class="form-control" id="sub_total{{$product->prd_id}}" value="{{$product->prd_price}}" onkeypress="return isNumberKey(this, event);" readonly></input>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#order_details_modal{{$product->prd_id}}">Cancel</button>
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#order_details_modal{{$product->prd_id}}" onclick="addToCart({{$product->prd_id}},prd_name{{$product->prd_id}}.value, prd_price{{$product->prd_id}}.value, prd_quantity{{$product->prd_id}}.value, temp_discount{{$product->prd_id}}.value, order_details_modal{{$product->prd_id}}.id)"><i class="fa fa-plus-circle"></i> Add</button>
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
                                <input type="text" id="amount_payable" name="amount_payable" class="form-control" value="0.00" readonly></input>
                            </div>
                            <div class="form-group">
                                <label for="cus_address">Received Amount <span style="color:red">*</span></label>
                                <input type="text" id="received_amount" name="amount_amount" class="form-control" placeholder="Enter Amount" onkeypress="return isNumberKey(this, event)" onkeyup="enterPayable();" required></input>
                                <input type="hidden" id="receipt_list" name="receipt_list[]" class="form-control" value=""></input>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-money-bill mr-1"> </i>Pay</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
                                <tr class="">
                                    <td>1</td>
                                    <td>Botin</td>
                                    <td>500.00</td>
                                </tr>
                                <tr class="card-header">
                                    <td>1</td>
                                    <td>Botin</td>
                                    <td>100.00</td>
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

    function getTotal(prd_price_id, prd_quantity_id, temp_discount_id, txt_sub_total){
        var prd_price = document.getElementById(prd_price_id).value;
        var prd_quantity = document.getElementById(prd_quantity_id).value;
        var temp_discount = document.getElementById(temp_discount_id).value;
        var sub_total = (prd_price * prd_quantity) - temp_discount;

        if(prd_price == "" || prd_price < 1){
            document.getElementById(prd_price_id).value = "0.00";
            document.getElementById(temp_discount_id).value = "0.00";
            sub_total = 0;
        }
        if(prd_quantity == "" || prd_quantity < 1){
            alert("Quantity cannot be zero");
            document.getElementById(prd_quantity_id).value = "1";
        }

        document.getElementById(txt_sub_total).value = sub_total.toFixed(2);
    }

    //Initialize Array for Sales Report in Add to Cart Function
    var total_discount = parseFloat(0);
    var count = 0;
    var list = new Array();
    var details = new Array();

    function addToCart(prd_id, prd_name, prd_price, prd_quantity, temp_discount, modal) {
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
                prd_price = parseFloat(prd_price).toFixed(2)
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
            var row_count = (table.rows.length) - 2;
            var row = table.insertRow(0);
            row.id = "row"+row_count;
            row.insertCell(0).innerHTML = prd_name;
            row.insertCell(1).innerHTML = prd_price;
            row.insertCell(2).innerHTML = parseFloat(prd_quantity).toFixed(1);
            row.insertCell(3).innerHTML = parseFloat(temp_discount).toFixed(2);
            row.insertCell(4).innerHTML = sub_total.toFixed(2);
            row.insertCell(5).innerHTML = "<a href='javascript:void()' onclick='removeFromCart(" +row.id+ "," +sub_total+ ")'><i class='fa fa-trash text-warning'></i></a>";
            
            list[count] = new Array(client_id, prd_id, prd_name, prd_price, prd_quantity, temp_discount, sub_total);
            count = count + 1;

            //For Populating Receipt Table 
            var received = document.getElementById("received_amount").value;
            var rct_table = document.getElementById("tbl-rct");
            var rct_row_count = (table.rows.length) - 2;
            var rct_row = rct_table.insertRow(0);
            rct_row.id = "rct_row"+rct_row_count;
            rct_row.insertCell(0).innerHTML = prd_quantity;
            rct_row.insertCell(1).innerHTML = prd_name;
            rct_row.insertCell(2).innerHTML = prd_price;
            
            document.getElementById("rct_gross_total").innerHTML = gross_total.toFixed(2);
            document.getElementById("rct_discount").innerHTML = parseFloat(temp_discount).toFixed(2);
            document.getElementById("rct_amount_payable").innerHTML = sub_total.toFixed(2);
            document.getElementById("rct_amount_paid").innerHTML = received;
            document.getElementById("receipt_list").value = list;
            document.getElementById("lbl_total").innerHTML = total.toFixed(2);
            modal.hidden = true;
            
            alert(prd_quantity+ " " +prd_name+ " has been added to cart");
            // session()->flash('successMessage','Transaction complete!');
        }
        else{
            alert("Please input quantity");
        }
        
    }

    function enterPayable(){
        // alert("test");
        //Change AMOUNT PAID and CHANGE in Modal when KeyPressed on amount_payable input
        var amount = parseFloat(document.getElementById("amount_payable").value);
        var received = parseFloat(document.getElementById("received_amount").value);
        var change = document.getElementById("rct_change").value;
        document.getElementById("rct_amount_paid").innerHTML = received.toFixed(2);

        var final_change = amount - received;
        document.getElementById("rct_change").innerHTML = final_change.toFixed(2);
    }

    function removeFromCart(row, sub_total) {
        var total = document.getElementById("lbl_total").innerHTML; 
        total = parseFloat(total) - sub_total;
        
        document.getElementById("lbl_total").innerHTML = total.toFixed(2);
        document.getElementById("amount_payable").value = total.toFixed(2);
        // document.getElementById("tbl-cart").deleteRow(row.id);

        var deleteRow = document.getElementById(row.id);
	    row.parentElement.removeChild(deleteRow); 
    }

    $(document).ready(function(){
        $("#receipt-modal").modal('hide');
    });

    
</script>

@endsection
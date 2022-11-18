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

                                    <select class="form-control col-md-7 col-12" name="client_id" required="">
                                        <option value="-1">-NOT SPECIFIED-</option>
                                        <option value="0">-WALK IN-</option>
                                        <option value="97">Abiera Analou Dagpin </option>
                                        <option value="121">Abrio Ivy </option>
                                        <option value="98">Patnalag Nepenthe </option>     
                                        <option value="98">Ztnalag Nepenthe </option>                       
                                    </select>

                                    <button type="button" class="btn btn-default form-control col-md-2 col-12 mt-3" data-toggle="modal" data-target="#customer-modal"><i class="fa fa-user-plus"></i> New Client</button>
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

                    <div class="col-12 mb-3">
                        <button type="button" class="btn btn-info form-control col-md-2 col-12" data-toggle="modal" data-target="#order-modal"><i class="fa fa-plus-circle"></i> Select Products</button>
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
                                            <th>Subtotal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl-cart">
                                        <tr class="bg-gray">
                                            <td colspan="5"></td>
                                        </tr>
                                        <tr class="text-info">
                                            <td></td>
                                            <td></td>
                                            <td><strong>Total</strong></td>
                                            <td><strong id="lbl_total" class="fa fa-3x">0.00</strong></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 mb-3">
                        <button type="button" class="btn btn-success form-control col-md-2 col-12" data-toggle="modal" data-target="#supplier-modal"><i class="fa fa-money-bill-wave"></i> Receive Payment</button>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-shopping-cart"></i> Transaction Summary</h3>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <div class="row">
                                <table class="table table-sm table-borderless text-left">
                                    <tbody>
                                        <tr>
                                            <td>Gross Total</td>
                                            <td>200.00</td>
                                        </tr>
                                        <tr>
                                            <td>Discount</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Amount Payable</td>
                                            <td>200.00</td>
                                        </tr>
                                        <tr>
                                            <td>Amount Paid</td>
                                            <td>200.00</td>
                                        </tr>
                                        <tr>
                                            <td>Balance</td>
                                            <td>0.00</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="col-12 mb-3">
                                    <a class="btn btn-info form-control col-md-1 col-12" href="{{ action('PrintController@allsaleDetails') }}" target="_BLANK"><i class="fa fa-print"></i> Print</a></button>
                                    <button type="button" class="btn btn-default form-control col-md-2 col-12" data-toggle="modal" data-target="#supplier-modal"><i class="fa fa-ban"></i> Void Transaction</button>
                                </div>
                            </div>
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
            <form method="POST" action="{{ action('CustomerController@createCustomer')}}" enctype="multipart/form-data">
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
                    <div class="row">
                        <div class="col-12" style="height:350px; overflow-x:auto;">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Stocks</th>
                                        <th width="70px"></th>
                                    </tr>
                                </thead>
                                <tbody id="tbl-products">
                                    @if(isset($products))
                                        @foreach($products as $product)
                                        <tr>
                                            @if($product->prd_name)
                                                <td>   
                                                    {{$product->prd_name}}
                                                </td>
                                            @else
                                                <td>-</td>
                                            @endif
                                            @if($product->prd_price)
                                                <td>   
                                                {{$product->prd_price}}
                                                </td>
                                            @else
                                                <td>-</td>
                                            @endif
                                            @if($product->prd_quantity)
                                                <td>   
                                                {{$product->prd_quantity}}
                                                </td>
                                            @else
                                                <td>-</td>
                                            @endif
                                            <td><button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#order_details_modal{{$product->prd_id}}"><i class="fa fa-plus"></i></button></td>
                                
                                            <!-- Order Details Modal -->
                                            <div class="modal fade" id="order_details_modal{{$product->prd_id}}" id="order_details_modal{{$product->prd_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-sm fa-info-circle"></i> Order Details</h5>
                                                        </div>
                                                        <!-- <form method="POST" action="" enctype="multipart/form-data">
                                                        {{ csrf_field() }}  -->
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="cus_name">Product <span style="color:red">*</span></label>
                                                                            <input type="text" class="form-control" id="prd_name{{$product->prd_id}}" value="{{$product->prd_name}}" required readonly/>
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <label for="cus_address">Price <span style="color:red">*</span></label>
                                                                            <input type="number" class="form-control" id="prd_price{{$product->prd_id}}" value="{{$product->prd_price}}" onkeyup="getTotal(prd_price{{$product->prd_id}}.value, prd_quantity{{$product->prd_id}}.value, temp_discount{{$product->prd_id}}.value, sub_total{{$product->prd_id}}.id)" onkeypress="return isNumberKey(this, event);" required></input>
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <label for="cus_address">Quantity <span style="color:red">*</span></label>
                                                                            <input type="number" class="form-control" id="prd_quantity{{$product->prd_id}}" value="1" min="1" max="{{$product->prd_quantity}}" onkeyup="getTotal(prd_price{{$product->prd_id}}.value, prd_quantity{{$product->prd_id}}.value, temp_discount{{$product->prd_id}}.value, sub_total{{$product->prd_id}}.id)" onkeypress="return isNumberKey(this, event);" required></input>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="cus_address">Discount <span style="color:red">*</span></label>
                                                                            <input type="number" class="form-control" id="temp_discount" value="0.00" onkeyup="getTotal(prd_price{{$product->prd_id}}.value, prd_quantity{{$product->prd_id}}.value, temp_discount{{$product->prd_id}}.value, sub_total{{$product->prd_id}}.id)" onkeypress="return isNumberKey(this, event);"></input>
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
                                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#order_details_modal{{$product->prd_id}}" onclick="addToCart(prd_name{{$product->prd_id}}.value, prd_price{{$product->prd_id}}.value, prd_quantity{{$product->prd_id}}.value, order_details_modal{{$product->prd_id}}.id)"><i class="fa fa-plus-circle"></i> Add</button>
                                                            </div>
                                                        <!-- </form> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Done</button>
                </div>
            </form>
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

    
    // $(document).ready(function(){
    //     $("#prd_price").on("keyup", function() {
    //         $("#prd_total") = $(this) * $("#prd_quantity");
    //     });
    // });

    function getTotal(prd_price, prd_quantity, temp_discount, txt_sub_total){
        alert(temp_discount);
        var sub_total = (prd_price * prd_quantity) - temp_discount;

        document.getElementById(txt_sub_total).value = sub_total.toFixed(2);
    }

    function addToCart(prd_name, prd_price, prd_quantity, modal) {

        var subtotal = prd_price * prd_quantity;
        var total = total + subtotal;

        var table = document.getElementById("tbl-cart");
        var row = table.insertRow(0);
        row.insertCell(0).innerHTML = prd_name;
        row.insertCell(1).innerHTML = prd_price;
        row.insertCell(2).innerHTML = prd_quantity;
        row.insertCell(3).innerHTML = subtotal.toFixed(2);
        row.insertCell(4).innerHTML = "<a href='javascript:void()'><i class='fa fa-trash text-warning'></i></a>";
        
        document.getElementById("lbl_total").innerHTML = total.toFixed(2);
        modal.hidden = true;
    }

    function removeFromCart() {
        document.getElementById("tbl-cart").deleteRow(0);
    } 

    
</script>

@endsection
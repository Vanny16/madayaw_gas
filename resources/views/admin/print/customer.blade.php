@extends('layouts.themes.admin.print')
@section('content')
<div class="row">
    <div class="col-md-12"> 
        <h3 style="text-align:center;"></h3>
        <p style="text-align:center;"></p>
    </div>
    <div class="col-md-12"> 
        <div class="card">
            <div class="card-header">  
                <div class="row">
                    <h3 class="card-title"><i class="fas fa-male"></i><i class="fas fa-female"></i> Customer Records</h3>
                    <div class="col-md-12 text-right text-gray order-lg-2 order-1 mb-3">
                        <small>
                            <i id="current-date-now"><?php echo date(" F d, Y"); ?> </i>
                            <i id="current-time-now" class="text-info ml-1" data-start="<?php echo time(); ?>"></i>
                        </small>
                    </div>
                </div>
            </div>
        </div>
            <div class="card-body">
                <table class="table table-hover table-condensed">

                @if(isset($all_customer_details))
                    <thead>
                        <tr>
                            <th width="500px">Customer Name</th>
                            <th>Contact #</th>
                            <th width="500px">Address</th>
                            <th width="500px">Accessible Products</th>
                            <th>Status</th>
                            <th width="20px"></th>
                        </tr>
                        <tr>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_customer_details as $all_customer_detail)
                        <tr>
                            <td>{{$all_customer_detail->cus_name}}</td>
                            <td>{{$all_customer_detail->cus_contact}}</td>
                            <td>{{$all_customer_detail->cus_address}}</td>
                            @if($all_customer_detail->cus_accessibles)
                                <td>
                                <?php
                                    $accessibles = explode(",",$all_customer_detail->cus_accessibles);
                                    if(end($accessibles) == " " || end($accessibles) == ""){array_pop($accessibles);}

                                    $accessibles_prices = explode(",",$all_customer_detail->cus_accessibles_prices);
                                    if(end($accessibles_prices) == " " || end($accessibles_prices) == ""){}
                                    $check_indicator = "";
                                    $displayed_price = "";
                                    ?>

                                    <div class="col-md-12">
                                        @if(is_array($products) || is_object($products))
                                            @foreach($products as $product)
                                                @if($product ->prd_is_refillable == 1)
                                                    <div class="col-6 required-checkbox">    
                                                        @if(count($accessibles) < 1)
                                                            <input type="checkbox" id="product{{$product->prd_id}}" name="cus_accessibles[{{ $product->prd_id }}][prd_id]" value="{{$product->prd_id}}">
                                                            <label for="">{{$product->prd_name}}</label>
                                                            <input type="number" class="form-control" id="price{{$product->prd_id}}" name="cus_accessibles[{{ $product->prd_id }}][price]" min="1" step="0.01" value="{{$product->prd_price}}">
                                                        @else
                                                        @php($counter = 0)
                                                        @foreach($accessibles as $key => $accessible)
                                                            @php($check_indicator = "")
                                                            @php($displayed_price = "")
                                                            @if($product->prd_id == $accessible)
                                                                @php($check_indicator = "checked")
                                                                @if(array_key_exists($key, $accessibles_prices))
                                                                    @php($displayed_price = $accessibles_prices[$key])
                                                                @else
                                                                    @php($displayed_price = $product->prd_price)
                                                                @endif
                                                                @php($counter++)
                                                                @break
                                                            @else
                                                                @php($displayed_price = $product->prd_price)
                                                            @endif
                                                        @endforeach
                                                            <small>{{$product->prd_name}}</small>
                                                            <small>-</small>
                                                            <small><?php echo($displayed_price)?></small>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </td>
                            @endif
                            @if($all_customer_detail->cus_active == 0)
                                <td>
                                    <span class="badge badge-danger">Inactive</span>
                                </td>
                            @else
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                            @endif
                        </tr> 
                        @endforeach
                    </tbody>

                @elseif(isset($customer_details))
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Contact #</th>
                            <th>Address</th>
                            <th>Accessible Products</th>
                            <th>Status</th>
                            <th width="20px"></th>
                        </tr>
                        <tr>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customer_details as $customer_detail)
                        <tr>
                            <td>{{$customer_detail->cus_name}}</td>
                            <td>{{$customer_detail->cus_contact}}</td>
                            <td>{{$customer_detail->cus_address}}</td>
                            @if($customer_detail->cus_accessibles)
                                <td>
                                    <?php
                                    $accessibles = explode(",",$customer_detail->cus_accessibles);
                                    if(end($accessibles) == " " || end($accessibles) == ""){array_pop($accessibles);}

                                    $accessibles_prices = explode(",",$customer_detail->cus_accessibles_prices);
                                    if(end($accessibles_prices) == " " || end($accessibles_prices) == ""){}
                                    $check_indicator = "";
                                    $displayed_price = "";
                                    ?>

                                    <div class="col-md-12">
                                        @if(is_array($products) || is_object($products))
                                            @foreach($products as $product)
                                                @if($product ->prd_is_refillable == 1)
                                                    <div class="col-6 required-checkbox">    
                                                        @if(count($accessibles) < 1)
                                                            <input type="checkbox" id="product{{$product->prd_id}}" name="cus_accessibles[{{ $product->prd_id }}][prd_id]" value="{{$product->prd_id}}">
                                                            <label for="">{{$product->prd_name}}</label>
                                                            <input type="number" class="form-control" id="price{{$product->prd_id}}" name="cus_accessibles[{{ $product->prd_id }}][price]" min="1" step="0.01" value="{{$product->prd_price}}">
                                                        @else
                                                        @php($counter = 0)
                                                        @foreach($accessibles as $key => $accessible)
                                                            @php($check_indicator = "")
                                                            @php($displayed_price = "")
                                                            @if($product->prd_id == $accessible)
                                                                @php($check_indicator = "checked")
                                                                @if(array_key_exists($key, $accessibles_prices))
                                                                    @php($displayed_price = $accessibles_prices[$key])
                                                                @else
                                                                    @php($displayed_price = $product->prd_price)
                                                                @endif
                                                                @php($counter++)
                                                                @break
                                                            @else
                                                                @php($displayed_price = $product->prd_price)
                                                            @endif
                                                        @endforeach
                                                            <small>{{$product->prd_name}}</small>
                                                            <small>-</small>
                                                            <small><?php echo($displayed_price)?></small>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </td>
                            @endif
                            @if($customer_detail->cus_active == 0)
                                <td>
                                    <span class="badge badge-danger">Inactive</span>
                                </td>
                            @else
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                            @endif
                        </tr> 
                        @endforeach
                    </tbody>
                @endif
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"> 
    window.addEventListener("load", window.print());
</script>
@endsection
@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Customers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Manage Customers</li>
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
                            <h3 class="card-title"><i class="fas fa-search"></i> Find Customer</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="{{ action('CustomerController@searchCustomer') }}">
                            {{ csrf_field() }} 
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="search_string">Find Customer</label>
                                            @if(isset($search_string))
                                                <input id="search_customers" type="text" class="form-control" name="search_string" placeholder="Search ..." value="{{ $search_string }}"/>
                                            @else
                                                <input id="search_customers" type="text" class="form-control" name="search_string" placeholder="Search ..."/>
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            <label for="filter_status">Status</label>
                                            <select class="form-control" id="filter_status" name="filter_status" required>
                                                @foreach($statuses as $status)
                                                    @if($status == $default_status)
                                                        <option value="{{ $status }}" selected>{{ $status }}</option>
                                                    @else
                                                        <option value="{{ $status }}">{{ $status }}</option>
                                                    @endif
                                                @endforeach   
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12 mt-2">
                                            <button type="submit" class="btn btn-success col-md-3 col-12"><span class="fa fa-search"></span> Find</button> 
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                @if(session('typ_id') == '1' || session('typ_id') == '2') 
                    <a class="btn btn-primary col-md-2 col-12 mb-1" href="javascript:void(0)" data-toggle="modal" data-target="#customer-modal"><i class="fa fa-user-plus"></i> New Customer</a>
                @endif
                    <a class="btn btn-info col-md-1 col-12 float-right" href="{{ action('PrintController@allcustomerDetails') }}" target="_BLANK"><i class="fa fa-print"></i> Print</a>
                </div>

                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-male"></i><i class="fas fa-female"></i> Customers</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <div id="cus-toolbar" class="border bg-light" hidden>
                            <div class="row ml-2 mt-2 mb-2">
                                <form action="" class="col-md-12 form-inline">
                                    <div class="col-md-1">
                                        <a href="javascript:void(0)" id="adjust-pricing" class="text-danger" data-toggle="modal" data-target="#pricing-modal" onclick="changePricing()"><i class="fa fa-money fa-sm"></i> Adjust Pricing</a>
                                    </div>

                                    {{--<div class="col-md-2">
                                        <a href="javascript:void(0)" class="text-gray"><i class="fa fa-undo fa-sm"></i> Remove Discount</a>
                                    </div>--}}
                                </form>
                            </div>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="20px">
                                            <input type="checkbox" id="customer-select-all"></th>
                                        <th width="50px"></th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Contact #</th>
                                        <th>Accessible Products</th>
                                        <th width="100px">Status</th>
                                        <th></th>
                                        @if(session('typ_id') == '1' || session('typ_id') == '2') 
                                        <th></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody id="tbl-customers">
                                    @if(isset($customers))
                                        @foreach($customers as $customer)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="customer-select" id="customer-select" name="customer-select[]" value="{{$customer->cus_id}}">
                                                </td>
                                                <td>
                                                @if($customer->cus_image <> '')
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#img-customer-modal-{{$customer->cus_id}}"><img class="img-fluid img-circle elevation-2" src="{{ asset('img/customers/' . $customer->cus_image) }}" alt="{{ $customer->cus_image }}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                @else</a>
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#img-customer-modal-{{$customer->cus_id}}"><img class="profile-user-img img-fluid img-circle" src="{{ asset('img/customers/default.png') }}" alt="{{ $customer->cus_image }}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                @endif    
                                                </td>
                                                <td>   
                                                    {{ $customer->cus_name }}
                                                </td>
                                                @if($customer->cus_address)
                                                <td>
                                                    {{ $customer->cus_address }}
                                                </td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                                @if($customer->cus_contact)
                                                    <td>
                                                        {{ $customer->cus_contact }}
                                                    </td>
                                                @else
                                                    <td>-</td>
                                                @endif

                                                @if($customer->cus_accessibles)
                                                <td>
                                                    {{-- <a href="javascript:void(0)" data-toggle="modal" data-target="#accessibles-modal-{{$customer->cus_id}}"><i class="fa fa-eye"></i></a> --}}
                                                    <?php
                                                        $accessibles = explode(",",$customer->cus_accessibles);
                                                        if(end($accessibles) == " " || end($accessibles) == ""){array_pop($accessibles);}

                                                        $accessibles_prices = explode(",",$customer->cus_accessibles_prices);
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
                                                @else
                                                    <td>
                                                    -    
                                                    </td>
                                                @endif
                                                {{-- 
                                                @if($customer->cus_notes)
                                                    <td>
                                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#notes-modal-{{$customer->cus_id}}"><i class="fa fa-eye"></i></a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <a href="javascript:void(0)" class="text-gray" style="cursor: not-allowed;" disabled><i class="fa fa-eye"></i></a>
                                                    </td>
                                                @endif 
                                                --}}

                                                @if($customer->cus_active == 0)
                                                    <td>
                                                        <span class="badge badge-danger">Inactive</span>
                                                        @if(session('typ_id') == '1' || session('typ_id') == '2') 
                                                        <a class="fa fa-toggle-off" type="button" href="{{ action('CustomerController@reactivateCustomer',[$customer->cus_id]) }}" aria-hidden="true"></a>
                                                        @endif
                                                    </td>
                                                @else
                                                    <td>
                                                        <span class="badge badge-success">Active</span>
                                                        @if(session('typ_id') == '1' || session('typ_id') == '2') 
                                                        <a class="fa fa-toggle-on" type="button" href="{{ action('CustomerController@deactivateCustomer',[$customer->cus_id]) }}" aria-hidden="true"></a>
                                                        @endif
                                                    </td>
                                                @endif
                                                
                                                <td>
                                                @if($customer->cus_active == 0)
                                                    <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" disabled><i class="fa fa-ellipsis-vertical"></i></button>
                                                @else   
                                                    <div class="dropdown">
                                                        <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" data-toggle="dropdown"><i class="fa fa-ellipsis-vertical"></i></button>
                                                        <ul class="dropdown-menu">
                                                            @if(session('typ_id') == '1' || session('typ_id') == '4')
                                                                <li>
                                                                    <a class="ml-3" id="cus_edit_button" href="javascript:void(0)" data-toggle="modal" data-target="#edit-customer-modal-{{$customer->cus_id}}"><i class="fa fa-edit mr-2" aria-hidden="true"></i>Edit Info</a>
                                                                    <input type="hidden" name="cus_id" value="{{$customer->cus_id}}">
                                                                </li>
                                                            @endif
                                                            <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#print-customer-modal-{{$customer->cus_id}}"><i class="fa fa-print mr-2" aria-hidden="true"></i>Print Info</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                @endif
                                            
                                                <!--Notes Modal -->
                                                <div class="modal fade" id="notes-modal-{{$customer->cus_id}}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Notes</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                    <div class="col-md-12">
                                                                        {{ $customer->cus_notes }}
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--Accessibles Modal -->
                                                <div class="modal fade" id="accessibles-modal-{{$customer->cus_id}}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Accessible Products</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <?php
                                                                        $accessibles = explode(",",$customer->cus_accessibles);
                                                                        if(end($accessibles) == " " || end($accessibles) == ""){array_pop($accessibles);}

                                                                        $accessibles_prices = explode(",",$customer->cus_accessibles_prices);
                                                                        if(end($accessibles_prices) == " " || end($accessibles_prices) == ""){}
                                                                        $check_indicator = "";
                                                                        $displayed_price = "";
                                                                        ?>
                                                                    <div class="col-md-12">
                                                                        @if(is_array($products) || is_object($products))
                                                                            @foreach($products as $product)
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
                                                                                        <input type="checkbox" id="product{{$product->prd_id}}" name="cus_accessibles[{{ $product->prd_id }}][prd_id]" value="{{$product->prd_id}}" <?php echo($check_indicator)?>>
                                                                                        <label for="">{{$product->prd_name}}</label>
                                                                                        <input type="number" class="form-control" id="price{{$product->prd_id}}" name="cus_accessibles[{{ $product->prd_id }}][price]" min="1" step="0.01" value="<?php echo($displayed_price)?>">
                                                                                    @endif
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--Edit Customer Modal -->
                                                <div class="modal fade" id="edit-customer-modal-{{$customer->cus_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Customer Form</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="POST" action="{{ action('CustomerController@editCustomer',[$customer->cus_id])}}" enctype="multipart/form-data">
                                                            {{ csrf_field() }} 
                                                                <div class="modal-body">
                                                                    <div class="row">

                                                                        <div class="col-12 text-center">
                                                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#avatarUploadModal" height="150px" width="150px">
                                                                                @if($customer->cus_image <> '')
                                                                                    <img class="img-circle elevation-2" src="{{ asset('img/customers/' . $customer->cus_image) }}" alt="{{ $customer->cus_image }}" style="max-height:150px; max-width:150px; min-height:150px; min-width:150px; object-fit:cover;"/>
                                                                                @else
                                                                                    <img class="img-circle elevation-2" src="{{ asset('img/customers/default.png') }}" alt="{{ $customer->cus_image }}" style="max-height:150px; max-width:150px; min-height:150px; min-width:150px; object-fit:cover;"/>
                                                                                @endif
                                                                            </a>
                                                                            <div class="col-12 text-center mb-4">
                                                                                <a href="javascript:void(0);" class="">
                                                                                    <label class="btn btn-transparent btn-file">
                                                                                        <i id="btn_edit_choose_file" class="fa fa-solid fa-camera mr-2"></i><small>Upload Photo</small>
                                                                                        <input type="file" class="custom-file-input" id="cus_image" name='cus_image' value="{{ old('cus_image') }}" aria-describedby="inputGroupFileAddon01" style="display: none;">
                                                                                    </label>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="cus_name">Full Name <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="cus_name" placeholder="Enter Full Name" value="{{$customer->cus_name}}" required/>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="cus_address">Address <span style="color:red">*</span></label> 
                                                                                <input type="text" class="form-control" name="cus_address" placeholder="Enter Address" value="{{$customer->cus_address}}" required/>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="cus_contact">Contact # <span style="color:red">*</span></label>
                                                                                <input type="text" name="cus_contact" class="form-control" placeholder="Enter Contact #" value="{{$customer->cus_contact}}" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="11"></input>
                                                                            </div>
                                                                            
                                                                            {{--
                                                                                <div class="form-group">
                                                                                <label for="cus_contact">Price Change <span style="color:red">*</span></label>
                                                                                <input type="text" name="cus_contact" class="form-control" placeholder="Enter Contact #" value="{{$customer->cus_price_change}}" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="11"></input>
                                                                                </div>
                                                                            --}}
                                                                            
                                                                            <div class="form-group">
                                                                                <label> Select Accessible Products<span style="color:red"> *</span></label>
                                                                                <div class="card">
                                                                                    <div class="col-12 p-2">
                                                                                        <div class="row">
                                                                                            <?php
                                                                                                $accessibles = explode(",",$customer->cus_accessibles);
                                                                                                if(end($accessibles) == " " || end($accessibles) == ""){array_pop($accessibles);}

                                                                                                $accessibles_prices = explode(",",$customer->cus_accessibles_prices);
                                                                                                if(end($accessibles_prices) == " " || end($accessibles_prices) == ""){}
                                                                                                $check_indicator = "";
                                                                                                $displayed_price = "";
                                                                                                ?>
                                                                                            <div class="col-md-12">
                                                                                                @if(is_array($products) || is_object($products))
                                                                                                    @foreach($products as $product)
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
                                                                                                            @php($status = "")
                                                                                                            @if(session('typ_id') == 4)
                                                                                                                @php($status = "disabled")
                                                                                                            @endif
                                                                                                                <input type="checkbox" id="product{{$product->prd_id}}" name="cus_accessibles[{{ $product->prd_id }}][prd_id]" value="{{$product->prd_id}}" <?php echo($check_indicator)?>>
                                                                                                                <label for="">{{$product->prd_name}}</label>
                                                                                                                <input type="number" class="form-control" id="price{{$product->prd_id}}" name="cus_accessibles[{{ $product->prd_id }}][price]" min="1" step="0.01" value="<?php echo($displayed_price)?>" {{$status}}>
                                                                                                            @endif
                                                                                                        </div>
                                                                                                    @endforeach
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="cus_notes">Notes</label>
                                                                                <textarea name="cus_notes" placeholder="Additional notes ..." class="form-control" >{{$customer->cus_notes}}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="text" class="form-control" name="cus_uuid" value="{{ $customer->cus_uuid }}"  hidden/> 
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!--Print Modal -->
                                                <div class="modal fade" id="print-customer-modal-{{$customer->cus_id}}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            
                                                            <div class="modal-body">
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                        <div class="col-md-2 col-12 mb-3 text-center">
                                                                            <div class="image">
                                                                                <img src="{{ asset('img/customers/default.png') }}" class="img-circle elevation-2" alt="Customer Image" height="100vh">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-10 col-12">
                                                                            <h3><strong style="text-transform:uppercase;">{{ $customer->cus_name }}</strong></h3>
                                                                            <i class="text-default">
                                                                                {{ $customer->cus_address }} <br>
                                                                                {{ $customer->cus_contact }}
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a class="btn btn-info" href="{{ action('PrintController@customerDetails',[$customer->cus_id]) }}" target="_BLANK"><i class="fa fa-print"></i> Print</a>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--Customer-Profile Modal -->
                                                <div class="modal fade" id="img-customer-modal-{{$customer->cus_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content bg-transparent">
                                                            <div class="modal-body">
                                                                
                                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <div class="row">
                                                                    <div class="col-12 text-center">
                                                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#avatarUploadModal">
                                                                            @if($customer->cus_image <> '')
                                                                                <img src="{{ asset('img/customers/' . $customer->cus_image) }}" alt="{{ $customer->cus_image }}"  alt="{{ $customer->cus_image }}" style="max-height:100%; max-width:100%; min-height:100%; min-width:100%; object-fit: contain;">
                                                                            @else
                                                                            <img src="{{ asset('img/customers/default.png') }}" alt="{{ $customer->cus_image }}"  alt="{{ $customer->cus_image }}" style="max-height:100%; max-width:100%; min-height:100%; min-width:100%; object-fit: contain;">
                                                                            @endif
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{--<div class = "d-flex justify-content-center">
                                {{ $customers->links() }}
                            </div>--}}
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
                            <img class="img-circle elevation-2" src="{{ asset('img/customers/default.png') }}" alt="" style="max-height:150px; max-width:150px; min-height:150px; min-width:150px; object-fit:cover;"/>
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
                                <input type="text" name="cus_contact" class="form-control" placeholder="Enter Contact #" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="11"></input>
                            </div>

                            <label> Select Accessible Products<span style="color:red"> *</span></label>
                            <div class="card">
                                <div class="col-12 p-2">
                                    <div class="row">
                                        <table class="table table-lg table-borderless text-left">
                                            <tbody>
                                                <div class="col-md-6 required-checkbox">
                                                    @if(is_array($products) || is_object($products))
                                                        @foreach($products as $product)
                                                        <tr>
                                                            <div class="form-check">
                                                                <td><input type="checkbox" id="product{{$product->prd_id}}" name="cus_accessibles[{{ $product->prd_id }}][prd_id]" value="{{$product->prd_id}}"></td>
                                                                <td><label for="">{{$product->prd_name}}</label></td>
                                                                <td><input type="number" class="form-control" id="price{{$product->prd_id}}" name="cus_accessibles[{{ $product->prd_id }}][price]" min="1" step="0.01" value="{{$product->prd_price}}"></td>
                                                            </div>
                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            {{--<div class="form-group">
                                <label for="cus_notes">Notes</label>
                                <textarea name="cus_notes" placeholder="Additional notes ..." class="form-control"></textarea>
                            </div>--}}
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


<!--Pricing Modal -->
<div class="modal fade" id="pricing-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Adjust Product Price</h5>
            </div>
            <form method="POST" action="{{ action('CustomerController@changeProductPrice')}}" enctype="multipart/form-data">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="form-group"> 
                        <label for="cus_name">Enter Changed Price<span style="color:red">*</span></label>
                        <input type="decimal"class="form-control" placeholder="Enter New Price" id="price-change" name="price_change" required onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 46 && event.charCode <= 57))" minlength="1" maxlength="3" max="100"/>
                        <input type="text" class="form-control" id="selected-customers" name="selected_customers" value="" hidden>
                    </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-gift"></i> Apply</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function changePricing() {
        checkedValues = "";
        $(".customer-select:checked").each(function() {

        // Push the value of the checked checkbox into the array
        checkedValues = checkedValues + $(this).val()+",";
        });

        document.getElementById("selected-customers").value = checkedValues;
    }

    function handleChange($input_id) {

        const input = document.getElementById($input_id);
        input.value = parseFloat(input.value).toFixed(2); // ensures 2 decimal places
        input.value = parseFloat(input.value).toFixed(1); // ensures 1 decimal place
    }

    $(document).ready(function(){
        $("#search_customers").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tbl-customers tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    $(document).ready(function() {
        $("#customer-select-all").change(function() {
            if (this.checked) {
                $(".customer-select").each(function() {
                    this.checked=true;
                $("#cus-toolbar").prop("hidden", false);
                });
            } else {
                $(".customer-select").each(function() {
                    this.checked=false;
                    $("#cus-toolbar").prop("hidden", true);
                });
            }
        });

        $(".customer-select").click(function () {
            if ($(this).is(":checked")) {
                var isAllChecked = 0;

                $(".customer-select").each(function() {
                    if (!this.checked){
                        isAllChecked = 1;
                        $("#cus-toolbar").prop("hidden", false);
                    }
                });

                if (isAllChecked == 0) {
                    $("#customer-select-all").prop("checked", true);
                    $("#cus-toolbar").prop("hidden", false);
                }     
            }
            else {
                $("#customer-select-all").prop("checked", false);
            }
        });
    });

</script>
@endsection
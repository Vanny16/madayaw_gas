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

                @if($pdn_flag == false)
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
                            <div class="card-body" style="height:480px; overflow:auto;">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th width="100px"></th>
                                            <th>Product Name</th>
                                            <th>SKU</th>
                                            <th>Price</th>
                                            <th style="text-align: center">Quantity</th>
                                            <th>Description</th>
                                            <th>Weight</th>
                                            <th>Supplier</th>
                                            <th width="150px"></th>
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
                                                @if($product->prd_price === null)
                                                    <td>
                                                        0.00
                                                    </td>
                                                @else
                                                    <td>
                                                        {{$product->prd_price}}
                                                    </td>
                                                @endif
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
                                                @if($product->prd_weight)
                                                    <td>   
                                                        {{$product->prd_weight}} g
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
                                                @if($product->prd_active == 0)
                                                    <td>
                                                        <a class="btn btn-default btn-sm text-primary" disabled><i class="fa fa-plus mr-1" aria-hidden="true"></i> Stock-in</a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <a class="btn btn-default btn-sm text-primary" href="javascript:void(0)" data-toggle="modal" data-target="#product-stockin-modal-{{$product->prd_id}}"><i class="fa fa-plus mr-1" aria-hidden="true"></i> Stock-in</a>
                                                    </td>
                                                @endif
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

                                                <!-- Edit Products Modal -->
                                                <div class="modal fade" id="edit-product-modal-{{$product->prd_id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Product Form</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="POST" action="{{ action('ProductController@editProduct') }}" enctype="multipart/form-data">
                                                            {{ csrf_field() }} 
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-12 text-center">
                                                                                <img class="img-circle elevation-2" src="{{ asset('img/products/default.png') }}" alt="{{-- $product->prd_image --}}" style="max-height:150px; max-width:150px; min-height:150px; min-width:150px; object-fit:cover;"/>
                                                                            <div class="col-12 text-center mb-4">
                                                                            <a href="javascript:void(0);" class="">
                                                                                <label class="btn btn-transparent btn-file">
                                                                                    <i id="btn_choose_file" class="fa fa-solid fa-camera mr-2"></i><small>Upload Photo</small>
                                                                                    <input type="file" class="custom-file-input" id="choose_file" name='prd_image' value="{{-- old('prd_image') --}}" aria-describedby="inputGroupFileAddon01" style="display: none;">
                                                                                </label>
                                                                            </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                        <div class="form-group">
                                                                                <label for="prd_name">Product Name <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="prd_name" value="{{ $product->prd_name }}"/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="prd_sku">SKU <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="prd_sku" value="{{ $product->prd_sku }}"/>
                                                                            </div>
                                                                            {{--<div class="form-group">
                                                                                <label for="prd_sku">Status <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="sts_name" value=""/>
                                                                            </div>--}}
                                                                            <div class="form-group">
                                                                                <label for="prd_price">Price <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="prd_price" value="{{ $product->prd_price }}" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="prd_deposit">Deposit Price<span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="prd_deposit" placeholder="Enter deposit price" value="{{ $product->prd_deposit}}" onkeypress="return isNumberKey(this, event);" required/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="prd_weight">Net Weight (g) <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="prd_weight" placeholder="Enter net weight" value="{{ $product->prd_weight }}" onkeypress="return isNumberKey(this, event);" required/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="prd_price">Quantity <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="prd_quantity" value="{{ $product->prd_quantity }}" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="prd_description">Description <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="prd_description" value="{{ $product->prd_description }}" />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="cus_contact">Reorder Point <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="prd_reorder" value="{{ $product->prd_reorder_point }}" placeholder="Enter Reorder Point" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="11" required></input>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="sup_id">Supplier <span style="color:red">*</span></label>
                                                                                <select class="form-control" id="suppliers" name="sup_id" required>
                                                                                    @foreach($suppliers as $supplier)
                                                                                        @if($supplier->sup_active == 0)
                                                                                            @continue
                                                                                        @else
                                                                                            @if($product->sup_id == $supplier->sup_id)
                                                                                                <option value="{{ $supplier->sup_id }}" selected>{{ $supplier->sup_name }}</option>
                                                                                            @else
                                                                                                <option value="{{ $supplier->sup_id }}">{{ $supplier->sup_name }}</option>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endforeach   
                                                                                </select> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="text" class="form-control" name="prd_uuid" value="{{ $product->prd_uuid }}"  hidden/> 
                                                                    <input type="text" class="form-control" name="prd_id" value="{{ $product->prd_id }}" hidden/>        
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Stockin Modal -->
                                                <div class="modal fade" id="product-stockin-modal-{{$product->prd_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Product Form</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="POST" action="{{ action('ProductController@addQuantity') }}">
                                                            {{ csrf_field() }} 
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="prd_name">Product Name <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="prd_name" value="{{ $product->prd_name }}" readonly required/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="prd_description">Description <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="prd_description" value="{{ $product->prd_description }}" readonly required/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="prd_sku">SKU <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="prd_sku" value="{{ $product->prd_sku }}" readonly required/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="prd_sku">Quantity to be added <span style="color:red">*</span></label>
                                                                                <input type="number" class="form-control" name="prd_quantity" placeholder="Enter Quantity" onkeypress="return isNumberKey(this, event);" required/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">  
                                                                    <input type="text" class="form-control" name="prd_id" value="{{ $product->prd_id }}"  hidden/>    
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Print-Product Modal -->
                                                <div class="modal fade" id="print-product-modal-{{$product->prd_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-10 col-12">
                                                                        <h3><strong style="text-transform:uppercase;">{{ $product->prd_name }}</strong></h3> 
                                                                        <i class="text-default">
                                                                            {{ $product->prd_description }}
                                                                            <br>
                                                                            {{ $product->prd_sku }} 
                                                                            <br>
                                                                            {{ $product->prd_quantity }}
                                                                            <br>
                                                                            {{ $product->sup_name }}
                                                                        </i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a class="btn btn-info" href="{{ action('PrintController@productDetails',[$product->prd_sku]) }}" target="_BLANK"><i class="fa fa-print"></i> Print</a>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--Product-Profile Modal -->
                                                <div class="modal fade" id="img-product-modal-{{$product->prd_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content bg-transparent">
                                                            <div class="modal-body">
                                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            
                                                                <div class="row">
                                                                    <div class="col-12 text-center">
                                                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#avatarUploadModal">
                                                                            @if($product->prd_image <> '')
                                                                                <img src="{{ asset('img/products/' . $product->prd_image) }}" alt="{{ $product->prd_image }}"  alt="{{ $product->prd_image }}" style="max-height:100%; max-width:100%; min-height:100%; min-width:100%; object-fit: contain;">
                                                                            @else
                                                                            <img src="{{ asset('img/products/default.png') }}" alt="{{ $product->prd_image }}"  alt="{{ $product->prd_image }}" style="max-height:100%; max-width:100%; min-height:100%; min-width:100%; object-fit: contain;">
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
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>

<!-- Create Modal -->

@if(session('getProdValues'))
    @php($prd_name = Session::get('getProdValues')[0][0])
    @php($prd_sku = Session::get('getProdValues')[0][1])
    @php($prd_price = Session::get('getProdValues')[0][2])
    @php($prd_deposit = Session::get('getProdValues')[0][3])
    @php($prd_weight = Session::get('getProdValues')[0][4])
    @php($prd_description = Session::get('getProdValues')[0][5])
    @php($prd_reorder = Session::get('getProdValues')[0][6])
    @php($sup_name = Session::get('getProdValues')[0][7])
    @php($state = Session::get('getProdValues')[0][8])
@else
    @php($prd_name = '')
    @php($prd_sku = '')
    @php($prd_price = '')
    @php($prd_deposit = '')
    @php($prd_weight = '')
    @php($prd_description = '')
    @php($prd_reorder = '')
    @php($sup_name = '')
    @php($state = '')
@endif
<div class="modal fade show" id="product-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md show" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ action('ProductController@createProduct') }}" enctype="multipart/form-data">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 text-center">
                                <img class="img-circle elevation-2" src="{{ asset('img/products/default.png') }}" alt="{{-- $product->prd_image --}}" style="max-height:150px; max-width:150px; min-height:150px; min-width:150px; object-fit:cover;"/>
                            <div class="col-12 text-center mb-4">
                            <a href="javascript:void(0);" class="">
                                <label class="btn btn-transparent btn-file">
                                    <i id="btn_choose_file" class="fa fa-solid fa-camera mr-2"></i><small>Upload Photo</small>
                                    <input type="file" class="custom-file-input" id="choose_file" name='prd_image' value="{{-- old('prd_image') --}}" aria-describedby="inputGroupFileAddon01" style="display: none;">
                                </label>
                            </a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="prd_name">Product Name <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="prd_name" placeholder="Enter Product Name" value="{{ $prd_name }}" required/>
                            </div>
                            <div class="form-group">
                                <label for="prd_sku">SKU <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="prd_sku" placeholder="Enter SKU" value="{{ $prd_sku }}" required/>
                            </div>
                            <div class="form-group">
                                <label for="prd_price">Price <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="prd_price" placeholder="Enter Price" value="{{ $prd_price }}" onkeypress="return isNumberKey(this, event);" required/>
                            </div>
                            <div class="form-group">
                                <label for="prd_deposit">Deposit Price<span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="prd_deposit" placeholder="Enter deposit price" value="{{ $prd_deposit }}" onkeypress="return isNumberKey(this, event);" required/>
                            </div>
                            <div class="form-group">
                                <label for="prd_weight">Net Weight (g)<span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="prd_weight" placeholder="Enter net weight" value="{{ $prd_weight }}" onkeypress="return isNumberKey(this, event);" required/>
                            </div>
                            <div class="form-group">
                                <label for="prd_description">Description <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="prd_description" placeholder="Enter Description" value="{{ $prd_description }}" required/>
                            </div>
                            <div class="form-group">
                                <label for="cus_contact">Reorder Point <span style="color:red">*</span></label>
                                <input type="text" name="prd_reorder" class="form-control" placeholder="Enter Reorder Point" value="{{ $prd_reorder }}" onkeypress="return isNumberKey(this, event);" maxlength="11" required></input>
                            </div>
                            <div class="form-group">
                                <label for="sup_id">Supplier <span style="color:red">*</span></label>
                                <div class="form-inline">
                                    <select class="form-control col-md-7" id="suppliers" name="sup_id" oninvalid="this.setCustomValidity('You have no suppliers yet. Please create atleast 1.')" oninput="setCustomValidity('')" required>
                                        @foreach($suppliers as $supplier)
                                            @if($supplier->sup_active == 0)
                                                @continue
                                            @else
                                                @if($sup_name == $supplier->sup_name )
                                                    @php($selected = "selected")
                                                @else
                                                    @php($selected = "")
                                                @endif
                                                <option value="{{ $supplier->sup_id }}" {{ $selected }}>{{ $supplier->sup_name }}</option>
                                            @endif
                                        @endforeach   
                                    </select> 
                                    <button type="button" class="btn btn-info form-control col-md-4 col-12 ml-md-4 mt-md-0 mx-sm-0 mt-3" data-toggle="modal" data-target="#supplier-modal" onclick="getNewProductValue(prd_name.value, prd_sku.value, prd_price.value, prd_deposit.value, prd_weight.value, prd_description.value, prd_reorder.value)"><i class="fa fa-plus-circle"></i> New Supplier</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Supplier Modal -->
<div class="modal fade" id="supplier-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Supplier Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="form-add" action="{{ action('ProductController@createSupplier')}}">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sup_name">Supplier Name <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="sup_name" placeholder="Enter Supplier Name" value="" required/>
                            </div>

                            <div class="form-group">
                                <label for="sup_address">Address <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="sup_address" placeholder="Enter Supplier Address" value="" required/>
                            </div>

                            <div class="form-group">
                                <label for="sup_contact">Contact <span style="color:red">*</span></label>
                                <input type="text" name="sup_contact" class="form-control" placeholder="Enter Supplier Contact #" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" minlength="11" maxlength="11" required></input>
                            </div>

                            <div class="form-group">
                                <label for="sup_notes">Notes</label>
                                <textarea name="sup_notes" placeholder="Additional notes ..." class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
                
                <input type="text" id="sup_prd_name" name="sup_prd_name" hidden/>
                <input type="text" id="sup_prd_sku" name="sup_prd_sku"  hidden/>
                <input type="text" id="sup_prd_price" name="sup_prd_price"  hidden/>
                <input type="text" id="sup_prd_deposit" name="sup_prd_deposit"  hidden/>
                <input type="text" id="sup_prd_weight" name="sup_prd_weight" hidden/>
                <input type="text" id="sup_prd_description" name="sup_prd_description"  hidden/>
                <input type="text" id="sup_prd_reorder" name="sup_prd_reorder"  hidden/>
            </form>
        </div>
    </div>
</div>
 
<script>
    $(document).ready(function(){
        $("#search_products").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tbl-products tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    });
</script>
<script>
    
    $(document).ready(function(){
        $("#product-modal").modal('{{$state}}');
    });

    function getNewProductValue(prd_name, prd_sku, prd_price, prd_deposit, prd_weight, prd_description, prd_reorder){
        document.getElementById('sup_prd_name').value = prd_name;
        document.getElementById('sup_prd_sku').value = prd_sku;
        document.getElementById('sup_prd_price').value = prd_price;
        document.getElementById('sup_prd_deposit').value = prd_deposit;
        document.getElementById('sup_prd_weight').value = prd_weight;
        document.getElementById('sup_prd_description').value = prd_description;
        document.getElementById('sup_prd_reorder').value = prd_reorder;
    }
</script>

@endsection
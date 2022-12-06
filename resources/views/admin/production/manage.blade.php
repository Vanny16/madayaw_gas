@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Production</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Production</li>
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
                <div class="col-12 text-white mb-3">
                    <a class="btn btn-success col-lg-2 col-md-3 col-12"><i class="fa fa-play mr-1"></i> Start Production</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7"> 
                    <div class="col-md-12"> 
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-list"></i> Raw Materials</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool text-primary" href="javascript:void(0)" data-toggle="modal" data-target="#product-modal" onclick="addItem(0)"><i class="fas fa-plus"></i> Add New Item</button>
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                </div>
                            </div>
                            <div class="card-body" style="overflow-x:auto;">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th width="50px"></th>
                                            <th>Name</th>
                                            <th>Stocks</th>
                                            <th></th>
                                            <th width="50px"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl-raw_materials">
                                        @if(isset($raw_materials))
                                            @foreach($raw_materials as $raw_material)
                                                @if($raw_material->prd_quantity < $raw_material->prd_reorder_point)
                                                    @php($reorder_indicator = "table-danger" )
                                                @else
                                                    @php($reorder_indicator = "")
                                                @endif
                                                <tr class="{{ $reorder_indicator }}">
                                                    <td>
                                                        @if($raw_material->prd_image <> '')
                                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#img-product-modal-{{$raw_material->prd_id}}"><img class="img-fluid img-circle elevation-2" src="{{ asset('img/products/' . $raw_material->prd_image) }}" alt="{{ $raw_material->prd_image }}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                        @else
                                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#img-product-modal-{{$raw_material->prd_id}}"><img class="profile-user-img img-fluid img-circle" src="{{ asset('img/products/default.png') }}" alt="{{ $raw_material->prd_image }}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                        @endif
                                                    </td>   
                                                    <td>{{$raw_material->prd_name}}</td>
                                                    <td>{{$raw_material->prd_quantity}}
                                                        <br>
                                                        @if($reorder_indicator != "") 
                                                            @if($raw_material->prd_quantity == 0)
                                                                <span class="badge badge-danger">Restock now</span>
                                                            @elseif($raw_material->prd_quantity < $raw_material->prd_reorder_point)
                                                                <span class="badge badge-warning">Request for restock</span>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td><button type="button" class="btn btn-transparent btn-sm text-success" data-toggle="modal" data-target="#add-quantity-modal" onclick="stockIn({{$raw_material->prd_id}}, 0)"><i class="fa fa-plus-circle"></i> Stock-in</button></td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" data-toggle="dropdown"><i class="fa fa-ellipsis-vertical"></i></button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#edit-raw-modal-{{$raw_material->prd_id}}"><i class="fa fa-edit mr-2" aria-hidden="true"></i>Edit Info</a></li>
                                                                <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#print-product-modal-{{--$product->prd_id--}}"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Deactivate</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- Edit Products Modal -->
                                                <div class="modal fade" id="edit-raw-modal-{{$raw_material->prd_id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Product Form</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="POST" action="{{ action('ProductionController@editItem') }}" enctype="multipart/form-data">
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
                                                                                <input type="text" class="form-control" id="set_prd_name" name="prd_name" value="{{$raw_material->prd_name}}"/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="prd_sku">SKU <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" id="set_prd_sku" name="prd_sku" value="{{$raw_material->prd_sku}}"/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="prd_price">Price <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" id="set_prd_price" name="prd_price" value="{{$raw_material->prd_price}}" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="prd_price">Quantity <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" id="set_prd_quantity" name="prd_quantity" value="{{$raw_material->prd_quantity}}" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="prd_description">Description <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" id="set_prd_description" name="prd_description" value="{{$raw_material->prd_description}}" />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="cus_contact">Reorder Point <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" id="set_prd_reorder" name="prd_reorder" value="{{$raw_material->prd_reorder_point}}" placeholder="Enter Reorder Point" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="11" required></input>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="sup_id">Supplier <span style="color:red">*</span></label>
                                                                                <select class="form-control" id="suppliers" name="sup_id" required>
                                                                                    @foreach($suppliers as $supplier)
                                                                                        @if($supplier->sup_active == 0)
                                                                                            @continue
                                                                                        @else
                                                                                            @if($raw_material->sup_id == $supplier->sup_id)
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
                                                                    <input type="text" class="form-control" id="set_prd_id" name="prd_uuid" value="{{$raw_material->prd_uuid}}" hidden/>
                                                                    <input type="text" class="form-control" id="set_prd_id" name="prd_id" value="{{$raw_material->prd_id}}" hidden/>        
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12"> 
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-filter"></i> Empty Canisters</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool text-primary" href="javascript:void(0)" data-toggle="modal" data-target="#product-modal" onclick="addItem(1)"><i class="fas fa-plus"></i> Add New Item</button>
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                </div>
                            </div>
                            <div class="card-body" style="overflow-x:auto;">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th width="50px"></th>
                                            <th>Canister</th>
                                            <th>Quantity</th>
                                            <th></th>
                                            <th width="50px"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl-empty-canisters">
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <tr>
                                                    <td>
                                                        @if($canister->prd_image <> '')
                                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#img-product-modal-{{$raw_material->prd_id}}"><img class="img-fluid img-circle elevation-2" src="{{ asset('img/products/' . $raw_material->prd_image) }}" alt="{{ $raw_material->prd_image }}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                        @else
                                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#img-product-modal-{{$raw_material->prd_id}}"><img class="profile-user-img img-fluid img-circle" src="{{ asset('img/products/default.png') }}" alt="{{ $raw_material->prd_image }}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                        @endif
                                                    </td>   
                                                    <td>{{$canister->prd_name}}</td>
                                                    <td>{{$canister->prd_empty_goods}}</td>
                                                    <td> <a class="btn btn-transparent btn-sm text-success" href="javascript:void(0)" data-toggle="modal" data-target="#add-quantity-modal" onclick="stockIn({{$canister->prd_id}}, 1)">
                                                        <i class="fa fa-plus-circle mr-1" aria-hidden="true"></i> Stock-in</a></td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" data-toggle="dropdown"><i class="fa fa-ellipsis-vertical"></i></button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#edit-empty-modal-{{$canister->prd_id}}"
                                                                    onclick="editItem(
                                                                    {{$canister->prd_id}},
                                                                    {{$canister->prd_name}},
                                                                    {{$canister->prd_sku}},
                                                                    {{$canister->prd_price}},
                                                                    {{$canister->prd_quantity}},
                                                                    {{$canister->prd_description}},
                                                                    {{$canister->prd_reorder_point}},
                                                                    {{$canister->sup_id}}
                                                                    )">
                                                                    <i class="fa fa-edit mr-2" aria-hidden="true"></i>Edit Info</a></li>
                                                                <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#edit-empty-modal-{{$canister->prd_id}}"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Deactivate</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!-- Edit Products Modal -->
                                                <div class="modal fade" id="edit-empty-modal-{{$canister->prd_id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Product Form</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="POST" action="{{ action('ProductionController@editItem') }}" enctype="multipart/form-data">
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
                                                                                <input type="text" class="form-control" id="set_prd_name" name="prd_name" value="{{$canister->prd_name}}"/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="prd_sku">SKU <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" id="set_prd_sku" name="prd_sku" value="{{$canister->prd_sku}}"/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="prd_price">Price <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" id="set_prd_price" name="prd_price" value="{{$canister->prd_price}}" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="prd_price">Quantity <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" id="set_prd_quantity" name="prd_quantity" value="{{$canister->prd_quantity}}" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="prd_description">Description <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" id="set_prd_description" name="prd_description" value="{{$canister->prd_description}}" />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="cus_contact">Reorder Point <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" id="set_prd_reorder" name="prd_reorder" value="{{$canister->prd_reorder_point}}" placeholder="Enter Reorder Point" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="11" required></input>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="sup_id">Supplier <span style="color:red">*</span></label>
                                                                                <select class="form-control" id="suppliers" name="sup_id" required>
                                                                                    @foreach($suppliers as $supplier)
                                                                                        @if($supplier->sup_active == 0)
                                                                                            @continue
                                                                                        @else
                                                                                            @if($canister->sup_id == $supplier->sup_id)
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
                                                                    <input type="text" class="form-control" id="set_prd_id" name="prd_uuid" value="{{$canister->prd_uuid}}" hidden/>        
                                                                    <input type="text" class="form-control" id="set_prd_id" name="prd_id" value="{{$canister->prd_id}}" hidden/>        
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12"> 
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-fill-drip"></i> Filled Canisters</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                </div>
                            </div>
                            <div class="card-body" style="overflow-x:auto;">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th width="50px"></th>
                                            <th>Canister</th>
                                            <th>Quantity</th>
                                            <th></th>
                                            <th></th>
                                            <th width="50px"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl-filled-canisters">
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <tr>
                                                    <td>
                                                        @if($canister->prd_image <> '')
                                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#img-product-modal-{{$raw_material->prd_id}}"><img class="img-fluid img-circle elevation-2" src="{{ asset('img/products/' . $raw_material->prd_image) }}" alt="{{ $raw_material->prd_image }}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                        @else
                                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#img-product-modal-{{$raw_material->prd_id}}"><img class="profile-user-img img-fluid img-circle" src="{{ asset('img/products/default.png') }}" alt="{{ $raw_material->prd_image }}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                        @endif
                                                    </td>   
                                                    <td>{{$canister->prd_name}}</td>
                                                    <td>{{$canister->prd_quantity}}</td>
                                                    <td> <a class="btn btn-transparent btn-sm text-success" href="javascript:void(0)" data-toggle="modal" data-target="#add-quantity-modal" onclick="stockIn({{$canister->prd_id}}, 2)"><i class="fa fa-plus-circle mr-1" aria-hidden="true"></i> Stock-in filled-cans</a></td>
                                                    <td> <a class="btn btn-transparent btn-sm text-danger" href="javascript:void(0)" data-toggle="modal" data-target="#add-quantity-modal" onclick="stockIn({{$canister->prd_id}}, 3)"><i class="fa fa-arrow-down mr-1" aria-hidden="true"></i> Return Leakers</a></td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" data-toggle="dropdown"><i class="fa fa-ellipsis-vertical"></i></button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#print-product-modal-{{--$product->prd_id--}}"><i class="fa fa-edit mr-2" aria-hidden="true"></i>Edit Info</a></li>
                                                                <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#print-product-modal-{{--$product->prd_id--}}"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Deactivate</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12"> 
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="far fa-circle"></i> Leakers</h3>
                                <div class="card-tools">
                                    {{--<button type="button" class="btn btn-tool text-danger" href="javascript:void(0)" data-toggle="modal" data-target="#leakers-modal"><i class="fas fa-plus"></i> Add Leakers</button>--}}
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                </div>
                            </div>
                            <div class="card-body" style="overflow-x:auto;">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th width="50px"></th>
                                            <th>Canister</th>
                                            <th>Quantity</th>
                                            <th></th>
                                            <th></th>
                                            <th width="50px"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl-products">
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <tr>
                                                    <td>
                                                        @if($canister->prd_image <> '')
                                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#img-product-modal-{{$raw_material->prd_id}}"><img class="img-fluid img-circle elevation-2" src="{{ asset('img/products/' . $raw_material->prd_image) }}" alt="{{ $raw_material->prd_image }}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                        @else
                                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#img-product-modal-{{$raw_material->prd_id}}"><img class="profile-user-img img-fluid img-circle" src="{{ asset('img/products/default.png') }}" alt="{{ $raw_material->prd_image }}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                        @endif
                                                    </td>   
                                                    <td>{{$canister->prd_name}}</td>
                                                    <td>{{$canister->prd_leakers}}</td>
                                                    <td> <a class="btn btn-transparent btn-sm text-info" data-toggle="modal" data-target="#add-quantity-modal" onclick="stockIn({{$canister->prd_id}}, 4)"><i class="fa fa-arrow-right mr-1" aria-hidden="true"></i> Revalve</a></td>
                                                    <td> <a class="btn btn-transparent btn-sm text-info" data-toggle="modal" data-target="#add-quantity-modal" onclick="stockIn({{$canister->prd_id}}, 5)"><i class="fa fa-arrow-right mr-1" aria-hidden="true"></i> Scrap</a></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12"> 
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="far fa-circle"></i> For Revalving</h3>
                                <div class="card-tools">
                                {{--<button type="button" class="btn btn-tool text-danger" href="javascript:void(0)" data-toggle="modal" data-target="#for-revalving-modal"><i class="fas fa-plus"></i> Add Item</button>--}}
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                </div>
                            </div>
                            <div class="card-body" style="overflow-x:auto;">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th width="50px"></th>
                                            <th>Canister</th>
                                            <th>Quantity</th>
                                            <th></th>
                                            <th width="50px"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl-products">
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <tr>
                                                    <td>
                                                        @if($canister->prd_image <> '')
                                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#img-product-modal-{{$raw_material->prd_id}}"><img class="img-fluid img-circle elevation-2" src="{{ asset('img/products/' . $raw_material->prd_image) }}" alt="{{ $raw_material->prd_image }}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                        @else
                                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#img-product-modal-{{$raw_material->prd_id}}"><img class="profile-user-img img-fluid img-circle" src="{{ asset('img/products/default.png') }}" alt="{{ $raw_material->prd_image }}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                        @endif
                                                    </td>   
                                                    <td>{{$canister->prd_name}}</td>
                                                    <td>{{$canister->prd_for_revalving}}</td>
                                                    <td> <a class="btn btn-transparent btn-sm text-info" disabled><i class="fa fa-arrow-right mr-1" aria-hidden="true"></i> Send somewhere</a></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12"> 
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="far fa-circle"></i> Scrap</h3>
                                <div class="card-tools">
                                {{--<button type="button" class="btn btn-tool text-danger" href="javascript:void(0)" data-toggle="modal" data-target="#scrap-modal"><i class="fas fa-plus"></i> Add Item</button>--}}
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                </div>
                            </div>
                            <div class="card-body" style="overflow-x:auto;">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th width="50px"></th>
                                            <th>Canister</th>
                                            <th>Quantity</th>
                                            <th></th>
                                            <th width="50px"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl-products">
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <tr>
                                                    <td>
                                                        @if($canister->prd_image <> '')
                                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#img-product-modal-{{$raw_material->prd_id}}"><img class="img-fluid img-circle elevation-2" src="{{ asset('img/products/' . $raw_material->prd_image) }}" alt="{{ $raw_material->prd_image }}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                        @else
                                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#img-product-modal-{{$raw_material->prd_id}}"><img class="profile-user-img img-fluid img-circle" src="{{ asset('img/products/default.png') }}" alt="{{ $raw_material->prd_image }}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                        @endif
                                                    </td>   
                                                    <td>{{$canister->prd_name}}</td>
                                                    <td>{{$canister->prd_scraps}}</td>
                                                    <td> <a class="btn btn-transparent btn-sm text-info" href="javascript:void(0)" data-toggle="modal" data-target="#scrap-modal-{{$canister->prd_id}}" ><i class="fa fa-arrow-right mr-1" aria-hidden="true"></i> Send somewhere</a></td>
                                                </tr>
                                            @endforeach
                                        @endif 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5"> 
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-clock"></i> Daily Production Summary</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <div class="col-12 mt-3 text-center">
                            <small class="mr-3"><?php echo date(" F d, Y"); ?></small>
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <th width="50%"></th>
                                    <th width="50%"></th>
                                </tr>
                                <tr>
                                    <td class="text-right">Start Time:</td>
                                    <td class="text-left text-success"><strong>6:00 AM</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-right">End Time:</td>
                                    <td class="text-left text-danger">3:00 PM</td>
                                </tr>
                            </table>
                        </div>
                        <!-- Canisters -->
                        <div class="card-body" style="overflow-x:auto;">
                            <div class="row mb-3">
                                <div class="col-12 text-center bg-info">
                                    <p><i class="fa fa-pallet mt-3"></i> Canister Movement</p>
                                </div>
                            </div>
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>Canister</th>
                                        <th>MR</th>
                                        <th>MS</th>
                                        <th>Botin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><i>Empty</i></td>
                                        <td>200</td>
                                        <td>200</td>
                                        <td>200</td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i>Filled</i></td>
                                        <td>200</td>
                                        <td>200</td>
                                        <td>200</td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i>Leakers</i></td>
                                        <td>200</td>
                                        <td>200</td>
                                        <td>200</td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i>For Revalving</i></td>
                                        <td>200</td>
                                        <td>200</td>
                                        <td>200</td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i>Scrap</i></td>
                                        <td>200</td>
                                        <td>200</td>
                                        <td>200</td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="row mb-3 mt-5">
                                <div class="col-12 text-center bg-info">
                                    <p><i class="fa fa-fill-drip mt-3"></i> Filled Canisters</p>
                                </div>
                            </div>
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>Stock Status</th>
                                        <th>MR</th>
                                        <th>MS</th>
                                        <th>Botin</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl-products">
                                    <tr>
                                        <td><i>Opening Stocks</i></td>
                                        <td>200</td>
                                        <td>200</td>
                                        <td>200</td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i>Closing Stocks</i></td>
                                        <td>200</td>
                                        <td>200</td>
                                        <td>200</td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Tank -->
                        <div class="card-body" style="overflow-x:auto;">
                            <div class="row mb-3">
                                <div class="col-12 text-center bg-info">
                                    <p class=""><i class="fa fa-gas-pump mt-3"></i> Tank</p>
                                </div>
                            </div>
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>Tank Name</th>
                                        <th>Tank Opening</th>
                                        <th>Tank Closing</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tank 1</td>
                                        <td>5000 kgs</td>
                                        <td>2345 kgs</td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tank 2</td>
                                        <td>5000 kgs</td>
                                        <td>2245 kgs</td>
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

<!-- Create Product Modal -->
@if(session('getProductionValues'))
    @php($prd_name = Session::get('getProductionValues')[0][0])
    @php($prd_sku = Session::get('getProductionValues')[0][1])
    @php($prd_price = Session::get('getProductionValues')[0][2])
    @php($prd_description = Session::get('getProductionValues')[0][3])
    @php($prd_reorder = Session::get('getProductionValues')[0][4])
    @php($sup_name = Session::get('getProductionValues')[0][5])
    @php($state = Session::get('getProductionValues')[0][6])
@else
    @php($prd_name = '')
    @php($prd_sku = '')
    @php($prd_price = '')
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
            <form method="POST" action="{{ action('ProductionController@createProduct') }}" enctype="multipart/form-data">
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
                                <input type="text" class="form-control" name="prd_price" placeholder="Enter Price" value="" onkeypress="return isNumberKey(this, event);" required/>
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
                                    <button type="button" class="btn btn-info form-control col-md-4 col-12 ml-md-4 mt-md-0 mx-sm-0 mt-3" data-toggle="modal" data-target="#supplier-modal" onclick="getNewProductValue(prd_name.value, prd_sku.value, prd_description.value, prd_reorder.value)"><i class="fa fa-plus-circle"></i> New Supplier</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                </div>
                <div class="modal-footer">
                    <input type="text" class="form-control" id="set_add_flag" name="add_flag" value="" hidden/>
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
                <input type="text" id="sup_prd_sku" name="sup_prd_sku" placeholder="Enter SKU" value="" hidden/>
                <input type="text" id="sup_prd_description" name="sup_prd_description"  hidden/>
                <input type="text" id="sup_prd_reorder" name="sup_prd_reorder"  hidden/>
            </form>
        </div>
    </div>
</div>

<!-- Add Quantity Modal -->
<div class="modal fade" id="add-quantity-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Quantity</h5>
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
                                <label for="quantity"id="lbl-add">Amount to add <span style="color:red">*</span></label>
                                <div id="crate">
                                    <label for="quantity" id="lbl-crate">Crate<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="crate-quantity" name="crate_quantity" placeholder="Quantity"/>
                                </div>
                                <label for="quantity"id="lbl-loose">Loose <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="quantity" name="quantity" name="quantity" placeholder="Quantity"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="text" class="form-control" id="set_stockin_flag" name="stockin_flag" value="" hidden/>
                    <input type="text" class="form-control" id="set_stockin_id" name="stockin_prd_id" value="" hidden/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function addItem(flag){
        document.getElementById('set_add_flag').value = flag;
    }

    // function editItem(prd_id, prd_name, prd_sku, prd_price, prd_quantity, prd_description, prd_reorder_point, sup_id){
    //     alert(prd_id);
    //     document.getElementById('set_prd_id').value = prd_id;
    //     document.getElementById('set_prd_name').value = prd_name;
    //     // document.getElementById('set_prd_sku').value = prd_sku;
    //     // document.getElementById('set_prd_price').value = prd_price;
    //     // document.getElementById('set_prd_quantity').value = prd_quantity;
    //     // document.getElementById('set_prd_description').value = prd_description;
    //     // document.getElementById('set_prd_reorder').value = prd_reorder_point;
    //     // document.getElementById('set_sup_id').value = sup_id;
    // }

    function stockIn(prd_id, flag){
        document.getElementById('set_stockin_id').value = prd_id;
        document.getElementById('set_stockin_flag').value = flag;
        
        if(flag === 0){
            $("#add-quantity-modal").find("#lbl-add").show();
            $("#add-quantity-modal").find("#lbl-loose").hide();
            $("#add-quantity-modal").find("#lbl-crate").hide();
            $("#add-quantity-modal").find("#crate-quantity").hide();
        }else{
            $("#add-quantity-modal").find("#lbl-add").hide();
            $("#add-quantity-modal").find("#lbl-loose").show();
            $("#add-quantity-modal").find("#lbl-crate").show();
            $("#add-quantity-modal").find("#crate-quantity").show();
        }
    }
</script>
@endsection
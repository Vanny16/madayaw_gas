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
                    @if(session('typ_id') == 1 || session('typ_id') == 5)
                        @if($pdn_flag)
                            <a class="btn btn-success col-lg-2 col-md-3 col-12" href= "javascript:void(0)" data-toggle="modal" data-target="#production-prompt-modal"><i class="fa fa-play mr-1"></i> Start Production</a>
                        @else
                            <a class="btn btn-danger col-lg-2 col-md-3 col-12" href= "javascript:void(0)" data-toggle="modal" data-target="#production-prompt-modal"><i class="fa fa-stop mr-1"></i> End Production</a>
                        @endif
                    @endif
                    @if(session('typ_id') == 4)
                        <a class="btn btn-primary col-lg-2 col-md-3 col-12" style="float:right;" href= "javascript:void(0)" data-toggle="modal" data-target="#production-verify-modal"><i class="fa fa-edit mr-1"></i> Verify Production</a>
                    @elseif(session('typ_id') == 1 || session('typ_id') == 5)
                        <div class="dropdown dropleft" style="float:right;">
                            <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" data-toggle="dropdown"><i class="fa fa-ellipsis-vertical"></i></button>
                            <ul class="dropdown-menu">
                                <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#production-verify-modal">Verify Production</a></li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                @if($pdn_flag == 0)
                    <div class="col-md-4 order-lg-1 order-md-1 order-sm-2 order-xs-2"> 
                        <div class="col-md-12"> 
                            <div class="card">
                                <div class="card-header">
                                    <h5>Product Movement</h5>
                                    <ul class="nav nav-pills card-header-pills">
                                        <li class="nav-item">
                                            <a id="backflushed_tab" class="nav-link" data-toggle="tab" href="#filled-canisters" onclick="showInTabTwo(2)">Backflushed</a>
                                        </li>
                                        <li class="nav-item">
                                            <a id="leakers_tab" class="nav-link" data-toggle="tab" href="#leakers" onclick="showInTabTwo(6)">Leakers</a>
                                        </li>
                                        <li class="nav-item">
                                            <a id="for_revalving_tab" class="nav-link" data-toggle="tab" href="#for-revalving" onclick="showInTabTwo(4)">For Revalving</a>
                                        </li>
                                        <li class="nav-item">
                                            <a id="scraps_tab" class="nav-link" data-toggle="tab" href="#scrap" onclick="showInTabTwo(5)">Scrap</a>
                                        </li>
                                    </ul>
                                    <div class="card-tools">
                                        {{--<button type="button" class="btn btn-tool text-danger" href="javascript:void(0)" data-toggle="modal" data-target="#leakers-modal"><i class="fas fa-plus"></i> Add Leakers</button>--}}
                                        <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button> -->
                                    </div>
                                </div>
                                <div class="tab-content card-body">
                                    <div id="filled-canisters" class="tab-pane">
                                        <div class="card-body" style="overflow-x:auto;">
                                            <table class="table table-hover table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th width="50px"></th>
                                                        <th>Canister</th>
                                                        <!-- <th>Quantity</th> -->
                                                        <th width="240px"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbl-filled-canisters">
                                                    @if(isset($canisters))
                                                        @foreach($canisters as $canister)
                                                            @if($canister->prd_active == 1)
                                                            <tr>
                                                                <td>
                                                                    @if($canister->prd_image <> '')
                                                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#img-product-modal-{{$raw_material->prd_id}}"><img class="img-fluid img-circle elevation-2" src="{{ asset('img/products/' . $raw_material->prd_image) }}" alt="{{ $raw_material->prd_image }}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                                    @else
                                                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#img-product-modal-{{--$raw_material->prd_id--}}"><img class="profile-user-img img-fluid img-circle" src="{{ asset('img/products/default.png') }}" alt="{{-- $raw_material->prd_image --}}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                                    @endif
                                                                </td>   
                                                                <td>{{$canister->prd_name}}</td>
                                                                <!-- <td>{{$canister->prd_quantity}}</td> -->
                                                                <td>
                                                                    @if(session('typ_id') == '1' || session('typ_id') == '4')
                                                                    <a class="btn btn-transparent btn-sm text-success" href="javascript:void(0)" data-toggle="modal" data-target="#add-quantity-modal" onclick="stockIn({{$canister->prd_id}}, 2)"><i class="fa fa-plus-circle mr-1" aria-hidden="true"></i> Stock-in filled-cans</a>
                                                                    @endif
                                                                </td>
                                                                {{--<td> <a class="btn btn-transparent btn-sm text-danger" href="javascript:void(0)" data-toggle="modal" data-target="#add-quantity-modal" onclick="stockIn({{$canister->prd_id}}, 6)"><i class="fa fa-arrow-down mr-1" aria-hidden="true"></i> Input Leakers</a></td>--}}
                                                                {{--<td>
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" data-toggle="dropdown"><i class="fa fa-ellipsis-vertical"></i></button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target=""><i class="fa fa-edit mr-2" aria-hidden="true"></i>Edit Info</a></li>
                                                                            <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target=""><i class="fa fa-ban mr-2" aria-hidden="true"></i>Deactivate</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </td>--}}
                                                            </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="leakers" class="tab-pane">
                                        <div class="card-body" style="overflow-x:auto;">
                                            <table class="table table-hover table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th width="50px"></th>
                                                        <th>Canister</th>
                                                        <!-- <th>Quantity</th> -->
                                                        @if(session('typ_id') == '1' || session('typ_id') == '4')
                                                        <th></th>
                                                        <th></th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody id="tbl-products">
                                                    @if(isset($canisters))
                                                        @foreach($canisters as $canister)
                                                            @if($canister->prd_active == 1)
                                                            <tr>
                                                                <td>
                                                                    @if($canister->prd_image <> '')
                                                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#img-product-modal-{{$raw_material->prd_id}}"><img class="img-fluid img-circle elevation-2" src="{{ asset('img/products/' . $raw_material->prd_image) }}" alt="{{ $raw_material->prd_image }}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                                    @else
                                                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#img-product-modal-{{--$raw_material->prd_id--}}"><img class="profile-user-img img-fluid img-circle" src="{{ asset('img/products/default.png') }}" alt="{{-- $raw_material->prd_image --}}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                                    @endif
                                                                </td>   
                                                                <td>{{$canister->prd_name}}</td>
                                                                <!-- <td>{{$canister->prd_leakers}}</td> -->

                                                                @if(session('typ_id') == '1' || session('typ_id') == '4')
                                                                <td> <a class="btn btn-transparent btn-sm text-success" data-toggle="modal" data-target="#add-quantity-modal" onclick="stockIn({{$canister->prd_id}}, 6)"><i class="fa fa-plus-circle mr-1" aria-hidden="true"></i> Input Leakers</a></td>
                                                                <td> <a class="btn btn-transparent btn-sm text-danger" data-toggle="modal" data-target="#add-quantity-modal" onclick="stockIn({{$canister->prd_id}}, 3)"><i class="fa fa-plus-circle mr-1" aria-hidden="true"></i> Input Bad Order</a></td>
                                                                <td> <a class="btn btn-transparent btn-sm text-info" data-toggle="modal" data-target="#add-quantity-modal" onclick="stockIn({{$canister->prd_id}}, 7)"><i class="fa fa-arrow-right mr-1" aria-hidden="true"></i> For Revalving</a></td>
                                                                <td> <a class="btn btn-transparent btn-sm text-info" data-toggle="modal" data-target="#add-quantity-modal" onclick="stockIn({{$canister->prd_id}}, 5)"><i class="fa fa-arrow-right mr-1" aria-hidden="true"></i> Scrapped</a></td>
                                                                @endif
                                                            </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div> 
                                    </div>
                                    <div id="for-revalving" class="tab-pane">
                                        <div class="card-body" style="overflow-x:auto;">
                                            <table class="table table-hover table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th width="50px"></th>
                                                        <th>Canister</th>
                                                        <!-- <th>Quantity</th> -->
                                                        @if(session('typ_id') == '1' || session('typ_id') == '4')
                                                        <th></th>
                                                        @endif
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
                                                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#img-product-modal-{{--$raw_material->prd_id--}}"><img class="profile-user-img img-fluid img-circle" src="{{ asset('img/products/default.png') }}" alt="{{-- $raw_material->prd_image --}}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                                    @endif
                                                                </td>   
                                                                <td>{{$canister->prd_name}}</td>
                                                                <!-- <td>{{$canister->prd_for_revalving}}</td> -->
                                                                @if(session('typ_id') == '1' || session('typ_id') == '4')
                                                                <td> <a class="btn btn-transparent btn-sm text-info" data-toggle="modal" data-target="#add-quantity-modal" onclick="stockIn({{$canister->prd_id}}, 4)"><i class="fa fa-arrow-right mr-1" aria-hidden="true"></i> Decant and Revalve</a></td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="scrap" class="tab-pane">
                                        <div class="card-body" style="overflow-x:auto;">
                                            <table class="table table-hover table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th width="50px"></th>
                                                        <th>Canister</th>
                                                        <!-- <th>Quantity</th> -->
                                                        <th></th>
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
                                                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#img-product-modal-{{--$raw_material->prd_id--}}"><img class="profile-user-img img-fluid img-circle" src="{{ asset('img/products/default.png') }}" alt="{{-- $raw_material->prd_image --}}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                                    @endif
                                                                </td>   
                                                                <td>{{$canister->prd_name}}</td>
                                                                <!-- <td>{{$canister->prd_scraps}}</td> -->
                                                                    @if(session('typ_id') == 1) {{-- || session('typ_id') == '4' --}}
                                                                    <td>
                                                                        <a class="btn btn-transparent btn-sm text-info" href="javascript:void(0)" data-toggle="modal" data-target="#disposal-modal-{{$canister->prd_id}}" ><i class="fa fa-arrow-right mr-1" aria-hidden="true"></i> Dispose </a>
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                    </td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    @endif 
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>                                                    
                            </div>
                        </div>
                        <div class="col-md-12"> 
                            <div class="card">
                                <div class="card-header">
                                    <ul class="nav nav-pills card-header-pills">
                                        <li class="nav-item">
                                            <a id="raw_tab" class="nav-link" data-toggle="tab" href="#raw-materials" onclick="showInTabOne(0)">Raw Materials</a>
                                        </li>
                                        <li class="nav-item">
                                            <a id="crimped_tab" class="nav-link" data-toggle="tab" href="#empty-canisters" onclick="showInTabOne(1)">Empty Good</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a id="backflushed_tab" class="nav-link" data-toggle="tab" href="#filled-canisters" onclick="showInTabOne(2)">Backflushed</a>
                                        </li> -->
                                    </ul>
                                    <div class="card-tools">
                                        <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button> -->
                                    </div>
                                </div>
                                <div class="tab-content card-body">
                                    <div id="raw-materials" class="tab-pane">
                                        @if(session('typ_id') == '1')
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool text-primary" href="javascript:void(0)" data-toggle="modal" data-target="#product-modal"><i class="fas fa-plus"></i> Add New SKU</button>
                                            </div>
                                        @endif
                                        <div class="card-body" style="overflow-x:auto;">
                                            <table class="table table-hover table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th width="50px"></th>
                                                        <th>Name</th>
                                                        <th>Stocks</th>
                                                        <th></th>
                                                        <th></th>
                                                        <th width="50px"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbl-raw_materials">
                                                    @if(isset($raw_materials))
                                                        @foreach($raw_materials as $raw_material)
                                                            @if($raw_material->prd_is_refillable == 1)
                                                                @if($raw_material->prd_raw_can_qty < $raw_material->prd_reorder_point)
                                                                    @php($reorder_indicator = "table-danger" )
                                                                @else
                                                                    @php($reorder_indicator = "")
                                                                @endif
                                                            @else
                                                                @if($raw_material->prd_quantity < $raw_material->prd_reorder_point)
                                                                    @php($reorder_indicator = "table-danger" )
                                                                @else
                                                                    @php($reorder_indicator = "")
                                                                @endif
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
                                                                <td>
                                                                    @if($raw_material->prd_is_refillable == 1)
                                                                        {{number_format($raw_material->prd_raw_can_qty, 0, '.', ',')}}
                                                                        <br>
                                                                        @if($reorder_indicator != "") 
                                                                            @if($raw_material->prd_raw_can_qty == 0)
                                                                                <span class="badge badge-danger">Restock now</span>
                                                                            @elseif($raw_material->prd_raw_can_qty < $raw_material->prd_reorder_point)
                                                                                <span class="badge badge-warning">Request for restock</span>
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        {{number_format($raw_material->prd_quantity, 0, '.', ',')}}
                                                                        <br>
                                                                        @if($reorder_indicator != "") 
                                                                            @if($raw_material->prd_quantity == 0)
                                                                                <span class="badge badge-danger">Restock now</span>
                                                                            @elseif($raw_material->prd_quantity < $raw_material->prd_reorder_point)
                                                                                <span class="badge badge-warning">Request for restock</span>
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if(session('typ_id') == '1' || session('typ_id') == '4')
                                                                    <button type="button" class="btn btn-transparent btn-sm text-success" data-toggle="modal" data-target="#add-quantity-modal" onclick="stockIn({{$raw_material->prd_id}}, 0)"><i class="fa fa-plus-circle"></i> Stock-in</button>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if($raw_material->prd_active == 0)
                                                                        <span class="badge badge-danger">Inactive</span>
                                                                        @if(session('typ_id') == '1' || session('typ_id') == '4')
                                                                        <a class="fa fa-toggle-off" type="button" href="{{ action('ProductionController@activateProduct',[$raw_material->prd_uuid])}}" aria-hidden="true"></a>
                                                                        @endif
                                                                    @else
                                                                        <span class="badge badge-success">Active</span>
                                                                        @if(session('typ_id') == '1'){{--  || session('typ_id') == '4' --}}
                                                                            <a class="fa fa-toggle-on" type="button" href="{{ action('ProductionController@activateProduct',[$raw_material->prd_uuid])}}" aria-hidden="true"></a>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if(session('typ_id') == '1') {{-- || session('typ_id') == '4' --}}
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" data-toggle="dropdown"><i class="fa fa-ellipsis-vertical"></i></button>
                                                                            <ul class="dropdown-menu">
                                                                                <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" onclick="if(confirm('\nEditing the product price won\'t be effective to the existing customers since they have their own base price. \n\nAre you sure you want to proceed?') && (this.dataset.target = '#edit-raw-modal-{{$raw_material->prd_id}}'));"><i class="fa fa-edit mr-2" aria-hidden="true"></i>Edit Info</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    @endif
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

                                                                                        <div class="form-group" >
                                                                                            <label for="edit_prd_type">Material Type <span style="color:red">*</span></label>
                                                                                            <select class="form-control" id="edit_prd_type{{$raw_material->prd_id}}" name="prd_type">
                                                                                                @if($raw_material->prd_is_refillable == 0)
                                                                                                    @php($select_non_refillable = "selected")
                                                                                                    @php($select_refillable = "")
                                                                                                @else
                                                                                                    @php($select_non_refillable = "")
                                                                                                    @php($select_refillable = "selected")
                                                                                                @endif
                                                                                                <option value="0" {{ $select_non_refillable }}>Non-refillable</option>
                                                                                                <option value="1" {{ $select_refillable }}>Refillable</option>
                                                                                            </select>
                                                                                        </div>

                                                                                        @php($quantity = "")
                                                                                        @if($raw_material->prd_is_refillable == 1)
                                                                                            @php($quantity = $raw_material->prd_raw_can_qty)
                                                                                        @else
                                                                                            @php($quantity = $raw_material->prd_quantity)
                                                                                        @endif

                                                                                        <div id="edit_refillables{{$raw_material->prd_id}}">
                                                                                            <div class="form-group">
                                                                                                <label for="">Select Valve <span style="color:red">*</span></label>
                                                                                                <div class="form-check">
                                                                                                    <div class="row">
                                                                                                        @php($item_components = explode(',', $raw_material->prd_components))
                                                                                                        
                                                                                                        @foreach($raw_materials as $component)
                                                                                                            @if($component->prd_is_refillable == 0)
                                                                                                                @php($checked = '')
                                                                                                                @foreach($item_components as $item_component)
                                                                                                                    @if($item_component == $component->prd_id)
                                                                                                                        @php($checked = 'checked')
                                                                                                                    @endif
                                                                                                                @endforeach
                                                                                                                <div class="col-4">
                                                                                                                    <label>
                                                                                                                        <input type="radio" name="valve" value="{{$component->prd_id}}" {{ $checked }} @if($loop->first) @endif/> {{$component->prd_name}}
                                                                                                                    </label>
                                                                                                                </div>
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="">Select Seal <span style="color:red">*</span></label>
                                                                                                <div class="form-check">
                                                                                                    <div class="row">
                                                                                                        @php($item_seals = explode(',', $raw_material->prd_seals))
                                                                                                        
                                                                                                        @foreach($raw_materials as $component)
                                                                                                            @if($component->prd_is_refillable == 0)
                                                                                                                @php($checked = '')
                                                                                                                @foreach($item_seals as $item_seal)
                                                                                                                    @if($item_seal == $component->prd_id)
                                                                                                                        @php($checked = 'checked')
                                                                                                                    @endif
                                                                                                                @endforeach
                                                                                                                <div class="col-4">
                                                                                                                    <label>
                                                                                                                        <input type="radio" name="seal" value="{{$component->prd_id}}" {{ $checked }} @if($loop->first) @endif/> {{$component->prd_name}}
                                                                                                                    </label>
                                                                                                                </div>
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            @php($status = "")
                                                                                            @if(session('typ_id') == 4)
                                                                                                @php($status = "disabled")
                                                                                            @endif
                                                                                            <div class="form-group">
                                                                                                <label for="set_prd_price">Refill Price <span style="color:red">*</span></label>
                                                                                                <input type="text" class="form-control" id="set_prd_price" name="prd_price" value="{{$raw_material->prd_price}}" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" {{$status}}/>
                                                                                            </div>
                                                                                            {{-- <div class="form-group">
                                                                                                <label for="set_prd_deposit">Deposit Price <span style="color:red">*</span></label>
                                                                                                <input type="text" class="form-control" id="set_prd_deposit" name="prd_deposit" placeholder="Enter Deposit Price" value="{{ $raw_material->prd_deposit }}" onkeypress="return isNumberKey(this, event);" {{$status}}/>
                                                                                            </div> --}}
                                                                                             <div class="form-group">
                                                                                                <label for="set_prd_deposit">Brand New Price <span style="color:red">*</span></label>
                                                                                                <input type="text" class="form-control" id="set_prd_deposit" name="prd_deposit" placeholder="Enter Brand New Price" value="{{ $raw_material->prd_deposit }}" onkeypress="return isNumberKey(this, event);" {{$status}}/>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="set_prd_weight">Net Weight (g) <span style="color:red">*</span></label>
                                                                                                <input type="text" class="form-control" id="set_prd_weight" name="prd_weight" placeholder="Enter Net Weight" value="{{ $raw_material->prd_weight }}" onkeypress="return isNumberKey(this, event);"/>
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                        <!-- {{--@php($quantity = "")
                                                                                        @if($raw_material->prd_is_refillable == 1)
                                                                                            @php($quantity = $raw_material->prd_raw_can_qty)

                                                                                            <div class="form-group">
                                                                                                <label for="prd_price">Price <span style="color:red">*</span></label>
                                                                                                <input type="text" class="form-control" id="set_prd_price" name="prd_price" value="{{$raw_material->prd_price}}" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="prd_deposit">Deposit Price <span style="color:red">*</span></label>
                                                                                                <input type="text" class="form-control" id="set_prd_deposit" name="prd_deposit" placeholder="Enter Deposit Price" value="{{ $raw_material->prd_deposit }}" onkeypress="return isNumberKey(this, event);"/>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="prd_weight">Net Weight (g) <span style="color:red">*</span></label>
                                                                                                <input type="text" class="form-control" id="set_prd_weight" name="prd_weight" placeholder="Enter Net Weight" value="{{ $raw_material->prd_weight }}" onkeypress="return isNumberKey(this, event);"/>
                                                                                            </div>
                                                                                        @else
                                                                                            @php($quantity = $raw_material->prd_quantity)
                                                                                        @endif--}} -->
                                                
                                                                                        <div class="form-group">
                                                                                            <label for="prd_description">Description <span style="color:red">*</span></label>
                                                                                            <input type="text" class="form-control" id="set_prd_description" name="prd_description" value="{{$raw_material->prd_description}}" />
                                                                                        </div>                   

                                                                                        <!-- <div class="form-group">
                                                                                            <label for="prd_price">Quantity <span style="color:red">*</span></label>
                                                                                            <input type="text" class="form-control" id="set_prd_quantity" name="prd_quantity" value="{{$quantity}}" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
                                                                                        </div> -->

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
                                                            
                                                            <script>
                                                                function showEditRefillable{{$raw_material->prd_id}}(){
                                                                    $("#edit_refillables{{$raw_material->prd_id}}").show();
                                                                }

                                                                function hideEditRefillable{{$raw_material->prd_id}}(){
                                                                    $("#edit_refillables{{$raw_material->prd_id}}").hide();
                                                                }

                                                                $(document).ready(function(){
                                                                    var selectedType = $("#edit_prd_type{{$raw_material->prd_id}}").val();
                                                                    if(selectedType === '0'){
                                                                        hideEditRefillable{{$raw_material->prd_id}}();
                                                                        document.getElementById('show_modal').value = 0;
                                                                    } else if(selectedType === '1'){
                                                                        showEditRefillable{{$raw_material->prd_id}}();
                                                                        document.getElementById('show_modal').value = 1;
                                                                    }
                                                                });

                                                                $("#edit_prd_type{{$raw_material->prd_id}}").on("change", function() {
                                                                    if (this.value === '0') {
                                                                        hideEditRefillable{{$raw_material->prd_id}}();
                                                                        document.getElementById('show_modal').value = 0;
                                                                    } else if (this.value === '1') {
                                                                        showEditRefillable{{$raw_material->prd_id}}();
                                                                        document.getElementById('show_modal').value = 1;
                                                                    }
                                                                });
                                                            </script>

                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>     
                                    </div>


                                    <div id="empty-canisters" class="tab-pane">
                                        <div class="card-tools">
                                            <!-- <button type="button" class="btn btn-tool text-primary" href="javascript:void(0)" data-toggle="modal" data-target="#product-modal" onclick="addItem(1)"><i class="fas fa-plus"></i> Add New Canister</button> -->
                                        </div>
                                        <div class="card-body" style="overflow-x:auto;">
                                            <table class="table table-hover table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th width="50px"></th>
                                                        <th>Canister</th>
                                                        <!-- <th>Quantity</th> -->
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbl-empty-canisters">
                                                    @if(isset($canisters))
                                                        @foreach($canisters as $canister)
                                                            @if($canister->prd_active == 1)
                                                            <tr>
                                                                <td>
                                                                    @if($canister->prd_image <> '')
                                                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#img-product-modal-{{$raw_material->prd_id}}"><img class="img-fluid img-circle elevation-2" src="{{ asset('img/products/' . $raw_material->prd_image) }}" alt="{{ $raw_material->prd_image }}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                                    @else
                                                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#img-product-modal-{{--$raw_material->prd_id--}}"><img class="profile-user-img img-fluid img-circle" src="{{ asset('img/products/default.png') }}" alt="{{-- $raw_material->prd_image --}}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                                    @endif
                                                                </td>   
                                                                <td>{{$canister->prd_name}}</td>
                                                                <!-- <td>{{$canister->prd_empty_goods}}</td> -->
                                                                <td>
                                                                    @if(session('typ_id') == '1' || session('typ_id') == '4')
                                                                    <a class="btn btn-transparent btn-sm text-success" href="javascript:void(0)" data-toggle="modal" data-target="#add-quantity-modal" onclick="stockIn({{$canister->prd_id}}, 1)">
                                                                        <i class="fa fa-plus-circle mr-1" aria-hidden="true"></i> Crimp New Cans
                                                                    </a>
                                                                    @endif
                                                                </td>
                                                                <!-- <td>
                                                                    @if($canister->prd_active == 0)
                                                                        <span class="badge badge-danger">Inactive</span>
                                                                        <a class="fa fa-toggle-off" type="button" href="{{ action('ProductionController@activateProduct',[$canister->prd_uuid])}}" aria-hidden="true"></a>
                                                                    @else
                                                                        <span class="badge badge-success">Active</span>
                                                                        <a class="fa fa-toggle-on" type="button" href="{{ action('ProductionController@activateProduct',[$canister->prd_uuid])}}" aria-hidden="true"></a>
                                                                    @endif
                                                                </td> -->
                                                            </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                    <div id="filled-canisters" class="tab-pane">
                                        <div class="card-body" style="overflow-x:auto;">
                                            <table class="table table-hover table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th width="50px"></th>
                                                        <th>Canister</th>
                                                        <!-- <th>Quantity</th> -->
                                                        <th width="240px"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbl-filled-canisters">
                                                    @if(isset($canisters))
                                                        @foreach($canisters as $canister)
                                                            @if($canister->prd_active == 1)
                                                            <tr>
                                                                <td>
                                                                    @if($canister->prd_image <> '')
                                                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#img-product-modal-{{$raw_material->prd_id}}"><img class="img-fluid img-circle elevation-2" src="{{ asset('img/products/' . $raw_material->prd_image) }}" alt="{{ $raw_material->prd_image }}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                                    @else
                                                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#img-product-modal-{{--$raw_material->prd_id--}}"><img class="profile-user-img img-fluid img-circle" src="{{ asset('img/products/default.png') }}" alt="{{-- $raw_material->prd_image --}}" style="max-height:50px; max-width:50px; min-height:50px; min-width:50px; object-fit:cover;"/></a>
                                                                    @endif
                                                                </td>   
                                                                <td>{{$canister->prd_name}}</td>
                                                                <!-- <td>{{$canister->prd_quantity}}</td> -->
                                                                <td>
                                                                    @if(session('typ_id') == '1' || session('typ_id') == '4')
                                                                    <a class="btn btn-transparent btn-sm text-success" href="javascript:void(0)" data-toggle="modal" data-target="#add-quantity-modal" onclick="stockIn({{$canister->prd_id}}, 2)"><i class="fa fa-plus-circle mr-1" aria-hidden="true"></i> Stock-in filled-cans</a>
                                                                    @endif
                                                                </td>
                                                                {{--<td> <a class="btn btn-transparent btn-sm text-danger" href="javascript:void(0)" data-toggle="modal" data-target="#add-quantity-modal" onclick="stockIn({{$canister->prd_id}}, 6)"><i class="fa fa-arrow-down mr-1" aria-hidden="true"></i> Input Leakers</a></td>--}}
                                                                {{--<td>
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" data-toggle="dropdown"><i class="fa fa-ellipsis-vertical"></i></button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target=""><i class="fa fa-edit mr-2" aria-hidden="true"></i>Edit Info</a></li>
                                                                            <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target=""><i class="fa fa-ban mr-2" aria-hidden="true"></i>Deactivate</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </td>--}}
                                                            </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($pdn_flag == 1)
                        <div class="col-md-12 order-lg-2 order-md-2 order-sm-1 order-xs-1"> 
                    @else
                        <div class="col-md-8 order-lg-2 order-md-2 order-sm-1 order-xs-1"> 
                    @endif
                    
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-clock"></i> Production Summary</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <div class="col-12 mt-3 text-center">
                            <strong class="mx-auto">{{$pdn_date}}</strong>
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <th width="50%"></th>
                                    <th width="50%"></th>
                                </tr>
                                <tr>
                                    <td class="text-right">Start Time:  </td>
                                    <td class="text-left text-success">{{$pdn_start_time}}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">End Time:  </td>
                                    @if(empty($pdn_end_time))
                                        <td class="text-left text-danger">-- : -- : -- --</td>
                                    @else    
                                        <td class="text-left text-danger">{{$pdn_end_time}}</td>
                                    @endif
                                </tr>
                            </table>
                            {{--<div class="text-white">
                                <a class="btn btn-primary" href=""> Edit Stocks</a>
                            </div>--}}
                        </div>

                        <!-- Canisters -->
                        <div class="row mb-3">
                            <div class="col-12 text-center bg-info">
                                <p><i class="fa fa-pallet mt-3"></i> Canister Movement</p>
                            </div>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <table class="table table-hover table-condensed">
                                <hr>
                                <thead>
                                    <tr>
                                        <th>Canister</th>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <th>{{$canister->prd_name}}</th>
                                            @endforeach
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><i>Filled</i></td>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <td>{{ number_format($canister->prd_quantity, 0, '.', ',') }}</td>
                                            @endforeach
                                        @endif
                                    </tr>
                                    <tr>
                                        <td><i>Leakers</i></td>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <td>{{ number_format($canister->prd_leakers, 0, '.', ',') }}</td>
                                            @endforeach
                                        @endif
                                    </tr>
                                    <tr>
                                        <td><i>Empty</i></td>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <td>{{ number_format($canister->prd_empty_goods, 0, '.', ',') }}</td>
                                            @endforeach
                                        @endif
                                    </tr>
                                    <tr>
                                        <td><i>For Revalving</i></td>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <td>{{ number_format($canister->prd_for_revalving, 0, '.', ',') }}</td>
                                            @endforeach
                                        @endif
                                    </tr>
                                    <tr>
                                        <td><i>Scrap</i></td>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <td>{{ number_format($canister->prd_scraps, 0, '.', ',') }}</td>
                                            @endforeach
                                        @endif
                                    </tr>
                                    <tr>
                                        <td><b>Total Stocks</b></td>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <strong><th>{!! get_product_total_stock($canister->prd_id) !!}</th></strong>
                                            @endforeach
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                            <hr>

                            <hr>
                            <strong class="ml-2">Opposition Canisters</strong>
                            <hr>
                            <table class="table table-hover table-condensed">
                                @if(isset($oppositions))
                                <thead>
                                    <tr>
                                        @foreach($oppositions as $opposition)
                                            <th><i>{{ $opposition->ops_name }}</i></th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach($oppositions as $opposition)
                                            <td>{{ number_format($opposition->ops_quantity, 0, '.', ',') }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                                @endif
                            </table>
                            <hr>
                            <br>

                            <div class="card">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-4 col-12 mb-3">
                                            <div class="card border card-stretch" style="">
                                                <div class="card-body text-center">
                                                    <h2 style="color:#238ab2;">{!! get_total_canister_report() !!}</h2>
                                                    <p>Madayaw Canister Population</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12 mb-3">
                                            <div class="card border card-stretch" style="">
                                                <div class="card-body text-center">
                                                    <h2 style="color:#238ab2;">{!! get_total_opposition_report() !!}</h2>
                                                    <p>Opposition Canister Population</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12 mb-3">
                                            <div class="card border card-stretch" style="">
                                                <div class="card-body text-center">
                                                    <h2 style="color:#238ab2;">{!! get_total_stock_report() !!}</h2>
                                                    <p>Total Canister Population</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Canisters -->
                        <div class="row mb-3 mt-5">
                            <div class="col-12 text-center bg-info">
                                <p><i class="fa fa-fill-drip mt-3"></i> Filled Canisters</p>
                            </div>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>Stock Status</th>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <th>{{$canister->prd_name}}</th>
                                            @endforeach
                                        @endif
                                    </tr>
                                </thead>
                                <tbody id="tbl-products">
                                    @php($production_id = get_last_production_id())
                                    @php($stocks_flag = 1)
                                    <tr>
                                        <td><i>Opening Stocks</i></td>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <td>{!! get_opening_stock($canister->prd_id, $production_id) !!}</td>
                                            @endforeach
                                        @endif
                                    </tr>
                                    @php($stocks_flag = 2)
                                    <tr>
                                        <td><i>Closing Stocks</i></td>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <td>{!! get_closing_stock($canister->prd_id, $production_id) !!}</td>
                                            @endforeach
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Tank -->
                        <div class="row mb-3">
                            <div class="col-12 text-center bg-info">
                                <p class=""><i class="fa fa-gas-pump mt-3"></i> Tank</p>
                            </div>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>Tank Name</th>
                                        <th>Tank Opening</th>
                                        <th>Tank Closing</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($tanks))
                                        @foreach($tanks as $tank)
                                            <tr>
                                                <td><i>{{$tank->tnk_name}}</i></td>
                                                <td>{!! get_opening_tank($tank->tnk_id, get_last_production_id()) !!} kg</td>
                                                <td>{!! get_closing_tank($tank->tnk_id, get_last_production_id()) !!} kg</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


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
    @php($show_modal = Session::get('getProdValues')[0][9])
    @php($tab_1 = Session::get('getProdValues')[0][10])
    @php($tab_2 = Session::get('getProdValues')[0][11])
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
    @php($show_modal = '')
    @php($tab_1 = '')
    @php($tab_2 = '')
@endif

<!-- Create Product Modal -->
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
                            <div class="form-group" >
                                <label for="prd_sku">SKU <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="prd_sku" placeholder="Enter SKU" value="{{ $prd_sku }}" required/>
                            </div>
                            <div class="form-group" >
                                <label for="prd_type">Material Type <span style="color:red">*</span></label>
                                <select class="form-control" id="prd_type" name="prd_type">
                                    @if($show_modal == 0)
                                        @php($select_non_refillable = "selected")
                                        @php($select_refillable = "")
                                    @else
                                        @php($select_non_refillable = "")
                                        @php($select_refillable = "selected")
                                    @endif
                                    <option value="0" {{ $select_non_refillable }}>Non-refillable</option>
                                    <option value="1" {{ $select_refillable }}>Refillable</option>
                                </select>
                            </div>
                            <div class="form-group" id="prd_components">
                                <label for="prd_type">Select Valve <span style="color:red">*</span></label>
                                <div class="form-check">
                                    <div class="row">
                                        @foreach($raw_materials as $raw_material)
                                            @if($raw_material->prd_is_refillable == 0)
                                                <div class="col-4">
                                                    <label>
                                                        <input type="radio" name="valve" value="{{$raw_material->prd_id}}" @if($loop->first) @endif/> {{$raw_material->prd_name}}
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="prd_seals">
                                <label for="prd_type">Select Seal <span style="color:red">*</span></label>
                                <div class="form-check">
                                    <div class="row">
                                        @foreach($raw_materials as $raw_material)
                                            @if($raw_material->prd_is_refillable == 0)
                                                <div class="col-4">
                                                    <label>
                                                        <input type="radio" name="seal" value="{{$raw_material->prd_id}}" @if($loop->first) @endif/> {{$raw_material->prd_name}}
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="prd_price">
                                <label for="prd_price">Price <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="prd_price" placeholder="Enter Price" value="{{ $prd_price }}" onkeypress="return isNumberKey(this, event);"/>
                            </div>
                            <div class="form-group"  id="prd_deposit">
                                <label for="prd_deposit">Brand New Price <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="prd_deposit" placeholder="Enter Brand New Price" value="{{ $prd_deposit }}" onkeypress="return isNumberKey(this, event);"/>
                            </div>
                            {{-- <div class="form-group"  id="prd_deposit">
                                <label for="prd_deposit">Deposit Price <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="prd_deposit" placeholder="Enter Deposit Price" value="{{ $prd_deposit }}" onkeypress="return isNumberKey(this, event);"/>
                            </div> --}}
                            <div class="form-group" id="prd_weight">
                                <label for="prd_weight">Net Weight (g) <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="prd_weight" placeholder="Enter Net Weight" value="{{ $prd_weight }}" onkeypress="return isNumberKey(this, event);"/>
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
                    <input type="text" class="form-control" id="set_add_flag" name="add_flag" value="" hidden/>
                    <input type="text" id="np_tab_1" name="tab_1"  hidden/>
                    <input type="text" id="np_tab_2" name="tab_2"  hidden/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Toggle Production Modal -->
<div class="modal fade" id="production-prompt-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                @if($pdn_flag)
                    <h5 class="modal-title" id="exampleModalLabel">Start Production</h5>
                @else
                    <h5 class="modal-title" id="exampleModalLabel">End Production</h5>
                @endif
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ action('ProductionController@toggleProduction') }}" enctype="multipart/form-data">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12" style="display: flex; justify-content: center; align-items: center;">
                                    <h3>Tanks</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        @if($pdn_flag)
                                            <th>Confirm Opening Tank</th>
                                        @else
                                            <th>Confirm Closing Tank</th>
                                        @endif
                                        <th class="text-center"><em>Plant Manager</em></th>
                                        <th class="text-center"><em>Supervisor</em></th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @if(isset($tanks[0]))
                                        @foreach($tanks as $tank)
                                            {{-- @if($tank->tnk_active == 1)
                                                @php($tank_remaining = ($tank->tnk_remaining) / 1000)
                                                <td><em>{{$tank->tnk_name}} <strong>(kg)</strong></em></td>
                                                <td><input type="text" class="form-control" value="{{ $tank_remaining }}" disabled></td>
                                                @if(session('typ_id') == 1 || session('typ_id') == 4)
                                                    <td><input type="text" class="form-control" name="tank_remaining{{$tank->tnk_id}}" placeholder="Enter Stocks Quantity" value="{{ $tank_remaining }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                @endif
                                                <input type="text" class="form-control" name="tank_details" placeholder="Enter Stocks Quantity" value="{{$tank_details}}" hidden/>
                                            @endif --}}
                                            
                                            <tr>
                                                @if($tank->tnk_active == 1)
                                                    <td><em>{{$tank->tnk_name}} <strong>(kg)</strong></em></td>
                                                    @if(session('typ_id') == 1 || session('typ_id') == 4)
                                                        @if(count($product_verifications) <> 0)
                                                            @foreach($product_verifications as $verification)
                                                                @if($verification->verify_prd_id == $tank->tnk_id && $verification->verify_is_product == 0)
                                                                    @if($pdn_flag)
                                                                        @php($tank_remaining = ($verification->verify_opening) / 1000)
                                                                    @else
                                                                        @php($tank_remaining = ($verification->verify_closing) / 1000)
                                                                    @endif
                                                                    <td><input type="text" class="form-control" value="{{ $tank_remaining }}"disabled></td>
                                                                    <td><input type="text" class="form-control" name="tank_remaining{{$tank->tnk_id}}" placeholder="Enter Stocks Quantity" value="{{ $tank_remaining }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            @php($tank_remaining = ($tank->tnk_remaining) / 1000)
                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                            <td><input type="text" class="form-control" name="tank_remaining{{$tank->tnk_id}}" placeholder="Enter Stocks Quantity" value="{{ $tank_remaining }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                        @endif
                                                    @else
                                                        @php($tank_remaining = ($tank->tnk_remaining) / 1000)
                                                        <td><input type="text" class="form-control" value="{{ $tank_remaining }}"disabled></td>
                                                        <td><input type="text" class="form-control" name="tank_remaining{{$tank->tnk_id}}" placeholder="Enter Stocks Quantity" value="{{ $tank_remaining }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                    @endif
                                                    <input type="text" class="form-control" name="tank_details" placeholder="Enter Stocks Quantity" value="{{$tank_details}}" hidden/>
                                                @endif
                                            </tr>
                                        @endforeach
                                   @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                   
                    <div style="padding: 20px;"></div>

                    <!-- COMMENTED FOR TESTING -->
                    <div>
                        {{--
                            <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <div class="col-12">
                                    @if(isset($tanks[0]))
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-4">
                                                    @if($pdn_flag)
                                                        <label for="stocks_quantity">Confirm Opening Tank</label>
                                                    @else
                                                        <label for="stocks_quantity">Confirm Closing Tank</label>
                                                    @endif
                                                </div>
                                                <div class="col-8"></div>
                                            </div>
                                        </div>
                                        @foreach($tanks as $tank)
                                            @if($tank->tnk_active == 1)
                                                @php($tank_remaining = ($tank->tnk_remaining) / 1000)
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <em>{{$tank->tnk_name}} <strong>(kg)</strong></em>
                                                        </div>
                                                        <div class="col-6">
                                                            @if($pdn_flag)
                                                                <input type="text" class="form-control" name="tank_remaining{{$tank->tnk_id}}" placeholder="Enter Stocks Quantity" value="{{ $tank_remaining }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required>
                                                            @else
                                                                <input type="text" class="form-control" name="tank_remaining{{$tank->tnk_id}}" placeholder="Enter Stocks Quantity" value="{{ $tank_remaining }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required>
                                                            @endif
                                                            <input type="text" class="form-control" name="tank_details" placeholder="Enter Stocks Quantity" value="{{$tank_details}}" hidden/>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <hr>
                            </div>
                            <div class="col-1"></div>
                        </div>
                        --}}
                    </div>
                    
                    <div>
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-12" style="display: flex; justify-content: center; align-items: center;">
                                        <h3>Canisters</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="overflow-x:auto;">
                                <table class="table table-hover ">
                                    <thead>
                                        <tr>
                                            <th>Canister</th>
                                            <th colspan="2" class="text-center" style="min-width: 250px;">Filled</th>
                                            <th colspan="2" class="text-center" style="min-width: 250px;">Leakers</th>
                                            <th colspan="2" class="text-center" style="min-width: 250px;">Empty</th>
                                            <th colspan="2" class="text-center" style="min-width: 250px;">For Revalving</th>
                                            <th colspan="2" class="text-center" style="min-width: 250px;">Scraps</th>
                                            <th colspan="2" class="text-center" style="min-width: 250px;">Total Stocks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($canisters))
                                            <tr>
                                                <td></td>
                                                <td class="text-center"><em>Supervisor</em></td>
                                                <td class="text-center"><em>Plant Manager</em></td>
                                                <td class="text-center"><em>Supervisor</em></td>
                                                <td class="text-center"><em>Plant Manager</em></td>
                                                <td class="text-center"><em>Supervisor</em></td>
                                                <td class="text-center"><em>Plant Manager</em></td>
                                                <td class="text-center"><em>Supervisor</em></td>
                                                <td class="text-center"><em>Plant Manager</em></td>
                                                <td class="text-center"><em>Supervisor</em></td>
                                                <td class="text-center"><em>Plant Manager</em></td>
                                                <td class="text-center"><em>Supervisor</em></td>
                                                <td class="text-center"><em>Plant Manager</em></td>
                                            </tr>
                                            @foreach($canisters as $canister)
                                                <tr>
                                                    <td><i>{{$canister->prd_name}}</i></td>
                                                    
                                                        @if(count($product_verifications) <> 0)
                                                            @foreach($product_verifications as $verification)
                                                                @if($verification->verify_prd_id == $canister->prd_id && $verification->verify_is_product == 1)
                                                                    
                                                                    @if($pdn_flag)
                                                                        @if(!is_null($verification->verify_opening) && ($verification->verify_user_type == 3 || $verification->verify_user_type == 5))
                                                                            <td><input type="text" class="form-control" value="{{$verification->verify_opening_filled}}" disabled></td>
                                                                            <td><input type="text" class="form-control" name="filled_stock_quantity{{$canister->prd_id}}" value="{{$verification->verify_opening_filled}}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="{{$verification->verify_opening_leakers}}" disabled></td>
                                                                            <td><input type="text" class="form-control" name="leakers_stock_quantity{{$canister->prd_id}}" value="{{$verification->verify_opening_leakers}}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="{{$verification->verify_opening_empty}}" disabled></td>
                                                                            <td><input type="text" class="form-control" name="empty_stock_quantity{{$canister->prd_id}}" value="{{$verification->verify_opening_empty}}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="{{$verification->verify_opening_for_revalving}}" disabled></td>
                                                                            <td><input type="text" class="form-control" name="revalving_stock_quantity{{$canister->prd_id}}" value="{{$verification->verify_opening_for_revalving}}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="{{$verification->verify_opening_scraps}}" disabled></td>
                                                                            <td><input type="text" class="form-control" name="scraps_stock_quantity{{$canister->prd_id}}" value="{{$verification->verify_opening_scraps}}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="{{$verification->verify_opening}}" disabled></td>
                                                                            <td><input type="text" class="form-control" name="total_stock_quantity{{$canister->prd_id}}" value="{!! get_product_total_stock($canister->prd_id) !!}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                        @else
                                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                                            <td><input type="text" class="form-control" name="filled_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_quantity }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                                            <td><input type="text" class="form-control" name="leakers_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_leakers }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                                            <td><input type="text" class="form-control" name="empty_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_empty_goods }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                                            <td><input type="text" class="form-control" name="revalving_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_for_revalving }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                                            <td><input type="text" class="form-control" name="scraps_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_scraps }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                                            <td><input type="text" class="form-control" name="total_stock_quantity{{$canister->prd_id}}" value="{!! get_product_total_stock($canister->prd_id) !!}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                        @endif
                                                                    @else
                                                                        @if(!is_null($verification->verify_closing) && ($verification->verify_user_type == 3 || $verification->verify_user_type == 5))
                                                                            <td><input type="text" class="form-control" value="{{$verification->verify_closing_filled}}" disabled></td>
                                                                            <td><input type="text" class="form-control" name="filled_stock_quantity{{$canister->prd_id}}" value="{{$verification->verify_closing_filled}}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="{{$verification->verify_closing_leakers}}" disabled></td>
                                                                            <td><input type="text" class="form-control" name="leakers_stock_quantity{{$canister->prd_id}}" value="{{$verification->verify_closing_leakers}}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="{{$verification->verify_closing_empty}}" disabled></td>
                                                                            <td><input type="text" class="form-control" name="empty_stock_quantity{{$canister->prd_id}}" value="{{$verification->verify_closing_empty}}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="{{$verification->verify_closing_for_revalving}}" disabled></td>
                                                                            <td><input type="text" class="form-control" name="revalving_stock_quantity{{$canister->prd_id}}" value="{{$verification->verify_closing_for_revalving}}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="{{$verification->verify_closing_scraps}}" disabled></td>
                                                                            <td><input type="text" class="form-control" name="scraps_stock_quantity{{$canister->prd_id}}" value="{{$verification->verify_closing_scraps}}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="{{$verification->verify_closing}}" disabled></td>
                                                                            <td><input type="text" class="form-control" name="total_stock_quantity{{$canister->prd_id}}" value="{!! get_product_total_stock($canister->prd_id) !!}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                        @else
                                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                                            <td><input type="text" class="form-control" name="filled_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_quantity }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                                            <td><input type="text" class="form-control" name="leakers_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_leakers }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                                            <td><input type="text" class="form-control" name="empty_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_empty_goods }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                                            <td><input type="text" class="form-control" name="revalving_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_for_revalving }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                                            <td><input type="text" class="form-control" name="scraps_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_scraps }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                                            <td><input type="text" class="form-control" name="total_stock_quantity{{$canister->prd_id}}" value="{!! get_product_total_stock($canister->prd_id) !!}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                            <td><input type="text" class="form-control" name="filled_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_quantity }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                            
                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                            <td><input type="text" class="form-control" name="leakers_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_leakers }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                            
                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                            <td><input type="text" class="form-control" name="empty_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_empty_goods }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                            
                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                            <td><input type="text" class="form-control" name="revalving_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_for_revalving }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                            
                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                            <td><input type="text" class="form-control" name="scraps_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_scraps }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                            
                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                            <td><input type="text" class="form-control" name="total_stock_quantity{{$canister->prd_id}}" value="{!! get_product_total_stock($canister->prd_id) !!}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                        @endif
                                                        
                                                        <input type="text" class="form-control" name="canister_details" value="{{$canister_details}}" hidden/>
                                                 </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <hr>    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    @if($pdn_flag)
                        @if($verify_opening_visibility == "disabled")
                            <strong>Plant Manager / Admin must verify first!</strong>
                            @php($opening_visibility = "disabled")
                        @elseif($opening_visibility == "discrepancy")
                            <strong>Please resolve Production discrepancy!</strong>
                            @php($opening_visibility = "disabled")
                        @else
                            <strong>Are you sure you want to end the production?</strong>
                        @endif
                        
                        {{-- @if(session('typ_id') <> 1)
                        @else
                            <strong>Are you sure you want to end the production?</strong>
                            @if($verify_opening_visibility)
                            @endif
                        @endif --}}
                            
                        <div>
                            <button type="submit" class="btn btn-success" {{ $opening_visibility }} onclick="this.disabled=true; this.innerHTML='Starting...'; this.form.submit();" ><i class="fa fa-check mr-1"></i>Start Production</button>
                            <a class="btn btn-default text-success" data-dismiss="modal"><i class="text-success"></i>Cancel</a>
                        </div>
                    @else
                        @if($verify_closing_visibility == "disabled")
                            <strong>Plant Manager / Admin must verify first!</strong>
                            @php($closing_visibility = "disabled")
                        @elseif($closing_visibility == "discrepancy")
                            <strong>Please resolve Production discrepancy!</strong>
                            @php($closing_visibility = "disabled")
                        @else
                            <strong>Are you sure you want to end the production?</strong>
                        @endif

                        {{-- @if(session('typ_id') <> 1)
                        @else
                            <strong>Are you sure you want to end the production?</strong> 
                        @endif --}}

                        <div>
                            <button type="submit" class="btn btn-danger" {{ $closing_visibility }} onclick="this.disabled=true; this.innerHTML='Ending...'; this.form.submit();" ><i class="fa fa-ban mr-1"></i>End Production</button>
                            <a class="btn btn-default text-danger" data-dismiss="modal"><i class="text-danger"></i>Cancel</a>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Verify Production Modal -->
<div class="modal fade" id="production-verify-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Verify Production Stocks & Tanks</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ action('ProductionController@verifyProduction') }}" enctype="multipart/form-data">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12" style="display: flex; justify-content: center; align-items: center;">
                                    <h3>Tanks</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        @if($pdn_flag)
                                            <th>Confirm Opening Tank</th>
                                        @else
                                            <th>Confirm Closing Tank</th>
                                        @endif
                                        @if(session('typ_id') == 1 || session('typ_id') == 4)
                                            <th class="text-center"><em>Plant Manager</em></th>
                                            <th class="text-center"><em>Supervisor</em></th>
                                        @else
                                            <th class="text-center"></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                   @if(isset($tanks[0]))
                                        @foreach($tanks as $tank)
                                            <tr>
                                                @if($tank->tnk_active == 1)
                                                    <td><em>{{$tank->tnk_name}} <strong>(kg)</strong></em></td>
                                                    @if(session('typ_id') == 1 || session('typ_id') == 4)
                                                        @if(count($product_verifications) <> 0)
                                                            @foreach($product_verifications as $verification)
                                                                @if($verification->verify_prd_id == $tank->tnk_id && $verification->verify_is_product == 0)
                                                                    @if($pdn_flag)
                                                                        @php($tank_remaining = ($tank->tnk_remaining) / 1000)
                                                                    @else
                                                                        @php($tank_remaining = ($verification->verify_opening) / 1000)
                                                                    @endif
                                                                    <td><input type="text" class="form-control" value="{{ $tank_remaining }}"disabled></td>
                                                                    <td><input type="text" class="form-control" name="verify_tank_remaining{{$tank->tnk_id}}" placeholder="Enter Stocks Quantity" value="{{ $tank_remaining }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            @php($tank_remaining = ($tank->tnk_remaining) / 1000)
                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                            <td><input type="text" class="form-control" name="verify_tank_remaining{{$tank->tnk_id}}" placeholder="Enter Stocks Quantity" value="{{ $tank_remaining }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                        @endif
                                                    @else
                                                        @php($tank_remaining = ($tank->tnk_remaining) / 1000)
                                                        <td><input type="text" class="form-control" name="verify_tank_remaining{{$tank->tnk_id}}" placeholder="Enter Stocks Quantity" value="{{ $tank_remaining }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                    @endif
                                                    <input type="text" class="form-control" name="tank_details" placeholder="Enter Stocks Quantity" value="{{$tank_details}}" hidden/>
                                                @endif
                                            </tr>
                                        @endforeach
                                   @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                   
                    <div style="padding: 20px;"></div>

                    <!-- COMMENTED FOR TESTING -->
                    <div>
                        {{--
                            <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <div class="col-12">
                                    @if(isset($tanks[0]))
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-4">
                                                    @if($pdn_flag)
                                                        <label for="stocks_quantity">Confirm Opening Tank</label>
                                                    @else
                                                        <label for="stocks_quantity">Confirm Closing Tank</label>
                                                    @endif
                                                </div>
                                                <div class="col-8"></div>
                                            </div>
                                        </div>
                                        @foreach($tanks as $tank)
                                            @if($tank->tnk_active == 1)
                                                @php($tank_remaining = ($tank->tnk_remaining) / 1000)
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <em>{{$tank->tnk_name}} <strong>(kg)</strong></em>
                                                        </div>
                                                        <div class="col-6">
                                                            @php(dd($tank))
                                                            @if($pdn_flag)
                                                                <input type="text" class="form-control" name="verify_tank_remaining{{$tank->tnk_id}}" placeholder="Enter Stocks Quantity" value="{{ $tank_remaining }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required>
                                                            @else
                                                                <input type="text" class="form-control" name="verify_tank_remaining{{$tank->tnk_id}}" placeholder="Enter Stocks Quantity" value="{{ $tank_remaining }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required>
                                                            @endif
                                                            <input type="text" class="form-control" name="tank_details" placeholder="Enter Stocks Quantity" value="{{$tank_details}}" hidden/>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <hr>
                            </div>
                            <div class="col-1"></div>
                        </div>
                        --}}
                    </div>

                    
                    <div>
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-12" style="display: flex; justify-content: center; align-items: center;">
                                        <h3>Canisters</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="overflow-x:auto;">
                                <table class="table table-hover ">
                                    <thead>
                                        <tr>
                                            @if(session('typ_id') == 1 || session('typ_id') == 4 )
                                                <th>Canister</th>
                                                <th colspan="2" class="text-center" style="min-width: 250px;">Filled</th>
                                                <th colspan="2" class="text-center" style="min-width: 250px;">Leakers</th>
                                                <th colspan="2" class="text-center" style="min-width: 250px;">Empty</th>
                                                <th colspan="2" class="text-center" style="min-width: 250px;">For Revalving</th>
                                                <th colspan="2" class="text-center" style="min-width: 250px;">Scraps</th>
                                                <th colspan="2" class="text-center" style="min-width: 250px;">Total Stocks</th>
                                            @else
                                                <th>Canister</th>
                                                <th class="text-center">Filled</th>
                                                <th class="text-center">Leakers</th>
                                                <th class="text-center">Empty</th>
                                                <th class="text-center">For Revalving</th> 
                                                <th class="text-center">Scraps</th> 
                                                <th class="text-center">Total Stocks</th> 
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($canisters))
                                            <tr>
                                                @if(session('typ_id') == 1 || session('typ_id') == 4 )
                                                    <td></td>
                                                    <td class="text-center"><em>Supervisor</em></td>
                                                    <td class="text-center"><em>Plant Manager</em></td>
                                                    <td class="text-center"><em>Supervisor</em></td>
                                                    <td class="text-center"><em>Plant Manager</em></td>
                                                    <td class="text-center"><em>Supervisor</em></td>
                                                    <td class="text-center"><em>Plant Manager</em></td>
                                                    <td class="text-center"><em>Supervisor</em></td>
                                                    <td class="text-center"><em>Plant Manager</em></td>
                                                    <td class="text-center"><em>Supervisor</em></td>
                                                    <td class="text-center"><em>Plant Manager</em></td>
                                                    <td class="text-center"><em>Supervisor</em></td>
                                                    <td class="text-center"><em>Plant Manager</em></td>
                                                @else
                                                @endif
                                            </tr>
                                            @foreach($canisters as $canister)
                                                <tr>
                                                    @if(session('typ_id') == 1 || session('typ_id') == 4 )
                                                        <td><i>{{$canister->prd_name}}</i></td>
                                                        @if(count($product_verifications) <> 0)
                                                            <?php $counter = 0; ?><!--for debugging -->
                                                            @foreach($product_verifications as $verification)
                                                                @if($verification->verify_prd_id == $canister->prd_id && $verification->verify_is_product == 1)
                                                                    @php($counter++) <!--for debugging -->
                                                                    @if($pdn_flag)
                                                                        @if(!is_null($verification->verify_opening) && ($verification->verify_user_type == 3 || $verification->verify_user_type == 5))
                                                                            <td><input type="text" class="form-control" value="{{$verification->verify_opening_filled}}" disabled></td>
                                                                            <td><input type="text" class="form-control" name="verify_filled_stock_quantity{{$canister->prd_id}}" value="{{$verification->verify_opening_filled}}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="{{$verification->verify_opening_leakers}}" disabled></td>
                                                                            <td><input type="text" class="form-control" name="verify_leakers_stock_quantity{{$canister->prd_id}}" value="{{$verification->verify_opening_leakers}}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="{{$verification->verify_opening_empty}}" disabled></td>
                                                                            <td><input type="text" class="form-control" name="verify_empty_stock_quantity{{$canister->prd_id}}" value="{{$verification->verify_opening_empty}}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="{{$verification->verify_opening_for_revalving}}" disabled></td>
                                                                            <td><input type="text" class="form-control" name="verify_revalving_stock_quantity{{$canister->prd_id}}" value="{{$verification->verify_opening_for_revalving}}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="{{$verification->verify_opening_scraps}}" disabled></td>
                                                                            <td><input type="text" class="form-control" name="verify_scraps_stock_quantity{{$canister->prd_id}}" value="{{$verification->verify_opening_scraps}}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="{{$verification->verify_opening}}" disabled></td>
                                                                            <td><input type="text" class="form-control" name="verify_total_stock_quantity{{$canister->prd_id}}" value="{!! get_product_total_stock($canister->prd_id) !!}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                        @else
                                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                                            <td><input type="text" class="form-control" name="verify_filled_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_quantity }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                                            <td><input type="text" class="form-control" name="verify_leakers_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_leakers }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                                            <td><input type="text" class="form-control" name="verify_empty_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_empty_goods }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                                            <td><input type="text" class="form-control" name="verify_revalving_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_for_revalving }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                                            <td><input type="text" class="form-control" name="verify_scraps_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_scraps }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                                            <td><input type="text" class="form-control" name="verify_total_stock_quantity{{$canister->prd_id}}" value="{!! get_product_total_stock($canister->prd_id) !!}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                        @endif
                                                                    @else
                                                                        @if(!is_null($verification->verify_closing) && ($verification->verify_user_type == 3 || $verification->verify_user_type == 5))
                                                                            <td><input type="text" class="form-control" value="{{$verification->verify_closing_filled}}" disabled></td>
                                                                            <td><input type="text" class="form-control" name="verify_filled_stock_quantity{{$canister->prd_id}}" value="{{$verification->verify_closing_filled}}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="{{$verification->verify_closing_leakers}}" disabled></td>
                                                                            <td><input type="text" class="form-control" name="verify_leakers_stock_quantity{{$canister->prd_id}}" value="{{$verification->verify_closing_leakers}}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="{{$verification->verify_closing_empty}}" disabled></td>
                                                                            <td><input type="text" class="form-control" name="verify_empty_stock_quantity{{$canister->prd_id}}" value="{{$verification->verify_closing_empty}}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="{{$verification->verify_closing_for_revalving}}" disabled></td>
                                                                            <td><input type="text" class="form-control" name="verify_revalving_stock_quantity{{$canister->prd_id}}" value="{{$verification->verify_closing_for_revalving}}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="{{$verification->verify_closing_scraps}}" disabled></td>
                                                                            <td><input type="text" class="form-control" name="verify_scraps_stock_quantity{{$canister->prd_id}}" value="{{$verification->verify_closing_scraps}}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="{{$verification->verify_closing}}" disabled></td>
                                                                            <td><input type="text" class="form-control" name="verify_total_stock_quantity{{$canister->prd_id}}" value="{!! get_product_total_stock($canister->prd_id) !!}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                        @else
                                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                                            <td><input type="text" class="form-control" name="verify_filled_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_quantity }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                                            <td><input type="text" class="form-control" name="verify_leakers_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_leakers }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                                            <td><input type="text" class="form-control" name="verify_empty_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_empty_goods }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                                            <td><input type="text" class="form-control" name="verify_revalving_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_for_revalving }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                                            <td><input type="text" class="form-control" name="verify_scraps_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_scraps }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                            
                                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                                            <td><input type="text" class="form-control" name="verify_total_stock_quantity{{$canister->prd_id}}" value="{!! get_product_total_stock($canister->prd_id) !!}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                            <td><input type="text" class="form-control" name="verify_filled_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_quantity }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                            
                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                            <td><input type="text" class="form-control" name="verify_leakers_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_leakers }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                            
                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                            <td><input type="text" class="form-control" name="verify_empty_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_empty_goods }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                            
                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                            <td><input type="text" class="form-control" name="verify_revalving_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_for_revalving }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                            
                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                            <td><input type="text" class="form-control" name="verify_scraps_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_scraps }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                            
                                                            <td><input type="text" class="form-control" value="N/A" disabled></td>
                                                            <td><input type="text" class="form-control" name="verify_total_stock_quantity{{$canister->prd_id}}" value="{!! get_product_total_stock($canister->prd_id) !!}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                        @endif
                                                        
                                                        <input type="text" class="form-control" name="canister_details" value="{{$canister_details}}" hidden/>
                                                    @else
                                                        <td><i>{{$canister->prd_name}}</i></td>
                                                        
                                                        <td><input type="form-check-input" class="form-control" name="verify_filled_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_quantity }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                        <td><input type="text" class="form-control" name="verify_leakers_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_leakers }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                        
                                                        <td><input type="text" class="form-control" name="verify_empty_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_empty_goods }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                        <td><input type="text" class="form-control" name="verify_revalving_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_for_revalving }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                        
                                                        <td><input type="text" class="form-control" name="verify_scraps_stock_quantity{{$canister->prd_id}}" value="{{ $canister->prd_scraps }}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                        <td><input type="text" class="form-control" name="verify_total_stock_quantity{{$canister->prd_id}}"value="{!! get_product_total_stock($canister->prd_id) !!}" onclick="this.select();" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)" required></td>
                                                        
                                                        <input type="text" class="form-control" name="canister_details" value="{{$canister_details}}" hidden/>
                                                    @endif
                                                 </tr>
                                            @endforeach
                                        @endif
                                                            {{-- @php(dd($counter))<!--for debugging --> --}}
                                    </tbody>
                                </table>
                                <hr>    
                            </div>
                        </div>
                    </div>
                    
                    <!-- COMMENTED TEST CODE -->
                    <div>
                        {{-- 
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <hr>
                            </div>
                            <div class="col-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <div class="col-12">
                                    @if(isset($canisters[0]))
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-4">
                                                    @if($pdn_flag)
                                                        <label for="stocks_quantity">Verify Opening Stocks</label>
                                                    @else
                                                        <label for="stocks_quantity">Verify Closing Stocks</label>
                                                    @endif
                                                </div>
                                                <div class="col-8">
                                                </div>
                                            </div>
                                        </div>
                                        @foreach($canisters as $canister)
                                            @if($canister->prd_active == 1)
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <em>{{$canister->prd_name}}</em>
                                                        </div>
                                                        <div class="col-8">
                                                            @if($pdn_flag)
                                                                <input type="text" class="form-control" name="verify_stock_quantity{{$canister->prd_id}}" placeholder="Enter Stocks Quantity" value="{{ $canister->prd_quantity }}" onclick="this.select();" required>
                                                            @else
                                                                <input type="text" class="form-control" name="verify_stock_quantity{{$canister->prd_id}}" placeholder="Enter Stocks Quantity" value="{{ $canister->prd_quantity }}" onclick="this.select();" required>
                                                            @endif
                                                            <input type="text" class="form-control" name="canister_details" placeholder="Enter Stocks Quantity" value="{{$canister_details}}" hidden/>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <hr>
                            </div>
                            <div class="col-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="display: flex; justify-content: center; align-items: center;">
                                <h3>Leakers</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <div class="col-12">
                                    @if(isset($canisters[0]))
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-4">
                                                    @if($pdn_flag)
                                                        <label for="stocks_quantity">Verify Opening Stocks</label>
                                                    @else
                                                        <label for="stocks_quantity">Verify Closing Stocks</label>
                                                    @endif
                                                </div>
                                                <div class="col-8"></div>
                                            </div>
                                        </div>
                                        @foreach($canisters as $canister)
                                            @if($canister->prd_active == 1)
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <em>{{$canister->prd_name}}</em>
                                                        </div>
                                                        <div class="col-8">
                                                            @if($pdn_flag)
                                                                <input type="text" class="form-control" name="verify_stock_quantity{{$canister->prd_id}}" placeholder="Enter Stocks Quantity" value="{{ $canister->prd_leakers }}" onclick="this.select();" required>
                                                            @else
                                                                <input type="text" class="form-control" name="verify_stock_quantity{{$canister->prd_id}}" placeholder="Enter Stocks Quantity" value="{{ $canister->prd_leakers }}" onclick="this.select();" required>
                                                            @endif
                                                            <input type="text" class="form-control" name="canister_details" placeholder="Enter Stocks Quantity" value="{{$canister_details}}" hidden/>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <hr>
                            </div>
                            <div class="col-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="display: flex; justify-content: center; align-items: center;">
                                <h3>Empty Goods</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <div class="col-12">
                                    @if(isset($canisters[0]))
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-4">
                                                    @if($pdn_flag)
                                                        <label for="stocks_quantity">Verify Opening Stocks</label>
                                                    @else
                                                        <label for="stocks_quantity">Verify Closing Stocks</label>
                                                    @endif
                                                </div>
                                                <div class="col-8"></div>
                                            </div>
                                        </div>
                                        @foreach($canisters as $canister)
                                            @if($canister->prd_active == 1)
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <em>{{$canister->prd_name}}</em>
                                                        </div>
                                                        <div class="col-8">
                                                            @if($pdn_flag)
                                                                <input type="text" class="form-control" name="verify_stock_quantity{{$canister->prd_id}}" placeholder="Enter Stocks Quantity" value="{{ $canister->prd_empty_goods }}" onclick="this.select();" required>
                                                            @else
                                                                <input type="text" class="form-control" name="verify_stock_quantity{{$canister->prd_id}}" placeholder="Enter Stocks Quantity" value="{{ $canister->prd_empty_goods }}" onclick="this.select();" required>
                                                            @endif
                                                            <input type="text" class="form-control" name="canister_details" placeholder="Enter Stocks Quantity" value="{{$canister_details}}" hidden/>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <hr>
                            </div>
                            <div class="col-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="display: flex; justify-content: center; align-items: center;">
                                <h3>For Revalving</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <div class="col-12">
                                    @if(isset($canisters[0]))
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-4">
                                                    @if($pdn_flag)
                                                        <label for="stocks_quantity">Verify Opening Stocks</label>
                                                    @else
                                                        <label for="stocks_quantity">Verify Closing Stocks</label>
                                                    @endif
                                                </div>
                                                <div class="col-8"></div>
                                            </div>
                                        </div>
                                        @foreach($canisters as $canister)
                                            @if($canister->prd_active == 1)
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <em>{{$canister->prd_name}}</em>
                                                        </div>
                                                        <div class="col-8">
                                                            @if($pdn_flag)
                                                                <input type="text" class="form-control" name="verify_stock_quantity{{$canister->prd_id}}" placeholder="Enter Stocks Quantity" value="{{ $canister->prd_for_revalving }}" onclick="this.select();" required>
                                                            @else
                                                                <input type="text" class="form-control" name="verify_stock_quantity{{$canister->prd_id}}" placeholder="Enter Stocks Quantity" value="{{ $canister->prd_for_revalving }}" onclick="this.select();" required>
                                                            @endif
                                                            <input type="text" class="form-control" name="canister_details" placeholder="Enter Stocks Quantity" value="{{$canister_details}}" hidden/>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <hr>
                            </div>
                            <div class="col-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="display: flex; justify-content: center; align-items: center;">
                                <h3>Scraps</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <div class="col-12">
                                    @if(isset($canisters[0]))
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-4">
                                                    @if($pdn_flag)
                                                        <label for="stocks_quantity">Verify Opening Stocks</label>
                                                    @else
                                                        <label for="stocks_quantity">Verify Closing Stocks</label>
                                                    @endif
                                                </div>
                                                <div class="col-8"></div>
                                            </div>
                                        </div>
                                        @foreach($canisters as $canister)
                                            @if($canister->prd_active == 1)
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <em>{{$canister->prd_name}}</em>
                                                        </div>
                                                        <div class="col-8">
                                                            @if($pdn_flag)
                                                                <input type="text" class="form-control" name="verify_stock_quantity{{$canister->prd_id}}" placeholder="Enter Stocks Quantity" value="{{ $canister->prd_scraps }}" onclick="this.select();" required>
                                                            @else
                                                                <input type="text" class="form-control" name="verify_stock_quantity{{$canister->prd_id}}" placeholder="Enter Stocks Quantity" value="{{ $canister->prd_scraps }}" onclick="this.select();" required>
                                                            @endif
                                                            <input type="text" class="form-control" name="canister_details" placeholder="Enter Stocks Quantity" value="{{$canister_details}}" hidden/>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-1"></div>
                        </div> 
                        --}}
                    </div>
                    
                </div>
                <div class="modal-footer">
                    @if($pdn_flag)
                        @if(session('typ_id') <> 1)
                            @if($verify_opening_visibility == "disabled")
                                <strong>Supervisor / Admin must verify first!</strong>
                            @elseif($verify_opening_visibility == "verified")
                                <strong>Plant Manager / Admin already verified!</strong>
                                @php($verify_opening_visibility = "disabled")
                            @else
                                <strong>Are you sure you want to verify the opening stocks?</strong>
                            @endif
                        @else
                            <strong>Are you sure you want to verify the opening stocks?</strong>
                            @php($verify_opening_visibility = "")
                        @endif
                        <div>
                            <button type="submit" class="btn btn-success" {{ $verify_opening_visibility }}><i class="fa fa-check mr-1"> </i>Verify Production</button>
                            <a class="btn btn-default text-success" data-dismiss="modal"><i class="text-success"></i>Cancel</a>
                        </div>
                    @else
                        @if(session('typ_id') <> 1)
                            @if($verify_closing_visibility == "disabled")
                                <strong>Supervisor / Admin must verify first!</strong>
                            @elseif($verify_closing_visibility == "verified")
                                <strong>Plant Manager / Admin already verified!</strong>
                                @php($verify_closing_visibility = "disabled")
                            @else
                                <strong>Are you sure you want to verify and print the closing stocks?</strong>
                            @endif
                        @else
                            <strong>Are you sure you want to verify the opening stocks?</strong>
                            @php($verify_closing_visibility = "")
                        @endif
                        <div>
                            <button type="submit" class="btn btn-danger" {{ $verify_closing_visibility }}><i class="fa fa-ban mr-1"> </i>Verify Production</button>
                            <a class="btn btn-default text-danger" data-dismiss="modal"><i class="text-danger"></i>Cancel</a>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Opening / Closing Modal -->
<div class="modal fade" id="stocks-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                @if($pdn_flag)
                    <h5 class="modal-title" id="exampleModalLabel">Input Opening Stocks</h5>
                @else
                    <h5 class="modal-title" id="exampleModalLabel">Input Closing Stocks</h5>
                @endif
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tnk_name">Input Closing Stocks<span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="tnk_name" placeholder="Enter Tank Name" value="" required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @if($pdn_flag)
                    <a href="{{ action('ProductionController@toggleProduction') }}" type="button" class="btn btn-default text-danger"><i class="fa fa-ban mr-1 text-danger"> </i>Start Production</a>
                @else
                    <a href="{{ action('ProductionController@toggleProduction') }}" type="button" class="btn btn-default text-danger"><i class="fa fa-ban mr-1 text-danger"> </i>End Production</a>
                @endif
                <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Supplier Modal -->
<div class="modal fade" id="supplier-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Supplier Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="form-add" action="{{ action('ProductionController@createSupplier') }}">
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
                                <input type="text" name="sup_contact" class="form-control" placeholder="Enter Supplier Contact #" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="11" required></input>
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
                    <button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.innerHTML='Saving...'; this.form.submit();"><i class="fa fa-save"></i> Save</button>
                </div>
                <input type="text" id="sup_prd_name" name="sup_prd_name" hidden/>
                <input type="text" id="sup_prd_sku" name="sup_prd_sku" placeholder="Enter SKU" value="" hidden/>
                <input type="text" id="sup_prd_price" name="sup_prd_price" placeholder="Enter SKU" value="" hidden/>
                <input type="text" id="sup_prd_deposit" name="sup_prd_deposit" placeholder="Enter SKU" value="" hidden/>
                <input type="text" id="sup_prd_weight" name="sup_prd_weight" placeholder="Enter SKU" value="" hidden/>
                <input type="text" id="sup_prd_description" name="sup_prd_description"  hidden/>
                <input type="text" id="sup_prd_reorder" name="sup_prd_reorder"  hidden/>
                <input type="text" id="show_modal" name="show_modal"  hidden/>
                <input type="text" id="tab_1" name="tab_1"  hidden/>
                <input type="text" id="tab_2" name="tab_2"  hidden/>
            </form>
        </div>
    </div>
</div>

<!-- Add Quantity Modal -->
<div class="modal fade" id="add-quantity-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <div class="form-inline">
                                    <label for="tanks" id="lbl-tank">Selected Tank <span style="color:red">*</span></label>
                                    <select class="form-control col-md-12" name="selected_tank" id="selected-tank">
                                    @if(isset($tanks))
                                        @foreach($tanks as $tank)
                                            @if($tank->tnk_active == 0)
                                                @continue
                                            @else
                                                <option value="{{ $tank->tnk_id }}">{{ $tank->tnk_name }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">   
                                <label for="quantity" id="lbl-add">Amount to add <span style="color:red">*</span></label>
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
                                <label for="quantity"id="lbl-loose">Loose <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)"/>
                                <div id="crate">
                                    <label for="quantity" id="lbl-crate">Crate <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="crate-quantity" name="crate_quantity" placeholder="Quantity" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="text" class="form-control" id="set_stockin_flag" name="stockin_flag" value="" hidden/>
                    <input type="text" class="form-control" id="set_stockin_page" name="stockin_page" value="" hidden/>
                    <input type="text" class="form-control" id="set_stockin_id" name="stockin_prd_id" value="" hidden/>
                    <input type="text" class="form-control" id="return_page" name="return_page" value="production" hidden/>
                    <input type="text" id="si_tab_1" name="tab_1"  hidden/>
                    <input type="text" id="si_tab_2" name="tab_2"  hidden/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.innerHTML='Saving...'; this.form.submit();"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Disposal Modal -->
<div class="modal fade" id="disposal-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <div class="form-inline">
                                    <label for="tanks" id="lbl-tank">Selected Tank <span style="color:red">*</span></label>
                                    <select class="form-control col-md-12" name="selected_tank" id="selected-tank">
                                    @if(isset($tanks))
                                        @foreach($tanks as $tank)
                                            @if($tank->tnk_active == 0)
                                                @continue
                                            @else
                                                <option value="{{ $tank->tnk_id }}">{{ $tank->tnk_name }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">   
                                <label for="quantity" id="lbl-add">Amount to add <span style="color:red">*</span></label>
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
                                <label for="quantity"id="lbl-loose">Loose <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)"/>
                                <div id="crate">
                                    <label for="quantity" id="lbl-crate">Crate <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="crate-quantity" name="crate_quantity" placeholder="Quantity" onkeypress="return isNumberKey(this, event);" onchange="noNegativeValue(this.id)"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="text" class="form-control" id="set_stockin_flag" name="stockin_flag" value="" hidden/>
                    <input type="text" class="form-control" id="set_stockin_page" name="stockin_page" value="" hidden/>
                    <input type="text" class="form-control" id="set_stockin_id" name="stockin_prd_id" value="" hidden/>
                    <input type="text" class="form-control" id="return_page" name="return_page" value="production" hidden/>
                    <input type="text" id="si_tab_1" name="tab_1"  hidden/>
                    <input type="text" id="si_tab_2" name="tab_2"  hidden/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.innerHTML='Saving...'; this.form.submit();"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Opening / Closing Modal -->
<div class="modal fade" id="stocks-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tank Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tnk_name">Tank Name <span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="tnk_name" placeholder="Enter Tank Name" value="" required/>
                        </div>
                        <div class="form-group">
                            <label for="tnk_quantity">Quantity <span style="color:red">*</span></label>
                            <input type="text" name="tnk_quantity" class="form-control" placeholder="Enter Quantity" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="11" required></input>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ action('ProductionController@toggleProduction') }}" type="button" class="btn btn-default text-danger"><i class="fa fa-ban mr-1 text-danger"> </i>End Production</a>
                <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Tank Modal
<div class="modal fade" id="tank-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tank Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="form-add" action="">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tnk_name">Tank Name <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="tnk_name" placeholder="Enter Tank Name" value="" required/>
                            </div>
                            <div class="form-group">
                                <label for="tnk_quantity">Quantity <span style="color:red">*</span></label>
                                <input type="text" name="tnk_quantity" class="form-control" placeholder="Enter Quantity" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" minlength="11" maxlength="11" required></input>
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
</div> -->

<script>
    function showRefillable(){
        $("#prd_deposit").show();
        $("#prd_weight").show();
        $("#prd_price").show();
        $("#prd_components").show();
        $("#prd_seals").show();
    }

    function hideRefillable(){
        $("#prd_deposit").hide();
        $("#prd_weight").hide();
        $("#prd_price").hide();
        $("#prd_components").hide();
        $("#prd_seals").hide();
    }

    $("#prd_type").on("change", function() {
        if (this.value === '0') {
            hideRefillable();
            document.getElementById('show_modal').value = 0;
        }
        else if (this.value === '1') {
            showRefillable();
            document.getElementById('show_modal').value = 1;
        }
    });

    function addItem(flag){
        document.getElementById('set_add_flag').value = flag;

        if(flag === 0){
            hideRefillable();
            document.getElementById('show_modal').value = 0;
        }else{
            showRefillable();
            document.getElementById('show_modal').value = 1;
        }
    }

    $(document).ready(function(){
        
        //RAW MATS, EMPTY GOODS TAB
        @if($tab_1 == 0)
            $("#raw_tab").addClass("active");
            $("#raw-materials").addClass("active");
            document.getElementById('np_tab_1').value = 0;
            document.getElementById('si_tab_1').value = 0;
        @elseif($tab_1 == 1)
            $("#crimped_tab").addClass("active");
            $("#empty-canisters").addClass("active");
            document.getElementById('np_tab_1').value = 1;
            document.getElementById('si_tab_1').value = 1;
        // @elseif($tab_1 == 2)
        //     $("#backflushed_tab").addClass("active");
        //     $("#filled-canisters").addClass("active");
        //     document.getElementById('si_tab_1').value = 2;
        @else
            $("#raw_tab").addClass("active");
            $("#raw-materials").addClass("active");
            document.getElementById('np_tab_1').value = 0;
            document.getElementById('si_tab_1').value = 0;
        @endif
        
        //BACKFLUSH, LEAKERS, REVALVING, SCRAP TAB
        @if($tab_2 == 2)
            $("#backflushed_tab").addClass("active");
            $("#filled-canisters").addClass("active");
            document.getElementById('np_tab_2').value = 2;
            document.getElementById('si_tab_2').value = 2;
        @elseif($tab_2 == 6)
            $("#leakers_tab").addClass("active");
            $("#leakers").addClass("active");
            document.getElementById('np_tab_2').value = 6;
            document.getElementById('si_tab_2').value = 6;
        @elseif($tab_2 == 4)
            $("#for_revalving_tab").addClass("active");
            $("#for_revalving").addClass("active");
            document.getElementById('si_tab_2').value = 4;
        @elseif($tab_2 == 5)
            $("#scraps_tab").addClass("active");
            $("#scrap").addClass("active");
            // $("#filled-canisters").addClass("active");
            document.getElementById('si_tab_2').value = 5;
        @else
            $("#backflushed_tab").addClass("active");
            $("#filled-canisters").addClass("active");
            document.getElementById('np_tab_2').value = 2;
            document.getElementById('si_tab_2').value = 2;
        @endif

        @if($show_modal == 0)
            hideRefillable()
        @elseif($show_modal == 1)
            showRefillable();
        @endif

        //Set heights for "Total" cards in Canister Movement Summary
        setTotalCardsHeight();

        $("#product-modal").modal('{{$state}}');
    });

    function setTotalCardsHeight(){
        // Get the cards with the class 'card-stretch'
        var cards = $('.card-stretch');
     
        // Set the initial max height to 0
        var maxHeight = 0;
        // Loop through each card
        cards.each(function() {
            // Get the height of the card
            var cardHeight = $(this).outerHeight();

            // If the height of the card is greater than the current max height, update the max height
            if (cardHeight > maxHeight) {
                maxHeight = cardHeight;
            }
        });

        // Set the height of all cards to the max height
        cards.css('height', maxHeight + 'px');
    }

    function stockIn(prd_id, flag){
        document.getElementById('set_stockin_id').value = prd_id;
        document.getElementById('set_stockin_flag').value = flag;
        
        if(flag === 0){
            $("#add-quantity-modal").find("#trx_ref_no").hide();
            $("#add-quantity-modal").find("#customer").hide();
            $("#add-quantity-modal").find("#lbl-tank").hide();
            $("#add-quantity-modal").find("#selected-tank").hide();
            $("#add-quantity-modal #selected-tank").prop("required", false);
            $("#add-quantity-modal").find("#lbl-add").show();
            $("#add-quantity-modal").find("#lbl-loose").hide();
            $("#add-quantity-modal").find("#lbl-crate").hide();
            $("#add-quantity-modal").find("#quantity").show();
            $("#add-quantity-modal").find("#crate-quantity").hide();     
            
        }else{
            $("#add-quantity-modal").find("#trx_ref_no").hide();
            $("#add-quantity-modal").find("#customer").hide();
            $("#add-quantity-modal").find("#lbl-tank").hide();
            $("#add-quantity-modal").find("#selected-tank").hide();
            $("#add-quantity-modal #selected-tank").prop("required", false);
            $("#add-quantity-modal").find("#lbl-add").hide();
            $("#add-quantity-modal").find("#lbl-loose").show();
            $("#add-quantity-modal").find("#lbl-crate").show();
            $("#add-quantity-modal").find("#quantity").show();
            $("#add-quantity-modal").find("#crate-quantity").show();
        }

        if(flag === 2){
            $("#add-quantity-modal").find("#trx_ref_no").hide();
            $("#add-quantity-modal").find("#customer").hide();
            $("#add-quantity-modal").find("#lbl-tank").show();
            $("#add-quantity-modal").find("#selected-tank").show();
            $("#add-quantity-modal #selected-tank").prop("required", true);
            $("#add-quantity-modal").find("#lbl-crate").show();
            $("#add-quantity-modal").find("#lbl-loose").show();
            $("#add-quantity-modal").find("#quantity").show();
            $("#add-quantity-modal").find("#crate-quantity").show();
        }
        else if(flag === 3){
            $("#add-quantity-modal").find("#trx_ref_no").show();
            $("#add-quantity-modal").find("#customer").hide();
            $("#add-quantity-modal").find("#lbl-tank").hide();
            $("#add-quantity-modal").find("#selected-tank").hide();
            $("#add-quantity-modal #selected-tank").prop("required", false);
            $("#add-quantity-modal").find("#lbl-add").hide();
            $("#add-quantity-modal").find("#lbl-loose").hide();
            $("#add-quantity-modal").find("#lbl-crate").hide();
            $("#add-quantity-modal").find("#quantity").hide();
            $("#add-quantity-modal").find("#crate-quantity").hide();
        }
    }

    function getNewProductValue(prd_name, prd_sku, prd_price, prd_deposit, prd_weight, prd_description, prd_reorder){
        document.getElementById('sup_prd_name').value = prd_name;
        document.getElementById('sup_prd_sku').value = prd_sku;
        document.getElementById('sup_prd_price').value = prd_price;
        document.getElementById('sup_prd_deposit').value = prd_deposit;
        document.getElementById('sup_prd_weight').value = prd_weight;
        document.getElementById('sup_prd_description').value = prd_description;
        document.getElementById('sup_prd_reorder').value = prd_reorder;
    }

    function showInTabOne(page){
        document.getElementById('set_add_flag').value = page;
        document.getElementById('tab_1').value = page;
        document.getElementById('np_tab_1').value = page;
        document.getElementById('si_tab_1').value = page;
        document.getElementById('set_stockin_page').value = page;

        // if(page === 2){
        //     $("#add-quantity-modal").find("#lbl-tank").show();
        //     $("#add-quantity-modal").find("#tnk-name").hide();
        //     $("#add-quantity-modal").find("#lbl-crate").show();
        //     $("#add-quantity-modal").find("#lbl-loose").show();
        //     $("#add-quantity-modal").find("#crate-quantity").hide();

        // }else{
        //     $("#add-quantity-modal").find("#lbl-tank").show();
        //     $("#add-quantity-modal").find("#tnk-name").show();
        //     $("#add-quantity-modal").find("#lbl-crate").hide();
        //     $("#add-quantity-modal").find("#lbl-loose").hide();
        //     $("#add-quantity-modal").find("#crate-quantity").hide();
        // }
    }

    function showInTabTwo(page){
        document.getElementById('set_add_flag').value = page;
        document.getElementById('tab_2').value = page;
        document.getElementById('np_tab_2').value = page;
        document.getElementById('si_tab_2').value = page;
        document.getElementById('set_stockin_page').value = page;

        // if(page === 2){
        //     $("#add-quantity-modal").find("#lbl-tank").show();
        //     $("#add-quantity-modal").find("#tnk-name").hide();
        //     $("#add-quantity-modal").find("#lbl-crate").show();
        //     $("#add-quantity-modal").find("#lbl-loose").show();
        //     $("#add-quantity-modal").find("#crate-quantity").hide();

        // }else{
        //     $("#add-quantity-modal").find("#lbl-tank").show();
        //     $("#add-quantity-modal").find("#tnk-name").show();
        //     $("#add-quantity-modal").find("#lbl-crate").hide();
        //     $("#add-quantity-modal").find("#lbl-loose").hide();
        //     $("#add-quantity-modal").find("#crate-quantity").hide();
        // }
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

    function verifyTransaction(){
        var trx_ref_id = document.getElementById("trx_ref_id").value;
        var verified = false;

        @foreach($transactions as $transaction)
            if(trx_ref_id == "{{ $transaction->trx_ref_id }}"){
                verified = true;
                $("#cus_name").val("{{ $transaction->cus_name }}");

                $("#add-quantity-modal").find("#customer").show();
                $("#add-quantity-modal").find("#lbl-crate").show();
                $("#add-quantity-modal").find("#lbl-loose").show();
                $("#add-quantity-modal").find("#quantity").show();
                $("#add-quantity-modal").find("#crate-quantity").show();
            }
        @endforeach

        if(!verified){
            if(trx_ref_id == ""){
                alert("Input required field");
            }
            else{
                alert("No transactions referenced to this code");
            }
            
            $("#add-quantity-modal").find("#customer").hide();
            $("#add-quantity-modal").find("#lbl-crate").hide();
            $("#add-quantity-modal").find("#lbl-loose").hide();
            $("#add-quantity-modal").find("#quantity").hide();
            $("#add-quantity-modal").find("#crate-quantity").hide();
        }
    }
</script>
@endsection
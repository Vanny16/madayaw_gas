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
                    <a class="btn btn-success btn-sm"><i class="fa fa-play mr-1"></i> Start Production</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8"> 
                    <div class="col-md-12"> 
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-list"></i> Raw Materials</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool text-primary" href="javascript:void(0)" data-toggle="modal" data-target="#product-modal"><i class="fas fa-plus"></i> Add New Item</button>
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                </div>
                            </div>
                            <div class="card-body" style="overflow-x:auto;">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Stocks</th>
                                            <th></th>
                                            <th width="50px"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl-raw_materials">
                                        @if(isset($raw_materials))
                                            @foreach($raw_materials as $raw_material)
                                                <tr>
                                                    <td>{{$raw_material->prd_name}}</td>
                                                    <td>{{$raw_material->prd_quantity}}</td>
                                                    <td> <button type="button" class="btn btn-transparent btn-sm text-success" data-toggle="modal" data-target="#add-quantity-modal" onclick="stockIn({{ $raw_material->prd_id }}, 1)"><i class="fa fa-plus-circle mr-1" aria-hidden="true"></i> Stock-in</button></td>
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
                                                <!-- Add Raw Materials Modal -->
                                                <div class="modal fade" id="add-raw-modal-{{$raw_material->prd_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Add Raw Materials</h5>
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
                                                                                <label for="quantity">Amount to add <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="quantity" placeholder="Quantity" required/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="text" class="form-control" name="flag" value="1" hidden/>
                                                                    <input type="text" class="form-control" name="prd_id" value="{{$raw_material->prd_id}}" hidden/>
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
                                    <button type="button" class="btn btn-tool text-primary" href="javascript:void(0)" data-toggle="modal" data-target="#product-modal"><i class="fas fa-plus"></i> Add New Item</button>
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                </div>
                            </div>
                            <div class="card-body" style="overflow-x:auto;">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <tr>
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
                                                    <td>{{$canister->prd_name}}</td>
                                                    <td>{{$canister->prd_empty_goods}}</td>
                                                    <td> <a class="btn btn-transparent btn-sm text-success" href="javascript:void(0)" data-toggle="modal" data-target="#return-add-modal-{{$canister->prd_id}}" disabled><i class="fa fa-plus-circle mr-1" aria-hidden="true"></i> Stock-in</a></td>
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
                                                <!--Return/Add Empty Cans Modal -->
                                                <div class="modal fade" id="return-add-modal-{{$canister->prd_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Return/Add Empty Cans</h5>
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
                                                                                <label for="quantity">Amount to Add <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="quantity" placeholder="Quantity" value="" required/>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="text" class="form-control" name="flag" value="2" hidden/>
                                                                    <input type="text" class="form-control" name="prd_id" value="{{$canister->prd_id}}" hidden/>
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
                                <h3 class="card-title"><i class="fas fa-fill-drip"></i> Canister Filling</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                </div>
                            </div>
                            <div class="card-body" style="overflow-x:auto;">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Canister</th>
                                            <th>Quantity</th>
                                            <th></th>
                                            <th width="50px"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl-filled-canisters">
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <tr>
                                                    <td>{{$canister->prd_name}}</td>
                                                    <td>{{$canister->prd_quantity}}</td>
                                                    <td> <a class="btn btn-transparent btn-sm text-success" href="javascript:void(0)" data-toggle="modal" data-target="#canister-filling-modal-{{$canister->prd_id}}" disabled><i class="fa fa-plus-circle mr-1" aria-hidden="true"></i> Stock-in filled-cans</a></td>
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
                                                <!--Stock-in Canister-Filling Modal -->
                                                <div class="modal fade" id="canister-filling-modal-{{$canister->prd_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Stock-in Filled Cans</h5>
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
                                                                                <label for="quantity">Quantity <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="quantity" placeholder="Quantity" value="" required/>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="text" class="form-control" name="flag" value="1" hidden/>
                                                                    <input type="text" class="form-control" name="prd_id" value="{{$canister->prd_id}}" hidden/>
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
                                <h3 class="card-title"><i class="far fa-circle"></i> Leakers</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool text-danger" href="javascript:void(0)" data-toggle="modal" data-target="#leakers-modal"><i class="fas fa-plus"></i> Add Leakers</button>
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                </div>
                            </div>
                            <div class="card-body" style="overflow-x:auto;">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <tr>
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
                                                    <td>{{$canister->prd_name}}</td>
                                                    <td>{{$canister->prd_leakers}}</td>
                                                    <td> <a class="btn btn-transparent btn-sm text-info" disabled><i class="fa fa-arrow-right mr-1" aria-hidden="true"></i> Revalve</a></td>
                                                    <td> <a class="btn btn-transparent btn-sm text-info" disabled><i class="fa fa-arrow-right mr-1" aria-hidden="true"></i> Scrap</a></td>
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
                                                <!--Add Leakers Modal -->
                                                    <div class="modal fade" id="leakers-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Leakers</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="POST" action="" enctype="multipart/form-data">
                                                            {{ csrf_field() }} 
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="canister">Canister <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="canister" placeholder="Canister" value="" required/>
                                                                            </div>
            
                                                                            <div class="form-group">
                                                                                <label for="quantity">Quantity <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="quantity" placeholder="Quantity" value="" required/>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="production">For Production<span style="color:red">*</span></label>
                                                                                <select class="form-control col-md-12" id="for-production">
                                                                                    <option value="">YES</option>
                                                                                    <option value="">NO</option>
                                                                                </select>
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
                                    <button type="button" class="btn btn-tool text-danger" href="javascript:void(0)" data-toggle="modal" data-target="#for-revalving-modal"><i class="fas fa-plus"></i> Add Item</button>
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                </div>
                            </div>
                            <div class="card-body" style="overflow-x:auto;">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <tr>
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
                                                    <td>{{$canister->prd_name}}</td>
                                                    <td>{{$canister->prd_for_revalving}}</td>
                                                    <td> <a class="btn btn-transparent btn-sm text-info" disabled><i class="fa fa-arrow-right mr-1" aria-hidden="true"></i> Send somewhere</a></td>
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
                                        <!--Add For-Revalving Modal -->
                                        <div class="modal fade" id="for-revalving-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">For Revalving</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="" enctype="multipart/form-data">
                                                    {{ csrf_field() }} 
                                                        <div class="modal-body">
                                                            <div class="row">
                                                        
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="canister">Canister <span style="color:red">*</span></label>
                                                                        <input type="text" class="form-control" name="canister" placeholder="Canister" value="" required/>
                                                                    </div>
    
                                                                    <div class="form-group">
                                                                        <label for="quantity">Quantity <span style="color:red">*</span></label>
                                                                        <input type="text" class="form-control" name="quantity" placeholder="Quantity" value="" required/>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="production">For Production<span style="color:red">*</span></label>
                                                                        <select class="form-control col-md-12" id="for-production">
                                                                            <option value="">YES</option>
                                                                            <option value="">NO</option>
                                                                        </select>
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
                                    <button type="button" class="btn btn-tool text-danger" href="javascript:void(0)" data-toggle="modal" data-target="#scrap-modal"><i class="fas fa-plus"></i> Add Item</button>
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                </div>
                            </div>
                            <div class="card-body" style="overflow-x:auto;">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <tr>
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
                                                    <td>{{$canister->prd_name}}</td>
                                                    <td>{{$canister->prd_scraps}}</td>
                                                    <td> <a class="btn btn-transparent btn-sm text-info" href="javascript:void(0)" data-toggle="modal" data-target="#scrap-modal-{{$canister->prd_id}}" ><i class="fa fa-arrow-right mr-1" aria-hidden="true"></i> Send somewhere</a></td>
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
                                                <!--Add Scrap Modal -->
                                                <div class="modal fade" id="scrap-modal-{{$canister->prd_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Empty Canisters</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="POST" action="" enctype="multipart/form-data">
                                                            {{ csrf_field() }} 
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="canister">Canister <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="canister" placeholder="Canister" value="" required/>
                                                                            </div>
            
                                                                            <div class="form-group">
                                                                                <label for="quantity">Quantity <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="quantity" placeholder="Quantity" value="" required/>
                                                                            </div>
                                                                            
                                                                            <div class="form-group">
                                                                                <label for="production">For Production<span style="color:red">*</span></label>
                                                                                <select class="form-control col-md-12" id="for-production">
                                                                                    <option value="">YES</option>
                                                                                    <option value="">NO</option>
                                                                                </select>
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
                                            @endforeach
                                        @endif 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-4"> 
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-clock"></i> Production Summary</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <!-- Opening -->
                        <div class="card-body" style="overflow-x:auto;">
                            <div class="row mb-3">
                                <div class="col-7">
                                    <small class="text-success">Opening Operations</small>
                                </div>
                            </div>
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="50px">#</th>
                                        <th>Tank Name</th>
                                        <th>Time Start</th>
                                        <th>Tank Opening</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl-products">
                                    <tr>
                                        <td class="text-danger">1</td>
                                        <td>Tank 1</td>
                                        <td>6:00 AM</td>
                                        <td>5000 kgs</td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <hr>
                        <!-- Closing -->
                        <div class="card-body" style="overflow-x:auto;">
                            <div class="row mb-3">
                                <div class="col-8">
                                    <small class="text-danger">Closing Operations</small>
                                </div>
                            </div>
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="50px">#</th>
                                        <th>Tank Name</th>
                                        <th>Time End</th>
                                        <th>Tank Closing</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl-products">
                                    <tr>
                                        <td class="text-danger">1</td>
                                        <td>Tank 1</td>
                                        <td>3:00 PM</td>
                                        <td>2567 kgs</td>
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
@if(session('getProdValues'))
    @php($prd_name = Session::get('getProdValues')[0][0])
    @php($prd_sku = Session::get('getProdValues')[0][1])
    @php($prd_price = Session::get('getProdValues')[0][2])
    @php($prd_description = Session::get('getProdValues')[0][3])
    @php($prd_reorder = Session::get('getProdValues')[0][4])
    @php($sup_name = Session::get('getProdValues')[0][5])
    @php($state = Session::get('getProdValues')[0][6])
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

<!-- Add Raw Materials Modal -->
<div class="modal fade" id="add-quantity-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Raw Materials</h5>
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
                                <label for="quantity">Amount to add <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="quantity" name="quantity" placeholder="Quantity" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="text" class="form-control" id="set_flag" name="set_flag" value="" hidden/>
                    <input type="text" class="form-control" id="set_prd_id" name="set_prd_id" value="" hidden/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function stockIn(prd_id, flag){
        document.getElementById('set_prd_id').value = prd_name;
        document.getElementById('set_flag').value = flag;
    
        alert("hi");
    }
</script>

@endsection
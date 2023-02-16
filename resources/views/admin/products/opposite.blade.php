@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Opposition Canisters</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Opposition Canisters </li>
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
                            <h3 class="card-title"><i class="fas fa-box-open"></i> Find Canister</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="{{ action('ProductController@searchProduct') }}">
                            {{ csrf_field() }} 
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="search_string">Find Product</label>
                                                <input type="text" class="form-control" id="search_oppositions" name="search_string" placeholder="Opposition Name">
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

                @if($pdn_flag == 0)
                    <div class="col-md-12 mb-3"> 
                        <a class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#product-modal"><i class="fa fa-dolly"></i> New Opposition Canister</a>
                        <button type="button" class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#exchange-modal"><a class="fa fa-exchange"></a> Trade Canisters</button>
                        <a class="btn btn-info col-md-1 col-12 float-right" href="{{ action('PrintController@alloppositeDetails') }}" target="_BLANK"><i class="fa fa-print"></i> Print</a>
                    </div>

                    <div class="col-md-12"> 
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-boxes"></i> Canisters</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                </div>
                            </div>
                            <div class="card-body" style="height:480px; overflow:auto;">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th width="20px"></th>
                                            <th>Opposition Name</th>
                                            <th>SKU</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th width="200px"></th>
                                            <th>Notes</th>
                                            <th>Active</th>
                                            <th width="100px"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl-opposition">
                                        @if(isset($oppositions))
                                            @foreach($oppositions as $opposition)
                                                <tr>
                                                    @if($opposition->ops_id)
                                                        <td>   
                                                            {{$opposition->ops_id}}
                                                        </td>
                                                    @else
                                                        <td>-</td>
                                                    @endif
                                                    @if($opposition->ops_name)
                                                        <td>   
                                                            {{$opposition->ops_name}}
                                                        </td>
                                                    @else
                                                        <td>-</td>
                                                    @endif
                                                    @if($opposition->ops_sku)
                                                        <td>   
                                                            {{$opposition->ops_sku}}
                                                        </td>
                                                    @else
                                                        <td>-</td>
                                                    @endif
                                                    @if($opposition->ops_description)
                                                        <td>   
                                                            {{$opposition->ops_description}}
                                                        </td>
                                                    @else
                                                        <td>-</td>
                                                    @endif
                                                    @if($opposition->ops_quantity)
                                                        <td style="text-align: left">   
                                                            {{$opposition->ops_quantity}}
                                                        </td>
                                                    @else
                                                        <td>-</td>
                                                    @endif
                                                    <td>
                                                        <!-- <button type="button" class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#exchange-modal-{{$opposition->ops_id}}"><a class="fa fa-exchange"></a> Trade Canisters</button> -->
                                                    </td>
                                                    @if($opposition->ops_notes)
                                                        <td>
                                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#notes-modal-{{$opposition->ops_id}}"><i class="fa fa-eye"></i></a>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <a href="javascript:void(0)" class="text-gray" style="cursor: not-allowed;" disabled><i class="fa fa-eye"></i></a>
                                                        </td>
                                                    @endif
                                                    <td>
                                                        @if($opposition->ops_active == 1) 
                                                            <span class="badge badge-success">Active</span>
                                                            <a class="fa fa-toggle-on" type="button" href="{{ action('ProductController@opsdeactivateProduct',[$opposition->ops_id])}}" aria-hidden="true"></a>
                                                        @else
                                                            <span class="badge badge-danger">Inactive</span>
                                                            <a class="fa fa-toggle-off" type="button" href="{{ action('ProductController@opsreactivateProduct',[$opposition->ops_id])}}" aria-hidden="true"></a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                    @if($opposition->ops_active == 0)
                                                        <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" disabled><i class="fa fa-ellipsis-vertical"></i></button>
                                                    @else   
                                                        <div class="dropdown">
                                                            <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" data-toggle="dropdown"><i class="fa fa-ellipsis-vertical"></i></button>
                                                            <ul class="dropdown-menu">
                                                                @if(session('typ_id') == '1' || session('typ_id') == '2')
                                                                <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#edit-opposition-modal-{{$opposition->ops_id}}"><i class="fa fa-edit mr-2" aria-hidden="true"></i>Edit Info</a></li>
                                                                @endif
                                                                <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#print-product-modal-{{$opposition->ops_id}}"><i class="fa fa-print mr-2" aria-hidden="true"></i>Print Info</a></li>
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    </td>
                                                    <!-- Edit Products Modal -->
                                                    <div class="modal fade" id="edit-opposition-modal-{{$opposition->ops_id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-md" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Opppositoin Form</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form method="POST" action="{{ action('ProductController@editOpposition') }}" enctype="multipart/form-data">
                                                                {{ csrf_field() }} 
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-12 text-center">
                                                                                    <img class="img-circle elevation-2" src="{{ asset('img/products/default.png') }}" alt="{{-- $opposite->ops_image --}}" style="max-height:150px; max-width:150px; min-height:150px; min-width:150px; object-fit:cover;"/>
                                                                                <div class="col-12 text-center mb-4">
                                                                                <a href="javascript:void(0);" class="">
                                                                                    <label class="btn btn-transparent btn-file">
                                                                                        <i id="btn_choose_file" class="fa fa-solid fa-camera mr-2"></i><small>Upload Photo </small>
                                                                                        <input type="file" class="custom-file-input" id="choose_file" name='prd_image' value="{{-- old('ops_image') --}}" aria-describedby="inputGroupFileAddon01" style="display: none;">
                                                                                    </label>
                                                                                </a>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label for="ops_name">Opposition Name <span style="color:red"> *</span></label>
                                                                                    <input type="text" class="form-control" name="ops_name" value="{{ $opposition->ops_name }}" />
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="ops_sku">SKU <span style="color:red"> *</span></label>
                                                                                    <input type="text" class="form-control" name="ops_sku" value="{{ $opposition->ops_sku }}" />
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="ops_description">Description <span style="color:red"> *</span></label>
                                                                                    <input type="text" class="form-control" name="ops_description" value="{{ $opposition->ops_description }}" />
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="ops_quantity">Quantity <span style="color:red"> *</span></label>
                                                                                    <input type="text" class="form-control" name="ops_quantity" value="{{ $opposition->ops_quantity }}" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="notes">Notes </label>
                                                                                    <textarea class="form-control" name="ops_notes" placeholder="Additional notes ..." value="{{ $opposition->ops_notes }}"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input type="text" class="form-control" name="ops_uuid" value="{{ $opposition->ops_uuid }}"  hidden/> 
                                                                        <input type="text" class="form-control" name="ops_id" value="{{ $opposition->ops_id }}" hidden/>        
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!--Notes Modal -->
                                                    <div class="modal fade modal-lg" id="notes-modal-{{$opposition->ops_id}}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                            {{ $opposition->ops_notes }}
                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Exchange Modal -->
                                                    <div class="modal fade" id="exchange-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Trade Canisters</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form method="POST" action="{{ action('ProductController@tradeCanisters') }}" enctype="multipart/form-data">
                                                                {{ csrf_field() }} 
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-5">
                                                                                <label for="filter_status">Opposite Canisters</label>
                                                                                <select class="form-control" id="filter_status" name="opposition_canister">
                                                                                    @foreach($oppositions as $opposition)
                                                                                        <option value="{{ $opposition->ops_id }}">{{ $opposition->ops_name }}</option>   
                                                                                    @endforeach 
                                                                                </select> 
                                                                                <div class="row">
                                                                                    <div class="form-group col-md-12 mt-2">
                                                                                        <input class="form-control" type="text" value="" placeholder="0" id="" name="trade_in_opposition_amount" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <div class="mx-auto">
                                                                                    <span class="fa fa-exchange"> </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-5">
                                                                                <label for="filter_status">Madayaw Canisters</label>
                                                                                <select class="form-control" id="filter_status" name="madayaw_canister">
                                                                                    @foreach($products as $product)
                                                                                        <option value="{{ $product->prd_id }}">{{ $product->prd_name }}</option>   
                                                                                    @endforeach  
                                                                                </select>

                                                                                <div class="row">
                                                                                    <div class="form-group col-md-12 mt-2">
                                                                                        <input class="form-control" type="text" value="" placeholder="0" id="" name="trade_in_madayaw_amount" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                                    </div>
                                                                </form>
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

<!-- Opposition Create Modal -->
<div class="modal fade show" id="product-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md show" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Opposition Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ action('ProductController@addOpposition') }}" enctype="multipart/form-data">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 text-center">
                                <img class="img-circle elevation-2" src="{{ asset('img/products/default.png') }}" alt="{{-- $opposition->ops_image --}}" style="max-height:150px; max-width:150px; min-height:150px; min-width:150px; object-fit:cover;"/>
                            <div class="col-12 text-center mb-4">
                            <a href="javascript:void(0);" class="">
                                <label class="btn btn-transparent btn-file">
                                    <i id="btn_choose_file" class="fa fa-solid fa-camera mr-2"></i><small>Upload Photo</small>
                                    <input type="file" class="custom-file-input" id="choose_file" name='ops_image' value="{{-- old('ops_image') --}}" aria-describedby="inputGroupFileAddon01" style="display: none;">
                                </label>
                            </a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ops_name">Opposition Name <span style="color:red"> *</span></label>
                                <input type="text" class="form-control" name="ops_name" placeholder="Enter Opposition Name" required/>
                            </div>
                            <div class="form-group">
                                <label for="ops_sku">SKU <span style="color:red"> *</span></label>
                                <input type="text" class="form-control" name="ops_sku" placeholder="Enter SKU" required/>
                            </div>
                            <div class="form-group">
                                <label for="ops_description">Description <span style="color:red"> *</span></label>
                                <input type="text" class="form-control" name="ops_description" placeholder="Enter Description" required/>
                            </div>
                            <div class="form-group">
                                <label for="ops_quantity">Quantity <span style="color:red"> *</span></label>
                                <input type="text" class="form-control" name="ops_quantity" value="Enter Quantity" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
                            </div>
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea name="ops_notes" placeholder="Additional notes ..." class="form-control"></textarea>
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

<!--Exchange Modal -->
<div class="modal fade" id="exchange-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Trade Canisters</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ action('ProductController@tradeCanisters') }}">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row w-100 justify-content-center align-items-center"> 
                                <label for="opposition-canisters" class="text-danger" >Opposite Canisters</label>
                            </div>
                            <select class="form-control" id="opposition-canisters" name="opposition_canister">
                                @foreach($oppositions as $opposition)
                                    <option value="{{ $opposition->ops_id }}">{{ $opposition->ops_name }}</option>
                                @endforeach   
                            </select> 
                            <div class="form-group mt-2">
                                <input class="form-control" type="number" value="0" id="" name="trade_in_opposite_amount" onclick="this.select()"/>
                            </div>
                        </div>
                        <div class="col-md-2 mx-auto">
                            <div class="container h-100">
                                <div class="row h-100 justify-content-center align-items-center"> 
                                    <span class="fa fa-exchange text-primary"> </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="row w-100 justify-content-center align-items-center"> 
                                <label for="madayaw-canisters" class="text-success">Madayaw Canisters</label>
                            </div>
                            <select class="form-control" id="madayaw-canisters" name="madayaw_canister">
                                @foreach($products as $product)
                                    <option value="{{ $product->prd_id }}">{{ $product->prd_name }}</option>
                                @endforeach   
                            </select>
                            <div class="row">
                                <div class="form-group col-md-12 mt-2">
                                    <input class="form-control" type="number" value="0" id="" name="trade_in_madayaw_amount" onclick="this.select()"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#search_oppositions").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tbl-opposition tr").filter(function() {
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
    // function getNewProductValue(prd_name, prd_sku, prd_description, prd_reorder){
    //     document.getElementById('sup_prd_name').value = prd_name;
    //     document.getElementById('sup_prd_sku').value = prd_sku;
    //     document.getElementById('sup_prd_description').value = prd_description;
    //     document.getElementById('sup_prd_reorder').value = prd_reorder;
    //     document.getElementById('sup_prd_is_production').value = is_production;
    //     document.getElementById('sup_prd_is_refillable').value = is_refillable;
    // }

    // function getNewProductValue(prd_name, prd_sku, prd_description, prd_reorder, is_production, is_refillable){
    //     document.getElementById('sup_prd_name').value = prd_name;
    //     document.getElementById('sup_prd_sku').value = prd_sku;
    //     document.getElementById('sup_prd_description').value = prd_description;
    //     document.getElementById('sup_prd_reorder').value = prd_reorder;
    //     document.getElementById('sup_prd_is_production').value = is_production;
    //     document.getElementById('sup_prd_is_refillable').value = is_refillable;
    // }
</script>

@endsection
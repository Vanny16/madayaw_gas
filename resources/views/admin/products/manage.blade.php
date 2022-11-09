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
                            <form class="form-horizontal" method="POST" action="">
                            {{ csrf_field() }} 
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="search_string">Find Product</label>
                                                <input type="text" class="form-control" id="search_products" name="search_string" placeholder="Product Name" required/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-success"><span class="fa fa-search"></span> Find</button> 
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3"> 
                    <a class="btn btn-primary col-md-2 col-12" href="javascript:void(0)" data-toggle="modal" data-target="#product-modal"><i class="fa fa-dolly"></i> New Product</a>

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
                        <div class="card-body" style="overflow-x:auto;">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Description</th>
                                        <th>SKU</th>
                                        <th>Quantity</th>
                                        <th>Supplier</th>
                                        <th width="120px"></th>
                                        <th width="120px"></th>
                                        <th width="100px"></th>
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
                                            @if($product->prd_description)
                                                <td>   
                                                    {{$product->prd_description}}
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
                                            @if($product->prd_quantity)
                                                <td>   
                                                    {{$product->prd_quantity}} pc/s
                                                </td>
                                            @else
                                                <td>0</td>
                                            @endif
                                            @if($product->sup_name)
                                                <td>   
                                                    {{$product->sup_name}}
                                                </td>
                                            @else
                                                <td>-</td>
                                            @endif
                                                <td>
                                                    <a class="btn btn-default btn-sm text-primary" href="javascript:void(0)" data-toggle="modal" data-target="#product-stockin-modal-{{$product->prd_id}}"><i class="fa fa-plus mr-1" aria-hidden="true"></i> Stock-in</a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-success">Active</span>
                                                    @if(session('typ_id') == '1' || session('typ_id') == '2') 
                                                    <a class="fa fa-toggle-on" type="button" href="" aria-hidden="true"></a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <div class="dropdown">
                                                            <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" data-toggle="dropdown"><i class="fa fa-ellipsis-vertical"></i></button>
                                                            <ul class="dropdown-menu">
                                                                @if(session('typ_id') == '1' || session('typ_id') == '2')
                                                                <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#edit-product-modal-{{$product->prd_id}}"><i class="fa fa-edit mr-2" aria-hidden="true"></i>Edit Info</a></li>
                                                                @endif
                                                                <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#print-customer-modal-{{$product->prd_id}}"><i class="fa fa-print mr-2" aria-hidden="true"></i>Print Info</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>

                                                <!-- Edit Products Modal -->
                                                <div class="modal fade" id="edit-product-modal-{{$product->prd_id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Product Form</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="POST" action="{{ action('ProductController@createProduct') }}">
                                                            {{ csrf_field() }} 
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="prd_name">Product Name <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="prd_name" placeholder="Enter Product Name" value="" required/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="prd_description">Description <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="prd_description" placeholder="Enter Description" value="" required/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="prd_sku">SKU <span style="color:red">*</span></label>
                                                                                <input type="text" class="form-control" name="prd_sku" placeholder="Enter SKU" value="" required/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="sup_id">Supplier <span style="color:red">*</span></label>
                                                                                <select class="form-control" id="suppliers" name="sup_id" required>
                                                                                    @foreach($suppliers as $supplier)
                                                                                        <option value="{{ $supplier->sup_id }}">{{ $supplier->sup_name }}</option>
                                                                                    @endforeach   
                                                                                </select> 
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
                                                                                <input type="number" class="form-control" name="prd_quantity" placeholder="Enter Quantity" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" required/>
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

<!-- Products Modal -->
<div class="modal fade" id="product-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ action('ProductController@createProduct') }}">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="prd_name">Product Name <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="prd_name" placeholder="Enter Product Name" value="" required/>
                            </div>
                            <div class="form-group">
                                <label for="prd_description">Description <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="prd_description" placeholder="Enter Description" value="" required/>
                            </div>
                            <div class="form-group">
                                <label for="prd_sku">SKU <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="prd_sku" placeholder="Enter SKU" value="" required/>
                            </div>
                            <div class="form-group">
                                <label for="sup_id">Supplier <span style="color:red">*</span></label>
                                <select class="form-control" id="suppliers" name="sup_id" required>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->sup_id }}">{{ $supplier->sup_name }}</option>
                                    @endforeach   
                                </select> 
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


<script>
    $(document).ready(function(){
        $("#search_products").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tbl-products tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

@endsection
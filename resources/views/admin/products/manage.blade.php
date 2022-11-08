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
                                            @if(isset($search_string))
                                                <input type="text" class="form-control" name="search_string" placeholder="Product Name" value="{{ $search_string }}" required/>
                                            @else
                                                <input type="text" class="form-control" name="search_string" placeholder="Product Name" required/>
                                            @endif
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>   
                                            Botin
                                        </td>
                                        <td>
                                            Gas Can
                                        </td>
                                        <td>
                                            BTNUSUH0987009
                                        </td>
                                        <td>
                                            100000
                                        </td>
                                        <td>
                                            <a class="btn btn-default btn-sm text-primary" href="javascript:void(0)" data-toggle="modal" data-target="#product-modal"><i class="fa fa-plus mr-1" aria-hidden="true"></i> Stock-in</a>
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
            <form method="POST" action="">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="prod_name">Product Name <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="prod_name" placeholder="Enter Product Name" value="" required/>
                            </div>

                            <div class="form-group">
                                <label for="prod_description">Description <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="prod_description" placeholder="Enter Description" value="" required/>
                            </div>

                            <div class="form-group">
                                <label for="prod_sku">SKU <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="prod_sku" placeholder="Enter SKU" value="" required/>
                            </div>

                            <div class="form-group">
                                <label for="prod_quantity">Quantity <span style="color:red">*</span></label>
                                <input type="number" class="form-control" name="prod_quantity" placeholder="Enter Quantity" value="" required/>
                            </div>

                            <div class="form-group">
                                <label for="cus_address">Notes <span style="color:red">*</span></label>
                                <textarea name="cus_notes" placeholder="Additional notes ..." class="form-control" required></textarea>
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

@endsection
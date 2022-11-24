@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tank</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Manage Tank</li>
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
                            <h3 class="card-title"><i class="fas fa-info-circle"></i> Tank Status</h3>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="200px">Tank Name</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tank 1</td>
                                        <td>
                                            <div class="bg-dark" style="width: 100%;">
                                                <div class="bg-success text-center" style="width: 30%;">&nbsp;
                                                </div>
                                            </div>
                                            <strong class="mr-2">30%</strong>
                                            <small class="float-right">1500/5000 kgs</small>
                                        </td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>      
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <a class="btn btn-primary col-md-2 col-12 mb-1" href="javascript:void(0)" data-toggle="modal" data-target="#add-tank-modal"><i class="fa fa-plus mr-1"></i> Add New Tank</a>
                </div>

                <div class="col-md-8"> 
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-gas-pump"></i> Tanks</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="50px">#</th>
                                        <th>Tank Name</th>
                                        <th>Type</th>
                                        <th>Capacity</th>
                                        <th>Remaining</th>
                                        <th width="50px"></th>
                                    </tr>
                                </thead>
                                <tbody id="tbl-products">
                                    <tr>
                                        <td class="text-danger">1</td>
                                        <td>Tank 1</td>
                                        <td>All Metal</td>
                                        <td>5000 kgs</td>
                                        <td>3210 kgs &nbsp;
                                            
                                        <a class="btn btn-default btn-sm text-danger" href="javascript:void(0)" data-toggle="modal" data-target="#refill-modal" disabled><i class="fa fa-gas-pump mr-1" aria-hidden="true"></i> Refill</a>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" data-toggle="dropdown"><i class="fa fa-ellipsis-vertical"></i></button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#print-product-modal-{{--$product->prd_id--}}"><i class="fa fa-edit mr-2" aria-hidden="true"></i>Edit Info</a></li>
                                                    <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#print-product-modal-{{--$product->prd_id--}}"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Deactivate</a></li>
                                                </ul>
                                            </div>
                                        </td>

                                        <!--Add Raw-Materials Modal -->
                                        <div class="modal fade" id="add-tank-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Add New Tank</h5>
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
                                                                        <label for="tank_name">Tank Name <span style="color:red">*</span></label>
                                                                        <input type="text" class="form-control" name="tank_name" placeholder="Tank Name" value="" required/>
                                                                    </div>
    
                                                                    <div class="form-group">
                                                                        <label for="type">Type <span style="color:red">*</span></label>
                                                                        <input type="text" class="form-control" name="type" placeholder="Type" value="" required/>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="capacity">Capacity <span style="color:red">*</span></label>
                                                                        <input type="text" class="form-control" name="capacity" placeholder="Stocks" value="" required/>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="remaining">Remaining <span style="color:red">*</span></label>
                                                                        <input type="text" class="form-control" name="sup_address" placeholder="Stocks" value="" required/>
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

                                        <!--Refill Modal -->
                                        <div class="modal fade" id="refill-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Refill Tank</h5>
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
                                                                            <label for="sup_address">Quantity <span style="color:red">*</span></label>
                                                                            <input type="text" class="form-control" name="sup_address" placeholder="Quantity" value="" required/>
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
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-4"> 
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-clock"></i> Operations</h3>
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
                                <!-- <div class="col-5 text-right text-white">
                                    <a class="btn btn-success btn-sm"><i class="fa fa-play mr-1"></i> Start</a>
                                </div> -->
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

@endsection
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
                            <h3 class="card-title"><i class="fas fa-user"></i> Find Customer</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="">
                            {{ csrf_field() }} 
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="search_string">Find Customer</label>
                                            @if(isset($search_string))
                                                <input type="text" class="form-control" name="search_string" placeholder="Name" value="{{ $search_string }}" required/>
                                            @else
                                                <input type="text" class="form-control" name="search_string" placeholder="Name" required/>
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
                    <a class="btn btn-primary col-md-2 col-12" href="javascript:void(0)" data-toggle="modal" data-target="#customer-modal"><i class="fa fa-user-plus"></i> New Customer</a>
                </div>

                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-users"></i> Customers</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="50px"></th>
                                        <th>Customer Name</th>
                                        <th>Contact #</th>
                                        <th>Address</th>
                                        <th width="100px">Status</th>
                                        <th width="100px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="user-panel">
                                                <div class="image">
                                                    <img src="{{ asset('images/employees/default.png') }}" class="img-circle elevation-2" alt="Customer Image">
                                                </div>
                                            </div>
                                        </td>
                                        <td>   
                                            Raevin Jhon Palacio
                                        </td>
                                        <td>
                                            09876543210
                                        </td>
                                        <td>
                                            Indangan, Davao City
                                        </td>
                                        <td>
                                            <span class="badge badge-success">Active</span>
                                            <i class="fa fa-toggle-on" aria-hidden="true"></i>
                                        </td>
                                        <td>
                                            <a class="btn btn-default btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#customer-modal"><i class="fa fa-key" aria-hidden="true"></i> Reset</a>
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


<!-- Customer Modal -->
<div class="modal fade" id="customer-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Customer Form</h5>
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
                                <label for="cus_name">Full Name <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="cus_name" placeholder="Enter Full Name" value="" required/>
                            </div>

                            <div class="form-group">
                                <label for="cus_address">Address <span style="color:red">*</span></label>
                                <input type="email" class="form-control" name="cus_address" placeholder="Enter Address" value="" required/>
                            </div>

                            <div class="form-group">
                                <label for="cus_address">Contact # <span style="color:red">*</span></label>
                                <input type="email" class="form-control" name="cus_address" placeholder="Enter Contact #" value="" required/>
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
@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Suppliers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Manage Supplier</li>
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
                            <h3 class="card-title"><i class="fas fa-warehouse"></i> Find Supplier</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" method="GET" action="">
                            {{ csrf_field() }} 
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="search_string">Find Supplier</label>
                                                <input type="text" class="form-control" id="search_suppliers" name="search_string" placeholder="Name"/>
                                        </div>

                                        <div class="col-md-2">
                                            <label for="filter_status">Status</label>
                                            <select class="form-control" id="filter_status" name="filter_status">
                                                {{-- @foreach($statuses as $status)
                                                    @if($status == $default_status) 
                                                        <option value="{{ $status }}" selected>{{ $status }}</option>
                                                    @else
                                                        <option value="{{ $status }}">{{ $status }}</option>
                                                    @endif
                                                @endforeach   --}}
                                                <option value="">All</option>
                                                <option value="">Active</option>
                                                <option value="">Inactive</option>
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

                <div class="col-md-12 mb-3"> 
                    <a class="btn btn-primary col-md-2 col-12 mb-1" href="javascript:void(0)" data-toggle="modal" data-target="#supplier-modal"><i class="fas fa-plus"></i> New Supplier</a>
                    <a class="btn btn-info col-md-1 col-12 float-right" href="{{ action('PrintController@allsupplierDetails') }}" target="_BLANK"><i class="fa fa-print"></i> Print</a>
                </div>

                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-warehouse"></i> Suppliers</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="50px"></th>
                                        <th>Supplier Name</th>
                                        <th>Contact #</th>
                                        <th>Address</th>
                                        <th>Notes</th>
                                        <th width="100px">Status</th>
                                        <th width="100px"></th>
                                    </tr>
                                </thead>
                                <tbody id="tbl-suppliers">
                                    @if(isset($suppliers))
                                        @foreach($suppliers as $supplier)
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#img-supplier-modal-{{$supplier->sup_id}}"><img src="{{ asset('img/users/default.png') }}" class="img-circle elevation-2" alt="User Image" height="30px"></a>
                                            </td>
                                            <td>   
                                                {{ $supplier->sup_name }}
                                            </td>
                                            @if($supplier->sup_contact)
                                                <td>
                                                    {{ $supplier->sup_contact }}
                                                </td>
                                            @else
                                                <td>-</td>
                                            @endif
                                            @if($supplier->sup_address)
                                            <td>
                                                {{ $supplier->sup_address }}
                                            </td>
                                            @else
                                                <td>-</td>
                                            @endif
                                            @if($supplier->sup_notes)
                                            <td>
                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#notes-modal-{{$supplier->sup_id}}"><i class="fa fa-eye"></i></a>
                                            </td>
                                            @else
                                            <td>-</td>
                                            @endif
                                            @if($supplier->sup_active == 0)
                                                <td>
                                                    <span class="badge badge-danger">Inactive</span>
                                                    <a class="fa fa-toggle-off" type="button" href="{{ action('SupplierController@reactivateSupplier',[$supplier->sup_id]) }}" aria-hidden="true"></a>
                                                </td>
                                            @else
                                                <td>
                                                    <span class="badge badge-success">Active</span>
                                                    <a class="fa fa-toggle-on" type="button" href="{{ action('SupplierController@deactivateSupplier',[$supplier->sup_id]) }}" aria-hidden="true"></a>
                                                </td>
                                            @endif
                                            <td>
                                                <div class="dropdown">
                                                    <div class="dropdown">
                                                        <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" data-toggle="dropdown"><i class="fa fa-ellipsis-vertical"></i></button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#edit-supplier-modal-{{$supplier->sup_id}}"><i class="fa fa-edit mr-2" aria-hidden="true"></i>Edit Info</a></li>
                                                            <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#print-supplier-modal-{{$supplier->sup_id}}"><i class="fa fa-print mr-2" aria-hidden="true"></i>Print Info</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        
                                            <!--Notes Modal -->
                                            <div class="modal fade" id="notes-modal-{{$supplier->sup_id}}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                    {{ $supplier->sup_notes }}
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <!--Edit Supplier Modal -->
                                            <div class="modal fade" id="edit-supplier-modal-{{$supplier->sup_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Supplier Form</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST" action="{{ action('SupplierController@editSupplier',[$supplier->sup_id])}}">
                                                        {{ csrf_field() }} 
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="sup_name">Suppliers Name <span style="color:red">*</span></label>
                                                                            <input type="text" class="form-control" name="sup_name" placeholder="Enter Supplier Name" value="{{$supplier->sup_name}}" required/>
                                                                        </div>
        
                                                                        <div class="form-group">
                                                                            <label for="sup_address">Address <span style="color:red">*</span></label>
                                                                            <input type="text" class="form-control" name="sup_address" placeholder="Enter Supplier Address" value="{{$supplier->sup_address}}" required/>
                                                                        </div>
        
                                                                        <div class="form-group">
                                                                            <label for="sup_contact">Contact <span style="color:red">*</span></label>
                                                                            <input type="text" name="sup_contact" class="form-control" placeholder="Enter Supplier Contact #" value="{{$supplier->sup_contact}}" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" minlength="11" maxlength="11" required></input>
                                                                        </div>
        
                                                                        <div class="form-group">
                                                                            <label for="sup_notes">Notes</label>
                                                                            <textarea name="sup_notes" placeholder="Additional notes ..." class="form-control" >{{$supplier->sup_notes}}</textarea>
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
    
                                            <!--Print Modal -->
                                            <div class="modal fade" id="print-supplier-modal-{{$supplier->sup_id}}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        
                                                        <div class="modal-body">
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                        <div class="col-md-2 col-12">
                                                                            <div class="image">
                                                                                <img src="{{ asset('img/suppliers/default.png') }}" class="img-circle elevation-2" alt="Supplier Image" height="100vh">
                                                                            </div>
                                                                        </div>
        
                                                                        <div class="col-md-10 col-12">
                                                                            <h3><strong style="text-transform:uppercase;">{{ $supplier->sup_name }}</strong></h3>
                                                                            <i class="text-default">
                                                                                {{ $supplier->sup_address }} <br>
                                                                                {{ $supplier->sup_contact }}
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a class="btn btn-info" href="{{ action('PrintController@supplierDetails',[$supplier->sup_uuid]) }}" target="_BLANK"><i class="fa fa-print"></i> Print</a>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!--Supplier-Profile Modal -->
                                            <div class="modal fade" id="img-supplier-modal-{{$supplier->sup_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Supplier Profile</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12 text-center">
                                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#avatarUploadModal">
                                                                        <img class="profile-user-img img-fluid img-circle" src="{{ asset('img/users/default.png') }}" alt="User profile picture"/>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                </div>
            </div>
        </section>
    </div>
    
    <!-- Supplier Modal -->
    <div class="modal fade" id="supplier-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Supplier Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ action('SupplierController@createSupplier')}}">
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
                </form>
            </div>
        </div>
    </div>
    <script>
    
    $(document).ready(function(){
            $("#search_suppliers").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#tbl-suppliers tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    
    </script>
    @endsection
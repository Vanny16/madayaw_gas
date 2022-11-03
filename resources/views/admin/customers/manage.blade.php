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
                                                <input id="search_customers" type="text" class="form-control" name="search_string" placeholder="Search ..." value="{{ $search_string }}"/>
                                            @else
                                                <input id="search_customers" type="text" class="form-control" name="search_string" placeholder="Search ..."/>
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
                                <tbody id="tbl-customers">
                                @if(isset($customers))
                                    @foreach($customers as $customer)
                                    <tr>
                                        <td>
                                            <div class="user-panel">
                                                <div class="image">
                                                    <img src="{{ asset('images/employees/default.png') }}" class="img-circle elevation-2" alt="Customer Image">
                                                </div>
                                            </div>
                                        </td>
                                        <td>   
                                            {{ $customer->cus_name }}
                                        </td>
                                        <td>
                                            {{ $customer->cus_contact }}
                                        </td>
                                        <td>
                                            {{ $customer->cus_address }}
                                        </td>
                                        @if($customer->cus_active == 0)
                                            <td>
                                                <span class="badge badge-danger">Inactive</span>
                                                <a class="fa fa-toggle-off" type="button" href="{{ action('CustomerController@reactivateCustomer',[$customer->cus_id]) }}" aria-hidden="true"></a>
                                            </td>
                                        @else
                                            <td>
                                                <span class="badge badge-success">Active</span>
                                                <a class="fa fa-toggle-on" type="button" href="{{ action('CustomerController@deactivateCustomer',[$customer->cus_id]) }}" aria-hidden="true"></a>
                                            </td>
                                        @endif
                                        <td>
                                            <div class="dropdown">
                                                <div class="dropdown">
                                                    <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" data-toggle="dropdown"><i class="fa fa-ellipsis-vertical"></i></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#edit-customer-modal"><i class="fa fa-edit mr-2" aria-hidden="true"></i>Edit Info</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr> 
                                        <!--Edit Customer Modal -->
                                        <div class="modal fade" id="edit-customer-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Customer Form</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{{ action('CustomerController@editCustomer')}}">
                                                    {{ csrf_field() }} 
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="cus_name">Full Name <span style="color:red">*</span></label>
                                                                        <input type="text" class="form-control" id="cus_name" placeholder="Enter Full Name" value="{{$customer->cus_name}}" required/>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="cus_address">Address <span style="color:red">*</span></label>
                                                                        <input type="text" class="form-control" id="cus_address" placeholder="Enter Address" value="{{$customer->cus_address}}" required/>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="cus_contact">Contact # <span style="color:red">*</span></label>
                                                                        <input type="number" class="form-control" id="cus_contact" placeholder="Enter Contact #" value="{{$customer->cus_contact}}" required/>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="cus_notes">Notes</label>
                                                                        <textarea id="cus_notes" placeholder="Additional notes ..." class="form-control"></textarea>
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
            <form method="POST" action="{{ action('CustomerController@createCustomer')}}">
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
                                <input type="text" class="form-control" name="cus_address" placeholder="Enter Address" value="" required/>
                            </div>

                            <div class="form-group">
                                <label for="cus_address">Contact # <span style="color:red">*</span></label>
                                <input type="text" name="cus_contact" class="form-control" placeholder="Enter Contact #" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" minlength="11" maxlength="11" required></input>
                            </div>

                            <div class="form-group">
                                <label for="cus_notes">Notes</label>
                                <textarea name="cus_notes" placeholder="Additional notes ..." class="form-control"></textarea>
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
        $("#search_customers").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tbl-customers tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

</script>
@endsection
{{-- @if(Session::has('emp_uuid')) --}}
<aside class="main-sidebar sidebar-light-primary elevation-4">
    {{-- Logo --}}
    <a href="{{ session('acc_website') }}" target="_blank" class="brand-link">
        <img src="{{ asset('images/accounts/' . session('acc_image')) }}" alt="Organization Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ session('acc_name') }}</span>
    </a>

    {{-- Sidebar  --}}
    <div class="sidebar">
        {{-- Sidebar user panel (optional) --}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(session('emp_image') <> '')
                    <img src="{{ asset('images/employees/' . session('emp_image')) }}" class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{ asset('images/employees/default.png') }}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="{{-- action('UserController@main') --}}" class="d-block"> {{ session('emp_full_name') }}</a>
            </div>
        </div>

        {{-- Sidebar Menu --}}
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
            
                <li class="nav-item">
                    <a href="{{ action('MainController@home') }}" class="nav-link">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            Home 
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p>Management <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ action('UserController@user') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>
                                    Users
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ action('CustomerController@manage') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>
                                    Customers
                                </p>
                            </a>
                        </li>


                        <!-- <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Users <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ action('MainController@home') }}" data-toggle="modal" data-target="#user-modal" class="nav-link">
                                        <i class="nav-icon fa fa-plus"></i>
                                        <p>
                                            Create New User
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ action('UserController@user') }}" class="nav-link">
                                        <i class="nav-icon fa fa-edit"></i>
                                        <p>
                                            Modify User
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-address-card"></i>
                                <p>Customers <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ action('MainController@home') }}" class="nav-link" data-toggle="modal" data-target="#customer-modal">
                                        <i class="nav-icon fa fa-plus"></i>
                                        <p>
                                            New Customer
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ action('CustomerController@manage') }}" class="nav-link">
                                        <i class="nav-icon fa fa-edit"></i>
                                        <p>
                                            Modify Customer
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li> -->
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ action('MainController@home') }}" class="nav-link">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>
                            Products
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ action('MainController@home') }}" class="nav-link">
                        <i class="nav-icon fas fa-truck-moving"></i>
                        <p>
                            Suppliers 
                        </p>
                    </a>
                </li>


            </ul>
        </nav>
    </div>
</aside>


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

<!--User Modal-->
<div class="modal fade" id="user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New User</h5>
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
                                <label for="usr_full_name">Full Name <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="usr_full_name" placeholder="Fullname" value="{{ old('usr_full_name') }}" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="usr_address">Address <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="usr_address" placeholder="Address" value="{{ old('usr_address') }}" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usr_username">Username <span style="color:red">*</span></label>
                                <input type="email" class="form-control" name="usr_username" value="{{ old('usr_username') }}" required/>
                            </div>
                        </div>    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usr_password">Password <span style="color:red">*</span></label>
                                <input type="email" class="form-control" name="usr_password" value="{{ old('usr_password') }}" required/>
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

{{--@else
    <script type="text/javascript">
        window.location = "{{ url('/') }}";
    </script>

 @endif --}}
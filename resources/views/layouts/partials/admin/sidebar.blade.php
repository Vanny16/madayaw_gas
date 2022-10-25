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
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Users <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ action('MainController@home') }}" data-toggle="modal" data-target="#addUserModal" class="nav-link">
                                        <i class="nav-icon fa fa-plus"></i>
                                        <p>
                                            Create New User
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ action('MainController@home') }}" data-toggle="modal" data-target="#editUserModal" class="nav-link">
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
                                    <a href="{{ action('MainController@home') }}" class="nav-link">
                                        <i class="nav-icon fa fa-plus"></i>
                                        <p>
                                            New Customer
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ action('MainController@home') }}" class="nav-link">
                                        <i class="nav-icon fa fa-edit"></i>
                                        <p>
                                            Modify Customer
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
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
{{--@else
    <script type="text/javascript">
        window.location = "{{ url('/') }}";
    </script>

 @endif --}}
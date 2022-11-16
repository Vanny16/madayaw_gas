{{-- @if(Session::has('emp_uuid')) --}}
<aside class="main-sidebar sidebar-light-primary elevation-4">
    {{-- Logo --}}
    <a href="{{ session('acc_website') }}" target="_blank" class="brand-link">
        <img src="{{ asset('img/accounts/logo-1.jpg' ) }}" alt="Organization Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{-- session('acc_name') --}} Madayaw Gas</span>
    </a>

    {{-- Sidebar  --}}
    <div class="sidebar">
        {{-- Sidebar user panel (optional) --}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(session('usr_image') <> '')
                    <img class="img-fluid img-circle elevation-2" src="{{ asset('img/users/' . session('usr_image')) }}" alt="{{ session('usr_image') }}" style="max-height:35px; max-width:35px; min-height:35px; min-width:35px; object-fit:cover;"/>
                @else
                    <img class="img-fluid img-circle elevation-2" src="{{ asset('img/users/default.png') }}" alt="User Image" style="max-height:35px; max-width:35px; min-height:35px; min-width:35px; object-fit:cover;"/>
                @endif
            </div>
            <div class="info">
                <a href="{{ action('UserController@profile')}}" class="d-block"> {{ session('usr_full_name') }}</a>
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

                {{--
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Calendar 
                        </p>
                    </a>
                </li>
                --}}
                
                <li class="nav-item">
                    <a href="{{ action('ProductController@manage') }}" class="nav-link">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>
                            Products
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ action('SupplierController@manage') }}" class="nav-link">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>
                            Suppliers 
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-address-card"></i>
                        <p>Accounts Manager <i class="right fas fa-angle-left"></i></p>
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
                    </ul>
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
{{-- @if(Session::has('emp_uuid')) --}}
<aside class="main-sidebar sidebar-light-primary elevation-4">
    {{-- Logo --}}
    <a href="{{ session('acc_website') }}" target="_blank" class="brand-link">
        <img src="{{ asset('img/accounts/logo-1.jpg' ) }}" alt="Organization Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{-- session('acc_name') --}} Madayaw Gas</span>
    </a>

    {{-- Sidebar  --}}
    <div class="sidebar" style="overflow: auto;">
        {{-- Sidebar user panel (optional) --}}
        <a href="{{ action('UserController@profile')}}" class="d-block"> 
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image text-center">
                    @if(session('usr_image') <> '')
                        <img class="img-fluid img-circle elevation-2" src="{{ asset('img/users/' . session('usr_image')) }}" alt="{{ session('usr_image') }}" style="max-height:35px; max-width:35px; min-height:35px; min-width:35px; object-fit:cover;"/>
                    @else
                        <img class="img-fluid img-circle elevation-2" src="{{ asset('img/users/default.png') }}" alt="User Image" style="max-height:35px; max-width:35px; min-height:35px; min-width:35px; object-fit:cover;"/>
                    @endif
                </div>
                <div class="info">
                    {{ session('usr_full_name') }}<br>
                    <small><i>{{-- session('typ_name') --}}</i></small>
                </div>
            </div>
        </a>
        <div class="my-custom-scrollbar-primary">
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
                
                <li class="nav-header">SALES</li>
                
                @if(session('typ_id') != '3')
                <li class="nav-item">
                    <a href="{{ action('SalesController@main') }}" class="nav-link">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>
                            Point of Sale
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ action('SalesController@paymentsToday') }}" class="nav-link">
                        <i class="nav-icon fas fa-coins"></i>
                        <p>
                            Payments
                        </p>
                    </a>
                </li>
                @endif

                @if(session('typ_id') == '1')
                <li class="nav-header">INVENTORY</li>

                <li class="nav-item">
                    <a href="{{ action('ProductController@manage') }}" class="nav-link">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>
                            Products
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ action('ProductController@opposite') }}" class="nav-link">
                        <i class="nav-icon fa fa-bitbucket"></i>
                        <p>
                            Opposition Canisters
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

                <li class="nav-item">
                    <a href="{{ action('ProductionController@tank') }}" class="nav-link">
                        <i class="nav-icon fa fa-gas-pump"></i>
                        <p>
                            Tank
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ action('ProductionController@manage') }}" class="nav-link">
                        <i class="nav-icon fas fa-pallet"></i>
                        <p>
                            Production
                        </p>
                    </a>
                </li>
                 
                <li class="nav-header">REPORTS</li>

                <li class="nav-item">
                    <form id="go_sales" method="GET" action="{{ action('ReportsController@salesToday')}}">
                    {{ csrf_field() }} 
                        <button href="" class="nav-link btn btn-transparent text-dark" onclick="go_sales.submit()">
                            <i class="nav-icon fa fa-bar-chart"></i>
                            <p>
                                Sales Reports
                            </p>
                        </button>
                    </form>
                </li>

                <li class="nav-item">
                    <form id="go_transactions" method="GET" action="{{ action('ReportsController@transactionsToday')}}">
                    {{ csrf_field() }} 
                        <button href="" class="nav-link btn btn-transparent text-dark" onclick="go_transactions.submit()">
                            <i class="nav-icon fa fa-bar-chart"></i>
                            <p>
                                Transaction Reports
                            </p>
                        </button>
                    </form>
                </li>

                <li class="nav-item">
                    <form id="go_productions" method="POST" action="{{ action('ReportsController@production') }}">
                    {{ csrf_field() }}
                        <button href="" class="nav-link btn btn-transparent text-dark" onclick="go_productions.submit()">
                            <i class="nav-icon fa fa-bar-chart"></i>
                            <p>
                                Production Reports
                            </p>
                        </button>
                    </form>
                </li>
                
                <li class="nav-header">ACCOUNTS</li>

                <li class="nav-item">
                    <a href="{{ action('UserController@user') }}" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Users @if(session('reset_passwords_count') != 0)<span class="badge badge-danger ml-2">{{ session('reset_passwords_count') }}</span>@endif
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ action('CustomerController@manage') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-tag"></i>
                        <p>
                            Customers
                        </p>
                    </a>
                </li>

                @endif

            </ul>
        </nav>
    </div>
    <div class="col-12 mb-5">&nbsp;</div>
</aside>

{{--@else
    <script type="text/javascript">
        window.location = "{{ url('/') }}";
    </script>

 @endif --}}
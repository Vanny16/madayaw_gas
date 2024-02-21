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
                        <i class="nav-icon fa fa-bullhorn"></i>
                        <p>
                            News & Announcements 
                        </p>
                    </a>
                </li>

                <?php $state = ""; if(check_production_log()){$state = "disabled";}?>
                
                @if(session('typ_id') != '3')
                <li class="nav-header">SALES</li>

                <li class="nav-item">
                    @if($state == "disabled")
                        {{-- <a id="sales-link" class="nav-link bg-muted"></a> --}}
                        <a id="sales-link" class="nav-link">
                            <i class="nav-icon fas fa-cash-register"></i>
                            <p class="text-muted">
                                Point of Sale
                            </p>
                        </a>
                    @else
                        <a id="{{-- sales-link --}}" href="{{ action('SalesController@main') }}" class="nav-link">
                            <i class="nav-icon fas fa-cash-register"></i>
                            <p>
                                Point of Sale
                            </p>
                        </a>
                    @endif
                </li>

                {{-- <li class="nav-item">
                    <button href="{{ action('SalesController@main') }}" class="nav-link">
                        <i class="nav-icon fas fa-coins"></i>
                        <p>
                            test
                        </p>
                    </button>
                </li> --}}

                <li class="nav-item">
                    <a href="{{ action('ReportsController@paymentsToday') }}" class="nav-link">
                        <i class="nav-icon fas fa-coins"></i>
                        <p>
                            Payments
                        </p>
                    </a>
                </li>
                @endif

                @if(session('typ_id') == '1' || session('typ_id') == '5' || session('typ_id') == '4')
                    <li class="nav-header">INVENTORY</li>
                @endif

                @if(session('typ_id') == '1' || session('typ_id') == '5' || session('typ_id') == '4')
                    <li class="nav-item">
                        <a href="{{ action('ProductController@manage') }}" class="nav-link">
                            <i class="nav-icon fas fa-box-open"></i>
                            <p>
                                Products
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        {{-- <form id="go_oppositions" method="POST" action="{{ action('OppositionController@opposite') }}">
                            {{ csrf_field() }}
                            <button href="" class="nav-link btn btn-transparent text-dark" style="background-color:transparent; color: #0d6efd;"onclick="go_oppositions.submit()">
                                <i class="nav-icon fa fa-bitbucket"></i>
                                <p>
                                Opposition Canisters
                                </p>
                            </button>
                        </form> --}}
                        <a href="{{ action('OppositionController@opposite') }}" class="nav-link">
                            <i class="nav-icon fa fa-bitbucket"></i>
                            <p>
                                Opposition Canisters
                            </p>
                        </a>
                    </li>
                    
                    @if (session('typ_id') == 1)
                        <li class="nav-item">
                            <a href="{{ action('SupplierController@manage') }}" class="nav-link">
                                <i class="nav-icon fas fa-warehouse"></i>
                                <p>
                                    Suppliers 
                                </p>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a href="{{ action('ProductionController@tank') }}" class="nav-link">
                            <i class="nav-icon fa fa-gas-pump"></i>
                            <p>
                                Tank
                            </p>
                        </a>
                    </li>
                @endif

                {{-- for employee access on oppositions --}}
                @if(session('typ_id') == '2')
                    <li class="nav-item">
                        {{-- <form id="go_oppositions" method="POST" action="{{ action('OppositionController@opposite') }}">
                            {{ csrf_field() }}
                            <button href="" class="nav-link btn btn-transparent text-dark" style="background-color:transparent; color: #0d6efd;"onclick="go_oppositions.submit()">
                                <i class="nav-icon fa fa-bitbucket"></i>
                                <p>
                                Opposition Canisters
                                </p>
                            </button>
                        </form> --}}
                        <a href="{{ action('OppositionController@opposite') }}" class="nav-link">
                            <i class="nav-icon fa fa-bitbucket"></i>
                            <p>
                                Opposition Canisters
                            </p>
                        </a>
                    </li>
                @endif

                @if(session('typ_id') == '1' || session('typ_id') == '5' || session('typ_id') == '4')
                <li class="nav-item">
                    <a href="{{ action('ProductionController@manage') }}" class="nav-link">
                        <i class="nav-icon fas fa-pallet"></i>
                        <p>
                            Production
                        </p>
                    </a>
                </li>
                @endif
                 
                @if(session('typ_id') == '1' || session('typ_id') == '5'){{-- || session('typ_id') == '4'--}}
                <li class="nav-header">REPORTS</li>
                @endif

                @if(session('typ_id') == '1' || session('typ_id') == '5'){{-- || session('typ_id') == '4'--}}
                <li class="nav-item">
                    <a href="{{ action('ReportsController@salesToday') }}" class="nav-link">
                        <i class="nav-icon fa fa-bar-chart"></i>
                        <p>
                            Sales Reports
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ action('ReportsController@transactionsToday') }}" class="nav-link">
                        <i class="nav-icon fa fa-bar-chart"></i>
                        <p>
                            Transactions Reports
                        </p>
                    </a>
                </li>

                @endif

                @if(session('typ_id') == '1' || session('typ_id') == '5') {{-- || session('typ_id') == '4'--}}
                <li class="nav-item">
                    <form id="go_productions" action="{{ action('ReportsController@production') }}">
                    {{ csrf_field() }}
                        <button href="" class="nav-link btn btn-transparent text-dark" onclick="go_productions.submit()">
                            <i class="nav-icon fa fa-bar-chart"></i>
                            <p>
                                Production Reports
                            </p>
                        </button>
                    </form>
                </li>
                @endif
                
                @if(session('typ_id') == '1')
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
<script>
    $(document).ready(function() {
        $("#sales-link").on("click", function(event) {
            // Prevent default navigation behavior
            event.preventDefault();

            // Disable the link to prevent double-clicking
            // $(this).prop("disabled", true);

            // Optionally, you can add a class to style the disabled link
            // $(this).addClass("disabled");

            // Perform any other actions you need here
            // ...

            // After some time, you can re-enable the link if needed
            setTimeout(function() {
                $("#sales-link").prop("disabled", false);
                $("#sales-link").removeClass("disabled");
            }, 5000); // Adjust the delay time as needed
        });
    });

    document.getElementById('sales-link').addEventListener('click', function(event) {
        document.getElementById('sales-link').prop("disabled", true);
        event.preventDefault(); // Prevent the default navigation behavior
    // You can add any additional logic or actions here
});

</script>
{{--@else
    <script type="text/javascript">
        window.location = "{{ url('/') }}";
    </script>

 @endif --}}
@extends('layouts.themes.admin.print')
@section('content')
<div class="row">
    <div class="col-md-12"> 
        <h3 style="text-align:center;"></h3>
        <p style="text-align:center;"></p>
    </div>
    <div class="col-md-12"> 
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        
                        <table>
                            <tr>
                                <td><img src="{{ asset('img/accounts/logo-1.jpg' ) }}" style="width:70px;"></td>
                                <td colspan="2">&nbsp; </td>
                                <td>
                                    <p class="ml-2">
                                        <strong>MADAYAW PETROLEUM AND GAS CORPORATION</strong><br>
                                        <small>Park Avenue Cor. Lakatan St., Brgy. Wilfredo Aquino, Agdao, Davao City</small>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <hr><br>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-file-text-o"></i> <strong>CANISTER DAILY ACTIVITY REPORT </strong></h3>
                        <div class="card-tools">
                            <div class="row"> <p>Date: </p>&nbsp<strong class="mx-auto">{{$production_date}}</strong> <br> </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="col-5" style=" background-color: #2489b3">
                            <p style="color:white">PART 1: FILLING PLANT PRODUCTION</p>
                        </div>
                        <div class="col-7">

                        </div>
                    </div>
                    <div class="card">
                        <!-- Canisters -->
                        <div class="card-body" > <!-- style="overflow-x:auto;" -->
                            <table class="table table-hover table-condensed">
                                <hr>
                                <thead>
                                    <tr>
                                        <th colspan = "3"></th>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <th>{{$canister->prd_name}}</th>
                                            @endforeach
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan = "3"><i>Opening Canister Stock</i></td>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <td>{{ number_format($canister->prd_quantity, 0, '.', ',') }}</td>
                                            @endforeach
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-body" style="overflow-x:auto;">
                            <table class="table table-hover table-condensed">
                                <hr>
                                <thead>
                                    <tr>
                                        <th>Canister</th>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <th>{{$canister->prd_name}}</th>
                                            @endforeach
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><i>Filled</i></td>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <td>{{ number_format($canister->prd_quantity, 0, '.', ',') }}</td>
                                            @endforeach
                                        @endif
                                    </tr>
                                    <tr>
                                        <td><i>Leakers</i></td>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <td>{{ number_format($canister->prd_leakers, 0, '.', ',') }}</td>
                                            @endforeach
                                        @endif
                                    </tr>
                                    <tr>
                                        <td><i>Empty</i></td>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <td>{{ number_format($canister->prd_empty_goods, 0, '.', ',') }}</td>
                                            @endforeach
                                        @endif
                                    </tr>
                                    <tr>
                                        <td><i>For Revalving</i></td>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <td>{{ number_format($canister->prd_for_revalving, 0, '.', ',') }}</td>
                                            @endforeach
                                        @endif
                                    </tr>
                                    <tr>
                                        <td><i>Scrap</i></td>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <td>{{ number_format($canister->prd_scraps, 0, '.', ',') }}</td>
                                            @endforeach
                                        @endif
                                    </tr>
                                    <tr>
                                        <td><b>Total Stocks</b></td>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <strong><th>{!! get_product_total_stock($canister->prd_id) !!}</th></strong>
                                            @endforeach
                                        @endif
                                    </tr>
                                    <tr>
                                        <td colspan=<?php echo count($canisters) + 1 ?>><b>Opposition Canisters</b></td>
                                    </tr>
                                    @if(isset($oppositions))
                                        @foreach($oppositions as $opposition)
                                            <tr>
                                                <td><i>{{ $opposition->ops_name }}</i></td>
                                                <td colspan=<?php echo count($canisters) + 1 ?>>{{ number_format($opposition->ops_quantity, 0, '.', ',') }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <hr>
                            <br>
                            <div class="text-center"><h5>Total Canister Population: <h2>{!! get_total_stock_report() !!}</h2></h5></div>
                        </div>

                        <!-- Canisters -->
                        <div class="row mb-3 mt-5">
                            <div class="col-12 text-center bg-info">
                                <p><i class="fa fa-fill-drip mt-3"></i> Filled Canisters</p>
                            </div>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>Stock Status</th>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <th>{{$canister->prd_name}}</th>
                                            @endforeach
                                        @endif
                                    </tr>
                                </thead>
                                <tbody id="tbl-products">
                                    @php($production_id = get_last_production_id())
                                    @php($stocks_flag = 1)
                                    <tr>
                                        <td><i>Opening Stocks</i></td>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <td>{!! get_opening_stock($canister->prd_id, $production_id) !!}</td>
                                            @endforeach
                                        @endif
                                    </tr>
                                    @php($stocks_flag = 2)
                                    <tr>
                                        <td><i>Closing Stocks</i></td>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <td>{!! get_closing_stock($canister->prd_id, $production_id) !!}</td>
                                            @endforeach
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Tank -->
                        <div class="row mb-3">
                            <div class="col-12 text-center bg-info">
                                <p class=""><i class="fa fa-gas-pump mt-3"></i> Tank</p>
                            </div>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>Tank Name</th>
                                        <th>Tank Opening</th>
                                        <th>Tank Closing</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($tanks))
                                        @foreach($tanks as $tank)
                                            <tr>
                                                <td><i>{{$tank->tnk_name}}</i></td>
                                                <td>{!! get_opening_tank($tank->tnk_id, get_last_production_id()) !!} kg</td>
                                                <td>{!! get_closing_tank($tank->tnk_id, get_last_production_id()) !!} kg</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div>
            {{--<div class="card-body">
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Canister </th>
                            <th colspan="2" class="text-center" style="min-width: 250px;">Filled</th>
                            <th colspan="2" class="text-center" style="min-width: 250px;">Leakers</th>
                            <th colspan="2" class="text-center" style="min-width: 250px;">Empty</th>
                            <th colspan="2" class="text-center" style="min-width: 250px;">For Revalving</th>
                            <th colspan="2" class="text-center" style="min-width: 250px;">Scraps</th>
                            <th colspan="2" class="text-center" style="min-width: 250px;">Total Stocks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td class="text-center"><em>Plant Manager</em></td>
                            <td class="text-center"><em>Supervisor</em></td>
                            <td class="text-center"><em>Plant Manager</em></td>
                            <td class="text-center"><em>Supervisor</em></td>
                            <td class="text-center"><em>Plant Manager</em></td>
                            <td class="text-center"><em>Supervisor</em></td>
                            <td class="text-center"><em>Plant Manager</em></td>
                            <td class="text-center"><em>Supervisor</em></td>
                            <td class="text-center"><em>Plant Manager</em></td>
                            <td class="text-center"><em>Supervisor</em></td>
                            <td class="text-center"><em>Plant Manager</em></td>
                            <td class="text-center"><em>Supervisor</em></td>
                        </tr>
                        @foreach($canisters as $canister)
                            <tr>
                                <td><i>{{$canister->prd_name}}</i></td>
                                @foreach($pm_product_verifications as $verification)
                                    @if($verification->verify_prd_id == $canister->prd_id && $verification->verify_is_product == 1)
                                    
                                        @if(($verification->verify_user_type == 3 || $verification->verify_user_type == 5) && $verification->verify_is_product == 1)
                                            <td>{{$verification->verify_opening_filled}}</td>
                                        @elseif($verification->verify_user_type == 4 && $verification->verify_is_product == 1)
                                            <td>{{$verification->verify_opening_filled}}</td>
                                        @endif

                                        @if(($verification->verify_user_type == 3 || $verification->verify_user_type == 5) && $verification->verify_is_product == 1)
                                            <td>{{$verification->verify_opening_leakers}}</td>
                                        @elseif($verification->verify_user_type == 4 && $verification->verify_is_product == 1)
                                            <td>{{$verification->verify_opening_leakers}}</td>
                                        @endif

                                        @if(($verification->verify_user_type == 3 || $verification->verify_user_type == 5) && $verification->verify_is_product == 1)
                                            <td>{{$verification->verify_opening_empty}}</td>
                                        @elseif($verification->verify_user_type == 4 && $verification->verify_is_product == 1)
                                            <td>{{$verification->verify_opening_empty}}</td>
                                        @endif
                                        
                                        @if(($verification->verify_user_type == 3 || $verification->verify_user_type == 5) && $verification->verify_is_product == 1)
                                            <td>{{$verification->verify_opening_for_revalving}}</td>
                                        @elseif($verification->verify_user_type == 4 && $verification->verify_is_product == 1)
                                            <td>{{$verification->verify_opening_for_revalving}}</td>
                                        @endif

                                        @if(($verification->verify_user_type == 3 || $verification->verify_user_type == 5) && $verification->verify_is_product == 1)
                                            <td>{{$verification->verify_opening_scraps}}</td>
                                        @elseif($verification->verify_user_type == 4 && $verification->verify_is_product == 1)
                                            <td>{{$verification->verify_opening_scraps}}</td>
                                        @endif

                                        @if(($verification->verify_user_type == 3 || $verification->verify_user_type == 5) && $verification->verify_is_product == 1)
                                            <td>{{$verification->verify_opening}}</td>
                                        @elseif($verification->verify_user_type == 4 && $verification->verify_is_product == 1)
                                            <td>{{$verification->verify_opening}}</td>
                                        @endif
                                    @endif
                                @endforeach
                            </tr>
                            
                        @endforeach

                        {{-- <tr><td class="text-center"><strong> Closing Stocks </strong></td></tr>
                        
                        <tr>
                            <td><i>{{$canister->prd_name}}</i></td>
                            @foreach($product_verifications as $verification)
                                @if($verification->verify_prd_id == $canister->prd_id && $verification->verify_is_product == 1)
                                    
                                    @if(($verification->verify_user_type == 3 || $verification->verify_user_type == 5) && $verification->verify_is_product == 1)
                                        <td>{{$verification->verify_closing_filled}}</td>
                                    @elseif($verification->verify_user_type == 4 && $verification->verify_is_product == 1)
                                        <td>{{$verification->verify_closing_filled}}</td>
                                    @endif

                                    @if(($verification->verify_user_type == 3 || $verification->verify_user_type == 5) && $verification->verify_is_product == 1)
                                        <td>{{$verification->verify_closing_leakers}}</td>
                                    @elseif($verification->verify_user_type == 4 && $verification->verify_is_product == 1)
                                        <td>{{$verification->verify_closing_leakers}}</td>
                                    @endif

                                    @if(($verification->verify_user_type == 3 || $verification->verify_user_type == 5) && $verification->verify_is_product == 1)
                                        <td>{{$verification->verify_closing_empty}}</td>
                                    @elseif($verification->verify_user_type == 4 && $verification->verify_is_product == 1)
                                        <td>{{$verification->verify_closing_empty}}</td>
                                    @endif
                                    
                                    @if(($verification->verify_user_type == 3 || $verification->verify_user_type == 5) && $verification->verify_is_product == 1)
                                        <td>{{$verification->verify_closing_for_revalving}}</td>
                                    @elseif($verification->verify_user_type == 4 && $verification->verify_is_product == 1)
                                        <td>{{$verification->verify_closing_for_revalving}}</td>
                                    @endif

                                    @if(($verification->verify_user_type == 3 || $verification->verify_user_type == 5) && $verification->verify_is_product == 1)
                                        <td>{{$verification->verify_closing_scraps}}</td>
                                    @elseif($verification->verify_user_type == 4 && $verification->verify_is_product == 1)
                                        <td>{{$verification->verify_closing_scraps}}</td>
                                    @endif

                                    @if(($verification->verify_user_type == 3 || $verification->verify_user_type == 5) && $verification->verify_is_product == 1)
                                        <td>{{$verification->verify_closing}}</td>
                                    @elseif($verification->verify_user_type == 4 && $verification->verify_is_product == 1)
                                        <td>{{$verification->verify_closing}}</td>
                                    @endif
                                @endif
                            @endforeach
                        </tr> --}}

                    </tbody>
                </table>
            </div>--}}
        </div>
    </div>
</div>
<script type="text/javascript">
    // Define a function to handle the beforeprint event
    function handleBeforePrint() {
        // Remove the event listener to prevent an infinite loop
        window.removeEventListener("beforeprint", handleBeforePrint);

        // Display a confirmation dialog to allow the user to select print settings
        if (confirm("Click 'OK' to show preview")) {
            // Open the print dialog
            setTimeout(function() {
                window.print();
            }, 500);
        }
        else{
            window.location.href = "{{ action('ProductionController@manage') }}";
        }
    }

    // Add an event listener for the beforeprint event
    window.addEventListener("beforeprint", handleBeforePrint);

    // Call the print method when the page finishes loading
    window.addEventListener("load", function() {
        setTimeout(function() {
            window.print();
            window.location.href = "{{ action('ProductionController@manage') }}";
        }, 500);
    });
</script>
@endsection
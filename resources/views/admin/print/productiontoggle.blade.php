@extends('layouts.themes.admin.print')
@section('content')
<div class="row">
    <div class="col-md-12"> 
        <h3 style="text-align:center;"></h3>
        <p style="text-align:center;"></p>
    </div>
    <div class="col-md-12"> 
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    
                    <table>
                        <tr>
                            <td><img src="{{ asset('img/accounts/logo-1.jpg' ) }}" style="width:70px;"></td>
                            <td colspan="2">&nbsp; </td>
                            <td>
                                <h4 class="ml-2">
                                    <strong>MADAYAW PETROLEUM AND GAS CORPORATION</strong><br>
                                </h4>
                                <p class="ml-2">
                                    
                                    <small>Park Avenue Cor. Lakatan St., Brgy. Wilfredo Aquino, Agdao, Davao City</small>
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <hr><br>
            <div class="row">
                <div class="col-md-6"><h3 class="ml-2">
                    <i class="fa fa-file-text-o"></i> <strong>CANISTER DAILY ACTIVITY REPORT </strong></h3>
                </div>
                <div class="col-md-6 align-items-center">
                    <div class="col-md-12 d-flex justify-content-end">
                        <p>Date: </p>&nbsp<strong style="text-decoration:underline">{{$production_date}}</strong> <br> 
                    </div>
                </div>
            </div>
            <br>
            <div class="d-flex align-items-center">
                <h4><strong>PART 1: FILLING PLANT PRODUCTION</strong></h4>
            </div>
            <!-- Canisters -->
            
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th colspan = "2"></th>
                            @if(isset($canisters))
                                @foreach($canisters as $canister)
                                    <th>{{$canister->prd_name}}</th>
                                @endforeach
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan = "2"><i>Opening Filled Canister Stock</i></td>
                            @if(isset($canisters))
                                @foreach($canisters as $canister)
                                    <td>{{ number_format($canister->prd_quantity, 0, '.', ',') }}</td>
                                @endforeach
                            @endif
                        </tr>
                    </tbody>
                </table>
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th colspan="2" style="text-align:center"><i>CUSTOMER</i></td>
                            <th colspan="2" style="text-align:center"><i>DOCUMENT NO.</i></th>
                            @if(isset($canisters))
                                @foreach($canisters as $canister)
                                    <th><strong>{{$canister->prd_name}}</strong></th>
                                @endforeach
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchases_array as $purchase_array)
                            <tr>
                                <td colspan="2" style="text-align:center"><i>{{ $purchase_array[0] }}</i></td>
                                <td colspan="2" style="text-align:center"><i>{{ $purchase_array[1] }}</i></td>
                                @for($index = 2; $index < count($purchase_array); $index++)
                                    <td><strong>{{$purchase_array[$index]}}</strong></td>    
                                @endfor
                            </tr>
                        @endforeach
                    </thead>
                </table>
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th colspan = "2"></th>
                            @if(isset($canisters))
                                @foreach($canisters as $canister)
                                    <th>{{$canister->prd_name}}</th>
                                @endforeach
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan = "2"><i>Closing Filled Canister Stock</i></td>
                            @if(isset($canisters))
                                @foreach($canisters as $canister)
                                    <td>{{ number_format($canister->prd_quantity, 0, '.', ',') }}</td>
                                @endforeach
                            @endif
                        </tr>
                    </tbody>
                </table>
            

            <br>
            <div class="d-flex align-items-center">
                <h4><strong>PART 2: EMPTY CANISTER MOVEMENT</strong></h4>
            </div>
            
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th colspan="4" style="text-align:center">RECEIVED</th>
                            @if(isset($canisters))
                                @foreach($canisters as $canister)
                                    <th></th>
                                @endforeach
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2" style="text-align:center"><i>CUSTOMER</i></td>
                            <td colspan="2" style="text-align:center"><i>DOCUMENT NO.</i></td>
                            @if(isset($canisters))
                                @foreach($canisters as $canister)
                                    <td><strong>{{$canister->prd_name}}</strong></td>
                                @endforeach
                            @endif
                            
                        </tr>
                    </tbody>
                    <thead>
                        <tr>
                            <th colspan="4" style="text-align:center">ISSUED</th>
                            @if(isset($canisters))
                                @foreach($canisters as $canister)
                                    <th></th>
                                @endforeach
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2" style="text-align:center"><i>CUSTOMER</i></td>
                            <td colspan="2" style="text-align:center"><i>DOCUMENT NO.</i></td>
                            @if(isset($canisters))
                                @foreach($canisters as $canister)
                                    <td><strong>{{$canister->prd_name}}</strong></td>
                                @endforeach
                            @endif
                        </tr>
                        <tr>
                            <!-- add forloop here for how many customers ordered  -->
                            @foreach($issued_customers_array as $customers_array)
                            <tr>
                                <td colspan="2" style="text-align:center"><i>{{ $customers_array[0] }}</i></td>
                                <td colspan="2" style="text-align:center"><i>{{ $customers_array[1] }}</i></td>
                                @for($index = 2; $index < count($customers_array); $index++)
                                    <td><strong>{{$customers_array[$index]}}</strong></td>    
                                @endfor
                            </tr>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            <br>
            <div class="d-flex align-items-center">
                <h4><strong>PART 3: CANISTER MOVEMENT</strong></h4>
            </div>
            <table class="table table-hover table-condensed">
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
                </tbody>
            </table>
            <div class="text-center">
                <p><strong>Total Canister Population: </strong><h4>{!! get_total_canister_report() !!}</h4></p>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-2">
                    <div class="text-center">
                        <h5><strong>BRAND NEW</strong></h5>
                    </div>
                </div>
                <div class="col-md-1">
                    <h5 style="text-align:center"><strong>|</strong></h5>
                </div>
                <div class="col-md-9 d-flex justify-content-center">
                    <div class="col-md-4" style="text-align:center">
                        <p style="text-decoration:underline"><strong>Valve: </strong>{!! get_total_canister_report() !!}</p>
                    </div>
                    <div class="col-md-4" style="text-align:center">
                        <p style="text-decoration:underline"><strong>Seal: </strong>{!! get_total_canister_report() !!}</p>
                    </div>
                    <div class="col-md-4" style="text-align:center">
                        <p style="text-decoration:underline"><strong>Crates: </strong>{!! get_total_canister_report() !!}</p>
                    </div>
                </div>
            </div>
            <hr><br>
            <div class="d-flex align-items-center">
                <h4><strong>PART 4: OPPOSITION CANISTERS</strong></h4>
            </div>
            <table class="table table-hover table-condensed">
                <thead>
                <tr>
                        @if(isset($oppositions))
                            @foreach($oppositions as $opposition)
                                <th>{{$opposition->ops_name}}</th>
                            @endforeach
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @if(isset($oppositions))
                            @foreach($oppositions as $opposition)
                                <td>{{ number_format($opposition->ops_quantity, 0, '.', ',') }}</td>
                            @endforeach
                        @endif
                    </tr>
                </tbody>
            </table>
            <div class="text-center" style="page-break-inside:avoid">
                <p><strong>Total Opposition Population: </strong><h4>{!! get_total_opposition_report($canister->prd_id) !!}</h4></p>
            </div>
            <div style="page-break-inside:avoid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex justify-content-center">
                            <h5><strong>Time Start Ops</strong></h5>
                        </div>
                        <div class="col-md-12 d-flex justify-content-center">
                            <strong class="text-success">{{$production_start}}</strong> <br> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-center">
                            <h5><strong>Time End Ops</strong></h5>
                        </div>
                        <div class="col-md-12 d-flex justify-content-center">
                            <strong class="text-danger">{{$production_end}}</strong> <br> 
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-5">
                        <div class="row">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <th style="text-align:center">Tank Opening %</th>
                                    <th style="text-align:center">%</th>
                                    <th style="text-align:center">VOL</th>
                                </thead>
                                <tbody>
                                    @if(isset($tanks))
                                        @foreach($tanks as $tank)
                                            @php($tank_percentage = (($tank->log_tnk_opening) / ($tank->tnk_capacity)) * 100)
                                            @php($converted_volume = ($tank->log_tnk_opening) / 1000)
                                            <tr>
                                                <td style="text-align:center">{{ $tank->tnk_name }}</td>
                                                <td style="text-align:center">{{ $tank_percentage }}%</td>
                                                <td style="text-align:center">{{ $converted_volume }} kg</td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <div class="row">
                        <table class="table table-hover table-condensed">
                                <thead>
                                    <th style="text-align:center">Tank Closing %</th>
                                    <th style="text-align:center">%</th>
                                    <th style="text-align:center">VOL</th>
                                </thead>
                                <tbody>
                                    @if(isset($tanks))
                                        @foreach($tanks as $tank)
                                            @php($tank_percentage = (($tank->log_tnk_closing) / ($tank->tnk_capacity)) * 100)
                                            @php($converted_volume = ($tank->log_tnk_closing) / 1000)
                                            <tr>
                                                <td style="text-align:center">{{ $tank->tnk_name }}</td>
                                                <td style="text-align:center">{{ $tank_percentage }}%</td>
                                                <td style="text-align:center">{{ $converted_volume }} kg</td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br>
            <div class="row">
                <div class="col-md-6" >
                    <h5><strong>Prepared by: </strong></h5>
                </div>
                <div class="col-md-6">
                    <h5><strong>Checked by: </strong></h5>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    // // Define a function to handle the beforeprint event
    // function handleBeforePrint() {
    //     // Remove the event listener to prevent an infinite loop
    //     window.removeEventListener("beforeprint", handleBeforePrint);

    //     // Display a confirmation dialog to allow the user to select print settings
    //     if (confirm("Click 'OK' to show preview")) {
    //         // Open the print dialog
    //         setTimeout(function() {
    //             window.print();
    //         }, 500);
    //     }
    //     else{
    //         window.location.href = "{{ action('ProductionController@manage') }}";
    //     }
    // }

    // // Add an event listener for the beforeprint event
    // window.addEventListener("beforeprint", handleBeforePrint);

    // // Call the print method when the page finishes loading
    // window.addEventListener("load", function() {
    //     setTimeout(function() {
    //         window.print();
    //         window.location.href = "{{ action('ProductionController@manage') }}";
    //     }, 500);
    // });
</script>
@endsection
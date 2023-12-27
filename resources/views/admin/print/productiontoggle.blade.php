@extends('layouts.themes.admin.print')
@section('content')
<div class="row">
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
                    <i class="fa fa-file-text-o"></i> <strong style="font-size:20px;">CANISTER DAILY ACTIVITY REPORT </strong></h3>
                </div>
                <div class="col-md-6 align-items-center">
                    <div class="col-md-12 d-flex justify-content-end">
                        <p>Date: </p>&nbsp<strong style="text-decoration:underline">{{$production_date}}</strong> <br> 
                    </div>
                </div>
            </div>
            <br>
            <div class="d-flex align-items-center">
                <h4><strong style="font-size:15px;">PART 1: FILLING PLANT PRODUCTION</strong></h4>
            </div>
            <!-- Canisters -->
            
                <table id="part1Table">
                    <thead>
                        <tr>
                            <th colspan = "2" style="text-align:center; border:1px solid black;"></th>
                            @if(isset($canisters))
                                @foreach($canisters as $canister)
                                    <th style="text-align:center; border:1px solid black;">{{$canister->prd_name}}</th>
                                @endforeach
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan = "2" style="text-align:center; border:1px solid black;"><i>Opening Filled Canister Stock</i></td>
                            @if(isset($opening_stocks_array))
                                @foreach($opening_stocks_array as $opening_stock)
                                    <td style="text-align:center; border:1px solid black;">{{ number_format($opening_stock, 0, '.', ',') }}</td>
                                @endforeach
                            @endif
                        </tr>
                    </tbody>
                </table>
                <br>
                <table>
                    <thead>
                        <tr>
                            <th colspan="2" style="text-align:center; border:1px solid;"><i>CUSTOMER</i></td>
                            <th colspan="2" style="text-align:center; border:1px solid;"><i>REFERENCE ID</i></
                            th>
                            @if(isset($canisters))
                                @foreach($canisters as $canister)
                                    <th style="text-align:center; border:1px solid;"><strong>{{$canister->prd_name}}</strong></th>
                                @endforeach
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php($row_count = $purchase_table_rows)
                        @foreach($new_purchases_array as $purchase_array)
                            <tr>
                                <!-- <td colspan="2" style="text-align:center; border:1px solid;"><i>{{ $purchase_array['cus_name'] }}</i></td>
                                <td colspan="2" style="text-align:center; border:1px solid;"><i>{{ $purchase_array['ref_id'] }}</i></td>

                                @for($index = 2; $index < count($canisters); $index++)
                                    <td style="text-align:center; border:1px solid;"><strong>{{$purchase_array[$prd_name]}}</strong></td>    
                                @endfor -->

                                <td colspan="2" style="text-align:center; border:1px solid;"><i>{{ $purchase_array['cus_name'] }}</i></td>
                                <td colspan="2" style="text-align:center; border:1px solid;"><i>{{ $purchase_array['ref_id'] }}</i></td>
                                @foreach($new_purchases_array['quantities'] as $quantity)
                                    <td style="text-align:center; border:1px solid;"><strong>{{$quantity}}</strong></td>  
                                @endforeach
                            </tr>
                            @php($row_count--)
                        @endforeach
                        
                        @php(($td_count = count($canisters)))
                        @if($row_count <> 0)
                            @while($row_count > 0)
                                <tr>
                                    <td colspan="2" style="text-indent:-9999px; border:1px solid black;">0</td>
                                    <td colspan="2" style="text-indent:-9999px; border:1px solid black;">0</td>
                                    @for($count = 0; $count < $td_count; $count++)
                                        <td style="text-indent:-9999px; border-right:1px solid black;">0</td>
                                    @endfor
                                </tr>
                                
                                @php($row_count--)
                            @endwhile
                        @endif
                        <tr>
                            <td colspan="4" style="text-align:center; border:1px solid black"><strong>TOTAL</strong></td>
                            @if(count($total_array) > 0)
                                @foreach($total_array as $value)
                                    <td style="text-align:center; border:1px solid black"><strong>{{ $value }}</strong></td>
                                @endforeach
                            @else
                                @foreach($canisters as $canister)
                                <td style="text-indent:-9999px; border:1px solid black;"><strong>0</strong></td>
                                @endforeach
                            @endif
                        </tr>
                    </tbody>
                </table>
                <br>
                <table>
                    <thead>
                        <tr>
                            <th colspan = "2" style="text-align:center; border:1px solid black;"></th>
                            @if(isset($canisters))
                                @foreach($canisters as $canister)
                                    <th style="text-align:center; border:1px solid black;">{{$canister->prd_name}}</th>
                                @endforeach
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan = "2" style="text-align:center; border:1px solid black;"><i>Closing Filled Canister Stock</i></td>
                            @if(isset($closing_stocks_array))
                                @foreach($closing_stocks_array as $closing_stock)
                                    <td style="text-align:center; border:1px solid black;">{{ number_format($closing_stock, 0, '.', ',') }}</td>
                                @endforeach
                            @endif
                        </tr>
                    </tbody>
                </table>
            

            <br>
            <div class="d-flex align-items-center">
                <h4><strong style="font-size:15px;">PART 2: EMPTY CANISTER MOVEMENT</strong></h4>
            </div>
        
            <table>
                <thead>
                    <tr style="border-bottom:1px solid black;">
                        <th colspan="2" style="text-align:center; border:1px solid black">RECEIVED</th>
                        @if(isset($canisters))
                            @foreach($canisters as $canister)
                                <th style="border-bottom:1px solid black"></th>
                            @endforeach
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom:2px solid black;">
                        <td colspan="1" style="text-align:center; border:1px solid black;"><i>CUSTOMER</i></td>
                        <td colspan="1" style="text-align:center; border:1px solid black;"><i>REFERENCE ID</i></td>
                        @if(isset($canisters))
                            @foreach($canisters as $canister)
                                <td style="text-align:center; border:1px solid black; "><strong>{{$canister->prd_name}}</strong></td>
                            @endforeach
                        @endif
                    </tr>
                    <tr>
                        <!-- add forloop here for how many customers ordered  -->
                        @php($row_count = $received_table_rows)
                        <!-- @foreach($received_customers_array as $received_array) -->
                        @foreach($new_received_array as $received_array)
                            <tr>
                                <!-- <td colspan="1" style="text-align:center; border:1px solid black; border-right:1px solid black"><i>{{ $received_array[0] }}</i></td>
                                <td colspan="1" style="text-align:center; border:1px solid black"><i>{{ $received_array[1] }}</i></td>
                                @for($index = 2; $index < count($received_array); $index++)
                                    <td style="text-align:center; border-right:1px solid black"><strong>{{($received_array[$index] ?? 0)}}</strong></td>    
                                @endfor -->
                            
                                <td colspan="1" style="text-align:center; border:1px solid black; border-right:1px solid black"><i>{{ $received_array['cus_name'] }}</i></td>
                                <td colspan="1" style="text-align:center; border:1px solid black"><i>{{ $received_array['ref_id'] }}</i></td>
                                @foreach($new_received_array['quantities'] as $quantity)
                                    <td style="text-align:center; border-right:1px solid black"><strong>{{$quantity}}</strong></td>    
                                @endfor
                            </tr>
                        @php($row_count--)
                        @endforeach
                        
                        @php(($td_count = count($canisters)))
                        @if($row_count <> 0)
                            @while($row_count > 0)
                                <tr>
                                    <td colspan="1" style="text-indent:-9999px; border:1px solid black; border-right:1px solid black">0</td>
                                    <td colspan="1" style="text-indent:-9999px; border:1px solid black">0</td>
                                    @for($count = 0; $count < $td_count; $count++)
                                        <td style="text-indent:-9999px; border:1px solid black">0</td>
                                    @endfor
                                </tr>
                                @php($row_count--)
                            @endwhile
                        @endif
                    </tr>
                    <tr style="border-top:1px solid black"></tr>
                </tbody>
            </table>    
            <br>
            <table>
                <thead>
                    <tr>
                        <th colspan="4" style="text-align:center; border:1px solid black">RECEIVED</th>
                        @if(isset($canisters))
                            @foreach($oppositions as $opposition)
                                <th style="border-bottom:1px solid black"></th>
                            @endforeach
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2" style="text-align:center; border:1px solid black; border-bottom:2px solid black"><i>CUSTOMER</i></td>
                        <td colspan="2" style="text-align:center; border:1px solid black; border-bottom:2px solid black"><i>REFERENCE ID</i></td>
                        @if(isset($oppositions))
                            @foreach($oppositions as $opposition)
                                <td style="text-align:center; border:1px solid black; border-bottom:2px solid black"><strong>{{$opposition->ops_name}}</strong></td>
                            @endforeach
                        @endif
                    </tr>
                    <tr>
                        <!-- add forloop here for how many customers ordered  -->
                        @php($row_count = $opposition_table_rows)
                            @foreach($oppositions_array as $opposition_array)
                            <!-- <tr>
                                <td colspan="2" style="text-align:center; border:1px solid black; border-left:1px solid black"><i>{{ $opposition_array[0] }}</i></td>
                                <td colspan="2" style="text-align:center; border:1px solid black; border-left:1px solid black"><i>{{ $opposition_array[1] }}</i></td>
                                @for($index = 2; $index < count($opposition_array); $index++)
                                    <td style="text-align:center; border:1px solid black;"><strong>{{$opposition_array[$index]}}</strong></td>    
                                @endfor
                            </tr> -->
                            <tr>
                                <td colspan="2" style="text-align:center; border:1px solid black; border-left:1px solid black"><i>{{ $newopposition_array['cus_id'] }}</i></td>
                                <td colspan="2" style="text-align:center; border:1px solid black; border-left:1px solid black"><i>{{ $newopposition_array['ref_id'] }}</i></td>
                                @foreach($new_opposition_array['quantities'] as $quantity)
                                    <td style="text-align:center; border:1px solid black;"><strong>{{$quantity}}</strong></td>    
                                @endfor
                            </tr>
                            @php($row_count--)
                        @endforeach

                        @php(($td_count = count($oppositions)))
                        @if($row_count <> 0)
                            @while($row_count > 0)
                                <tr>
                                    <td colspan="2" style="text-indent:-9999px; border:1px solid black; border-right:1px solid black">0</td>
                                    <td colspan="2" style="text-indent:-9999px; border:1px solid black">0</td>
                                    @for($count = 0; $count < $td_count; $count++)
                                        <td style="text-indent:-9999px; border:1px solid black">0</td>
                                    @endfor
                                </tr>
                                @php($row_count--)
                            @endwhile
                        @endif
                    </tr>
                    <tr style="border-top:1px solid black"></tr>
                </tbody>
            </table>
            <br>
            <table>
                <thead>
                    <tr>
                        <th colspan="2" style="text-align:center; border:1px solid black">ISSUED</th>
                        @if(isset($canisters))
                            @foreach($canisters as $canister)
                                <th style="border-bottom:1px solid black"></th>
                            @endforeach
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom:2px solid black">
                        <td colspan="1" style="text-align:center; border:1px solid black"><i>CUSTOMER</i></td>
                        <td colspan="1" style="text-align:center; border:1px solid black"><i>REFERENCE ID</i></td>
                        @if(isset($canisters))
                            @foreach($canisters as $canister)
                                <td style="text-align:center; border:1px solid black"><strong>{{$canister->prd_name}}</strong></td>
                            @endforeach
                        @endif
                    </tr>
                    <tr>
                        <!-- add forloop here for how many customers ordered  -->
                        @php($row_count = $issued_table_rows)
                        @foreach($issued_customers_array as $customers_array)
                            <tr>
                                <td colspan="1" style="text-align:center; border:1px solid black; border-right:1px solid black"><i>{{ $customers_array[0] }}</i></td>
                                <td colspan="1" style="text-align:center; border:1px solid black"><i>{{ $customers_array[1] }}</i></td>
                                @for($index = 2; $index < count($customers_array); $index++)
                                    <td style="text-align:center; border:1px solid black"><strong>{{$customers_array[$index]}}</strong></td>    
                                @endfor
                            </tr>
                            @php($row_count--)
                        @endforeach

                        @php(($td_count = count($canisters)))
                        @if($row_count <> 0)
                            @while($row_count > 0)
                                <tr>
                                    <td colspan="1" style="text-indent:-9999px; border:1px solid black; border-right:1px solid black">0</td>
                                    <td colspan="1" style="text-indent:-9999px; border:1px solid black">0</td>
                                    @for($count = 0; $count < $td_count; $count++)
                                        <td style="text-indent:-9999px; border:1px solid black">0</td>
                                    @endfor
                                </tr>
                                @php($row_count--)
                            @endwhile
                        @endif
                    </tr>
                    <tr style="border-top:1px solid black"></tr>
                </tbody>
            </table>
            <br>
            <div class="d-flex align-items-center">
                <h4><strong style="font-size:15px;">PART 3: CANISTER MOVEMENT</strong></h4>
            </div>
            <table>
                <thead>
                    <tr>
                        <th  style="text-align:center; border:1px solid black">Canister</th>
                        @if(isset($canisters))
                            @foreach($canisters as $canister)
                                <th style="text-align:center; border:1px solid black">{{$canister->prd_name}}</th>
                            @endforeach
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center; border:1px solid black"><i>Filled</i></td>
                        @if(isset($canisters))
                            @foreach($canisters as $canister)
                                <td style="text-align:center; border:1px solid black">{{ number_format($canister->prd_quantity, 0, '.', ',') }}</td>
                            @endforeach
                        @endif
                    </tr>
                    <tr>
                        <td style="text-align:center; border:1px solid black"><i>Leakers</i></td>
                        @if(isset($canisters))
                            @foreach($canisters as $canister)
                                <td style="text-align:center; border:1px solid black">{{ number_format($canister->prd_leakers, 0, '.', ',') }}</td>
                            @endforeach
                        @endif
                    </tr>
                    <tr>
                        <td style="text-align:center; border:1px solid black"><i>Empty</i></td>
                        @if(isset($canisters))
                            @foreach($canisters as $canister)
                                <td style="text-align:center; border:1px solid black">{{ number_format($canister->prd_empty_goods, 0, '.', ',') }}</td>
                            @endforeach
                        @endif
                    </tr>
                    <tr>
                        <td style="text-align:center; border:1px solid black"><i>For Revalving</i></td>
                        @if(isset($canisters))
                            @foreach($canisters as $canister)
                                <td style="text-align:center; border:1px solid black">{{ number_format($canister->prd_for_revalving, 0, '.', ',') }}</td>
                            @endforeach
                        @endif
                    </tr>
                    <tr>
                        <td style="text-align:center; border:1px solid black"><i>Scrap</i></td>
                        @if(isset($canisters))
                            @foreach($canisters as $canister)
                                <td style="text-align:center; border:1px solid black">{{ number_format($canister->prd_scraps, 0, '.', ',') }}</td>
                            @endforeach
                        @endif
                    </tr>
                    <tr>
                        <td style="text-align:center; border:1px solid black"><b>Total Stocks</b></td>
                        @if(isset($canisters))
                            @foreach($canisters as $canister)
                                <strong><th style="text-align:center; border:1px solid black">{!! get_product_total_stock_no_scrap($canister->prd_id) !!}</th></strong>
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
                    <div class="col-md-3" style="text-align:center">
                        <p style="text-decoration:underline"><strong>Valve: </strong>{!! get_valve_population() !!}</p>
                    </div>
                    <div class="col-md-3" style="text-align:center">
                        <p style="text-decoration:underline"><strong>Seal: </strong>{!! get_seal_population() !!}</p>
                    </div>
                    {{-- <div class="col-md-2" style="text-align:center">
                        <p style="text-decoration:underline"><strong>Crates: </strong>{!! get_crate_population() !!}</p>
                    </div> --}}
                    <div class="col-md-3" style="text-align:center">
                        <p style="text-decoration:underline"><strong>Gas stove: </strong>{!! get_gasStove_population() !!}</p>
                    </div>
                    <div class="col-md-3" style="text-align:center">
                        <p style="text-decoration:underline"><strong>Tank seal: </strong>{!! get_tankSeal_population() !!}</p>
                    </div>
                </div>
            </div>
            <hr><br>
            <div class="d-flex align-items-center">
                <h4><strong style="font-size:15px;">PART 4: OPPOSITION CANISTERS</strong></h4>
            </div>

            {{--<table>
                <thead>
                    <tr>
                        <th colspan="4" style="text-align:center; border:1px solid black">RECEIVED</th>
                        @if(isset($canisters))
                            @foreach($oppositions as $opposition)
                                <th style="border-bottom:1px solid black"></th>
                            @endforeach
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2" style="text-align:center; border:1px solid black; border-bottom:2px solid black"><i>CUSTOMER</i></td>
                        <td colspan="2" style="text-align:center; border:1px solid black; border-bottom:2px solid black"><i>REFERENCE ID</i></td>
                        @if(isset($oppositions))
                            @foreach($oppositions as $opposition)
                                <td style="text-align:center; border:1px solid black; border-bottom:2px solid black"><strong>{{$opposition->ops_name}}</strong></td>
                            @endforeach
                        @endif
                    </tr>
                    <tr>
                        <!-- add forloop here for how many customers ordered  -->
                        @php($row_count = $issued_table_rows)
                        @foreach($oppositions_array as $opposition_array)
                        <tr>
                            <td colspan="2" style="text-align:center; border:1px solid black; border-left:1px solid black"><i>{{ $opposition_array[0] }}</i></td>
                            <td colspan="2" style="text-align:center; border:1px solid black; border-left:1px solid black"><i>{{ $opposition_array[1] }}</i></td>
                            @for($index = 2; $index < count($opposition_array); $index++)
                                <td style="text-align:center; border:1px solid black;"><strong>{{$opposition_array[$index]}}</strong></td>    
                            @endfor
                        </tr>
                        @php($row_count--)
                        @endforeach

                        @php(($td_count = count($oppositions)))
                        @if($row_count <> 0)
                            @while($row_count > 0)
                                <tr>
                                    <td colspan="2" style="text-indent:-9999px; border:1px solid black; border-right:1px solid black">0</td>
                                    <td colspan="2" style="text-indent:-9999px; border:1px solid black">0</td>
                                    @for($count = 0; $count < $td_count; $count++)
                                        <td style="text-indent:-9999px; border:1px solid black">0</td>
                                    @endfor
                                </tr>
                                @php($row_count--)
                            @endwhile
                        @endif
                    </tr>
                    <tr style="border-top:1px solid black"></tr>
                </tbody>
            </table>--}}
            <hr><br>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h5><strong>Opposition Population</strong></h5>
                </div>
            </div>
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        @if(isset($oppositions))
                            @foreach($oppositions as $opposition)
                                <th style="text-align:center">{{$opposition->ops_name}}</th>
                            @endforeach
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @if(isset($oppositions))
                            @foreach($oppositions as $opposition)
                                <td style="text-align:center">{{ number_format($opposition->ops_quantity, 0, '.', ',') }}</td>
                            @endforeach
                        @endif
                    </tr>
                </tbody>
            </table>
            <div class="text-center">
                <p><strong style="font-size:15px;">Total Opposition Population: </strong><h4>{!! get_total_opposition_report($canister->prd_id) !!}</h4></p>
            </div>
            <div >
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex justify-content-center">
                            <h5><strong style="font-size:15px;">Time Start Ops</strong></h5>
                        </div>
                        <div class="col-md-12 d-flex justify-content-center">
                            <strong class="text-success">{{$production_start}}</strong> <br> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-center">
                            <h5><strong style="font-size:15px;">Time End Ops</strong></h5>
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
                    <h5><strong style="font-size:15px;">Prepared by: </strong></h5>
                </div>
                <div class="col-md-6">
                    <h5><strong style="font-size:15px;">Checked by: </strong></h5>
                </div>
            </div>
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
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
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title"><i class="fa fa-bar-chart"></i> Production Summary</h3><br>
                    </div>
                    <div class="col-md-6">
                        <small class="float-right">{{ $production_date }}</small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="display: flex; justify-content: center; align-items: center;">
                    <h3>Canisters</h3>
                </div>
            </div>
            <div class="card-body">
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
                        <tr><td class="text-center"><strong> Opening Stocks </strong></td></tr>
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
                                @foreach($product_verifications as $verification)
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
                            <tr><td class="text-center"><strong> Closing Stocks </strong></td></tr>
                        
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
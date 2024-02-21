@extends('layouts.themes.admin.print')
@section('content')
<div class="content">
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
    <hr>
    <div class="row">
        <div class="col-md-6">
            <h3 class="ml-2">
                <i class="fa fa-file-text-o"></i> <strong style="font-size:20px;">EOD REPORT FOR {{ date('F j, Y', strtotime($selectedDate)) }}</strong>
            </h3>
        </div>
    </div>
    <br>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partials.alert')
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-stretch">
                                <div class="card-body" style="overflow-x:auto;">
                                    <table class="table table-hover table-condensed">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center; border:1px solid;"><i>REFERENCE ID</i></th>
                                                <th style="text-align:center; border:1px solid;"><i>CUSTOMER</i></td>
                                                @if(isset($canisters))
                                                @foreach($canisters as $canister)
                                                    <th style="text-align:center; border:1px solid;"><strong>{{$canister->prd_name}}</strong></th>
                                                @endforeach
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody id="tbl-products">
                                            @if (isset($eod_by_date))
                                            @if ($eod_by_date->count() === 0)
                                            <td><div>NO DATA FOR {{ date('F j, Y', strtotime($selectedDate)) }}</div></td>
                                            @endif
{{-- 
                                            @foreach($eod_by_date as $eod)
                                            <tr>
                                                <td style="text-align:center; border:1px solid;"><i>{{ $eod->ref_id }}</i></td>
                                                <td style="text-align:center; border:1px solid;"><i>{{ $eod->cus_name }}</i></td>
                                                @foreach($canisters as $canister)
                                                @php
                                                // Find the index of the current prd_id in the prd_ids array
                                                $index = array_search($canister->prd_id, explode(',', $eod->prd_ids));
                                                // Get the corresponding quantity
                                                $quantity = explode(',', $eod->quantities)[$index] ?? 0;
                                                @endphp
                                                <td style="text-align:center; border:1px solid;"><strong>{{ $quantity }}</strong></td>
                                                @endforeach
                                            </tr>
                                            @endforeach --}}

                                            @foreach($eod_by_date as $eod)
                                            <tr>
                                                <td style="text-align:center; border:1px solid;"><i>{{ $eod->ref_id }}</i></td>
                                                <td style="text-align:center; border:1px solid;"><i>{{ $eod->cus_name }}</i></td>
                                                @foreach($canisters as $canister)
                                                @php
                                                // Find the index of the current prd_id in the prd_ids array
                                                $index = array_search($canister->prd_id, explode(',', $eod->prd_ids));
                                                // Get the corresponding quantity, or default to 0 if prd_id not found
                                                $quantity = ($index !== false) ? explode(',', $eod->quantities)[$index] : 0;
                                                @endphp
                                                <td style="text-align:center; border:1px solid;"><strong>{{ $quantity }}</strong></td>
                                                @endforeach
                                            </tr>
                                            @endforeach

                                            {{-- @foreach($eod_by_date as $eod)
                                            <tr>
                                                <td style="text-align:center; border:1px solid;"><i>{{ $eod->ref_id }}</i></td>
                                                <td style="text-align:center; border:1px solid;"><i>{{ $eod->cus_name }}</i></td>
                                                @foreach($canisters as $canister)
                                                @php
                                                $quantity = explode(',', $eod->quantities)[$loop->index] ?? 0;
                                                @endphp
                                                <td style="text-align:center; border:1px solid;"><strong>{{ $quantity }}</strong></td>
                                                @endforeach
                                            </tr>
                                            @endforeach --}}
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
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
        window.location.href = "{{ action('ReportsController@production') }}";
    }
    }

    // Add an event listener for the beforeprint event
    window.addEventListener("beforeprint", handleBeforePrint);

    // Call the print method when the page finishes loading
    window.addEventListener("load", function() {
        setTimeout(function() {
            window.print();
            window.location.href = "{{ action('ReportsController@production') }}";
        }, 500);
    });
</script>
@endsection
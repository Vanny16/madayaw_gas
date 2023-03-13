@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Production Reports</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Reports</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
 
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partials.alert')
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <form method="POST" action="{{ action('ReportsController@production') }}">
                                    {{ csrf_field() }}
                                        <div class="row">

                                            {{-- <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle w-100 {{$production_list_status}}" type="button" id="dropdownMonthButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        @if($selectedMonth <> '')
                                                            {{$selectedMonth}}
                                                        @else
                                                            Month
                                                        @endif
                                                    </button>
                                                    <div class="dropdown-menu w-100" aria-labelledby="dropdownMonthButton" style="max-height: 200px; overflow-y: scroll;">
                                                        @foreach($months as $month)
                                                            <a class="dropdown-item" href="#" data-value="{{$month}}">{{$month}}</a>
                                                        @endforeach
                                                    </div>
                                                    <input type="hidden" name="month" value="{{$selectedMonth}}" />
                                                </div> --}}

                                            <div class="col-md-4 mb-3">
                                                <label for="selectedDate">Production Date</label>
                                                <input type="date" class="form-control" name="selectedDate" value="" required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <button type="submit" class="btn btn-success float-right w-100"><span class="fa fa-search"></span> Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="card card-stretch">
                                <div class="d-flex align-items-center">
                                    <div class="col-12 mt-3 text-center">
                                        <strong class="mx-auto">{{$pdn_date}}</strong>
                                        <hr>
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <th width="50%"></th>
                                                <th width="50%"></th>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Start Time:  </td>
                                                <td class="text-left text-success">{{$pdn_start_time}}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">End Time:  </td>
                                                @if(empty($pdn_end_time))
                                                    <td class="text-left text-danger">-- : -- : -- --</td>
                                                @else    
                                                    <td class="text-left text-danger">{{$pdn_end_time}}</td>
                                                @endif
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="card card-stretch">
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
                                            <tr class='clickable-row' data-toggle="modal" data-target="#stocks-modal">
                                                <td><i>Opening Stocks</i></td>
                                                @if(isset($canisters))
                                                    @foreach($canisters as $canister)
                                                        <td>{!! get_opening_stock($canister->prd_id, $production_id) !!}</td>
                                                    @endforeach
                                                @endif
                                            </tr>
                                            <tr class='clickable-row' data-toggle="modal" data-target="#stocks-modal">
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
                                <div class="card-body" style="overflow-x:auto;">
                                    <table class="table table-hover table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Tank Name</th>
                                                @if(isset($tanks))
                                                    @foreach($tanks as $tank)
                                                        <th>{{$tank->tnk_name}}</th>
                                                    @endforeach
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><i>Opening Tank</i></td>
                                                @foreach($tanks as $tank)
                                                    <td>{!! get_opening_tank($tank->tnk_id, get_last_production_id()) !!}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td><i>Closing Tank</i></td>
                                                @foreach($tanks as $tank)
                                                    <td>{!! get_closing_tank($tank->tnk_id, get_last_production_id()) !!}</td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body" style="overflow-x:auto;">
                                    <table class="table table-hover table-condensed" id="tbl-canister-movement">
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
                                                <td><i>Empty</i></td>
                                                @if(isset($canisters))
                                                    @foreach($canisters as $canister)
                                                        <td>{!! get_quantity_of_canisters($canister->prd_id, 1) !!}</td>
                                                    @endforeach
                                                @endif
                                            </tr>
                                            <tr>
                                                <td><i>Filled</i></td>
                                                @if(isset($canisters))
                                                    @foreach($canisters as $canister)
                                                        <td>{!! get_quantity_of_canisters($canister->prd_id, 2) !!}</td>
                                                    @endforeach
                                                @endif
                                            </tr>
                                            <tr>
                                                <td><i>Leakers</i></td>
                                                @if(isset($canisters))
                                                    @foreach($canisters as $canister)
                                                        <td>{!! get_quantity_of_canisters($canister->prd_id, 3) !!}</td>
                                                    @endforeach
                                                @endif
                                            </tr>
                                            <tr>
                                                <td><i>For Revalving</i></td>
                                                @if(isset($canisters))
                                                    @foreach($canisters as $canister)
                                                        <td>{!! get_quantity_of_canisters($canister->prd_id, 4) !!}</td>
                                                    @endforeach
                                                @endif
                                            </tr>
                                            <tr>
                                                <td><i>Scrap</i></td>
                                                @if(isset($canisters))
                                                    @foreach($canisters as $canister)
                                                        <td>{!! get_quantity_of_canisters($canister->prd_id, 5) !!}</td>
                                                    @endforeach
                                                @endif
                                            </tr>
                                            <hr>
                                            <tr>
                                                <td><b>Total Stocks</b></td>
                                                @if(isset($canisters))
                                                    @foreach($canisters as $canister)
                                                        <strong><th>{!! get_stock_report($canister->prd_id, 3) !!}</th></strong>
                                                    @endforeach
                                                @endif
                                            </tr>
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

$(document).ready(function() {
    // Get the cards with the class 'card-stretch'
    var cards = $('.card-stretch');

    // Set the initial max height to 0
    var maxHeight = 0;

    // Loop through each card
    cards.each(function() {
        // Get the height of the card
        var cardHeight = $(this).outerHeight();

        // If the height of the card is greater than the current max height, update the max height
        if (cardHeight > maxHeight) {
            maxHeight = cardHeight;
        }
    });

    // Set the height of all cards to the max height
    cards.css('height', maxHeight + 'px');
    
    $(document).on("click", ".dropdown-menu a", function () {
        var value = $(this).attr("data-value");
        var dropdown = $(this).closest(".dropdown");
        dropdown.find(".btn").text(value);
        dropdown.find("input").val(value);
    });
});

</script>
@endsection 
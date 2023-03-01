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
            
            @if($production_date_from != "" && $production_date_to != "")
                @php
                    $date_from = $production_date_from;
                    $date_to = $production_date_to;
                @endphp
            @else
                @php
                    $date_from = Carbon\Carbon::parse()->format('Y-m-d');
                    $date_to = Carbon\Carbon::parse()->format('Y-m-d');
                @endphp
            @endif

            <div class="row">
                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-calendar"></i> Selected Date</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ action('ReportsController@productionFilter')}}">
                            {{ csrf_field() }} 
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="date_from">From</label>
                                        <input type="date" class="form-control" name="production_date_from" value="{{ $date_from }}" required/>     
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="date_to">To</label>
                                        <input type="date" class="form-control" name="production_date_to" value="{{ $date_to }}" required/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <button type="submit" class="btn btn-success"><span class="fa fa-search"></span> Find</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">

                                @if($production_date_from != "" && $production_date_to != "")
                                    @if($production_date_from == Carbon\Carbon::parse()->format('Y-m-d'))
                                        <h5>Today's sales</h5>
                                    @else
                                        <h5>Production from <span class="text-info">{{ \Carbon\Carbon::parse($production_date_from)->format('F d, Y') }}</span> to <span class="text-info">{{ \Carbon\Carbon::parse($production_date_to)->format('F d, Y') }}</span></h5>
                                    @endif
                                @else
                                    <h5>Production Summary</h5>
                                @endif
                                </div>
                                <div class="col-6">
                                    <a href="{{ action('ReportsController@production') }}"><button type="submit" class="btn btn-danger float-right"><span class="fa fa-table"></span> Show all time production</button></a>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                               {{\Carbon\Carbon::parse($date_from)->format('F d, Y')}}
                            </div>
                        </div>
                    </div>
                    {{--<div class="row">
                        <div class="col-md-12 mb-3"> 
                            <form method="POST" action="{{ action('PrintController@allproductionReports')}}">
                            {{ csrf_field() }}
                                <button type="submit" class="btn btn-info col-md-1 col-12 float-left" href="" target="_BLANK"><i class="fa fa-print"></i> Print</button>
                                <input type="date_from" class="form-control" id="production_date_from" name="production_date_from" value="{{ $date_from }}" hidden/>
                                <input type="date_to" class="form-control" id="production_date_to" name="production_date_to" value="{{ $date_to }}" hidden/>
                            </form>
                        </div>
                    </div>--}}
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-bar-chart"></i> Production Reports</h3>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <div class="row">
                                <table class="table table-hover table-condensed" id="tbl-cart">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Product Name</th>
                                            <th>Empty Goods</th>
                                            <th>Filled Canisters</th>
                                            <th>Leakers</th>
                                            <th>For Revalving</th>
                                            <th>Scrap</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($productions))
                                            @foreach($productions as $production)
                                                <tr>
                                                    <td>{{$production->log_date}}</td>
                                                    <td>{{$production->prd_name}}</td>
                                                    <td>{{$production->log_empty_goods}}</td>
                                                    <td>{{$production->log_filled}}</td>
                                                    <td>{{$production->log_leakers}}</td>
                                                    <td>{{$production->log_for_revalving}}</td>
                                                    <td>{{$production->log_scraps}}</td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            {{ $productions->links() }}
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
                                                <th>Tank Name</th>
                                                <th>Tank Opening</th>
                                                <th>Tank Closing</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><i>Tank 1</i></td>
                                                <td>5000 kgs</td>
                                                <td>2345 kgs</td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><i>Tank 2</i></td>
                                                <td>5000 kgs</td>
                                                <td>2245 kgs</td>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-clock"></i> Production Summary</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <div class="col-12 mt-3 text-center">
                            <strong class="mx-auto">{{$pdn_date}}</strong>
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
                            {{--<div class="text-white">
                                <a class="btn btn-primary" href=""> Edit Stocks</a>
                            </div>--}}
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
                                    <tr class='clickable-row' data-toggle="modal" data-target="#stocks-modal">
                                        <td><i>Opening Stocks</i></td>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <td>{!! get_opening_stock($canister->prd_id, $production_id) !!}</td>
                                            @endforeach
                                        @endif
                                    </tr>
                                    @php($stocks_flag = 2)
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
                        <!-- Canisters -->
                        <div class="row mb-3">
                            <div class="col-12 text-center bg-info">
                                <p><i class="fa fa-pallet mt-3"></i> Canister Movement</p>
                            </div>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
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
                                        <td><i>Empty</i></td>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <th>{!! get_quantity_of_canisters($canister->prd_id, 1) !!}</th>
                                            @endforeach
                                        @endif
                                    </tr>
                                    <tr>
                                        <td><i>Filled</i></td>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <th>{!! get_quantity_of_canisters($canister->prd_id, 2) !!}</th>
                                            @endforeach
                                        @endif
                                    </tr>
                                    <tr>
                                        <td><i>Leakers</i></td>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <th>{!! get_quantity_of_canisters($canister->prd_id, 3) !!}</th>
                                            @endforeach
                                        @endif
                                    </tr>
                                    <tr>
                                        <td><i>For Revalving</i></td>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <th>{!! get_quantity_of_canisters($canister->prd_id, 4) !!}</th>
                                            @endforeach
                                        @endif
                                    </tr>
                                    <tr>
                                        <td><i>Scrap</i></td>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <th>{!! get_quantity_of_canisters($canister->prd_id, 5) !!}</th>
                                            @endforeach
                                        @endif
                                    </tr>
                                    <hr>
                                    <tr>
                                        <td><b>Total Stocks</b></td>
                                        @if(isset($canisters))
                                            @foreach($canisters as $canister)
                                                <strong><td>{!! get_stock_report($canister->prd_id, 3) !!}</td></strong>
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
                                    <tr>
                                        <td><i>Tank 1</i></td>
                                        <td>5000 kgs</td>
                                        <td>2345 kgs</td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i>Tank 2</i></td>
                                        <td>5000 kgs</td>
                                        <td>2245 kgs</td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
});

// $(document).ready(function () {
//     // alert('asdf');
//     $.ajax({
//         type: "GET",
//         url: "/reports/test-production",
//         dataType: "json",
//         success: function(test_productions) {
//             $.each(test_productions, function(index, value) {
//                 $('#tbl-cart tbody').append(
//                     '<tr>' +
//                     '<td>' + value.log_date + '</td>' +
//                     '<td>' + value.prd_name + '</td>' +
//                     '<td>' + value.log_empty_goods + '</td>' +
//                     '<td>' + value.log_filled + '</td>' +
//                     '<td>' + value.log_leakers + '</td>' +
//                     '<td>' + value.log_for_revalving + '</td>' +
//                     '<td>' + value.log_scraps+ '</td>' +
//                     '</tr>'
//                 );
//             });
//         }
//     });
    
//     $('#filter_date_from').on("change", function (e) {
//         var date_from = $("#filter_date_from").val();
//         var date_to = $("#filter_date_to").val();
//         alert(date_to);
//         $.ajax({
//             type: "POST",
//             url: "/reports/filter-production",
//             data: {date_from: date_from, date_to: date_to},
//             success: function(filter_productions) {
//                 console.log(filter_productions);
//                 $('#tbl-cart tbody').empty();
//                 // $.each(filter_productions, function(index, value) {
//                 //     $('#tbl-cart tbody').append(
//                 //         '<tr>' +
//                 //         '<td>' + value.log_date + '</td>' +
//                 //         '<td>' + value.prd_name + '</td>' +
//                 //         '<td>' + value.log_empty_goods + '</td>' +
//                 //         '<td>' + value.log_filled + '</td>' +
//                 //         '<td>' + value.log_leakers + '</td>' +
//                 //         '<td>' + value.log_for_revalving + '</td>' +
//                 //         '<td>' + value.log_scraps+ '</td>' +
//                 //         '</tr>'
//                 //     );
//                 // });
//             }
//         });
//     });

    

//   });
</script>
@endsection 
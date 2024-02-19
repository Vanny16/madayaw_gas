@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">EOD By Date</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item active">EOD</li>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-top-stretch">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form method="POST" action="{{ action('ReportsController@search_eod') }}">
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <div class="col-md-5 mb-3">
                                                        <label for="selectedDate">Production Date</label>
                                                        <input type="date" class="form-control" name="selectedDate"
                                                            value="{{$selectedDate}}" required />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 mb-3">
                                                        <button type="submit"
                                                            class="btn btn-success float-right w-100"><span
                                                                class="fa fa-search"></span> Search</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-stretch">
                                <div class="card-body" style="overflow-x:auto;">
                                    <table class="table table-hover table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Reference ID</th>
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                                <th>Customer</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl-products">
                                            @if (isset($eod_by_date))
                                            @if ($eod_by_date->count() === 0)
                                            <td>NO DATA FOR {{ $selectedDate }}</td>
                                            @endif
                                            @foreach ($eod_by_date as $eods)
                                            
                                            {{-- @if(property_exists($eods, 'cus_accessibles_prices'))
                                            @php($prd_price = $eods->cus_accessibles_prices)
                                            @else
                                            @php($prd_price = $eods->prd_price)
                                            @endif --}}

                                            <tr>
                                                <td>{{ $eods->ref_id }}</td>
                                                <td>{{ $eods->prd_name }}</td>
                                                <td>{{ $eods->quantity }}</td>
                                                <td>{{ $eods->cus_name }}</td>
                                            </tr>
                                            @endforeach
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
    $(document).ready(function() {
    // Get the cards with the class 'card-stretch'
    var cards = $('.card-stretch');
    var topCards = $('.card-top-stretch');
    var botCards = $('.card-bot-stretch');
    

    // Set the initial max height to 0
    var maxHeight = 0;
    var topMaxHeight = 0;
    var botMaxHeight = 0;

    // Loop through each card
    cards.each(function() {
        // Get the height of the card
        var cardHeight = $(this).outerHeight();

        // If the height of the card is greater than the current max height, update the max height
        if (cardHeight > maxHeight) {
            maxHeight = cardHeight;
        }
    });

    topCards.each(function() {
        // Get the height of the card
        var cardHeight = $(this).outerHeight();

        // If the height of the card is greater than the current max height, update the max height
        if (cardHeight > topMaxHeight) {
            topMaxHeight = cardHeight;
        }
    });

    botCards.each(function() {
        // Get the height of the card
        var cardHeight = $(this).outerHeight();

        // If the height of the card is greater than the current max height, update the max height
        if (cardHeight > botMaxHeight) {
            botMaxHeight = cardHeight;
        }
    });

    // Set the height of all cards to the max height
    cards.css('height', maxHeight + 'px');
    topCards.css('height', topMaxHeight + 'px');
    botCards.css('height', botMaxHeight + 'px');

    $(document).on("click", ".dropdown-menu a", function () {
        var value = $(this).attr("data-value");
        var dropdown = $(this).closest(".dropdown");
        dropdown.find(".btn").text(value);
        dropdown.find("input").val(value);
    });
});

</script>
@endsection
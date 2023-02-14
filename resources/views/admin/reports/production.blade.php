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
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-calendar"></i> Selected Date</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="date_from">From</label>
                                    <input type="date" class="form-control" id="filter_date_from" name="filter_date_from" value="{{ Carbon\Carbon::parse()->format('Y-m-d') }}" required/>     
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="date_to">To</label>
                                    <input type="date" class="form-control" id="filter_date_to" name="filter_date_to" value="{{ Carbon\Carbon::parse()->format('Y-m-d') }}" required/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <button type="submit" class="btn btn-success"><span class="fa fa-search"></span> Find</button> 
                                </div>
                            </div>
                        </div>
                    </div>
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
                                        {{--@if(isset($productions))
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
                                        @endif--}}
                                    </tbody>
                                </table>
                                {{-- $productions->links() --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
$(document).ready(function () {
    // alert('asdf');
    $.ajax({
        type: "GET",
        url: "/reports/test-production",
        dataType: "json",
        success: function(test_productions) {
            $.each(test_productions, function(index, value) {
                $('#tbl-cart tbody').append(
                    '<tr>' +
                    '<td>' + value.log_date + '</td>' +
                    '<td>' + value.prd_name + '</td>' +
                    '<td>' + value.log_empty_goods + '</td>' +
                    '<td>' + value.log_filled + '</td>' +
                    '<td>' + value.log_leakers + '</td>' +
                    '<td>' + value.log_for_revalving + '</td>' +
                    '<td>' + value.log_scraps+ '</td>' +
                    '</tr>'
                );
            });
        }
    });
    
    $('#filter_date_from').on("change", function (e) {
        var date_from = $("#filter_date_from").val();
        var date_to = $("#filter_date_to").val();
        alert(date_to);
        $.ajax({
            type: "POST",
            url: "/reports/filter-production",
            data: {date_from: date_from, date_to: date_to},
            success: function(filter_productions) {
                console.log(filter_productions);
                $('#tbl-cart tbody').empty();
                // $.each(filter_productions, function(index, value) {
                //     $('#tbl-cart tbody').append(
                //         '<tr>' +
                //         '<td>' + value.log_date + '</td>' +
                //         '<td>' + value.prd_name + '</td>' +
                //         '<td>' + value.log_empty_goods + '</td>' +
                //         '<td>' + value.log_filled + '</td>' +
                //         '<td>' + value.log_leakers + '</td>' +
                //         '<td>' + value.log_for_revalving + '</td>' +
                //         '<td>' + value.log_scraps+ '</td>' +
                //         '</tr>'
                //     );
                // });
            }
        });
    });

    

  });
</script>
@endsection 
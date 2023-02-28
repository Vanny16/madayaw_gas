@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Payments</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Payments</li>
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
                            <h3 class="card-title"><i class="fas fa-filter"></i> Filters</h3>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <div class="row">
                                <div class="col-3"> 
                                    <label>Status</label>
                                    <select class="form-control">
                                        <option>Pending</option>
                                        <option>Paid</option>
                                        <option>All</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-coins"></i> Transaction Payments</h3>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <div class="row">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Reference ID</th>
                                            <th>Customer</th>
                                            <th>Date & Time</th>
                                            <th>Amount Payable</th>
                                            <th>Amount Paid</th>
                                            <th>Balance</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($transactions as $transaction)
                                            @if($transaction->trx_balance > 0)
                                                @php($status = "PENDING")
                                                @php($text_color = "text-danger")
                                            @else
                                                @php($status = "PAID")
                                                @php($text_color = "text-success")
                                            @endif
                                            <tr class='clickable-row' data-toggle="modal" data-target="#purchases-modal{{-- $transaction->trx_ref_id --}}" >
                                                <td>{{ $transaction->trx_ref_id }}</td>
                                                <td>{{ $transaction->cus_name }}</td>
                                                <td>{{ $transaction->trx_datetime }}</td>
                                                <td>{{ $transaction->trx_total }}</td>
                                                <td>{{ $transaction->trx_amount_paid }}</td>
                                                <td>{{ $transaction->trx_balance }}</td>
                                                <td class="{{ $text_color }}">{{ $status }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection 

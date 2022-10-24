@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Payroll Utilities</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item">Payroll</li>
                        <li class="breadcrumb-item active">Utilities</li>
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
        {{-- 
            <div class="row">
                <div class="col-md-12 mb-2">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal"><span class="fa fa-plus-circle"></span> New Update</button>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><span class="fas fa-tools"></span> Payroll Utilities</h3>
                        </div>
                        <div class="card-body">
                            <ul>
                                <li><a href="{{ action('PayrollController@incomeAccounts') }}" target="_BLANK">Income Accounts</a></li>
                                <li><a href="{{ action('PayrollController@deductionAccounts') }}" target="_BLANK">Deduction Accounts</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
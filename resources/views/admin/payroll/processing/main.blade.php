@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Payroll Processing</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item">Payroll</li>
                        <li class="breadcrumb-item active">Processing</li>
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
                            <h3 class="card-title"><i class="fa fa-calendar" aria-hidden="true"></i> Select Payroll Period</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ action('PayrollController@processEmployees') }}">
                            {{ csrf_field() }} 
                                <div class="form-group row">
                                    <label for="yr_id" class="col-sm-2 col-form-label">Year</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="yr_id" required>
                                            @foreach($period_years as $period_year)
                                                <option value="{{ $period_year->yr_id }}">{{ $period_year->yr_name }}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="mos_id" class="col-sm-2 col-form-label">Month</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="mos_id" required>
                                            @foreach($period_months as $period_month)
                                                <option value="{{ $period_month->mos_id }}">{{ $period_month->mos_name }}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="trm_id" class="col-sm-2 col-form-label">Term</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="trm_id" required>
                                            @foreach($period_terms as $period_term)
                                                <option value="{{ $period_term->trm_id }}">{{ $period_term->trm_name }}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-arrow-circle-right"></i> Proceed</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
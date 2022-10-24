@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Income Accounts</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item">Payroll</li>
                        <li class="breadcrumb-item">Utilities</li>
                        <li class="breadcrumb-item active">Income Accounts</li>
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
                <div class="col-md-12 mb-2">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal"><span class="fa fa-plus-circle"></span> New Income Account</button>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-file-invoice"></i> Income Accounts</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>Account Name</th>
                                        <th width="120px" class="text-center"><i class="fa fa-cog"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($payroll_income_accounts as $payroll_income_account)
                                        <tr>
                                            <td>{{ $payroll_income_account->inc_name }}</td>
                                            <td><a class="btn btn-danger btn-sm" href="{{ action('PayrollController@deleteIncomeAccount',[$payroll_income_account->inc_id]) }}"><span class="fa fa-trash"></span></a></td>
                                        </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Income Account</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="{{ action('PayrollController@saveIncomeAccount') }}">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label for="inc_name">Account Name<span style="color:red;">*</span></label>
                        <input class="form-control" type="text" name="inc_name" required/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Save</button> 
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">System Updates</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item active">System Updates</li>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal"><span class="fa fa-plus-circle"></span> New Update</button>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><span class="fa fa-history"></span> System Updates</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="120px">Date/Version</th>
                                        <th></th>
                                        @if(session('super_admin') == true)
                                            <th width="120px" class="text-center"><i class="fa fa-cog"></i></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($versions as $version)
                                        <tr>
                                            <td>
                                                <small><span class="fa fa-clock"></span> {{ \Carbon\Carbon::parse($version->ver_date)->addHour(-8)->diffForHumans() }}</small>
                                                <br/>
                                                <small>Version 1.0.{{ $version->ver_id }} </small>
                                            </td>
                                            <td>
                                                <small><span class="fa fa-user"></span> {{ get_employee_name($version->emp_id) }}</small>
                                                <br/>
                                                <span class="fa fa-bookmark"></span> {{ $version->ver_details }}
                                            </td>
                                            @if(session('super_admin') == true)
                                                <td><a class="btn btn-danger btn-sm" href="{{ action('UpdateController@delete',[$version->ver_id]) }}"><span class="fa fa-trash"></span></a></td>
                                            @endif
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
                <h4 class="modal-title">New Update</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="{{ action('UpdateController@save') }}">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label for="ver_details">Details<span style="color:red;">*</span></label>
                        <input class="form-control" type="text" name="ver_details" required/>
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
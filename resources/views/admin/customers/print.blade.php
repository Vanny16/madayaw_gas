@extends('layouts.themes.admin.print')
@section('content')
<div class="row">
    <div class="col-md-12"> 
        <img src="{{ asset('images/accounts/' . get_company_image($employee->acc_id)) }}" class="brand-image img-circle">
        <h3 style="text-align:center;"></h3>
        <p style="text-align:center;"></p>
    </div>
    <div class="col-md-12"> 
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-clock"></i> Customer Record</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th width="120px">Customer Name</th>
                            <th>Contact #</th>
                            <th>Address</th>
                            <th>Notes</th>
                            <th>Status</th>
                            <th width="20px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <small><a href="javascript:void(0)" data-toggle="modal" data-target="#remarksModal"><span class="fa fa-edit"></span></button></small>
                            </td>
                        </tr> 
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"> 
    window.addEventListener("load", window.print());
</script>
@endsection
@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Departments</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('AdminController@main') }}">Home</a></li>
                        <li class="breadcrumb-item">Departments</li>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal"><span class="fa fa-plus-circle"></span> Create New</button>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><span class="fa fa-users"></span> Departments</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>Branch</th>
                                        <th>Department Name</th>
                                        <th width="120px" class="text-center"><i class="fa fa-cog"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($departments as $department)
                                        <tr>
                                            <td>{{ $department->branch_id }} </td>
                                            <td>{{ $department->dep_name }} </td>
                                            <td>
                                                @if($department->dep_active == '1')
                                                    <a class="btn btn-danger btn-sm" href="{{ action('DepartmentController@deactivate',[$department->dep_id]) }}"><span class="fa fa-user-minus"></span></a>
                                                @else 
                                                    <a class="btn btn-success btn-sm" href="{{ action('DepartmentController@activate',[$department->dep_id]) }}"><span class="fa fa-user-plus"></span></a>
                                                @endif
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateModal-{{$department->dep_id}}"><span class="fa fa-eye"></span></button>
                                            </td>
                                        </tr> 
                                        <div id="updateModal-{{$department->dep_id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update Department</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <form method="POST" action="{{ action('DepartmentController@update') }}">
                                                    {{ csrf_field() }} 
                                                        <div class="modal-body">
                                                            <div class="col-md-12 mb-3">
                                                                <label for="dep_name">Department Short Name<span style="color:red;">*</span></label>
                                                                <input class="form-control" type="text" name="dep_name" value="{{ $department->dep_name }}" required/>
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <label for="dep_full_name">Department Full Name<span style="color:red;">*</span></label>
                                                                <input class="form-control" type="text" name="dep_full_name" value="{{ $department->dep_full_name }}" required/>
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <label for="branch_id">Select User Department(s):</label>
                                                                <select class="form-control" name="branch_id" required>
                                                                    @if($department->branch_id == 'UM-MAIN')
                                                                        <option value="UM-MAIN" selected>UM-MAIN</option>
                                                                    @else 
                                                                        <option value="UM-MAIN">UM-MAIN</option>
                                                                    @endif
                                                                    @if($department->branch_id == 'UM-TAGUM')
                                                                        <option value="UM-TAGUM" selected>UM-TAGUM</option>
                                                                    @else 
                                                                        <option value="UM-TAGUM">UM-TAGUM</option>
                                                                    @endif
                                                                    @if($department->branch_id == 'UM-PANABO')
                                                                        <option value="UM-PANABO" selected>UM-PANABO</option>
                                                                    @else 
                                                                        <option value="UM-PANABO">UM-PANABO</option>
                                                                    @endif
                                                                    @if($department->branch_id == 'UM-DIGOS')
                                                                        <option value="UM-DIGOS" selected>UM-DIGOS</option>
                                                                    @else 
                                                                        <option value="UM-DIGOS">UM-DIGOS</option>
                                                                    @endif
                                                                    @if($department->branch_id == 'UM-BANSALAN')
                                                                        <option value="UM-BANSALAN" selected>UM-BANSALAN</option>
                                                                    @else 
                                                                        <option value="UM-BANSALAN">UM-BANSALAN</option>
                                                                    @endif
                                                                    @if($department->branch_id == 'UM-PENAPLATA')
                                                                        <option value="UM-PENAPLATA" selected>UM-PENAPLATA</option>
                                                                    @else 
                                                                        <option value="UM-PENAPLATA">UM-PENAPLATA</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <input type="hidden" name="dep_id" value="{{ $department->dep_id}}" required/>
                                                            <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Save Changes</button> 
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
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
                <h4 class="modal-title">Create Department</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="{{ action('DepartmentController@save') }}">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label for="dep_name">Department Short Name<span style="color:red;">*</span></label>
                        <input class="form-control" type="text" name="dep_name" required/>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="dep_full_name">Department Full Name<span style="color:red;">*</span></label>
                        <input class="form-control" type="text" name="dep_full_name" required/>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="branch_id">Branch:</label>
                        <select class="form-control" name="branch_id" required>
                            <option value="UM-MAIN">UM-MAIN</option>
                            <option value="UM-TAGUM">UM-TAGUM</option>
                            <option value="UM-PANABO">UM-PANABO</option>
                            <option value="UM-DIGOS">UM-DIGOS</option>
                            <option value="UM-BANSALAN">UM-BANSALAN</option>
                            <option value="UM-PENAPLATA">UM-PENAPLATA</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Save Department</button> 
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tank</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Manage Tank</li>
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
            <div class="col-md-12 mb-2">
                <a class="btn btn-primary col-md-2 col-20 mb-1" href="javascript:void(0)" data-toggle="modal" data-target="#tank-modal"><i class="fa fa-plus mr-1"></i> Add New Tank</a>
            </div>
            <div class="row">
                <div class="col-md-6"> 
                    <div class="card">
                        <div class="card-header" style="overflow-x:auto;">
                            <h3 class="card-title"><i class="fas fa-info-circle"></i> Tank Status</h3>
                        </div>                         
                        <div class="row">       
                            @foreach($tanks as $tank)
                                @php($tank_percentage = (((float)$tank->tnk_remaining / 1000) / ((float)$tank->tnk_capacity / 1000)) * 100)
                                @php($tank_bg = "bg-success")

                                @if($tank_percentage > 50)
                                    @php($tank_bg = "bg-success")
                                @elseif($tank_percentage < 50)
                                    @php($tank_bg = "bg-warning")
                                @elseif($tank_percentage < 25)
                                    @php($tank_bg = "bg-danger")
                                @endif
                            
                                <div class="row" style="margin: 15px;">
                                    <div class="col-md-12">
                                        <div class="row">  
                                            <a class="btn btn-transparent btn-sm text-danger" href="javascript:void(0)" data-toggle="modal" data-target="#tank-refill-modal-{{$tank->tnk_id}}"><i class="fa fa-sm fa-plus mr-1" aria-hidden="true"></i><i class="fa fa-gas-pump mr-1" aria-hidden="true"></i></a>
                                        </div> 
                                        <div class="col-md-12" style="margin-left: 500px;">
                                            @if($tank->tnk_active == 0)
                                                <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" data-toggle="dropdown" disabled><i class="fa fa-ellipsis-vertical"></i></button>
                                            @else    
                                                <div class="dropdown">
                                                    <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" data-toggle="dropdown"><i class="fa fa-ellipsis-vertical"></i></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#tank-edit-modal-{{$tank->tnk_id}}"><i class="fa fa-edit mr-2" aria-hidden="true"></i>Edit Info</a></li>
                                                        <!-- <li><a class="ml-3" href="{{ action('ProductionController@tankActivation', ['tnk_id' => $tank->tnk_id, 'tnk_active' => $tank->tnk_active]) }}"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Deactivate</a></li> -->
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row" style="margin: 5px;">
                                                @if($tank->tnk_active == 1) 
                                                <span class="badge badge-success">Active</span>
                                                    <a class="fa fa-toggle-on" type="button" href="{{ action('ProductionController@tankActivation', ['tnk_id' => $tank->tnk_id, 'tnk_active' => $tank->tnk_active]) }}" aria-hidden="true"></a>
                                                @else
                                                <span class="badge badge-danger">Inactive</span>
                                                    <a class="fa fa-toggle-off" type="button" href="{{ action('ProductionController@tankActivation', ['tnk_id' => $tank->tnk_id, 'tnk_active' => $tank->tnk_active]) }}" aria-hidden="true"></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>  
                                    
                                    <div class="progress" style="border-style: double; border-color: grey; border-width: 5px; height: 350px; width: 150px; transform: rotate(-90deg); border-radius: 90px; margin: 53px; margin-bottom: -80px; margin-top: -50px;">
                                        <div class="bg-success progress-bar" role="progressbar" style="width: {{$tank_percentage}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                            <span style="transform: rotate(90deg);">{{number_format($tank_percentage, 2)}}%</span>
                                        </div>   
                                    </div>
                          
                                    <div class="row" style="margin: 51px; margin-top: 85px;">
                                        <div class="col-md-12">
                                            <small><strong>{{$tank->tnk_name}}</strong></small>
                                            <div class="row">
                                                <small><strong>Capacity:</strong> {{number_format($tank->tnk_capacity)}} kg</small>
                                            </div>
                                            <div class="row">
                                                <small><strong>Volume:</strong> {{number_format($tank->tnk_remaining)}} kg</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                    {{--<div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <small class="float-left">{{number_format($tank->tnk_remaining, 2)}}/{{$tank->tnk_capacity}} g</small>
                                                <small class="float-right">{{number_format($tank->tnk_remaining / 1000, 2)}}/{{ number_format((float)$tank->tnk_capacity / 1000, 2) }} kg</small>
                                            </div>
                                        </div>
                                    </div>--}}                              
                                </div>
                                <!-- Edit Tank Modal -->
                                <div class="modal fade" id="tank-edit-modal-{{$tank->tnk_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Tank Form</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" id="form-add" action="{{ action('ProductionController@editTank', [$tank->tnk_id]) }}">
                                            {{ csrf_field() }} 
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="tnk_name">Tank Name <span style="color:red">*</span></label>
                                                                <input type="text" name="tnk_name" class="form-control" value="{{$tank->tnk_name}}" required/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tnk_capacity">Capacity (kg)<span style="color:red">*</span></label>
                                                                <input type="text" name="tnk_capacity" class="form-control" value="{{$tank->tnk_capacity/1000}}" onkeypress="return isNumberKey(this, event);" required/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tnk_remaining">Remaining <span style="color:red">*</span></label>
                                                                <input type="text" name="tnk_remaining" class="form-control" value="{{$tank->tnk_remaining/1000}} " onkeypress="return isNumberKey(this, event);" required/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tnk_notes">Notes</label>
                                                                <input type="text" name="tnk_notes" class="form-control" value="{{$tank->tnk_notes}}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="text" class="form-control" name="tnk_uuid" value="{{ $tank->tnk_uuid }}"  hidden/>                            
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Refill Tank Modal -->
                                <div class="modal fade" id="tank-refill-modal-{{$tank->tnk_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Refill Form</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" id="form-add" action="{{ action('ProductionController@refillTank', [$tank->tnk_id]) }}">
                                            {{ csrf_field() }} 
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="tnk_name">Tank Name <span style="color:red">*</span></label>
                                                                <input type="text" name="tnk_name" class="form-control" value="{{$tank->tnk_name}}" readonly required/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tnk_capacity">Capacity (kg)<span style="color:red">*</span></label>
                                                                <input type="text" name="tnk_capacity" class="form-control" value="{{$tank->tnk_capacity / 1000}} kg" onkeypress="return isNumberKey(this, event);" readonly required/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tnk_remaining">Volume (kg) <span style="color:red">*</span></label>
                                                                <input type="text" name="tnk_remaining" class="form-control" placeholder="Input Volume" value="" onclick="this.select();" onkeypress="return isNumberKey(this, event);" required/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tnk_notes">Notes <span style="color:red">*</span></label>
                                                                <input type="text" name="tnk_notes" class="form-control" value="{{$tank->tnk_notes}}" readonly required/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="text" class="form-control" name="tnk_uuid" value="{{ $tank->tnk_uuid }}"  hidden/> 
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div> 

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-clock"></i> Tank Operation</h3>
                            <!-- <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div> -->
                        </div>
                        <!-- Opening -->
                        <div class="card-body" style="overflow-x:auto;">
                            <div class="row mb-3">
                                <div class="col-7">
                                    <small class="text-success">Opening Operations</small>
                                </div>
                                <!-- <div class="col-5 text-right text-white">
                                    <a class="btn btn-success btn-sm"><i class="fa fa-play mr-1"></i> Start</a>
                                </div> -->
                            </div>
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="50px">#</th>
                                        <th>Tank Name</th>
                                        <th>Tank Opening</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl-products">
                                    @if(isset($tanks))
                                        @foreach($tanks as $tank)
                                            <tr>
                                                <td><i>{{$tank->tnk_id}}</i></td>
                                                <td><i>{{$tank->tnk_name}}</i></td>
                                                <td>{!! get_opening_tank($tank->tnk_id, get_last_production_id()) !!}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <!-- Closing -->
                        <div class="card-body" style="overflow-x:auto;">
                            <div class="row mb-3">
                                <div class="col-8">
                                    <small class="text-danger">Closing Operations</small>
                                </div>
                            </div>
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="50px">#</th>
                                        <th>Tank Name</th>
                                        <th>Tank Closing</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl-products">
                                    @if(isset($tanks))
                                        @foreach($tanks as $tank)
                                            <tr>
                                                <td><i>{{$tank->tnk_id}}</i></td>
                                                <td><i>{{$tank->tnk_name}}</i></td>
                                                <td>{!! get_closing_tank($tank->tnk_id, get_last_production_id()) !!}</td>
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
    </section>
</div>
                    {{--<div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-gas-pump"></i> Tanks</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="50px">#</th>
                                        <th>Tank Name</th>
                                        <th>Capacity</th>
                                        <th>Volume</th>
                                        <th>Notes</th>
                                        <th></th>
                                        <th width="50px"></th>
                                    </tr>
                                </thead>
                                <tbody id="tbl-tanks">
                                    @if(isset($tanks))
                                        @foreach($tanks as $tank)
                                            @if($tank->tnk_remaining == 0)
                                                @php($refill_indicator = "table-danger" )
                                            @else
                                                @php($refill_indicator = "")
                                            @endif
                                            <tr class=" {{ $refill_indicator }} ">
                                                @if($tank->tnk_id)
                                                    <td class="text-danger">
                                                        {{$tank->tnk_id}}
                                                    </td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                                @if($tank->tnk_name)
                                                    <td>
                                                        {{$tank->tnk_name}}
                                                    </td>
                                                @else
                                                    <td>-</t/d>
                                                @endif
                                                @if($tank->tnk_capacity)
                                                    <td>
                                                        {{ number_format((float)$tank->tnk_capacity / 1000, 2) }} kg
                                                    </td>
                                                @else
                                                    <td>0 kg</td>
                                                @endif
                                                @if($tank->tnk_remaining)
                                                    <td>
                                                    {{ number_format((float)$tank->tnk_remaining / 1000, 2) }} kg
                                                        <a class="btn btn-transparent btn-sm text-danger" href="javascript:void(0)" data-toggle="modal" data-target="#tank-refill-modal-{{$tank->tnk_id}}"><i class="fa fa-sm fa-plus mr-1" aria-hidden="true"></i><i class="fa fa-gas-pump mr-1" aria-hidden="true"></i></a>
                                                    </td>
                                                @else
                                                    <td>
                                                        0 kg &nbsp;                                                    
                                                        <a class="btn btn-transparent btn-sm text-danger" href="javascript:void(0)" data-toggle="modal" data-target="#tank-refill-modal-{{$tank->tnk_id}}"><i class="fa fa-gas-pump mr-1" aria-hidden="true"></i> Refill</a>
                                                    </td>
                                                @endif
                                                @if($tank->tnk_notes)
                                                    <td>
                                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#tank-notes-modal-{{$tank->tnk_id}}"><i class="fa fa-eye"></i></a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <a href="javascript:void(0)" class="text-gray" style="cursor: not-allowed;" disabled><i class="fa fa-eye"></i></a>
                                                    </td>
                                                @endif
                                                
                                                    <td>
                                                        @if($tank->tnk_active == 1) 
                                                        <span class="badge badge-success">Active</span>
                                                            <a class="fa fa-toggle-on" type="button" href="{{ action('ProductionController@tankActivation', ['tnk_id' => $tank->tnk_id, 'tnk_active' => $tank->tnk_active]) }}" aria-hidden="true"></a>
                                                        @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                            <a class="fa fa-toggle-off" type="button" href="{{ action('ProductionController@tankActivation', ['tnk_id' => $tank->tnk_id, 'tnk_active' => $tank->tnk_active]) }}" aria-hidden="true"></a>
                                                        @endif
                                                    </td>
                                                <td>
                                                @if($tank->tnk_active == 0)
                                                    <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" data-toggle="dropdown" disabled><i class="fa fa-ellipsis-vertical"></i></button>
                                                @else    
                                                    <div class="dropdown">
                                                        <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" data-toggle="dropdown"><i class="fa fa-ellipsis-vertical"></i></button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#tank-edit-modal-{{$tank->tnk_id}}"><i class="fa fa-edit mr-2" aria-hidden="true"></i>Edit Info</a></li>
                                                            <!-- <li><a class="ml-3" href="{{ action('ProductionController@tankActivation', ['tnk_id' => $tank->tnk_id, 'tnk_active' => $tank->tnk_active]) }}"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Deactivate</a></li> -->
                                                        </ul>
                                                    </div>
                                                @endif
                                                </td>
                                            </tr>
                                            <!-- Edit Tank Modal -->
                                            <div class="modal fade" id="tank-edit-modal-{{$tank->tnk_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Tank Form</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST" id="form-add" action="{{ action('ProductionController@editTank', [$tank->tnk_id]) }}">
                                                        {{ csrf_field() }} 
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="tnk_name">Tank Name <span style="color:red">*</span></label>
                                                                            <input type="text" name="tnk_name" class="form-control" value="{{$tank->tnk_name}}" required/>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="tnk_capacity">Capacity (kg)<span style="color:red">*</span></label>
                                                                            <input type="text" name="tnk_capacity" class="form-control" value="{{$tank->tnk_capacity/1000}}" onkeypress="return isNumberKey(this, event);" required/>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="tnk_remaining">Remaining <span style="color:red">*</span></label>
                                                                            <input type="text" name="tnk_remaining" class="form-control" value="{{$tank->tnk_remaining/1000}} " onkeypress="return isNumberKey(this, event);" required/>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="tnk_notes">Notes</label>
                                                                            <input type="text" name="tnk_notes" class="form-control" value="{{$tank->tnk_notes}}" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="text" class="form-control" name="tnk_uuid" value="{{ $tank->tnk_uuid }}"  hidden/>                            
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Refill Tank Modal -->
                                            <div class="modal fade" id="tank-refill-modal-{{$tank->tnk_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Refill Form</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST" id="form-add" action="{{ action('ProductionController@refillTank', [$tank->tnk_id]) }}">
                                                        {{ csrf_field() }} 
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="tnk_name">Tank Name <span style="color:red">*</span></label>
                                                                            <input type="text" name="tnk_name" class="form-control" value="{{$tank->tnk_name}}" readonly required/>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="tnk_capacity">Capacity (kg)<span style="color:red">*</span></label>
                                                                            <input type="text" name="tnk_capacity" class="form-control" value="{{$tank->tnk_capacity / 1000}} kg" onkeypress="return isNumberKey(this, event);" readonly required/>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="tnk_remaining">Volume (kg) <span style="color:red">*</span></label>
                                                                            <input type="text" name="tnk_remaining" class="form-control" placeholder="Input Volume" value="" onclick="this.select();" onkeypress="return isNumberKey(this, event);" required/>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="tnk_notes">Notes <span style="color:red">*</span></label>
                                                                            <input type="text" name="tnk_notes" class="form-control" value="{{$tank->tnk_notes}}" readonly required/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="text" class="form-control" name="tnk_uuid" value="{{ $tank->tnk_uuid }}"  hidden/> 
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Notes Modal -->
                                            <div class="modal fade" id="tank-notes-modal-{{$tank->tnk_id}}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Notes</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-12">
                                                                {{ $tank->tnk_notes }}
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>--}}
                </div>

                

                {{-- <div class="col-md-12">
                    <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-gas-pump"></i> Tanks</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                </div>
                            </div>
                            <div class="card-body" style="overflow-x:auto;">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th width="50px">#</th>
                                            <th>Tank Name</th>
                                            <th>Capacity</th>
                                            <th>Volume</th>
                                            <th>Notes</th>
                                            <th></th>
                                            <th width="50px"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl-tanks">
                                        @if(isset($tanks))
                                            @foreach($tanks as $tank)
                                                @if($tank->tnk_remaining == 0)
                                                    @php($refill_indicator = "table-danger" )
                                                @else
                                                    @php($refill_indicator = "")
                                                @endif
                                                <tr class=" {{ $refill_indicator }} ">
                                                    @if($tank->tnk_id)
                                                        <td class="text-danger">
                                                            {{$tank->tnk_id}}
                                                        </td>
                                                    @else
                                                    <td>-</td>
                                                    @endif
                                                    @if($tank->tnk_name)
                                                        <td>
                                                            {{$tank->tnk_name}}
                                                        </td>
                                                    @else
                                                        <td>-</t/d>
                                                    @endif
                                                    @if($tank->tnk_capacity)
                                                        <td>
                                                            {{ number_format((float)$tank->tnk_capacity / 1000, 2) }} kg
                                                        </td>
                                                    @else
                                                        <td>0 kg</td>
                                                    @endif
                                                    @if($tank->tnk_remaining)
                                                        <td>
                                                        {{ number_format((float)$tank->tnk_remaining / 1000, 2) }} kg
                                                            <a class="btn btn-transparent btn-sm text-danger" href="javascript:void(0)" data-toggle="modal" data-target="#tank-refill-modal-{{$tank->tnk_id}}"><i class="fa fa-sm fa-plus mr-1" aria-hidden="true"></i><i class="fa fa-gas-pump mr-1" aria-hidden="true"></i></a>
                                                        </td>
                                                    @else
                                                        <td>
                                                            0 kg &nbsp;                                                    
                                                            <a class="btn btn-transparent btn-sm text-danger" href="javascript:void(0)" data-toggle="modal" data-target="#tank-refill-modal-{{$tank->tnk_id}}"><i class="fa fa-gas-pump mr-1" aria-hidden="true"></i> Refill</a>
                                                        </td>
                                                    @endif
                                                    @if($tank->tnk_notes)
                                                        <td>
                                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#tank-notes-modal-{{$tank->tnk_id}}"><i class="fa fa-eye"></i></a>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <a href="javascript:void(0)" class="text-gray" style="cursor: not-allowed;" disabled><i class="fa fa-eye"></i></a>
                                                        </td>
                                                    @endif
                                                    
                                                    <td>
                                                        @if($tank->tnk_active == 1) 
                                                        <span class="badge badge-success">Active</span>
                                                            <a class="fa fa-toggle-on" type="button" href="{{ action('ProductionController@tankActivation', ['tnk_id' => $tank->tnk_id, 'tnk_active' => $tank->tnk_active]) }}" aria-hidden="true"></a>
                                                        @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                            <a class="fa fa-toggle-off" type="button" href="{{ action('ProductionController@tankActivation', ['tnk_id' => $tank->tnk_id, 'tnk_active' => $tank->tnk_active]) }}" aria-hidden="true"></a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                    @if($tank->tnk_active == 0)
                                                    <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" data-toggle="dropdown" disabled><i class="fa fa-ellipsis-vertical"></i></button>
                                                    @else    
                                                        <div class="dropdown">
                                                            <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" data-toggle="dropdown"><i class="fa fa-ellipsis-vertical"></i></button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#tank-edit-modal-{{$tank->tnk_id}}"><i class="fa fa-edit mr-2" aria-hidden="true"></i>Edit Info</a></li>
                                                                <!-- <li><a class="ml-3" href="{{ action('ProductionController@tankActivation', ['tnk_id' => $tank->tnk_id, 'tnk_active' => $tank->tnk_active]) }}"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Deactivate</a></li> -->
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    </td>
                                                </tr>
                                                <!-- Refill Tank Modal -->
                                                <div class="modal fade" id="tank-refill-modal-{{$tank->tnk_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Refill Form</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="POST" id="form-add" action="{{ action('ProductionController@refillTank', [$tank->tnk_id]) }}">
                                                            {{ csrf_field() }} 
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="tnk_name">Tank Name <span style="color:red">*</span></label>
                                                                                <input type="text" name="tnk_name" class="form-control" value="{{$tank->tnk_name}}" readonly required/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="tnk_capacity">Capacity (kg)<span style="color:red">*</span></label>
                                                                                <input type="text" name="tnk_capacity" class="form-control" value="{{$tank->tnk_capacity / 1000}} kg" onkeypress="return isNumberKey(this, event);" readonly required/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="tnk_remaining">Volume (kg) <span style="color:red">*</span></label>
                                                                                <input type="text" name="tnk_remaining" class="form-control" placeholder="Input Volume" value="" onclick="this.select();" onkeypress="return isNumberKey(this, event);" required/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="tnk_notes">Notes <span style="color:red">*</span></label>
                                                                                <input type="text" name="tnk_notes" class="form-control" value="{{$tank->tnk_notes}}" readonly required/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="text" class="form-control" name="tnk_uuid" value="{{ $tank->tnk_uuid }}"  hidden/> 
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Edit Tank Modal -->
                                                <div class="modal fade" id="tank-edit-modal-{{$tank->tnk_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Tank Form</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="POST" id="form-add" action="{{ action('ProductionController@editTank', [$tank->tnk_id]) }}">
                                                            {{ csrf_field() }} 
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="tnk_name">Tank Name <span style="color:red">*</span></label>
                                                                                <input type="text" name="tnk_name" class="form-control" value="{{$tank->tnk_name}}" required/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="tnk_capacity">Capacity (kg)<span style="color:red">*</span></label>
                                                                                <input type="text" name="tnk_capacity" class="form-control" value="{{$tank->tnk_capacity/1000}}" onkeypress="return isNumberKey(this, event);" required/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="tnk_remaining">Remaining <span style="color:red">*</span></label>
                                                                                <input type="text" name="tnk_remaining" class="form-control" value="{{$tank->tnk_remaining/1000}} " onkeypress="return isNumberKey(this, event);" required/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="tnk_notes">Notes</label>
                                                                                <input type="text" name="tnk_notes" class="form-control" value="{{$tank->tnk_notes}}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="text" class="form-control" name="tnk_uuid" value="{{ $tank->tnk_uuid }}"  hidden/>                            
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--Notes Modal -->
                                                <div class="modal fade" id="tank-notes-modal-{{$tank->tnk_id}}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Notes</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                    <div class="col-md-12">
                                                                        {{ $tank->tnk_notes }}
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="col-md-4"> 
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-clock"></i> Tank Operation</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <!-- Opening -->
                        <div class="card-body" style="overflow-x:auto;">
                            <div class="row mb-3">
                                <div class="col-7">
                                    <small class="text-success">Opening Operations</small>
                                </div>
                                <!-- <div class="col-5 text-right text-white">
                                    <a class="btn btn-success btn-sm"><i class="fa fa-play mr-1"></i> Start</a>
                                </div> -->
                            </div>
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="50px">#</th>
                                        <th>Tank Name</th>
                                        <th>Tank Opening</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl-products">
                                    @if(isset($tanks))
                                        @foreach($tanks as $tank)
                                            <tr>
                                                <td><i>{{$tank->tnk_id}}</i></td>
                                                <td><i>{{$tank->tnk_name}}</i></td>
                                                <td>{!! get_opening_tank($tank->tnk_id, get_last_production_id()) !!}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <hr>
                        <!-- Closing -->
                        <div class="card-body" style="overflow-x:auto;">
                            <div class="row mb-3">
                                <div class="col-8">
                                    <small class="text-danger">Closing Operations</small>
                                </div>
                            </div>
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="50px">#</th>
                                        <th>Tank Name</th>
                                        <th>Tank Closing</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl-products">
                                    @if(isset($tanks))
                                        @foreach($tanks as $tank)
                                            <tr>
                                                <td><i>{{$tank->tnk_id}}</i></td>
                                                <td><i>{{$tank->tnk_name}}</i></td>
                                                <td>{!! get_closing_tank($tank->tnk_id, get_last_production_id()) !!}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}
                
            </div>
        </div>
    </section>
</div>

<!-- Add Tank Modal -->
<div class="modal fade" id="tank-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tank Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="form-add" action="{{ action('ProductionController@createTank') }}">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tnk_name">Tank Name <span style="color:red">*</span></label>
                                <input type="text" name="tnk_name" class="form-control" placeholder="Enter Tank Name" required/>
                            </div>
                            <div class="form-group">
                                <label for="tnk_capacity">Capacity (kg)<span style="color:red">*</span></label>
                                <input type="text" name="tnk_capacity" class="form-control" placeholder="Enter Capacity" onkeypress="return isNumberKey(this, event);" required/>
                            </div>
                            <div class="form-group">
                                <label for="tnk_notes">Notes</label>
                                <textarea name="tnk_notes" placeholder="Additional notes ..." class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection
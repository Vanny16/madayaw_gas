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
            
            <div class="row">
                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-info-circle"></i> Tank Status</h3>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="200px">Tank Name</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tank 1</td>
                                        <td>
                                            <div class="bg-dark" style="width: 100%;">
                                                <div class="bg-success text-center" style="width: 30%;">&nbsp;
                                                </div>
                                            </div>
                                            <strong class="mr-2">30%</strong>
                                            <small class="float-right">1500/5000 kgs</small>
                                        </td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>      
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <a class="btn btn-primary col-md-2 col-12 mb-1" href="javascript:void(0)" data-toggle="modal" data-target="#tank-modal"><i class="fa fa-plus mr-1"></i> Add New Tank</a>
                </div>

                <div class="col-md-8"> 
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
                                        <th>Remaining</th>
                                        <th>Notes</th>
                                        <th width="50px"></th>
                                    </tr>
                                </thead>
                                <tbody id="tbl-tanks">
                                    @if(isset($tanks))
                                        @foreach($tanks as $tank)
                                            @if($tank->tnk_remaining < $tank->tnk_capacity)
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
                                                        {{$tank->tnk_capacity}} kgs
                                                    </td>
                                                @else
                                                    <td>0 kg</td>
                                                @endif
                                                @if($tank->tnk_remaining)
                                                    <td>
                                                        {{$tank->tnk_remaining}} kgs &nbsp;
                                                        <a class="btn btn-default btn-sm text-danger" href="javascript:void(0)" data-toggle="modal" data-target="#tank-refill-modal-{{$tank->tnk_id}}"><i class="fa fa-gas-pump mr-1" aria-hidden="true"></i> Refill</a>
                                                    </td>
                                                @else
                                                    <td>
                                                        0 kg &nbsp;                                                    
                                                        <a class="btn btn-default btn-sm text-danger" href="javascript:void(0)" data-toggle="modal" data-target="#tank-refill-modal-{{$tank->tnk_id}}"><i class="fa fa-gas-pump mr-1" aria-hidden="true"></i> Refill</a>
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
                                                    <div class="dropdown">
                                                        <button class="btn btn-default bg-transparent btn-outline-trasparent" style="border: transparent;" data-toggle="dropdown"><i class="fa fa-ellipsis-vertical"></i></button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#tank-edit-modal-{{$tank->tnk_id}}"><i class="fa fa-edit mr-2" aria-hidden="true"></i>Edit Info</a></li>
                                                            <li><a class="ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#print-product-modal-{{--$product->prd_id--}}"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Deactivate</a></li>
                                                        </ul>
                                                    </div>
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
                                                                            <label for="tnk_capacity">Capacity <span style="color:red">*</span></label>
                                                                            <input type="text" name="tnk_capacity" class="form-control" value="{{$tank->tnk_capacity}} kgs" onkeypress="return isNumberKey(this, event);" readonly required/>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="tnk_remaining">Remaining <span style="color:red">*</span></label>
                                                                            <input type="text" name="tnk_remaining" class="form-control" placeholder="Enter Remaining" onkeypress="return isNumberKey(this, event);" required/>
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
                                                                            <label for="tnk_capacity">Capacity <span style="color:red">*</span></label>
                                                                            <input type="text" name="tnk_capacity" class="form-control" value="{{$tank->tnk_capacity}}" onkeypress="return isNumberKey(this, event);" required/>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="tnk_remaining">Remaining <span style="color:red">*</span></label>
                                                                            <input type="text" name="tnk_remaining" class="form-control" value="{{$tank->tnk_remaining}} kgs" onkeypress="return isNumberKey(this, event);" readonly required/>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="tnk_notes">Notes <span style="color:red">*</span></label>
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

                <div class="col-md-4"> 
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
                                        <th>Time Start</th>
                                        <th>Tank Opening</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl-products">
                                    <tr>
                                        <td class="text-danger">1</td>
                                        <td>Tank 1</td>
                                        <td>6:00 AM</td>
                                        <td>5000 kgs</td>
                                        </td>
                                    </tr>
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
                                        <th>Time End</th>
                                        <th>Tank Closing</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl-products">
                                    <tr>
                                        <td class="text-danger">1</td>
                                        <td>Tank 1</td>
                                        <td>3:00 PM</td>
                                        <td>2567 kgs</td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
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
                                <label for="tnk_capacity">Capacity <span style="color:red">*</span></label>
                                <input type="text" name="tnk_capacity" class="form-control" placeholder="Enter Capacity" onkeypress="return isNumberKey(this, event);" required/>
                            </div>
                            <div class="form-group">
                                <label for="tnk_notes">Notes <span style="color:red">*</span></label>
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
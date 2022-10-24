@extends('layouts.themes.admin.calendarmain')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Events Calendar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item">Events Calendar</li>
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
            @if(session('mod_calendar') == '1')  
                <div class="row mb-3">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#createEvent"><i class="fa fa-calendar-plus-o"></i> New Event</button>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-calendar"></i> Events Calendar</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                {!! $calendar->calendar() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>                 
    </section>
</div>
<div id="createEvent" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Event</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="{{ action('EventController@save') }}">
            {{ csrf_field() }}
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label for="evt_title">Title <span style="color:red;">*</span></label>
                        <input class="form-control" type="text" name="evt_title" value="{{ old('evt_title') }}" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="evt_details">Details <span style="color:red;">*</span></label>
                        {{-- <input class="form-control" type="text" name="evt_details" value="{{ old('evt_details') }}" required> --}}
                        <textarea class="form-control" name="evt_details" rows="5" required></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="evt_color">Legend</label>
                        <input class="form-control" type="color" name="evt_color" value="#ff0000">
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="evt_is_whole_day" name="evt_is_whole_day" onclick="myFunction()">
                            <label for="evt_is_whole_day" class="custom-control-label">Wholeday Event</label>
                        </div>
                    </div>
                        <label for="evt_start_date">Start Date</label>
                        <div class="col-md-12 mb-3">
                            <input class="form-control" type="date" id="evt_start_date" name="evt_start_date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" onchange="copyDate()">
                        </div> 
                    <div id="setDates">
                        <div class="col-md-12 mb-3">
                            <input class="form-control" type="time" id="evt_start_time" name="evt_start_time" value="{{ Carbon\Carbon::now()->format('H:i:s') }}" onchange="copyTime()">
                        </div> 
                        <label for="evt_end_date">End Date</label>
                        <div class="col-md-12 mb-3">
                            <input class="form-control" type="date" id="evt_end_date" name="evt_end_date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div> 
                        <div class="col-md-12 mb-3">
                            <input class="form-control" type="time" id="evt_end_time" name="evt_end_time" value="{{ Carbon\Carbon::now()->format('H:i:s') }}">
                        </div> 
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><span class="fas fa-save"></span> Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
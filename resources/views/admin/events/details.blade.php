@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Event Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item">Events Calendar</li>
                        <li class="breadcrumb-item active">Details</li>
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
                            Event Details
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="evt_title">Event Title <span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="evt_title" value="{{ $event->evt_title }}" readonly>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="evt_start_date">Start</label>
                                    <input class="form-control" type="text" value="{{ \Carbon\Carbon::parse($event->evt_start_date)->format('Y-m-d H:i:s') }}" disabled>
                                </div> 
                                 <div class="col-md-3 mb-3">
                                    <label for="evt_end_date">End</label>
                                    <input class="form-control" type="text" value="{{ \Carbon\Carbon::parse($event->evt_end_date)->format('Y-m-d H:i:s') }}" disabled>
                                </div> 
                        
                                <div class="col-md-12 mb-3">
                                    <div class="custom-control custom-checkbox">
                                        @if($event->evt_is_whole_day=='true')
                                        <input class="custom-control-input" type="checkbox" id="evt_is_whole_day" name="evt_is_whole_day" checked disabled>
                                        @else
                                        <input class="custom-control-input" type="checkbox" id="evt_is_whole_day" name="evt_is_whole_day" disabled>
                                        @endif
                                        <label for="evt_is_whole_day" class="custom-control-label">Wholeday Event</label>
                                    </div>
                                </div> 
                                <div class="col-md-12 mb-3">
                                    <label for="evt_details">Details <span style="color:red;">*</span></label>
                                    <textarea class="form-control" rows="5" readonly>{{ $event->evt_details }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <a class="btn btn-primary" href="{{ url()->previous() }}"><span class="fa fa-arrow-circle-left"></span> Back</a>
                                @if(session('mod_calendar') == '1')  
                                    <a class="btn btn-danger" href="{{ action('EventController@delete',[$event->evt_uuid]) }}"><span class="fa fa-trash"></span> Delete</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>                 
    </section>
</div>
@endsection
@extends('layouts.themes.public.nonav')
@section('content')
<div id="page-wrapper">
    <div class="container">
        @foreach($feedbacks as $feedback)
            <article class="card">
                <header class="card-header" style="color:white;background:maroon;"> Feedback Tracking </header>
                <div class="card-body">
                    <h6>Submitted by: <span style="color:maroon;font-weight:bold;">{{ $feedback->std_name }}</span></h6>
                    <article class="card">
                        <div class="card-body row">
                            <div class="col"> <strong>Date submitted</strong> <br>{{ $feedback->fbk_date_created }} </div>
                            <div class="col"> <strong>Contact:</strong> <br> <i class="fa fa-envelope"></i> {{ $feedback->std_email }} <br/> <i class="fa fa-phone"></i> {{ $feedback->std_mobile }} </div>
                            @if($feedback->dep_id)
                                <div class="col"> <strong>Department:</strong> <br> <i class="fa fa-institution"></i> {{ getDepartmentName($feedback->dep_id) }}</div>
                            @else 
                                <div class="col"> <strong>Department:</strong> <br> <i class="fa fa-institution"></i> [Not yet assigned]</div>
                            @endif
                            <div class="col"> <strong>Tracking #:</strong> <br> {{ $feedback->fbk_uuid }} </div>
                        </div>
                    </article>
                    <div class="track">
                        @if($feedback->fbk_status == '0')
                            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">For Validation</span> </div>
                            <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">For Action</span> </div>
                            <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">For Verification</span> </div>
                            <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Completed</span> </div>
                        @elseif($feedback->fbk_status == '1')
                            @if($feedback->tck_route == '0' or $feedback->tck_route == '-1')
                                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">For Validation</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">For Action</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">For Verification</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Completed</span> </div>
                            @elseif($feedback->tck_route == '1')
                                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">For Validation</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">For Action</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">For Verification</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Completed</span> </div>
                            @else
                                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">For Validation</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">For Action</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">For Verification</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Completed</span> </div>
                            @endif
                        @elseif($feedback->fbk_status == '-1')
                            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">For Validation</span> </div>
                            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"></span> </div>
                            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"></span> </div>
                            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Disapproved</span> </div>
                        @endif
                    </div>
                    <hr/>
                    @if($feedback->fbk_status == '-1')
                        <small><span class="fa fa-info-circle"></span> Disapproval Details:</small><br/>
                        <small>{!! $feedback->fbk_disapprove_details !!}</small>
                        <hr/>
                    @elseif($feedback->fbk_status == '1')
                        @if($feedback->tck_route == '1')
                            <small><span class="fa fa-info-circle"></span> Response Details:</small><br/>
                            <small>{{ getLatestAction($feedback->tck_id)->act_details }}</small><br/>
                            <form method="POST" action="{{ action('VerificationController@submitStudentVerification') }}">
                            {{ csrf_field() }}
                                @if(getLatestAction($feedback->tck_id)->act_status == '0' OR getLatestAction($feedback->tck_id)->act_status == '-1')
                                    <hr/>
                                    <input type="hidden" name="act_id" value="{{ getLatestAction($feedback->tck_id)->act_id }}" required/>
                                    <input type="hidden" name="tck_id" value="{{ getLatestAction($feedback->tck_id)->tck_id }}" required/>
                                    <input type="hidden" name="fbk_uuid" value="{{ $feedback->fbk_uuid }}" required/>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#disapproveModal-{{getLatestAction($feedback->tck_id)->act_id}}"><span class="fa fa-thumbs-down"></span> Return</button>
                                    <button type="submit" class="btn btn-success"><span class="fa fa-thumbs-up"></span> Accept</button>  
                                @endif
                            </form>
                            <hr/>
                            <div id="disapproveModal-{{getLatestAction($feedback->tck_id)->act_id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ action('VerificationController@disapproveStudentVerification') }}">
                                        {{ csrf_field() }} 
                                            <div class="modal-header">
                                                <h4 class="modal-title">Return Details</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <label for="act_reject_details">Please state the reason for return.</label>
                                                <textarea class="form-control" name="act_reject_details" rows="5" placeholder="Details of disapproval" required></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="tck_id" value="{{ getLatestAction($feedback->tck_id)->tck_id }}" required/>
                                                <input type="hidden" name="act_id" value="{{ getLatestAction($feedback->tck_id)->act_id }}" required/>
                                                <input type="hidden" name="fbk_uuid" value="{{ $feedback->fbk_uuid }}" required/>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger"><span class="fa fa-thumbs-down"></span> Disapprove</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @elseif($feedback->tck_route == '2')
                            <div class="mb-3">
                                <p><span class="fa fa-info-circle"></span> Response Details: <span class="badge badge-info">Feedback closed <span class="fa fa-lock"></span></span></p>
                                <p>{{ getLatestAction($feedback->tck_id)->act_details }}</p>
                                <hr/>
                            </div>
                            @if($feedback->tck_rate == null)
                                <div class="mb-3">
                                    How did you feel about our services?<br/>
                                </div>
                                <div class="mb-3">
                                    <a class="btn btn-default" href="{{ action('VerificationController@rate',['1',getLatestAction($feedback->tck_id)->tck_id,$feedback->fbk_uuid]) }}"><span class="fas fa-smile" style="color:#00730b"></span> Happy</a>
                                    <a class="btn btn-default" href="{{ action('VerificationController@rate',['2',getLatestAction($feedback->tck_id)->tck_id,$feedback->fbk_uuid]) }}"><span class="fas fa-meh" style="color:#35bd00"></span> Satisfied</a>
                                    <a class="btn btn-default" href="{{ action('VerificationController@rate',['3',getLatestAction($feedback->tck_id)->tck_id,$feedback->fbk_uuid]) }}"><span class="fas fa-sad-cry" style="color:#ffae00"></span> Disatisfied</a>
                                    <a class="btn btn-default" href="{{ action('VerificationController@rate',['4',getLatestAction($feedback->tck_id)->tck_id,$feedback->fbk_uuid]) }}"><span class="fas fa-frown" style="color:#ff4e00"></span> Sad</a>
                                    <a class="btn btn-default" href="{{ action('VerificationController@rate',['5',getLatestAction($feedback->tck_id)->tck_id,$feedback->fbk_uuid]) }}"><span class="fas fa-angry" style="color:#ff0000"></span> Angry</a>
                                    <hr/>
                                </div>
                            @endif
                        @endif
                    @endif
                    <a href="{{ action('MainController@main') }}" class="btn" style="color:white;background:maroon;"> <i class="fa fa-chevron-left"></i> Back to Home</a>
                </div>
            </article>
        @endforeach
    </div>
</div>
@endsection
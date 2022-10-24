@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Reply Message</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item">Messages</li>
                        <li class="breadcrumb-item active">Reply</li>
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
                <div class="col-md-3">
                    @include('admin.messages.sidebar') 
                </div>
                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Reply To Message</h3>
                        </div>
                        <form method="POST" action="{{ action('MessageController@sendSingle') }}">
                        {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="To:" value="{{ get_employee_name_by_uuid($message->msg_from) }}" readonly/> 
                                    <input type="hidden" name="msg_to" value="{{ $message->msg_from }}"> 
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Subject:" name="msg_subject" value="Re: {{ $message->msg_subject }}" required/> 
                                </div>
                                <div class="form-group">
                                    <textarea id="compose-textarea" class="form-control" style="height: 300px" name="msg_content">{{get_employee_name_by_uuid($message->msg_from)}} Wrote: {!! $message->msg_content !!}
                                    </textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
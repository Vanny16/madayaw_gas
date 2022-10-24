@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Read Message</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item">Messages</li>
                        <li class="breadcrumb-item active">Read</li>
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
                            <h3 class="card-title">Message Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input class="form-control" type="text" value="From: {{ get_employee_name_by_uuid($message->msg_from) }}" readonly/> 
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" value="Subject: {{ $message->msg_subject }}" readonly/> 
                            </div>
                            <div class="form-group">
                                <textarea id="compose-textarea" class="form-control" style="height: 300px" readonly>{!! $message->msg_content !!}</textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <a class="btn btn-primary" href="{{ action('MessageController@reply',[$message->msg_uuid]) }}"><i class="fas fa-reply"></i> Reply</a>
                                <a class="btn btn-primary" href="{{ action('MessageController@forward',[$message->msg_uuid]) }}"><i class="fas fa-share"></i> Forward</a>
                                <a class="btn btn-danger" href="{{ action('MessageController@deleteTo',[$message->msg_uuid]) }}"><i class="fa fa-trash"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
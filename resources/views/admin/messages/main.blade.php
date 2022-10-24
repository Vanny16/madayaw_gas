@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Inbox</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item">Messages</li>
                        <li class="breadcrumb-item active">Inbox</li>
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
                            <h3 class="card-title">Inbox</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="Search Mail">
                                    <div class="input-group-append">
                                        <div class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="mailbox-controls">
                                <a class="btn btn-default btn-sm" href="{{ action('MessageController@main') }}"><i class="fas fa-sync-alt"></i></a>
                                <div class="float-right">

                                </div>
                            </div>
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">
                                    <tbody>
                                        @forelse($messages as $message)
                                        <tr>
                                            <td class="mailbox-star">
                                                @if($message->msg_is_read=='0')
                                                    <span class="badge badge-warning">Unread</span>
                                                @endif
                                            </td>
                                            <td class="mailbox-name"><a href="{{ action('MessageController@read',[$message->msg_uuid]) }}">{{ get_employee_name_by_uuid($message->msg_from) }}</a></td>
                                            <td class="mailbox-subject">
                                                <b>
                                                    @if(strlen($message->msg_subject) > '20')
                                                        {!! substr($message->msg_subject,0,19) !!}...
                                                    @else
                                                        {!! $message->msg_subject !!}
                                                    @endif
                                                </b> 
                                                @if(strlen($message->msg_content) > '50')
                                                    - {!! substr($message->msg_content,0,49) !!}...
                                                @else
                                                    - {!! $message->msg_content !!}
                                                @endif
                                            </td>
                                            <td class="mailbox-date">{{ \Carbon\Carbon::parse($message->msg_date)->diffForHumans() }}</td>
                                            <td><a class="btn btn-danger btn-sm float-right" href="{{ action('MessageController@deleteTo',[$message->msg_uuid]) }}"><span class="fa fa-trash"></span></a></td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td>
                                                Currently, there are no messages in your inbox...
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer p-0">
                                <div class="mailbox-controls">
                                    <a class="btn btn-default btn-sm" href="{{ action('MessageController@main') }}"><i class="fas fa-sync-alt"></i></a>
                                    <div class="float-right">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
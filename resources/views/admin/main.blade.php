@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Home</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="{{ action('MainController@home') }}">Home</a></li>
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
                <div class="col-md-9"> 
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-bullhorn"></i> News and Announcements</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="time-label">
                                    <span class="bg-danger"><i class="fa fa-bullhorn"></i> News and Announcements</span>
                                    @if(session('mod_news') == '1')  
                                        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#createNews"><i class="fa fa-comment"></i> Compose</button>
                                    @endif
                                </div>
                                @foreach($news as $news_item)
                                    <div>
                                        <i class="fas fa-newspaper bg-blue"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($news_item->nws_date_created)->diffForHumans() }}</span>
                                            <h3 class="timeline-header">{{ $news_item->nws_title }}</h3>
                                            <div class="timeline-body">
                                                @if($news_item->nws_image != '')
                                                    <div class="thumbnail">
                                                        <a href="{{ asset('images/news/' . $news_item->nws_image) }}">
                                                            <img src="{{ asset('images/news/' . $news_item->nws_image) }}" alt="" style="width:100%">
                                                        </a>
                                                        <div class="caption">
                                                            <p>{{ $news_item->nws_content }}</p>
                                                        </div>
                                                    </div>
                                                @else
                                                    <p>{{ $news_item->nws_content }}</p>
                                                @endif
                                            </div>
                                            <div class="timeline-footer">
                                                @if(session('mod_news') == '1')  
                                                    {{-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeNews-{{$news_item->nws_id}}"><i class="fa fa-trash"></i> Delete</button> --}}
                                                    <a style="color:#dc3545;" href="javascript:void(0)" data-toggle="modal" data-target="#removeNews-{{$news_item->nws_id}}"><i class="fa fa-trash"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="modal fade" id="removeNews-{{$news_item->nws_id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Confirm Deletion</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete this news/announcement?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <a class="btn btn-danger btn-sm" href="{{ action('NewsController@delete',[$news_item->nws_id]) }}"><i class="fa fa-trash"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card direct-chat direct-chat-primary">
                        <div class="card-header bg-navy">
                            <h3 class="card-title"><span class="fa fa-comments"></span> Chat</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('admin.chat')
                        </div>
                        <div class="card-footer">
                            <form method="POST" action="{{ action('ChatController@send') }}">
                            {{ csrf_field() }}
                                <div class="input-group">
                                    <input type="text" name="cht_message" placeholder="Type Message ..." class="form-control">
                                    <span class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Send</button> 
                                    </span>  
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card card-info">
                        <div class="card-header border-bottom-0 bg-navy">
                            <h3 class="card-title"><i class="fa fa-birthday-cake" aria-hidden="true"></i> {{ date('F') }} celebrators</h3>
                        </div>
                        <div class="card-body pt-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                @forelse($birthdays as $birthday)
                                    <li class="item">
                                        <div class="product-img"> 
                                            <img class="img-size-50 img-circle" src="{{ asset(get_avatar($birthday->emp_id)) }}" alt="logs user image">
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-title">
                                                {{ $birthday->emp_last_name }}, {{ $birthday->emp_first_name }}
                                                <span class="badge badge-info float-right"></span>
                                            </a>
                                            <span class="product-description">
                                                {{-- {{ \Carbon\Carbon::parse($birthday->emp_birthdate)->diffInYears(today()) }} --}}
                                                {{ \Carbon\Carbon::parse($birthday->emp_birthdate)->format('M. d, Y') }}
                                                @if(\Carbon\Carbon::parse($birthday->emp_birthdate)->format('m-d') == date('m-d'))
                                                    <span class="badge badge-warning">TODAY</span>
                                                @endif
                                            </span> 
                                        </div>
                                    </li>
                                @empty
                                    <li class="item">
                                        <div class="product-img"> 
                                            
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-title">
                                                <span class="badge badge-info float-right"></span>
                                            </a>
                                            <span class="product-description">
                                                No celebrators for this month...
                                            </span> 
                                        </div>
                                    </li>
                                @endforelse
                            </ul>
                        </div> 
                        <div class="card-footer text-center">
                            
                        </div>
                    </div>
                    <div class="card card-info">
                        <div class="card-header border-bottom-0 bg-navy">
                            <h3 class="card-title"><i class="fas fa-users"></i> Recent users</h3>
                        </div>
                        <div class="card-body pt-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                @forelse($login_logs as $log)
                                    <li class="item">
                                        <div class="product-img"> 
                                            <img class="img-size-50 img-circle" src="{{ asset(get_avatar($log->emp_id)) }}" alt="logs user image">
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-title">
                                                {{ $log->emp_last_name }}, {{ $log->emp_first_name }}
                                                <span class="badge badge-info float-right"></span>
                                            </a>
                                            <span class="product-description">
                                                {{ \Carbon\Carbon::parse($log->log_date)->diffForHumans() }}
                                            </span> 
                                        </div>
                                    </li>
                                @empty
                                    <li class="item">
                                        <div class="product-img"> 
                                            
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-title">
                                                <span class="badge badge-info float-right"></span>
                                            </a>
                                            <span class="product-description">
                                                No logs for today...
                                            </span> 
                                        </div>
                                    </li>
                                @endforelse
                            </ul>
                        </div> 
                        <div class="card-footer text-center">
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<div class="modal fade" id="createNews">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Compose Announcement</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ action('NewsController@save') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="nws_title">Title <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="nws_title" name="nws_title" placeholder="Title" value="{{ old('nws_title') }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="nws_content">Message Content <span style="color:red;">*</span></label>
                                <textarea class="form-control" id="nws_content" name="nws_content" rows="4">{{ old('nws_content') }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3"> 
                                <label for="nws_image">Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="nws_image" name="nws_image" value="{{ old('nws_image') }}" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="nws_image">Choose file</label>
                                </div>
                                <small id="fileHelp" class="form-text text-muted">Please upload a valid image file in jpg or png format. Size of image should not be more than 1MB.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><span class="fas fa-save"></span> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@endsection
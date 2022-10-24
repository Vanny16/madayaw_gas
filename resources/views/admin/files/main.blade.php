@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">File Downloads</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item">File Downloads</li>
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

            @if(session('mod_amin') == '1')
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addModal"><span class="fa fa-cloud-upload"></span> Upload File</button>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><span class="fa fa-cloud-download"></span> Downloadable Files</h3>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="120px">Date Uploaded</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($file_downloads as $file_download)
                                        <tr>
                                            <td>
                                                <small><span class="fa fa-clock"></span> {{ \Carbon\Carbon::parse($file_download->fle_date_created)->addHour(-8)->diffForHumans() }}</small>
                                            </td>
                                            <td>
                                                <small><span class="fa fa-bookmark"></span> {{ $file_download->fle_title }}</small>
                                                <hr/>
                                                <small><span class="fa fa-book"></span> {{ $file_download->fle_description }}</small>
                                                @if(session('mod_amin') == '1')
                                                    <hr/><a style="color:#dc3545;" href="{{ action('DownloadController@remove',[$file_download->fle_uuid]) }}"><span class="fa fa-trash"></span></button>
                                                @endif
                                                <a class="btn btn-success btn-sm float-right" href="{{ action('DownloadController@download',[$file_download->fle_file]) }}"><span class="fa fa-cloud-download"></span> Download File</button>
                                            </td>
                                        </tr> 
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
                <h4 class="modal-title">New File Upload</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="{{ action('DownloadController@save') }}" enctype="multipart/form-data">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="fle_title">Title <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="fle_title" name="fle_title" placeholder="Title" value="{{ old('fle_title') }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="fle_description">Message Content <span style="color:red;">*</span></label>
                                <textarea class="form-control" id="fle_description" name="fle_description" rows="4">{{ old('fle_description') }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3"> 
                                <label for="fle_file">Attach File</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="fle_file" name="fle_file" value="{{ old('fle_file') }}" aria-describedby="inputGroupFileAddon01" required>
                                    <label class="custom-file-label" for="fle_file">Choose file</label>
                                </div>
                                <small id="fileHelp" class="form-text text-muted">Please upload a valid file in zip, rar, jpg, png, gif, txt, doc, docx, xls, xlsx, ppt, pptx, or pdf format. Size of image should not be more than 5MB.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Save</button> 
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
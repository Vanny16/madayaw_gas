@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">File Leave</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item active">File Leave</li>
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
                            <h3 class="card-title"><i class="fa fa-file-text"></i> File Leave</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="{{ action('LeaveController@leaverequest') }}" enctype="multipart/form-data">
                            {{ csrf_field() }} 
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="num_of_days">Number of Days</label>
                                            <input class="form-control" type="number" step=".5" id="num_of_days" name="num_of_days" placeholder="# of days" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="start_date">Start Date<span style="color:red;">*</span></label>
                                            <input class="form-control" type="date" id="start_date" name="start_date" onchange="copyDate()" required/>
                                        </div>
                                        <div class="col-md-4     mb-3">
                                            <label for="end_date">End Date<span style="color:red;">*</span></label>
                                            <input class="form-control" type="date" id="end_date" name="end_date" onchange="getNumDays();" required/>
                                        </div>
                                    </div>    
                                    <div class="row">
                                        <p style="font-size:15px; color:red;">*</p><p style="font-size:14px;">Note: .5 decimal indicates a half day on the end date. </p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="leave_type">Type of Leave<span style="color:red;">*</span></label>
                                            <select class="form-control" name="leave_type" required>
                                                <option value="1" selected>Vacation Leave</option>
                                                <option value="2">Sick Leave</option>
                                            </select> 
                                        </div>
                                        <div class="col-md-4 mb-3"> 
                                            <label for="flve_file">Attach File</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="flve_file" name="flve_file" value="{{ old('flve_file') }}" aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label" for="flve_file">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="approving_officer">Approving Officer<span style="color:red;">*</span></label>
                                            <select class="form-control" name="emp_id" required>
                                                    @foreach($employees as $employee)
                                                        @if(isset($emp_id))
                                                            @if($emp_id == $employee->emp_id)
                                                                <option value="{{ $employee->emp_id }}" selected {{$employee->emp_last_name }},  {{$employee->emp_first_name }}    {{$employee->emp_middle_name }}</option>
                                                            @else 
                                                                <option value="{{ $employee->emp_id }}" {{$employee->emp_last_name }},   {{$employee->emp_first_name }} {{$employee->emp_middle_name }}</option>
                                                            @endif
                                                            @else
                                                                <option value="{{ $employee->emp_id }}">{{  $employee->emp_last_name }}, {{   $employee->emp_first_name }} {{   $employee->emp_middle_name }}</option>
                                                            @endif
                                                    @endforeach
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <button type="submit" class="btn btn-success">Submit</button> 
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
 $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    
    $("#start_date").on('change',function() {
        var st_date = new Date($('#start_date').val());
        var en_date = new Date($('#end_date').val());
        var get_start_date = st_date.getDate();
        var get_end_date = en_date.getDate();
        var numOfDates = getBusinessDatesCount(st_date,en_date);
        $("#num_of_days").val((numOfDates));
    });

    $("#end_date").on('change',function() {
        var st_date = new Date($('#start_date').val());
        var en_date = new Date($('#end_date').val());
        var get_start_date = st_date.getDate();
        var get_end_date = en_date.getDate();
        var numOfDates = getBusinessDatesCount(st_date,en_date);
        $("#num_of_days").val((numOfDates));
    });

function getBusinessDatesCount(startDate, endDate) {
    let count = 0;
    const curDate = new Date(startDate.getTime());
    while (curDate <= endDate) {
        const dayOfWeek = curDate.getDay();
        if(dayOfWeek !== 0 && dayOfWeek !== 6) count++;
        curDate.setDate(curDate.getDate() + 1);
    }
    return count;
}
</script>
@endsection
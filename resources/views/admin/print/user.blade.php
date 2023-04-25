@extends('layouts.themes.admin.print')
@section('content')
<div class="row">
    <div class="col-md-12"> 
        <h3 style="text-align:center;"></h3>
        <p style="text-align:center;"></p>
    </div>
    <div class="col-md-12"> 
        <div class="card">
            <div class="card-header">  
                <div class="row">
                    <h3 class="card-title"><i class="fas fa-male"></i><i class="fas fa-female"></i> User Records</h3>
                    <div class="col-md-10 text-right text-gray order-lg-2 order-1 mb-3">
                        <small>
                            <i id="current-date-now"><?php echo date(" F d, Y"); ?> </i>
                            <i id="current-time-now" class="text-info ml-1" data-start="<?php echo time(); ?>"></i>
                        </small>
                    </div>
                </div>
            </div>
        </div>
            <div class="card-body">
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Address</th>
                            <th>user Type</th>
                        </tr>
                        <tr>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_user_details as $all_user_detail)
                        <tr>
                            <td>{{$all_user_detail->usr_full_name}}</td>
                            <td>{{$all_user_detail->usr_name}}</td>
                            <td>{{$all_user_detail->usr_address}}</td>
                            <td>{{$all_user_detail->typ_name}}</td>
                            @if($all_user_detail->usr_active == 0)
                                <td>
                                    <span class="badge badge-danger">Inactive</span>
                                </td>
                            @else
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                            @endif
                        </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"> 
    // Define a function to handle the beforeprint event
    function handleBeforePrint() {
        // Remove the event listener to prevent an infinite loop
        window.removeEventListener("beforeprint", handleBeforePrint);

        // Display a confirmation dialog to allow the user to select print settings
        if (confirm("Click 'OK' to show preview")) {
            // Open the print dialog
            setTimeout(function() {
                window.print();
            }, 500);
        }
        else{
            window.location.href = "{{ action('UserController@user') }}";
        }
    }

    // Add an event listener for the beforeprint event
    window.addEventListener("beforeprint", handleBeforePrint);

    // Call the print method when the page finishes loading
    window.addEventListener("load", function() {
        setTimeout(function() {
            window.print();
            window.location.href = "{{ action('UserController@user') }}";
        }, 500);
    });
</script>
@endsection


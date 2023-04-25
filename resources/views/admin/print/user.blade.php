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
                        </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"> 
    window.addEventListener("load", window.print());
</script>
@endsection


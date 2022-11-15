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
            @if(isset($all_customer_details))    
            <h3 class="card-title"><i class="fas fa-users"></i> Customer Records</h3>
            @else
            <h3 class="card-title"><i class="fas fa-users"></i> Customer Record</h3>
            @endif
        </div>
            <div class="card-body">
                <table class="table table-hover table-condensed">

                @if(isset($all_customer_details))
                    <thead>
                        <tr>
                            <th width="500px">Customer Name</th>
                            <th>Contact #</th>
                            <th width="500px">Address</th>
                            <th width="500px">Notes</th>
                            <th>Status</th>
                            <th width="20px"></th>
                        </tr>
                        <tr>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_customer_details as $all_customer_detail)
                        <tr>
                            <td>{{$all_customer_detail->cus_name}}</td>
                            <td>{{$all_customer_detail->cus_contact}}</td>
                            <td>{{$all_customer_detail->cus_address}}</td>
                            <td>{{$all_customer_detail->cus_notes}}</td>
                            @if($all_customer_detail->cus_active == 0)
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

                @elseif(isset($customer_details))
                    <thead>
                        <tr>
                            <th width="500px">Customer Name</th>
                            <th width="500px">Contact #</th>
                            <th width="500px">Address</th>
                            <th width="500px">Notes</th>
                            <th>Status</th>
                            <th width="20px"></th>
                        </tr>
                        <tr>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customer_details as $customer_detail)
                        <tr>
                            <td>{{$customer_detail->cus_name}}</td>
                            <td>{{$customer_detail->cus_contact}}</td>
                            <td>{{$customer_detail->cus_address}}</td>
                            <td>{{$customer_detail->cus_notes}}</td>
                            @if($customer_detail->cus_active == 0)
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
                @endif
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"> 
    window.addEventListener("load", window.print());
</script>
@endsection
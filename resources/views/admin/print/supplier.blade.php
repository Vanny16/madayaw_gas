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
            @if(isset($all_supplier_details))    
            <h3 class="card-title"><i class="fas fa-warehouse"></i> Suppliers Records</h3>
            @else
            <h3 class="card-title"><i class="fas fa-warehouse"></i> Suppliers Records</h3>
            @endif
        </div>
            <div class="card-body">
                <table class="table table-hover table-condensed">

                @if(isset($all_supplier_details))
                    <thead>
                        <tr>
                            <th>Supplier Name</th>
                            <th>Contact #</th>
                            <th>Address</th>
                            <th>Notes</th>
                            <th width="100px"></th>
                        </tr>
                        <tr>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_supplier_details as $all_supplier_detail)
                        <tr>
                            <td>{{$all_supplier_detail->sup_name}}</td>
                            <td>{{$all_supplier_detail->sup_contact}}</td>
                            <td>{{$all_supplier_detail->sup_address}}</td>
                            <td>{{$all_supplier_detail->sup_notes}}</td>
                            @if($all_supplier_detail->sup_active == 0)
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

                @elseif(isset($supplier_details))
                    <thead>
                        <tr>
                            <th width="200px">Supplier Name</th>
                            <th>Contact #</th>
                            <th>Address</th>
                            <th width="500px">Status</th>
                            <th>Notes</th>
                            <th width="20px"></th>
                        </tr>
                        <tr>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($supplier_details as $supplier_detail)
                        <tr>
                            <td>{{$supplier_detail->sup_name}}</td>
                            <td>{{$supplier_detail->sup_contact}}</td>
                            <td>{{$supplier_detail->sup_address}}</td>
                            <td>{{$supplier_detail->sup_notes}}</td>
                            @if($supplier_detail->sup_active == 0)
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
            window.location.href = "{{ action('SupplierController@manage') }}";
        }
    }

    // Add an event listener for the beforeprint event
    window.addEventListener("beforeprint", handleBeforePrint);

    // Call the print method when the page finishes loading
    window.addEventListener("load", function() {
        setTimeout(function() {
            window.print();
            window.location.href = "{{ action('SupplierController@manage') }}";
        }, 500);
    });
</script>
@endsection
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
            @if(isset($all_opposite_details))    
            <h3 class="card-title"><i class="fas fa-users"></i> Opposites Records</h3>
            @else
            <h3 class="card-title"><i class="fas fa-users"></i> Opposites Records</h3>
            @endif
        </div>
            <div class="card-body">
                <table class="table table-hover table-condensed">

                @if(isset($all_opposite_details))
                    <thead>
                        <tr>
                            <th width="500px">Product Name</th>
                            <th>SKU</th>
                            <th>Description</th>
                            <th width="500px">Quantity</th>
                            <th width="20px"></th>
                        </tr>
                        <tr>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_opposite_details as $all_opposite_detail)
                        <tr>
                            <td>{{$all_opposite_detail->ops_name}}</td>
                            <td>{{$all_opposite_detail->ops_sku}}</td>
                            <td>{{$all_opposite_detail->ops_description}}</td>
                            <td>{{$all_opposite_detail->ops_quantity}}</td>
                        </tr> 
                        @endforeach
                    </tbody>

                @elseif(isset($opposite_details))
                    <thead>
                        <tr>
                            <th width="200px">Product Name</th>
                            <th>SKU</th>
                            <th>Description</th>
                            <th width="480px">Quantity</th>
                            <th width="20px"></th>
                        </tr>
                        <tr>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($opposite_details as $opposite_detail)
                        <tr>
                            <td>{{$opposite_detail->ops_name}}</td>
                            <td>{{$opposite_detail->ops_sku}}</td>
                            <td>{{$opposite_detail->ops_description}}</td>
                            <td>{{$opposite_detail->ops_quantity}} pc/s</td>
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
            window.close();
        }
    }

    // Add an event listener for the beforeprint event
    window.addEventListener("beforeprint", handleBeforePrint);

    // Call the print method when the page finishes loading
    window.addEventListener("load", function() {
        setTimeout(function() {
            window.print();
            window.close();
        }, 500);
    });
</script>
@endsection
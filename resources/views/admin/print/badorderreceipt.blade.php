@extends('layouts.themes.admin.smallreceipt')
@section('content')
<div style="width:50mm;">
    <div class="card">
        <div class="card-header">
            <table width="100%">
                <tr>
                    <td><p><img src="{{ asset('img/accounts/logo-1.jpg' ) }}" style="width:30px;"></p></td>
                    <td><p style="text-align:center;"><strong> MADAYAW PETROLEUM AND GAS CORPORATION</strong></p></td>
                </tr>
                <tr>
                    <td colspan="2"><p style="text-align:center;"> Park Avenue Cor. Lakatan St., Brgy. Wilfredo Aquino, Agdao, Davao City<p></td>
                </tr>
            </table>
        </div>
        <h3>BAD ORDER RECEIPT</h3>
        <table width="100%">
            
                <tr>   
                    <td width="50%"><p><strong><i>{{ $bad_order->bo_ref_id }}</i></strong></p></td>
                    <td width="50%"><small>{{ $bad_order->bo_datetime }}</small></td>
                </tr>
        
        </table>  
    </div>
    <div class="row">
        <table>
            <tr>
                <td width="50%">Transaction ID:</td>
                <td width="50%">{{ $bad_order->trx_ref_id }}</td>
            </tr>
            <tr>
                <td width="50%">Customer Name:</td>
                <td width="50%">{{ $bad_order->cus_name }}</td>
            </tr>
            <tr>
                <td width="50%">Address:</td>
                <td width="50%">{{ $bad_order->cus_address }}</td>
            </tr>
            <tr>
                <td width="50%">Contact:</td>
                <td width="50%">{{ $bad_order->cus_contact }}</td>
            </tr>
        </table>
        <hr>
        <table>
            <tr>
                <td width="20%"><strong>Item</strong></td>
                <td colspan="1"></td>
                <td width="20%"><strong>Crates</strong></td>
                <td width="20%"><strong>Loose</strong></td>
                <td colspan="6"></td>
                <td width="20%"><strong>Qty</strong></td>
            </tr>
            
            @php($bo_qty = (($bad_order->bo_crates *  12) + $bad_order->bo_loose))
            <tr>
                <td width="20%">{{ $bad_order->prd_name }}</td>
                <td colspan="1"></td>
                <td width="20%">{{ $bad_order->bo_crates }}</td>
                <td width="20%">{{ $bad_order->bo_loose }}</td>
                <td colspan="6"></td>
                <td width="20%">{{ $bo_qty }}</td>
            </tr>
               
            <tr>
                <td colspan="12"><hr></td>
            </tr>
            <tr>
                <td colspan="1">Total</td>
                <td colspan="9"></td>
                <td colspan="1"><strong>{{ $bo_qty }}</strong></td>
            </tr>
            <tr>
                <td colspan="5"><br><br><br></td>
            </tr>
            <tr>
                <td colspan="5"> <span class="">_______________________<span></td>
            </tr>
            <tr>
                <td colspan="5">Signature over printed name</td>
            </tr>
        </table>
    </div>
    
</div>

<script type="text/javascript">
    // Define a function to handle the beforeprint event
    function handleBeforePrint() {
        // Remove the event listener to prevent an infinite loop
        window.removeEventListener("beforeprint", handleBeforePrint);

        // Display a confirmation dialog to allow the user to select print settings
        if (confirm("Do you want a receipt?")) {
            // Open the print dialog
            setTimeout(function() {
                window.print();
                @if(session('return_page')=="pos")
                    window.location.href = "{{ action('SalesController@main') }}";
                @else
                    window.location.href = "{{ action('ProductionController@manage') }}";
                @endif
            }, 500);
        }
        else{
            @if(session('return_page')=="pos")
                window.location.href = "{{ action('SalesController@main') }}";
            @else
                window.location.href = "{{ action('ProductionController@manage') }}";
            @endif
        }
    }

    // Add an event listener for the beforeprint event
    window.addEventListener("beforeprint", handleBeforePrint);

    // Call the print method when the page finishes loading
    window.addEventListener("load", function() {
        setTimeout(function() {
            window.print();
            @if(session('return_page')=="pos")
                window.location.href = "{{ action('SalesController@main') }}";
            @else
                window.location.href = "{{ action('ProductionController@manage') }}";
            @endif
        }, 500);
    });
</script>
@endsection
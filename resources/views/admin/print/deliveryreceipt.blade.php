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
        <h3>DELIVERY RECEIPT</h3>
        <table width="100%">
            <tr>
                <td width="50%"><p><strong><i>{{ $transactions->trx_ref_id }}</i></strong></p></td>
                <td width="50%"><small>{{ $transactions->trx_datetime }}</small></td>
            </tr>
        </table>
    </div>

    <div class="row">
        <table>
            <tr>
                <td width="50%">Customer Name:</td>
                <td width="50%">{{ $transactions->cus_name }}</td>
            </tr>
            <tr>
                <td width="50%">Address:</td>
                <td width="50%">{{ $transactions->cus_address }}</td>
            </tr>
            <tr>
                <td width="50%">Contact:</td>
                <td width="50%">{{ $transactions->cus_contact }}</td>
            </tr>
        </table>
        <hr>

        <table>
            <tr>
                <td width="20%"><strong>Unit</strong></td>
                <td width="20%"><strong>Item</strong></td>
                <td width="20%"><strong>Crate</strong></td>
                <td width="20%"><strong>Loose</strong></td>
                <td width="20%"><strong>Qty</strong></td>
            </tr>
            @foreach($pur_ins as $pur_in)
                @if($pur_in->prd_id_in <> '0')
                    @if($pur_in->can_type_in == 1)
                        @php($prd_name = $pur_in->prd_name)
                    @else
                        @foreach($ops_ins as $ops_in)
                            @if($ops_in->ops_id == $pur_in->prd_id)
                                @php($prd_name = $ops_in->ops_name)
                            @endif
                        @endforeach
                    @endif
                    <tr>
                        <td width="20%">IN</td>
                        <td width="20%">{{ $prd_name }}</td>
                        <td width="20%">{{ $pur_in->pur_crate_in }}</td>
                        <td width="20%">{{ $pur_in->pur_loose_in }}</td>
                        <td width="20%">{{ ($pur_in->pur_crate_in * 12) + $pur_in->pur_loose_in }}</td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <td colspan="5"><hr></td>
            </tr>
            @foreach($purchases as $purchase)
            <tr>
                <td width="20%">OUT</td>
                <td width="20%">{{ $purchase->prd_name }}</td>
                <td width="20%">{{ $purchase->pur_crate }}</td>
                <td width="20%">{{ $purchase->pur_loose }}</td>
                <td width="20%">
                    @if($purchase->prd_is_refillable == 1)
                        {{ ($purchase->pur_crate * 12) + $purchase->pur_loose }}
                    @else
                        {{ $purchase->pur_loose }}
                    @endif
                </td>
            </tr>
            @endforeach
            
            <tr>
                <td colspan="5"><hr></td>
            </tr>
            <tr>
                <td colspan="2">Issued by:</td>
                <td colspan="3">{{session('usr_full_name')}}</td>
            </tr>
            <tr>
                <td colspan="2">Received by:</td>
                <td colspan="3 ">{{ $transactions->cus_name }}</td>
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
        if (confirm("Print delivery receipt?")) {
            // Open the print dialog
            setTimeout(function() {
                window.print();
            }, 500);
        }
        else{
            window.location.href = "{{ action('SalesController@main') }}";
        }
    }

    // Add an event listener for the beforeprint event
    window.addEventListener("beforeprint", handleBeforePrint);

    // Call the print method when the page finishes loading
    window.addEventListener("load", function() {
        setTimeout(function() {
            window.print();
            window.location.href = "{{ action('SalesController@main') }}";
        }, 500);
    });
</script>

@endsection
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
        <h3>SALES RECEIPT</h3>
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
                <td width="50%">CD #:</td>
                <td width="50%">{{ $transactions->trx_can_dec }}</td>
            </tr>
            <tr>
                <td width="50%">DR #:</td>
                <td width="50%">{{ $transactions->trx_del_rec }}</td>
            </tr>
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
                <td width="20%"><strong>Item</strong></td>
                <td width="20%"><strong>Bnew</strong></td>
                <td width="20%"><strong>Price</strong></td>
                <td width="20%"><strong>Qty</strong></td>
                <td width="20%"><strong>Sub</strong></td>
            </tr>
            @php($total_deposit=0)
            @php($total_discount=0)
            @foreach($purchases as $purchase)
                @php($total_deposit += $purchase->pur_deposit)
                @php($total_discount += $purchase->pur_discount)
                    @php($new_can_qty = $purchase->pur_qty - (($purchase->pur_crate_in *  12) + $purchase->pur_loose_in))
                    <tr>
                        <td width="20%">{{ $purchase->prd_name }}</td>
                        <td width="20%">{{ number_format($purchase->prd_deposit, 2, '.', ',') }}</td>
                        <td width="20%">{{ number_format($purchase->pur_prd_price, 2, '.', ',') }}</td>
                        <td width="20%">{{ $purchase->pur_qty }}</td>
                        {{-- <td width="20%">{{ number_format($purchase->prd_deposit, 2, '.', ',') }}</td> --}}
                        <td width="20%">{{ number_format($purchase->pur_total, 2, '.', ',') }}</td>
                    </tr>
            @endforeach
            
            <tr>
                <td colspan="5"><hr></td>
            </tr>
            <tr>
                <td colspan="1">Gross</td>
                <td colspan="3"><hr></td>
                <td colspan="1"><strong>{{ number_format($transactions->trx_gross, 2, '.', ',') }}</strong></td>
            </tr>
            <tr>
                <td colspan="1">Brd-New</td>
                <td colspan="3"><hr></td>
                <td colspan="1"><strong>{{ number_format($total_deposit, 2, '.', ',') }}</strong></td>
            </tr>
            <tr>
                <td colspan="1">Discount</td>
                <td colspan="3"><hr></td>
                <td colspan="1"><strong>{{ number_format($total_discount, 2, '.', ',') }}</strong></td>
            </tr>
            <tr>
                <td colspan="1">Net Total</td>
                <td colspan="3"><hr></td>
                <td colspan="1"><strong>{{ number_format($transactions->trx_total, 2, '.', ',') }}</strong></td>
            </tr>
            <tr>
                <td colspan="1">M.O.P.</td>
                <td colspan="3"><hr></td>
                <td colspan="1">{{ $transactions->payment_name }}</td>
            </tr>
            <tr>
                <td colspan="1">Check #</td>
                <td colspan="3"><hr></td>
                <td colspan="1">{{ session('pmnt_check_no') }}</td>
            </tr>
            <tr>
                <td colspan="1">Received</td>
                <td colspan="3"><hr></td>
                <td colspan="1">{{ number_format($transactions->pmnt_received, 2, '.', ',') }}</td>
            </tr>
            <tr>
                <td colspan="1">Change</td>
                <td colspan="3"><hr></td>
                <td colspan="1">{{ number_format($transactions->pmnt_change, 2, '.', ',') }}</td>
            </tr>
            <tr>
                <td colspan="1">Balance</td>
                <td colspan="3"><hr></td>
                <td colspan="1">{{ number_format($transactions->trx_balance, 2, '.', ',') }}</td>
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
            }, 500);
        }
        else{
            window.location.href = "{{ action('PrintController@deliveryReceipt') }}";
        }
    }

    // Add an event listener for the beforeprint event
    window.addEventListener("beforeprint", handleBeforePrint);

    // Call the print method when the page finishes loading
    window.addEventListener("load", function() {
        setTimeout(function() {
            window.print();
            window.location.href = "{{ action('PrintController@deliveryReceipt') }}";
        }, 500);
    });
</script>


@endsection
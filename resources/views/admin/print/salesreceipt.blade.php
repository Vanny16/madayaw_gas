@extends('layouts.themes.admin.smallreceipt')
@section('content')
<div style="width:50mm;">
    <div class="card">
        <div class="card-header">
            <p style="text-align:center;"><strong> MADAYAW PETROLEUM AND GAS CORPORATION</strong></p>
            <p style="text-align:center;"> Park Avenue Cor. Lakatan St., Brgy. Wilfredo Aquino, Agdao, Davao City<p>
        </div>
        <small>{{ $transactions->trx_datetime }}</small>
        <p><strong><i>{{ $transactions->trx_ref_id }}</i></strong></p>
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
        </table>
        <hr>
        <table>
            <tr>
                <td width="20%"><strong>Item</strong></td>
                <td width="20%"><strong>Price</strong></td>
                <td width="20%"><strong>Qty</strong></td>
                <td width="20%"><strong>Deposit</strong></td>
                <td width="20%"><strong>Sub</strong></td>
            </tr>
            
            @foreach($purchases as $purchase)
            @php($new_can_qty = $purchase->pur_qty - (($purchase->pur_crate_in *  12) + $purchase->pur_loose_in))
            <tr>
                <td width="20%">{{ $purchase->prd_name }}</td>
                <td width="20%">{{ $purchase->prd_price }}</td>
                <td width="20%">{{ $purchase->pur_qty }}</td>
                <td width="20%">{{ number_format($purchase->pur_deposit, 2, '.', ',') }}</td>
                <td width="20%">{{ number_format($purchase->pur_total, 2, '.', ',') }}</td>
            </tr>
            @endforeach
            
            <tr>
                <td colspan="5"><hr></td>
            </tr>
            <tr>
                <td colspan="1">Total</td>
                <td colspan="3"><hr></td>
                <td colspan="1"><strong>{{ number_format($transactions->trx_total, 2, '.', ',') }}</strong></td>
            </tr>
            <tr>
                <td colspan="5"><br></td>
            </tr>
            <tr>
                <td colspan="5">Issued by:</td>
            </tr>
            <tr>
                <td colspan="5">Received by:</td>
            </tr>
        </table>
    </div>
</div>
<script type="text/javascript"> 
    // window.addEventListener("load", window.print());
    // window.location.href = "{{ action('SalesController@main') }}";
</script>
@endsection
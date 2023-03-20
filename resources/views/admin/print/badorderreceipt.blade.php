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
                <td colspan="6"></td>
                <td width="20%"><strong>Qty</strong></td>
            </tr>
            
            @php($bo_qty = (($bad_order->bo_crates *  12) + $bad_order->bo_loose))
            <tr>
                <td width="20%">{{ $bad_order->prd_name }}</td>
                <td colspan="6"></td>
                <td width="20%">{{ ($bad_order->bo_loose) }}</td>
            </tr>
            
     
            
            <tr>
                <td colspan="6"><hr></td>
            </tr>
            <tr>
                <td colspan="1">Total</td>
                <td colspan="6"></td>
                <td colspan="1"><strong>{{ number_format($bo_qty, 2, '.', ',') }}</strong></td>
            </tr>
            <tr>
                <td colspan="5"><br></td>
            </tr>
            <tr>
                <td colspan="2">Issued by:</td>
                <td colspan="3">{{session('usr_full_name')}}</td>
            </tr>
            <tr>
                <td colspan="2">Received by:</td>
                <td colspan="3 ">{{ $bad_order->cus_name }}</td>
            </tr>
        </table>
    </div>
    
</div>
<script type="text/javascript"> 
    window.addEventListener("load", window.print());
    // window.location.href = "{{ action('ProductionController@manage') }}";
</script>
@endsection
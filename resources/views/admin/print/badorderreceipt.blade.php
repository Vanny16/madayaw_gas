@extends('layouts.themes.admin.print')
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
                <td width="50%"><p><strong><i>{{ $bad_orders->bo_ref_id }}</i></strong></p></td>
                <td width="50%"><small>{{ $bad_orders->bo_datetime }}</small></td>
            </tr>
        
        </table>  
    </div>
    <div class="row">
        <table>
            <tr>
                <td width="50%">Transaction ID:</td>
                <td width="50%">{{ $transactions->trx_ref_id }}</td>
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
                <td width="20%">{{ $bad_orders->bo_loose }}</td>
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
                <td colspan="1">M.O.P.</td>
                <td colspan="3"><hr></td>
                <td colspan="1">{{ $transactions->payment_name }}</td>
            </tr>
            <tr>
                <td colspan="1">Paid</td>
                <td colspan="3"><hr></td>
                <td colspan="1">{{ number_format($transactions->pmnt_amount, 2, '.', ',') }}</td>
            </tr>
            <tr>
                <td colspan="1">Balance</td>
                <td colspan="3"><hr></td>
                <td colspan="1">{{ number_format($transactions->trx_balance, 2, '.', ',') }}</td>
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
                <td colspan="3 ">{{ $transactions->cus_name }}</td>
            </tr>
        </table>
    </div>
    
</div>
<!-- <div class="row">
    <div class="col-md-12"> 
        <h3 style="text-align:center;"></h3>
        <p style="text-align:center;"></p>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <p style="text-align:center;"><strong> MADAYAW PETROLEUM AND GAS CORPORATION</strong></p>
                <p style="text-align:center;"> Park Avenue Cor. Lakatan St., Brgy. Wilfredo Aquino, Agdao, Davao City<p>
            </div>
            <div class="row">
                <div class="col-md-2 col-12 mb-3">
                    <h5><strong>ORDER RECEIPT </strong></h5>
                </div>
                <div class="col-md-8 col-12 mb-6">
                    <p class="text-danger fa-2x mr-2" style="text-align:right;">NO. {{ $transactions->trx_ref_id }}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <table class="table table-borderless table-non-stripped">
                <tr class="bg-light" height="1px">
                    <td width="200px" style="border: border-collapse:collapse;"><strong>Customer Name:</strong></td>
                    <td colspan="5" style="border-bottom: 1px solid black; border-collapse:collapse;">{{ $transactions->cus_name }}</td>
                </tr>
                <tr class="bg-light" height="1px">
                    <td width="200px" style="border: border-collapse:collapse;"><strong>Address:</strong></td>
                    <td colspan="5" style="border-bottom: 1px solid black; border-collapse:collapse;">{{ $transactions->cus_address }}</td>
                </tr>
                <tr class="bg-light" height="1px">
                    <td width="200px" style="border: border-collapse:collapse;"><strong>Date:</strong></td>
                    <td colspan="5" style="border-bottom: 1px solid black; border-collapse:collapse;">{{ date("Y-m-d", strtotime($transactions->trx_datetime)) }}</td>
                </tr>
            </table>
        </div>

            <div class="row">
                <table class="table table-borderless table-non-stripped text-center" style="border: 1px solid black;">
                    <thead>
                        <tr>
                            <th width="70px" style="border: 1px solid black; border-collapse:collapse;">Unit</th>
                            <th width="500px" style="border: 1px solid black; border-collapse:collapse;">Trx-Reference ID</th>
                            <th width="70px" style="border: 1px solid black; border-collapse:collapse;">Loose</th>
                            <th width="500px" style="border: 1px solid black; border-collapse:collapse;">Description</th>
                            <th width="500px" style="border: 1px solid black; border-collapse:collapse;">Unit Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchases as $purchase)
                            <tr>
                                <td style="border: 1px solid black; border-collapse:collapse;">IN</td>
                                {{--<td style="border: 1px solid black; border-collapse:collapse;">{{ $bad_order->bo_ref_id }}</td>--}}
                                <td style="border: 1px solid black; border-collapse:collapse;"><strong>{{ $purchase->pur_loose }}</strong></td>
                                <td style="border: 1px solid black; border-collapse:collapse;">{{ $purchase->pur_qty }}</td>
                                <td style="border: 1px solid black; border-collapse:collapse;">{{ $purchase->prd_name }}</td>
                                <td style="border: 1px solid black; border-collapse:collapse;">{{ $purchase->prd_price }}</td>
                            </tr>
                        @endforeach
                        <tr class="text-success bg-white">
                            <td colspan="6"></td>
                            <td class="text-success"><strong>Total</strong></td>
                            <td class="text-success"><strong id="lbl_total" class="fa fa-2x">₱ {{ number_format($transactions->trx_total, 2, '.', ',') }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-2 col-12 mb-3">
                    <p>Issued By: </p>
                </div>
                <div class="col-md-8 col-12 mb-6" style="text-align:right;">
                    <p>Receive By: </p>
                </div>
            </div>
        </div>
    </div>
</div> -->
<script type="text/javascript"> 
    window.addEventListener("load", window.print());
    // window.location.href = "{{ action('SalesController@main') }}";
</script>
@endsection
@extends('layouts.themes.admin.print')
@section('content')
<div style="width: 57mm; height: 50mm;">
    <div class="row">
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
                    </div>
                    <div class="col-md-8 col-12 mb-6 text-center">
                        <span class="">{{ $transactions->trx_datetime }}</span>
                        <span class="text-danger mr-2">{{ $transactions->trx_ref_id }}</span>
                    </div>
                </div>
                <div class="card-body">
                <div class="row">
                <table class="">
                    <tr height="1px">
                        <td width="10%" style="border: border-collapse:collapse;">Customer:</td>
                        <td width="90%">{{ $transactions->cus_name }}</td>
                    </tr>
                    <tr height="1px">
                        <td width="10%" style="border: border-collapse:collapse;">Address:</td>
                        <td width="90%">{{ $transactions->cus_address }}</td>
                    </tr>
                </table>
            </div>
            <hr>
            
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
        </div>
        <!-- <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <p style="text-align:center;"><strong> MADAYAW PETROLEUM AND GAS CORPORATION</strong></p>
                    <p style="text-align:center;"> Park Avenue Cor. Lakatan St., Brgy. Wilfredo Aquino, Agdao, Davao City<p>
                </div>
                <div class="row">
                    <div class="col-md-2 col-12 mb-3">
                        <h5><strong>DELIVERY RECEIPT </strong></h5>
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
                                <th width="70px" style="border: 1px solid black; border-collapse:collapse;">Crates</th>
                                <th width="70px" style="border: 1px solid black; border-collapse:collapse;">Loose</th>
                                <th width="100px" style="border: 1px solid black; border-collapse:collapse;">Total Qty</th>
                                <th width="500px" style="border: 1px solid black; border-collapse:collapse;">Description</th>
                                <th width="500px" style="border: 1px solid black; border-collapse:collapse;">Unit Price</th>
                                <th width="500px" style="border: 1px solid black; border-collapse:collapse;">Deposit</th>
                                <th width="500px" style="border: 1px solid black; border-collapse:collapse;">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchases as $purchase)
                            
                            @php($new_can_qty = $purchase->pur_qty - (($purchase->pur_crate_in *  12) + $purchase->pur_loose_in))

                            <tr>
                                <td style="border: 1px solid black; border-collapse:collapse;">OUT</td>
                                <td colspan="2" style="border: 1px solid black; border-collapse:collapse;">(<strong>{{ $purchase->pur_crate }}</strong> x 12) + <strong>{{ $purchase->pur_loose }}</strong></td>
                                <td style="border: 1px solid black; border-collapse:collapse;">{{ $purchase->pur_qty }}</td>
                                <td style="border: 1px solid black; border-collapse:collapse;">{{ $purchase->prd_name }}</td>
                                <td style="border: 1px solid black; border-collapse:collapse;">{{ $purchase->prd_price }}</td>
                                <td style="border: 1px solid black; border-collapse:collapse;"><span class="text-secondary mr-2">({{ $purchase->prd_deposit }} x  <?php echo $new_can_qty; ?> )</span>= {{ $purchase->pur_deposit }}</td>
                                <td style="border: 1px solid black; border-collapse:collapse;">₱ {{ number_format($purchase->pur_total, 2, '.', ',') }}</td>
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
        </div>--}} -->
    </div>
</div>
<script type="text/javascript"> 
    // window.addEventListener("load", function() {
    // window.print();
    // });

    // window.location.href = "{{-- action('SalesController@main') --}}";
</script>
@endsection
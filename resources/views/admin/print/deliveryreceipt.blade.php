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
                <p style="text-align:center;"><strong> MADAYAW PETROLEUM AND GAS CORPORATION</strong></p>
                <p style="text-align:center;"> PARK Avenue Cor. Lakatan St., Brgy. Wilfredo Aquino, Agdao, Davao City<p>
            </div>
            <div class="row">
                <div class="col-md-2 col-12 mb-3">
                    <p><strong>DELIVERY RECEIPT </strong></p>
                </div>
                <div class="col-md-8 col-12 mb-6">
                    <p class="text-danger fa-2x mr-2" style="text-align:right;">NO. </p>
                </div>
            </div>
       
        </div>
        
            <p><strong>Customer Name: </strong></p>
            <p><strong>Date: </strong></p>
            <p><strong>Address: </strong></p>

            <div class="card-body">
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th width="500px" style="border: 1px solid black; border-collapse:collapse;">QTY</th>
                            <th width="500px" style="border: 1px solid black; border-collapse:collapse;">Unit</th>
                            <th width="500px" style="border: 1px solid black; border-collapse:collapse;">Description</th>
                            <th width="500px" style="border: 1px solid black; border-collapse:collapse;">Unit Price</th>
                            <th style="border: 1px solid black; border-collapse:collapse;">Amount</th>
                            <th width="20px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-light" height="1px">
                            <td colspan="5" style="border: 1px solid black; border-collapse:collapse;"></td>
                        </tr>
                        <tr class="text-success bg-white">
                            <td colspan="3"></td>
                            <td class="text-success"><strong>Total</strong></td>
                            <td class="text-success"><strong id="lbl_total" class="fa fa-2x">0.00</strong></td>
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
</div>
<script type="text/javascript"> 
    window.addEventListener("load", window.print());
</script>
@endsection
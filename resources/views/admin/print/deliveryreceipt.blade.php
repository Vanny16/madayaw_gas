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
                <p style="text-align:center;"> MADAYAW PETROLEUM AND GAS CORPORATION</p>
                <p style="text-align:center;"> PARK Avenue Cor. Lakatan St., Brgy. Wilfredo Aquino, Agdao, Davao City<p>
            </div>
            <div class="row">
                <div class="col-md-2 col-12 mb-3">
                    <p>DELIVERY RECEIPT </p>
                </div>
                <div class="col-md-8 col-12 mb-6">
                    <p class="text-danger fa-2x mr-2" style="text-align:right;">NO. </p>
                </div>
            </div>
       
        </div>
        
            <p>Customer Name: </p>
            <p>Date: </p>
            <p>Address: </p>

            <div class="card-body">
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th width="500px">QTY</th>
                            <th width="500px">Unit</th>
                            <th width="500px">Description</th>
                            <th width="500px">Unit Price</th>
                            <th>Amount</th>
                            <th width="20px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-light" height="1px">
                            <td colspan="8"></td>
                        </tr>
                        <tr class="text-success bg-white">
                            <td colspan="5"></td>
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
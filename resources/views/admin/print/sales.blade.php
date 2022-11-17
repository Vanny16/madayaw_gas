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
                    @if(isset($all_sales_details))    
                <h3 class="card-title"><i class="fas fa-shopping-cart"></i> Sales Records</h3>
                    @else
                <h3 class="card-title"><i class="fas fa-shopping-cart"></i> Sales Records</h3>
                    @endif
            </div>
            <div class="card-body">
                <table class="table table-hover table-condensed">

                @if(isset($all_sale_details))
                    <thead>
                        <tr>
                            <th width="200px">Gross Total</th>
                            <th>Discount</th>
                            <th width="500px">Amount Payable</th>
                            <th width="500px">Amount Paid</th>
                            <th>Balance</th>
                            <th width="20px"></th>
                        </tr>
                        <tr>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_sale_details as $all_sale_detail)
                        <tr>
                            <td>{{$all_sale_detail->sup_name}}</td>
                        </tr>
                        <tr>
                            <td>{{$all_sale_detail->sup_contact}}</td>
                        </tr>
                        <tr>
                            <td>{{$all_sale_detail->sup_address}}</td>
                        </tr>
                        <tr>
                            <td>{{$all_sale_detail->sup_notes}}</td>
                        </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"> 
    window.addEventListener("load", window.print());
</script>
@endsection
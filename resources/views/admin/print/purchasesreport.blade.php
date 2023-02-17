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
            @if(isset($all_purchases_reports))    
            <h3 class="card-title"><i class="fa fa-bar-chart"></i> Purchases  Reports</h3>
            @else
            <h3 class="card-title"><i  class="fa fa-bar-chart"></i> Purchases Report</h3>
            @endif
        </div>
            <div class="card-body">
                <table class="table table-hover table-condensed">

                @if(isset($all_purchases_reports))
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Crates</th>
                            <th>Loose</th>
                            <th>Deposit</th>
                            <th>Subtotal</th>
                            <th width="20px"></th>
                        </tr>
                        <tr>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_purchases_reports as $all_purchases_report)
                        <tr>
                            <td>{{$all_purchases_report->prd_name}}</td>
                            <td>₱ {{$all_purchases_report->prd_price, 2, '.', ','}}</td>
                            <td>{{$all_purchases_report->pur_crate}}</td>
                            <td>{{$all_purchases_report->pur_loose}}</td>
                            <td>₱ {{$all_purchases_report->pur_deposit, 2, '.', ','}}</td>
                            <td>₱ {{$all_purchases_report->pur_total, 2, '.', ','}}</td>
                        </tr> 
                        @endforeach
                    </tbody>

                @elseif(isset($purchases_reports))
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Crates</th>
                            <th>Loose</th>
                            <th>Deposit</th>
                            <th>Subtotal</th>
                            <th width="20px"></th>
                        </tr>
                        <tr>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchases_reports as $purchases_report)
                        <tr>
                            <td>{{$purchases_reports->prd_name}}</td>
                            <td>₱ {{$purchases_reports->prd_price, 2, '.', ','}}</td>
                            <td>{{$purchases_reports->pur_crate}}</td>
                            <td>{{$purchases_reports->pur_loose}}</td>
                            <td>₱ {{$purchases_reports->pur_deposit, 2, '.', ','}}</td>
                            <td>₱ {{$purchases_reports->pur_total, 2, '.', ','}}</td>
                        </tr> 
                        @endforeach
                    </tbody>
                @endif
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"> 
    window.addEventListener("load", window.print());
    window.location.href = "{{ action('ReportsController@transactions') }}";
</script>
@endsection
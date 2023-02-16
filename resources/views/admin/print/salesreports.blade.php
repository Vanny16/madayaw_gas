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
            @if(isset($all_sales_reports))    
            <h3 class="card-title"><i class=" fa fa-bar-chart"></i> Sales Reports</h3>
            @else
            <h3 class="card-title"><i class=" fa fa-bar-chart"></i> Sales Report</h3>
            @endif
        </div>
            <div class="card-body">
                <table class="table table-hover table-condensed">

                @if(isset($all_sales_reports))
                    <thead>
                        <tr>
                            <th>Prodcut Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Quantity Sold</th>
                            <th>Total Sales</th>
                            <th width="20px"></th>
                        </tr>
                        <tr>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_sales_reports as $all_sales_report)
                        <tr>
                            <td>{{$all_sales_report->sales_date_from}}</td>
                            <td>{{$all_sales_report->sales_date_to}}</td>
                            <td>{{$all_sales_report->prd_name}}</td>
                            <td>{{$all_sales_report->prd_description}}</td>
                            <td>₱ {{$all_sales_report->prd_price}}</td>
                            <td>{{$all_sales_report->total_sold}}</td>
                            <td>₱ {{$all_sales_report->total_sales}}</td>
                        </tr> 
                        @endforeach
                    </tbody>

                @elseif(isset($sales_reports))
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Descriptiom</th>
                            <th>Price</th>
                            <th>Quantity Sold</th>
                            <th>Total Sales</th>
                            <th width="20px"></th>
                        </tr>
                        <tr>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales_reports as $sales_report)
                        <tr>
                            <td>{{$sales_report->sales_date_from}}</td>
                            <td>{{$sales_report->sales_date_to}}</td>
                            <td>{{$sales_report->prd_name}}</td>
                            <td>{{$sales_report->prd_description}}</td>
                            <td>₱ {{$sales_report->prd_price}}</td>
                            <td>{{$sales_report->total_sold}}</td>
                            <td>₱ {{$sales_report->total_sales}}</td>
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
</script>
@endsection
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
            @if(isset($all_production_reports))    
            <h3 class="card-title"><i class="fas fa-male"></i><i class="fas fa-female"></i> Production  Reports</h3>
            @else
            <h3 class="card-title"><i class="fas fa-male"></i><i class="fas fa-female"></i> Production Report</h3>
            @endif
        </div>
            <div class="card-body">
                <table class="table table-hover table-condensed">

                @if(isset($all_transaction_reports))
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product Name</th>
                            <th>Empty Goods</th>
                            <th>Filled Canisters</th>
                            <th>Leakers</th>
                            <th>For Revalving</th>
                            <th>Scrap</th>
                            <th width="20px"></th>
                        </tr>
                        <tr>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_production_reports as $all_production_report)
                        <tr>
                            <td>{{$all_production_report->trx_ref_id}}</td>
                            <td>{{$all_production_report->usr_id}}</td>
                            <td>{{$all_production_report->cus_id}}</td>
                            <td>{{$all_production_report->trx_datetime}}</td>
                            <td>{{$all_production_report->trx_total}}</td>
                            <td>{{$all_production_report->trx_amount_paid}}</td>
                        </tr> 
                        @endforeach
                    </tbody>

                @elseif(isset($sales_reports))
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product Name</th>
                            <th>Empty Goods</th>
                            <th>Filled Canisters</th>
                            <th>Leakers</th>
                            <th>For Revalving</th>
                            <th>Scrap</th>
                            <th width="20px"></th>
                        </tr>
                        <tr>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($production_reports as $production_report)
                        <tr>
                            <td>{{$all_production_report->trx_ref_id}}</td>
                            <td>{{$all_production_report->usr_id}}</td>
                            <td>{{$all_production_report->cus_id}}</td>
                            <td>{{$all_production_report->trx_datetime}}</td>
                            <td>{{$all_production_report->trx_total}}</td>
                            <td>{{$all_production_report->trx_amount_paid}}</td>
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
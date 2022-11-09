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
            @if(isset($all_product_details))    
            <h3 class="card-title"><i class="fas fa-users"></i> Products Records</h3>
            @else
            <h3 class="card-title"><i class="fas fa-users"></i> Products Records</h3>
            @endif
        </div>
            <div class="card-body">
                <table class="table table-hover table-condensed">

                @if(isset($all_product_details))
                    <thead>
                        <tr>
                            <th width="200px">Prodcut Name</th>
                            <th>Description</th>
                            <th>SKU</th>
                            <th width="500px">Quantity</th>
                            <th width="20px"></th>
                        </tr>
                        <tr>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_product_details as $all_product_detail)
                        <tr>
                            <td>{{$all_product_detail->prd_name}}</td>
                            <td>{{$all_product_detail->prd_description}}</td>
                            <td>{{$all_product_detail->prd_sku}}</td>
                            <td>{{$all_product_detail->prd_quantity}}</td>
                        </tr> 
                        @endforeach
                    </tbody>

                @elseif(isset($product_details))
                    <thead>
                        <tr>
                            <th width="200px">Product Name</th>
                            <th>Description</th>
                            <th>SKU</th>
                            <th width="500px">Quantity</th>
                            <th width="20px"></th>
                        </tr>
                        <tr>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product_details as $product_detail)
                        <tr>
                            <td>{{$product_detail->prd_name}}</td>
                            <td>{{$product_detail->prd_description}}</td>
                            <td>{{$product_detail->prd_SKU}}</td>
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
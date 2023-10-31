@extends('layouts.themes.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Production</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Production History</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partials.alert')
                </div>
            </div>
            <div class="row">
                @if($pdn_flag)
                    <div class="col-12 text-white mb-3">
                        <a class="btn btn-success col-lg-2 col-md-3 col-12" href= "{{ action('ProductionController@toggleProduction')}}"><i class="fa fa-play mr-1"></i> Start Production</a>
                    </div>
                @else
                    <div class="col-12 text-white mb-3">
                        <a class="btn btn-danger col-lg-2 col-md-3 col-12" href= "{{ action('ProductionController@toggleProduction')}}"><i class="fa fa-stop mr-1"></i> End Production</a>
                    </div>
                @endif
            </div>
            <div class="row">
                
            </div>
        </div>
    </section>
</div>

<!-- Create Product Modal -->
@if(session('getProductionValues'))
    @php($prd_name = Session::get('getProductionValues')[0][0])
    @php($prd_sku = Session::get('getProductionValues')[0][1])
    @php($prd_price = Session::get('getProductionValues')[0][2])
    @php($prd_description = Session::get('getProductionValues')[0][3])
    @php($prd_reorder = Session::get('getProductionValues')[0][4])
    @php($sup_name = Session::get('getProductionValues')[0][5])
    @php($state = Session::get('getProductionValues')[0][6])
@else
    @php($prd_name = '')
    @php($prd_sku = '')
    @php($prd_price = '')
    @php($prd_description = '')
    @php($prd_reorder = '')
    @php($sup_name = '')
    @php($state = '')
@endif
<div class="modal fade show" id="product-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md show" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ action('ProductionController@createProduct') }}" enctype="multipart/form-data">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 text-center">
                                <img class="img-circle elevation-2" src="{{ asset('img/products/default.png') }}" alt="{{-- $product->prd_image --}}" style="max-height:150px; max-width:150px; min-height:150px; min-width:150px; object-fit:cover;"/>
                            <div class="col-12 text-center mb-4">
                            <a href="javascript:void(0);" class="">
                                <label class="btn btn-transparent btn-file">
                                    <i id="btn_choose_file" class="fa fa-solid fa-camera mr-2"></i><small>Upload Photo</small>
                                    <input type="file" class="custom-file-input" id="choose_file" name='prd_image' value="{{-- old('prd_image') --}}" aria-describedby="inputGroupFileAddon01" style="display: none;">
                                </label>
                            </a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="prd_name">Product Name <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="prd_name" placeholder="Enter Product Name" value="{{ $prd_name }}" required/>
                            </div>
                            <div class="form-group">
                                <label for="prd_sku">SKU <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="prd_sku" placeholder="Enter SKU" value="{{ $prd_sku }}" required/>
                            </div>
                            <div class="form-group">
                                <label for="prd_price">Price <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="prd_price" placeholder="Enter Price" value="" onkeypress="return isNumberKey(this, event);" required/>
                            </div>
                            <div class="form-group">
                                <label for="prd_description">Description <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="prd_description" placeholder="Enter Description" value="{{ $prd_description }}" required/>
                            </div>
                            <div class="form-group">
                                <label for="cus_contact">Reorder Point <span style="color:red">*</span></label>
                                <input type="text" name="prd_reorder" class="form-control" placeholder="Enter Reorder Point" value="{{ $prd_reorder }}" onkeypress="return isNumberKey(this, event);" maxlength="11" required></input>
                            </div>
                            <div class="form-group">
                                <label for="sup_id">Supplier <span style="color:red">*</span></label>
                                <div class="form-inline">
                                    <select class="form-control col-md-7" id="suppliers" name="sup_id" oninvalid="this.setCustomValidity('You have no suppliers yet. Please create atleast 1.')" oninput="setCustomValidity('')" required>
                                        @foreach($suppliers as $supplier)
                                            @if($supplier->sup_active == 0)
                                                @continue
                                            @else
                                                @if($sup_name == $supplier->sup_name )
                                                    @php($selected = "selected")
                                                @else
                                                    @php($selected = "")
                                                @endif
                                                <option value="{{ $supplier->sup_id }}" {{ $selected }}>{{ $supplier->sup_name }}</option>
                                            @endif
                                        @endforeach   
                                    </select> 
                                    <button type="button" class="btn btn-info form-control col-md-4 col-12 ml-md-4 mt-md-0 mx-sm-0 mt-3" data-toggle="modal" data-target="#supplier-modal" onclick="getNewProductValue(prd_name.value, prd_sku.value, prd_description.value, prd_reorder.value)"><i class="fa fa-plus-circle"></i> New Supplier</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                </div>
                <div class="modal-footer">
                    <input type="text" class="form-control" id="set_add_flag" name="add_flag" value="" hidden/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Supplier Modal -->
<div class="modal fade" id="supplier-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Supplier Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="form-add" action="{{ action('ProductController@createSupplier')}}">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sup_name">Supplier Name <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="sup_name" placeholder="Enter Supplier Name" value="" required/>
                            </div>

                            <div class="form-group">
                                <label for="sup_address">Address <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="sup_address" placeholder="Enter Supplier Address" value="" required/>
                            </div>

                            <div class="form-group">
                                <label for="sup_contact">Contact <span style="color:red">*</span></label>
                                <input type="text" name="sup_contact" class="form-control" placeholder="Enter Supplier Contact #" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" minlength="11" maxlength="11" required></input>
                            </div>

                            <div class="form-group">
                                <label for="sup_notes">Notes</label>
                                <textarea name="sup_notes" placeholder="Additional notes ..." class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
                <input type="text" id="sup_prd_name" name="sup_prd_name" hidden/>
                <input type="text" id="sup_prd_sku" name="sup_prd_sku" placeholder="Enter SKU" value="" hidden/>
                <input type="text" id="sup_prd_description" name="sup_prd_description"  hidden/>
                <input type="text" id="sup_prd_reorder" name="sup_prd_reorder"  hidden/>
            </form>
        </div>
    </div>
</div>

<!-- Add Quantity Modal -->
<div class="modal fade" id="add-quantity-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Quantity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ action('ProductionController@addQuantity') }}">
            {{ csrf_field() }} 
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="quantity"id="lbl-add">Amount to add <span style="color:red">*</span></label>
                                <div id="crate">
                                    <label for="quantity" id="lbl-crate">Crate<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="crate-quantity" name="crate_quantity" placeholder="Quantity"/>
                                </div>
                                <label for="quantity"id="lbl-loose">Loose <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="quantity" name="quantity" name="quantity" placeholder="Quantity"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="text" class="form-control" id="set_stockin_flag" name="stockin_flag" value="" hidden/>
                    <input type="text" class="form-control" id="set_stockin_id" name="stockin_prd_id" value="" hidden/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function addItem(flag){
        document.getElementById('set_add_flag').value = flag;
    }

    // function editItem(prd_id, prd_name, prd_sku, prd_price, prd_quantity, prd_description, prd_reorder_point, sup_id){
    //     alert(prd_id);
    //     document.getElementById('set_prd_id').value = prd_id;
    //     document.getElementById('set_prd_name').value = prd_name;
    //     // document.getElementById('set_prd_sku').value = prd_sku;
    //     // document.getElementById('set_prd_price').value = prd_price;
    //     // document.getElementById('set_prd_quantity').value = prd_quantity;
    //     // document.getElementById('set_prd_description').value = prd_description;
    //     // document.getElementById('set_prd_reorder').value = prd_reorder_point;
    //     // document.getElementById('set_sup_id').value = sup_id;
    // }

    function stockIn(prd_id, flag){
        document.getElementById('set_stockin_id').value = prd_id;
        document.getElementById('set_stockin_flag').value = flag;
        
        if(flag === 0){
            $("#add-quantity-modal").find("#lbl-add").show();
            $("#add-quantity-modal").find("#lbl-loose").hide();
            $("#add-quantity-modal").find("#lbl-crate").hide();
            $("#add-quantity-modal").find("#crate-quantity").hide();
        }else{
            $("#add-quantity-modal").find("#lbl-add").hide();
            $("#add-quantity-modal").find("#lbl-loose").show();
            $("#add-quantity-modal").find("#lbl-crate").show();
            $("#add-quantity-modal").find("#crate-quantity").show();
        }
    }
</script>
@endsection
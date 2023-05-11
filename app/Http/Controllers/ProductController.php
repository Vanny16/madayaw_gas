<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    public function manage()
    {
        $statuses = array(
            1 => 'All',
            2 => 'Active',
            3 => 'Inactive'
        );

        $default_status = '0';

        $products = DB::table('products')
        ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_for_POS', '=', '1')
        ->get();

        $suppliers = DB::table('suppliers')
        ->where('acc_id', '=', session('acc_id'))
        ->get();
        
        $pdn_flag = check_production_log();
        // dd($pdn_flag);
        return view('admin.products.manage',compact('statuses', 'default_status', 'products', 'suppliers', 'pdn_flag'));
    }

    public function opposite()
    {
        $statuses = array(
            1 => 'All',
            2 => 'Active',
            3 => 'Inactive'
        );

        $default_status = '0';

        $oppositions = DB::table('oppositions')
        ->where('acc_id', '=', session('acc_id'))
        ->get();

        $products = DB::table('products')
        ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_is_refillable', '=', '1')
        ->get();

        $customers = DB::table('customers')
        ->where('acc_id', '=', session('acc_id'))
        ->where('cus_active', '=', '1')
        ->get();

        $pdn_flag = check_production_log();
        // dd($suppliers);
        return view('admin.products.opposite',compact('customers', 'statuses', 'default_status', 'products', 'oppositions', 'pdn_flag'));
    }

    public function opsdeactivateProduct($ops_id)
    {
        DB::table('oppositions')
        ->where('ops_id', '=', $ops_id)
        ->update([
            'ops_active' => 0
        ]);

        session()->flash('successMessage','Opposite Product deactivated');
        return redirect()->action('ProductController@opposite');
    }

    public function opsreactivateProduct($ops_id)
    {
        DB::table('oppositions')
        ->where('ops_id', '=', $ops_id)
        ->update([
            'ops_active' => 1
        ]);

        session()->flash('successMessage','Opposite Product activated');
        return redirect()->action('ProductController@opposite');
    }

    public function addOpposition(Request $request)
    {
        $ops_name = $request->ops_name;
        $ops_sku = $request->ops_sku;
        $ops_description = $request->ops_description;
        $ops_quantity = $request->ops_quantity;
        $ops_notes = $request->ops_notes;

        $check_ops_name = DB::table('oppositions')
        ->where('acc_id', '=', session('acc_id'))
        ->where('ops_name','=', $ops_name)
        ->first();
        // dd($check_ops_name);
        if($check_ops_name != null)
        {
            session()->flash('errorMessage','Opposition canister already created');
            return redirect()->action('ProductController@opposite');
        }

        DB::table('oppositions')
        ->insert([
        'acc_id' => session('acc_id'),
        'ops_name' => $ops_name, 
        'ops_sku' => $ops_sku,
        'ops_uuid' => generateuuid(),
        'ops_description' => $ops_description,
        'ops_quantity' => $ops_quantity,
        'ops_notes' => $ops_notes
        ]);

        //IMAGE UPLOAD 
        if($request->file('ops_image'))
        {
            $ops_id = DB::table('oppostions')
            ->select('ops_id')
            ->orderBy('ops_id', 'desc')
            ->first();
    
            $file = $request->file('ops_image');

            $validator = Validator::make( 
                [
                    'file' => $file,
                    'extension' => strtolower($file->getClientOriginalExtension()),
                ],
                [
                    'file' => 'required',
                    'file' => 'max:3072', //3MB
                    'extension' => 'required|in:jpg,png,gif',
                ]
            );
    
            if ($validator->fails()) 
            {
                session()->flash('errorMessage',  "Invalid File Extension or maximum size limit of 5MB reached!");
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            $fileName = $ops_id->ops_id . '.' . $file->getClientOriginalExtension();
    
            Storage::disk('local')->put('img/customers/' . $fileName, fopen($file, 'r+'));

            DB::table('customers')
            ->where('ops_id','=',$ops_id->ops_id)
            ->update([
                'ops_image' => $fileName,
            ]);  
    
        }   

        session()->flash('successMessage','Opposition Product has been added');
        return redirect()->action('ProductController@opposite');
    }

    public function editOpposition(Request $request)
    {
        $ops_id = $request->ops_id;
        $ops_name = $request->ops_name;
        $ops_sku = $request->ops_sku;
        $ops_description = $request->ops_description;
        $ops_quantity = $request->ops_quantity;
        $ops_notes = $request->ops_notes;
        $ops_uuid = $request->ops_uuid;

        $check_ops_name = DB::table('oppositions')
        ->where('acc_id', '=', session('acc_id'))
        ->where('ops_name','=', $ops_name)
        ->first();
        // dd($check_ops_name);

        //   $check_uuid = DB::table('oppositions')
        // ->where('ops_id', '=', $ops_id)
        // ->where('ops_uuid', '=', null)
        // ->get();

        // // dd($check_uuid);
        // if($check_uuid != null)
        // {
        //     DB::table('oppositions')
        //     ->where('ops_id', '=', $ops_id)
        //     ->update([
        //         'ops_uuid' => generateuuid()
        //     ]);
        // }

        $sku_checker = DB::table('oppositions')
        ->where('acc_id', '=', session('acc_id'))
        ->where('ops_uuid', '<>', $ops_uuid)
        ->where('ops_sku','=',$ops_sku)
        ->first();
        // dd($sku_checker);
        if($sku_checker != null)
        {
            session()->flash('errorMessage','Opposition canister already created');
            return redirect()->action('ProductController@opposite');
        }

        DB::table('oppositions')
        ->where('ops_id', '=', $ops_id)
        ->update([
            'ops_name' => $ops_name,
            'ops_sku' => $ops_sku,
            'ops_description' => $ops_description,
            'ops_quantity' => $ops_quantity,
            'ops_notes' => $ops_notes
        ]);

        //IMAGE UPLOAD 
        if($request->file('ops_image'))
        {
            $ops_id = DB::table('oppostions')
            ->select('ops_id')
            ->orderBy('ops_id', 'desc')
            ->first();
    
            $file = $request->file('ops_image');

            $validator = Validator::make( 
                [
                    'file' => $file,
                    'extension' => strtolower($file->getClientOriginalExtension()),
                ],
                [
                    'file' => 'required',
                    'file' => 'max:3072', //3MB
                    'extension' => 'required|in:jpg,png,gif',
                ]
            );
    
            if ($validator->fails()) 
            {
                session()->flash('errorMessage',  "Invalid File Extension or maximum size limit of 5MB reached!");
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            $fileName = $ops_id->ops_id . '.' . $file->getClientOriginalExtension();
    
            Storage::disk('local')->put('img/customers/' . $fileName, fopen($file, 'r+'));

            DB::table('customers')
            ->where('ops_id','=',$ops_id->ops_id)
            ->update([
                'ops_image' => $fileName,
            ]);  
    
        }   

        session()->flash('successMessage','Opposition Product has been updated');
        return redirect()->action('ProductController@opposite');
    }

    public function createProduct(Request $request)
    {
        $prd_name = $request->prd_name;
        $prd_description = $request->prd_description;
        $prd_sku = $request->prd_sku;
        $prd_price = $request->prd_price;
        $prd_weight = $request->prd_weight;
        $prd_reorder = $request->prd_reorder;
        $sup_id = $request->sup_id;

        $sku_checker = DB::table('products')
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_sku','=',$prd_sku)
        ->first();

        if($sku_checker != null)
        {
            session()->flash('errorMessage','Product with this SKU already exists');
            return redirect()->action('ProductController@manage');
        }

        DB::table('products')
        ->insert([
        'prd_name'=> $prd_name,
        'acc_id' => session('acc_id'),
        'prd_uuid' => generateuuid(),
        'prd_description' => $prd_description,
        'prd_sku' => $prd_sku,
        'prd_price' => $prd_price,
        'prd_weight' => $prd_weight,
        'prd_reorder_point' => $prd_reorder,
        'prd_for_production' => 0,
        'prd_is_refillable' => 0,
        'prd_for_POS' => 1,
        'sup_id' => $sup_id
        ]);

        if($request->file('prd_image'))
        {
            $prd_id = DB::table('products')
            ->select('prd_id')
            ->orderBy('prd_id', 'desc')
            ->first();

            $file = $request->file('prd_image');

            $validator = Validator::make( 
                [
                    'file' => $file,
                    'extension' => strtolower($file->getClientOriginalExtension()),
                ],
                [
                    'file' => 'required',
                    'file' => 'max:3072', //3MB
                    'extension' => 'required|in:jpg,png,gif',
                ]
            );
            
            // dd(public_path());
    
            if ($validator->fails()) 
            {
                session()->flash('errorMessage',  "Invalid File Extension or maximum size limit of 5MB reached!");
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            $fileName = $prd_id->prd_id . '.' . $file->getClientOriginalExtension();
    
            Storage::disk('local')->put('img/products/' . $fileName, fopen($file, 'r+'));

            DB::table('products')
            ->where('prd_id','=',$prd_id->prd_id)
            ->update([
                'prd_image' => $fileName,
            ]);  
        }

        session()->flash('successMessage','Product has been added');
        return redirect()->action('ProductController@manage');
    }

    public function editProduct(Request $request)
    {
        $prd_id = $request->prd_id;
        $prd_name = $request->prd_name;
        $prd_description = $request->prd_description;
        $prd_sku = $request->prd_sku;
        $prd_price = $request->prd_price;
        $prd_deposit = $request->prd_deposit;
        $prd_reorder = $request->prd_reorder;
        $prd_weight = $request->prd_weight;
        $sup_id = $request->sup_id;
        $prd_uuid = $request->prd_uuid;
        $prd_quantity = (float)$request->prd_quantity;

        // $check_uuid = DB::table('products')
        // ->where('prd_id', '=', $prd_id)
        // ->where('prd_uuid', '=', null)
        // ->get();

        // if($check_uuid != null)
        // {
        //     DB::table('products')
        //     ->where('prd_id', '=', $prd_id)
        //     ->update([
        //         'prd_uuid' => generateuuid()
        //     ]);
        // }
            //test
        $sku_checker = DB::table('products')
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_uuid', '<>', $prd_uuid)
        ->where('prd_sku','=',$prd_sku)
        ->first();

        if($sku_checker != null)
        {
            session()->flash('errorMessage','Product with this SKU already exists');
            return redirect()->action('ProductController@manage');
        }

        $qty_checker = DB::table('products')
        ->where('prd_id', '=', $prd_id)
        ->select('prd_quantity')
        ->first();

        // if($qty_checker->prd_quantity > $prd_quantity)
        // {
        //     $subtracted_qty = $qty_checker->prd_quantity - $prd_quantity;
        //     (float)$prd_quantity = "-" . $subtracted_qty;
            
        //     DB::table('products')
        //     ->where('prd_id', '=', $prd_id)
        //     ->update([
        //         'prd_quantity' => $qty_checker->prd_quantity - $subtracted_qty
        //     ]);
            
        //     record_stockin($prd_id, $prd_quantity);
        // }

        DB::table('products')
        ->where('prd_id', '=', $prd_id)
        ->update([
            'prd_name' => $prd_name,
            'prd_description' => $prd_description,
            'prd_sku' => $prd_sku,
            'prd_price' => $prd_price,
            // 'prd_deposit' => $prd_deposit,
            'prd_reorder_point' => $prd_reorder, 
            'prd_weight' => $prd_weight,
            'sup_id' => $sup_id
        ]);

        if($request->file('prd_image'))
        {
            $file = $request->file('prd_image');

            $validator = Validator::make( 
                [
                    'file' => $file,
                    'extension' => strtolower($file->getClientOriginalExtension()),
                ],
                [
                    'file' => 'required',
                    'file' => 'max:3072', //3MB
                    'extension' => 'required|in:jpg,png,gif',
                ]
            );
            
            // dd(public_path());
    
            if ($validator->fails()) 
            {
                session()->flash('errorMessage',  "Invalid File Extension or maximum size limit of 5MB reached!");
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            $fileName = $request->prd_id . '.' . $file->getClientOriginalExtension();
    
            Storage::disk('local')->put('img/products/' . $fileName, fopen($file, 'r+'));

            DB::table('products')
            ->where('prd_id','=',$request->prd_id)
            ->update([
                'prd_image' => $fileName,
            ]);  
        }
        session()->flash('successMessage','Product details updated.');
        return redirect()->action('ProductController@manage');
    }

    public function addQuantity(Request $request)
    {
        $prd_id = $request->prd_id;
        $stockin_qty = (float)$request->prd_quantity;

        $quantity = DB::table('products')
        ->where('prd_id', '=', $prd_id)
        ->first();
        
        $prd_quantity = (float)$quantity->prd_quantity + $stockin_qty;

        DB::table('products')
        ->where('prd_id', '=', $prd_id)
        ->update([
            'prd_quantity' => (float)$prd_quantity,
        ]);
        
        record_stockin($prd_id, $stockin_qty);

        session()->flash('successMessage','Quantity added has been added');
        return redirect()->action('ProductController@manage');
    }
    
    public function deactivateProduct($prd_id)
    {
        DB::table('products')
        ->where('prd_id', '=', $prd_id)
        ->update([
            'prd_active' => 0
        ]);

        session()->flash('successMessage','Product deactivated');
        return redirect()->action('ProductController@manage');
    }

    public function reactivateProduct($prd_id)
    {
        DB::table('products')
        ->where('prd_id', '=', $prd_id)
        ->update([
            'prd_active' => 1
        ]);

        session()->flash('successMessage','Product activated');
        return redirect()->action('ProductController@manage');
    }

    public function searchProduct(Request $request)
    {
        $search_string = $request->search_string;

        $statuses = array(
            0 => 'Inactive',
            1 => 'Active',
            2 => 'All'
        );

        $default_status = $request->filter_status;

        $prd_active = array_search($request->filter_status, $statuses);

        $query = DB::table('products')
        ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        ->where('products.acc_id','=',session('acc_id'))
        ->where('prd_name','LIKE', $search_string . '%');

        // dd($search_string);

        if($prd_active != 2){
            $query = $query->where('prd_active', '=', $prd_active);
        }

        $products = $query->orderBy('prd_name')->get(); 

        $suppliers = DB::table('suppliers')
        ->get();

        return view('admin.products.manage', compact( 'statuses', 'default_status', 'products','prd_active','suppliers'));
    }

    public function createSupplier(Request $request)
    {
        $sup_name = $request->sup_name;
        $sup_address = $request->sup_address;
        $sup_contact = $request->sup_contact;
        $sup_notes = $request->sup_notes;

        $check_sup_name = DB::table('suppliers')
        ->where('acc_id', '=', session('acc_id'))
        ->where('sup_name','=', $sup_name)
        ->first();

        $prodValues = array(
            $request->sup_prd_name,
            $request->sup_prd_sku,
            $request->sup_prd_price,
            $request->sup_prd_deposit,
            $request->sup_prd_weight,
            $request->sup_prd_description,
            $request->sup_prd_reorder,
            $request->sup_name,
            'show'
        );
        // dd($prodValues);
        if($check_sup_name != null)
        {
            session()->flash('errorMessage','Supplier already exist');
            session()->flash('getProdValues', array( $prodValues));
        }
        else{
            $usr_id = DB::table('suppliers')
            ->insert([
            'sup_id' => session('sup_id'),
            'acc_id' => session('acc_id'),
            'sup_uuid' => generateuuid(),
            'sup_name' => $sup_name, 
            'sup_address' => $sup_address,
            'sup_contact' => $sup_contact,
            'sup_notes' => $sup_notes
            ]);

            session()->flash('successMessage','Supplier has been added');
            session()->flash('getProdValues', array( $prodValues));
        }

        return redirect()->action('ProductController@manage');
    }

    public function tradeCanisters(Request $request)
    {
        $opposition_canister_id = $request->opposition_canister;
        $madayaw_canister_id = $request->madayaw_canister;
        $trade_in_opposition_crates = $request->trade_in_opposition_crates;
        $trade_in_opposition_loose = $request->trade_in_opposition_loose;
        $trade_in_products_crates = $request->trade_in_madayaw_crates; 
        $trade_in_products_loose = $request->trade_in_madayaw_loose; 
        //dd($request);

        $oppositions = DB::table('oppositions')
        ->where('acc_id', '=', session('acc_id'))
        ->where('ops_id', '=', $opposition_canister_id)
        ->first();

        if($oppositions == null)
        {
            session()->flash('warningMessage','Opposition Canister empty!');
            return redirect()->action('ProductController@opposite');
        }

        $opposition_qty = ($oppositions->ops_quantity);

        $products = DB::table('products')
        ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_id', '=', $madayaw_canister_id)
        ->first();
        $product_qty = $products->prd_empty_goods;
        
        //CALCULATION
        $new_opposition_qty = $opposition_qty - (($trade_in_opposition_crates * 12) + $trade_in_opposition_loose);

        if($new_opposition_qty < 0)
        {
            $new_opposition_qty = 0;
        }

        DB::table('oppositions')
        ->where('ops_id', '=', $opposition_canister_id)
        ->update([
            'ops_quantity' => $new_opposition_qty
        ]);

        $new_products_qty = $product_qty + (($trade_in_products_crates * 12) + $trade_in_products_loose);
        
        DB::table('products')
        ->where('prd_id', '=', $madayaw_canister_id)
        ->update([
            'prd_empty_goods' => $new_products_qty
        ]);

        //ADD TO TRANSACTIONS AND PURCHASES
        $trx_id = DB::table('transactions')
        ->max('trx_id');

        if($trx_id == null){
            $trx_id = 1;
        }
        else{
            $trx_id += 1;
        }

        $ops_ref_id = "OPS-" . date('Y') . date('m') . date('d') . "-" . $trx_id;
        $ops_del_rec = $request->ops_del_rec;

        DB::table('transactions')
        ->insert([
            'trx_ref_id' => $ops_ref_id,
            'acc_id' => session('acc_id'),
            'usr_id' => session('usr_id'),
            'cus_id' => $opposition_canister_id,
            'trx_datetime' => date('Y-m-d') . " " . date('H:i:s'),
            'trx_date' => date('Y-m-d'),
            'trx_time' => date('H:i:s'),
            'trx_gross' => 0,
            'trx_total' => 0,
            'trx_amount_paid' => 0,
            'trx_balance' => 0,
            'trx_can_dec' => "N/A",
            'trx_del_rec' => $ops_del_rec,
            'pdn_id' => get_last_production_id()
        ]);

        DB::table('purchases')
        ->insert([
            'trx_id' => $trx_id,
            'prd_id' => $madayaw_canister_id,
            'prd_price' => 0,
            'pur_crate' => $trade_in_opposition_crates,
            'pur_loose' => $trade_in_opposition_loose,
            'pur_qty' => (($trade_in_opposition_crates * 12) + $trade_in_opposition_loose),
            'pur_discount' => 0,
            'pur_deposit' => 0,
            'prd_id_in' => $opposition_canister_id,
            'can_type_in' => 1,
            'pur_crate_in' => $trade_in_products_crates,
            'pur_loose_in' => $trade_in_products_loose,
            'pur_total' => 0
        ]);

        session()->flash('successMessage','Canister exchange saved!');
        return redirect()->action('ProductController@opposite');
    }

    public function searchOpposition(Request $request)
    {
        $search_string = $request->search_string;

        $statuses = array(
            0 => 'Inactive',
            1 => 'Active',
            2 => 'All'
        );

        $default_status = $request->filter_status;

        $ops_active = array_search($request->filter_status, $statuses);

        $query = DB::table('oppositions')
        ->join('products', 'products.prd_id', '=', 'oppositions.prd_id')
        ->where('oppositions.acc_id','=',session('acc_id'))
        ->where('ops_name','LIKE', $search_string . '%');

        // dd($search_string);

        if($ops_active != 2){
            $query = $query->where('ops_active', '=', $ops_active);
        }

        $oppositions = $query->orderBy('ops_name')->get(); 

        $products = DB::table('products')
        ->get();

        return view('admin.products.opposite', compact( 'statuses', 'default_status', 'oppostions','ops_active','products'));
    }

} 

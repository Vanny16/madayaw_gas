<?php

namespace App\Http\Controllers;

use App\EodReport;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Opposition;
use App\Product;
use App\Transaction;
use DB;

class OppositionController extends Controller
{
    public function opposite()
    {
        // $search_string = $request->search_string ?? null;
        
        // $default_status = $request->filter_status ?? 1;
        // // dd($search_string);
        // // $default_status = 0;

        // $statuses = array(
        //     1 => 'All',
        //     2 => 'Active',
        //     3 => 'Inactive'
        // );

        // $products = DB::table('products')
        // ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        // ->where('products.acc_id', '=', session('acc_id'))
        // ->where('prd_is_refillable', '=', '1')
        // ->get();

        $products = Product::index(); //OVERWRITE PREVIOUS QUERY FOR TESTING
        
        // $oppositions = DB::table('oppositions')
        // ->where('acc_id', '=', session('acc_id'))
        // ->get();
        
        $oppositions = Opposition::index(); //OVERWRITE PREVIOUS QUERY FOR TESTING

        // if($search_string != null || $default_status != null)
        // {
        //     $oppositions = DB::table('oppositions')
        //     ->where('acc_id', '=', session('acc_id'));

        //     if($search_string != null){
        //         $oppositions = $oppositions->where('ops_name','LIKE', $search_string . '%');
        //     }

        //     $oppositions = $oppositions->where('ops_active','=', $default_status)
        //     ->get();
        // }
        // else
        // {
        //     $oppositions = DB::table('oppositions')
        //     ->where('acc_id', '=', session('acc_id'))
        //     ->get();
        // }
        // dd($default_status);

        $customers = DB::table('customers')
        ->where('acc_id', '=', session('acc_id'))
        ->where('cus_active', '=', '1')
        ->get();

        $pdn_flag = check_production_log();
        // dd($suppliers);
        return view('admin.products.opposite',compact('customers', 'products', 'oppositions', 'pdn_flag'));
    }

    public function opsdeactivateProduct($ops_id)
    {
        DB::table('oppositions')
        ->where('ops_id', '=', $ops_id)
        ->update([
            'ops_active' => 0
        ]);

        session()->flash('successMessage','Opposite Product deactivated');
        return redirect()->action('OppositionController@opposite');
    }

    public function opsreactivateProduct($ops_id)
    {
        DB::table('oppositions')
        ->where('ops_id', '=', $ops_id)
        ->update([
            'ops_active' => 1
        ]);

        session()->flash('successMessage','Opposite Product activated');
        return redirect()->action('OppositionController@opposite');
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
            return redirect()->action('OppositionController@opposite');
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
        return redirect()->action('OppositionController@opposite');
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
            return redirect()->action('OppositionController@opposite');
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
        return redirect()->action('OppositionController@opposite');
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

    public function tradeCanisters(Request $request)
    {
        $opposition_canister_id = $request->opposition_canister;
        $madayaw_canister_id = $request->madayaw_canister;
        $trade_in_opposition_crates = $request->trade_in_opposition_crates;
        $trade_in_opposition_loose = $request->trade_in_opposition_loose;
        $trade_in_products_crates = $request->trade_in_madayaw_crates; 
        $trade_in_products_loose = $request->trade_in_madayaw_loose; 
        $opposition_name = $request->opposition_name;

        $oppositions = DB::table('oppositions')
        ->where('acc_id', '=', session('acc_id'))
        ->where('ops_id', '=', $opposition_canister_id)
        ->first();

        if($oppositions == null)
        {
            session()->flash('warningMessage','Opposition Canister empty!');
            return redirect()->action('OppositionController@opposite');
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
        $trx_id = Transaction::query()//NECESSARY FOR INDEX ; OVERWRITE PREVIOUS QUERY FOR TESTING ; USED TO VERIFY THE BAD ORDER
                            ->where('pdn_id', get_last_production_id())
                            ->orderBy('trx_id', 'desc')
                            ->count();

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
            'trx_opposition_name' => $opposition_name,
            'pdn_id' => get_last_production_id()
        ]);

        DB::table('purchases')
        ->insert([
            'trx_id' => $trx_id,
            'prd_id' => $madayaw_canister_id,
            'prd_price' => 0,
            'pur_crate' => $trade_in_opposition_crates + 0,
            'pur_loose' => $trade_in_opposition_loose + 0,
            'pur_qty' => (($trade_in_opposition_crates * 12) + $trade_in_opposition_loose) + 0,
            'pur_discount' => 0,
            'pur_deposit' => 0,
            'prd_id_in' => $opposition_canister_id,
            'can_type_in' => 1,
            'pur_crate_in' => $trade_in_products_crates + 0,
            'pur_loose_in' => $trade_in_products_loose + 0,
            'pur_total' => 0
        ]);

        $opposition_canister_name = DB::table('oppositions')->select('prd_name')
                        ->where('prd_id', '=', $opposition_canister_id)
                        ->first();

        saveForEodTables([
            'ref_id' => $ops_ref_id,
            'prd_id' => $madayaw_canister_id,
            'quantity' => (($trade_in_opposition_crates * 12) + $trade_in_opposition_loose) + 0,
            'pdn_id' => get_last_production_id(),
            'cus_id' => $opposition_canister_id,
            'cus_name' => $opposition_canister_name
            ],'4'
        );

        session()->flash('successMessage','Canister exchange saved!');
        return redirect()->action('OppositionController@opposite');
    }


}

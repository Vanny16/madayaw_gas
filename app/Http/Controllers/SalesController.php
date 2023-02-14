<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
Use DB;

class SalesController extends Controller
{
    //
    public function main()
    {
        $products = DB::table('products')
        ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        ->where('prd_for_POS', '=' ,'1')
        ->where('prd_quantity', '<>' ,'0.0')
        ->where('prd_active', '=' ,'1')
        ->get();
        // dd(compact('products'));

        $customers = DB::table('customers')
        ->where('acc_id', '=',session('acc_id'))
        ->where('cus_active', '=', '1')
        ->orderBy('cus_id')
        ->get();

        $oppositions = DB::table('oppositions')
        ->get();

        $transaction_id = DB::table('transactions')
        ->max('trx_id');

        return view('admin.sales.main', compact('products', 'customers', 'oppositions', 'transaction_id'));
    }

    public function createCustomer(Request $request)
    {
        $cus_name = $request->cus_name;
        $cus_address = $request->cus_address;
        $cus_contact = $request->cus_contact;
        $cus_notes = $request->cus_notes;

        $check_cus_name = DB::table('customers')
        ->where('acc_id', '=', session('acc_id'))
        ->where('cus_name','=', $cus_name)
        ->first();

        if($check_cus_name != null)
        {
            session()->flash('errorMessage','Customer name is already existing');
            return redirect()->action('SalesController@main');
        }

        $usr_id = DB::table('customers')
        ->insert([
        'acc_id' => session('acc_id'),
        'cus_uuid' => generateuuid(),
        'cus_name' => $cus_name, 
        'cus_address' => $cus_address,
        'cus_contact' => $cus_contact,
        'cus_notes' => $cus_notes
        ]);

        //IMAGE UPLOAD 
        if($request->file('cus_image'))
        {
            $cus_id = DB::table('customers')
            ->select('cus_id')
            ->orderBy('cus_id', 'desc')
            ->first();
    
            $file = $request->file('cus_image');

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
    
            $fileName = $cus_id->cus_id . '.' . $file->getClientOriginalExtension();
    
            Storage::disk('local')->put('img/customers/' . $fileName, fopen($file, 'r+'));

            DB::table('customers')
            ->where('cus_id','=',$cus_id->cus_id)
            ->update([
                'cus_image' => $fileName,
            ]);  
    
        }   
        session(['new_client' => $request->cus_name]);
        session()->flash('successMessage','New customer has been added');
        return redirect()->action('SalesController@main');
    }
    
    public function paymentSales(Request $request)
    {
        $trx_id = DB::table('transactions')
        ->max('trx_id');

        if($trx_id == null){
            $trx_id = 1;
        }
        else{
            $trx_id += 1;
        }

        $trx_ref_id = date('Y') . date('m') . date('d') . "-" . $trx_id;
        $prd_id = "";
        $prd_price = "";
        $pur_qty = "";
        $pur_crate = "";
        $pur_loose = "";
        $pur_total = "";
        $pur_crate_in = "";
        $pur_loose_in = "";
        $pur_deposit = "";
        $cus_id = "";
        
        $trx_total = $request->trx_total;
        $trx_amount_paid = $request->trx_amount_paid;
        $trx_balance = (double)$trx_amount_paid - (double)$trx_total;

        $list = $request->purchases;
        $selected_item_list  = $list;
        $purchase_row = explode(",#,", $selected_item_list);

        //for products variable
        $deduct_qty = 0;
        $add_empty_good_qty = 0;

        // dd($purchase_row);

        for($i = 0 ; $i < count($purchase_row) ; $i++)
        {
            $purchase_data = explode(",", $purchase_row[$i]);

            for($j = 0 ; $j < count($purchase_data) ; $j++)
            {
                $prd_id =  $purchase_data[0];
                $prd_price = $purchase_data[2];
                $pur_crate = $purchase_data[3];
                $pur_loose = $purchase_data[4];
                $pur_qty = (int)($purchase_data[3] * 12) + (int)($purchase_data[4]);
                $pur_deposit = $purchase_data[6];
                $pur_total = $purchase_data[7];
                $pur_crate_in = $purchase_data[8];
                $pur_loose_in = $purchase_data[9];
                $cus_id = $purchase_data[10];
            
            }
            
            DB::table('purchases')
            ->insert([
                'trx_id' => $trx_id,
                'prd_id' => $prd_id,
                'prd_price' => $prd_price,
                'pur_crate' => $pur_crate,
                'pur_loose' => $pur_loose,
                'pur_qty' => $pur_qty,
                'pur_deposit' => $pur_deposit,
                'pur_crate_in' => $pur_crate_in,
                'pur_loose_in' => $pur_loose_in,
                'pur_total' => $pur_total
            ]);


            $products = DB::table('products')
            ->where('prd_id', '=', $prd_id)
            ->first();

            if($products->prd_is_refillable == 1){
                $deduct_qty = (int)$products->prd_quantity - (int)$pur_qty;
                $add_empty_good_qty = (int)$products->prd_empty_goods + ((int)($pur_crate_in * 12) + $pur_loose_in);
            }
            else{
                $deduct_qty = (int)$products->prd_quantity - (int)$pur_qty;
            }

            // dd($add_empty_good_qty);  

            DB::table('products')
            ->where('prd_id', '=', $prd_id)
            ->update([
                'prd_quantity' => $deduct_qty,
                'prd_empty_goods' => $add_empty_good_qty
            ]);
        }

        DB::table('transactions')
        ->insert([
            'acc_id' => session('acc_id'),
            'usr_id' => session('usr_id'),
            'trx_ref_id' => $trx_ref_id,
            'cus_id' => $cus_id,
            'trx_datetime' => date('Y-m-d h:i:s'),
            'trx_date' => date('Y-m-d'),
            'trx_time' => date('h:i:s'),
            'trx_total' => $trx_total,
            'trx_amount_paid' => $trx_amount_paid,
            'trx_balance' => $trx_balance 
        ]);

        session(['latest_trx_id' => $trx_id]);

        session()->flash('successMessage','Transaction complete!');
        return redirect()->action('PrintController@receiptDetails');
    }

    public function addCanister(Request $request)
    {
        $ops_name = $request->ops_name;
        $ops_sku = $request->ops_sku;
        $ops_description = $request->ops_description;
        $ops_notes = $request->ops_notes;

        $check_ops_name = DB::table('oppositions')
        ->where('acc_id', '=', session('acc_id'))
        ->where('ops_name','=', $ops_name)
        ->first();

        if($check_ops_name != null)
        {
            session()->flash('errorMessage','Opposition canister already created');
            return redirect()->action('SalesController@main');
        }

        DB::table('oppositions')
        ->insert([
        'acc_id' => session('acc_id'),
        'ops_name' => $ops_name, 
        'ops_sku' => $ops_sku,
        'ops_description' => $ops_description,
        'ops_notes' => $ops_notes
        ]);

        //IMAGE UPLOAD 
        if($request->file('ops_image'))
        {
            $ops_id = DB::table('oppostion')
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

        session()->flash('successMessage','test');
        return redirect()->action('SalesController@main');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Customer;
use App\Opposition;
use App\Product;
use App\Purchase;
use App\Transaction;
Use DB;


class SalesController extends Controller
{
    //
    public function main()
    {
        // $products = DB::table('products')
        // ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        // ->where('prd_for_POS', '=' ,'1')
        // ->where('prd_quantity', '>' ,'0.0')
        // ->where('prd_active', '=' ,'1')
        // ->get();

        $products = Product::POSIndex(); //OVERWRITE PREVIOUS QUERY FOR TESTING

        // $customers = DB::table('customers')
        // ->where('acc_id', '=',session('acc_id'))
        // ->where('cus_active', '=', '1')
        // ->orderBy('cus_name', 'ASC')
        // ->get();

        $customers = Customer::POSIndex(); //OVERWRITE PREVIOUS QUERY FOR TESTING

        // $transactions = DB::table('transactions')
        // ->join('customers', 'customers.cus_id', '=', 'transactions.cus_id')
        // ->where('transactions.acc_id', '=', session('acc_id'))
        // ->where('trx_active','=','1')
        // ->get();

        $transactions = Transaction::query()//NECESSARY FOR INDEX ; OVERWRITE PREVIOUS QUERY FOR TESTING ; USED TO VERIFY THE BAD ORDER
                                ->where('pdn_id', get_last_production_id())
                                ->orderBy('trx_id', 'desc')
                                ->count();
                                
                                // dd($transactions);

        $purchased_products = DB::table('products') //NECESSARY FOR INDEX ; USED TO VERIFY THE BAD ORDER
        ->join('purchases', 'purchases.prd_id', '=', 'products.prd_id')
        ->get();

        // $purchased_products = Purchase::POSIndex(); //OVERWRITE PREVIOUS QUERY FOR TESTING

        // $oppositions = DB::table('oppositions')
        // ->get();

        // $oppositions = Opposition::all(); //OVERWRITE PREVIOUS QUERY FOR TESTING

        // $transaction_id = DB::table('transactions')
        // ->max('trx_id');

        $transaction_id = Transaction::query()//NECESSARY FOR INDEX ; OVERWRITE PREVIOUS QUERY FOR TESTING ; USED TO VERIFY THE BAD ORDER
                                    ->where('pdn_id', get_last_production_id())
                                    ->orderBy('trx_id', 'desc')
                                    ->count();
        
        // $in_products = DB::table('products')
        // ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        // ->where('prd_for_POS', '=' ,'1')
        // // ->where('prd_id', '=' ,$cus_accessibles[$i])
        // ->where('prd_quantity', '>' ,'0.0')
        // ->where('prd_active', '=' ,'1')
        // ->get();

        session()->forget('selected_customer');

        return view('admin.sales.main', compact('products', 'customers', 'transaction_id')); //'oppositions', 'in_products' 'transactions',  'purchased_products', 
    }

    public function payments()
    {
        $payments_date_from = "";
        $payments_date_to = "";
        $paginate_row = session('paginate_row') ?? '50';

        $transactions = DB::table('transactions')
        ->join('customers', 'customers.cus_id', '=', 'transactions.cus_id')
        ->join('payment_types', 'payment_types.mode_of_payment', '=', 'transactions.mode_of_payment')
        ->where('trx_active','=','1')
        ->orderBy('transactions.trx_ref_id', 'DESC')
        ->paginate($paginate_row);

        $payments = DB::table('payments')
        ->join('transactions', 'transactions.trx_id', '=', 'payments.trx_id')
        ->join('payment_types', 'payment_types.mode_of_payment', '=', 'payments.trx_mode_of_payment')
        ->join('users', 'users.usr_id', '=', 'payments.usr_id')
        ->select('trx_mode_pf_payment As pmnt_amount_cash FROM transactions where mode_of_payment')
        ->wherebetween('transactions.trx_amount_paid', [$date_from, $date_to])
        ->get();
        // 'trx_mode_of_payment' => $mode_of_payment,
        // 'pmnt_amount' => $trx_amount_cash,
        
        session(['select_show' => 'Transactions']);

        return view('admin.sales.payments', compact('payments', 'transactions', 'payments_date_from', 'payments_date_to'));
    }

    public function selectCustomer(Request $request)
    {
        $client_id = $request->input('client_id');

        if($client_id[0] == ""){
            return redirect()->action('SalesController@main');
        }

        // if($client_id == 0){
        //     return redirect()->action('SalesController@main');
        // }

        // $selected_customer = DB::table('customers')
        // ->where('acc_id', '=',session('acc_id'))
        // ->where('cus_active', '=', '1')
        // ->where('cus_name', '=', $client_id[0] )
        // // ->where('cus_id', '=', $client_id )
        // ->orderBy('cus_name', 'ASC')
        // ->first();
        //  dd($selected_customer);

        $selected_customer = Customer::POSSelectCustomer($client_id[0]);//OVERWRITE PREVIOUS QUERY FOR TESTING

        if($selected_customer == null){

            session()->flash('errorMessage',  "Customer name not found!");
            return $this->main();
        }
        
        $cus_accessibles_list = $selected_customer->cus_accessibles;
        $cus_accessibles = explode(",", $cus_accessibles_list);
        
        $cus_accessibles_prices_list = $selected_customer->cus_accessibles_prices;
        $cus_accessibles_prices = explode(",", $cus_accessibles_prices_list);
            
        $cus_price_change = $selected_customer->cus_price_change;

        if($cus_price_change == null){
            $cus_price_change = 0;
        }

        $products = array();

        for ($i = 0; $i < count($cus_accessibles)-1; $i++) {
            $product = DB::table('products')
                ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
                ->where('prd_for_POS', '=' ,'1')
                ->where('prd_id', '=' ,$cus_accessibles[$i])
                // ->where('prd_quantity', '>' ,'0.0')
                ->where('prd_active', '=' ,'1')
                ->first();
                
            if ($product !== null) {
                $product = json_decode(json_encode($product), true);
                $product['cus_accessibles_prices'] = $cus_accessibles_prices[$i] + $cus_price_change;
                array_push($products, (object)$product);
            }
        }
        
        session()->flash('selected_customer',$selected_customer->cus_name);

        $in_products = DB::table('products')
        ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        ->where('prd_for_POS', '=' ,'1')
        // ->where('prd_id', '=' ,$cus_accessibles[$i])
        // ->where('prd_quantity', '>' ,'0.0')
        ->where('prd_active', '=' ,'1')
        ->get();

        $customers = DB::table('customers')
        ->where('acc_id', '=',session('acc_id'))
        ->where('cus_active', '=', '1')
        ->orderBy('cus_name', 'ASC')
        ->get();

        $customers = Customer::POSIndex(); //OVERWRITE PREVIOUS QUERY FOR TESTING

        // $transactions = DB::table('transactions')
        // ->join('customers', 'customers.cus_id', '=', 'transactions.cus_id')
        // ->where('transactions.acc_id', '=', session('acc_id'))
        // ->get();

        // $transactions = Transaction::query()//NECESSARY FOR INDEX ; OVERWRITE PREVIOUS QUERY FOR TESTING ; USED TO VERIFY THE BAD ORDER
        //                         ->orderBy('trx_id', 'desc')
        //                         ->first(); 

        $purchased_products = DB::table('products')
        ->join('purchases', 'purchases.prd_id', '=', 'products.prd_id')
        ->get();

        $oppositions = DB::table('oppositions')
        ->get();

        $oppositions = Opposition::POSIndex(); //OVERWRITE PREVIOUS QUERY FOR TESTING

        $transaction_id = Transaction::query()//NECESSARY FOR INDEX ; OVERWRITE PREVIOUS QUERY FOR TESTING ; USED TO VERIFY THE BAD ORDER
                                    ->where('pdn_id', get_last_production_id())
                                    ->orderBy('trx_id', 'desc')
                                    ->count();

        session(['client_id' => $client_id[0]]);

        return view('admin.sales.main', compact('products', 'customers', 'oppositions', 'transaction_id', 'in_products'));//'transactions', 'purchased_products',
    }

    public function getTransaction($transaction)
    {
        $transaction = Transaction::query()
                                ->join('customers', 'customers.cus_id', '=', 'transactions.cus_id')
                                ->where('trx_ref_id', $transaction)
                                ->first();

        $purchased_products = Product::query() //NECESSARY FOR INDEX ; USED TO VERIFY THE BAD ORDER
                                    ->join('purchases', 'purchases.prd_id', '=', 'products.prd_id')
                                    ->where('trx_id', $transaction->trx_id)
                                    ->get();
        // @foreach($purchased_products as $purchased_product)
        //     @if($purchased_product->trx_id == $transaction->trx_id)
        //         $("#pur_products").append("<option value='{{ $purchased_product->prd_id }}'>{{ $purchased_product->prd_name }}</option>");
        //     @endif
        // @endforeach
        
        // Assuming you want to return $transaction as JSON response
        return response()->json([
            'transaction' => $transaction,
            'purchased_products' => $purchased_products
        ]);
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

        $pmnt_id = DB::table('payments')
        ->max('pmnt_id');

        if($pmnt_id == null){
            $pmnt_id = 1;
        }
        else{
            $pmnt_id += 1;
        }

        //FOR DATA INPUT
        $prod_date = DB::table('production_logs')
        ->orderBy('pdn_id', 'DESC')
        ->first()
        ->pdn_date;

        // $prod_date = DateTime($prod_date);
        $prod_date = \Carbon\Carbon::createFromFormat('Y-m-d', $prod_date);
        // $formattedDate = $prod_date->format('Y-m-d');

        $trx_ref_id = "POS-" . date('Y') . date('m') . date('d') . "-" . $trx_id; //date_format($prod_date, 'd')
        $pmt_ref_id = "PMT-" . date('Y') . date('m') . date('d') . "-" . $pmnt_id; //date_format($prod_date, 'd')
        $prd_id = "";
        $prd_price = "";
        $pur_qty = "";
        $pur_crate = "";
        $pur_loose = "";
        $pur_discount = "";
        $pur_deposit = "";
        $pur_total = "";
        $pur_crate_in = "";
        $pur_loose_in = "";
        $cus_id = "";
        
        $trx_date = $request->trx_date;
        $trx_can_dec = $request->trx_can_dec;
        $trx_del_rec = $request->trx_del_rec;
        $brd_new_total = $request->brd_new_total;
        
        $mode_of_payment = $request->mode_of_payment;
        $trx_gross = (float)$request->trx_gross;
        $trx_total = (float)$request->trx_total;
        $trx_amount_paid = (float)$request->trx_amount_paid;
        $trx_balance =  (double)$trx_total - (double)$trx_amount_paid;
        
        if($mode_of_payment == 1 || $mode_of_payment == 3){
            if($trx_amount_paid <= 0){
                session()->flash('errorMessage','Invalid input');
                return redirect()->action('SalesController@main');
            }
        }

        if($trx_amount_paid > $trx_total){
            $trx_amount_paid = $trx_total;
            $trx_balance  = 0;
        }

        $pmnt_received = (float)$request->trx_amount_paid;
        $pmnt_change =  (double)$trx_total - (double)$pmnt_received;

        $pmnt_check_no = $request->pmnt_check_no;
        $pmnt_check_date = $request->pmnt_check_date;

        if($pmnt_received > 0){
            if($pmnt_change <= 0){
                $pmnt_change = $pmnt_change * -1;
            }
            else{
                $pmnt_change = 0;
            }
        }
        else{
            $pmnt_change = 0;
        }

        $list = $request->purchases;
        $selected_item_list  = $list;
        $purchase_row = explode(",#,", $selected_item_list);

        //for products variable
        $deduct_qty = 0;
        $add_empty_good_qty = 0;

        for($i = 0 ; $i < count($purchase_row) ; $i++)
        {
            $purchase_data = explode(",", $purchase_row[$i]);

            for($j = 0 ; $j < count($purchase_data) ; $j++)
            {
                //to search customer id based from name
                // $customer_id = DB::table('customers')
                // ->where('cus_name', 'LIKE', $purchase_data[13])
                // ->get();
                
                $customer_id = Customer::query()
                                    ->where('cus_name', 'LIKE' , $purchase_data[13])
                                    ->first();
                                    
                $prd_id =  $purchase_data[0];
                $prd_price = $purchase_data[3];
                $pur_crate = $purchase_data[4];
                $pur_loose = $purchase_data[5];
                $pur_qty = (int)($purchase_data[4] * 12) + (int)($purchase_data[5]);
                $pur_discount = $purchase_data[6];
                $pur_deposit = $purchase_data[7];
                $pur_total = $purchase_data[8];
                $pur_crate_in = $purchase_data[9];
                $pur_loose_in = $purchase_data[10];
                $prd_id_in = $purchase_data[11];
                $can_type_in = $purchase_data[12];
                $cus_id = $customer_id->cus_id; //$customer_id[0]->cus_id;
            }
            
            DB::table('purchases')
            ->insert([
                'trx_id' => $trx_id,
                'prd_id' => $prd_id,
                'prd_price' => $prd_price,
                'pur_crate' => $pur_crate,
                'pur_loose' => $pur_loose,
                'pur_qty' => $pur_qty,
                'pur_discount' => $pur_discount,
                'pur_deposit' => $pur_deposit,
                'prd_id_in' => $prd_id_in,
                'can_type_in' => $can_type_in,
                'pur_crate_in' => $pur_crate_in,
                'pur_loose_in' => $pur_loose_in,
                'pur_total' => $pur_total
            ]);

            $remaining_opposite = DB::table('oppositions')
            ->where('ops_id', '=', $prd_id_in)
            ->first();

            $remaining_crimped = DB::table('products')
            ->where('prd_id', '=', $prd_id_in)
            ->first();

            $products = DB::table('products')
            ->where('prd_id', '=', $prd_id)
            ->first();

            if($can_type_in == 0 || $can_type_in == 1){
                if($products->prd_is_refillable == 1){
                    $deduct_qty = (int)$products->prd_quantity - (int)$pur_qty;
                    $add_empty_good_qty = (int)$remaining_crimped->prd_empty_goods + ((int)($pur_crate_in * 12) + $pur_loose_in);
                }
                else{
                    $deduct_qty = (int)$products->prd_quantity - (int)$pur_qty;
                }
    
                //For Crimped
                DB::table('products')
                ->where('prd_id', '=', $prd_id_in)
                ->update([
                    'prd_empty_goods' => $add_empty_good_qty
                ]);

                if($products->prd_is_refillable == 1)
                {
                    //ADD QUANTITY TO STOCKS LOGS FOR CANISTER MOVEMENT TRACKING
                    //get quantity of the product in the stocks_logs table
                    $stocks_logs = DB::table('stocks_logs')
                    ->where('prd_id', '=', $prd_id_in)
                    ->first();
                    $stocks_logs_quantity = $stocks_logs->stk_empty_goods;

                    //add stocks_logs quantity to add_empty_good_qty
                    DB::table('stocks_logs')
                    ->where('prd_id', '=', $prd_id_in)
                    ->update([
                        'stk_empty_goods' => $stocks_logs_quantity + $add_empty_good_qty
                    ]);
                }
            }
            else{
                $deduct_qty = (int)$products->prd_quantity - (int)$pur_qty;
                $add_ops_qty = (int)$remaining_opposite->ops_quantity + ((int)($pur_crate_in * 12) + $pur_loose_in);
                
                //For Opposite
                DB::table('oppositions')
                ->where('ops_id', '=', $prd_id_in)
                ->update([
                    'ops_quantity' => $add_ops_qty
                ]);
            }
            
            //For Backflushed
            DB::table('products')
            ->where('prd_id', '=', $prd_id)
            ->update([
                'prd_quantity' => $deduct_qty
            ]);
        }
        
        DB::table('transactions')
        ->insert([
            'acc_id' => session('acc_id'),
            'usr_id' => session('usr_id'),
            'trx_ref_id' => $trx_ref_id,
            'cus_id' => $cus_id,
            'trx_datetime' => $trx_date . " " . date('H:i:s'),
            'trx_date' => $trx_date,
            'trx_time' => date('H:i:s'),
            'trx_gross' => $trx_gross,
            'trx_total' => $trx_total,
            'trx_amount_paid' => $trx_amount_paid,
            'trx_balance' => $trx_balance,
            'trx_can_dec' => $trx_can_dec,
            'trx_del_rec' => $trx_del_rec,
            'pdn_id' => get_last_production_id()
        ]);

        //FOR PAYMENTS
        if($mode_of_payment != 5){

            if($mode_of_payment == 4){
                DB::table('payments')
                ->insert([
                    'acc_id' => session('acc_id'),
                    'usr_id' => session('usr_id'),
                    'trx_id' => $trx_id,
                    'pmnt_ref_id' => $pmt_ref_id,
                    'trx_mode_of_payment' => $mode_of_payment,
                    'pmnt_amount' => $trx_amount_paid,
                    'pmnt_received' => $pmnt_received,
                    'pmnt_change' => $pmnt_change,
                    'pmnt_date' => $trx_date,
                    'pmnt_time' => date('H:i:s'),
                    'pmnt_check_no' => $pmnt_check_no,
                    'pmnt_check_date' => $pmnt_check_date
                ]);
            }
            else{
                DB::table('payments')
                ->insert([
                    'acc_id' => session('acc_id'),
                    'usr_id' => session('usr_id'),
                    'trx_id' => $trx_id,
                    'pmnt_ref_id' => $pmt_ref_id,
                    'trx_mode_of_payment' => $mode_of_payment,
                    'pmnt_amount' => $trx_amount_paid,
                    'pmnt_received' => $pmnt_received,
                    'pmnt_change' => $pmnt_change,
                    'pmnt_date' => $trx_date,
                    'pmnt_time' => date('H:i:s')
                ]);
            }

            //IMAGE UPLOAD FOR GCASH
            if($request->file('pmnt_attachment_gcash'))
            {
                $pmnt_id = DB::table('payments')
                ->select('pmnt_id')
                ->orderBy('pmnt_id', 'desc')
                ->first();
        
                $file = $request->file('pmnt_attachment_gcash');
    
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
        
                $fileName = $pmnt_id->pmnt_id . '.' . $file->getClientOriginalExtension();
        
                Storage::disk('local')->put('img/payments/' . $fileName, fopen($file, 'r+'));
    
                DB::table('payments')
                ->where('pmnt_id','=',$pmnt_id->pmnt_id)
                ->update([
                    'pmnt_attachment' => $fileName,
                ]);  
            }   
            
            //IMAGE UPLOAD FOR CHECK
            if($request->file('pmnt_attachment_check'))
            {
                $pmnt_id = DB::table('payments')
                ->select('pmnt_id')
                ->orderBy('pmnt_id', 'desc')
                ->first();
        
                $file = $request->file('pmnt_attachment_check');
    
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
        
                $fileName = $pmnt_id->pmnt_id . '.' . $file->getClientOriginalExtension();
        
                Storage::disk('local')->put('img/payments/' . $fileName, fopen($file, 'r+'));
    
                DB::table('payments')
                ->where('pmnt_id','=',$pmnt_id->pmnt_id)
                ->update([
                    'pmnt_attachment' => $fileName,
                ]);  
            }   

        }
        else{
            $trx_amount_cash = (float)$request->trx_amount_cash;
            $trx_amount_credit = (float)$request->trx_amount_credit;
            $trx_amount_gcash = (float)$request->trx_amount_gcash;
            $trx_amount_check = (float)$request->trx_amount_check;

            if($trx_amount_cash > 0){
                DB::table('payments')
                ->insert([
                    'acc_id' => session('acc_id'),
                    'usr_id' => session('usr_id'),
                    'trx_id' => $trx_id,
                    'pmnt_ref_id' => $pmt_ref_id,
                    'trx_mode_of_payment' => $mode_of_payment,
                    'pmnt_amount' => $trx_amount_cash,
                    'pmnt_received' => $trx_amount_paid,
                    'pmnt_change' => 0,
                    'pmnt_date' => $trx_date,
                    'pmnt_time' => date('H:i:s')
                ]);
            }
            if($trx_amount_credit > 0){
                DB::table('payments')
                ->insert([
                    'acc_id' => session('acc_id'),
                    'usr_id' => session('usr_id'),
                    'trx_id' => $trx_id,
                    'pmnt_ref_id' => $pmt_ref_id,
                    'trx_mode_of_payment' => $mode_of_payment,
                    'pmnt_amount' => $trx_amount_credit,
                    'pmnt_received' => $trx_amount_paid,
                    'pmnt_change' => 0,
                    'pmnt_date' => $trx_date,
                    'pmnt_time' => date('H:i:s')
                ]);
            }
            if($trx_amount_gcash > 0){
                DB::table('payments')
                ->insert([
                    'acc_id' => session('acc_id'),
                    'usr_id' => session('usr_id'),
                    'trx_id' => $trx_id,
                    'pmnt_ref_id' => $pmt_ref_id,
                    'trx_mode_of_payment' => $mode_of_payment,
                    'pmnt_amount' => $trx_amount_gcash,
                    'pmnt_received' => $trx_amount_paid,
                    'pmnt_change' => 0,
                    'pmnt_date' => $trx_date,
                    'pmnt_time' => date('H:i:s')
                ]);

                //IMAGE UPLOAD FOR GCASH
                if($request->file('pmnt_attachment_gcash'))
                {
                    $pmnt_id = DB::table('payments')
                    ->select('pmnt_id')
                    ->orderBy('pmnt_id', 'desc')
                    ->first();
            
                    $file = $request->file('pmnt_attachment_gcash');
        
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
            
                    $fileName = $pmnt_id->pmnt_id . '.' . $file->getClientOriginalExtension();
            
                    Storage::disk('local')->put('img/payments/' . $fileName, fopen($file, 'r+'));
        
                    DB::table('payments')
                    ->where('pmnt_id','=',$pmnt_id->pmnt_id)
                    ->update([
                        'pmnt_attachment' => $fileName,
                    ]);  
                }   
            }
            if($trx_amount_check > 0){
                DB::table('payments')
                ->insert([
                    'acc_id' => session('acc_id'),
                    'usr_id' => session('usr_id'),
                    'trx_id' => $trx_id,
                    'pmnt_ref_id' => $pmt_ref_id,
                    'trx_mode_of_payment' => $mode_of_payment,
                    'pmnt_amount' => $trx_amount_check,
                    'pmnt_received' => $trx_amount_paid,
                    'pmnt_change' => 0,
                    'pmnt_date' => $trx_date,
                    'pmnt_time' => date('H:i:s'),
                    'pmnt_check_no' => $pmnt_check_no,
                    'pmnt_check_date' => $pmnt_check_date
                ]);

                //IMAGE UPLOAD FOR CHECK
                if($request->file('pmnt_attachment_check'))
                {
                    $pmnt_id = DB::table('payments')
                    ->select('pmnt_id')
                    ->orderBy('pmnt_id', 'desc')
                    ->first();
            
                    $file = $request->file('pmnt_attachment_check');
        
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
            
                    $fileName = $pmnt_id->pmnt_id . '.' . $file->getClientOriginalExtension();
            
                    Storage::disk('local')->put('img/payments/' . $fileName, fopen($file, 'r+'));
        
                    DB::table('payments')
                    ->where('pmnt_id','=',$pmnt_id->pmnt_id)
                    ->update([
                        'pmnt_attachment' => $fileName,
                    ]);  
                }   
            }
        }

        session(['pmnt_check_no' => $pmnt_check_no]);
        session(['latest_trx_id' => $trx_id]);
        session(['brd_new_total' => $brd_new_total]);

        session()->flash('successMessage','Transaction complete!');
        return redirect()->action('PrintController@salesReceipt');
    }

    public function payPending(Request $request){
        
        $trx_id = $request->trx_id;

        $pmnt_id = DB::table('payments')
        ->max('pmnt_id');

        if($pmnt_id == null){
            $pmnt_id = 1;
        }
        else{
            $pmnt_id += 1;
        }

        $pmt_ref_id = "PMT" . date('Y') . date('m') . date('d') . "-" . $pmnt_id;
        $pmnt_date = $request->pmnt_date;

        $transaction = DB::table('transactions')
        ->where('trx_id','=',$request->trx_id)
        ->first();

        $trx_balance = $transaction->trx_balance;
        $pmnt_amount = (float)$request->pmnt_amount;
        $new_trx_balance = $trx_balance - $pmnt_amount;

        if($pmnt_amount <= 0){
            session()->flash('errorMessage','Invalid input');
            return redirect()->action('SalesController@payments');
        }

        if($pmnt_amount > $trx_balance){
            $pmnt_amount = $trx_balance;
            $new_trx_balance  = 0;
        }
        
        $mode_of_payment = $request->mode_of_payment;
        $pmnt_received = (float)$request->pmnt_amount;
        $pmnt_change =  (double)$trx_balance - (double)$pmnt_received;
        
        $pmnt_check_no = $request->pmnt_check_no;
        $pmnt_check_date = $request->pmnt_check_date;
        
        if($pmnt_change <= 0){
            $pmnt_change = $pmnt_change * -1;
        }
        else if($pmnt_change > 0){
            $pmnt_change = 0;
        }

        //FOR PAYMENTS
        if($mode_of_payment != 5){

            if($mode_of_payment == 4){
                DB::table('payments')
                ->insert([
                    'acc_id' => session('acc_id'),
                    'usr_id' => session('usr_id'),
                    'trx_id' => $trx_id,
                    'pmnt_ref_id' => $pmt_ref_id,
                    'trx_mode_of_payment' => $mode_of_payment,
                    'pmnt_amount' => $pmnt_amount,
                    'pmnt_received' => $pmnt_received,
                    'pmnt_change' => $pmnt_change,
                    'pmnt_date' => $pmnt_date,
                    'pmnt_time' => date('H:i:s'),
                    'pmnt_check_no' => $pmnt_check_no,
                    'pmnt_check_date' => $pmnt_check_date
                ]);
            }
            else{
                DB::table('payments')
                ->insert([
                    'acc_id' => session('acc_id'),
                    'usr_id' => session('usr_id'),
                    'trx_id' => $trx_id,
                    'pmnt_ref_id' => $pmt_ref_id,
                    'trx_mode_of_payment' => $mode_of_payment,
                    'pmnt_amount' => $pmnt_amount,
                    'pmnt_received' => $pmnt_received,
                    'pmnt_change' => $pmnt_change,
                    'pmnt_date' => $pmnt_date,
                    'pmnt_time' => date('H:i:s')
                ]);
            }
    
            //IMAGE UPLOAD FOR GCASH
            if($request->file('pmnt_attachment_gcash'))
            {
                $pmnt_id_att = DB::table('payments')
                ->select('pmnt_id')
                ->orderBy('pmnt_id', 'desc')
                ->first();
        
                $file = $request->file('pmnt_attachment_gcash');
    
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
        
                $fileName = $pmnt_id_att->pmnt_id . '.' . $file->getClientOriginalExtension();
        
                Storage::disk('local')->put('img/payments/' . $fileName, fopen($file, 'r+'));
    
                DB::table('payments')
                ->where('pmnt_id','=',$pmnt_id_att->pmnt_id)
                ->update([
                    'pmnt_attachment' => $fileName,
                ]);  
            }   
            
            //IMAGE UPLOAD FOR CHECK
            if($request->file('pmnt_attachment_check'))
            {
                $pmnt_id_att = DB::table('payments')
                ->select('pmnt_id')
                ->orderBy('pmnt_id', 'desc')
                ->first();
        
                $file = $request->file('pmnt_attachment_check');
    
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
        
                $fileName = $pmnt_id_att->pmnt_id . '.' . $file->getClientOriginalExtension();
        
                Storage::disk('local')->put('img/payments/' . $fileName, fopen($file, 'r+'));
    
                DB::table('payments')
                ->where('pmnt_id','=',$pmnt_id_att->pmnt_id)
                ->update([
                    'pmnt_attachment' => $fileName,
                ]);  
            }   

            session(['pmnt_amount' => $pmnt_amount]);
        }
        else{
            $pmnt_amount_cash = (float)$request->pmnt_amount_cash;
            $pmnt_amount_gcash = (float)$request->pmnt_amount_gcash;
            $pmnt_amount_check = (float)$request->pmnt_amount_check;

            if($pmnt_amount_cash > 0){
                DB::table('payments')
                ->insert([
                    'acc_id' => session('acc_id'),
                    'usr_id' => session('usr_id'),
                    'trx_id' => $request->trx_id,
                    'pmnt_ref_id' => $pmt_ref_id,
                    'trx_mode_of_payment' => $mode_of_payment,
                    'pmnt_amount' => $pmnt_amount_cash,
                    'pmnt_received' => $pmnt_received,
                    'pmnt_change' => 0,
                    'pmnt_date' => $pmnt_date,
                    'pmnt_time' => date('H:i:s')
                ]);
            }
            if($pmnt_amount_gcash > 0){
                DB::table('payments')
                ->insert([
                    'acc_id' => session('acc_id'),
                    'usr_id' => session('usr_id'),
                    'trx_id' => $request->trx_id,
                    'pmnt_ref_id' => $pmt_ref_id,
                    'trx_mode_of_payment' => $mode_of_payment,
                    'pmnt_amount' => $pmnt_amount_gcash,
                    'pmnt_received' => $pmnt_received,
                    'pmnt_change' => 0,
                    'pmnt_date' => $pmnt_date,
                    'pmnt_time' => date('H:i:s')
                ]);

                //IMAGE UPLOAD FOR GCASH
                if($request->file('pmnt_attachment_gcash'))
                {
                    $pmnt_id_att = DB::table('payments')
                    ->select('pmnt_id')
                    ->orderBy('pmnt_id', 'desc')
                    ->first();
            
                    $file = $request->file('pmnt_attachment_gcash');
        
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
            
                    $fileName = $pmnt_id_att->pmnt_id . '.' . $file->getClientOriginalExtension();
            
                    Storage::disk('local')->put('img/payments/' . $fileName, fopen($file, 'r+'));
        
                    DB::table('payments')
                    ->where('pmnt_id','=',$pmnt_id_att->pmnt_id)
                    ->update([
                        'pmnt_attachment' => $fileName,
                    ]);  
                }   
            }
            if($pmnt_amount_check > 0){
                DB::table('payments')
                ->insert([
                    'acc_id' => session('acc_id'),
                    'usr_id' => session('usr_id'),
                    'trx_id' => $request->trx_id,
                    'pmnt_ref_id' => $pmt_ref_id,
                    'trx_mode_of_payment' => $mode_of_payment,
                    'pmnt_amount' => $pmnt_amount_check,
                    'pmnt_received' => $pmnt_received,
                    'pmnt_change' => 0,
                    'pmnt_date' => $pmnt_date,
                    'pmnt_time' => date('H:i:s')
                ]);

                //IMAGE UPLOAD FOR CHECK
                if($request->file('pmnt_attachment_check'))
                {
                    $pmnt_id_att = DB::table('payments')
                    ->select('pmnt_id')
                    ->orderBy('pmnt_id', 'desc')
                    ->first();
            
                    $file = $request->file('pmnt_attachment_check');
        
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
            
                    $fileName = $pmnt_id_att->pmnt_id . '.' . $file->getClientOriginalExtension();
            
                    Storage::disk('local')->put('img/payments/' . $fileName, fopen($file, 'r+'));
        
                    DB::table('payments')
                    ->where('pmnt_id','=',$pmnt_id_att->pmnt_id)
                    ->update([
                        'pmnt_attachment' => $fileName,
                    ]);  
                }   
            }

            session(['pmnt_amount' => $pmnt_received]);
        }
        
        
        $updated_payment = $transaction->trx_amount_paid + $pmnt_amount;

        DB::table('transactions')
        ->where('trx_id','=',$request->trx_id)
            ->update([
                'trx_balance' => $new_trx_balance,
                'trx_amount_paid' => $updated_payment,
        ]);  

        session(['pmnt_check_no' => $pmnt_check_no]);
        session(['latest_pmnt_id' => $pmnt_id]);

        session()->flash('successMessage','Payment saved');
        return redirect()->action('PrintController@paymentReceipt');
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

        session()->flash('successMessage','Opposition Canister added');
        return redirect()->action('SalesController@main');
    }
}

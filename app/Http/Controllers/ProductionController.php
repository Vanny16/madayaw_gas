<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use DB;

class ProductionController extends Controller
{
    public function manage()
    {
        $raw_materials = DB::table('products')
        ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_for_production','=','1')
        ->get();
        
        $canisters = DB::table('products')
        ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->get();

        $products = DB::table('products')
        ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        ->where('products.acc_id', '=', session('acc_id'))
        ->get();

        $suppliers = DB::table('suppliers')
        ->where('acc_id', '=', session('acc_id'))
        ->get();

        $transactions = DB::table('transactions')
        ->join('customers', 'customers.cus_id', '=', 'transactions.cus_id')
        ->where('transactions.acc_id', '=', session('acc_id'))
        ->get();

        $pdn_flag = check_production_log();

        $production_times = DB::table('production_logs')
        ->orderBy('pdn_id', 'desc')
        ->first();
        
        $tanks = DB::table('tanks')
        ->where('acc_id', '=', session('acc_id'))
        ->get();

        $tank_logs = DB::table('tank_logs')
        ->where('acc_id', '=', session('acc_id'))
        ->get(); 

        $pdn_date = "";
        $pdn_start_time = '-- : -- --';
        $pdn_end_time = '-- : -- --'; 

        if(isset($production_times)){
            if(date('Y-m-d',strtotime($production_times->pdn_date)) == date("Y-m-d"))
            {
                if($production_times->pdn_end_time <> 0)
                {
                    $pdn_date = date("F j, Y", strtotime($production_times->pdn_date));
                    $pdn_start_time = date("h:i:s a", strtotime($production_times->pdn_start_time));
                    $pdn_end_time = date("h:i:s a", strtotime($production_times->pdn_end_time));
                }
                else
                {
                    $pdn_date = date("F j, Y", strtotime($production_times->pdn_date));
                    $pdn_start_time = date("h:i:s a", strtotime($production_times->pdn_start_time));
                    $pdn_end_time = '-- : -- --'; 
                    // $pdn_end_time = date("h:i:s a", strtotime($production_times->pdn_end_time));
                }   
            }
            else
            {
                $pdn_date = date("F j, Y", strtotime($production_times->pdn_date));
                $pdn_start_time = date("h:i:s a", strtotime($production_times->pdn_start_time));
                $pdn_end_time = date("h:i:s a", strtotime($production_times->pdn_end_time));
            }
        }

        return view('admin.production.manage',compact('raw_materials', 'canisters', 'products', 'suppliers', 'transactions', 'pdn_flag', 'pdn_date', 'pdn_start_time', 'pdn_end_time', 'tanks'));
    }

    //PRODUCTION
    public function toggleProduction(Request $request)
    {
        $pdn_flag = check_production_log();
        $temp_details = explode(",", $request->canister_details);
        $temp_tank_details = explode(",", $request->tank_details);
        array_pop($temp_details);
        array_pop($temp_tank_details);

        $canister_details = [];
        $tank_details = [];
        
        foreach($temp_details as $details)
        {   
            $detail = explode("|", $details);
            array_push($canister_details, $detail[0]);
        }

        foreach($temp_tank_details as $details)
        {   
            $detail = explode("|", $details);
            array_push($tank_details, $detail[0]);
        }

        if($pdn_flag)
        {
            DB::table('production_logs')
            ->insert([
                'pdn_date' => DB::raw('CURRENT_TIMESTAMP'),
                'pdn_start_time' => DB::raw('CURRENT_TIMESTAMP')
            ]);

            if($temp_details <> "" && $temp_tank_details <> "")
            {
                foreach($canister_details as $prd_id)
                {
                    $input_field = "stock_quantity" . $prd_id;
                    
                    DB::table('stocks_logs')
                    ->insert([
                        'acc_id' => session('acc_id'),
                        'prd_id' => $prd_id,
                        'opening_stocks' => $request->$input_field,
                        'pdn_id' => get_last_production_id()
                    ]);
                }

                foreach($tank_details as $tnk_id)
                {
                    $input_field = "tank_remaining" . $tnk_id;

                    DB::table('tank_logs')
                    ->insert([
                        'acc_id' => session('acc_id'),
                        'tnk_id' => $tnk_id,
                        'log_tnk_opening' => $request->$input_field,
                        'pdn_id' => get_last_production_id()
                    ]);
                }
            }

            session()->flash('successMessage','Production started!');
            return redirect()->action('ProductionController@manage');
        }
        else
        {
            DB::table('production_logs')
            ->update([
                'pdn_end_time' => DB::raw('CURRENT_TIMESTAMP')
            ]);

            if($temp_details <> "" && $temp_tank_details <> "")
            {
                foreach($canister_details as $prd_id)
                {
                    $input_field = "stock_quantity" . $prd_id;
                  
                    DB::table('stocks_logs')
                    ->where('pdn_id', '=', get_last_production_id())
                    ->update([
                        'closing_stocks' => $request->$input_field,
                    ]);
                }

                foreach($tank_details as $tnk_id)
                {
                    $input_field = "tank_remaining" . $tnk_id;

                    DB::table('tank_logs')
                    ->where('pdn_id', '=', get_last_production_id())
                    ->update([
                        'log_tnk_closing' => $request->$input_field,
                    ]);
                }
            }

            session()->flash('successMessage','Production ended!');
            return redirect()->action('ProductionController@manage');
        }
    }
    
    public function createProduct(Request $request)
    {
        $prd_name = $request->prd_name;
        $prd_description = $request->prd_description;
        $prd_sku = $request->prd_sku;
        $prd_type = $request->prd_type;
        $prd_price = $request->prd_price;
        $prd_deposit = $request->prd_deposit;
        $prd_weight = $request->prd_weight;
        $prd_reorder = $request->prd_reorder;
        $sup_id = $request->sup_id;
        $components = $request->input('components');
        $prd_components = "";

        $prodValues = array(
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            $request->show_modal,
            $request->tab_1,
            $request->tab_2,
            $request->prd_type
        );

        // dd($prd_type);
        
        
        $sku_checker = DB::table('products')
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_sku','=',$prd_sku)
        ->first();

        if($sku_checker != null)
        {
            session()->flash('errorMessage','Product with this SKU already exists');
            return redirect()->action('ProductionController@manage');
        }


        //FLAGS
        // 0 = quantity raw materials
        // 1 = empty goods

        if($prd_type == 0)
        {
            DB::table('products')
            ->insert([
            'prd_name'=> $prd_name,
            'acc_id' => session('acc_id'),
            'prd_uuid' => generateuuid(),
            'prd_sku' => $prd_sku,
            'prd_description' => $prd_description,
            'prd_reorder_point' => $prd_reorder,
            'prd_for_production' => 1,
            'prd_for_POS' => 0,
            'prd_is_refillable' => 0,
            'sup_id' => $sup_id
            ]);
        }
        elseif($prd_type == 1)
        {
            $get_components = "";

            if(!is_null($components)){
                foreach ($components as $component) {
                    $get_components =  $component .",". $get_components;
                }
                $prd_components = substr($get_components, 0, strlen($get_components) - 1);
            }

            // dd($prd_components);

            DB::table('products')
            ->insert([
            'prd_name'=> $prd_name,
            'acc_id' => session('acc_id'),
            'prd_uuid' => generateuuid(),
            'prd_description' => $prd_description,
            'prd_sku' => $prd_sku,
            'prd_price' => $prd_price,
            'prd_deposit' => $prd_deposit,
            'prd_weight' => $prd_weight,
            'prd_reorder_point' => $prd_reorder,
            'prd_for_production' => 1,
            'prd_for_POS' => 1,
            'prd_is_refillable' => 1,
            'prd_components' => $prd_components,
            'sup_id' => $sup_id
            ]);
        }

        if($request->file('prd_image'))
        {
            $prd_id = DB::table('products')
            ->where('acc_id', '=', session('acc_id'))
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
            ->where('acc_id', '=', session('acc_id'))
            ->where('prd_id','=',$prd_id->prd_id)
            ->update([
                'prd_image' => $fileName,
            ]);  
        }

        session()->flash('getProdValues', array( $prodValues));
        session()->flash('successMessage','Raw material has been added');
        return redirect()->action('ProductionController@manage');
    }




    //ADD QUANTITY FOR ITEMS
    public function addQuantity(Request $request)
    {
        $trx_id = DB::table('transactions')
        ->max('trx_id');

        if($trx_id == null){
            $trx_id = 1;
        }
        else{
            $trx_id += 1;
        }

        $prd_id = $request->stockin_prd_id;
        (float)$prd_quantity = $request->quantity + ($request->crate_quantity * 12);
        $flag = $request->stockin_flag;
        $tnk_id = $request->selected_tank;

        // dd($tnk_id);

        record_stockin($prd_id, $prd_quantity);
        
        $quantity = DB::table('products')
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_id', '=', $prd_id)
        ->first();
        
        $raw_materials = DB::table('products')
        ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','0')
        ->get();

        //FLAGS
        // 0 = quantity raw materials
        // 1 = empty goods
        // 2 = filled canisters
        // 3 = bad order
        // 4 = revalve
        // 5 = scrap
        // 6 = leakers
        
        $prodValues = array(
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            $request->show_modal, 
            $request->tab_1,
            $request->tab_2
        );

        // dd($prodValues);

        if($flag == 0)
        {
            //ADD QUANTITY TO RAW MATERIALS
            if($quantity->prd_is_refillable == 1){
                $new_quantity = (float)$quantity->prd_raw_can_qty + $prd_quantity;
                
                DB::table('products')
                ->where('prd_id','=',$prd_id)
                ->update([
                    'prd_raw_can_qty' => (float)$new_quantity
                ]);  
            }
            else{
                $new_quantity = (float)$quantity->prd_quantity + $prd_quantity;
                
                DB::table('products')
                ->where('prd_id','=',$prd_id)
                ->update([
                    'prd_quantity' => (float)$new_quantity
                ]);  
            }


            session()->flash('getProdValues', array( $prodValues));
            session()->flash('successMessage','Raw materials added');
            return redirect()->action('ProductionController@manage');
        }

        if($flag == 1)
        {
            if(check_materials($flag, $prd_quantity, $prd_id))
            {
                //ADD QUANTITY TO EMPTY GOODS
                (float)$new_quantity = (float)$quantity->prd_empty_goods + $prd_quantity;
                
                DB::table('products')
                ->where('prd_id','=',$prd_id)
                ->update([
                    'prd_empty_goods' => $new_quantity
                ]);
                

                // SUBTRACT FROM RAW MATERIALS
                subtract_qty($flag, $prd_quantity, $prd_id);

                //LOG ACTION IN PRODUCTION
                record_movement($prd_id, $prd_quantity, $flag);

                session()->flash('getProdValues', array( $prodValues));
                session()->flash('successMessage','Empty goods added');
                return redirect()->action('ProductionController@manage');
            } 
            else
            {
                session()->flash('getProdValues', array( $prodValues));
                session()->flash('errorMessage','Raw materials insufficient!');
                return redirect()->action('ProductionController@manage');
            }  
        }
        
        elseif($flag == 2)
        {
            if($this->check_gas_quantity($tnk_id, $prd_id, $prd_quantity))
            {
                if(check_materials($flag, $prd_quantity, $prd_id))
                {
                    //ADD QUANTITY TO FILLED 
                    (float)$new_quantity = (float)$quantity->prd_quantity + $prd_quantity;

                    $tank = DB::table('tanks')
                    ->where('tnk_id', '=', $tnk_id)
                    ->first();

                    $tank_quantity = $tank->tnk_remaining - ($quantity->prd_weight * $prd_quantity);

                    DB::table('tanks')
                    ->where('tnk_id', '=', $tnk_id)
                    ->update([
                        'tnk_remaining' => $tank_quantity
                    ]);

                    DB::table('products')
                    ->where('prd_id','=',$prd_id)
                    ->update([
                        'prd_quantity' => $new_quantity
                    ]);  

                    //SUBTRACT FROM RAW MATERIALS
                    subtract_qty($flag, $prd_quantity, $prd_id);

                    //LOG ACTION IN PRODUCTION
                    record_movement($prd_id, $prd_quantity, $flag);

                    session()->flash('getProdValues', array( $prodValues));
                    session()->flash('successMessage','Canister added');
                    return redirect()->action('ProductionController@manage');
                } 
                else
                {
                    session()->flash('getProdValues', array( $prodValues));
                    session()->flash('errorMessage','Empty goods insufficient!');
                    return redirect()->action('ProductionController@manage');
                }
            }
            else
            {
                session()->flash('errorMessage','Tank LPG insufficient!');
                return redirect()->action('ProductionController@manage');
            }
        }

        elseif($flag == 3)
        {
            //ADD QUANTITY TO LEAKERS FROM SELLER RETURNS
            $trx_ref_id = $request->trx_ref_id;
            (float)$new_quantity = (float)$quantity->prd_leakers + $prd_quantity;
            (float)$deduct_backflushed = (float)$quantity->prd_quantity - $prd_quantity;
            
            $bo_transaction = DB::table('transactions')
            ->join('purchases', 'purchases.trx_id', '=', 'transactions.trx_id')
            ->where('acc_id', '=', session('acc_id'))
            ->where('trx_ref_id', '=', $trx_ref_id)
            ->get();

            // dd($bo_transaction[0]->trx_id);

            if(empty($bo_transaction[0])) {
                session()->flash('warningMessage','Please check your inputs');
                return redirect()->action('ProductionController@manage');
            }
            else{
                $crate_quantity = $request->crate_quantity;
                $quantity = $request->quantity;

                if($crate_quantity == null && $quantity == null){
                    session()->flash('warningMessage','Please check your inputs');
                    return redirect()->action('ProductionController@manage');
                }
                else{
                    DB::table('products') 
                    ->where('prd_id','=',$prd_id)
                    ->update([
                        'prd_leakers' => $new_quantity,
                        'prd_quantity' => $deduct_backflushed
                    ]);

                    $max_bo_id = DB::table('bad_orders')
                    ->max('bo_id');

                    $new_bo_id = $max_bo_id + 1;
                    $bo_ref_id = "BO-". date('Y') . date('m') . date('d') . "-" . $new_bo_id;

                    DB::table('bad_orders')
                    ->insert([
                        'acc_id' => session('acc_id'),
                        'bo_ref_id' => $bo_ref_id,
                        'trx_id' => $bo_transaction[0]->trx_id,
                        'bo_crates' => $request->crate_quantity,
                        'bo_loose' => $request->quantity,
                        'bo_date' => date('Y-m-d'),
                        'bo_time' => date('H:i:s'),
                        'bo_datetime' => date('Y-m-d H:i:s')
                    ]);
    
                    //LOG ACTION IN PRODUCTION
                    record_movement($prd_id, $prd_quantity, $flag);
                    
                    session()->flash('getProdValues', array( $prodValues));
                    session()->flash('successMessage','Leakers added');
                    return redirect()->action('PrintController@badorderReceipt');
                }
            }
        }

        elseif($flag == 4)
        {
            if(check_materials($flag, $prd_quantity, $prd_id))
            {
                //ADD QUANTITY FROM LEAKERS TO REVALVING 
                (float)$new_quantity = (float)$quantity->prd_for_revalving + $prd_quantity;
                
                DB::table('products')
                ->where('prd_id','=',$prd_id)
                ->update([
                    'prd_for_revalving' => $new_quantity
                ]);

                $search_string = 'valve';

                $valve_details = DB::table('products')
                ->where('acc_id', '=', session('acc_id'))
                ->where('prd_name', 'LIKE', '%valve%')
                ->first();

                //SUBTRACT QUANTITY FROM LEAKERS
                subtract_qty($flag, $prd_quantity, $prd_id);

                $valve_details = DB::table('products')
                ->where('acc_id', '=', session('acc_id'))
                ->where('prd_name', 'LIKE', '%valve%')
                ->update([
                    'prd_quantity' => $valve_qty = $valve_details->prd_quantity - 1
                ]);

                //LOG ACTION IN PRODUCTION
                record_movement($prd_id, $prd_quantity, $flag);

                session()->flash('getProdValues', array( $prodValues));
                session()->flash('successMessage','Leakers sent to Revalves');
                return redirect()->action('ProductionController@manage');
            }
            else
            {
                session()->flash('getProdValues', array( $prodValues));
                session()->flash('errorMessage','Leakers insufficient!');
                return redirect()->action('ProductionController@manage');
            }
        }

        elseif($flag == 5)
        {
            if(check_materials($flag, $prd_quantity, $prd_id))
            {
                //ADD QUANTITY TO SCRAPS FROM LEAKERS
                (float)$new_quantity = (float)$quantity->prd_scraps + $prd_quantity;
                
                DB::table('products')
                ->where('prd_id','=',$prd_id)
                ->update([
                    'prd_scraps' => $new_quantity
                ]);  

                //SUBTRACT QUANTITY FROM LEAKERS
                subtract_qty($flag, $prd_quantity, $prd_id);
                
                //LOG ACTION IN PRODUCTION
                record_movement($prd_id, $prd_quantity, $flag);

                session()->flash('getProdValues', array( $prodValues));
                session()->flash('successMessage','Leakers sent as Scraps');
                return redirect()->action('ProductionController@manage');
                }
            else
            {
                session()->flash('getProdValues', array( $prodValues));
                session()->flash('errorMessage','Leakers insufficient!');
                return redirect()->action('ProductionController@manage');
            }
            
        }
        elseif($flag == 6)
        {
            if(check_materials($flag, $prd_quantity, $prd_id))
            {
                //ADD QUANTITY TO LEAKERS FROM SELLER RETURNS
                (float)$new_quantity = (float)$quantity->prd_leakers + $prd_quantity;
                            
                DB::table('products')
                ->where('prd_id','=',$prd_id)
                ->update([
                    'prd_leakers' => $new_quantity
                ]);  

                //SUBTRACT QUANTITY FROM LEAKERS
                subtract_qty($flag, $prd_quantity, $prd_id);

                //LOG ACTION IN PRODUCTION
                record_movement($prd_id, $prd_quantity, $flag);
                
                session()->flash('getProdValues', array( $prodValues));
                session()->flash('successMessage','Leakers added');
                return redirect()->action('ProductionController@manage');
            }
            else
            {
                session()->flash('getProdValues', array( $prodValues));
                session()->flash('errorMessage','Backflushed insufficient!');
                return redirect()->action('ProductionController@manage');
            }
        }

        session()->flash('getProdValues', array( $prodValues));
    }  

    //EDIT PRODUCTION ITEMS
    public function editItem(Request $request)
    {
        $prd_id = $request->prd_id;
        $prd_name = $request->prd_name;
        $prd_description = $request->prd_description;
        $prd_sku = $request->prd_sku;
        $prd_price = $request->prd_price;
        $prd_reorder = $request->prd_reorder;
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

        if($qty_checker->prd_quantity > $prd_quantity)
        {
            $subtracted_qty = $qty_checker->prd_quantity - $prd_quantity;
            (float)$prd_quantity = "-" . $subtracted_qty;
            
            DB::table('products')
            ->where('prd_id', '=', $prd_id)
            ->update([
                'prd_quantity' => $qty_checker->prd_quantity - $subtracted_qty
            ]);
            
            record_stockin($prd_id, $prd_quantity);
        }

        DB::table('products')
        ->where('prd_id', '=', $prd_id)
        ->update([
            'prd_name' => $prd_name,
            'prd_description' => $prd_description,
            'prd_sku' => $prd_sku,
            'prd_price' => $prd_price,
            'prd_reorder_point' => $prd_reorder, 
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
        return redirect()->action('ProductionController@manage');
    }

    //ACTIVATION CONTROLLER
    public function activateProduct($prd_uuid)
    {
        $active_checker = DB::table('products')
        ->where('prd_uuid','=',$prd_uuid)
        ->first();

        // dd($active_checker);
        if($active_checker->prd_active == 0)
        {
            DB::table('products')
            ->where('prd_uuid', '=', $prd_uuid)
            ->update([
                'prd_active' => 1
            ]);    

            session()->flash('successMessage','Product reactivated');
            return redirect()->action('ProductionController@manage');
        }
        else
        {
            DB::table('products')
            ->where('prd_uuid', '=', $prd_uuid)
            ->update([
                'prd_active' => 0
            ]);

            session()->flash('successMessage','Product deactivated');
            return redirect()->action('ProductionController@manage');
        }
    }

    //TANK CONTROLLER
    public function tank()
    {
        $tanks = DB::table('tanks')
        ->get();

        return view('admin.production.tank', compact('tanks'));
    }

    //ADD TANK CONTROLLER
    public function createTank(Request $request)
    {
        $tnk_name = $request->tnk_name;
        $tnk_capacity = $request->tnk_capacity;
        $tnk_remaining = $request->tnk_remaining;
        $tnk_notes = $request->tnk_notes;

        $check_tank_name = DB::table('tanks')
        ->where('acc_id', '=', session('acc_id'))
        ->where('tnk_name','=', $tnk_name)
        ->first();

        if($check_tank_name != null)
        {
            session()->flash('errorMessage','Tank already exist');
            return redirect()->action('ProductionController@tank');
        }

        DB::table('tanks')
        ->insert([
        'acc_id' => session('acc_id'),
        'tnk_name' => $tnk_name, 
        'tnk_capacity' => (float)$tnk_capacity * 1000,
        'tnk_notes' => $tnk_notes
        ]);

        session()->flash('successMessage','Tank has been added');
        return redirect()->action('ProductionController@tank');
    }

    //EDIT TANK CONTROLLER
    public function editTank(Request $request)
    {
        $tnk_id = $request->tnk_id;
        $tnk_name = $request->tnk_name;
        $tnk_capacity = $request->tnk_capacity;
        $tnk_remaining = $request->tnk_remainning;
        $tnk_notes = $request->tnk_notes;
        $tnk_uuid = $request->tnk_uuid;

        $check_tank_name = DB::table('tanks')
        ->where('acc_id','=', session('acc_id'))
        ->where('tnk_uuid','<>', $tnk_uuid)
        ->where('tnk_name','=', $tnk_name)
        ->first();

        
        if($check_tank_name != null)
        {
            session()->flash('errorMessage','Tank already exist');
            return redirect()->action('ProductionController@tank');
        }

        DB::table('tanks')
        ->where('tnk_id', '=', $tnk_id)
        ->update([
            'tnk_name' => $tnk_name,
            'tnk_capacity' => $tnk_capacity,
            'tnk_remaining' => $tnk_remaining,
            'tnk_notes' => $tnk_notes
        ]);
        
        session()->flash('successMessage','Tank details updated.');
        return redirect()->action('ProductionController@tank');
    }

    //REFILL TANK CONTROLLER
    public function refillTank(Request $request)
    {
        $tnk_id = $request->tnk_id;
        $refill_cty = (float)$request->tnk_remaining * 1000;

        $remaining = DB::table('tanks')
        ->where('tnk_id', '=', $tnk_id)
        ->first();
        
        $tnk_remaining = (float)$remaining->tnk_remaining + $refill_cty;

        DB::table('tanks')
        ->where('tnk_id', '=', $tnk_id)
        ->update([
            'tnk_remaining' => (float)$tnk_remaining,
        ]);
        
        record_stockin($tnk_id, $refill_cty);

        session()->flash('successMessage','Remaining has been added');
        return redirect()->action('ProductionController@tank');
    
    }
    
    //CREATE SUPPLIER
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
            'show',
            $request->show_modal,
            $request->tab_1,
            $request->tab_2
        );

        // dd($prodValues);

        if($check_sup_name != null)
        {
            session()->flash('errorMessage','Supplier already exist');
            session()->flash('getProductionValues', array( $prodValues));
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
        return redirect()->action('ProductionController@manage');
    }

    private function check_gas_quantity($tnk_id, $prd_id, $prd_quantity)
    {
        $tank = DB::table('tanks')
        ->where('tnk_id', '=', $tnk_id)
        ->first();

        $canister = DB::table('products')
        ->where('prd_id', '=', $prd_id)
        ->first();

        if($tank->tnk_remaining < ($canister->prd_weight * $prd_quantity))
        {
            return false;
        }  
        else
        {
            return true;
        }
    }
}

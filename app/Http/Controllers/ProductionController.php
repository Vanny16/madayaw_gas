<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProductionController extends Controller
{
    public function manage()
    {
        $raw_materials = DB::table('products')
        ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','0')
        ->get();
        // dd($raw_materials);
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

        $pdn_flag = check_production_date();

        return view('admin.production.manage',compact('raw_materials', 'canisters', 'products', 'suppliers'));
    }

    //PRODUCTION
    public function toggleProduction()
    {
        DB::table('production_logs')
        ->insert([
            'pdn_datetime' => DB::raw('CURRENT_TIMESTAMP') 
        ]);

        session()->flash('successMessage','Production started!');
        return redirect()->action('ProductionController@manage');
    }

    public function stopProduction()
    {

    }

    public function createProduct(Request $request)
    {
        $prd_name = $request->prd_name;
        $prd_description = $request->prd_description;
        $prd_sku = $request->prd_sku;
        $prd_price = $request->prd_price;
        $prd_reorder = $request->prd_reorder;
        $sup_id = $request->sup_id;
        $flag = $request->add_flag;
        
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

        if($flag == 0)
        {
        DB::table('products')
        ->insert([
        'prd_name'=> $prd_name,
        'acc_id' => session('acc_id'),
        'prd_uuid' => generateuuid(),
        'prd_description' => $prd_description,
        'prd_sku' => $prd_sku,
        'prd_price' => $prd_price,
        'prd_reorder_point' => $prd_reorder,
        'prd_for_production' => 1,
        'prd_is_refillable' => 0,
        'sup_id' => $sup_id
        ]);
        }
        elseif($flag == 1)
        {
        DB::table('products')
        ->insert([
        'prd_name'=> $prd_name,
        'acc_id' => session('acc_id'),
        'prd_uuid' => generateuuid(),
        'prd_description' => $prd_description,
        'prd_sku' => $prd_sku,
        'prd_price' => $prd_price,
        'prd_reorder_point' => $prd_reorder,
        'prd_for_production' => 1,
        'prd_is_refillable' => 1,
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

        session()->flash('successMessage','Raw material has been added');
        return redirect()->action('ProductionController@manage');
    }

    //ADD QUANTITY FOR ITEMS
    public function addQuantity(Request $request)
    {
        $prd_id = $request->stockin_prd_id;
        (float)$prd_quantity = $request->quantity + ($request->crate_quantity * 12);
        $flag = $request->stockin_flag;
        
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
        // 3 = leakers
        // 4 = revalve
        // 5 = scrap
        
        if($flag == 0)
        {
            //ADD QUANTITY TO RAW MATERIALS
            $new_quantity = (float)$quantity->prd_quantity + $prd_quantity;

            DB::table('products')
            ->where('prd_id','=',$prd_id)
            ->update([
                'prd_quantity' => (float)$new_quantity
            ]);  

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

                session()->flash('successMessage','Empty goods added');
                return redirect()->action('ProductionController@manage');
            } 
            else
            {
                session()->flash('errorMessage','Raw materials insufficient!');
                return redirect()->action('ProductionController@manage');
            }  

            
        }
        elseif($flag == 2)
        {
            if(check_materials($flag, $prd_quantity, $prd_id))
            {
                //ADD QUANTITY TO FILLED 
                (float)$new_quantity = (float)$quantity->prd_quantity + $prd_quantity;

                DB::table('products')
                ->where('prd_id','=',$prd_id)
                ->update([
                    'prd_quantity' => $new_quantity
                ]);  

                //SUBTRACT FROM RAW MATERIALS
                subtract_qty($flag, $prd_quantity, $prd_id);

                session()->flash('successMessage','Canister added');
                return redirect()->action('ProductionController@manage');
            } 
            else
            {
                session()->flash('errorMessage','Empty goods insufficient!');
                return redirect()->action('ProductionController@manage');
            }
        }
        elseif($flag == 3)
        {
            //ADD QUANTITY TO LEAKERS FROM SELLER RETURNS
            (float)$new_quantity = (float)$quantity->prd_leakers + $prd_quantity;
                        
            DB::table('products')
            ->where('prd_id','=',$prd_id)
            ->update([
                'prd_leakers' => $new_quantity
            ]);  

            session()->flash('successMessage','Leakers added');
            return redirect()->action('ProductionController@manage');
        }
        elseif($flag == 4)
        {
            // dd(check_materials($flag, $prd_quantity, $prd_id));
            if(check_materials($flag, $prd_quantity, $prd_id))
            {
                //ADD QUANTITY TO REVALVING FROM LEAKERS
                (float)$new_quantity = (float)$quantity->prd_for_revalving + $prd_quantity;
                
                DB::table('products')
                ->where('prd_id','=',$prd_id)
                ->update([
                    'prd_for_revalving' => $new_quantity
                ]);  

                //SUBTRACT QUANTITY FROM LEAKERS
                subtract_qty($flag, $prd_quantity, $prd_id);

                session()->flash('successMessage','Leakers sent to Revalves');
                return redirect()->action('ProductionController@manage');
            }
            else
            {
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

                session()->flash('successMessage','Leakers sent as Scraps');
                return redirect()->action('ProductionController@manage');
                }
            else
            {
                session()->flash('errorMessage','Leakers insufficient!');
                return redirect()->action('ProductionController@manage');
            }
        }
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
        return view('admin.production.tank');
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
            $request->sup_prd_description,
            $request->sup_prd_reorder,
            $request->sup_name,
            $request->sup_prd_is_production,
            $request->sup_prd_is_refillable,
            'show'
        );
        if($check_sup_name != null)
        {
            session()->flash('errorMessage','Supplier already exist');
            session()->flash('getProductionValues', array( $productValues));
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

}

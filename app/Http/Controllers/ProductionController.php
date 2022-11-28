<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProductionController extends Controller
{
//    private $_quantity = DB::table('products')
//         ->where('prd_id', '=', $prd_id)
//         ->first();

    public function manage()
    {
        $raw_materials = DB::table('products')
        ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','0')
        ->get();

        $canisters = DB::table('products')
        ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->get();

        $suppliers = DB::table('suppliers')
        ->get();
        
        // dd($suppliers);
        return view('admin.production.manage',compact('raw_materials', 'canisters', 'suppliers'));
    }

    //PRODUCTION
    public function startProduction()
    {

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
        $flag = $request->addraw_flag;

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

        session()->flash('successMessage','Raw material has been added');
        return redirect()->action('ProductionController@manage');
    }

    public function addQuantity(Request $request)
    {
        $prd_id = $request->prd_id;
        $prd_quantity = $request->quantity;
        $flag = $request->stockin_flag;
        
        $quantity = DB::table('products')
        ->where('prd_id', '=', $prd_id)
        ->first();
        
        //FLAGS
        // 0 = quantity raw materials
        // 1 = filled canisters
        // 2 = empty goods
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
        }
        if($flag == 1)
        {
            //RAW MATERIALS CHECKER
            // $materials_checker = DB::table('products')
            // ->where('');

            //ADD QUANTITY TO FILLED 
            $new_quantity = (float)$quantity->prd_quantity + $prd_quantity;

            DB::table('products')
            ->where('prd_id','=',$prd_id)
            ->update([
                'prd_quantity' => (float)$new_quantity
            ]);  

            //SUBTRACT FROM RAW MATERIALS
            $new_caps = (float)$quantity->prd_quantity + $prd_quantity;

            DB::table('products')
            ->where('prd_id','=',$prd_id)
            ->update([
                'prd_quantity' => (float)$new_quantity
            ]);  
        }
        elseif($flag == 2)
        {
            //ADD QUANTITY TO EMPTY GOODS
            $new_quantity = (float)$quantity->prd_empty_goods + $prd_quantity;
            
            DB::table('products')
            ->where('prd_id','=',$prd_id)
            ->update([
                'prd_empty_goods' => (float)$new_quantity
            ]);  
        }
        elseif($flag == 3)
        {
            //ADD QUANTITY TO LEAKERS FILLED CANISTERS
            $new_quantity = (float)$quantity->prd_leakers + $prd_quantity;
            
            DB::table('products')
            ->where('prd_id','=',$prd_id)
            ->update([
                'prd_leakers' => (float)$new_quantity
            ]);  

            //ADD QUANTITY TO REVALVING FROM LEAKERS
            $new_quantity = (float)$quantity->prd_leakers + $prd_quantity;
            
            DB::table('products')
            ->where('prd_id','=',$prd_id)
            ->update([
                'prd_leakers' => (float)$new_quantity
            ]);  
        }
        elseif($flag == 4)
        {
            //ADD QUANTITY TO REVALVING FROM LEAKERS
            $new_quantity = (float)$quantity->prd_for_revalving + $prd_quantity;
            
            DB::table('products')
            ->where('prd_id','=',$prd_id)
            ->update([
                'prd_for_revalving' => (float)$new_quantity
            ]);  

            //SUBTRACT QUANTITY FROM LEAKERS
            $new_quantity = (float)$quantity->prd_leakers - $prd_quantity;

            DB::table('products')
            ->where('prd_id','=',$prd_id)
            ->update([
                'prd_leakers' => (float)$new_quantity
            ]);  
        }
        elseif($flag == 5)
        {
            //ADD QUANTITY TO SCRAPS FROM LEAKERS
            $new_quantity = (float)$quantity->prd_scraps + $prd_quantity;
            
            DB::table('products')
            ->where('prd_id','=',$prd_id)
            ->update([
                'prd_scraps' => (float)$new_quantity
            ]);  

            //SUBTRACT QUANTITY FROM LEAKERS
            $new_quantity = (float)$quantity->prd_leakers - $prd_quantity;

            DB::table('products')
            ->where('prd_id','=',$prd_id)
            ->update([
                'prd_leakers' => (float)$new_quantity
            ]);  
        }

        session()->flash('successMessage','Raw materials added');
        return redirect()->action('ProductionController@manage');
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

        return redirect()->action('ProductionController@manage');
    }

}

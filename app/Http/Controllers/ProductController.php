<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        ->get();

        $suppliers = DB::table('suppliers')
        ->get();
        
        // dd($suppliers);
        return view('admin.products.manage',compact('statuses', 'default_status', 'products', 'suppliers'));

    }
    
    public function createProduct(Request $request)
    {
        $prd_name = $request->prd_name;
        $prd_description = $request->prd_description;
        $prd_sku = $request->prd_sku;
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
        'sup_id' => $sup_id
        ]);

        session()->flash('successMessage','Product has been added');
        return redirect()->action('ProductController@manage');
    }

    public function editProduct(Request $request)
    {
        $prd_id = $request->prd_id;
        $prd_name = $request->prd_name;
        $prd_description = $request->prd_description;
        $prd_sku = $request->prd_sku;
        $sup_id = $request->sup_id;
        $prd_uuid = $request->prd_uuid;

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

        DB::table('products')
        ->where('prd_id', '=', $prd_id)
        ->update([
            'prd_name' => $prd_name,
            'prd_description' => $prd_description,
            'prd_sku' => $prd_sku,
            'sup_id' => $sup_id
        ]);
        
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

        // dd($p);


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
            $request->sup_prd_description,
            $request->sup_prd_reorder,
            $request->sup_name,
            'show'
        );

        if($check_sup_name != null)
        {
            session()->flash('errorMessage','Supplier already exist');
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

    public function test(Request $request)
    {
        return redirect()->action('ProductController@manage');
    }
}

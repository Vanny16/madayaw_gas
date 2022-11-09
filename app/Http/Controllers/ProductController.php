<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    //
    public function manage()
    {
        $products = DB::table('products')
        ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        ->get();

        $suppliers = DB::table('suppliers')
        ->get();
        
        // dd($suppliers);
        return view('admin.products.manage',compact('products','suppliers'));

    }
    
    public function productAdd(Request $request)
    {
        $prd_name = $request->prd_name;
        $prd_description = $request->prd_description;
        $prd_sku = $request->prd_sku;
        $sup_id = $request->sup_id;

        DB::table('products')
        ->insert([
            'prd_name' => $prd_name,
            'prd_description' => $prd_description,
            'prd_sku' => $prd_sku,
            'sup_id' => $sup_id,
        ]);

        session()->flash('successMessage','New product has been added');
        return redirect()->action('ProductController@manage');
    }

    public function productaddQuantity(Request $request)
    {
        $prd_id = $request->prd_id;

        $quantity = DB::table('products')
        ->where('prd_id', '=', $prd_id)
        ->get();
        
        // dd($prd_id);
        $prd_quantity = (float)$quantity[0]->prd_quantity + (float)$request->prd_quantity;

        // dd($prd_quantity);

        DB::table('products')
        ->where('prd_id', '=', $prd_id)
        ->update([
            'prd_quantity' => (float)$prd_quantity,
        ]);
        
        session()->flash('successMessage','Quantity added has been added');
        return redirect()->action('ProductController@manage');
    }
    
    public function productEdit(Request $request)
    {
        $prd_name = $request->prd_name;
        $prd_description = $request->prd_description;
        $prd_sku = $request->prd_sku;
        $sup_id = $request->sup_id;

        DB::table('products')
        ->insert([
            'prd_name' => $prd_name,
            'prd_description' => $prd_description,
            'prd_sku' => $prd_sku,
            'sup_id' => $sup_id,
        ]);

        session()->flash('successMessage','New product has been added');
        return redirect()->action('ProductController@manage');
    }

    public function productStatus($prd_sku)
    {
        DB::table('users')
        ->where('usr_id', '=', $usr_id)
        ->update([
            'usr_active' => 0
        ]);

        session()->flash('successMessage','New product has been added');
        return redirect()->action('ProductController@manage');
    }
}

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
        ->get();

        return view('admin.products.manage',compact('products'));
    }
    
    public function createProduct(Request $request)
    {
        $prd_name = $request->prd_name;
        $prd_description = $request->prd_description;
        $prd_sku = $request->prd_sku;

        $usr_id = DB::table('products')
        ->insert([
        'prd_id' => session('prd_id'),
        'prd_description' => $prd_description,
        'prd_sku' => $prd_sku, 
        ]);

        session()->flash('successMessage','Product has been added');
        return redirect()->action('ProductController@manage');
    }

    public function editProduct(Request $request)
    {
        $prd_name = $request->prd_name;
        $prd_description = $request->prd_description;
        $prd_sku = $request->prd_sku;

        DB::table('products')
        ->where('prd_id', '=', $prd_id)
        ->update([
            'prd_name' => $prd_name,
            'prd_description' => $prd_description,
            'prd_sku' => $prd_sku
        ]);
        
        session()->flash('successMessage','Product details updated.');
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

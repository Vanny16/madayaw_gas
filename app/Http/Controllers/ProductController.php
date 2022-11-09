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
    // public function saveuser(Request $request)
    // {
    //     $usr_full_name = $request->usr_fullname;
    //     $usr_name = $request->usr_name;
    //     $usr_password = $request->usr_password;

    //     $usr_id = DB::table('users')
    //     ->insert([
    //         'acc_id' => session('acc_id')
    //         'usr_full_name' => $usr_full_name
    //         'usr_name' => $usr_name
    //         'usr_password' => $usr_password

    //     ]);
    // }
}

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
}

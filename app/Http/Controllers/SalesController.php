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
        ->where('prd_quantity', '!=' ,'0.0')
        ->where('prd_active', '=' ,'1')
        ->get();
        // dd(compact('products'));
        
        return view('admin.sales.main', compact('products'));
    }
    
}

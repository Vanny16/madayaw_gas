<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProductionController extends Controller
{

    public function manage()
    {
        $products = DB::table('products')
        ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        ->get();

        $suppliers = DB::table('suppliers')
        ->get();
        
        // dd($suppliers);
        return view('admin.production.production',compact('products', 'suppliers'));
    }

    //PRODUCTION
    public function startProduction()
    {

    }

    public function stopProduction()
    {

    }

    //RAW MATERIALS
    public function addRaw()
    {

    }

    //EMPTY CANISTERS
    public function addEmpty()
    {

    }  

    //CANISTER FILLING
    public function addFilling()
    {

    }

    //LEAKERS
    public function addLeakers()
    {

    }

    //REVALVING
    public function addRevalving()
    {
        
    }

    //SCRAP
    public function addScrap()
    {
        
    }

    //TANK CONTROLLER
    public function tank()
    {
        return view('admin.production.tank');
    }


}

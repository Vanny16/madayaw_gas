<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function sales()
    {
        $sales = DB::table('purchases')
        ->join('products','products.prd_id','=','purchases.prd_id')
        ->where('products.acc_id','=', session('acc_id'))
        ->get();
        // dd($sales);        

        return view('admin.reports.sales');
    }

    public function production()
    {
        $sales = DB::table('movement_logs')
        ->join('products','products.prd_id','=','purchases.prd_id')
        ->where('products.acc_id','=', session('acc_id'))
        ->get();
        // dd($sales);        

        return view('admin.reports.production');
    }
}

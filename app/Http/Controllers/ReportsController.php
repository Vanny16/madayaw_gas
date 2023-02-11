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

        return view('admin.reports.sales');
    }

    public function production()
    {
        $productions = DB::table('movement_logs')
        ->join('production_logs','production_logs.pdn_id','=','movement_logs.pdn_id')
        ->join('products','products.prd_id','=','movement_logs.prd_id')
        ->where('movement_logs.acc_id','=', session('acc_id'))
        ->selectRaw()
        ->orderBy('movement_logs.pdn_id', 'desc')
        ->paginate(10);
        // dd($productions);  
        
        $date_filter = "";

        return view('admin.reports.production', compact('productions','date_filter'));
    }

    public function search()
    {

    }
}

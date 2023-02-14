<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function sales()
    {
        $sales_date_from = "";
        $sales_date_to = "";

        $sales = DB::table('products')
                ->leftJoin('purchases', 'purchases.prd_id', '=', 'products.prd_id')
                ->where('products.acc_id', '=', session('acc_id'))
                ->where('products.prd_for_POS', '=', '1')
                ->selectRaw('products.prd_id, products.prd_name, products.prd_price, products.prd_description, sum(purchases.pur_qty) as total_sold, sum(purchases.pur_total) as total_sales')
                ->groupBy('products.prd_id', 'products.prd_name', 'products.prd_description', 'products.prd_price')
                ->havingRaw('sum(purchases.pur_qty) IS NULL OR sum(purchases.pur_qty) > 0')
                ->orderBy('products.prd_name')
                ->get();   

        return view('admin.reports.sales', compact('sales', 'sales_date_from', 'sales_date_to'));
    }

    public function salesFilter(Request $request)
    {
        $sales_date_from = $request->sales_date_from;
        $sales_date_to = $request->sales_date_to;

        $sales = DB::table('products')
                ->leftJoin('purchases', 'purchases.prd_id', '=', 'products.prd_id')
                ->leftJoin('transactions', 'transactions.trx_id', '=', 'purchases.trx_id')
                ->where('products.acc_id', '=', session('acc_id'))
                ->where('products.prd_for_POS', '=', '1')
                ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($sales_date_from)), date("Y-m-d", strtotime($sales_date_to))])
                ->selectRaw('products.prd_id, products.prd_name, products.prd_price, products.prd_description, sum(purchases.pur_qty) as total_sold, sum(purchases.pur_total) as total_sales')
                ->groupBy('products.prd_id', 'products.prd_name', 'products.prd_description', 'products.prd_price')
                ->havingRaw('sum(purchases.pur_qty) IS NULL OR sum(purchases.pur_qty) > 0')
                ->orderBy('products.prd_name')
                ->get();

        // dd($sales);        

        return view('admin.reports.sales', compact('sales', 'sales_date_from', 'sales_date_to'));
    }

    public function transactions()
    {
        $transactions_date_from = "";
        $transactions_date_to = "";

        $sales = DB::table('products')
                ->leftJoin('purchases', 'purchases.prd_id', '=', 'products.prd_id')
                ->where('products.acc_id', '=', session('acc_id'))
                ->where('products.prd_for_POS', '=', '1')
                ->selectRaw('products.prd_id, products.prd_name, products.prd_price, products.prd_description, sum(purchases.pur_qty) as total_sold, sum(purchases.pur_total) as total_sales')
                ->groupBy('products.prd_id', 'products.prd_name', 'products.prd_description', 'products.prd_price')
                ->havingRaw('sum(purchases.pur_qty) IS NULL OR sum(purchases.pur_qty) > 0')
                ->orderBy('products.prd_name')
                ->get();

        // dd($sales);        

        return view('admin.reports.transactions', compact('sales', 'transactions_date_from', 'transactions_date_to'));
    }

    public function transactionsFilter(Request $request)
    {
        $transactions_date_from = $request->transactions_date_from;
        $transactions_date_to = $request->transactions_date_to;

        $transactions = DB::table('transactions')
                        ->leftJoin('users', 'users.usr_id', '=', 'transactions.usr_id')
                        ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
                        ->get();

        // $sales = DB::table('transactions')
        // ->leftJoin('purchases', 'purchases.trx_id', '=', 'transactions.trx_id')
        // ->leftJoin('products', 'products.prd_id', '=', 'purchases.prd_id')
        // ->where('transactions.acc_id', '=', session('acc_id'))
        // ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($transactions_date_from)), date("Y-m-d", strtotime($transactions_date_to))])
        // ->selectRaw('products.prd_id, products.prd_name, products.prd_price, products.prd_description, sum(purchases.pur_qty) as total_sold, sum(purchases.pur_total) as total_sales')
        // ->groupBy('transactions.trx_id', 'transactions.trx_ref_id', 'products.prd_id', 'products.prd_name', 'products.prd_description', 'products.prd_price')
        // ->havingRaw('sum(purchases.pur_qty) IS NULL OR sum(purchases.pur_qty) > 0')
        // ->orderBy('products.prd_name')
        // ->get();

        // dd($transactions);        

        return view('admin.reports.transactions', compact('transactions', 'transactions_date_from', 'transactions_date_to'));
    }

    public function production()
    {
        $productions = DB::table('movement_logs')
                    ->join('production_logs','production_logs.pdn_id','=','movement_logs.pdn_id')
                    ->join('products','products.prd_id','=','movement_logs.prd_id')
                    ->where('movement_logs.acc_id','=', session('acc_id'))
                    ->selectRaw('log_date, products.prd_name, sum(movement_logs.log_empty_goods) as log_empty_goods, sum(movement_logs.log_filled) as log_filled, sum(movement_logs.log_leakers) as log_leakers, sum(movement_logs.log_for_revalving) as log_for_revalving, sum(movement_logs.log_scraps) as log_scraps, movement_logs.pdn_id')
                    ->groupBy('log_date', 'products.prd_name', 'movement_logs.pdn_id')
                    ->orderBy('movement_logs.pdn_id', 'desc')
                    ->paginate(10);
        
                    // dd($productions);
        $date_filter = ""; 

        return view('admin.reports.production', compact('productions','date_filter'));
    }

    public function testProductions(Request $request)
    {
        $test_productions = DB::table('movement_logs')
                    ->join('production_logs','production_logs.pdn_id','=','movement_logs.pdn_id')
                    ->join('products','products.prd_id','=','movement_logs.prd_id')
                    ->where('movement_logs.acc_id','=', session('acc_id'))
                    ->selectRaw('log_date, products.prd_name, sum(movement_logs.log_empty_goods) as log_empty_goods, sum(movement_logs.log_filled) as log_filled, sum(movement_logs.log_leakers) as log_leakers, sum(movement_logs.log_for_revalving) as log_for_revalving, sum(movement_logs.log_scraps) as log_scraps, movement_logs.pdn_id')
                    ->groupBy('log_date', 'products.prd_name', 'movement_logs.pdn_id')
                    ->orderBy('movement_logs.pdn_id', 'desc')
                    ->get();
                    // ->paginate(10);
        // dd($test_productions);
        return response()->json($test_productions);
    }

    public function productionFilter(Request $request)
    {
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        
        $filter_productions = DB::table('movement_logs')
                        ->join('production_logs','production_logs.pdn_id','=','movement_logs.pdn_id')
                        ->join('products','products.prd_id','=','movement_logs.prd_id')
                        ->where('movement_logs.acc_id','=', session('acc_id'))
                        // ->whereBetween('movement_logs.log_date','=', [$date_from, $date_to])
                        ->selectRaw('log_date, products.prd_name, sum(movement_logs.log_empty_goods) as log_empty_goods, sum(movement_logs.log_filled) as log_filled, sum(movement_logs.log_leakers) as log_leakers, sum(movement_logs.log_for_revalving) as log_for_revalving, sum(movement_logs.log_scraps) as log_scraps, movement_logs.pdn_id')
                        ->groupBy('log_date', 'products.prd_name', 'movement_logs.pdn_id')
                        ->orderBy('movement_logs.pdn_id', 'desc')
                        ->get();

        return response()->json($filter_productions);
    }
}

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

        $transactions = DB::table('transactions')
                        ->leftJoin('users', 'users.usr_id', '=', 'transactions.usr_id')
                        ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
                        ->get();

        $purchases = DB::table('purchases')
                        ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
                        ->get();
                        
        // dd($purchases);

        return view('admin.reports.transactions', compact('transactions', 'transactions_date_from', 'transactions_date_to', 'purchases'));
    }

    public function transactionsFilter(Request $request)
    {
        $transactions_date_from = $request->transactions_date_from;
        $transactions_date_to = $request->transactions_date_to;

        $transactions = DB::table('transactions')
                        ->leftJoin('users', 'users.usr_id', '=', 'transactions.usr_id')
                        ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
                        ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($transactions_date_from)), date("Y-m-d", strtotime($transactions_date_to))])
                        ->get();

        $purchases = DB::table('purchases')
                        ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
                        ->get();

        // dd($purchases);

        return view('admin.reports.transactions', compact('transactions', 'transactions_date_from', 'transactions_date_to', 'purchases'));
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

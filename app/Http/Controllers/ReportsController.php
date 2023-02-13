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

        // dd($sales);        

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

        // dd($sales);        

        return view('admin.reports.transactions', compact('sales', 'sales_date_from', 'sales_date_to'));
    }

    public function transactionsFilter(Request $request)
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

        return view('admin.reports.transactions', compact('sales', 'sales_date_from', 'sales_date_to'));
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

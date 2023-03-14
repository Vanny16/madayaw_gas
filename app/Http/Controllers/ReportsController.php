<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    // public function sales()
    // {
    //     $sales_date_from = "";
    //     $sales_date_to = "";

    //     $sales = DB::table('products')
    //             ->leftJoin('purchases', 'purchases.prd_id', '=', 'products.prd_id')
    //             ->where('products.acc_id', '=', session('acc_id'))
    //             ->where('products.prd_for_POS', '=', '1')
    //             ->selectRaw('products.prd_id, products.prd_name, products.prd_price, products.prd_description, sum(purchases.pur_qty) as total_sold, sum(purchases.pur_total) as total_sales')
    //             ->groupBy('products.prd_id', 'products.prd_name', 'products.prd_description', 'products.prd_price')
    //             ->havingRaw('sum(purchases.pur_qty) IS NULL OR sum(purchases.pur_qty) > 0')
    //             ->orderBy('products.prd_name')
    //             ->get();   

    //     return view('admin.reports.sales', compact('sales', 'sales_date_from', 'sales_date_to'));
    // }

    // public function salesFilter(Request $request)
    // {
    //     $sales_date_from = $request->sales_date_from;
    //     $sales_date_to = $request->sales_date_to;

    //     $sales = DB::table('products')
    //             ->leftJoin('purchases', 'purchases.prd_id', '=', 'products.prd_id')
    //             ->leftJoin('transactions', 'transactions.trx_id', '=', 'purchases.trx_id')
    //             ->where('products.acc_id', '=', session('acc_id'))
    //             ->where('products.prd_for_POS', '=', '1')
    //             ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($sales_date_from)), date("Y-m-d", strtotime($sales_date_to))])
    //             ->selectRaw('products.prd_id, products.prd_name, products.prd_price, products.prd_description, sum(purchases.pur_qty) as total_sold, sum(purchases.pur_total) as total_sales')
    //             ->groupBy('products.prd_id', 'products.prd_name', 'products.prd_description', 'products.prd_price')
    //             ->havingRaw('sum(purchases.pur_qty) IS NULL OR sum(purchases.pur_qty) > 0')
    //             ->orderBy('products.prd_name')
    //             ->get();

    //     // dd($sales);        

    //     return view('admin.reports.sales', compact('sales', 'sales_date_from', 'sales_date_to'));
    // }

    public function sales()
    {
        $sales_date_from = "";
        $sales_date_to = "";

        $sales = DB::table('transactions')
                        ->leftJoin('users', 'users.usr_id', '=', 'transactions.usr_id')
                        ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
                        ->get();

        return view('admin.reports.sales', compact('sales', 'sales_date_from', 'sales_date_to'));
    }

    public function salesFilter(Request $request)
    {
        $sales_date_from = $request->sales_date_from;
        $sales_date_to = $request->sales_date_to;

        $sales = DB::table('transactions')
                        ->leftJoin('users', 'users.usr_id', '=', 'transactions.usr_id')
                        ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
                        ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($sales_date_from)), date("Y-m-d", strtotime($sales_date_to))])
                        ->get();

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

        return view('admin.reports.transactions', compact('transactions', 'transactions_date_from', 'transactions_date_to', 'purchases'));
    }

    public function production(Request $request)
    {
        $selectedDate = $request->selectedDate ?? Carbon::now()->format('Y-m-d'); 
        $selectedID = $request->selectedID ?? '';

        $production_id = DB::table('production_logs')
                        ->where('pdn_date', '=', $selectedDate);

        if($selectedID <> '')
        {
            $production_id = $production_id->where('pdn_id', '=', $selectedID);
        }
        $production_id = $production_id->get();

        // dd($production_id);

        if(count($production_id) < 2)
        {
            $selectedID = $production_id->pdn_id;
        }
        
        $canisters = DB::table('products')
                    ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
                    ->where('products.acc_id', '=', session('acc_id'))
                    ->where('prd_for_production','=','1')
                    ->where('prd_is_refillable','=','1')
                    ->get();

        $production_datetime = DB::table('production_logs');

        if($selectedID <> '')
        {
            $production_datetime = $production_datetime ->where('pdn_id', '=', $selectedID);
        }
        elseif(!empty($production_id[0]))
        {
            $production_datetime = $production_datetime ->where('pdn_id', '=', $production_id[0]->pdn_id);
        }
        
        $production_datetime = $production_datetime ->first();
        
        $production_date_from = "";
        $production_date_to = "";
                        
        $pdn_date = Carbon::createFromFormat('Y-m-d', $production_datetime->pdn_date)->format('F j, Y');
        $pdn_start_time = Carbon::createFromFormat('H:i:s', $production_datetime->pdn_start_time)->format('h:i A');
        $pdn_end_time = Carbon::createFromFormat('H:i:s', $production_datetime->pdn_end_time)->format('h:i A');

        $tanks = DB::table('tanks')
        ->where('acc_id', '=', session('acc_id'))
        ->get();

        // if(isset($production_times)){
        //     if(date('Y-m-d',strtotime($production_times->pdn_date)) == date("Y-m-d"))
        //     {
        //         if($production_times->pdn_end_time <> 0)
        //         {
        //             $pdn_date = date("F j, Y", strtotime($production_times->pdn_date));
        //             $pdn_start_time = date("h:i:s a", strtotime($production_times->pdn_start_time));
        //             $pdn_end_time = date("h:i:s a", strtotime($production_times->pdn_end_time));
        //         }
        //         else
        //         {
        //             $pdn_date = date("F j, Y", strtotime($production_times->pdn_date));
        //             $pdn_start_time = date("h:i:s a", strtotime($production_times->pdn_start_time));
        //             $pdn_end_time = '-- : -- --'; 
        //             // $pdn_end_time = date("h:i:s a", strtotime($production_times->pdn_end_time));
        //         }   
        //     }
        //     else
        //     {
        //         $pdn_date = date("F j, Y", strtotime($production_times->pdn_date));
        //         $pdn_start_time = date("h:i:s a", strtotime($production_times->pdn_start_time));
        //         $pdn_end_time = date("h:i:s a", strtotime($production_times->pdn_end_time));
        //     }
        // }

        // $production_list = DB::table('production_logs')
        //                     ->select('pdn_id', 'pdn_date')
        //                     ->get();

        // $months = []; 
        // $days = []; 
        // $years = [];

        // foreach($production_list as $row)
        // {
        //     if(!in_array(date("Y", strtotime($row->pdn_date)), $years))
        //     {
        //         array_push($years, date("Y", strtotime($row->pdn_date)));
        //     }

        //     if(!in_array(date("F", strtotime($row->pdn_date)), $months))
        //     {
        //         array_push($months, date("F", strtotime($row->pdn_date)));
        //     }

        //     if(!in_array(date("j", strtotime($row->pdn_date)), $days))
        //     {
        //         array_push($days, date("j", strtotime($row->pdn_date)));
        //     }
        // }
        // // dd($years, $months, $days);

        // $production_years = $request->input('year') ?? Carbon::now()->year;
        // $production_months = $request->input('year') ?? Carbon::now()->month;

        // dd($production_id);

        return view('admin.reports.production', compact('canisters','production_date_from','production_date_to', 'pdn_date', 'pdn_start_time', 'pdn_end_time', 'tanks', 'production_id','selectedDate', 'selectedID'));
    }

    public function productionFilter(Request $request)
    {
        $production_date_from = $request->production_date_from;
        $production_date_to = $request->production_date_to;
        
        $productions = DB::table('movement_logs')
                    ->join('production_logs','production_logs.pdn_id','=','movement_logs.pdn_id')
                    ->join('products','products.prd_id','=','movement_logs.prd_id')
                    ->where('movement_logs.acc_id','=', session('acc_id'))
                    ->whereBetween('movement_logs.log_date', [date("Y-m-d", strtotime($production_date_from)), date("Y-m-d", strtotime($production_date_to))])
                    ->selectRaw('log_date, products.prd_name, sum(movement_logs.log_empty_goods) as log_empty_goods, sum(movement_logs.log_filled) as log_filled, sum(movement_logs.log_leakers) as log_leakers, sum(movement_logs.log_for_revalving) as log_for_revalving, sum(movement_logs.log_scraps) as log_scraps, movement_logs.pdn_id')
                    ->groupBy('log_date', 'products.prd_name', 'movement_logs.pdn_id')
                    ->orderBy('movement_logs.pdn_id', 'desc')
                    ->paginate(10);

        return view('admin.reports.production', compact('productions','production_date_from','production_date_to'));
    }

    public function testProductions(Request $request)
    {
        // $date_from = Carbon::now();
        // $date_to = $date_from->format('Y-m-d');
        // dd($date_to);
        $test_productions = DB::table('movement_logs')
                    ->join('production_logs','production_logs.pdn_id','=','movement_logs.pdn_id')
                    ->join('products','products.prd_id','=','movement_logs.prd_id')
                    // ->where('movement_logs.log_date','=', $date_to)
                    ->where('movement_logs.acc_id','=', session('acc_id'))
                    ->selectRaw('log_date, products.prd_name, sum(movement_logs.log_empty_goods) as log_empty_goods, sum(movement_logs.log_filled) as log_filled, sum(movement_logs.log_leakers) as log_leakers, sum(movement_logs.log_for_revalving) as log_for_revalving, sum(movement_logs.log_scraps) as log_scraps, movement_logs.pdn_id')
                    ->groupBy('log_date', 'products.prd_name', 'movement_logs.pdn_id')
                    ->orderBy('movement_logs.pdn_id', 'desc')
                    ->get();
                    // ->paginate(10);
        // dd($test_productions);
        dd(response()->json($test_productions));
        return response()->json($test_productions);


    }

    public function testproductionFilter(Request $request)
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

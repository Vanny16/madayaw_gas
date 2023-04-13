<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function sales()
    {
        $sales_date_from = "";
        $sales_date_to = "";

        $sales = DB::table('transactions')
                    ->leftJoin('users', 'users.usr_id', '=', 'transactions.usr_id')
                    ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
                    ->join('purchases', 'purchases.trx_id', '=', 'transactions.trx_id')
                    ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
                    ->where('trx_active','=','1')
                    ->orderBy('transactions.trx_datetime', 'DESC')
                    ->paginate(10);
        
        $purchases = DB::table('purchases')
                        ->join('products', 'products.prd_id', '=', 'purchases.prd_id')   
                        ->get();

        $transactions = DB::table('transactions')
        ->where('trx_active','=','1')
        ->get();

        $customers = DB::table('customers')
        ->get();

        $users = DB::table('users')
        ->get();

        $products = DB::table('products')
        ->get();
        
        session(['tbl_sales_form' => 'sales']);
        session(['select_grp' => -1]);
        session(['select_set' => '0']);

        return view('admin.reports.sales', compact('sales', 'sales_date_from', 'sales_date_to', 'purchases', 'transactions', 'customers', 'users', 'products'));
    }

    public function salesToday()
    {
        $sales_date_from = date("Y-m-d");
        $sales_date_to = date("Y-m-d");

        $sales = DB::table('transactions')
                    ->leftJoin('users', 'users.usr_id', '=', 'transactions.usr_id')
                    ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
                    ->join('purchases', 'purchases.trx_id', '=', 'transactions.trx_id')
                    ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
                    ->where('trx_active','=','1')
                    ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($sales_date_from)), date("Y-m-d", strtotime($sales_date_to))])
                    ->orderBy('transactions.trx_datetime', 'DESC')
                    ->paginate(10);

        $purchases = DB::table('purchases')
                    ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
                    ->get();
                    
        $transactions = DB::table('transactions')
        ->where('trx_active','=','1')
        ->get();

        $customers = DB::table('customers')
        ->get();

        $users = DB::table('users')
        ->get();
        
        $products = DB::table('products')
        ->where('prd_for_POS','=','1')
        ->get();

        session(['tbl_sales_form' => 'sales']);
        session(['select_grp' => -1]);
        session(['select_set' => '0']);

        return view('admin.reports.sales', compact('sales', 'sales_date_from', 'sales_date_to', 'purchases', 'transactions', 'customers', 'users', 'products'));
    }

    public function salesFilter(Request $request)
    {
        $sales_date_from = $request->sales_date_from;
        $sales_date_to = $request->sales_date_to;
        $select_grp = $request->select_grp;
        $select_set = $request->input('select_set');
        $tbl_sales_form = "";
        $paginate_row = (int)$request->paginate_row;

        if($select_grp != -1){

            $col_name = "";
            $col_val = "";

            if($select_set[$select_grp] != null){
                if($select_grp == 0){
                    $col_name = "trx_ref_id";
                    $col_val = $select_set[$select_grp];

                    if($col_val == "SUMMARY"){
                        $sales = DB::table('transactions')
                        ->leftJoin('users', 'users.usr_id', '=', 'transactions.usr_id')
                        ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
                        ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($sales_date_from)), date("Y-m-d", strtotime($sales_date_to))])
                        ->orderBy('transactions.trx_datetime', 'DESC')
                        ->paginate($paginate_row);

                        $tbl_sales_form = "sales_summary";
                    }
                    else if($col_val != "ALL"){
                        $sales = DB::table('transactions')
                        ->leftJoin('users', 'users.usr_id', '=', 'transactions.usr_id')
                        ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
                        ->join('purchases', 'purchases.trx_id', '=', 'transactions.trx_id')
                        ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
                        ->where($col_name,'=', $col_val)
                        ->orderBy('transactions.trx_datetime', 'DESC')
                        ->paginate($paginate_row);

                        $tbl_sales_form = "sales";
                    }
                    else{       
                        $sales = DB::table('transactions')
                        ->leftJoin('users', 'users.usr_id', '=', 'transactions.usr_id')
                        ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
                        ->join('purchases', 'purchases.trx_id', '=', 'transactions.trx_id')
                        ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
                        ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($sales_date_from)), date("Y-m-d", strtotime($sales_date_to))])
                        ->orderBy('transactions.trx_datetime', 'DESC')
                        ->paginate($paginate_row);

                        $tbl_sales_form = "sales";
                    }

                }
                else if($select_grp == 1){
                    $col_name = "prd_name";
                    $col_val = $select_set[$select_grp];

                    if($col_val != "ALL"){      
                        $sales = DB::table('products')
                        ->join('purchases', 'purchases.prd_id', '=', 'products.prd_id')
                        ->join('transactions', 'transactions.trx_id', '=', 'purchases.trx_id')
                        ->select('products.prd_name', DB::raw('SUM((purchases.pur_crate_in * 12) + purchases.pur_loose_in) as pur_qty_in'), DB::raw('SUM(purchases.pur_qty) as pur_qty_out'), DB::raw('SUM(purchases.pur_total) as pur_total'), DB::raw('SUM(transactions.trx_amount_paid) as trx_amount_paid'))
                        ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($sales_date_from)), date("Y-m-d", strtotime($sales_date_to))])
                        ->where($col_name,'=', $col_val)
                        ->groupBy('products.prd_name')
                        ->paginate($paginate_row);

                        $tbl_sales_form = "products";
                    }
                    else{       
                        $sales = DB::table('products')
                        ->join('purchases', 'purchases.prd_id', '=', 'products.prd_id')
                        ->join('transactions', 'transactions.trx_id', '=', 'purchases.trx_id')
                        ->select('products.prd_name', DB::raw('SUM((purchases.pur_crate_in * 12) + purchases.pur_loose_in) as pur_qty_in'), DB::raw('SUM(purchases.pur_qty) as pur_qty_out'), DB::raw('SUM(purchases.pur_total) as pur_total'), DB::raw('SUM(transactions.trx_amount_paid) as trx_amount_paid'))
                        ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($sales_date_from)), date("Y-m-d", strtotime($sales_date_to))])
                        ->groupBy('products.prd_name')
                        ->paginate($paginate_row);

                        $tbl_sales_form = "products";
                    }
                }

                else if($select_grp == 2){
                    $col_name = "cus_name";
                    $col_val = $select_set[$select_grp];
                    
                    if($col_val != "ALL"){      
                        $sales = DB::table('customers')
                        ->join('transactions', 'transactions.cus_id', '=', 'customers.cus_id')
                        ->join('purchases', 'purchases.trx_id', '=', 'transactions.trx_id')
                        ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
                        ->where('products.prd_is_refillable','=', '1')
                        ->where($col_name,'=', $col_val)
                        ->select('customers.cus_name', DB::raw('SUM((purchases.pur_crate_in * 12) + purchases.pur_loose_in) as pur_qty_in'), DB::raw('SUM(purchases.pur_qty) as pur_qty_out'), DB::raw('SUM(transactions.trx_total) as trx_total'), DB::raw('SUM(transactions.trx_balance) as trx_balance'), DB::raw('SUM(transactions.trx_amount_paid) as trx_amount_paid'))
                        ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($sales_date_from)), date("Y-m-d", strtotime($sales_date_to))])
                        ->groupBy('customers.cus_name')
                        ->paginate($paginate_row);

                        $tbl_sales_form = "customers";
                    }
                    else{       
                        $sales = DB::table('customers')
                        ->join('transactions', 'transactions.cus_id', '=', 'customers.cus_id')
                        ->join('purchases', 'purchases.trx_id', '=', 'transactions.trx_id')
                        ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
                        ->where('products.prd_is_refillable','=', '1')
                        ->select('customers.cus_name', DB::raw('SUM((purchases.pur_crate_in * 12) + purchases.pur_loose_in) as pur_qty_in'), DB::raw('SUM(purchases.pur_qty) as pur_qty_out'), DB::raw('SUM(transactions.trx_total) as trx_total'), DB::raw('SUM(transactions.trx_balance) as trx_balance'), DB::raw('SUM(transactions.trx_amount_paid) as trx_amount_paid'))
                        ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($sales_date_from)), date("Y-m-d", strtotime($sales_date_to))])
                        ->groupBy('customers.cus_name')
                        ->paginate($paginate_row);
                        // ->get();     
                        // dd($sales);

                        $tbl_sales_form = "customers";
                    }

                }

                else if($select_grp == 3){
                    $col_name = "usr_full_name";
                    $col_val = $select_set[$select_grp];
                    
                    if($col_val != "ALL"){
                        $sales = DB::table('users')
                        ->join('transactions', 'transactions.usr_id', '=', 'users.usr_id')
                        ->select('users.usr_full_name', DB::raw('SUM(transactions.trx_total) as trx_total'), DB::raw('COUNT(transactions.trx_id) as trx_count'))
                        ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($sales_date_from)), date("Y-m-d", strtotime($sales_date_to))])
                        ->where($col_name,'=', $col_val)
                        ->groupBy('users.usr_full_name')
                        ->paginate($paginate_row);

                        $tbl_sales_form = "cashiers";
                    }
                    else{
                        $sales = DB::table('users')
                        ->join('transactions', 'transactions.usr_id', '=', 'users.usr_id')
                        ->select('users.usr_full_name', DB::raw('SUM(transactions.trx_total) as trx_total'), DB::raw('COUNT(transactions.trx_id) as trx_count'))
                        ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($sales_date_from)), date("Y-m-d", strtotime($sales_date_to))])
                        ->groupBy('users.usr_full_name')
                        ->paginate($paginate_row);

                        $tbl_sales_form = "cashiers";
                    }
                }

                // $sales = DB::table('transactions')
                // ->leftJoin('users', 'users.usr_id', '=', 'transactions.usr_id')
                // ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
                // ->join('purchases', 'purchases.trx_id', '=', 'transactions.trx_id')
                // ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
                // ->where($col_name,'=', $col_val)
                // ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($sales_date_from)), date("Y-m-d", strtotime($sales_date_to))])
                // ->orderBy('transactions.trx_datetime', 'DESC')
                // ->get();

                // dd($sales);
            }
            else{
                session()->flash('errorMessage',  "Invalid search");
                
                $sales = DB::table('transactions')
                    ->leftJoin('users', 'users.usr_id', '=', 'transactions.usr_id')
                    ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
                    ->join('purchases', 'purchases.trx_id', '=', 'transactions.trx_id')
                    ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
                    ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($sales_date_from)), date("Y-m-d", strtotime($sales_date_to))])
                    ->orderBy('transactions.trx_datetime', 'DESC')
                    ->paginate($paginate_row);

                    $tbl_sales_form = "sales";
            }
        }
        else{
            $sales = DB::table('transactions')
                ->leftJoin('users', 'users.usr_id', '=', 'transactions.usr_id')
                ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
                ->join('purchases', 'purchases.trx_id', '=', 'transactions.trx_id')
                ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
                ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($sales_date_from)), date("Y-m-d", strtotime($sales_date_to))])
                ->orderBy('transactions.trx_datetime', 'DESC')
                ->paginate($paginate_row);
                
                $tbl_sales_form = "sales";
        }

        
        $purchases = DB::table('purchases')
                        ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
                        ->get();

        $transactions = DB::table('transactions')
        ->where('trx_active','=','1')
        ->get();

        $customers = DB::table('customers')
        ->get();

        $users = DB::table('users')
        ->get();
        
        $products = DB::table('products')
        ->where('prd_for_POS','=','1')
        ->get();

        session(['tbl_sales_form' => $tbl_sales_form]);
        session(['select_grp' => $select_grp]);

        if($select_grp != -1){
            session(['select_set' => $select_set[$select_grp]]);
        }
        else{
            session(['select_set' => '0']);
        }

        return view('admin.reports.sales', compact('sales', 'sales_date_from', 'sales_date_to', 'purchases', 'transactions', 'customers', 'users', 'products'));
    }

    public function transactions()
    {
        $transactions_date_from = "";
        $transactions_date_to = "";
                        
        $transactions = DB::table('transactions')
                        ->leftJoin('users', 'users.usr_id', '=', 'transactions.usr_id')
                        ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
                        ->join('purchases', 'purchases.trx_id', '=', 'transactions.trx_id')
                        ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
                        ->where('trx_active','=','1')
                        ->orderBy('transactions.trx_datetime', 'DESC')
                        ->get();

        $purchases = DB::table('purchases')
                        ->join('products', 'products.prd_id', '=', 'purchases.prd_id')   
                        ->get();
        

        $pur_ins = DB::table('purchases')
                        ->join('products', 'products.prd_id', '=', 'purchases.prd_id_in')
                        ->get();
                        
        $ops_ins = DB::table('purchases')
                        ->join('oppositions', 'oppositions.ops_id', '=', 'purchases.prd_id_in')
                        ->get();

        $bad_orders = DB::table('bad_orders')
                        ->join('transactions', 'transactions.trx_id', '=', 'bad_orders.trx_id')
                        ->join('products', 'products.prd_id', '=', 'bad_orders.prd_id')
                        ->join('customers', 'customers.cus_id', '=', 'transactions.cus_id')
                        ->get();

        return view('admin.reports.transactions', compact('transactions', 'transactions_date_from', 'transactions_date_to', 'purchases', 'pur_ins', 'ops_ins', 'bad_orders'));
    }

    public function transactionsToday()
    {
        $transactions_date_from = date("Y-m-d");
        $transactions_date_to = date("Y-m-d");

        $transactions = DB::table('transactions')
                        ->leftJoin('users', 'users.usr_id', '=', 'transactions.usr_id')
                        ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
                        ->join('purchases', 'purchases.trx_id', '=', 'transactions.trx_id')
                        ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
                        ->where('trx_active','=','1')
                        ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($transactions_date_from)), date("Y-m-d", strtotime($transactions_date_to))])
                        ->orderBy('transactions.trx_datetime', 'DESC')
                        ->get();

        $purchases = DB::table('purchases')
                        ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
                        ->get();

        $pur_ins = DB::table('purchases')
                        ->join('products', 'products.prd_id', '=', 'purchases.prd_id_in')
                        ->get();
                        
        $ops_ins = DB::table('purchases')
                        ->join('oppositions', 'oppositions.ops_id', '=', 'purchases.prd_id_in')
                        ->get();

        $bad_orders = DB::table('bad_orders')
                        ->join('transactions', 'transactions.trx_id', '=', 'bad_orders.trx_id')
                        ->join('products', 'products.prd_id', '=', 'bad_orders.prd_id')
                        ->join('customers', 'customers.cus_id', '=', 'transactions.cus_id')
                        ->get();

        return view('admin.reports.transactions', compact('transactions', 'transactions_date_from', 'transactions_date_to', 'purchases', 'pur_ins', 'ops_ins', 'bad_orders'));
    }

    public function transactionsFilter(Request $request)
    {
        $transactions_date_from = $request->transactions_date_from;
        $transactions_date_to = $request->transactions_date_to;

        $transactions = DB::table('transactions')
                        ->leftJoin('users', 'users.usr_id', '=', 'transactions.usr_id')
                        ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
                        ->join('purchases', 'purchases.trx_id', '=', 'transactions.trx_id')
                        ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
                        ->where('trx_active','=','1')
                        ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($transactions_date_from)), date("Y-m-d", strtotime($transactions_date_to))])
                        ->orderBy('transactions.trx_datetime', 'DESC')
                        ->get();
                        
                        // dd($transactions);

        $purchases = DB::table('purchases')
                        ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
                        ->get();

        $pur_ins = DB::table('purchases')
                        ->join('products', 'products.prd_id', '=', 'purchases.prd_id_in')
                        ->get();
                        
        $ops_ins = DB::table('purchases')
                        ->join('oppositions', 'oppositions.ops_id', '=', 'purchases.prd_id_in')
                        ->get();

        $bad_orders = DB::table('bad_orders')
                        ->join('transactions', 'transactions.trx_id', '=', 'bad_orders.trx_id')
                        ->join('products', 'products.prd_id', '=', 'bad_orders.prd_id')
                        ->join('customers', 'customers.cus_id', '=', 'transactions.cus_id')
                        ->get();

        return view('admin.reports.transactions', compact('transactions', 'transactions_date_from', 'transactions_date_to', 'purchases', 'pur_ins', 'ops_ins', 'bad_orders'));
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

        // dd(empty($production_id));

        if(count($production_id) < 2 && count($production_id) > 0 )
        {
            $selectedID = $production_id[0]->pdn_id;
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
            // dd('if');
        }
        elseif(!empty($production_id[0]))
        {
            $production_datetime = $production_datetime ->where('pdn_id', '=', $production_id[0]->pdn_id);
            // dd('elseif');
        }
        
        $production_datetime = $production_datetime ->first();
        
        
            if(!empty($production_datetime))
            {
                $pdn_date = Carbon::createFromFormat('Y-m-d', $production_datetime->pdn_date)->format('F j, Y');
                $pdn_start_time = Carbon::createFromFormat('H:i:s', $production_datetime->pdn_start_time)->format('h:i A');
                
                $scrapped_month = Carbon::createFromFormat('Y-m-d', $production_datetime->pdn_date)->format('F Y');

                if(!empty($production_datetime->pdn_end_time))
                {
                    $pdn_end_time = Carbon::createFromFormat('H:i:s', $production_datetime->pdn_end_time)->format('h:i A');
                }
                else
                {
                    $pdn_end_time = "--:--  --";
                }
            }
            else
            {
                $pdn_date = Carbon::now()->format('F j, Y');
                $pdn_start_time = "--:--  --";
                $pdn_end_time = "--:--  --";
                $scrapped_month = Carbon::now()->format('F Y');
            }
        
        // dd($production_datetime);
        
        
        $production_list = DB::table('production_logs')
                            ->select('pdn_id', 'pdn_date')
                            ->get();

        $months = []; 
        $years = [];

        foreach($production_list as $row)
        {
            if(!in_array(date("F", strtotime($row->pdn_date)), $months))
            {
                array_push($months, date("F", strtotime($row->pdn_date)));
            }

            if(!in_array(date("Y", strtotime($row->pdn_date)), $years))
            {
                array_push($years, date("Y", strtotime($row->pdn_date)));
            }
        }

        $production_date_from = "";
        $production_date_to = "";
                        
        $tanks = DB::table('tanks')
        ->where('acc_id', '=', session('acc_id'))
        ->get();

        return view('admin.reports.production', compact('canisters','production_date_from','production_date_to', 'pdn_date', 'pdn_start_time', 'pdn_end_time', 'tanks', 'production_id', 'selectedDate', 'selectedID', 'months', 'years', 'scrapped_month'));
    }
}

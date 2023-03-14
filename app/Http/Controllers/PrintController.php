<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PrintController extends Controller
{
    public function allcustomerDetails()
    {
        $all_customer_details = DB::table('customers')
        ->get();

        return view('admin.print.customer', compact('all_customer_details'));
    }

    public function customerDetails($cus_uuid)
    {
        $customer_details = DB::table('customers')
        ->where('cus_uuid', '=', $cus_uuid)
        ->get();

        return view('admin.print.customer', compact('customer_details'));
    }

    public function allsupplierDetails()
    {
        $all_supplier_details = DB::table('suppliers')
        ->get();

        return view('admin.print.supplier', compact('all_supplier_details'));
    }

    public function supplierDetails($sup_uuid)
    {
        $supplier_details = DB::table('suppliers')
        ->where('sup_uuid', '=', $sup_uuid)
        ->get();

        return view('admin.print.supplier', compact('supplier_details'));
    }

    
    public function productDetails($prd_sku)
    {
        $product_details = DB::table('products')
        ->where('prd_sku', '=', $prd_sku)
        ->get();

        return view('admin.print.product', compact('product_details'));
    }

    public function allproductDetails()
    {
        $all_product_details = DB::table('products')
        ->get();

        return view('admin.print.product', compact('all_product_details'));
    }

    public function allsaleDetails()
    {
        $all_sale_details = DB::table('sales')
        ->get();

        return view('admin.print.main', compact('all_sale_details'));
    }

    public function oppositeDetails($ops_id)
    {
        $opposite_details = DB::table('oppositions')
        ->where('ops_id', '=', $ops_id)
        ->get();

        return view('admin.print.opposites', compact('opposite_details'));
    }

    public function alloppositeDetails()
    {
        $all_opposite_details = DB::table('oppositions')
        ->get();

        return view('admin.print.opposites', compact('all_opposite_details'));
    }


    public function receiptDetails()
    {
        $latest_trx_id = session('latest_trx_id');

        $transactions = DB::table('transactions')
        ->join('customers', 'customers.cus_id', '=', 'transactions.cus_id')
        ->where('trx_id', '=' ,$latest_trx_id)
        ->first();

        $purchases = DB::table('purchases')
        ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
        ->where('trx_id', '=' ,$latest_trx_id)
        ->get();

        session()->flash('successMessage','Transaction complete!');
        return view('admin.print.deliveryreceipt', compact('transactions', 'purchases'));
    }

    // public function salesReports(Request $request)
    // {   
    //     $sales_date_from = $request->sales_date_from;
    //     $sales_date_to = $request->sales_date_to;

    //     $sales_reports = DB::table('products')
    //     ->leftJoin('purchases', 'purchases.prd_id', '=', 'products.prd_id')
    //     ->leftJoin('transactions', 'transactions.trx_id', '=', 'purchases.trx_id')
    //     ->where('products.acc_id', '=', session('acc_id'))
    //     ->where('products.prd_for_POS', '=', '1')
    //     ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($sales_date_from)), date("Y-m-d", strtotime($sales_date_to))])
    //     ->selectRaw('products.prd_id, products.prd_name, products.prd_price, products.prd_description, sum(purchases.pur_qty) as total_sold, sum(purchases.pur_total) as total_sales')
    //     ->groupBy('products.prd_id', 'products.prd_name', 'products.prd_description', 'products.prd_price')
    //     ->havingRaw('sum(purchases.pur_qty) IS NULL OR sum(purchases.pur_qty) > 0')
    //     ->orderBy('products.prd_name')
    //     ->get();
 
    //     return view('admin.print.salesreports', compact('sales_reports', 'sales_date_from', 'sales_date_to'));
    // }

    // public function allsalesReports(Request $request)
    // {
    //     $sales_date_from = $request->sales_date_from;
    //     $sales_date_to = $request->sales_date_to;
       

    //     $all_sales_reports = DB::table('products')
    //     ->leftJoin('purchases', 'purchases.prd_id', '=', 'products.prd_id')
    //     ->leftJoin('transactions', 'transactions.trx_id', '=', 'purchases.trx_id')
    //     ->where('products.acc_id', '=', session('acc_id'))
    //     ->where('products.prd_for_POS', '=', '1')
    //     ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($sales_date_from)), date("Y-m-d", strtotime($sales_date_to))])
    //     ->selectRaw('products.prd_id, products.prd_name, products.prd_price, products.prd_description, sum(purchases.pur_qty) as total_sold, sum(purchases.pur_total) as total_sales')
    //     ->groupBy('products.prd_id', 'products.prd_name', 'products.prd_description', 'products.prd_price')
    //     ->havingRaw('sum(purchases.pur_qty) IS NULL OR sum(purchases.pur_qty) > 0')
    //     ->orderBy('products.prd_name')
    //     ->get();

    //     return view('admin.print.salesreports', compact('all_sales_reports', 'sales_date_from', 'sales_date_to'));
    // }

    public function salesReports(Request $request)
    {   
        $sales_date_from = $request->sales_date_from;
        $sales_date_to = $request->sales_date_to;

        $sales_reports = DB::table('transactions')
        ->leftJoin('users', 'users.usr_id', '=', 'transactions.usr_id')
        ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
        ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($sales_date_from)), date("Y-m-d", strtotime($sales_date_to))])
        ->get();

        $purchases = DB::table('purchases')
        ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
        ->get();

       
        return view('admin.print.salesreports', compact('sale_reports', 'purchases', 'sales_date_from', 'sales_date_to'));
    }

    public function allsalesReports(Request $request)
    {   
        $sales_date_from = $request->sales_date_from;
        $sales_date_to = $request->sales_date_to;

        $all_sales_reports = DB::table('transactions')
        ->leftJoin('users', 'users.usr_id', '=', 'transactions.usr_id')
        ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
        ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($sales_date_from)), date("Y-m-d", strtotime($sales_date_to))])
        ->get();

        $purchases = DB::table('purchases')
        ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
        ->get();

       
        return view('admin.print.salesreports', compact('all_sales_reports', 'purchases', 'sales_date_from', 'sales_date_to'));
    }

    public function transactionReports(Request $request)
    {   
        $transactions_date_from = $request->transactions_date_from;
        $transactions_date_to = $request->transactions_date_to;

        $transaction_reports = DB::table('transactions')
        ->leftJoin('users', 'users.usr_id', '=', 'transactions.usr_id')
        ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
        ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($transactions_date_from)), date("Y-m-d", strtotime($transactions_date_to))])
        ->get();

        $purchases = DB::table('purchases')
        ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
        ->get();

        // $transaction_Reports = DB::table('transactions')
        // ->where('trx_id', '=', $trx_id)
        // ->get();

        return view('admin.print.transactionreport', compact('transaction_reports', 'purchases', 'transactions_date_from', 'transactions_date_to'));
    }

    public function alltransactionReports(Request $request)
    {   
        $transactions_date_from = $request->transactions_date_from;
        $transactions_date_to = $request->transactions_date_to;

        $all_transaction_reports = DB::table('transactions')
        ->leftJoin('users', 'users.usr_id', '=', 'transactions.usr_id')
        ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
        ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($transactions_date_from)), date("Y-m-d", strtotime($transactions_date_to))])
        ->get();

        $all_purchase_reports = DB::table('purchases')
        ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
        ->get();

        $purchases = DB::table('purchases')
        ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
        ->get();

        // $all_transaction_reports = DB::table('transactions')
        // ->get();

        return view('admin.print.transactionreport', compact('all_transaction_reports', 'purchases', 'transactions_date_from', 'transactions_date_to'));
    }

    public function productionReports(Request $request)
    {
        $production_date_from = $request->production_date_from;
        $production_date_to = $request->production_date_to;
        
        $production_reports = DB::table('movement_logs')
        ->join('production_logs','production_logs.pdn_id','=','movement_logs.pdn_id')
        ->join('products','products.prd_id','=','movement_logs.prd_id')
        ->where('movement_logs.acc_id','=', session('acc_id'))
        ->whereBetween('movement_logs.log_date', [date("Y-m-d", strtotime($production_date_from)), date("Y-m-d", strtotime($production_date_to))])
        ->selectRaw('log_date, products.prd_name, sum(movement_logs.log_empty_goods) as log_empty_goods, sum(movement_logs.log_filled) as log_filled, sum(movement_logs.log_leakers) as log_leakers, sum(movement_logs.log_for_revalving) as log_for_revalving, sum(movement_logs.log_scraps) as log_scraps, movement_logs.pdn_id')
        ->groupBy('log_date', 'products.prd_name', 'movement_logs.pdn_id')
        ->orderBy('movement_logs.pdn_id', 'desc')
        ->paginate(10);


        return view('admin.print.productionreport', compact('production_reports', 'production_date_from', 'production_date_to'));
    }
    public function allproductionReports(Request $request)
    {
        $production_date_from = $request->production_date_from;
        $production_date_to = $request->production_date_to;
        
        $all_production_reports = DB::table('movement_logs')
        ->join('production_logs','production_logs.pdn_id','=','movement_logs.pdn_id')
        ->join('products','products.prd_id','=','movement_logs.prd_id')
        ->where('movement_logs.acc_id','=', session('acc_id'))
        ->whereBetween('movement_logs.log_date', [date("Y-m-d", strtotime($production_date_from)), date("Y-m-d", strtotime($production_date_to))])
        ->selectRaw('log_date, products.prd_name, sum(movement_logs.log_empty_goods) as log_empty_goods, sum(movement_logs.log_filled) as log_filled, sum(movement_logs.log_leakers) as log_leakers, sum(movement_logs.log_for_revalving) as log_for_revalving, sum(movement_logs.log_scraps) as log_scraps, movement_logs.pdn_id')
        ->groupBy('log_date', 'products.prd_name', 'movement_logs.pdn_id')
        ->orderBy('movement_logs.pdn_id', 'desc')
        ->paginate(10);


        return view('admin.print.productionreport', compact('all_production_reports', 'production_date_from', 'production_date_to'));
    }

    public function purchasesReports()
    {
        $purchases_reports = DB::table('purchases')
        ->where('prd_id', '=', $prd_id)
        ->get();

        return view('admin.print.purchasesreport', compact('purchases_reports'));
    }

    public function allpurchasesReports()
    {   
        $latest_trx_id = session('latest_trx_id');

        $transactions = DB::table('transactions')
        ->join('customers', 'customers.cus_id', '=', 'transactions.cus_id')
        ->where('trx_id', '=' ,$latest_trx_id)
        ->first();

        $all_purchases_reports = DB::table('purchases')
        ->join('products','products.prd_id','=','purchases.prd_id')
        ->where('trx_id', '=' ,$latest_trx_id)
        ->get();
        // dd($all_purchases_reports);
        return view('admin.print.purchasesreport', compact('all_purchases_reports'));
    }

}

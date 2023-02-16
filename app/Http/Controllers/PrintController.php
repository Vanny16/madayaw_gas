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

    public function salesReports($sls_id)
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

        $salesReports = DB::table('sales_reports')
        ->where('sls_id', '=', $sls_id)
        ->get();

     
        return view('admin.print.salesreports', compact('salesReports', 'sales', 'sales_date_from', 'sales_date_to'));
    }

    public function allsalesReports(Request $request)
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
       
        $all_sales_Reports = DB::table('sales_reports')
        ->get();
        // dd($all_sales_Reports);

       
        return view('admin.print.salesreports', compact('all_sales_Reports', 'sales', 'sales_date_from', 'sales_date_to'));
    }

    public function transactionReports($trx_id)
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

        $transaction_Reports = DB::table('transactions')
        ->where('trx_id', '=', $trx_id)
        ->get();

        return view('admin.print.transactionreport', compact('transaction_Reports', 'transactions', 'purchases'));
    }

    public function alltransactionReports(Request $request)
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

        $all_transaction_reports = DB::table('transactions')
        ->get();

        return view('admin.print.transactionreport', compact('all_transaction_reports', 'transactions', 'purchases'));
    }

}

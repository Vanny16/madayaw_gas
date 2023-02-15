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
        $all_oppisite_details = DB::table('oppositions')
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
        $salesReports = DB::table('sales_reports')
        ->where('sls_id', '=', $sls_id)
        ->get();

        return view('admin.print.salesreports', compact('salesReports'));
    }

    public function allsalesReports()
    {
        $all_salesReports = DB::table('sales_reports')
        ->get();

        return view('admin.print.salesreports', compact('all_salesReports'));
    }

    public function transactionReports($trx_id)
    {
        $transactionReports = DB::table('transactions')
        ->where('trx_id', '=', $trx_id)
        ->get();

        return view('admin.print.transactionreport', compact('transactionReports'));
    }

    public function alltransactionReports()
    {
        $all_transaction = DB::table('transactions')
        ->get();

        return view('admin.print.transactionreport', compact('all_transaction'));
    }

}

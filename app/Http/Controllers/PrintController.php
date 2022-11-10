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
        ->where('sup_uuid', '=', $cus_uuid)
        ->get();

        return view('admin.print.supplier', compact('supplier_details'));
    }

    
    public function productDetails($prd_id)
    {
        $product_details = DB::table('products')
        ->where('prd_id', '=', $sup_uuid)
        ->get();

        return view('admin.print.product', compact('product_details'));
    }

    public function allproductDetails()
    {
        $all_product_details = DB::table('products')
        ->get();

        return view('admin.print.product', compact('all_product_details'));
    }

}

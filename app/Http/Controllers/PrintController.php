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


}

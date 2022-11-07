<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class ProductController extends Controller
{
    //
    public function manage()
    {
        $products = DB::table('products')
        ->get();

        return view('admin.products.manage',compact('products'));
    }
    
    // public function saveuser(Request $request)
    // {
    //     $usr_full_name = $request->usr_fullname;
    //     $usr_name = $request->usr_name;
    //     $usr_password = $request->usr_password;

    //     $usr_id = DB::table('users')
    //     ->insert([
    //         'acc_id' => session('acc_id')
    //         'usr_full_name' => $usr_full_name
    //         'usr_name' => $usr_name
    //         'usr_password' => $usr_password

    //     ]);
    // }
}

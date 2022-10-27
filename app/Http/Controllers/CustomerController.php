<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CustomerController extends Controller
{
    
    public function manage()
    {
    
        $customers = DB::table('customers')
        ->where('acc_id', '=',session('acc_id'))
        ->get();

        return view('admin.customers.manage',compact('customers'));
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

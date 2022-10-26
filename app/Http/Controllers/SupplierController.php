<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    //
    public function manage()
    {
        // $modules = DB::table('modules')
        // ->where('mod_active','=','1')
        // ->orderBy('mod_name')
        // ->get();

        return view('admin.suppliers.manage');
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

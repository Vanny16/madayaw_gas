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
    
    public function createSupplier(Request $request)
    {
        $sup_name = $request->sup_name;
        $sup_contact = $request->sup_contact;
        $sup_address = $request->sup_address;

        $sup_id = DB::table('suppliers')
        ->insert([
            'acc_id' => session('acc_id'),
            'sup_name' => $sup_name,
            'sup_contact' => $sup_contact,
            'sup_address' => $sup_address

        ]);

        session()->flash('successMessage','New supplier has been added');
        return redirect()->action('SupplierController@manage');
    }
}

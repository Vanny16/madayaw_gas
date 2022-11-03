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
    
   public function createCustomer(Request $request)
    {
        $cus_name = $request->cus_name;
        $cus_address = $request->cus_address;
        $cus_contact = $request->cus_contact;
        $cus_notes = $request->cus_notes;

        $usr_id = DB::table('customers')
        ->insert([
            'acc_id' => session('acc_id'),
            'cus_name' => $cus_name, 
            'cus_address' => $cus_address,
            'cus_contact' => $cus_contact,
            'cus_notes' => $cus_notes

        ]);

        session()->flash('successMessage','New customer has been added');
        return redirect()->action('UserController@manage');
    } 
  
}

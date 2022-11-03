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

        $check_cus_name = DB::table('customers')
        ->where('cus_name','=', $cus_name)
        ->get();

        if($check_cus_name == null)
        {
            $usr_id = DB::table('customers')
            ->insert([
            'acc_id' => session('acc_id'),
            'cus_uuid' => generateuuid(),
            'cus_name' => $cus_name, 
            'cus_address' => $cus_address,
            'cus_contact' => $cus_contact,
            'cus_notes' => $cus_notes
            ]);

            session()->flash('successMessage','New customer has been added');
            return redirect()->action('CustomerController@manage');
        }
        else
        {
            session()->flash('errorMessage','Customer name is already existing');
            return redirect()->action('CustomerController@manage');
        }
    }
    
    public function editCustomer(Request $request)
    {

    }
    
    public function deactivateCustomer($cus_id)
    {
        DB::table('customers')
        ->where('cus_id', '=', $cus_id)
        ->update([
            'cus_active' => 0
        ]);

        session()->flash('successMessage','Customer has been deactivated.');
            return redirect()->action('CustomerController@manage');
    }

    public function reactivateCustomer($cus_id)
    {
        DB::table('customers')
        ->where('cus_id', '=', $cus_id)
        ->update([
            'cus_active' => 1
        ]);

        session()->flash('successMessage','Customer reactivated.');
            return redirect()->action('CustomerController@manage');
    }
}

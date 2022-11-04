<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use DB;

class SupplierController extends Controller
{
    //
    public function manage()
    {
        $suppliers = DB::table('suppliers')
        ->get();

        return view('admin.suppliers.manage',compact('suppliers'));
    }
    
    public function createSupplier(Request $request)
    {
        $sup_name = $request->sup_name;
        $sup_address = $request->sup_address;
        $sup_contact = $request->sup_contact;
        $sup_notes = $request->sup_notes;

        $check_sup_name = DB::table('suppliers')
        ->where('sup_name','=', $sup_name)
        ->first();

        if($check_sup_name != null)
        {
            session()->flash('errorMessage','Supplier already exist');
            return redirect()->action('SupplierController@manage');
        }
        else
        {
            $usr_id = DB::table('suppliers')
            ->insert([
            'sup_id' => session('sup_id'),
            'sup_uuid' => generateuuid(),
            'sup_name' => $sup_name, 
            'sup_address' => $sup_address,
            'sup_contact' => $sup_contact,
            'sup_notes' => $sup_notes
            ]);

            session()->flash('successMessage','Supplier has been added');
            return redirect()->action('SupplierController@manage');
        }
    }
    public function editSuppplier(Request $request, $sup_id)
    {
        $sup_name = $request->sup_name;
        $sup_address = $request->sup_address;
        $sup_contact = $request->sup_contact;
        $sup_notes = $request->sup_notes;

        $check_uuid = DB::table('suppliers')
        ->where('sup_id', '=', $sup_id)
        ->where('sup_uuid', '=', null)
        ->get();

        if($check_uuid != null)
        {
            DB::table('suppliers')
            ->where('sup_id', '=', $sup_id)
            ->update([
                'sup_uuid' => generateuuid()
            ]);
        }

        DB::table('suppliers')
        ->where('sup_id', '=', $sup_id)
        ->update([
            'sup_name' => $sup_name,
            'sup_address' => $sup_address,
            'sup_contact' => $sup_contact,
            'sup_notes' => $sup_notes
        ]);
        
        session()->flash('successMessage','Supplier details updated.');
        return redirect()->action('SupplierController@manage');
    }
    public function deactivateSupplier($sup_id)
    {
        DB::table('suppliers')
        ->where('sup_id', '=', $sup_id)
        ->update([
            'sup_active' => 0
        ]);

        session()->flash('successMessage','Supplier has been deactivated.');
            return redirect()->action('SupplierController@manage');
    }

    public function reactivateSupplier($sup_id)
    {
        DB::table('suppliers')
        ->where('sup_id', '=', $sup_id)
        ->update([
            'sup_active' => 1
        ]);

        session()->flash('successMessage','Supplier reactivated.');
            return redirect()->action('SupplierController@manage');
    }
}

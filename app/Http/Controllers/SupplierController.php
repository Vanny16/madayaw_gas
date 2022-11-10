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

        // dd($suppliers);
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
    
    public function editSupplier(Request $request, $sup_id)
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

    public function searchSupplier(Request $request)
    {
        $search_string = $request->search_string;
        $typ_id = $request->filter_type;

        $user_types = DB::table('user_types')
        ->get();

        $statuses = array(
            0 => 'Inactive',
            1 => 'Active',
            2 => 'All'
        );

        $default_status = $request->filter_status;
        $usr_active = array_search($request->filter_status, $statuses);

        $query = DB::table('suppliers')
        ->where('acc_id','=',session('acc_id'))
        ->where('sup_name','LIKE', $search_string . '%');

        if($typ_id != 0){
            $query = $query->where('typ_id', '=', $typ_id);
        }

        if($sup_active != 2){
            $query = $query->where('sup_active', '=', $sup_active);
        }

        $suppliers = $query->orderBy('sup_name')->get(); 
        
        return view('admin.supplier.manage',compact('suppliers','user_types','typ_id','statuses','default_status'));  
    }
}

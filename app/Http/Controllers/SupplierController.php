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

        $statuses = array(
            1 => 'All',
            2 => 'Active',
            3 => 'Inactive'
        );

        $default_status = '0';

        return view('admin.suppliers.manage',compact('suppliers', 'statuses','default_status'));
    }
    
    public function createSupplier(Request $request)
    {
        $sup_name = $request->sup_name;
        $sup_address = $request->sup_address;
        $sup_contact = $request->sup_contact;
        $sup_notes = $request->sup_notes;

        $check_sup_name = DB::table('suppliers')
        ->where('acc_id', '=', session('acc_id'))
        ->where('sup_name','=', $sup_name)
        ->first();

        if($check_sup_name != null)
        {
            session()->flash('errorMessage','Supplier already exist');
            return redirect()->action('SupplierController@manage');
        }
        else{
            $usr_id = DB::table('suppliers')
            ->insert([
            'sup_id' => session('sup_id'),
            'acc_id' => session('acc_id'),
            'sup_uuid' => generateuuid(),
            'sup_name' => $sup_name, 
            'sup_address' => $sup_address,
            'sup_contact' => $sup_contact,
            'sup_notes' => $sup_notes
            ]);
    
            session()->flash('successMessage','Supplier has been added');
        }

        return redirect()->action('SupplierController@manage');
    }
    
    public function editSupplier(Request $request, $sup_id)
    {
        $sup_name = $request->sup_name;
        $sup_address = $request->sup_address;
        $sup_contact = $request->sup_contact;
        $sup_notes = $request->sup_notes;
        $sup_uuid = $request->sup_uuid;

        // $check_uuid = DB::table('suppliers')
        // ->where('sup_id', '=', $sup_id)
        // ->where('sup_uuid', '=', null)
        // ->get();

        // if($check_uuid != null)
        // {
        //     DB::table('suppliers')
        //     ->where('sup_id', '=', $sup_id)
        //     ->update([
        //         'sup_uuid' => generateuuid()
        //     ]);
        // }

        $check_sup_name = DB::table('suppliers')
        ->where('acc_id', '=', session('acc_id'))
        ->where('sup_uuid', '<>', $sup_uuid)
        ->where('sup_name','=', $sup_name)
        ->first();

        if($check_sup_name != null)
        {
            session()->flash('errorMessage','Supplier already exist');
            return redirect()->action('SupplierController@manage');
        }

        DB::table('suppliers')
        ->where('sup_id', '=', $sup_id)
        ->update([
            'sup_name' => $sup_name,
            'sup_address' => $sup_address,
            'sup_contact' => $sup_contact,
            'sup_notes' => $sup_notes
        ]);

        //Image UPLOAD SECTION
        if($request->file('sup_image'))
        {
            $file = $request->file('sup_image');
            
            $validator = Validator::make( 
                [
                    'file' => $file,
                    'extension' => strtolower($file->getClientOriginalExtension()),
                ],
                [
                    'file' => 'required',
                    'file' => 'max:3072', //3MB
                    'extension' => 'required|in:jpg,png,gif',
                ]
            );
            
            // dd(public_path());

            if ($validator->fails()) {
                session()->flash('errorMessage',  "Invalid File Extension or maximum size limit of 5MB reached!");
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $fileName = $request->sup_id . '.' . $file->getClientOriginalExtension();

            // dd(fopen($file,'r+'));

            Storage::disk('local')->put('img/users/' . $fileName, fopen($file, 'r+'));

            DB::table('suppliers')
            ->where('sup_id','=',$sup_id)
            ->update([
                'sup_image' => $fileName,
            ]);  
        
            session()->flash('successMessage','Supplier details updated.');
            return redirect()->action('SupplierController@manage');
        }
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

        $statuses = array(
            0 => 'Inactive',
            1 => 'Active',
            2 => 'All'
        );

        $default_status = $request->filter_status;
        $sup_active = array_search($request->filter_status, $statuses);

        $query = DB::table('suppliers')
        ->where('acc_id','=',session('acc_id'))
        ->where('sup_name','LIKE', $search_string . '%');

        if($sup_active != 2){
            $query = $query->where('sup_active', '=', $sup_active);
        }

        $suppliers = $query->orderBy('sup_name')->get(); 

        return view('admin.suppliers.manage', compact('suppliers', 'statuses', 'default_status'));
    }
}

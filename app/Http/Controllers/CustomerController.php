<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use DB;

class CustomerController extends Controller
{
    
    public function manage()
    {
        $statuses = array(
            1 => 'All',
            2 => 'Active',
            3 => 'Inactive'
        );

        $default_status = '0';

        $customers = DB::table('customers')
        ->where('acc_id', '=',session('acc_id'))
        ->where('cus_id','<>', 0)
        ->where('cus_id','<>', -1)
        ->get();

        $cus_id = DB::table('customers')
        ->select('cus_id')
        ->orderBy('cus_id', 'desc')
        ->first();

        $products = DB::table('products')
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->get();

        $selected_products = DB::table('products')
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->get();

        // dd($products);

        return view('admin.customers.manage',compact('customers','statuses','default_status','products','selected_products'));
    }
    
    public function createCustomer(Request $request)
    {
        $cus_name = $request->cus_name;
        $cus_address = $request->cus_address;
        $cus_contact = $request->cus_contact;
        $cus_notes = $request->cus_notes;
        $cus_accessibles = $request->cus_accessible;

        $accessibles = "";
        foreach($cus_accessibles as $cus_access)
        {
            $accessibles = $accessibles . $cus_access . ",";
        }

        // dd($accessibles);

        $check_cus_name = DB::table('customers')
        ->where('acc_id', '=', session('acc_id'))
        ->where('cus_name','=', $cus_name)
        ->first();

        if($check_cus_name != null)
        {
            session()->flash('errorMessage','Customer name is already existing');
            return redirect()->action('CustomerController@manage');
        }

        $usr_id = DB::table('customers')
        ->insert([
        'acc_id' => session('acc_id'),
        'cus_uuid' => generateuuid(),
        'cus_name' => $cus_name, 
        'cus_address' => $cus_address,
        'cus_contact' => $cus_contact,
        'cus_accessibles' => $accessibles,
        'cus_notes' => $cus_notes
        ]);

        //IMAGE UPLOAD 
        if($request->file('cus_image'))
        {
            $cus_id = DB::table('customers')
            ->select('cus_id')
            ->orderBy('cus_id', 'desc')
            ->first();
    
            $file = $request->file('cus_image');

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
    
            if ($validator->fails()) 
            {
                session()->flash('errorMessage',  "Invalid File Extension or maximum size limit of 5MB reached!");
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            $fileName = $cus_id->cus_id . '.' . $file->getClientOriginalExtension();
    
            Storage::disk('local')->put('img/customers/' . $fileName, fopen($file, 'r+'));

            DB::table('customers')
            ->where('cus_id','=',$cus_id->cus_id)
            ->update([
                'cus_image' => $fileName,
            ]);  
    
        }   

        session()->flash('successMessage','New customer has been added');
        return redirect()->action('CustomerController@manage');
    }

    // public function canisterIn()
    // {
    //     $madayaw_canisters = array(
    //         1 => 'Botin',
    //         2 => 'Madayaw Square',
    //         3 => 'Madayaw Round'
    //     );

    //     $ops_id = DB::table('oppositions')
    //     -> where('ops_id', = , session('ops_id'))
    //     -> get(); 
        
    // }

    public function editCustomer(Request $request)
    {
        $cus_id = $request->cus_id;
        $cus_name = $request->cus_name;
        $cus_address = $request->cus_address;
        $cus_contact = $request->cus_contact;
        $cus_notes = $request->cus_notes;
        $cus_uuid = $request->cus_uuid;
        $cus_accessibles = $request->cus_accessible;

        $accessibles = "";
        foreach($cus_accessibles as $cus_access)
        {
            $accessibles = $accessibles . $cus_access . ",";
        }
        // dd($cus_accessible);
        // $check_uuid = DB::table('customers')
        // ->where('cus_id', '=', $cus_id)
        // ->where('cus_uuid', '=', null)
        // ->get();

        // if($check_uuid != null)
        // {
        //     DB::table('customers')
        //     ->where('cus_id', '=', $cus_id)
        //     ->update([
        //         'cus_uuid' => generateuuid()
        //     ]);
        // }

        $check_cus_name = DB::table('customers')
        ->where('acc_id', '=', session('acc_id'))
        ->where('cus_uuid', '<>', $cus_uuid)
        ->where('cus_name','=', $cus_name)
        ->first();

        if($check_cus_name != null)
        {
            session()->flash('errorMessage','Customer name is already existing');
            return redirect()->action('CustomerController@manage');
        }

        DB::table('customers')
        ->where('cus_id', '=', $cus_id)
        ->update([
            'cus_name' => $cus_name,
            'cus_address' => $cus_address,
            'cus_contact' => $cus_contact,
            'cus_accessibles' => $accessibles,
            'cus_notes' => $cus_notes
        ]);

        //IMAGE UPLOAD SECTION
        if($request->file('cus_image'))
        {
            $file = $request->file('cus_image');
            
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

            $fileName = $request->cus_id . '.' . $file->getClientOriginalExtension();

            // dd(fopen($file,'r+'));

            Storage::disk('local')->put('img/customers/' . $fileName, fopen($file, 'r+'));

            DB::table('customers')
            ->where('cus_id','=',$cus_id)
            ->update([
                'cus_image' => $fileName,
            ]);  

        }   
        session()->flash('successMessage','Customer details updated.');
        return redirect()->action('CustomerController@manage');
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
    
    public function searchCustomer(Request $request)
    {
        $search_string = $request->search_string;

        $statuses = array(
            0 => 'Inactive',
            1 => 'Active',
            2 => 'All'
        );

        $default_status = $request->filter_status;
        $cus_active = array_search($request->filter_status, $statuses);

        $query = DB::table('customers')
        ->where('acc_id','=',session('acc_id'))
        ->where('cus_name','LIKE', $search_string . '%');

        if($cus_active != 2){
            $query = $query->where('cus_active', '=', $cus_active);
        }

        $customers = $query->orderBy('cus_name')->get(); 

        return view('admin.customers.manage', compact('customers', 'statuses', 'default_status'));
    }

    public function changeProductPrice(Request $request)
    {
        $customers = $request->customers;
        $prd_id = $request->prd_id;
        $prd_price = $request->prd_price;
        $selected_customers = $request->selected_customers;
        dd($selected_customers);

        
    }

}

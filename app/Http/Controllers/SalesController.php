<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
Use DB;

class SalesController extends Controller
{
    //
    public function main()
    {
        $products = DB::table('products')
        ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        ->where('prd_for_POS', '=' ,'1')
        ->where('prd_quantity', '<>' ,'0.0')
        ->where('prd_active', '=' ,'1')
        ->get();
        // dd(compact('products'));

        $customers = DB::table('customers')
        ->where('acc_id', '=',session('acc_id'))
        ->where('cus_active', '=', '1')
        ->orderBy('cus_name')
        ->get();

        return view('admin.sales.main', compact('products', 'customers'));
    }

    public function report()
    {
        return view('admin.sales.report');
    }

    public function createCustomer(Request $request)
    {
        $cus_name = $request->cus_name;
        $cus_address = $request->cus_address;
        $cus_contact = $request->cus_contact;
        $cus_notes = $request->cus_notes;

        $check_cus_name = DB::table('customers')
        ->where('acc_id', '=', session('acc_id'))
        ->where('cus_name','=', $cus_name)
        ->first();

        if($check_cus_name != null)
        {
            session()->flash('errorMessage','Customer name is already existing');
            return redirect()->action('SalesController@main');
        }

        $usr_id = DB::table('customers')
        ->insert([
        'acc_id' => session('acc_id'),
        'cus_uuid' => generateuuid(),
        'cus_name' => $cus_name, 
        'cus_address' => $cus_address,
        'cus_contact' => $cus_contact,
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
        session(['new_client' => $request->cus_name]);
        session()->flash('successMessage','New customer has been added');
        return redirect()->action('SalesController@main');
    }
    
    public function paymentSales(Request $request)
    {
        $cus_id = $request->client_id;
        $prd_id = $request->prd_id;
        $sls_quantity = $request->client_id;
        $sls_discount = $request->sls_discount;
        $sls_sub_total = $request->sls_sub_total;
        $list = $request->input('receipt_list');
        // dd(getType($test));
        // $testt = getType($test[0]);
        $tmpArray = array();
        // foreach ($test as $sub)
        // {
        //     // dd(getType($test));
        //     $tmpArray[] = implode(',', $test);
        // }

        for($count = 0 ; $count < count($list) ; $count++)
        {
            $tmpArray[] = explode(',', $list[$count]);

            DB::table('sales_reports')
            ->insert([
                'cus_id' => $tmpArray[$count][0],
                'prd_id' => $tmpArray[$count][1],
                'sls_quantity' => $tmpArray[$count][4],
                'sls_discount' => $tmpArray[$count][5],
                'sls_sub_total' => $tmpArray[$count][6],
                'pdn_id' => get_last_production_id()
            ]);
        }
        dd($cus_id, $prd_id, $sls_quantity, $sls_discount, $sls_sub_total, $tmpArray);

        session()->flash('successMessage','New customer has been added'+$testt);
    }
}

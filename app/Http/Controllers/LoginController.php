<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class LoginController extends Controller
{
    public function login()
    {
        if(session('usr_id') != null){
            return redirect()->action('MainController@home');
        }
        else{
            return view('login.main');
        }
    }

    public function validateUser(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $users = DB::table('users')
        ->join('accounts','accounts.acc_id','=','users.acc_id')
        ->join('user_types','user_types.typ_id','=','users.typ_id')
        ->where('usr_name','=',$username)
        ->where('usr_password','=',md5($password))// COMMENTED FOR TESTING
        ->first();

        if($users)
        {
            if($users->usr_active == '1')
            {
                if($users->acc_active == '1')
                {

                    session(['usr_id' => $users->usr_id]);
                    session(['acc_id' => $users->acc_id]);
                    session(['usr_uuid' => $users->usr_uuid]);
                    session(['usr_full_name' => $users->usr_full_name]);
                    session(['usr_name' => $users->usr_name]);
                    session(['usr_address' => $users->usr_address]);
                    session(['usr_image' => $users->usr_image]);
                    session(['typ_id' => $users->typ_id]);
                    session(['typ_name' => $users->typ_name]);

                    return redirect()->action('MainController@home');
                }
                else
                {
                    session()->flash('errorMessage', 'User account is inactive. Please contact your HR.');
                    return redirect()->action('LoginController@login');
                }
            }
            else
            {
                session()->flash('errorMessage', 'Employee is inactive. Please contact your HR.');
                return redirect()->action('LoginController@login');
            }
        }
        else
        {
            session()->flash('errorMessage', 'Invalid username or password');
            return redirect()->action('LoginController@login');
        }       
    }

    public function confirmVoid(Request $request){
        $usr_password = $request->usr_password;
        $trx_id = $request->trx_id;

        $users = DB::table('users')
        ->join('accounts','accounts.acc_id','=','users.acc_id')
        ->join('user_types','user_types.typ_id','=','users.typ_id')
        ->where('usr_name','=', session('usr_name'))
        ->where('usr_password','=',md5($usr_password))// COMMENTED FOR TESTING
        ->first();
        
        $transactions = DB::table('transactions')
        ->leftJoin('users', 'users.usr_id', '=', 'transactions.usr_id')
        ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
        ->where('trx_id','=', $trx_id)
        ->get();

        $purchases = DB::table('purchases')
        ->join('products', 'products.prd_id', '=', 'purchases.prd_id')   
        ->where('trx_id','=', $trx_id)
        ->get();
    
        if($users)
        {
            foreach($purchases as $purchase){

                if($purchase->can_type_in != 2){
                    $prd_in = DB::table('products')
                    ->where('prd_id','=', $purchase->prd_id_in)
                    ->first();

                    if($prd_in != null){
                        $prd_empty_goods = $prd_in->prd_empty_goods;
                    }
                    else{
                        $prd_empty_goods = 0;
                    }

                }
                else{
                    $prd_in = DB::table('oppositions')
                    ->where('ops_id','=', $purchase->prd_id_in)
                    ->first();

                    $prd_empty_goods = $prd_in->ops_quantity;
                }
                
                $prd_out = DB::table('products')
                ->where('prd_id','=', $purchase->prd_id)
                ->first();

                $prd_quantity = $prd_out->prd_quantity;
                

                //CALCULATION FOR VOID
                $new_empty_goods_qty = $prd_empty_goods - (($purchase->pur_crate_in * 12) + $purchase->pur_loose_in);
                $new_prd_qty = $prd_quantity + $purchase->pur_qty;
                
                if($purchase->can_type_in != 2){

                    //For Returning The Empty Canisters back to the Customer
                    if($prd_in != null){
                        DB::table('products') 
                        ->where('prd_id','=',$purchase->prd_id_in)
                        ->update([
                            'prd_empty_goods' => $new_empty_goods_qty
                        ]);
                    }
                }
                else{
                    //For Returning The Empty Canisters back to the Customer From Oppositions
                    DB::table('oppositions') 
                    ->where('ops_id','=',$purchase->prd_id_in)
                    ->update([
                        'ops_quantity' => $new_empty_goods_qty
                    ]);
                }

                //For Returning The Items back to the Inventory
                DB::table('products') 
                ->where('prd_id','=',$purchase->prd_id)
                ->update([
                    'prd_quantity' => $new_prd_qty
                ]);

            }

            DB::table('transactions') 
            ->where('trx_id','=',$trx_id)
            ->update([
                'trx_active' => '0'
            ]);

            session()->flash('warningMessage', 'Transaction has been void');
            return redirect()->action('ReportsController@transactionsToday');
        }
        else
        {
            session()->flash('errorMessage', 'Invalid password');
            return redirect()->action('ReportsController@transactionsToday');
        }       
    }

    public function logout()
    {
        Session::flush();
        return redirect()->action('LoginController@login');
    }

}

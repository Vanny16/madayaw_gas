<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function user()
    {
        return view('admin.user.manage');
    }

    public function searchUser(Request $request)
    {
        $search_string = $request->search_string;

       
        $users = DB::table('users')
        ->where('usr_full_name','LIKE', $search_string . '%')
        ->where('acc_id','=',session('acc_id'))
        ->orderBy('usr_full_name')
        ->get();

        session()->flash('errorMessage','test');
        return redirect()->action('UserController@User',compact('users','search_string'));
        
    }

    public function createUser(Request $request)
    {
        $usr_full_name = $request->usr_full_name;
        $usr_address = $request->usr_address;
        $usr_name = $request->usr_name;
        $usr_password = $request->usr_password;

        $check_usr_name = DB::table('users')
        ->where('usr_name','=', $usr_name)
        ->get();

        if($check_usr_name != null)
        {
            DB::table('users')
            ->insert([
                'acc_id' => session('acc_id'),
                'usr_full_name' => $usr_full_name,
                'usr_name' => $usr_name,
                'usr_password' => $usr_password,
                'usr_address' => $usr_address
            ]);

            session()->flash('successMessage','New user has been added');
            return redirect()->action('UserController@user');
        }
        else
        {
            session()->flash('errorMessage','Username already taken');
            return redirect()->action('UserController@user');
        }
        //test
    }
}

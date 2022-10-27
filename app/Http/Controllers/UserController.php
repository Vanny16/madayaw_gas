<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function user()
    {
        $users = DB::table('users')
        ->where('acc_id', '=',session('acc_id'))
        ->get();

        // dd(session('usr_id'));
        return view('admin.user.manage',compact('users'));
    }

    public function searchUser(Request $request)
    {
        $users = DB::table('users')
        ->where('usr_full_name','LIKE', $search_string . '%')
        ->where('acc_id','=',session('acc_id'))
        ->orderBy('usr_full_name')
        ->get();


        return redirect()->action('UserController@User',compact('users'));  
    }

    public function createUser(Request $request)
    {
        $usr_full_name = $request->usr_full_name;
        $usr_address = $request->usr_address;
        $usr_name = $request->usr_name;
        $usr_password = $request->usr_password;
        $usr_type = $request->usr_type;

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
                'usr_address' => $usr_address,
                'usr_type' => $usr_type
            ]);

            session()->flash('successMessage','New user has been added');
            return redirect()->action('UserController@user');
        }
        else
        {
            session()->flash('errorMessage','Username already taken');
            return redirect()->action('UserController@user');
        }
    }

    public function editUser(Request $request, $usr_id)
    {
        $usr_type = (int)$request->usr_type;
        $usr_password = $request->usr_password;

        if($usr_password == null)
        {
        DB::table('users')
        ->where('usr_id', '=', $usr_id)
        ->update([
            'usr_type' => $usr_type
        ]);
        }
        else
        {
        DB::table('users')
        ->where('usr_id', '=', $usr_id)
        ->update([
            'usr_type' => $usr_type,
            'usr_password' => $usr_password
        ]);
        }
        
        // dd($request);
        session()->flash('successMessage','User details updated');
        return redirect()->action('UserController@user');
    }

    public function deactivateUser($usr_id)
    {
        DB::table('users')
        ->where('usr_id', '=', $usr_id)
        ->update([
            'usr_active' => 0
        ]);

        session()->flash('successMessage','User deleted');
            return redirect()->action('UserController@user');
    }

    public function reactivateUser($usr_id)
    {
        DB::table('users')
        ->where('usr_id', '=', $usr_id)
        ->update([
            'usr_active' => 1
        ]);

        session()->flash('successMessage','User reactivated');
            return redirect()->action('UserController@user');
    }
}

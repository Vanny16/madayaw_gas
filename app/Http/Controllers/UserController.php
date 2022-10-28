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
        ->join('user_types', 'user_types.typ_id', '=', 'users.typ_id')
        ->where('acc_id', '=',session('acc_id'))
        ->where('usr_active', '=', '1')
        ->get();

        $user_types = DB::table('user_types')
        ->get();

        return view('admin.user.manage',compact('users','user_types'));
    }

    public function searchUser(Request $request)
    {
        $search_string = $request->search_string;
        $typ_id = $request->filter_type;
        $usr_active = $request->filter_status;

        if($typ_id == 0)
        {
            $users = DB::table('users')     
            ->where('usr_active', '=', $usr_active)
            ->where('acc_id','=',session('acc_id'))
            ->orderBy('usr_full_name')
            ->get();
        }
        else
        {
            $users = DB::table('users')
            ->where('typ_id', '=', $typ_id)
            ->where('usr_active', '=', $usr_active)
            ->where('acc_id','=',session('acc_id'))
            ->orderBy('usr_full_name')
            ->get();
        }
        

        $user_types = DB::table('user_types')
        ->get();

        return view('admin.user.manage',compact('users','user_types'));  
    }

    public function createUser(Request $request)
    {
        $usr_full_name = $request->usr_full_name;
        $usr_address = $request->usr_address;
        $usr_name = $request->usr_name;
        $usr_password = $request->usr_password;
        $typ_id = $request->typ_id;

        $check_usr_name = DB::table('users')
        ->where('usr_name','=', $usr_name)
        ->first();

        if($check_usr_name == null)
        {
            DB::table('users')
            ->insert([
                'acc_id' => session('acc_id'),
                'usr_full_name' => $usr_full_name,
                'usr_name' => $usr_name,
                'usr_password' => $usr_password,
                'usr_address' => $usr_address,
                'typ_id' => $typ_id
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
        $typ_id = (int)$request->typ_id;
        $usr_password = $request->usr_password;

        if($usr_password == null)
        {
        DB::table('users')
        ->where('usr_id', '=', $usr_id)
        ->update([
            'typ_id' => $typ_id
        ]);
        }
        else
        {
        DB::table('users')
        ->where('usr_id', '=', $usr_id)
        ->update([
            'typ_id' => $typ_id,
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

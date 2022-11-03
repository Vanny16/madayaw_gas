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

        $typ_id = '0';

        $statuses = array(
            1 => 'All',
            2 => 'Active',
            3 => 'Inactive'
        );

        $default_status = '0';
         
        return view('admin.user.manage',compact('users','user_types','typ_id','statuses','default_status'));
    }

    public function searchUser(Request $request)
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

        session(['search_typ_id' => $users->usr_id]);
        session(['usr_id' => $users->usr_id]);

        $default_status = $request->filter_status;
        $usr_active = array_search($request->filter_status, $statuses);

        if($typ_id == 0)
        {
            if($usr_active == 2)
            {
                $users = DB::table('users')     
                ->where('acc_id','=',session('acc_id'))
                ->orderBy('usr_full_name')
                ->get();
            }
            else
            {
                $users = DB::table('users')     
                ->where('usr_active', '=', $usr_active)
                ->where('acc_id','=',session('acc_id'))
                ->orderBy('usr_full_name')
                ->get();
            }
        }
        else
        {
            if($usr_active == 2)
            {
                $users = DB::table('users')
                ->where('typ_id', '=', $typ_id)
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
        }
             
        
        return view('admin.user.manage',compact('users','user_types','typ_id','statuses','default_status'));  
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
                'usr_uuid' => generateuuid(),
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
        $usr_full_name = $request->usr_full_name;
        $typ_id = (int)$request->typ_id;
        $usr_password = $request->usr_password;

        if($usr_password == null)
        {
        DB::table('users')
        ->where('usr_id', '=', $usr_id)
        ->update([
            'usr_full_name' => $usr_full_name,
            'usr_address' => $usr_address,
            'typ_id' => $typ_id
        ]);
        }
        else
        {
        DB::table('users')
        ->where('usr_id', '=', $usr_id)
        ->update([
            'usr_full_name' => $usr_full_name,
            'usr_address' => $usr_address,
            'typ_id' => $typ_id,
            'usr_password' => $usr_password
        ]);
        }
        
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

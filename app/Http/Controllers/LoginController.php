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
        ->where('usr_password','=',$password)
        //->where('password','=',md5($password)) COMMENTED FOR TESTING
        ->first();

        if($users == null)
        {
            $users = DB::table('users')
            ->join('accounts','accounts.acc_id','=','users.acc_id')
            ->join('user_types','user_types.typ_id','=','users.typ_id')
            ->where('usr_name','=',$username)
            ->where('usr_password','=',md5($password))
            ->first();
        }

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

    public function logout()
    {
        Session::flush();
        return redirect()->action('LoginController@login');
    }

}

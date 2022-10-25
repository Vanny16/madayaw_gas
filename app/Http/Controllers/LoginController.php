<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class LoginController extends Controller
{
    public function login()
    {
        return view('login.main');
    }

    public function validateUser(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $users = DB::table('users')
        ->join('accounts','accounts.acc_id','=','users.acc_id')
        ->where('usr_name','=',$username)
        ->where('usr_password','=',$password)
        //->where('password','=',md5($password)) COMMENTED FOR TESTING
        ->first();

        if($users)
        {
            if($users->usr_active == '1')
            {
                if($users->acc_active == '1')
                {

                    session(['usr_id' => $users->usr_id]);
                    session(['acc_id' => $users->acc_id]);
                    session(['usr_full_name' => $users->usr_full_name]);
                    session(['usr_name' => $users->usr_name]);
                    session(['usr_address' => $users->usr_address]);
                    session(['usr_image' => $users->usr_image]);
                    session(['usr_type' => $users->usr_type]);

                    return redirect()->action('MainController@home');
                }
                else
                {
                    session()->flash('errorMessage', 'Organization account is inactive. Please contact your HR.');
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

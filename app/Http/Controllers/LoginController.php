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
        // $username = $request->username;
        // $password = $request->password;

        // $admin = DB::table('tbl_admin')
        // ->where('username','=',$username)
        // ->where('password','=',$password)
        // ->first();

        // if($admin){
        //     $request->session()->put('admin_session', '1');
        //     return redirect()->action('AdminController@admin');
        // }else{
        //     $request->session()->flash('error_login', 'Wrong username or password');
        //     return redirect()->action('AdminController@admin');
        // }
        return redirect()->action('MainController@home');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->action('LoginController@login');
    }

}

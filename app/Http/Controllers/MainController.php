<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class MainController extends Controller
{
    public function home()
    {
        if(session('typ_id') == null){
            return redirect()->action('LoginController@login');
        }
        else{
            return view('admin.main'); 
        }
    }
}
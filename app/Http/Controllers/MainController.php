<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class LoginController extends Controller
{
    public function home()
    {
        return view('login.main'); 
    }

}

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

}

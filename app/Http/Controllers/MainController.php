<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class MainController extends Controller
{
    public function home()
    {
        return view('admin.main'); 
    }

}

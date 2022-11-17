<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
Use DB;

class SalesController extends Controller
{
    //
    public function main()
    {
        return view('admin.sales.main');
    }
    
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user()
    {
        return view('admin.user.manage');
    }

    public function searchUser(Request $request)
    {
        $search_string = $request->search_string;
        session()->flash('success','test');
        // $users = DB::table('users')
        // ->where('usr_full_name','LIKE', $search_string . '%')
        // ->where('acc_id','=',session('acc_id'))
        // ->orderBy('usr_full_name')
        // ->get();

        return view('admin.employees.manage',compact('employees','search_string','modules'));

    }
}

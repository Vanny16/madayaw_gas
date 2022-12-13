<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class MainController extends Controller
{
    public function home()
    {
        $pdn_flag = check_production_log();

        if(session('typ_id') == null){
            return redirect()->action('LoginController@login');
        }
        else{
            return view('admin.main', compact('pdn_flag')); 
        }
    }
    
    //PRODUCTION
    public function toggleProduction()
    {
        $pdn_flag = check_production_log();
        
        if($pdn_flag)
        {
            DB::table('production_logs')
            ->insert([
                'pdn_datetime' => DB::raw('CURRENT_TIMESTAMP'),
                'pdn_action' => 1
            ]);

            session()->flash('successMessage','Production started!');
            return redirect()->action('MainController@home');
        }
        else
        {
            DB::table('production_logs')
            ->insert([
                'pdn_datetime' => DB::raw('CURRENT_TIMESTAMP'),
                'pdn_action' => 0 
            ]);

            session()->flash('successMessage','Production ended!');
            return redirect()->action('MainController@home');
        }
    }
}
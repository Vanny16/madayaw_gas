<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opposition extends Model
{
    protected $guarded = [];
    
    public static function POSIndex(){
        return self::select('ops_id', 'ops_name')
                    ->where('ops_name', 'NOT LIKE', '%EMPTY%')
                    ->where('acc_id', '=', session('acc_id'))
                    ->where('ops_active','=','1')
                    ->get();
    }

    public static function index(){
        return self::query()//select('ops_id', 'ops_name')
                    ->where('ops_name', 'NOT LIKE', '%EMPTY%')
                    ->where('acc_id', '=', session('acc_id'))
                    ->get();
    }
}

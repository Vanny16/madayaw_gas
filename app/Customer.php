<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

    public static function POSIndex(){
        return self::select('cus_id','cus_name')
                    ->where('acc_id', '=',session('acc_id'))
                    ->where('cus_active', '=', '1')
                    ->orderBy('cus_name', 'ASC')
                    ->get();
    }

    public static function POSSelectCustomer($id){
        return self::select('cus_id','cus_name','cus_accessibles','cus_price_change')
                    ->where('cus_name', '=', $id)
                    ->where('acc_id', '=',session('acc_id'))
                    ->where('cus_active', '=', '1')
                    ->first();
    }
}

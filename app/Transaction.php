<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Customer;
use App\Purchase;

class Transaction extends Model
{
    protected $guarded = [];

    public function customer(): HasOne{
        return $this->hasOne(Customer::class, 'cus_id', 'cus_id');
    }
    public function purchase(): HasMany{
        return $this->hasMany(Purchase::class, 'pur_id' , 'pur_id');
    }

    public static function POSIndex(){
        return self::select('trx_ref_id')
                    ->where('transactions.acc_id', '=', session('acc_id'))
                    ->where('trx_active','=','1')
                    ->get();
    }


}

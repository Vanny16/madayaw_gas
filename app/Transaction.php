<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Purchase;

class Transaction extends Model
{
    protected $guarded = [];

    public function transaction(){
        return $this->hasMany(Purchase::class);
    }
    public static function POSIndex(){
        return self::select('trx_ref_id')
                    ->where('transactions.acc_id', '=', session('acc_id'))
                    ->where('trx_active','=','1')
                    ->get();
    }


}

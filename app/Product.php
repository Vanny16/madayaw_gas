<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Purchase;

class Product extends Model
{
    protected $guarded = [];

    public function purchase(): BelongsTo{
        return $this->belongsTo(Purchase::class, 'pur_id', 'pur_id');
    }
    public static function POSIndex(){
        return self::select('prd_id','acc_id','prd_uuid','prd_name','prd_price','prd_deposit','prd_quantity','prd_image','prd_is_refillable')
                    ->where('prd_for_POS', 1)
                    ->where('prd_quantity', '>' ,'0.0')
                    ->where('prd_active', '=' ,'1')
                    ->get();
    }
}

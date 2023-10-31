<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Transaction;

class Purchase extends Model
{
    protected $guarded = [];

    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'prd_id', 'prd_id');
    }

    public function transaction(): BelongsTo{
        return $this->belongsTo(Transaction::class, 'trx_id', 'trx_id');
    }

    public static function POSIndex(){
        return self::select('prd_id','acc_id','prd_uuid','prd_name','prd_price','prd_deposit','prd_quantity','prd_image','prd_is_refillable')
                    ->where('prd_for_POS', 1)
                    ->where('prd_quantity', '>' ,'0.0')
                    ->where('prd_active', '=' ,'1')
                    ->get();
    }
}

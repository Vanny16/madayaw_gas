<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EodReport extends Model
{
    //
    protected $guarded = [];
    protected $table = 'eod_reports';

    public static function retrieve($reference_ids_array, $production_id = null){
        $values = [];

        foreach($reference_ids_array as $reference_id){
            $query = self::whereIn('ref_id', $reference_id);

            if($production_id != null)
            {
                $query = $query->where('pdn_id' ,'=', $production_id);
            }

            array_push($values, $query->get());
        }
        
        return $values;
    }
    

}

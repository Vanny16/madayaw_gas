<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EodReport extends Model
{
    //
    protected $guarded = [];
    protected $table = 'eod_reports';

    public static function purchasesReports(){
        
    }
    public static function issuedReports(){
        
    }
    public static function receivedReports(){
        
    }
    public static function oppositionReports(){
        
    }
}

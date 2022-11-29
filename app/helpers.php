<?php

function generateuuid()
{ 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = '';

    for ($i = 0; $i < 32; $i++) {
        $string .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    return $string;
}

function record_stockin($prd_id, $quantity)
{
    DB::table('quantity_logs')  
    ->insert([ 
        'acc_id' => session('acc_id'),
        'prd_id' => $prd_id,
        'usr_id' => session('usr_id'),
        'log_quantity' => $quantity,
        'log_datetime' => DB::raw('CURRENT_TIMESTAMP') 
        
    ]); 
}

function check_materials($flag)
{
    $raw_materials = DB::table('products')
    ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
    ->where('products.acc_id', '=', session('acc_id'))
    ->where('prd_for_production','=','1')
    ->where('prd_is_refillable','=','0')
    ->get();
    // dd($raw_materials);

    if($flag == 0)
    {

    }
    elseif($flag == 1)
    foreach ($raw_materials as $raw_material){

        if($raw_material->prd_quantity != 0){
            return true;
        }
        else
        {
            return false;
        }
    }
}
?>
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

function flash_message()
{
    session()->flash('successMessage','test successful');
}
?>
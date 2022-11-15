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
    DB::table('stockin_logs')  
    ->insert([ 
        'acc_id' => session('acc_id'),
        'log_date' => DB::raw('CURRENT_TIMESTAMP'), 
        'prd_id' => $prd_id,
        'log_quantity' => $quantity
    ]); 
}

function flash_message()
{
    session()->flash('successMessage','test successful');
}
?>
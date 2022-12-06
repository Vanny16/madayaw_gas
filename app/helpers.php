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

function check_materials($flag, $qty, $prd_id)
{
   //FOR EMPTYGOODS
    if($flag == 1)
    {
        $raw_materials = DB::table('products')
        ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','0')
        ->where('prd_active','<>','0')    
        ->get();
    
        foreach ($raw_materials as $raw_material)
        {
            if((float)$raw_material->prd_quantity >= $qty)
            {
                continue;
            }
            else
            {
                return false;
            }
        }
        return true;
    }
    //FOR FILLING CANISTERS
    elseif($flag == 2)
    {
        $empty_goods = DB::table('products')
        ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_id','=',$prd_id)
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->get();

        foreach ($empty_goods as $empty_good)
        {
            if((float)$empty_good->prd_empty_goods >= $qty)
            {
                continue;
            }
            else
            {
                return false;
            }
        }
        return true;
    }
    //FOR REVALVING OR SCRAPPING LEAKERS 
    elseif($flag == 4 || $flag == 5)
    {
        $leakers = DB::table('products')
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_id','=',$prd_id)
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->get();

        foreach ($leakers as $leaker)
        {
            if((float)$leaker->prd_leakers >= $qty)
            {
                continue;
            }
            else
            {
                return false;
            }
        }
        return true;
    }
}

function subtract_qty($flag, $qty, $prd_id)
{
    //SUBTRACT RAW MATERIALS FOR EMPTY GOODS
    if($flag == 1)
    {
        $raw_materials = DB::table('products')
        ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','0')
        ->where('prd_active','<>','0')
        ->get();

        for($x = 0 ; sizeOf($raw_materials) - 1 >= $x ; $x++)
        {
            DB::table('products')        
            ->where('prd_id', '=', $raw_materials[$x]->prd_id)
            ->where('acc_id', '=', session('acc_id'))
            ->where('prd_for_production','=','1')
            ->where('prd_is_refillable','=','0')
            ->update([
                'prd_quantity' => $raw_materials[$x]->prd_quantity - $qty 
            ]);

        }
    }
    //SUBTRACT EMPTY GOODS FOR FILLED CANISTERS
    elseif($flag == 2)
    {
        $canister = DB::table('products')
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_id', '=', $prd_id)
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->first();

        // dd($canister, $canister->prd_empty_goods - $qty );

        DB::table('products')        
        ->where('prd_id', '=', $canister->prd_id)
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->update([
            'prd_empty_goods' => $canister->prd_empty_goods - $qty 
        ]);
    }
    //SUBTRACT LEAKERS FOR REVALVING
    elseif($flag == 4)
    {
        $revalves = DB::table('products')
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_id', '=', $prd_id)
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->first();

        // dd($canister, $canister->prd_empty_goods - $qty );

        DB::table('products')        
        ->where('prd_id', '=', $canister->prd_id)
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->update([
            'prd_leakers' => $revalves->prd_leakers - $qty 
        ]);
    }
    //SUBTRACT LEAKERS FOR SCRAP
    elseif($flag == 5)
    {
        $scraps = DB::table('products')
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_id', '=', $prd_id)
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->first();

        DB::table('products')        
        ->where('prd_id', '=', $scraps->prd_id)
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->update([
            'prd_scraps' => $scraps->prd_leakers - $qty 
        ]);
    }
}
?>
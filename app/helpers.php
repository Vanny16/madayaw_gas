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

function check_production_log()
{
    $production_logs = DB::table('production_logs')
    ->orderBy('pdn_id', 'desc')
    ->first();
    
    if(isset($production_logs))
    {
        if($production_logs->pdn_end_time <> null)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        return true;
    }
}

function get_quantity($flag, $prd_id)
{
    $production_logs = DB::table('production_logs')
    ->orderBy('pdn_id', 'desc')
    ->first();

    //FLAGS
    // 1 = quantity
    // 2 = leakers
    // 3 = emptygoods
    // 4 = for revalving
    // 5 = scrap

    if($production_logs->pdn_end_time <> null)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function date_span_checker()
{ 
    $production_times = DB::table('production_logs')
    ->orderBy('pdn_id', 'desc')
    ->get();


}

function record_stockin($prd_id, $quantity)
{
    //FLAGS
    // 1 = quantity
    // 2 = leakers
    // 3 = emptygoods
    // 4 = for revalving
    // 5 = scrap

    DB::table('quantity_logs')  
    ->insert([ 
        'acc_id' => session('acc_id'),
        'prd_id' => $prd_id,
        'usr_id' => session('usr_id'),
        'log_quantity' => $quantity,
        'log_datetime' => DB::raw('CURRENT_TIMESTAMP') ,
        'pdn_id' => get_last_production_id()
    ]); 
}

function record_movement($prd_id, $quantity, $flag)
{
    //FLAGS
    // 1 = empty goods
    // 2 = filled
    // 3 = leakers
    // 4 = for revalving
    // 5 = scrap

    $get_pdn_id = DB::table('production_logs')
    ->orderBy('pdn_id', 'desc')
    ->first();

    // dd($get_pdn_id);
    if(isset($get_pdn_id))
    {
        if($flag == 1)
        {
            DB::table('movement_logs')  
            ->insert([ 
                'acc_id' => session('acc_id'),
                'prd_id' => $prd_id,
                'log_empty_goods' => $quantity,
                'log_date' => DB::raw('CURRENT_TIMESTAMP'),
                'usr_id' => session('usr_id'),
                'pdn_id' => $get_pdn_id->pdn_id
            ]);  
        }
        elseif($flag == 2)
        {
            DB::table('movement_logs')  
            ->insert([ 
                'acc_id' => session('acc_id'),
                'prd_id' => $prd_id,
                'log_filled' => $quantity,
                'log_date' => DB::raw('CURRENT_TIMESTAMP'),
                'usr_id' => session('usr_id'),
                'pdn_id' => $get_pdn_id->pdn_id
            ]); 
        }
        elseif($flag == 3)
        {
            DB::table('movement_logs')  
            ->insert([ 
                'acc_id' => session('acc_id'),
                'prd_id' => $prd_id,
                'log_leakers' => $quantity,
                'log_date' => DB::raw('CURRENT_TIMESTAMP'),
                'usr_id' => session('usr_id'),
                'pdn_id' => $get_pdn_id->pdn_id
            ]); 
        }
        elseif($flag == 4)
        {
            DB::table('movement_logs')  
            ->insert([ 
                'acc_id' => session('acc_id'),
                'prd_id' => $prd_id,
                'log_for_revalving' => $quantity,
                'log_date' => DB::raw('CURRENT_TIMESTAMP'),
                'usr_id' => session('usr_id'),
                'pdn_id' => $get_pdn_id->pdn_id
            ]); 
        }
        elseif($flag == 5)
        {
            DB::table('movement_logs')  
            ->insert([ 
                'acc_id' => session('acc_id'),
                'prd_id' => $prd_id,
                'log_scraps' => $quantity,
                'log_date' => DB::raw('CURRENT_TIMESTAMP'),
                'usr_id' => session('usr_id'),
                'pdn_id' => $get_pdn_id->pdn_id
            ]); 
        }
    }
    else
    {

    }

}

function get_opening_stock($prd_id, $pdn_id)
{
    $opening_stock = DB::table('stocks_logs')
    ->where('prd_id', '=', $prd_id)
    ->where('pdn_id', '=', $pdn_id)
    ->first();

    return $opening_stock->opening_stocks;
}

function get_closing_stock($prd_id, $pdn_id)
{
    $closing_stocks = DB::table('stocks_logs')
    ->where('prd_id', '=', $prd_id)
    ->where('pdn_id', '=', $pdn_id)
    ->first();
    
    return $closing_stocks->closing_stocks;
}


function get_last_production_id()
{ 
    $production_logs = DB::table('production_logs')
    ->orderBy('pdn_id', 'desc')
    ->first();
    // dd($production_logs->pdn_id);
    return $production_logs->pdn_id;
}

function get_quantity_of_canisters($prd_id, $flag)
{ 
    $query = DB::table('movement_logs')
    ->join('production_logs', 'production_logs.pdn_id', '=', 'movement_logs.pdn_id')
    ->where('movement_logs.acc_id', '=', session('acc_id'))
    ->where('prd_id','=', $prd_id)
    ->where('movement_logs.pdn_id','=', get_last_production_id());

    //FLAGS
    // 1 = emptygoods
    // 2 = filled
    // 3 = leakers
    // 4 = for revalving
    // 5 = scrap

    if($flag == 1)
    {
        $query = $query->sum('log_empty_goods');
        
        return $query;
    }
    elseif($flag == 2)
    {
        $query = $query->sum('log_filled');

        return $query;
    }
    elseif($flag == 3)
    {
        $query = $query->sum('log_leakers');

        return $query;
    }
    elseif($flag == 4)
    {
        $query = $query->sum('log_for_revalving');

        return $query;
    }
    elseif($flag == 5)
    {
        $query = $query->sum('log_scraps');
         
        return $query;
    }
}

function get_stock_report($prd_id, $flag)
{
    $production_logs = DB::table('movement_logs')
    ->join('production_logs', 'production_logs.pdn_id', '=', 'movement_logs.pdn_id')
    ->where('movement_logs.acc_id', '=', session('acc_id'));

    //FLAGS
    // 1 = OPENING
    // 2 = CLOSING 
    // 3 = TOTAL
    if($flag == 1)
    {
        return $production_logs = $production_logs 
        ->where('prd_id','=', $prd_id)
        ->where('movement_logs.pdn_id','<>', get_last_production_id())
        ->sum(DB::raw('log_empty_goods + log_filled + log_leakers + log_for_revalving + log_scraps'));
    }
    elseif($flag == 2)
    {
        if(check_production_log())
        {
            return $production_logs = $production_logs 
            ->where('prd_id','=', $prd_id)
            ->where('movement_logs.pdn_id','=', get_last_production_id())
            ->sum(DB::raw('log_filled')) + get_stock_report($prd_id, 1);
        }

        return 0;
    }    
    elseif($flag == 3)
    {
        return $production_logs = $production_logs 
        ->where('movement_logs.prd_id', '=', $prd_id)
        ->where('movement_logs.pdn_id', '=', get_last_production_id())
        ->sum(DB::raw('log_empty_goods + log_filled + log_leakers + log_for_revalving + log_scraps'));
    }
}

function check_materials($flag, $qty, $prd_id)
{
   //FOR EMPTYGOODS
   //dd($flag, $qty, $prd_id);
    if($flag == 1)
    {
        $raw_materials = DB::table('products')
        ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','0')
        ->where('prd_active','<>','0')    
        ->get();
    
        if(isset($raw_materials))
        {
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
        else
        {
            return false;
        }
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

        if(isset($empty_goods))
        {
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
        else
        {
            return false;
        }
    }
    //FOR REVALVING OR SCRAPPING LEAKERS 
    elseif($flag == 4 || $flag == 5)
    {
        $canisters = DB::table('products')
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_id','=',$prd_id)
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->get();

        if(isset($canisters))
        {
            foreach ($canisters as $canister)
            {
                if((float)$canister->prd_leakers >= $qty)
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
        else
        {
            return false;
        }
    }
    //FOR LEAKERS FROM PRODUCTION
    elseif($flag == 6)
    {
        $canisters = DB::table('products')
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_id','=',$prd_id)
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->get();

        if(isset($canisters))
        {
            foreach ($canisters as $canister)
            {
                if((float)$canister->prd_quantity >= $qty)
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
        else
        {
            return false;
        }
    }
}

function subtract_qty($flag, $qty, $prd_id)
{
    // dd($qty);
    //SUBTRACT RAW MATERIALS FOR EMPTY GOODS
    if($flag == 1)
    {

         
         $product = DB::table('products')
         ->where('prd_id','=', $prd_id)
         ->first();
 
         $components_list = $product->prd_components;
         $component = explode(",", $components_list);
 

         for($i = 0 ; $i < count($component) ; $i++)
         {
            
            $item = DB::table('products')      
            ->where('prd_id','=', $component[$i])
            ->where('acc_id', '=', session('acc_id'))
            ->where('prd_for_production','=','1')
            ->first();

            $new_quantity = $item->prd_quantity - $qty ;

            DB::table('products')        
            ->where('prd_id', '=', $component[$i])
            ->update([
                'prd_quantity' => $new_quantity
            ]);
         }

         $can = DB::table('products')      
            ->where('prd_id','=', $prd_id)
            ->where('acc_id', '=', session('acc_id'))
            ->where('prd_for_production','=','1')
            ->first();

         $new_quantity = $can->prd_raw_can_qty - $qty ;

         DB::table('products')        
         ->where('prd_id', '=', $prd_id)
         ->update([
             'prd_raw_can_qty' => $new_quantity
         ]);



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

        if(isset($canister))
        {
            $new_quantity= $canister->prd_empty_goods - $qty;
        }
        else
        {
            $new_quantity = 0;
        }

        DB::table('products')        
        ->where('prd_id', '=', $canister->prd_id)
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->update([
            'prd_empty_goods' => $new_quantity
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

        if(isset($revalves))
        {
            $new_quantity= $revalves->prd_leakers - $qty;
        }
        else
        {
            $new_quantity = 0;
        }

        DB::table('products')        
        ->where('prd_id', '=', $revalves->prd_id)
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->update([
            'prd_leakers' => $new_quantity
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

        if(isset($scraps))
        {
            $new_quantity= $scraps->prd_leakers - $qty;
        }
        else
        {
            $new_quantity = 0;
        }

        DB::table('products')        
        ->where('prd_id', '=', $scraps->prd_id)
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->update([
            'prd_leakers' => $new_quantity
        ]);
    }   
    //SUBTRACT BACKFLUSHED FOR LEAKERS
    elseif($flag == 6)
    {
        $leakers = DB::table('products')
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_id', '=', $prd_id)
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->first();
        // dd($qty);
        if(isset($leakers))
        {
            $new_quantity= $leakers->prd_quantity - $qty;
        }
        else
        {
            $new_quantity = 0;
        }

        DB::table('products')        
        ->where('prd_id', '=', $leakers->prd_id)
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->update([
            'prd_quantity' => $new_quantity
        ]);
    }   
}
?>
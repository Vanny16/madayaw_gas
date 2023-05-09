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
                'log_empty_goods' => $quantity,
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
        elseif($flag == 6)
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
        elseif($flag == 7)
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
    }
    else
    {

    }

}

function get_last_production_id()
{ 
    $production_logs = DB::table('production_logs')
    ->orderBy('pdn_id', 'desc')
    ->first();
    
    if($production_logs == null)
    {
        return 0;
    }

    return $production_logs->pdn_id;
}

function get_opening_stock($prd_id, $pdn_id)
{
    $opening_stocks = DB::table('stocks_logs')
    ->where('prd_id', '=', $prd_id)
    ->where('pdn_id', '=', $pdn_id)
    ->first();
    
    if($opening_stocks == null || $opening_stocks->opening_stocks == null)
    { 
        return 0;
    }

    return number_format($opening_stocks->opening_stocks, 0, '.', ',');
}

function get_closing_stock($prd_id, $pdn_id)
{
    $closing_stocks = DB::table('stocks_logs')
    ->where('prd_id', '=', $prd_id)
    ->where('pdn_id', '=', $pdn_id)
    ->first();

    if($closing_stocks == null || $closing_stocks->closing_stocks == null)
    { 
        return 0;
    }

    return number_format($closing_stocks->closing_stocks, 0, '.', ',');
}

function get_tank_quantity($tnk_id, $prd_id)
{
    $tanks = DB::table('tanks')
    ->first();

    if($tanks->tnk_remaining == null)
    {
        return 'N/A';
    }

    return number_format($tanks->tnk_remaining, 0, '.', ',');
}

function get_opening_tank($tnk_id, $pdn_id)
{
    $opening_tank = DB::table('tank_logs')
    ->where('tnk_id', '=', $tnk_id)
    ->where('pdn_id', '=', $pdn_id)
    ->first();
    
    if($opening_tank == null || $opening_tank->log_tnk_opening == null)
    { 
        return 0;
    }

    return number_format((($opening_tank->log_tnk_opening) / 1000), 0, '.', ',');
}

function get_closing_tank($tnk_id, $pdn_id)
{
    $closing_tank = DB::table('tank_logs')
    ->where('tnk_id', '=', $tnk_id)
    ->where('pdn_id', '=', $pdn_id)
    ->first();

    // dd($closing_tank, $pdn_id);
    if($closing_tank == null || $closing_tank->log_tnk_closing == null)
    { 
        return 0;
    }
    return number_format((($closing_tank->log_tnk_closing) / 1000), 0, '.', ',');
}

function get_quantity_of_canisters($prd_id, $pdn_id, $flag)
{ 
    $query = DB::table('stocks_logs')
    // ->join('production_logs', 'production_logs.pdn_id', '=', 'movement_logs.pdn_id')
    ->where('acc_id', '=', session('acc_id'))
    ->where('prd_id','=', $prd_id)
    ->where('pdn_id','=', $pdn_id)
    ->first();
    
    if($query == null)
    {
        return 0;
    }

    // dd($query->stk_empty_goods);
    //FLAGS
    // 1 = emptygoods
    // 2 = filled
    // 3 = leakers
    // 4 = for revalving
    // 5 = scrap

    if($flag == 1)
    {   
        return number_format($query->stk_empty_goods, 0, '.', ',');
    }
    elseif($flag == 2)
    {
        return number_format($query->stk_filled, 0, '.', ',');
    }
    elseif($flag == 3)
    {
        return number_format($query->stk_leakers, 0, '.', ',');
    }
    elseif($flag == 4)
    {
        return number_format($query->stk_for_revalving, 0, '.', ',');
    }
    elseif($flag == 5)
    {
        return number_format($query->stk_scraps, 0, '.', ',');
    }
}

function get_total_canister_report()
{
    //COMMENTED INCASE OF REVERTING
    // $total_stock = DB::table('movement_logs')
    // ->join('production_logs', 'production_logs.pdn_id', '=', 'movement_logs.pdn_id')
    // ->where('movement_logs.acc_id', '=', session('acc_id'))
    // ->where('movement_logs.prd_id', '=', $prd_id)
    // ->where('movement_logs.pdn_id', '=', $pdn_id)
    // ->sum(DB::raw('log_empty_goods + log_filled + log_leakers + log_for_revalving + log_scraps'));
    
    // return $total_stock;
    // $total_stock = DB::table('stocks_logs')
    // ->where('acc_id', '=', session('acc_id'))
    // ->where('prd_id', '=', $prd_id)
    // ->where('pdn_id', '=', $pdn_id)
    // ->sum(DB::raw('stk_empty_goods + stk_filled + stk_leakers + stk_for_revalving + stk_scraps'));
    
    $oppositions = DB::table('oppositions')
    ->where('acc_id', '=', session('acc_id'))
    ->get();

    $products = DB::table('products')
    ->where('acc_id', '=', session('acc_id'))
    ->where('prd_is_refillable', '=', 1)
    ->get();

    $total_stock = 0;

    // foreach($oppositions as $opposition)
    // {
    //     $total_stock = $total_stock + $opposition->ops_quantity;
    // }
    foreach($products as $product)
    {
        $total_stock = $total_stock + $product->prd_quantity;
        $total_stock = $total_stock + $product->prd_leakers;
        $total_stock = $total_stock + $product->prd_empty_goods;
        $total_stock = $total_stock + $product->prd_for_revalving;
        // $total_stock = $total_stock + $product->prd_scraps;
    }
    return number_format($total_stock, 0, '.', ',');
}

function get_total_opposition_report()
{
    
    $oppositions = DB::table('oppositions')
    ->where('acc_id', '=', session('acc_id'))
    ->get();

    $total_stock = 0;

    foreach($oppositions as $opposition)
    {
        $total_stock = $total_stock + $opposition->ops_quantity;
    }
    
    return number_format($total_stock, 0, '.', ',');
}

function get_total_stock_report()
{
    //COMMENTED INCASE OF REVERTING
    // $total_stock = DB::table('movement_logs')
    // ->join('production_logs', 'production_logs.pdn_id', '=', 'movement_logs.pdn_id')
    // ->where('movement_logs.acc_id', '=', session('acc_id'))
    // ->where('movement_logs.prd_id', '=', $prd_id)
    // ->where('movement_logs.pdn_id', '=', $pdn_id)
    // ->sum(DB::raw('log_empty_goods + log_filled + log_leakers + log_for_revalving + log_scraps'));
    
    // return $total_stock;
    // $total_stock = DB::table('stocks_logs')
    // ->where('acc_id', '=', session('acc_id'))
    // ->where('prd_id', '=', $prd_id)
    // ->where('pdn_id', '=', $pdn_id)
    // ->sum(DB::raw('stk_empty_goods + stk_filled + stk_leakers + stk_for_revalving + stk_scraps'));
    
    $oppositions = DB::table('oppositions')
    ->where('acc_id', '=', session('acc_id'))
    ->get();

    $products = DB::table('products')
    ->where('acc_id', '=', session('acc_id'))
    ->where('prd_is_refillable', '=', 1)
    ->get();

    $total_stock = 0;

    foreach($oppositions as $opposition)
    {
        $total_stock = $total_stock + $opposition->ops_quantity;
    }
    foreach($products as $product)
    {
        $total_stock = $total_stock + $product->prd_quantity;
        $total_stock = $total_stock + $product->prd_leakers;
        $total_stock = $total_stock + $product->prd_empty_goods;
        $total_stock = $total_stock + $product->prd_for_revalving;
    }
    return number_format($total_stock, 0, '.', ',');
}

function get_product_total_stock_from_pdn_date($prd_id, $pdn_id)
{
    //COMMENTED INCASE OF REVERTING
    // $total_stock = DB::table('movement_logs')
    // ->join('production_logs', 'production_logs.pdn_id', '=', 'movement_logs.pdn_id')
    // ->where('movement_logs.acc_id', '=', session('acc_id'))
    // ->where('movement_logs.prd_id', '=', $prd_id)
    // ->where('movement_logs.pdn_id', '=', $pdn_id)
    // ->sum(DB::raw('log_empty_goods + log_filled + log_leakers + log_for_revalving + log_scraps'));
    
    // return $total_stock;
    // $total_stock = DB::table('stocks_logs')
    // ->where('acc_id', '=', session('acc_id'))
    // ->where('prd_id', '=', $prd_id)
    // ->where('pdn_id', '=', $pdn_id)
    // ->sum(DB::raw('stk_empty_goods + stk_filled + stk_leakers + stk_for_revalving + stk_scraps'));
    
    $stocks = DB::table('stocks_logs')
    ->where('acc_id', '=', session('acc_id'))
    ->where('prd_id', '=', $prd_id)
    ->where('pdn_id', '=', $pdn_id)
    ->first();
    // dd($pdn_id);
    if($stocks == null)
    {
        return 0;
    }

    $total_stock = 0;

    $total_stock = $total_stock + $stocks->stk_filled + $stocks->stk_leakers + $stocks->stk_empty_goods + $stocks->stk_for_revalving + $stocks->stk_scraps;

    return number_format($total_stock, 0, '.', ',');
}

function get_product_total_stock($prd_id)
{
    //COMMENTED INCASE OF REVERTING
    // $total_stock = DB::table('movement_logs')
    // ->join('production_logs', 'production_logs.pdn_id', '=', 'movement_logs.pdn_id')
    // ->where('movement_logs.acc_id', '=', session('acc_id'))
    // ->where('movement_logs.prd_id', '=', $prd_id)
    // ->where('movement_logs.pdn_id', '=', $pdn_id)
    // ->sum(DB::raw('log_empty_goods + log_filled + log_leakers + log_for_revalving + log_scraps'));
    
    // return $total_stock;
    // $total_stock = DB::table('stocks_logs')
    // ->where('acc_id', '=', session('acc_id'))
    // ->where('prd_id', '=', $prd_id)
    // ->where('pdn_id', '=', $pdn_id)
    // ->sum(DB::raw('stk_empty_goods + stk_filled + stk_leakers + stk_for_revalving + stk_scraps'));
    
    $product = DB::table('products')
    ->where('acc_id', '=', session('acc_id'))
    ->where('prd_id', '=', $prd_id)
    ->first();

    $total_stock = 0;

    $total_stock = $total_stock + $product->prd_quantity + $product->prd_leakers + $product->prd_empty_goods + $product->prd_for_revalving + $product->prd_scraps;
    
    return $total_stock;
    // return number_format($total_stock, 0, '.', ',');
}

function get_product_total_stock_no_scrap($prd_id)
{
    //COMMENTED INCASE OF REVERTING
    // $total_stock = DB::table('movement_logs')
    // ->join('production_logs', 'production_logs.pdn_id', '=', 'movement_logs.pdn_id')
    // ->where('movement_logs.acc_id', '=', session('acc_id'))
    // ->where('movement_logs.prd_id', '=', $prd_id)
    // ->where('movement_logs.pdn_id', '=', $pdn_id)
    // ->sum(DB::raw('log_empty_goods + log_filled + log_leakers + log_for_revalving + log_scraps'));
    
    // return $total_stock;
    // $total_stock = DB::table('stocks_logs')
    // ->where('acc_id', '=', session('acc_id'))
    // ->where('prd_id', '=', $prd_id)
    // ->where('pdn_id', '=', $pdn_id)
    // ->sum(DB::raw('stk_empty_goods + stk_filled + stk_leakers + stk_for_revalving + stk_scraps'));
    
    $product = DB::table('products')
    ->where('acc_id', '=', session('acc_id'))
    ->where('prd_id', '=', $prd_id)
    ->first();

    $total_stock = 0;

    $total_stock = $total_stock + $product->prd_quantity + $product->prd_leakers + $product->prd_empty_goods + $product->prd_for_revalving;
    
    return $total_stock;
    // return number_format($total_stock, 0, '.', ',');
}

function get_valve_population()
{
    $canisters = DB::table('products')
    ->where('acc_id', '=', session('acc_id'))
    ->where('prd_active', '=', 1)
    ->where('prd_is_refillable', '=', 1)
    ->where('prd_for_production', '=', 1)
    ->get();
    
    $valve_ids = [];

    foreach($canisters as $canister)
    {
        if($canister->prd_components == null)
        {
            continue;
        }
        array_push($valve_ids, $canister->prd_components);
    }

    $valve_population = DB::table('products')
    ->where('acc_id', '=', session('acc_id'))
    ->where('prd_active', '=', 1)
    ->where('prd_for_production', '=', 1)
    ->whereIn('prd_id', $valve_ids)
    ->sum('prd_quantity');

    return number_format($valve_population, 0, '.', ',');
}

function get_seal_population()
{
    $canisters = DB::table('products')
    ->where('acc_id', '=', session('acc_id'))
    ->where('prd_active', '=', 1)
    ->where('prd_is_refillable', '=', 1)
    ->where('prd_for_production', '=', 1)
    ->get();
    
    $seal_ids = [];

    foreach($canisters as $canister)
    {
        if($canister->prd_components == null)
        {
            continue;
        }
        array_push($seal_ids, $canister->prd_seals);
    }

    $seal_population = DB::table('products')
    ->where('acc_id', '=', session('acc_id'))
    ->where('prd_active', '=', 1)
    ->where('prd_for_production', '=', 1)
    ->whereIn('prd_id', $seal_ids)
    ->sum('prd_quantity');

    return number_format($seal_population, 0, '.', ',');
}

function get_crate_population()
{
    return 0;
}

function check_materials($flag, $qty, $prd_id)
{
   //FOR EMPTYGOODS
    if($flag == 1)
    {
       $raw_materials = DB::table('products')
       ->where('products.acc_id', '=', session('acc_id'))
       ->where('prd_id','=', $prd_id)
       ->where('prd_for_production','=','1')
       ->where('prd_active','<>','0')    
       ->first();

       $valve = DB::table('products')
       ->where('products.acc_id', '=', session('acc_id'))
       ->where('prd_id','=', $raw_materials->prd_components)
       ->where('prd_for_production','=','1')
       ->where('prd_active','<>','0')    
       ->first();

    
       if(!isset($raw_materials) || !isset($valve))
        {
            return false;
        }

        if($raw_materials->prd_raw_can_qty < $qty)
        {
            return false;
        }
        
        if($valve->prd_quantity < $qty)
        {
            return false;
        }

        return true;
    }

    //    dd($);
    //    if(isset($raw_materials))
    //    {
    //        if($raw_materials->prd_raw_can_qty >= $qty)
    //        {
    //            return true;
    //        }
    //        else
    //        {
    //            return false;
    //        }
    //    }
    //    else
    //    {
    //        return false;
    //    }

    //FOR FILLING CANISTERS
    elseif($flag == 2)
    {
        $empty_goods = DB::table('products')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_id','=',$prd_id)
        ->where('prd_for_production','=','1')
        ->first();

        $product = DB::table('products')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_id','=',$prd_id)
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->first();
        
        if(!isset($empty_goods))
        {
            return false;
        }
        
        if($empty_goods->prd_empty_goods < $qty)
        {
            return false;
        }

        return true;
    }

    //FOR REVALVING 
    elseif($flag == 4)
    {
        $canisters = DB::table('products')
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_id','=',$prd_id)
        ->where('prd_for_production','=','1')
        ->first();

        if(isset($canisters))
        {
            if((float)$canisters->prd_for_revalving >= $qty)
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
            return false;
        }
    }

    //SCRAPPING LEAKERS 
    elseif($flag == 5)
    {
        $canisters = DB::table('products')
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_id','=',$prd_id)
        ->where('prd_for_production','=','1')
        ->first();

        if(isset($canisters))
        {
            if((float)$canisters->prd_leakers >= $qty)
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
        ->first();

        if(isset($canisters))
        {
            if((float)$canisters->prd_quantity >= $qty)
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
            return false;
        }
    }

    //FOR_REVALVING FROM PRODUCTION
    elseif($flag == 7)
    {
        $canisters = DB::table('products')
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_id','=',$prd_id)
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->first();
        
        if(isset($canisters))
        {
            if((float)$canisters->prd_leakers >= $qty)
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
            return false;
        }
    }

    elseif($flag == 8)
    {
        $canisters = DB::table('products')
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_id','=',$prd_id)
        ->where('prd_for_production','=','1')
        ->first();

        if(isset($canisters))
        {
            if((float)$canisters->prd_scraps >= $qty)
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
            return false;
        }
    }
}

function subtract_qty($flag, $qty, $prd_id)
{

    //SUBTRACT RAW MATERIALS FOR EMPTY GOODS
    if($flag == 1)
    {
        $product = DB::table('products')
        ->where('prd_id','=', $prd_id)
        ->first();

        // $components_list = $product->prd_components;
        // $component = explode(",", $components_list);

        // if($component[0] <> "")
        // {
        //     for($i = 0 ; $i < count($component) ; $i++)
        //     {
            
        //     $item = DB::table('products')      
        //     ->where('prd_id','=', $component[$i])
        //     ->where('acc_id', '=', session('acc_id'))
        //     ->where('prd_for_production','=','1')
        //     ->first();
    
        //     $new_quantity = $item->prd_quantity - $qty ;
    
        //     DB::table('products')        
        //     ->where('prd_id', '=', $component[$i])
        //     ->update([
        //         'prd_quantity' => $new_quantity
        //     ]);
        //     }
        // }

        $component = $product->prd_components;

        if($component <> "" || $component <> null)
        {
            $item = DB::table('products')      
            ->where('prd_id','=', $component)
            ->where('acc_id', '=', session('acc_id'))
            ->where('prd_for_production','=','1')
            ->first();
    
            $new_quantity = $item->prd_quantity - $qty ;
    
            DB::table('products')        
            ->where('prd_id', '=', $component)
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

        $seal = DB::table('products')
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_id', '=', $canister->prd_seals)
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','0')
        ->first();

        if(isset($canister))
        {
            $new_quantity= $canister->prd_empty_goods - $qty;
        }
        else
        {
            $new_quantity = 0;
        }

        if(isset($seal))
        {
            $seal_quantity= $seal->prd_quantity - $qty;
        }
        else
        {
            $seal_quantity = 0;
        }

        DB::table('products')        
        ->where('prd_id', '=', $canister->prd_id)
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->update([
            'prd_empty_goods' => $new_quantity
        ]);

        DB::table('products')        
        ->where('prd_id', '=', $seal->prd_id)
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','0')
        ->update([
            'prd_quantity' => $seal_quantity
        ]);
    }

    //SUBTRACT FOR_REVALVING FOR DECANTING 
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
            $new_quantity= $revalves->prd_for_revalving - $qty;
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
            'prd_for_revalving' => $new_quantity
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

    //SUBTRACT LEAKERS FOR "FOR_REVALVING"
    elseif($flag == 7)
    {
        $for_revalving = DB::table('products')
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_id', '=', $prd_id)
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->first();
        // dd($for_revalving);
        if(isset($for_revalving))
        {
            $new_quantity= $for_revalving->prd_leakers - $qty;
        }
        else
        {
            $new_quantity = 0;
        }

        DB::table('products')        
        ->where('prd_id', '=', $for_revalving->prd_id)
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->update([
            'prd_leakers' => $new_quantity
        ]);
    }   

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
            $new_quantity= $scraps->prd_scraps - $qty;
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
}
?>
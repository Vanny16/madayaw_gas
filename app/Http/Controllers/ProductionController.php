<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon\Carbon;

use DB;

class ProductionController extends Controller
{
    public function manage(){ 
        // return $this->printProduction();

        if(session('typ_id') == 3){
            return redirect()->action('MainController@home');
        }

        $raw_materials = DB::table('products')
        ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_for_production','=','1')
        ->get();
        
        $canisters = DB::table('products')
        ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->get();

        $suppliers = DB::table('suppliers')
        ->where('acc_id', '=', session('acc_id'))
        ->get();

        $transactions = DB::table('transactions')
        ->join('customers', 'customers.cus_id', '=', 'transactions.cus_id')
        ->where('transactions.acc_id', '=', session('acc_id'))
        ->get();

        $oppositions = DB::table('oppositions')
        ->where('acc_id', '=', session('acc_id'))
        ->get();

        $pdn_flag = check_production_log();

        $production_times = DB::table('production_logs')
        ->orderBy('pdn_id', 'DESC')
        ->first();

        $tanks = DB::table('tanks')
        ->where('acc_id', '=', session('acc_id'))
        ->where('tnk_active', '=', 1)
        ->get();
        // dd($tanks);
        $tank_logs = DB::table('tank_logs')
        ->where('acc_id', '=', session('acc_id'))
        ->get(); 

        $pdn_for_verifications = get_last_production_id();
        if(check_production_log())
        {
            $pdn_for_verifications = $pdn_for_verifications + 1;
        }

        $verifications = DB::table('stock_verifications')
        ->where('verify_acc_id', '=', session('acc_id'))
        ->where('verify_pdn_id', '=', $pdn_for_verifications);
        // ->get(); 

        $product_verifications = DB::table('stock_verifications')
        ->where('verify_pdn_id', '=', $pdn_for_verifications)
        ->where('verify_acc_id', '=', session('acc_id'))
        ->whereIn('verify_user_type', [1, 3, 4])
        ->get(); 

        $opening_visibility = "";
        $closing_visibility = "";
        
        $verify_opening_visibility = "";
        $verify_closing_visibility = "";

        if((count($verifications->get()) == 0) && session('typ_id') <> 4)
        {
            $opening_visibility = "disabled";
            $verify_opening_visibility = "disabled";
        }
        else
        {
            // $verifications = $verifications->get();
            if(session('typ_id') <> 1)
            {
                $opening_visibility = "disabled";
                
                $visibility_verifications = $verifications->where('verify_user_type', '!=', 1)->first();
                // dd($visibility_verifications);
                if(is_null($visibility_verifications) || is_null($visibility_verifications->verify_closing))
                {
                    $opening_visibility = "";
                    $closing_visibility = "disabled";
                }
            }

            if(session('typ_id') == 1)
            {
                $admin_verifications  = DB::table('stock_verifications')
                ->where('verify_acc_id', '=', session('acc_id'))
                ->where('verify_pdn_id', '=', $pdn_for_verifications)
                ->where('verify_user_type', '=', 1)
                ->first();
                // dd($admin_verifications);
                
                if(is_null($admin_verifications) || (is_null($admin_verifications->verify_closing) && ($admin_verifications->verify_user_type == 4 || $admin_verifications->verify_user_type == 1)))
                {   
                    $verify_opening_visibility = "";
                    $verify_closing_visibility = "disabled";
                }

                // $verify_production_id = get_last_production_id();
                // if($pdn_flag)
                // {
                //     $verify_opening_visibility = "disabled";
                //     $verify_production_id = $verify_production_id + 1;
                // }
                // foreach($verifications as $verification)
                // {
                //     if($verification->verify_pdn_id == $verify_production_id)
                //     {
                //         if(is_null($verification->verify_closing) && ($verification->verify_user_type == 5 || $verification->verify_user_type == 1))
                //         {   
                //             $verify_opening_visibility = "";
                //             $verify_closing_visibility = "disabled";
                //             break;
                //         }
                //     }
                // }
            }

            if(session('typ_id') == 5)
            {
                $pm_verifications  = DB::table('stock_verifications')
                ->where('verify_acc_id', '=', session('acc_id'))
                ->where('verify_pdn_id', '=', $pdn_for_verifications)
                ->where('verify_user_type', '=', 5)
                ->first();

                if($pdn_flag)
                {
                    $verify_opening_visibility = "disabled";
                }
                // dd($pm_verifications );
                if($pm_verifications != null)
                {
                    if(is_null($pm_verifications->verify_closing) && ($pm_verifications->verify_user_type == 4 || $pm_verifications->verify_user_type == 1))
                    {   
                        $verify_opening_visibility = "";
                        $verify_closing_visibility = "disabled";
                    }
                }
                else
                {
                    $verify_opening_visibility = "";
                    $verify_closing_visibility = "disabled";
                }
                // dd($pm_verifications);
                // foreach($verifications as $verification)
                // {
                //     if($verification->verify_pdn_id == $verify_production_id)
                //     {
                        
                //     }
                // }
            }

            if(session('typ_id') == 4)
            {
                $supervisor_verifications  = DB::table('stock_verifications')
                ->where('verify_acc_id', '=', session('acc_id'))
                ->where('verify_pdn_id', '=', $pdn_for_verifications)
                ->where('verify_user_type', '=', 4)
                ->first();

                if(!is_null($supervisor_verifications))
                {
                    if(!is_null($supervisor_verifications->verify_opening) && ($supervisor_verifications->verify_user_type == 5 || $supervisor_verifications->verify_user_type == 1))
                    {
                        $verify_opening_visibility = "verified";
                    }

                    if(!is_null($supervisor_verifications->verify_closing) && ($supervisor_verifications->verify_user_type == 5 || $supervisor_verifications->verify_user_type == 1))
                    {
                        $verify_closing_visibility = "verified";
                    }
                }
            }
        }
        // dd(session('typ_id'));

        //CHECK IF PLANT MANAGER AND SUPERVISOR INPUT ARE BALANCED
        if(!$this->verification_comparison())
        {
            $opening_visibility = "discrepancy";
            $closing_visibility = "discrepancy";
            session()->flash('errorMessage','Production Verification Discrepancy!');
        }
        // dd($opening_visibility, $closing_visibility);

        $canister_details = "";
        $tank_details = "";
        foreach($canisters as $canister)
        {
            $canister_details = $canister_details . $canister->prd_id . "|" . $canister->prd_name . ",";
        }

        foreach($tanks as $tank)
        {
            $tank_details = $tank_details . $tank->tnk_id . "|" . $tank->tnk_name . ",";
        }
        
        $input_text_display = "";
        if(session('typ_id') == 1 || session('typ_id') == 5 )
        {
            $input_text_display = "disabled";
        }

        $pdn_date = "";
        $pdn_start_time = '-- : -- --';
        $pdn_end_time = '-- : -- --'; 

        if(isset($production_times))
        {
            if(date('Y-m-d',strtotime($production_times->pdn_date)) == date("Y-m-d"))
            {
                if($production_times->pdn_end_time <> 0)
                {
                    $pdn_date = date("F j, Y", strtotime($production_times->pdn_date));
                    $pdn_start_time = date("h:i:s a", strtotime($production_times->pdn_start_time));
                    $pdn_end_time = date("h:i:s a", strtotime($production_times->pdn_end_time));
                }
                else
                {
                    $pdn_date = date("F j, Y", strtotime($production_times->pdn_date));
                    $pdn_start_time = date("h:i:s a", strtotime($production_times->pdn_start_time));
                    $pdn_end_time = '-- : -- --'; 
                    // $pdn_end_time = date("h:i:s a", strtotime($production_times->pdn_end_time));
                }   
            }
            else
            {
                $pdn_date = date("F j, Y", strtotime($production_times->pdn_date));
                $pdn_start_time = date("h:i:s a", strtotime($production_times->pdn_start_time));
                $pdn_end_time = date("h:i:s a", strtotime($production_times->pdn_end_time));
            }
        }
        
        return view('admin.production.manage',compact('raw_materials', 'canisters', 'suppliers', 'transactions', 'oppositions', 'pdn_flag', 'pdn_date', 'pdn_start_time', 'pdn_end_time', 'tanks', 'product_verifications', 'opening_visibility', 'closing_visibility', 'canister_details', 'tank_details', 'input_text_display', 'verify_opening_visibility', 'verify_closing_visibility'));
    }

    //PRODUCTION
    public function toggleProduction(Request $request)
    {
        $pdn_flag = check_production_log();
        $temp_details = explode(",", $request->canister_details);
        $temp_tank_details = explode(",", $request->tank_details);
        array_pop($temp_details);
        array_pop($temp_tank_details);
        
        $canister_details = [];
        $tank_details = [];
        
        foreach($temp_details as $details)
        {   
            $detail = explode("|", $details);
            array_push($canister_details, $detail[0]);
        }

        foreach($temp_tank_details as $details)
        {   
            $detail = explode("|", $details);
            array_push($tank_details, $detail[0]);
        }

        if(empty($temp_tank_details))
        {
            session()->flash('errorMessage','Must add tanks before starting production!');
            return redirect()->action('ProductionController@manage');
        }

        if($pdn_flag)
        {
            DB::table('production_logs')
            ->insert([
                'pdn_date' => Carbon::now(),
                'pdn_start_time' => Carbon::now()
            ]);

            if($temp_details <> "" && $temp_tank_details <> "")
            {
                foreach($canister_details as $prd_id)
                {
                    $total_input = 'total_stock_quantity' . $prd_id;
                    $filled_input = 'filled_stock_quantity' . $prd_id;
                    $empty_input = 'empty_stock_quantity' . $prd_id;
                    $leakers_input = 'leakers_stock_quantity' . $prd_id;
                    $for_revalving_input = 'revalving_stock_quantity' . $prd_id;
                    $scrap_input = 'scraps_stock_quantity' . $prd_id;

                    // DB::table('products')
                    // ->where('prd_id', '=', $prd_id)
                    // ->update([
                    //     'prd_quantity' => $request->$total_input,
                    // ]);
                    
                    DB::table('stocks_logs')
                    ->insert([
                        'acc_id' => session('acc_id'),
                        'prd_id' => $prd_id,
                        'opening_stocks' => $request->$total_input,
                        'pdn_id' => get_last_production_id()
                    ]);
                }

                foreach($tank_details as $tnk_id)
                {
                    $total_input = "tank_remaining" . $tnk_id;

                    // DB::table('tanks')
                    // ->where('tnk_id', '=', $tnk_id)
                    // ->update([
                    //     'tnk_remaining' => $request->$total_input * 1000,
                    // ]);

                    DB::table('tank_logs')
                    ->insert([
                        'acc_id' => session('acc_id'),
                        'tnk_id' => $tnk_id,
                        'log_tnk_opening' => ($request->$total_input) * 1000,
                        'pdn_id' => get_last_production_id()
                    ]);
                }
            }

            session()->flash('successMessage','Production started!');
            return redirect()->action('ProductionController@manage');
            // $view = $this->printProduction();
            // return $view;
        }
        else
        {
            DB::table('production_logs')
            ->update([
                'pdn_end_time' => Carbon::now()
            ]);

            if($temp_details <> "" && $temp_tank_details <> "")
            {
                foreach($canister_details as $prd_id)
                {
                    $total_input = 'total_stock_quantity' . $prd_id;
                    $filled_input = 'filled_stock_quantity' . $prd_id;
                    $empty_input = 'empty_stock_quantity' . $prd_id;
                    $leakers_input = 'leakers_stock_quantity' . $prd_id;
                    $for_revalving_input = 'revalving_stock_quantity' . $prd_id;
                    $scrap_input = 'scraps_stock_quantity' . $prd_id;
                  
                    // DB::table('products')
                    // ->where('prd_id', '=', $prd_id)
                    // ->update([
                    //     'prd_quantity' => $request->$total_input,
                    // ]);

                    DB::table('stocks_logs')
                    ->where('prd_id', '=', $prd_id)
                    ->where('pdn_id', '=', get_last_production_id())
                    ->update([
                        'closing_stocks' => $request->$total_input,
                    ]);
                }

                foreach($tank_details as $tnk_id)
                {
                    $total_input = "tank_remaining" . $tnk_id;

                    // DB::table('tanks')
                    // ->where('tnk_id', '=', $tnk_id)
                    // ->update([
                    //     'tnk_remaining' => $request->$total_input * 1000,
                    // ]);

                    DB::table('tank_logs')
                    ->where('pdn_id', '=', get_last_production_id())
                    ->where('tnk_id', '=', $tnk_id)
                    ->update([
                        'log_tnk_closing' => ($request->$total_input) * 1000,
                    ]);
                }
            }

            //DATA NEEDED FOR PRODUCTION PRINT
            //ENTER HERE THE FUNCTION FOR PRINTING

            session()->flash('successMessage','Production ended!');
            // return redirect()->action('ProductionController@manage');
            $view = $this->printProduction();
            return $view;
        }
    }

    public function verifyProduction(Request $request)
    {
        $pdn_flag = check_production_log();
        $temp_details = explode(",", $request->canister_details);
        $temp_tank_details = explode(",", $request->tank_details);
        array_pop($temp_details);
        array_pop($temp_tank_details);

        $canister_details = [];
        $tank_details = [];
        
        foreach($temp_details as $details)
        {   
            $detail = explode("|", $details);
            array_push($canister_details, $detail[0]);
        }

        foreach($temp_tank_details as $details)
        {   
            $detail = explode("|", $details);
            array_push($tank_details, $detail[0]);
        }

        if(empty($temp_tank_details))
        {
            session()->flash('errorMessage','Must add tanks before starting production!');
            return redirect()->action('ProductionController@manage');
        }

        $is_updated = false;
        $is_added = false;
        
        if($pdn_flag)
        {
            if($temp_details <> "" && $temp_tank_details <> "")
            {
                foreach($canister_details as $prd_id)
                {
                    $total_input = 'verify_total_stock_quantity' . $prd_id;
                    $filled_input = 'verify_filled_stock_quantity' . $prd_id;
                    $empty_input = 'verify_empty_stock_quantity' . $prd_id;
                    $leakers_input = 'verify_leakers_stock_quantity' . $prd_id;
                    $for_revalving_input = 'verify_revalving_stock_quantity' . $prd_id;
                    $scrap_input = 'verify_scraps_stock_quantity' . $prd_id;
                    
                    $verify_checker = DB::table('stock_verifications')
                    ->where('verify_prd_id', '=', $prd_id)
                    ->where('verify_is_product', '=', 1)
                    ->where('verify_pdn_id', '=', get_last_production_id() + 1)
                    ->where('verify_user_type', '=', session('typ_id'))
                    ->first();
                    
                    if(session('typ_id') == 4)
                    {
                        if(!$this->check_supervisor_verification($prd_id, get_last_production_id()))
                        {
                            session()->flash('errorMessage','Supervisor / Admin must verify first!');
                            return redirect()->action('ProductionController@manage');
                        }
                    }
                    // dd($request->$total_input,
                    // $request->$filled_input,
                    // $request->$empty_input,
                    // $request->$leakers_input,
                    // $request->$for_revalving_input,
                    // $request->$scrap_input);
                    if($verify_checker <> '' || !is_null($verify_checker))
                    {
                        DB::table('stock_verifications')
                        ->where('verify_pdn_id', '=', get_last_production_id() + 1)
                        ->where('verify_prd_id', '=', $prd_id)
                        ->where('verify_is_product', '=', 1)
                        ->where('verify_user_type', '=', session('typ_id'))
                        ->update([
                            'verify_opening' => $request->$total_input,
                            'verify_opening_filled' => $request->$filled_input,
                            'verify_opening_empty' => $request->$empty_input,
                            'verify_opening_leakers' => $request->$leakers_input,
                            'verify_opening_for_revalving' => $request->$for_revalving_input,
                            'verify_opening_scraps' => $request->$scrap_input,
                            'verify_user_id' => session('usr_id')
                        ]);

                        $is_updated = true;
                    }
                    else
                    {
                        DB::table('stock_verifications')
                        ->insert([
                            'verify_prd_id' => $prd_id,
                            'verify_opening' => $request->$total_input,
                            'verify_opening_filled' => $request->$filled_input,
                            'verify_opening_empty' => $request->$empty_input,
                            'verify_opening_leakers' => $request->$leakers_input,
                            'verify_opening_for_revalving' => $request->$for_revalving_input,
                            'verify_opening_scraps' => $request->$scrap_input,
                            'verify_is_product' => 1,
                            'verify_pdn_id' => get_last_production_id() + 1,
                            'verify_acc_id' => session('acc_id'),
                            'verify_user_type' => session('typ_id'),
                            'verify_user_id' => session('usr_id')
                        ]);

                        $is_added = true;
                    }
                }

                foreach($tank_details as $tnk_id)
                {
                    $input_field = "verify_tank_remaining" . $tnk_id;

                    $verify_checker = DB::table('stock_verifications')
                    ->where('verify_prd_id', '=', $tnk_id)
                    ->where('verify_is_product', '=', 0)
                    ->where('verify_pdn_id', '=', get_last_production_id() + 1)
                    ->where('verify_user_type', '=', session('typ_id'))
                    ->first();
                    
                    if(session('typ_id') == 4)
                    {
                        if(!$this->check_supervisor_verification($prd_id, get_last_production_id()))
                        {
                            session()->flash('errorMessage','Supervisors must verify first!');
                            return redirect()->action('ProductionController@manage');
                        }
                    }

                    if($verify_checker <> '' || !is_null($verify_checker))
                    {
                        DB::table('stock_verifications')
                        ->where('verify_pdn_id', '=', get_last_production_id() + 1)
                        ->where('verify_prd_id', '=', $tnk_id)
                        ->where('verify_is_product', '=', 0)
                        ->update([
                            'verify_opening' => ($request->$input_field) * 1000,
                            'verify_user_id' => session('usr_id')
                        ]);

                        $is_updated = true;
                    }
                    else
                    {
                        DB::table('stock_verifications')
                        ->insert([
                            'verify_prd_id' => $tnk_id,
                            'verify_opening' => ($request->$input_field) * 1000,
                            'verify_is_product' => 0,
                            'verify_pdn_id' => get_last_production_id() + 1,
                            'verify_acc_id' => session('acc_id'),
                            'verify_user_type' => session('typ_id'),
                            'verify_user_id' => session('usr_id')
                        ]);

                        $is_added = true;
                    }

                    
                }
            }

            if($is_added == true && $is_updated == false)
            {
                session()->flash('successMessage','Verification added!');
            }

            if($is_added == false && $is_updated == true)
            {
                session()->flash('successMessage','Verification updated!');
            }

            if($is_added == true && $is_updated == true)
            {
                session()->flash('successMessage','Verification added and updated!');
            }

            return redirect()->action('ProductionController@manage');
        }
        else
        {
            if($temp_details <> "" && $temp_tank_details <> "")
            {
                foreach($canister_details as $prd_id)
                {
                    $total_input = 'verify_total_stock_quantity' . $prd_id;
                    $filled_input = 'verify_filled_stock_quantity' . $prd_id;
                    $empty_input = 'verify_empty_stock_quantity' . $prd_id;
                    $leakers_input = 'verify_leakers_stock_quantity' . $prd_id;
                    $for_revalving_input = 'verify_revalving_stock_quantity' . $prd_id;
                    $scrap_input = 'verify_scraps_stock_quantity' . $prd_id;

                    $verification_check = DB::table('stock_verifications')
                    ->where('verify_acc_id', '=', session('acc_id'))
                    ->where('verify_pdn_id', '=', get_last_production_id())
                    ->where('verify_prd_id', '=', $prd_id)
                    ->where('verify_user_type', '=', session('typ_id'))
                    ->first();
                    
                    if(session('typ_id') == 4)
                    {
                        if(!$this->check_supervisor_verification($prd_id, get_last_production_id()))
                        {
                            session()->flash('errorMessage','Supervisors must verify first!');
                            return redirect()->action('ProductionController@manage');
                        }
                    }
                    
                    if($verification_check == '' || $verification_check == null)
                    {
                        
                        DB::table('stock_verifications')
                        ->insert([
                            'verify_prd_id' => $prd_id,
                            'verify_closing' => $request->$total_input,
                            'verify_closing_filled' => $request->$filled_input,
                            'verify_closing_empty' => $request->$empty_input,
                            'verify_closing_leakers' => $request->$leakers_input,
                            'verify_closing_for_revalving' => $request->$for_revalving_input,
                            'verify_closing_scraps' => $request->$scrap_input,
                            'verify_is_product' => 1,
                            'verify_pdn_id' => get_last_production_id(),
                            'verify_acc_id' => session('acc_id'),
                            'verify_user_type' => session('typ_id'),
                            'verify_user_id' => session('usr_id')
                        ]);  

                        $is_added = true;
                    }
                    else
                    {
                        DB::table('stock_verifications')
                        ->where('verify_pdn_id', '=', get_last_production_id())
                        ->where('verify_prd_id', '=', $prd_id)
                        ->where('verify_is_product', '=', 1)
                        ->where('verify_user_type', '=', session('typ_id'))
                        ->update([
                            'verify_closing' => $request->$total_input,
                            'verify_closing_filled' => $request->$filled_input,
                            'verify_closing_empty' => $request->$empty_input,
                            'verify_closing_leakers' => $request->$leakers_input,
                            'verify_closing_for_revalving' => $request->$for_revalving_input,
                            'verify_closing_scraps' => $request->$scrap_input,
                            'verify_user_id' => session('usr_id')
                        ]);

                        $is_updated = true;
                    }
                }

                foreach($tank_details as $tnk_id)
                {
                    $input_field = "verify_tank_remaining" . $tnk_id;

                    $verification_check = DB::table('stock_verifications')
                    ->where('verify_acc_id', '=', session('acc_id'))
                    ->where('verify_prd_id', '=', $tnk_id)
                    ->where('verify_pdn_id', '=', get_last_production_id())
                    ->where('verify_user_type', '=', session('typ_id'))
                    ->first();
                    
                    if(session('typ_id') == 4)
                    {
                        if(!$this->check_supervisor_verification($prd_id, get_last_production_id()))
                        {
                            session()->flash('errorMessage','Supervisors must verify first!');
                            return redirect()->action('ProductionController@manage');
                        }
                    }

                    if($verification_check == '' || $verification_check == null)
                    {
                        DB::table('stock_verifications')
                        ->insert([
                            'verify_prd_id' => $tnk_id,
                            'verify_closing' => ($request->$input_field) * 1000,
                            'verify_is_product' => 0,
                            'verify_pdn_id' => get_last_production_id(),
                            'verify_acc_id' => session('acc_id'),
                            'verify_user_type' => session('typ_id'),
                            'verify_user_id' => session('usr_id')
                        ]);  

                        $is_added = true;
                    }
                    else
                    {
                        DB::table('stock_verifications')
                        ->where('verify_pdn_id', '=', get_last_production_id())
                        ->where('verify_prd_id', '=', $tnk_id)
                        ->where('verify_is_product', '=', 0)
                        ->update([
                            'verify_closing' => ($request->$input_field) * 1000,
                            'verify_user_id' => session('usr_id')
                        ]);

                        $is_updated = true;
                    }
                }
            }

            if($is_added == true && $is_updated == false)
            {
                session()->flash('successMessage','Verification added!');
            }

            if($is_added == false && $is_updated == true)
            {
                session()->flash('successMessage','Verification updated!');
            }

            if($is_added == true && $is_updated == true)
            {
                session()->flash('successMessage','Verification added and updated!');
            }

            return redirect()->action('ProductionController@manage');
        }
    }
    
    public function createProduct(Request $request)
    {
        $prd_name = $request->prd_name;
        $prd_description = $request->prd_description;
        $prd_sku = $request->prd_sku;
        $prd_for_tank = $request->for_tank;
        $prd_type = $request->prd_type;
        $prd_price = $request->prd_price;
        $prd_deposit = $request->prd_deposit;
        $prd_weight = $request->prd_weight;
        $prd_reorder = $request->prd_reorder;
        $sup_id = $request->sup_id;
        $selected_valve = $request->valve;
        $selected_seal = $request->seal;
        $prd_components = "";
        $prd_seals = "";
        
        $prodValues = array(
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            $request->show_modal,
            $request->tab_1,
            $request->tab_2,
            $request->prd_type
        );

        // dd($prd_type);
        
        $sku_checker = DB::table('products')
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_sku','=',$prd_sku)
        ->first();

        if($sku_checker != null)
        {
            session()->flash('errorMessage','Product with this SKU already exists');
            return redirect()->action('ProductionController@manage');
        }

        //FLAGS
        // 0 = quantity raw materials
        // 1 = empty goods

        if($prd_type == 0)
        {
            DB::table('products')
            ->insert([
            'prd_name'=> $prd_name,
            'acc_id' => session('acc_id'),
            'prd_uuid' => generateuuid(),
            'prd_sku' => $prd_sku,
            'prd_description' => $prd_description,
            'prd_reorder_point' => $prd_reorder,
            'prd_for_production' => 1,
            'prd_for_POS' => 0,
            'prd_is_refillable' => 0,
            'prd_for_tank' => $prd_for_tank,
            'sup_id' => $sup_id
            ]);
        }
        elseif($prd_type == 1)
        {
            // $get_components = "";

            // if(!is_null($components)){
            //     foreach ($components as $component) {
            //         $get_components =  $component .",". $get_components;
            //     }
            //     $prd_components = substr($get_components, 0, strlen($get_components) - 1);
            // }
            // else
            // {
            //     session()->flash('getProdValues', array( $prodValues));
            //     session()->flash('errorMessage','Canister products must contain a component!');
            //     return redirect()->action('ProductionController@manage');
            // }

            // $get_seals = "";

            // if(!is_null($seals)){
            //     foreach ($seals as $seal) {
            //         $get_seals =  $seal .",". $get_seals;
            //     }
            //     $prd_seals = substr($prd_seals, 0, strlen($prd_seals) - 1);
            // }

            DB::table('products')
            ->insert([
            'prd_name'=> $prd_name,
            'acc_id' => session('acc_id'),
            'prd_uuid' => generateuuid(),
            'prd_description' => $prd_description,
            'prd_sku' => $prd_sku,
            'prd_price' => $prd_price,
            'prd_deposit' => $prd_deposit,
            'prd_weight' => $prd_weight,
            'prd_reorder_point' => $prd_reorder,
            'prd_for_production' => 1,
            'prd_for_POS' => 1,
            'prd_is_refillable' => 1,
            'prd_for_tank' => $prd_for_tank,
            'prd_components' => $selected_valve,
            'prd_seals' => $selected_seal,
            'sup_id' => $sup_id
            ]);

            $products = DB::table('products')
            ->orderBy('prd_id', 'desc')
            ->first();
            
            DB::table('stocks_logs')
            ->insert([
                'acc_id' => session('acc_id'),
                'prd_id' => $products->prd_id,
                'pdn_id' => get_last_production_id()
            ]);
        }

        if($request->file('prd_image'))
        {
            $prd_id = DB::table('products')
            ->where('acc_id', '=', session('acc_id'))
            ->select('prd_id')
            ->orderBy('prd_id', 'desc')
            ->first();

            $file = $request->file('prd_image');

            $validator = Validator::make( 
                [
                    'file' => $file,
                    'extension' => strtolower($file->getClientOriginalExtension()),
                ],
                [
                    'file' => 'required',
                    'file' => 'max:3072', //3MB
                    'extension' => 'required|in:jpg,png,gif',
                ]
            );
            
            // dd(public_path());
    
            if ($validator->fails()) 
            {
                session()->flash('errorMessage',  "Invalid File Extension or maximum size limit of 5MB reached!");
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            $fileName = $prd_id->prd_id . '.' . $file->getClientOriginalExtension();
    
            Storage::disk('local')->put('img/products/' . $fileName, fopen($file, 'r+'));

            DB::table('products')
            ->where('acc_id', '=', session('acc_id'))
            ->where('prd_id','=',$prd_id->prd_id)
            ->update([
                'prd_image' => $fileName,
            ]);  
        }

        session()->flash('getProdValues', array( $prodValues));
        session()->flash('successMessage','Raw material has been added');
        return redirect()->action('ProductionController@manage');
    }

    //ADD QUANTITY FOR ITEMS
    public function addQuantity(Request $request)
    {
        $trx_id = DB::table('transactions')
        ->max('trx_id');

        if($trx_id == null){
            $trx_id = 1;
        }
        else{
            $trx_id += 1;
        }

        $prd_id = $request->stockin_prd_id;
        $prd_quantity = $request->quantity + ($request->crate_quantity * 12);
        $flag = $request->stockin_flag;
        $tnk_id = $request->selected_tank;
        
        if($prd_quantity <= 0){
            session()->flash('errorMessage','Invalid input!');

            if($request->return_page == "pos"){
                return redirect()->action('SalesController@main');
            }
            else{
                return redirect()->action('ProductionController@manage');
            }
        }

        record_stockin($prd_id, $prd_quantity);
        
        $quantity = DB::table('products')
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_id', '=', $prd_id)
        ->first();
        
        $raw_materials = DB::table('products')
        ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','0')
        ->get();

        $stocks_logs = DB::table('stocks_logs')
        ->where('prd_id','=',$prd_id)
        ->where('acc_id','=', session('acc_id'))
        ->where('pdn_id', '=', get_last_production_id())
        ->first();

        if($quantity->prd_is_refillable == 1){
            $stocks_logs = DB::table('stocks_logs')
            ->where('acc_id', '=', session('acc_id'))
            ->where('prd_id','=', $prd_id)
            ->where('pdn_id', '=', get_last_production_id())
            ->first();
            // dd($stocks_logs);
            if($stocks_logs == null)
            {
                DB::table('stocks_logs')
                ->insert([
                    'acc_id' => session('acc_id'),
                    'prd_id' => $prd_id,
                    'pdn_id' => get_last_production_id()
                ]);
            }
        }

        //FLAGS
        // 0 = quantity raw materials
        // 1 = empty goods
        // 2 = filled canisters
        // 3 = bad order
        // 4 = decant and revalve
        // 5 = scrap
        // 6 = leakers
        // 7 = for revalving
        // 8 = disposal

        $prodValues = array(
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            $request->show_modal, 
            $request->tab_1,
            $request->tab_2
        );

        // dd($prodValues);
        if($flag == 0)
        {
            //ADD QUANTITY TO RAW MATERIALS
            if($quantity->prd_is_refillable == 1){
                $new_quantity = (float)$quantity->prd_raw_can_qty + $prd_quantity;
                
                DB::table('products')
                ->where('prd_id','=',$prd_id)
                ->update([
                    'prd_raw_can_qty' => (float)$new_quantity
                ]);  

                // SUBTRACT FROM RAW MATERIALS
                subtract_qty($flag, $prd_quantity, $prd_id);

                //LOG ACTION IN PRODUCTION
                record_movement($prd_id, $prd_quantity, $flag);

                //ADD LOGS TO STOCKS_LOGS FOR CANISTER MOVEMENT TRACKING
                DB::table('stocks_logs')
                ->where('prd_id','=',$prd_id)
                ->where('acc_id','=', session('acc_id'))
                ->where('pdn_id', '=', get_last_production_id())
                ->update([
                    'stk_raw_materials' => (float)$stocks_logs->stk_raw_materials + (float)$prd_quantity
                ]);  
            }
            else
            {
                $new_quantity = (float)$quantity->prd_quantity + $prd_quantity;
                
                DB::table('products')
                ->where('prd_id','=',$prd_id)
                ->update([
                    'prd_quantity' => (float)$new_quantity
                ]);  
            }

            session()->flash('getProdValues', array( $prodValues));
            session()->flash('successMessage','Raw materials added');
            return redirect()->action('ProductionController@manage');
        }

        elseif($flag == 1)
        {
            if(!($this->check_has_valve($prd_id)))
            {
                session()->flash('getProdValues', array( $prodValues));
                session()->flash('errorMessage','Valve not found! Check canister info for valve selection');
                return redirect()->action('ProductionController@manage');
            }

            if(!($this->check_valve_quantity($prd_id, $prd_quantity)))
            {
                session()->flash('getProdValues', array( $prodValues));
                session()->flash('errorMessage','Valves insufficient!');
                return redirect()->action('ProductionController@manage');
            }

            if(check_materials($flag, $prd_quantity, $prd_id))
            {
                //ADD QUANTITY TO EMPTY GOODS
                (float)$new_quantity = (float)$quantity->prd_empty_goods + $prd_quantity;
                
                DB::table('products')
                ->where('prd_id','=',$prd_id)
                ->update([
                    'prd_empty_goods' => $new_quantity
                ]);

                // SUBTRACT FROM RAW MATERIALS
                subtract_qty($flag, $prd_quantity, $prd_id);

                //LOG ACTION IN PRODUCTION
                record_movement($prd_id, $prd_quantity, $flag);

                //ADD LOGS TO STOCKS_LOGS FOR CANISTER MOVEMENT TRACKING
                DB::table('stocks_logs')
                ->where('prd_id','=',$prd_id)
                ->where('acc_id','=', session('acc_id'))
                ->where('pdn_id', '=', get_last_production_id())
                ->update([
                    'stk_empty_goods' => (float)$stocks_logs->stk_empty_goods + (float)$prd_quantity
                ]); 
                
                //SUBTRACT LOGS FROM RAW MATERIALS IN STOCKS_LOGS FOR EMPTY GOODS
                $stock_in_quantity = 0;

                if(!($stocks_logs->stk_raw_materials - (float)$prd_quantity < $stocks_logs->stk_raw_materials))
                {
                    $stock_in_quantity = $stocks_logs->stk_raw_materials - (float)$prd_quantity;
                }

                DB::table('stocks_logs')
                ->where('prd_id','=',$prd_id)
                ->where('acc_id','=', session('acc_id'))
                ->where('pdn_id', '=', get_last_production_id())
                ->update([
                    'stk_raw_materials' => $stock_in_quantity
                ]);  


                session()->flash('getProdValues', array( $prodValues));
                session()->flash('successMessage','Empty goods added');
                return redirect()->action('ProductionController@manage');
            } 
            else
            {
                session()->flash('getProdValues', array( $prodValues));
                session()->flash('errorMessage','Raw materials insufficient!');
                return redirect()->action('ProductionController@manage');
            }  
        }
        
        elseif($flag == 2)
        {
            if(!($this->check_has_seal($prd_id)))
            {
                session()->flash('getProdValues', array( $prodValues));
                session()->flash('errorMessage','Seal not found! Check canister info for seal selection');
                return redirect()->action('ProductionController@manage');
            }

            if(!($this->check_seal_quantity($prd_id, $prd_quantity)))
            {
                session()->flash('getProdValues', array( $prodValues));
                session()->flash('errorMessage','Seal insufficient!');
                return redirect()->action('ProductionController@manage');
            }

            if($this->check_gas_quantity($tnk_id, $prd_id, $prd_quantity))
            {
                if(check_materials($flag, $prd_quantity, $prd_id))
                {
                    //ADD QUANTITY TO FILLED 
                    (float)$new_quantity = (float)$quantity->prd_quantity + $prd_quantity;

                    $tank = DB::table('tanks')
                    ->where('tnk_id', '=', $tnk_id)
                    ->first();

                    //IF TANK QUANTITY IS LESS THAN 0
                    if($tank->tnk_remaining - ($quantity->prd_weight * $prd_quantity) < 0)
                    {

                    }

                    $tank_quantity = $tank->tnk_remaining - ($quantity->prd_weight * $prd_quantity);

                    DB::table('tanks')
                    ->where('tnk_id', '=', $tnk_id)
                    ->update([
                        'tnk_remaining' => $tank_quantity
                    ]);

                    DB::table('products')
                    ->where('prd_id','=',$prd_id)
                    ->update([
                        'prd_quantity' => $new_quantity
                    ]);  

                    //SUBTRACT FROM RAW MATERIALS
                    subtract_qty($flag, $prd_quantity, $prd_id);

                    //LOG ACTION IN PRODUCTION
                    record_movement($prd_id, $prd_quantity, $flag);

                    //ADD LOGS TO STOCKS_LOGS FOR CANISTER MOVEMENT TRACKING
                    //ADD QUANTITY TO FILLED
                    DB::table('stocks_logs')
                    ->where('prd_id','=',$prd_id)
                    ->where('acc_id','=', session('acc_id'))
                    ->where('pdn_id', '=', get_last_production_id())
                    ->update([
                    'stk_filled' => (float)$stocks_logs->stk_filled + (float)$prd_quantity
                    ]);  

                    //SUBTRACT QUANTITY FROM EMPTY
                    $stock_in_quantity = 0;

                    if(!($stocks_logs->stk_raw_materials - (float)$prd_quantity < $stocks_logs->stk_raw_materials))
                    {
                        $stock_in_quantity = $stocks_logs->stk_raw_materials - (float)$prd_quantity;
                    }

                    DB::table('stocks_logs')
                    ->where('prd_id','=',$prd_id)
                    ->where('acc_id','=', session('acc_id'))
                    ->where('pdn_id', '=', get_last_production_id())
                    ->update([
                    'stk_empty_goods' => $stock_in_quantity
                    ]);  

                    session()->flash('getProdValues', array( $prodValues));
                    session()->flash('successMessage','Canister added');
                    return redirect()->action('ProductionController@manage');
                } 
                else
                {
                    session()->flash('getProdValues', array( $prodValues));
                    session()->flash('errorMessage','Empty goods insufficient!');
                    return redirect()->action('ProductionController@manage');
                }
            }
            else
            {
                session()->flash('errorMessage','Tank LPG insufficient!');
                return redirect()->action('ProductionController@manage');
            }
        }

        elseif($flag == 3)
        {
            //ADD QUANTITY TO LEAKERS FROM SELLER RETURNS
            $trx_ref_id = $request->trx_ref_id;
            (float)$new_quantity = (float)$quantity->prd_leakers + $prd_quantity;
            (float)$deduct_backflushed = (float)$quantity->prd_quantity - $prd_quantity;
            
            $bo_transaction = DB::table('transactions')
            ->join('purchases', 'purchases.trx_id', '=', 'transactions.trx_id')
            ->where('acc_id', '=', session('acc_id'))
            ->where('trx_ref_id', '=', $trx_ref_id)
            ->where('trx_active','=','1')
            ->get();

            if(empty($bo_transaction[0])) {
                session()->flash('warningMessage','Please check your inputs');
                
                if($request->return_page == "pos"){
                    return redirect()->action('SalesController@main');
                }
                else{
                    return redirect()->action('ProductionController@manage');
                }
            }
            else{
                $has_this_prd = DB::table('transactions')
                ->join('purchases', 'purchases.trx_id', '=', 'transactions.trx_id')
                ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
                ->where('trx_ref_id', '=', $trx_ref_id)
                ->where('purchases.prd_id', '=', $prd_id)
                ->get();

                if(empty($has_this_prd[0])) {
                    session()->flash('errorMessage','No purchases with this product');

                    if($request->return_page == "pos"){
                        return redirect()->action('SalesController@main');
                    }
                    else{
                        return redirect()->action('ProductionController@manage');
                    }
                }
                else{
                    if($prd_quantity > 0){
                        if($prd_quantity <= $has_this_prd[0]->pur_qty){
                            $crate_quantity = $request->crate_quantity;
                            $quantity = $request->quantity;
            
                            if($crate_quantity == null && $quantity == null){
                                session()->flash('warningMessage','Please check your inputs');
                            }
                            else{
                                DB::table('products') 
                                ->where('prd_id','=',$prd_id)
                                ->update([
                                    'prd_leakers' => $new_quantity,
                                    'prd_quantity' => $deduct_backflushed
                                ]);
            
                                $max_bo_id = DB::table('bad_orders')
                                ->max('bo_id');
            
                                $new_bo_id = $max_bo_id + 1;
                                $bo_ref_id = "BO-". date('Y') . date('m') . date('d') . "-" . $new_bo_id;
                                
                                DB::table('bad_orders')
                                ->insert([
                                    'acc_id' => session('acc_id'),
                                    'bo_ref_id' => $bo_ref_id,
                                    'trx_id' => $bo_transaction[0]->trx_id,
                                    'bo_crates' => $request->crate_quantity,
                                    'prd_id' => $prd_id,
                                    'bo_loose' => $request->quantity,
                                    'bo_date' => date('Y-m-d'),
                                    'bo_time' => date('H:i:s'),
                                    'bo_datetime' => date('Y-m-d H:i:s')
                                ]);
                                
                                session(['latest_bo_id' => $new_bo_id ]); 
                                
                                if($has_this_prd[0]->prd_is_refillable == 1){
                                    //LOG ACTION IN PRODUCTION
                                    record_movement($prd_id, $prd_quantity, $flag);
    
                                    //ADD LOGS TO STOCKS_LOGS FOR CANISTER MOVEMENT TRACKING
                                    DB::table('stocks_logs')
                                    ->where('prd_id','=',$prd_id)
                                    ->where('acc_id','=', session('acc_id'))
                                    ->where('pdn_id', '=', get_last_production_id())
                                    ->update([
                                        'stk_leakers' => (float)$stocks_logs->stk_leakers + (float)$prd_quantity
                                    ]);  
                                }

                                session()->flash('successMessage','Leakers added');
                                session(['return_page' =>$request->return_page]);
                                return redirect()->action('PrintController@badorderReceipt');
                            }
                        }
                        else{
                            session()->flash('errorMessage','Number of leakers must not exceed to the purchased quantity');
                            
                            if($request->return_page == "pos"){
                                return redirect()->action('SalesController@main');
                            }
                            else{
                                return redirect()->action('ProductionController@manage');
                            }
                        }
                    }
                    else{
                        session()->flash('errorMessage','Invalid input');

                        if($request->return_page == "pos"){
                            return redirect()->action('SalesController@main');
                        }
                        else{
                            return redirect()->action('ProductionController@manage');
                        }
                    }
                }
            }
            
            session()->flash('getProdValues', array( $prodValues));      

        }

        elseif($flag == 4)
        {
            if(check_materials($flag, $prd_quantity, $prd_id))
            {
                //ADD QUANTITY FROM LEAKERS TO REVALVING 
                (float)$new_quantity = (float)$quantity->prd_empty_goods + $prd_quantity;
                
                DB::table('products')
                ->where('prd_id','=',$prd_id)
                ->update([
                    'prd_empty_goods' => $new_quantity
                ]);

                $canister_details = DB::table('products')
                ->where('acc_id', '=', session('acc_id'))
                ->where('prd_id', '=', $prd_id)
                ->first();
                
                $valve_details = DB::table('products')
                ->where('acc_id', '=', session('acc_id'))
                ->where('prd_id', '=', $canister_details->prd_components)
                ->first();

                //SUBTRACT QUANTITY FROM LEAKERS
                subtract_qty($flag, $prd_quantity, $prd_id);

                //SUBTRACT 1 VALVE FOR REVALVING
                DB::table('products')
                ->where('acc_id', '=', session('acc_id'))
                ->where('prd_id', '=', $valve_details->prd_id)
                ->update([
                    'prd_quantity' => $valve_qty = $valve_details->prd_quantity - 1
                ]);

                //LOG ACTION IN PRODUCTION
                record_movement($prd_id, $prd_quantity, $flag);

                //ADD LOGS TO STOCKS_LOGS FOR CANISTER MOVEMENT TRACKING
                //ADD QUANTITY TO EMPTY GOODS
                DB::table('stocks_logs')
                ->where('prd_id','=',$prd_id)
                ->where('acc_id','=', session('acc_id'))
                ->where('pdn_id', '=', get_last_production_id())
                ->update([
                'stk_empty_goods' => (float)$stocks_logs->stk_filled + (float)$prd_quantity
                ]);  

                //SUBTRACT QUANTITY FROM LEAKERS
                $stock_in_quantity = 0;

                if(!($stocks_logs->stk_raw_materials - (float)$prd_quantity < $stocks_logs->stk_raw_materials))
                {
                    $stock_in_quantity = $stocks_logs->stk_raw_materials - (float)$prd_quantity;
                }
                
                DB::table('stocks_logs')
                ->where('prd_id','=',$prd_id)
                ->where('acc_id','=', session('acc_id'))
                ->where('pdn_id', '=', get_last_production_id())
                ->update([
                'stk_empty_goods' => $stock_in_quantity
                ]);  

                session()->flash('getProdValues', array( $prodValues));
                session()->flash('successMessage','Canisters decanted and revalved');
                return redirect()->action('ProductionController@manage');
            }
            else
            {
                session()->flash('getProdValues', array( $prodValues));
                session()->flash('errorMessage','Canisters for revalving insufficient!');
                return redirect()->action('ProductionController@manage');
            }
        }

        elseif($flag == 5)
        {
            if(check_materials($flag, $prd_quantity, $prd_id))
            {
                //ADD QUANTITY TO SCRAPS FROM LEAKERS
                (float)$new_quantity = (float)$quantity->prd_scraps + $prd_quantity;
                
                DB::table('products')
                ->where('prd_id','=',$prd_id)
                ->update([
                    'prd_scraps' => $new_quantity
                ]);  

                //SUBTRACT QUANTITY FROM LEAKERS
                subtract_qty($flag, $prd_quantity, $prd_id);
                
                //LOG ACTION IN PRODUCTION
                record_movement($prd_id, $prd_quantity, $flag);

                //ADD LOGS TO STOCKS_LOGS FOR CANISTER MOVEMENT TRACKING
                //ADD QUANTITY FROM LEAKERS
                DB::table('stocks_logs')
                ->where('prd_id','=',$prd_id)
                ->where('acc_id','=', session('acc_id'))
                ->where('pdn_id', '=', get_last_production_id())
                ->update([
                'stk_scraps' => (float)$stocks_logs->stk_scraps + (float)$prd_quantity
                ]);  

                //SUBTRACT QUANTITY TO EMPTY GOODS
                $stock_in_quantity = 0;

                if(!($stocks_logs->stk_raw_materials - (float)$prd_quantity < $stocks_logs->stk_raw_materials))
                {
                    $stock_in_quantity = $stocks_logs->stk_raw_materials - (float)$prd_quantity;
                }
                
                DB::table('stocks_logs')
                ->where('prd_id','=',$prd_id)
                ->where('acc_id','=', session('acc_id'))
                ->where('pdn_id', '=', get_last_production_id())
                ->update([
                'stk_leakers' => $stock_in_quantity
                ]);  

                session()->flash('getProdValues', array( $prodValues));
                session()->flash('successMessage','Leakers sent as Scraps');
                return redirect()->action('ProductionController@manage');
                }
            else
            {
                session()->flash('getProdValues', array( $prodValues));
                session()->flash('errorMessage','Leakers insufficient!');
                return redirect()->action('ProductionController@manage');
            }
            
        }

        elseif($flag == 6)
        {
            if(check_materials($flag, $prd_quantity, $prd_id))
            {
                //ADD QUANTITY TO LEAKERS FROM SELLER RETURNS
                (float)$new_quantity = (float)$quantity->prd_leakers + $prd_quantity;
                            
                DB::table('products')
                ->where('prd_id','=',$prd_id)
                ->update([
                    'prd_leakers' => $new_quantity
                ]);  

                //SUBTRACT QUANTITY FROM LEAKERS
                subtract_qty($flag, $prd_quantity, $prd_id);

                //LOG ACTION IN PRODUCTION
                record_movement($prd_id, $prd_quantity, $flag);
                
                //ADD LOGS TO STOCKS_LOGS FOR CANISTER MOVEMENT TRACKING
                //ADD QUANTITY FROM LEAKERS
                DB::table('stocks_logs')
                ->where('prd_id','=',$prd_id)
                ->where('acc_id','=', session('acc_id'))
                ->where('pdn_id', '=', get_last_production_id())
                ->update([
                'stk_leakers' => (float)$stocks_logs->stk_leakers + (float)$prd_quantity
                ]);  

                //SUBTRACT QUANTITY TO EMPTY GOODS
                $stock_in_quantity = 0;

                if(!($stocks_logs->stk_raw_materials - (float)$prd_quantity < $stocks_logs->stk_raw_materials))
                {
                    $stock_in_quantity = $stocks_logs->stk_raw_materials - (float)$prd_quantity;
                }
                
                DB::table('stocks_logs')
                ->where('prd_id','=',$prd_id)
                ->where('acc_id','=', session('acc_id'))
                ->where('pdn_id', '=', get_last_production_id())
                ->update([
                'stk_filled' => $stock_in_quantity
                ]);  
                
                session()->flash('getProdValues', array( $prodValues));
                session()->flash('successMessage','Leakers added');
                return redirect()->action('ProductionController@manage');
            }
            else
            {
                session()->flash('getProdValues', array( $prodValues));
                session()->flash('errorMessage','Backflushed insufficient!');
                return redirect()->action('ProductionController@manage');
            }
        }

        elseif($flag == 7)
        {
            if(check_materials($flag, $prd_quantity, $prd_id))
            {
                //ADD QUANTITY TO FOR_REVALVING FROM LEAKERS
                (float)$new_quantity = (float)$quantity->prd_for_revalving + $prd_quantity;
                            // dd($new_quantity, $quantity->prd_for_revalving, $prd_quantity);
                DB::table('products')
                ->where('prd_id','=',$prd_id)
                ->update([
                    'prd_for_revalving' => $new_quantity
                ]);  

                //SUBTRACT QUANTITY FROM LEAKERS
                subtract_qty($flag, $prd_quantity, $prd_id);

                //LOG ACTION IN PRODUCTION
                record_movement($prd_id, $prd_quantity, $flag);
                
                //ADD LOGS TO STOCKS_LOGS FOR CANISTER MOVEMENT TRACKING
                //ADD QUANTITY FROM LEAKERS
                DB::table('stocks_logs')
                ->where('prd_id','=',$prd_id)
                ->where('acc_id','=', session('acc_id'))
                ->where('pdn_id', '=', get_last_production_id())
                ->update([
                'stk_for_revalving' => (float)$stocks_logs->stk_for_revalving + (float)$prd_quantity
                ]);  

                //SUBTRACT QUANTITY TO EMPTY GOODS
                $stock_in_quantity = 0;

                if(!($stocks_logs->stk_raw_materials - (float)$prd_quantity < $stocks_logs->stk_raw_materials))
                {
                    $stock_in_quantity = $stocks_logs->stk_raw_materials - (float)$prd_quantity;
                }
                
                DB::table('stocks_logs')
                ->where('prd_id','=',$prd_id)
                ->where('acc_id','=', session('acc_id'))
                ->where('pdn_id', '=', get_last_production_id())
                ->update([
                'stk_leakers' => $stock_in_quantity
                ]);  

                session()->flash('getProdValues', array( $prodValues));
                session()->flash('successMessage','Canisters added for revalving');
                return redirect()->action('ProductionController@manage');
            }
            else
            {
                session()->flash('getProdValues', array( $prodValues));
                session()->flash('errorMessage','Leakers insufficient!');
                return redirect()->action('ProductionController@manage');
            }
        }

        elseif($flag == 8)
        {
            if(check_materials($flag, $prd_quantity, $prd_id))
            {
                //SUBTRACT QUANTITY FROM SCRAPS
                subtract_qty($flag, $prd_quantity, $prd_id);
                
                //LOG ACTION IN PRODUCTION
                record_movement($prd_id, $prd_quantity, $flag);

                //ADD LOGS TO STOCKS_LOGS FOR CANISTER MOVEMENT TRACKING
                //ADD QUANTITY FROM LEAKERS
                DB::table('stocks_logs')
                ->where('prd_id','=',$prd_id)
                ->where('acc_id','=', session('acc_id'))
                ->where('pdn_id', '=', get_last_production_id())
                ->update([
                'stk_scraps' => (float)$stocks_logs->stk_scraps + (float)$prd_quantity
                ]);  

                //SUBTRACT QUANTITY TO EMPTY GOODS
                $stock_in_quantity = 0;

                if(!($stocks_logs->stk_raw_materials - (float)$prd_quantity < $stocks_logs->stk_raw_materials))
                {
                    $stock_in_quantity = $stocks_logs->stk_raw_materials - (float)$prd_quantity;
                }
                
                DB::table('stocks_logs')
                ->where('prd_id','=',$prd_id)
                ->where('acc_id','=', session('acc_id'))
                ->where('pdn_id', '=', get_last_production_id())
                ->update([
                'stk_leakers' => $stock_in_quantity
                ]);  

                session()->flash('getProdValues', array( $prodValues));
                session()->flash('successMessage', $prd_quantity . ' scrap/s disposed');
                return redirect()->action('ProductionController@manage');
            }
            else
            {
                session()->flash('getProdValues', array( $prodValues));
                session()->flash('errorMessage','Scraps insufficient!');
                return redirect()->action('ProductionController@manage');
            }
            
        }

        session()->flash('getProdValues', array( $prodValues));
    } 
    
    //EDIT EMPTY GOOD
    public function editEmptygoods(Request $request)
    {
        $prd_id = $request->prd_id;
        $prd_empty_goods = $request->prd_empty_goods;
        
        DB::table('products')
        ->where('prd_id', '=', $prd_id)
        ->where('acc_id','=', session('acc_id'))
        ->update([
            'prd_empty_goods' => $prd_empty_goods
        ]);
        // dd($quantity);
        session()->flash('successMessage','Empty quantity has been updated.');
        return redirect()->action('ProductionController@manage');
    }
     
    //EDIT FILLED GOOD
    public function editFilled(Request $request)
    {
        $prd_id = $request->prd_id;
        $prd_quantity = $request->prd_quantity;
        
        DB::table('products')
        ->where('prd_id', '=', $prd_id)
        ->where('acc_id','=', session('acc_id'))
        ->update([
            'prd_quantity' => $prd_quantity
        ]);
        // dd($quantity);
        session()->flash('successMessage','Filled quantity has been updated.');
        return redirect()->action('ProductionController@manage');
    }
     
    //EDIT EMPTY GOOD
    public function editLeakers(Request $request)
    {
        $prd_id = $request->prd_id;
        $prd_leakers = $request->prd_leakers;
        
        DB::table('products')
        ->where('prd_id', '=', $prd_id)
        ->where('acc_id','=', session('acc_id'))
        ->update([
            'prd_leakers' => $prd_leakers
        ]);
        // dd($quantity);
        session()->flash('successMessage','Leakers quantity has been updated.');
        return redirect()->action('ProductionController@manage');
    }

    //EDIT FOR REVALVING
    public function editRevalving(Request $request)
    {
        $prd_id = $request->prd_id;
        $prd_for_revalving = $request->prd_for_revalving;
        
        DB::table('products')
        ->where('prd_id', '=', $prd_id)
        ->where('acc_id','=', session('acc_id'))
        ->update([
            'prd_for_revalving' => $prd_for_revalving
        ]);
        // dd($quantity);
        session()->flash('successMessage','Revalving quantity has been updated.');
        return redirect()->action('ProductionController@manage');
    }

    //EDIT FOR SCRAP
    public function editScraps(Request $request)
    {
        $prd_id = $request->prd_id;
        $prd_scraps = $request->prd_scraps;
        
        DB::table('products')
        ->where('prd_id', '=', $prd_id)
        ->where('acc_id','=', session('acc_id'))
        ->update([
            'prd_scraps' => $prd_scraps
        ]);
        // dd($quantity);
        session()->flash('successMessage','Scaps quantity has been updated.');
        return redirect()->action('ProductionController@manage');
    }

    //EDIT PRODUCTION ITEMS
    public function editItem(Request $request)
    {
        $prd_id = $request->prd_id;
        $prd_name = $request->prd_name;
        $prd_description = $request->prd_description;
        $prd_sku = $request->prd_sku;
        $prd_type = $request->prd_type;
        $prd_price = $request->prd_price;
        $prd_deposit = $request->prd_deposit;
        $prd_weight = $request->prd_weight;
        $prd_reorder = $request->prd_reorder;
        $sup_id = $request->sup_id;
        $prd_uuid = $request->prd_uuid;
        $prd_quantity = (float)$request->prd_quantity;
        $selected_valve = $request->valve;
        $selected_seal = $request->seal;
        $prd_components = "";

        $prodValues = array(
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            $request->show_modal,
            $request->tab_1,
            $request->tab_2,
            $request->prd_type
        );

        $sku_checker = DB::table('products')
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_uuid', '<>', $prd_uuid)
        ->where('prd_sku','=',$prd_sku)
        ->first();

        if($sku_checker != null)
        {
            session()->flash('errorMessage','Product with this SKU already exists');
            return redirect()->action('ProductController@manage');
        }

        $qty_checker = DB::table('products')
        ->where('prd_id', '=', $prd_id)
        ->select('prd_quantity')
        ->first();

        // if($qty_checker->prd_quantity > $prd_quantity)
        // {
        //     $subtracted_qty = $qty_checker->prd_quantity - $prd_quantity;
        //     (float)$prd_quantity = "-" . $subtracted_qty;
            
        //     DB::table('products')
        //     ->where('prd_id', '=', $prd_id)
        //     ->update([
        //         'prd_quantity' => $qty_checker->prd_quantity - $subtracted_qty
        //     ]);
            
        //     record_stockin($prd_id, $prd_quantity);
        // }
        
        if($prd_type == 0)
        {
            // dd("asd");
            DB::table('products')
            ->where('prd_id', '=', $prd_id)
            ->update([
                'prd_name' => $prd_name,
                'prd_description' => $prd_description,
                'prd_sku' => $prd_sku,
                'prd_reorder_point' => $prd_reorder,
                'prd_for_POS' => 0,
                'prd_is_refillable' => 0, 
                'prd_components' => null, 
                'prd_seals' => null, 
                'sup_id' => $sup_id
            ]);
        }
        elseif($prd_type == 1)
        {
            // $get_components = "";

            // if(!is_null($components)){
            //     foreach ($components as $component) {
            //         $get_components =  $component .",". $get_components;
            //     }
            //     $prd_components = substr($get_components, 0, strlen($get_components) - 1);
            // }

            DB::table('products')
            ->where('prd_id', '=', $prd_id)
            ->update([
                'prd_name'=> $prd_name,
                'prd_description' => $prd_description,
                'prd_sku' => $prd_sku,
                'prd_price' => $prd_price,
                'prd_deposit' => $prd_deposit,
                'prd_weight' => $prd_weight,
                'prd_reorder_point' => $prd_reorder,
                'prd_for_production' => 1,
                'prd_for_POS' => 1,
                'prd_is_refillable' => 1,
                'prd_components' => $selected_valve,
                'prd_seals' => $selected_seal,
                'sup_id' => $sup_id
            ]);
        }

        if($request->file('prd_image'))
        {
            $file = $request->file('prd_image');

            $validator = Validator::make( 
                [
                    'file' => $file,
                    'extension' => strtolower($file->getClientOriginalExtension()),
                ],
                [
                    'file' => 'required',
                    'file' => 'max:3072', //3MB
                    'extension' => 'required|in:jpg,png,gif',
                ]
            );
            
            // dd(public_path());
    
            if ($validator->fails()) 
            {
                session()->flash('errorMessage',  "Invalid File Extension or maximum size limit of 5MB reached!");
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            $fileName = $request->prd_id . '.' . $file->getClientOriginalExtension();
    
            Storage::disk('local')->put('img/products/' . $fileName, fopen($file, 'r+'));

            DB::table('products')
            ->where('prd_id','=',$request->prd_id)
            ->update([
                'prd_image' => $fileName,
            ]);  
        }
        session()->flash('successMessage','Product details updated.');
        return redirect()->action('ProductionController@manage');
    }

    //ACTIVATION CONTROLLER
    public function activateProduct($prd_uuid)
    {
        $active_checker = DB::table('products')
        ->where('prd_uuid','=',$prd_uuid)
        ->first();

        // dd($active_checker);
        if($active_checker->prd_active == 0)
        {
            DB::table('products')
            ->where('prd_uuid', '=', $prd_uuid)
            ->update([
                'prd_active' => 1
            ]);    

            session()->flash('successMessage','Product reactivated');
            return redirect()->action('ProductionController@manage');
        }
        else
        {
            DB::table('products')
            ->where('prd_uuid', '=', $prd_uuid)
            ->update([
                'prd_active' => 0
            ]);

            session()->flash('successMessage','Product deactivated');
            return redirect()->action('ProductionController@manage');
        }
    }
    
    //CREATE SUPPLIER
    public function createSupplier(Request $request)
    {
        $sup_name = $request->sup_name;
        $sup_address = $request->sup_address;
        $sup_contact = $request->sup_contact;
        $sup_notes = $request->sup_notes;

        $check_sup_name = DB::table('suppliers')
        ->where('acc_id', '=', session('acc_id'))
        ->where('sup_name','=', $sup_name)
        ->first();

        $prodValues = array(
            $request->sup_prd_name,
            $request->sup_prd_sku,
            $request->sup_prd_price,
            $request->sup_prd_deposit,
            $request->sup_prd_weight,
            $request->sup_prd_description,
            $request->sup_prd_reorder,
            $request->sup_name,
            'show',
            $request->show_modal,
            $request->tab_1,
            $request->tab_2
        );

        // dd($prodValues);

        if($check_sup_name != null)
        {
            session()->flash('errorMessage','Supplier already exist');
            session()->flash('getProductionValues', array( $prodValues));
        }
        else{
            $usr_id = DB::table('suppliers')
            ->insert([
            'sup_id' => session('sup_id'),
            'acc_id' => session('acc_id'),
            'sup_uuid' => generateuuid(),
            'sup_name' => $sup_name, 
            'sup_address' => $sup_address,
            'sup_contact' => $sup_contact,
            'sup_notes' => $sup_notes
            ]);

            session()->flash('successMessage','Supplier has been added');
            session()->flash('getProdValues', array( $prodValues));
        }
        return redirect()->action('ProductionController@manage');
    }

    public function EODReport()
    {
        
    }

    private function check_gas_quantity($tnk_id, $prd_id, $prd_quantity)
    {
        $tank = DB::table('tanks')
        ->where('tnk_id', '=', $tnk_id)
        ->first();

        $canister = DB::table('products')
        ->where('prd_id', '=', $prd_id)
        ->first();

        if($tank->tnk_remaining < ($canister->prd_weight * $prd_quantity))
        {
            return false;
        }  
        else
        {
            return true;
        }
    }
    private function check_tank_remaining_quantities($tank_array, $tnk_id, $amount_to_subtract)
    {
        $tank = DB::table('tanks')
        ->whereIn('tnk_id', $tank_array)
        ->get();

        $next_tank = DB::table('tanks')
        ->whereNotIn('tnk_id', $tank_array)
        ->where('tnk_active', '=', 1)
        ->orderBy('tnk_id', 'ASC')
        ->select('tnk_id')
        ->first();

        if($next_tank == null)
        {
            return false;
        }

        $count_tanks_remaining = 0;

        foreach($tanks as $tank)
        {
            $count_tanks_remaining = $count_tanks_remaining + $tank->tnk_remaining;
        }

        if($count_tanks_remaining < $amount_to_subtract)
        {
            $this->check_tank_remaining_quantities($tank_array, $next_tank, $amount_to_subtract);
        }

        return true;
    }

    private function subtract_tank_amount($tank_array, $amount_to_subtract)
    {
        $tanks = DB::table('tanks')
        ->whereIn('tnk_id', $tank_array)
        ->get();

        $amount_remaining = $amount_to_subtract + 0;

        foreach($tanks as $tank)
        {
            $amount_remaining = $amount_remaining - $tank->tnk_remaining;

            $tank_remaining = abs($amount_remaining);
            if($amount_remaining < 0)
            {

            }
        }
    }

    private function check_has_valve($prd_id)
    {
        $product = DB::table('products')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_id','=',$prd_id)
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->first();

        $valves = DB::table('products')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_id','=',$product->prd_components)
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','0')
        ->first();

        if(is_null($valves))
        {
            return false;
        }
        return true;
    }

    private function check_valve_quantity($prd_id, $qty)
    {
        $product = DB::table('products')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_id','=',$prd_id)
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->first();

        $valves = DB::table('products')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_id','=',$product->prd_components)
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','0')
        ->first();

        if($valves->prd_quantity < $qty)
        {
            return false;
        }

        return true;
    }

    private function check_has_seal($prd_id)
    {
        $product = DB::table('products')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_id','=',$prd_id)
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->first();

        $seals = DB::table('products')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_id','=',$product->prd_seals)
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','0')
        ->first();

        if(is_null($seals))
        {
            return false;
        }
        return true;
    }

    private function check_seal_quantity($prd_id, $qty)
    {
        $product = DB::table('products')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_id','=',$prd_id)
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->first();

        $seals = DB::table('products')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_id','=',$product->prd_seals)
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','0')
        ->first();

        // dd($product->prd_seals);

        if($seals->prd_quantity < $qty)
        {
            return false;
        }

        return true;
    }

    private function check_supervisor_verification($prd_id, $pdn_id)
    {
        $verification_check = DB::table('stock_verifications')
        ->whereIn('verify_user_type', [1, 5])//
        ->where('verify_prd_id', '=', $prd_id)
        ->where('verify_pdn_id', '=', $pdn_id)
        ->get();
        // dd($verification_check);
        if(!$verification_check)
        {
            return false;
        }

        return true;
    }

    private function verification_comparison()
    {
        $pdn_id = get_last_production_id();

        if(check_production_log())
        {
            $pdn_id = $pdn_id + 1;
        }
        
        $supervisor_canisters = DB::table('stock_verifications')
        ->where('verify_pdn_id', '=', $pdn_id)
        ->where('verify_acc_id', '=', session('acc_id'))
        ->where('verify_is_product', '=', 1)
        ->where('verify_user_type', '=', 5)
        ->get();

        $supervisor_tanks = DB::table('stock_verifications')
        ->where('verify_pdn_id', '=', $pdn_id)
        ->where('verify_acc_id', '=', session('acc_id'))
        ->where('verify_is_product', '=', 0)
        ->where('verify_user_type', '=', 5)
        ->get();

        $pm_canisters = DB::table('stock_verifications')
        ->where('verify_acc_id', '=', session('acc_id'))
        ->where('verify_pdn_id', '=', $pdn_id)
        ->where('verify_is_product', '=', 1)
        ->where('verify_user_type', '=', 4)
        ->get();
                                    
        $pm_tanks = DB::table('stock_verifications')
        ->where('verify_pdn_id', '=', $pdn_id)
        ->where('verify_acc_id', '=', session('acc_id'))
        ->where('verify_is_product', '=', 0)
        ->where('verify_user_type', '=', 4)
        ->get();

        $admin_canisters = DB::table('stock_verifications')
        ->where('verify_pdn_id', '=', $pdn_id)
        ->where('verify_acc_id', '=', session('acc_id'))
        ->where('verify_is_product', '=', 0)
        ->where('verify_user_type', '=', 1)
        ->get();

        $admin_tanks = DB::table('stock_verifications')
        ->where('verify_pdn_id', '=', $pdn_id)
        ->where('verify_acc_id', '=', session('acc_id'))
        ->where('verify_is_product', '=', 0)
        ->where('verify_user_type', '=', 1)
        ->get();

        // dd($supervisor_canisters, $supervisor_tanks, get_last_production_id());
        //IF ADMIN INPUT BEFORE SUPERVISOR

        $did_admin_verify = true;
        if(check_production_log()) //OPENING
        {
            foreach($admin_canisters as $canister)
            {
                if($canister->verify_opening == null)
                {
                    $did_admin_verify = false;
                }
            }

            foreach($admin_tanks as $tank)
            {
                if($tank->verify_opening == null)
                {
                    $did_admin_verify = false;
                }
            }

            if($did_admin_verify)
            {
                return true;
            }
        }
        else //CLOSING
        {
            foreach($admin_canisters as $canister)
            {
                if($canister->verify_closing == null)
                {
                    $did_admin_verify = false;
                }
            }

            foreach($admin_tanks as $tank)
            {
                if($tank->verify_closing == null)
                {
                    $did_admin_verify = false;
                }
            }
            if($did_admin_verify)
            {
                return true;
            }
        }

        //DEPRECATED ADMIN VERIFICATION

        // if((count($admin_canisters) <> 0 && count($admin_tanks) <> 0) && (count($supervisor_canisters) == 0 && count($supervisor_tanks) == 0))
        // {
        //     return true;
        // }

        //IF SUPERVISOR INPUT BEFORE ADMIN
        if(count($supervisor_canisters) <> 0 && count($supervisor_tanks) <> 0)
        {
            //IF ADMIN HAS INPUT
            if(count($admin_canisters) <> 0 && count($admin_tanks) <> 0)
            {
                foreach($supervisor_canisters as $supervisor_canister)
                {
                    foreach($admin_canisters as $admin_canister)
                    {
                        if($admin_canister->verify_prd_id == $supervisor_canister->verify_prd_id)
                        {
                            if(check_production_log())
                            {
                                if
                                (
                                    $admin_canister->verify_opening <> $supervisor_canister->verify_opening ||
                                    $admin_canister->verify_opening_filled <> $supervisor_canister->verify_opening_filled ||
                                    $admin_canister->verify_opening_empty <> $supervisor_canister->verify_opening_empty ||
                                    $admin_canister->verify_opening_leakers <> $supervisor_canister->verify_opening_leakers || 
                                    $admin_canister->verify_opening_for_revalving <> $supervisor_canister->verify_opening_for_revalving 
                                )
                                {
                                    return false;
                                }
                            }
                            else
                            {
                                if
                                (
                                    $admin_canister->verify_closing <> $supervisor_canister->verify_closing ||
                                    $admin_canister->verify_closing_filled <> $supervisor_canister->verify_closing_filled ||
                                    $admin_canister->verify_closing_empty <> $supervisor_canister->verify_closing_empty ||
                                    $admin_canister->verify_closing_leakers <> $supervisor_canister->verify_closing_leakers || 
                                    $admin_canister->verify_closing_for_revalving <> $supervisor_canister->verify_closing_for_revalving 
                                )
                                {
                                    return false;
                                }
                            }
                        }
                    }
                }
                foreach($supervisor_tanks as $supervisor_tank)
                {
                    foreach($admin_tanks as $admin_tank)
                    {
                        if($admin_tank->verify_prd_id == $supervisor_tank->verify_prd_id)
                        {
                            if(check_production_log())
                            {
                                if
                                (
                                    $admin_tank->verify_opening <> $supervisor_tank->verify_opening
                                )
                                {
                                    return false;
                                }
                            }
                            else
                            {
                                if
                                (
                                    $admin_tank->verify_closing <> $supervisor_tank->verify_closing 
                                )
                                {
                                    // dd($admin_tank, $supervisor_tank);
                                    return false;
                                }
                            }
                        }
                    }
                }
                return true;
            }

            //PLANT MANAGER INPUT
            if(count($pm_canisters) <> 0 && count($pm_tanks) <> 0)
            {
                foreach($supervisor_canisters as $supervisor_canister)
                {
                    foreach($pm_canisters as $pm_canister)
                    {
                        if($pm_canister->verify_prd_id == $supervisor_canister->verify_prd_id)
                        {
                            if(check_production_log())
                            {
                                if
                                (
                                    $pm_canister->verify_opening <> $supervisor_canister->verify_opening ||
                                    $pm_canister->verify_opening_filled <> $supervisor_canister->verify_opening_filled ||
                                    $pm_canister->verify_opening_empty <> $supervisor_canister->verify_opening_empty ||
                                    $pm_canister->verify_opening_leakers <> $supervisor_canister->verify_opening_leakers || 
                                    $pm_canister->verify_opening_for_revalving <> $supervisor_canister->verify_opening_for_revalving 
                                )
                                {
                                    return false;
                                }
                            }
                            else
                            {
                                if
                                (
                                    $pm_canister->verify_closing <> $supervisor_canister->verify_closing ||
                                    $pm_canister->verify_closing_filled <> $supervisor_canister->verify_closing_filled ||
                                    $pm_canister->verify_closing_empty <> $supervisor_canister->verify_closing_empty ||
                                    $pm_canister->verify_closing_leakers <> $supervisor_canister->verify_closing_leakers || 
                                    $pm_canister->verify_closing_for_revalving <> $supervisor_canister->verify_closing_for_revalving 
                                )
                                {
                                    return false;
                                }
                            }
                        }
                    }
                }
                foreach($supervisor_tanks as $supervisor_tank)
                {
                    foreach($pm_tanks as $pm_tank)
                    {
                        if($pm_tank->verify_prd_id == $supervisor_tank->verify_prd_id)
                        {
                            if(check_production_log())
                            {
                                if
                                ($pm_tank->verify_opening <> $supervisor_tank->verify_opening)
                                {
                                    return false;
                                }
                            }
                            else
                            {
                                if
                                ($pm_tank->verify_closing <> $supervisor_tank->verify_closing)
                                {
                                    return false;
                                }
                            }
                        }
                    }
                }
            }
        }
        return true;
    }

    private function printProduction()
    {
        $canisters = DB::table('products')
        ->where('acc_id', '=', session('acc_id'))
        ->where('prd_is_refillable', '=', 1)
        ->where('prd_for_production', '=', 1)
        ->where('prd_active', '=', 1)
        ->get();

        $customers = DB::table('customers')
        ->where('acc_id', '=', session('acc_id'))
        ->where('cus_active', '=', 1)
        ->get();

        $oppositions = DB::table('oppositions')
        ->where('acc_id', '=', session('acc_id'))
        ->where('ops_active', '=', 1)
        ->get();
        
        $production_logs = DB::table('production_logs')
        ->where('pdn_id', '=', get_last_production_id())
        ->first();
        
        $production_date = date("F j, Y", strtotime($production_logs->pdn_date));
        $production_start = date("h:i a", strtotime($production_logs->pdn_start_time));
        $production_end = date("h:i a", strtotime($production_logs->pdn_end_time));

        $pm_product_verifications = DB::table('stock_verifications')
        ->where('verify_acc_id', '=', session('acc_id'))
        ->where('verify_pdn_id', '=', get_last_production_id())
        ->whereIn('verify_user_type', [1, 5])
        ->get();

        $product_verifications = DB::table('stock_verifications')
        ->where('verify_acc_id', '=', session('acc_id'))
        ->where('verify_pdn_id', '=', get_last_production_id())
        ->where('verify_is_product', '=', 1)
        ->whereIn('verify_user_type', [1, 4])
        ->orderBy('verify_id', 'DESC')
        ->get();

        // if(!empty($product_verifications->where('verify_user_type', '=', 1)->first()))
        // {
        //     $did_admin_verify = true;
        //     $product_verifications = $product_verifications->where('verify_user_type', '=', 1)->get();
        // }
        // else
        // {
        //     $product_verifications = $product_verifications->where('verify_user_type', '=', 4)->get();
        // }
        // dd($product_verifications);
        $opening_stocks_array = [];
        foreach($product_verifications as $opening)
        {
            // dd($opening->verify_opening);
            if(!empty($opening->verify_opening))//$opening->verify_user_type == 1 && )
            {
                array_unshift($opening_stocks_array, $opening->verify_opening_filled);
            }
        }
        
        $closing_stocks_array = []; 
        foreach($product_verifications as $closing)
        {
            if(!empty($closing->verify_closing))//$closing->verify_user_type == 1 && )
            {
                array_unshift($closing_stocks_array, $closing->verify_closing_filled);
            }
        }

        // dd($opening_stocks_array, $closing_stocks_array);

        $supervisor_product_verifications = DB::table('stock_verifications')
        ->where('verify_acc_id', '=', session('acc_id'))
        ->where('verify_pdn_id', '=', get_last_production_id())
        ->whereIn('verify_user_type', [1, 4])
        ->get();
        
        $customers = DB::table('customers')
        ->where('acc_id', '=', session('acc_id'))
        ->where('cus_active', '=', 1)
        ->get();

        $purchases = DB::table('purchases')
        ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
        ->orderBy('trx_id', 'DESC')
        ->get();

        $transactions = DB::table('transactions')
        ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
        ->where('transactions.pdn_id', '=', get_last_production_id())
        ->where('trx_active','=','1')
        ->orderBy('transactions.trx_id', 'DESC')
        ->get();
        
        $tanks = DB::table('tank_logs')
        ->join('tanks', 'tanks.tnk_id', '=', 'tank_logs.tnk_id')
        ->where('pdn_id', '=', get_last_production_id())
        ->where('tank_logs.acc_id', '=', session('acc_id'))
        ->get();
        
        $purchases_array = [];
        $received_customers_array = [];
        $issued_customers_array = [];
        if(isset($transactions))
        {
            foreach($transactions as $transaction)
            {
                $pur_internal_array = [];
                $rec_internal_array = [];
                $internal_array = [];
                
                if(!empty($transaction->trx_opposition_name))
                {
                    continue;
                }

                $is_not_canister = false;
                foreach($customers as $customer)
                {
                    // $pur_internal_array = [];
                    $pur_index = 2;
                    $rec_index = 2;
                    $iss_index = 2;
                    if($is_not_canister)
                    {
                        break;
                    }

                    if($transaction->cus_id == $customer->cus_id)
                    {
                        if($is_not_canister)
                        {
                            break;
                        }

                        array_push($pur_internal_array, $customer->cus_name);
                        array_push($pur_internal_array, $transaction->trx_ref_id);

                        array_push($rec_internal_array, $customer->cus_name);
                        array_push($rec_internal_array, $transaction->trx_ref_id);

                        array_push($internal_array, $customer->cus_name);
                        array_push($internal_array, $transaction->trx_ref_id);

                        $purchase_products = DB::table('purchases')
                        ->orderBy('prd_id', 'ASC')
                        ->where('can_type_in', '=', 1)
                        ->where('trx_id', '=', $transaction->trx_id)
                        // ->where('trx_id', '=', 3)
                        ->get();
                        // dd($purchase_products);
                        //--------------------------------------------

                        //PURCHASES ARRAY
                        foreach($purchase_products as $products)
                        {
                             //FOR PURCHASED CANISTERS
                            //  if($canister->prd_id == $products->prd_id)
                            //  {
                            if($transaction->trx_id == $products->trx_id)
                            {
                                $previous_prd_id = $products->prd_id;
                                foreach($canisters as $canister)
                                {
                                    $amount  = DB::table('purchases')
                                    ->where('trx_id', '=', $transaction->trx_id)
                                    ->where('prd_id', '=', $canister->prd_id)
                                    ->sum('pur_qty');

                                    $sum = $pur_internal_array[$pur_index] ?? 0;
                                    $pur_internal_array[$pur_index] = $amount+$sum;
                                    $pur_index++;
                                }
                            }
                        }
                        
                        //TRIM PURCHASES ARRAY
                        if(count($pur_internal_array) - 2 > count($canisters))
                        {
                            for($array_count = count($pur_internal_array) - 2; $array_count > count($canisters); $array_count--)
                            {
                                array_pop($pur_internal_array);
                            }
                        }
                        elseif(count($pur_internal_array) - 2 < count($canisters))
                        {
                            for($array_count = count($pur_internal_array) - 2; $array_count < count($canisters); $array_count--)
                            {
                                array_push($pur_internal_array, 0);
                            }
                        }

                        foreach($canisters as $canister)
                        {
                            if($is_not_canister)
                            {
                               
                                break;
                            }

                            $previous_id = $canister->prd_id;
                            foreach($purchase_products as $products)
                            {
                                //FOR RECEIVED CANISTERS
                                if($canister->prd_id == $products->prd_id_in)
                                {
                                    // dd($products);
                                    $count = $rec_internal_array[$rec_index] ?? 0;
                                    $rec_internal_array[$rec_index] = $count + $products->pur_qty;
                                    // $rec_index++;
                                }

                                //FOR ISSUED CANISTERS
                                if($canister->prd_id == $products->prd_id && ($products->pur_qty) > ($products->pur_crate_in * 12) + ($products->pur_loose_in))//($canister->prd_id == $products->prd_id )
                                {
                                    $count = $internal_array[$iss_index] ?? 0;
                                    $internal_array[$iss_index] = $count + $products->pur_qty - (($products->pur_crate_in * 12) + ($products->pur_loose_in)); //where('trx_id', '=', $transaction->trx_id)->first()->
                                    $iss_index++;
                                }
                                elseif($canister->prd_id == $products->prd_id && (($products->pur_crate_in * 12) + ($products->pur_loose_in) == 0))//($products->pur_qty) < ($products->pur_crate_in * 12) + ($products->pur_loose_in)
                                {
                                    // dd($products);
                                    $internal_array[$iss_index] = $count + 0; //where('trx_id', '=', $transaction->trx_id)->first()->
                                    // dd($internal_array);
                                    $iss_index++;
                                }
                            }
                            $rec_index++;
                        }

                        // dd(($rec_index));

                        $canister_count = count($canisters) - (count($rec_internal_array) - 2);
                        $issued_canister_count = count($canisters) - (count($internal_array) - 2);

                        if($canister_count > 0)
                        {
                            while($canister_count <> 0)
                            {
                                array_push($rec_internal_array, 0);
                                $canister_count--;
                            }
                        }

                        if($issued_canister_count > 0)
                        {
                            // dd($internal_array);
                            while($issued_canister_count <> 0)
                            {
                                array_push($internal_array, 0);
                                $issued_canister_count--;
                            }
                        }
                        
                        if(!$is_not_canister)
                        {
                            //ADD ISSUED / RECEIVED ARRAYS TO DISPLAY IF ISSUED CANISTERS IS NOT EQUAL TO 0
                            $amount = 0;

                            // dd($internal_array, $rec_internal_array);
                            //START WITH INDEX 2 BECAUSE 0 AND 1 ARE "CUSTOMER NAME" AND "REFERENCE ID" RESPECTIVELY
                            for($index = 2; $index < count($internal_array); $index++)
                            {
                                $amount = $amount + $internal_array[$index];
                            }
                            if($amount <> 0)
                            {
                                array_unshift($issued_customers_array, $internal_array);
                            }

                            // dd($rec_internal_array[3]);
                            $amount = 0;
                            for($index = 2; $index < count($rec_internal_array); $index++)
                            {
                                // dd($rec_internal_array, $rec_internal_array[$index]);
                                $amount = $amount + ($rec_internal_array[$index] ?? 0);
                            }
                            if($amount <> 0)
                            {
                                array_unshift($received_customers_array, $rec_internal_array);
                            }
                            
                            array_unshift($purchases_array, $pur_internal_array);
                        }
                    }
                }
            }
        }
        
        // dd($purchases_array);

        //OPPOSITION RECEIVED ARRAY
        $oppositions_array = [];
        $opposition_count = count($oppositions) - 1;

        $bool = false;
        $ops_internal = [];  
        foreach($transactions as $transaction)
        {
            foreach($customers as $customer)
            {
                if($customer->cus_id == $transaction->cus_id)
                {
                    if($bool)
                    {
                        break;
                    }
                    array_push($ops_internal, $customer->cus_name);
                    array_push($ops_internal, $transaction->trx_ref_id);

                    foreach($oppositions as $opposition)
                    {
                        $purs = DB::table('purchases')
                        ->where('trx_id', '=', $transaction->trx_id)
                        ->where('can_type_in', '=', 2)
                        ->where('prd_id_in', '=', $opposition->ops_id)
                        ->get();
                        
                        if(count($purs) == 0)
                        {
                            array_push($ops_internal, 0);
                            continue;
                        }

                        foreach($purs as $pur)
                        {
                            if($pur->can_type_in == 2)
                            {
                                if($pur->prd_id_in == $opposition->ops_id)
                                {
                                    array_push($ops_internal, ($pur->pur_loose_in + ($pur->pur_crate_in * 12)));
                                }
                            }
                        }
                    }
                }
                
            }
        }
        for($x = 0; $x < count($transactions); $x++)
        {
            $array = [];
            for($index = 0; $index < count($oppositions) + 2; $index++)
            {
                array_push($array, array_shift($ops_internal));
            }

            $count = 0;
            foreach($array as $index)
            {
                if(gettype($index) == "string")
                {
                    continue;
                }
                $count = $count + $index;
            }

            if($count == 0)
            {
                continue;
            }
            array_unshift($oppositions_array, $array);
        }
        
        $p1_table_rows = 10;
        $p2r_table_rows = 3;
        $p2i_table_rows = 3;
        
        $total_array = [];
        foreach($purchases_array as $purchase)
        {
            for($index = 0; $index < count($canisters); $index++)
            {
                $total_array[$index] = ($total_array[$index] ?? 0) + $purchase[$index + 2];
            }
            
        }
    
        return view('admin.print.productiontoggle', compact('canisters', 'customers', 'closing_stocks_array', 'received_customers_array', 'issued_customers_array', 'opening_stocks_array', 'oppositions', 'oppositions_array', 'p1_table_rows', 'p2r_table_rows', 'p2i_table_rows', 'production_logs', 'production_date', 'production_start', 'production_end', 'product_verifications', 'pm_product_verifications', 'purchases', 'purchases_array', 'supervisor_product_verifications','tanks', 'total_array', 'transactions',));
    }

    public function tank()
    {
        $tanks = DB::table('tanks')
        ->get();

        return view('admin.production.tank', compact('tanks'));
    }

    //ADD TANK CONTROLLER
    public function createTank(Request $request)
    {
        $tnk_name = $request->tnk_name;
        $tnk_capacity = $request->tnk_capacity;
        $tnk_remaining = $request->tnk_remaining;
        $tnk_notes = $request->tnk_notes;

        $check_tank_name = DB::table('tanks')
        ->where('acc_id', '=', session('acc_id'))
        ->where('tnk_name','=', $tnk_name)
        ->first();

        if($check_tank_name != null)
        {
            session()->flash('errorMessage','Tank already exist');
            return redirect()->action('ProductionController@tank');
        }

        DB::table('tanks')
        ->insert([
        'acc_id' => session('acc_id'),
        'tnk_name' => $tnk_name, 
        'tnk_capacity' => (float)$tnk_capacity * 1000,
        'tnk_notes' => $tnk_notes
        ]);

        session()->flash('successMessage','Tank has been added');
        return redirect()->action('ProductionController@tank');
    }

    //EDIT TANK CONTROLLER
    public function editTank(Request $request)
    {
        $tnk_id = $request->tnk_id;
        $tnk_name = $request->tnk_name;
        $tnk_capacity = (float)$request->tnk_capacity * 1000;
        $tnk_remaining = (float)$request->tnk_remaining * 1000;
        $tnk_notes = $request->tnk_notes;
        $tnk_uuid = $request->tnk_uuid;

        $tank = DB::table('tanks')
        ->where('acc_id','=', session('acc_id'))
        ->where('tnk_name','=', $tnk_name)
        ->first();
        
        if($tank != null && $tank->tnk_id != $tnk_id)
        {
            session()->flash('errorMessage','Tank already exist');
        }
        else{
            if($tnk_capacity >= $tnk_remaining && $tnk_capacity > 0){
                DB::table('tanks')
                ->where('tnk_id', '=', $tnk_id)
                ->update([
                    'tnk_name' => $tnk_name,
                    'tnk_capacity' => $tnk_capacity,
                    'tnk_remaining' => $tnk_remaining,
                    'tnk_notes' => $tnk_notes
                ]);
                session()->flash('successMessage','Tank details updated.');
            }
            else{
                session()->flash('errorMessage','Tank capacity must not be less than zero or the remaining LPG');
            }
        }
        
        return redirect()->action('ProductionController@tank');
    }

    //EDIT TANK CONTROLLER
    public function tankActivation($tnk_id, $tnk_active)
    {

        if($tnk_active==1){
            DB::table('tanks')
            ->where('tnk_id', '=', $tnk_id)
            ->update([
                'tnk_active' => 0
            ]);
            session()->flash('successMessage','Tank deactivated.');
        }
        else if($tnk_active==0){
            DB::table('tanks')
            ->where('tnk_id', '=', $tnk_id)
            ->update([
                'tnk_active' => 1
            ]);
            session()->flash('successMessage','Tank activated.');
        }
        
        return redirect()->action('ProductionController@tank');
    }

    //REFILL TANK CONTROLLER
    public function refillTank(Request $request)
    {
        $tnk_id = $request->tnk_id;
        $refill_cty = (float)$request->tnk_remaining * 1000;

        $remaining = DB::table('tanks')
        ->where('tnk_id', '=', $tnk_id)
        ->first();
        
        $tnk_capacity = (float)$remaining->tnk_capacity;
        $tnk_remaining = (float)$remaining->tnk_remaining + $refill_cty;

        if($tnk_remaining > $tnk_capacity){
            session()->flash('errorMessage','Refill must not be greater than tank capacity');
        }
        else if($tnk_remaining < 0 || $refill_cty < 0){
            session()->flash('errorMessage','Refill must not be less than zero');
        }
        else{
            DB::table('tanks')
            ->where('tnk_id', '=', $tnk_id)
            ->update([
                'tnk_remaining' => (float)$tnk_remaining,
            ]);
            
            record_stockin($tnk_id, $refill_cty);

            session()->flash('successMessage','Tank refilled');

        }

        return redirect()->action('ProductionController@tank');
    }
}

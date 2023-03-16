<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Session;
use DB;

class MainController extends Controller
{
    public function home()
    {
        $pdn_flag = check_production_log();

        $news = DB::table('news')
        ->where('news_active', '=', '1')
        ->orderByDesc('news_id')
        ->get();

        $canisters = DB::table('products')
        ->join('suppliers', 'suppliers.sup_id', '=', 'products.sup_id')
        ->where('products.acc_id', '=', session('acc_id'))
        ->where('prd_for_production','=','1')
        ->where('prd_is_refillable','=','1')
        ->get();

        $tanks = DB::table('tanks')
        ->where('acc_id', '=', session('acc_id'))
        ->get();

        if(session('typ_id') == null){
            return redirect()->action('LoginController@login');
        }
        else{
            return view('admin.main', compact('pdn_flag', 'news', 'canisters', 'tanks')); 
        }
    }
    
    //PRODUCTION
    public function toggleProduction()
    {
        $pdn_flag = check_production_log();

        if($pdn_flag)
        {
            DB::table('production_logs')
            ->insert([
                'pdn_date' => DB::raw('CURRENT_TIMESTAMP'),
                'pdn_start_time' => DB::raw('CURRENT_TIMESTAMP')
            ]);

            session()->flash('successMessage','Production started!');
            return redirect()->action('ProductionController@manage');
        }
        else
        {
            DB::table('production_logs')
            ->update([
                'pdn_end_time' => DB::raw('CURRENT_TIMESTAMP')
            ]);

            session()->flash('successMessage','Production ended!');
            return redirect()->action('ProductionController@manage');
        }
    }

    public function createNews(Request $request){
        DB::table('news')
            ->insert([
                'news_title' => $request->news_title,
                'news_content' => $request->news_content,
                'news_date' => date('Y-m-d'),
                'news_time' => date('H:i:s'),
                'news_datetime' => date('Y-m-d H:i:s')
            ]);


        //IMAGE UPLOAD 
        if($request->file('news_image'))
        {
            $news_id = DB::table('news')
            ->select('news_id')
            ->orderBy('news_id', 'desc')
            ->first();
    
            $file = $request->file('news_image');

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
    
            if ($validator->fails()) 
            {
                session()->flash('errorMessage',  "Invalid File Extension or maximum size limit of 5MB reached!");
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            $fileName = $news_id->news_id . '.' . $file->getClientOriginalExtension();
    
            Storage::disk('local')->put('img/news/' . $fileName, fopen($file, 'r+'));

            DB::table('news')
            ->where('news_id','=',$news_id->news_id)
            ->update([
                'news_img' => $fileName,
            ]);  
    
        }   

            
        session()->flash('successMessage','Your message has been posted!');
        return redirect()->action('MainController@home');
    }

    public function removeNews($news_id){
        DB::table('news')
            ->where('news_id', '=', $news_id)
            ->update([
                'news_active' => '0'
            ]);

            
        session()->flash('successMessage','The post has been removed!');
        return redirect()->action('MainController@home');
    }



    // public function toggleProduction()
    // {
    //     $pdn_flag = check_production_log();
        
    //     if($pdn_flag)
    //     {
    //         DB::table('production_logs')
    //         ->insert([
    //             'pdn_datetime' => DB::raw('CURRENT_TIMESTAMP'),
    //             'pdn_action' => 1
    //         ]);

    //         session()->flash('successMessage','Production started!');
    //         return redirect()->action('MainController@home');
    //     }
    //     else
    //     {
    //         DB::table('production_logs')
    //         ->insert([
    //             'pdn_datetime' => DB::raw('CURRENT_TIMESTAMP'),
    //             'pdn_action' => 0 
    //         ]);

    //         session()->flash('successMessage','Production ended!');
    //         return redirect()->action('MainController@home');
    //     }
    // }
}
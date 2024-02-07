<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function user()
    {
        if(session('typ_id') <> 1){
            return redirect()->action('MainController@home');
        }
        
        $users = DB::table('users')
        ->join('user_types', 'user_types.typ_id', '=', 'users.typ_id')
        ->where('acc_id', '=',session('acc_id'))
        ->get();

        $user_types = DB::table('user_types')
        ->get();

        $reset_passwords = DB::table('reset_password')
        ->join('users', 'users.usr_id', '=', 'reset_password.usr_id')
        ->where('rst_active', '=', 1)
        ->get();
        
        $reset_passwords_count = DB::table('reset_password')
        ->where('rst_active', '=', 1)
        ->count();
        
        session(['reset_passwords_count' => $reset_passwords_count]);

        $typ_id = '0';

        $statuses = array(
            1 => 'All',
            2 => 'Active',
            3 => 'Inactive'
        );

        $default_status = '0';
         
        return view('admin.user.manage',compact('users','user_types','typ_id','statuses','default_status','reset_passwords'));
    }

    public function createUser(Request $request)
    {
        $usr_full_name = $request->usr_full_name;
        $usr_address = $request->usr_address;
        $usr_name = $request->usr_name;
        $usr_password = $request->usr_password;
        $typ_id = $request->typ_id;

        $check_usr_name = DB::table('users')
        ->where('acc_id', '=', session('acc_id'))
        ->where('usr_name','=', $usr_name)
        ->first();

        if($check_usr_name != null)
        {
            session()->flash('errorMessage','Username already taken');
            return redirect()->action('UserController@user');
            
        }

        DB::table('users')
        ->insert([
            'acc_id' => session('acc_id'),
            'usr_uuid' => generateuuid(),
            'usr_full_name' => $usr_full_name,
            'usr_name' => $usr_name,
            'usr_password' => md5($usr_password),
            'usr_address' => $usr_address,
            'typ_id' => $typ_id
        ]);

        session()->flash('successMessage','New user has been added');
        return redirect()->action('UserController@user');
    }

    public function editUser(Request $request, $usr_id)
    {
        $usr_full_name = $request->usr_full_name;
        $typ_id = (int)$request->typ_id;
        $usr_address = $request->usr_address;
        $usr_password = $request->usr_password;

        $check_uuid = DB::table('users')
        ->where('usr_id', '=', $usr_id)
        ->where('usr_uuid', '=', null)
        ->get();

        if($check_uuid != null)
        {
            DB::table('users')
            ->where('usr_id', '=', $usr_id)
            ->update([
                'usr_uuid' => generateuuid()
            ]);
            session(['usr_full_name' => $request->usr_full_name]);
        }
        
        if($usr_password == null)
        {
            DB::table('users')
            ->where('usr_id', '=', $usr_id)
            ->update([
                'usr_full_name' => $usr_full_name,
                'usr_address' => $usr_address,
                'typ_id' => $typ_id
            ]);
            session(['usr_full_name' => $request->usr_full_name]);
        }
        else
        {
            DB::table('users')
            ->where('usr_id', '=', $usr_id)
            ->update([
                'usr_full_name' => $usr_full_name,
                'usr_address' => $usr_address,
                'typ_id' => $typ_id,
                'usr_password' => md5($usr_password)
            ]);
            session(['usr_full_name' => $request->usr_full_name]);
        }
        
        session()->flash('successMessage','User details updated');
        return redirect()->action('UserController@user');
    }

    public function deactivateUser($usr_id)
    {
        DB::table('users')
        ->where('usr_id', '=', $usr_id)
        ->update([
            'usr_active' => 0
        ]);

        session()->flash('successMessage','User deleted');
        return redirect()->action('UserController@user');
    }

    public function reactivateUser($usr_id)
    {
        DB::table('users')
        ->where('usr_id', '=', $usr_id)
        ->update([
            'usr_active' => 1
        ]);

        session()->flash('successMessage','User reactivated');
        return redirect()->action('UserController@user');
    }

    public function searchUser(Request $request)
    {
        $search_string = $request->search_string;
        $typ_id = $request->filter_type;

        $user_types = DB::table('user_types')
        ->get();

        $statuses = array(
            0 => 'Inactive',
            1 => 'Active',
            2 => 'All'
        );

        $default_status = $request->filter_status;
        $usr_active = array_search($request->filter_status, $statuses);

        $query = DB::table('users')
        ->where('acc_id','=',session('acc_id'))
        ->where('usr_full_name','LIKE', $search_string . '%');

        if($typ_id != 0){
            $query = $query->where('typ_id', '=', $typ_id);
        }

        if($usr_active != 2){
            $query = $query->where('usr_active', '=', $usr_active);
        }

        $users = $query->orderBy('usr_full_name')->get(); 
        
        return view('admin.user.manage',compact('users','user_types','typ_id','statuses','default_status'));  
    }

    //USER SCREEN FOR PROFILE EDITS
    public function profile()
    {
        $user_details = DB::table('users')
        ->where('usr_id', '=', session('usr_id'))
        ->first();

        // dd($user_details);
        return view('admin.profile.profile', compact('user_details'));
    }

    public function saveProfile(Request $request, $usr_id)
    {
        $typ_id = (int)$request->typ_id;
        $usr_address = $request->usr_address;

        $check_uuid = DB::table('users')
        ->where('usr_id', '=', $usr_id)
        ->where('usr_uuid', '=', null)
        ->get();

        $user_details = DB::table('users')
            ->where('usr_id', '=', $usr_id)
            ->update([
                'usr_address' => $usr_address     
            ]);
           
        if($user_details != null)
        {
            DB::table('users')
            ->where('usr_id', '=', $usr_id)
            ->update([
                'usr_uuid' => generateuuid()
            ]);

        }
        session()->flash('successMessage', 'Changes has been updated!');
        return redirect()->action('UserController@profile');
    }


    public function savePassword(Request $request)
    {
        $usr_password = $request->usr_password;
        $new_password = $request->new_password;
        $new_password2 = $request->new_password2;
        $usr_uuid = $request->usr_uuid;

        $users = DB::table('users')
        ->where('usr_uuid','=',$usr_uuid)
        ->first();

        $stored_password = $users->usr_password;

        if(md5($usr_password) == $stored_password){
            if($new_password == $new_password2){

                DB::table('users')
                ->where('usr_uuid','=',$usr_uuid)
                ->update([
                    'usr_password' => md5($new_password)
                ]);

                session()->flash('successMessage', 'User password successfully updated.');
            }else{
                session()->flash('errorMessage', 'New password does not match.');
            }
        }else{
            session()->flash('errorMessage', 'Incorrect password entered.');
        }

        return redirect()->action('UserController@profile');
    }

    public function forgotPassword(Request $request){

        $user = DB::table('users')
        ->where('usr_name','=',$request->usr_name)
        ->first();

        if($user != null){
            
            $has_pending_request = DB::table('reset_password')
            ->where('usr_id','=',$user->usr_id)
            ->where('rst_active','=', 1)
            ->first();

            if($has_pending_request == null){
                DB::table('reset_password')
                ->insert([
                    'usr_id' => $user->usr_id
                ]); 
                
                session()->flash('successMessage', 'Please wait for an admin to validate your request');
            }
            else{
                session()->flash('errorMessage', 'You already requested for password reset. \nPlease wait until an admin validates your request.');
            }

        }
        else{
            session()->flash('errorMessage', 'Username not found');
        }

        return redirect()->action('LoginController@login');
    }

    
    public function resetPassword(Request $request){

        DB::table('reset_password')
        ->where('rst_id','=',$request->rst_id)
        ->update([
            'rst_active' => 0
        ]); 

        DB::table('users')
        ->where('usr_id','=',$request->usr_id)
        ->update([
            'usr_password' => md5($request->usr_name)
        ]); 

        session()->flash('successMessage', "Password has been reset");
        return redirect()->action('UserController@user');
    }

    public function uploadAvatar(Request $request, $usr_id)
    {
        // dd($request->usr_image->getClientOriginalName());
        $file = $request->file('usr_image');
        $validator = Validator::make( 
            [
                'file' => $file,
                'extension' => strtolower($file->getClientOriginalExtension()),
            ],
            [
                'file' => 'required|max:3072',
                'extension' => 'required|in:jpg,png,gif',
            ]
        );
        
        if ($validator->fails()) {
            session()->flash('errorMessage',  "Invalid File Extension or maximum size limit of 5MB reached!");
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $fileName = $usr_id . '.' . $file->getClientOriginalExtension();

        Storage::disk('local')->put('/img/users/' . $fileName, fopen($file, 'r+'));

        DB::table('users')
        ->where('usr_id','=',$usr_id)
        ->update([
            'usr_image' => $fileName,
        ]);  

        session(['usr_image' => $usr_id .'.'. $request->usr_image->getClientOriginalExtension()]);

        session()->flash('successMessage', 'Profile photo has been uploaded.');
        return redirect()->action('UserController@profile');
    }
}

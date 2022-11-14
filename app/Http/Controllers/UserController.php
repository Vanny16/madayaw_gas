<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function user()
    {
        $users = DB::table('users')
        ->join('user_types', 'user_types.typ_id', '=', 'users.typ_id')
        ->where('acc_id', '=',session('acc_id'))
        ->get();

        $user_types = DB::table('user_types')
        ->get();

        $typ_id = '0';

        $statuses = array(
            1 => 'All',
            2 => 'Active',
            3 => 'Inactive'
        );

        $default_status = '0';
         
        return view('admin.user.manage',compact('users','user_types','typ_id','statuses','default_status'));
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

        return view('admin.profile.profile', compact('user_details'));
    }

    public function saveProfile()
    {
        $user_details = DB::table('users')
        ->where('usr_id', '=', session('user_id'))
        ->get();

        return view('admin.profile.profile', compact('user_details'));
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
            session()->flash('errorMessage', 'Incorrect old password entered.');
        }

        return redirect()->action('UserController@profile');
    }

    public function uploadAvatar(Request $request)
    {
        $file = $request->file('usr_image');
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
        
        if ($validator->fails()) {
            session()->flash('errorMessage',  "Invalid File Extension or maximum size limit of 5MB reached!");
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $fileName = $request->usr_id . '.' . $file->getClientOriginalExtension();

        Storage::disk('local')->put('/images/users/' . $fileName, fopen($file, 'r+'));

        DB::table('users')
        ->where('usr_id','=',$request->usr_id)
        ->update([
            'usr_image' => $fileName,
        ]);  

        session()->flash('successMessage', 'Profile photo has been uploaded.');
        return redirect()->action('UserController@main');
    }
}

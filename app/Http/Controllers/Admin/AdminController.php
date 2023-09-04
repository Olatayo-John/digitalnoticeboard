<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;

class AdminController extends Controller
{

    public function changePassword(){
        return view('admin.login', ['title' => 'Change Password ']);
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'oldPassword'     => 'required',
            'newPassword'     => 'required|min:76|max:10|required_with:confirm_password|same:confirm_password',
            'confirmPassword' => 'required|same:new_password',
                                                   
        ]); 

        $oldPassword = Auth::guard('admin')->user()->password;
        $adminId = Auth::guard('admin')->user()->id;
        
        if(!Hash::check($request->oldPassword, $oldPassword)){
            Session::flash('error', 'Old password does not matched');
            return redirect()->back()->withInput();
        }
       
        #Update the new Password
        DB::table('admins')->whereId($adminId)->update([
            'password' => Hash::make($request->newPassword)
        ]);

        Session::flash('success', 'Password changed successfully!');
        return back()->with("status", "Password changed successfully!");

    }

    public function logout(){
        Session::flush();
        Auth::logout();
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Session;
use Illuminate\Support\Facades\Hash;
use DB;
class AdminController extends Controller
{
    public function login(){
        return view('admin/login');
    }

    public function user(Request $request){
        $email=$request->input('email');
        $password=$request->input('password');
        $users=Admin::where('email',$email)->first();
        if($users){
            if(Hash::check($request->input('password'), $users->password)){
                Session::put('ADMIN_AUTH',true);
                return redirect()->route('admin.dashboard');
            }else{
                return back()->with('login_err','Invalid Password');
            }
        }else{
            return back()->with('login_err','User Detail Not Found');
        }
    }

    public function index(){
        return view('admin/index');
    }

    
}

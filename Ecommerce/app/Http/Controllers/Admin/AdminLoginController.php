<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    //
    public function index(){
        return view("admin.auth.login");
    }
    public function login(Request $request){
        $request->validate([
            "email"=>"required|email",
            "password"=> "required"
        ]);
        if(Auth::attempt($request->only("email","password"))){
            if(auth()->check() && auth()->user()->is_admin){
                $user  = auth()->user()->name;
                return redirect()->route('admin.home')->with("success","Welcome $user");
            }
            Auth::logout();
        }
        return redirect()->back()->withErrors(["error","You do not have permissions !!!"]);
    }
}

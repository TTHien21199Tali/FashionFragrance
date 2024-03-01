<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //import auth
use Illuminate\Support\Facades\Session;//import Session


class LoginController extends Controller
{
    //
    public function index(){
        return view('admin.users.login',[
            'title'=>'Đăng Nhập Hệ Thống'
        ]);
    }

    public function store(Request $request){

        //dd($request->input());
        $this->validate($request,[
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);     
        
        if(Auth::attempt([
            'email' => $request->input('email'),
            'password'=>$request->input('password')
        ],   $request->input('remember')
        )){
            return redirect()->route('admin');  
        }  
        Session::flash('error','Email hoặc password không đúng');
        return redirect()->back();
    }
}

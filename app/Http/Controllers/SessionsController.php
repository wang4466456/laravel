<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
class SessionsController extends Controller{

    public function create(){
        return view('sessions.create');
    }

    public function store(Request $request){
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            session()->flash('success','欢迎回来！');
            return redirect()->route('users.show',[Auth::user()]);
        }else{
            session()->flash('danger','邮箱或密码不正确');
            return redirect()->back();
        }
    }


    public function destroy(){
        Auth::logout();
        session()->flash('success','您成功退出!');
        return redirect('login');
    }



}


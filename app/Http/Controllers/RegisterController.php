<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
{
    //注册页面
    public function index()
    {
        return view('register.index');
    }

    //注册行为
    public function register()
    {
        $this->validate(request(), [
            'name'=>'required|min:3|unique:users,name',
            'email'=>'required|unique:users,email|email',
            'password'=>'required|min:6|max:32|confirmed',
        ]);

        $name = request('name');
        $email = request('email');
        $password = bcrypt(request('password'));

        $user = User::create(compact('name', 'email', 'password'));

        return redirect('/login');
    }
}

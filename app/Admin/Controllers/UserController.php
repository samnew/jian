<?php

namespace App\Admin\Controllers;

use App\AdminUser;
use Illuminate\Http\Request;


class UserController extends Controller
{
    // 管理员列表页面
    public function index()
    {
        $users = AdminUser::paginate(10);
        return view('admin/user/index', compact('users'));
    }

    // 管理员创建页面
    public function create()
    {
        return view('admin/user/create');
    }

    // 创建
    public function store()
    {
        $this->validate(request(), [
            'name'=>'required|min:4',
            'password'=>'required|min:6'
        ]);

        $name = request('name');
        $password = bcrypt(request('password'));

        AdminUser::create(compact('name','password'));

        return redirect('admin/users');
    }

    // 用户角色页面
    public function role()
    {
        return view('admin/user/role');
    }

    // 储存用户角色
    public function storeRole()
    {

    }
}

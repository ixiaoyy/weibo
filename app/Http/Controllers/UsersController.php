<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UsersController extends Controller
{
    // 用户注册
    public function create()
    {
        return view('users.create');
    }

    // 展示用户页面
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
      * Desc: 保存用户信息
      * User: YuY
      * Date: 2020/3/11
      */
    public function store(Request $request)
    {
        // 数据验证
        $this->validate($request, [
            'name' => 'required|unique:users|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        // 入库
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // 增加一条闪存
        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('users.show',[$user]);
    }
}

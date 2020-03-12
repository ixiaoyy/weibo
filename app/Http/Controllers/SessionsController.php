<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    /**
     * Desc: 创建用户页面
     * User: YuY
     * Date: 2020/3/11
     */
    public function create()
    {
        return view('sessions.create');
    }

    /**
      * Desc: 保存用户数据
      * User: YuY
      * Date: 2020/3/11
      */
    public function store(Request $request)
    {
        // 先校验数据
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        // 使用Auth::attempt，从数据库查找数据并匹配,匹配成功会创建一个『会话』给通过认证的用户，通过Auth::user() 方法来获取 当前登录用户 的信息
        // 使用$request->has('remember')【记住我】功能，自动生效
        if (Auth::attempt($credentials,$request->has('remember'))){
            // 登录成功后的相关操作
            session()->flash('success', '欢迎回来！');
            return redirect()->route('users.show', [Auth::user()]);
        } else {
            // 登录失败后的相关操作
            // 使用 withInput() 后模板里 old('email') 将能获取到上一次用户提交的内容
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
            return redirect()->back()->withInput();
        }
    }
    
    /**
      * Desc: 删除会话数据，退出登录
      * User: YuY
      * Date: 2020/3/12
      */
    public function destroy(){
        // 退出
        Auth::logout();
        // 闪存消息
        session()->flash('success', '您已成功退出！');
        return redirect('login');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UsersController extends Controller
{
    public function __construct(){
        // 身份验证-Auth中间件过滤未登录用户的动作
        $this->middleware('auth', [
           'except' => ['show', 'create', 'store', 'index']
        ]);

        // 只允许未登录用户的动作
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    // 用户注册
    public function create()
    {
        return view('users.create');
    }

    // 展示用户页面
    public function show(User $user)
    {
        $statuses = $user->statuses()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('users.show', compact('user', 'statuses'));
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

    /**
     * Desc: 编辑用户页面
     * User: YuY
     * Date: 2020/3/13
     */
    public function edit(User $user)
    {
        // 授权策略
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    /**
     * Desc: 更新用户
     * User: YuY
     * Date: 2020/3/13
     */
    public function update(User $user, Request $request)
    {
        // 验证
        $this->validate($request, [
           'name' => 'required|max:50',
           'password' => 'required|confirmed|min:6'
        ]);

        // 更新
        $data = [];
        $data['name'] = $request->name;
        if($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        session()->flash('success', '个人资料更新成功！');

        return redirect()->route('users.show', $user->id);
    }

    /**
      * Desc: 用户页
      * User: YuY
      * Date: 2020/3/13
      */
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        // 删除策略
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '成功删除用户！');
        return back();
    }

    public function followings(User $user)
    {
        $users = $user->followings()->paginate(30);
        $title = $user->name . '关注的人';
        return view('users.show_follow', compact('users', 'title'));
    }

    public function followers(User $user)
    {
        $users = $user->followers()->paginate(30);
        $title = $user->name . '的粉丝';
        return view('users.show_follow', compact('users', 'title'));
    }
}

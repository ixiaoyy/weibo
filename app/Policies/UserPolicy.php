<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    /**
      * Desc: 更新策略
      * User: YuY
      * Date: 2020/3/13
      */
    public function update(User $currentUser, User $user)
    {
        // 当前登录用户实例必须等于要进行授权的用户
        return $currentUser->id === $user->id;
    }

    /**
     * Desc: 删除策略
     * User: LiJin
     * Date: 2020/3/16
     */
    public function destroy(User $currentUser, User $user)
    {
        return $currentUser->is_admin && $currentUser->id !== $user->id;
    }
}

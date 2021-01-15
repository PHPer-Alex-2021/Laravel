<?php

namespace App\Policies;

use App\Http\Model\User;
use App\Http\Model\Art;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArtPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the art.
     *
     * @param  \App\Http\Model\User  $user
     * @param  \App\Http\Model\Art  $art
     * @return mixed
     */
    public function view(User $user, Art $art)
    {
        //
    }

    /**
     * Determine whether the user can create art.
     *
     * @param  \App\Http\Model\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the art.
     *
     * @param  \App\Http\Model\User  $user
     * @param  \App\Http\Model\Art  $art
     * @return mixed
     */
    public function update(User $user, Art $art)
    {
        //
        return $user->is_admin || $user->id == $art->user_id;
    }

    /**
     * Determine whether the user can delete the art.
     *
     * @param  \App\Http\Model\User  $user
     * @param  \App\Http\Model\Art  $art
     * @return mixed
     */
    public function delete(User $user, Art $art)
    {
        //当前登录的账号信息  验证的模型
        return $user->is_admin || $user->id == $art->user_id;
    }

    /**
     * Determine whether the user can restore the art.
     *
     * @param  \App\Http\Model\User  $user
     * @param  \App\Http\Model\Art  $art
     * @return mixed
     */
    public function restore(User $user, Art $art)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the art.
     *
     * @param  \App\Http\Model\User  $user
     * @param  \App\Http\Model\Art  $art
     * @return mixed
     */
    public function forceDelete(User $user, Art $art)
    {
        //
    }
}

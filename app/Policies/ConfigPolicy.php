<?php

namespace App\Policies;

use App\Http\Model\User;
use App\Http\Model\Config;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConfigPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the config.
     *
     * @param  \App\Http\Model\User  $user
     * @param  \App\App\Http\Model\Config  $config
     * @return mixed
     */
    public function view(User $user, Config $config)
    {
        //
    }

    /**
     * Determine whether the user can create configs.
     *
     * @param  \App\Http\Model\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the config.
     *
     * @param  \App\Http\Model\User  $user
     * @param  \App\App\Http\Model\Config  $config
     * @return mixed
     */
    public function update(User $user, Config $config)
    {
        //
        return $user->is_admin || $user->id == $config->id;
    }

    /**
     * Determine whether the user can delete the config.
     *
     * @param  \App\Http\Model\User  $user
     * @param  \App\App\Http\Model\Config  $config
     * @return mixed
     */
    public function delete(User $user, Config $config)
    {
        //
        return $user->is_admin;
    }

    /**
     * Determine whether the user can restore the config.
     *
     * @param  \App\Http\Model\User  $user
     * @param  \App\App\Http\Model\Config  $config
     * @return mixed
     */
    public function restore(User $user, Config $config)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the config.
     *
     * @param  \App\Http\Model\User  $user
     * @param  \App\App\Http\Model\Config  $config
     * @return mixed
     */
    public function forceDelete(User $user, Config $config)
    {
        //
    }
}

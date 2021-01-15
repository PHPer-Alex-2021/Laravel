<?php

namespace App\Policies;

use App\Http\Model\User;
use App\Http\Model\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the category.
     *
     * @param  \App\Http\Model\User  $user
     * @param  \App\App\Http\Model\Category  $category
     * @return mixed
     */
    public function view(User $user, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can create categories.
     *
     * @param  \App\Http\Model\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the category.
     *
     * @param  \App\Http\Model\User  $user
     * @param  \App\App\Http\Model\Category  $category
     * @return mixed
     */
    public function update(User $user, Category $category)
    {
        //
        return $user->is_admin || $user->id == $category->id;
    }

    /**
     * Determine whether the user can delete the category.
     *
     * @param  \App\Http\Model\User  $user
     * @param  \App\App\Http\Model\Category  $category
     * @return mixed
     */
    public function delete(User $user, Category $category)
    {
        //
        return $user->is_admin;
    }

    /**
     * Determine whether the user can restore the category.
     *
     * @param  \App\Http\Model\User  $user
     * @param  \App\App\Http\Model\Category  $category
     * @return mixed
     */
    public function restore(User $user, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the category.
     *
     * @param  \App\Http\Model\User  $user
     * @param  \App\App\Http\Model\Category  $category
     * @return mixed
     */
    public function forceDelete(User $user, Category $category)
    {
        //
    }
}

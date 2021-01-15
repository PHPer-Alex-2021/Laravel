<?php

namespace App\Policies;

use App\Http\Model\User;
use App\Http\Model\ArtComment;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArtCommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the art comment.
     *
     * @param  \App\Http\Model\User  $user
     * @param  \App\Http\Model\ArtComment  $artComment
     * @return mixed
     */
    public function view(User $user, ArtComment $artComment)
    {
        //
    }

    /**
     * Determine whether the user can create art comments.
     *
     * @param  \App\Http\Model\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the art comment.
     *
     * @param  \App\Http\Model\User  $user
     * @param  \App\Http\Model\ArtComment  $artComment
     * @return mixed
     */
    public function update(User $user, ArtComment $artComment)
    {
        //
        return $user->is_admin || $user->id == $artComment->user_id;
    }

    /**
     * Determine whether the user can delete the art comment.
     *
     * @param  \App\Http\Model\User  $user
     * @param  \App\Http\Model\ArtComment  $artComment
     * @return mixed
     */
    public function delete(User $user, ArtComment $artComment)
    {
        //
        return $user->is_admin || $user->id == $artComment->user_id;
    }

    /**
     * Determine whether the user can restore the art comment.
     *
     * @param  \App\Http\Model\User  $user
     * @param  \App\Http\Model\ArtComment  $artComment
     * @return mixed
     */
    public function restore(User $user, ArtComment $artComment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the art comment.
     *
     * @param  \App\Http\Model\User  $user
     * @param  \App\Http\Model\ArtComment  $artComment
     * @return mixed
     */
    public function forceDelete(User $user, ArtComment $artComment)
    {
        //
    }
}

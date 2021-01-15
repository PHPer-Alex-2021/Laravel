<?php


namespace App\ObServer;


use App\Http\Model\User;

class UserObserver
{
    public function creating(User $user){
        $user->email_token=str_random(10);
        $user->email_active=false;
    }
}

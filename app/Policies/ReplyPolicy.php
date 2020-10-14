<?php

namespace App\Policies;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy {
    use HandlesAuthorization;

    public function viewAny(User $user){
        //
    }

    public function view(User $user, Reply $reply){
        //
    }

    public function create(User $user){
        //
    }

    public function update(User $user, Reply $reply){
        return $user->id == $reply->user_id;
    }

    public function delete(User $user, Reply $reply){
        return $user->id == $reply->user_id;
    }

    public function restore(User $user, Reply $reply){
        //
    }

    public function forceDelete(User $user, Reply $reply){
        //
    }
}

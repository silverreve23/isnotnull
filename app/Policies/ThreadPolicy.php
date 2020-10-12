<?php

namespace App\Policies;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThreadPolicy {
    use HandlesAuthorization;

    public function viewAny(User $user){
        //
    }

    public function view(User $user, Thread $thread){
        //
    }

    public function create(User $user){
        //
    }

    public function update(User $user, Thread $thread){
    }

    public function delete(User $user, Thread $thread){
        return $user->id == $thread->user_id;
    }

    public function restore(User $user, Thread $thread){
        //
    }

    public function forceDelete(User $user, Thread $thread){
        //
    }
}

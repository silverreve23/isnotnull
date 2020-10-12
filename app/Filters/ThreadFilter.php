<?php

namespace App\Filters;

use App\Models\User;
use App\Filters\Filter;
use Illuminate\Http\Request;

class ThreadFilter extends Filter {
    protected $filters = ['by', 'popular'];

    protected function by($user){
        $user = User::whereName($user)->firstOrFail();

        $this->builder = $this->builder->where('user_id', $user->id);
    }

    protected function popular(){
        $this->builder->getQuery()->orders = [];

        $this->builder = $this->builder->orderBy('replies_count', 'desc');
    }
}

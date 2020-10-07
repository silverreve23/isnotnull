<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;

class ReplyController extends Controller {
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function store(Thread $thread){
        $thread->addReplay(array(
            'body' => request('body'),
            'user_id' => auth()->user()->id,
        ));

        return back();
    }
}

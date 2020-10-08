<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;

class ReplyController extends Controller {
    public function __construct(){
        $this->middleware('auth');
    }

    public function store($channelSlug, Thread $thread, Request $request){
        $this->validate($request, array(
            'body' => 'required',
        ));

        $thread->addReplay(array(
            'body' => request('body'),
            'user_id' => auth()->user()->id,
        ));

        return back();
    }
}

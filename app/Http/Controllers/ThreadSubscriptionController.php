<?php

namespace App\Http\Controllers;
use App\Models\Thread;

class ThreadSubscriptionController extends Controller {
    public function __construct(){
        $this->middleware('auth')->except(['index']);
    }

    public function store($channelSlug, Thread $thread){
        $thread->subscribe();

        return response([]);
    }

    public function show($channelSlug, Thread $thread){
        return view('threads.show', compact('thread'));
    }

    public function destroy($channelSlug, Thread $thread){
        $thread->unsubscribe();

        return response([]);
    }
}

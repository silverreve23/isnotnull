<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Http\Request;

class ThreadController extends Controller {
    public function __construct(){
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Channel $channel){
        if($channel->exists){
            $threads = $channel->threads()->latest();
        }else{
            $threads = Thread::latest();
        }

        if($user = request('by')){
            $user = User::whereName($user)->firstOrFail();

            $threads = $threads->where('user_id', $user->id);
        }

        $threads = $threads->get();

        return view('threads.index', compact('threads'));
    }

    public function create(){
        return view('threads.create');
    }

    public function store(Request $request){
        $this->validate($request, array(
            'title' => 'required',
            'body' => 'required',
            'channel_id' => 'required|exists:channels,id',
        ));

        $thread = Thread::create(array(
            'title' => request('title'),
            'body' => request('body'),
            'channel_id' => request('channel_id'),
            'user_id' => auth()->user()->id,
        ));

        return redirect($thread->path());
    }

    public function show($channelSlug, Thread $thread){
        return view('threads.show', compact('thread'));
    }

    public function edit(Thread $thread){
        //
    }

    public function update(Request $request, Thread $thread){
        //
    }

    public function destroy(Thread $thread){
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Thread;
use App\Models\Channel;
use App\Filters\ThreadFilter;
use Illuminate\Http\Request;

class ThreadController extends Controller {
    public function __construct(){
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Channel $channel, ThreadFilter $filter){
        $threads = $this->getThreads($channel, $filter);

        if(request()->wantsJson()) return $threads;

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
        $replies = $thread->replies()->paginate(10);

        return view('threads.show', compact('thread', 'replies'));
    }

    public function edit(Thread $thread){
        //
    }

    public function update(Request $request, Thread $thread){
        //
    }

    public function destroy($channelSlug, Thread $thread){
        $this->authorize('delete', $thread);

        if($thread->user_id != auth()->user()->id){
            if(request()->wantsJson()){
                return response(['status' => 'Permission denied'], 403);
            }

            return redirect('/login');
        }

        $thread->delete();

        if(request()->wantsJson()){
            return response([], 204);
        }

        return redirect('/threads');
    }

    public function getThreads($channel, $filter){
        $threads = Thread::latest()->filter($filter);

        if($channel->exists){
            $threads = Thread::whereChannelId($channel->id);
        }

        return $threads->paginate();
    }
}

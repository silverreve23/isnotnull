<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;
use App\Models\Thread;

class ReplyController extends Controller {
    public function __construct(){
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index($channelSlug, Thread $thread){
        return $thread->replies()->paginate(10);
    }

    public function store($channelSlug, Thread $thread, Request $request){
        $this->validate($request, array(
            'body' => 'required',
        ));

        $reply = $thread->addReply(array(
            'body' => request('body'),
            'user_id' => auth()->user()->id,
        ));

        if(request()->expectsJson()){
            return $reply->load('owner');
        }

        return back()->with('flash', 'Your reply has been left!');;
    }

    public function update(Reply $reply, Request $request){
        $this->authorize('update', $reply);

        $this->validate($request, array(
            'body' => 'required',
        ));

        $reply->update(array(
            'body' => request('body')
        ));

        // return back()->with('flash', 'Your reply has been updated!');;
    }

    public function destroy(Reply $reply){
        $this->authorize('delete', $reply);

        $reply->delete();

        if(request()->expectsJson()){
            return response(['status' => 'Reply deleted']);
        }

        return back()->with('flash', 'Your reply has been deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller {
    public function __construct(){
        $this->middleware('auth')->only('store');
    }

    public function index(){
        $threads = Thread::get();

        return view('threads.index', compact('threads'));
    }

    public function create(){
        //
    }

    public function store(Request $request){
        $thread = Thread::create(array(
            'title' => request('title'),
            'body' => request('body'),
            'user_id' => auth()->user()->id,
        ));

        return redirect($thread->path());
    }

    public function show(Thread $thread){
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

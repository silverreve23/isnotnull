<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;
use App\Models\Favorite;

class FavoriteController extends Controller {
    public function __construct(){
        $this->middleware('auth');
    }

    public function store(Reply $reply, Request $request){
        $reply->favorite();

        return back()->with('flash', 'Reply has been favorited!');
    }
}

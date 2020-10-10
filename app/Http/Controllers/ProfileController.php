<?php

namespace App\Http\Controllers;

use App\Models\User;

class ProfileController extends Controller {
    public function __construct(){
        $this->middleware('auth')->except('show');
    }

    public function show(User $profile){
        $threads = $profile->threads()->paginate(10);

        return view('profiles.show', compact('profile', 'threads'));
    }
}

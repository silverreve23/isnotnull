<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Activity;

class ProfileController extends Controller {
    public function __construct(){
        $this->middleware('auth')->except('show');
    }

    public function show(User $profile){
        $activities = Activity::feed($profile);

        return view('profiles.show', compact('profile', 'activities'));
    }
}

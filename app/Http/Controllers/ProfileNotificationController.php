<?php

namespace App\Http\Controllers;
use App\Models\User;

class ProfileNotificationController extends Controller {
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(User $profile){
        return auth()->user()->unreadNotifications;
    }

    public function destroy(User $profile, $notifyID = null){
        auth()->user()->notifications()->findOrFail($notifyID)->markAsRead();

        return response([]);
    }
}

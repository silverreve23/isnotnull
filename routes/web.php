<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreadController;


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function(){
    return view('dashboard');
})->name('dashboard');

Route::get('/', function(){
    return view('welcome');
});

Route::resource('/threads', ThreadController::class)->names('threads');

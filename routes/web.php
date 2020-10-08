<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\ReplyController;


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function(){
    return view('dashboard');
})->name('dashboard');

Route::get('/', function(){
    return view('welcome');
});

Route::get('/threads', [ThreadController::class, 'index'])->name('threads.index');
Route::post('/threads', [ThreadController::class, 'store'])->name('threads.store');
Route::get('/threads/create', [ThreadController::class, 'create'])->name('threads.create');
Route::get('/threads/{channel}', [ThreadController::class, 'index'])->name('threads.index');
Route::get('/threads/{channel}/{thread}', [ThreadController::class, 'show'])->name('threads.show');
Route::post('/threads/{channel}/{thread}/replies', [ReplyController::class, 'store'])->name('replies.store');

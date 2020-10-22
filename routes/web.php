<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ThreadSubscriptionController;
use App\Http\Controllers\ProfileNotificationController;

use Illuminate\Support\Facades\Route;

Route::get('/', [ThreadController::class, 'index'])->name('threads.index');
Route::get('/dashboard', [ThreadController::class, 'index'])->name('threads.index');

Route::get('/threads', [ThreadController::class, 'index'])->name('threads.index');
Route::post('/threads', [ThreadController::class, 'store'])->name('threads.store');
Route::get('/threads/create', [ThreadController::class, 'create'])->name('threads.create');
Route::get('/threads/{channel}', [ThreadController::class, 'index'])->name('threads.index');
Route::get('/threads/{channel}/{thread}', [ThreadController::class, 'show'])->name('threads.show');
Route::delete('/threads/{channel}/{thread}', [ThreadController::class, 'destroy'])->name('threads.destroy');
Route::post('/threads/{channel}/{thread}/replies', [ReplyController::class, 'store'])->name('replies.store');
Route::get('/threads/{channel}/{thread}/replies', [ReplyController::class, 'index'])->name('replies.index');

Route::post('/threads/{channel}/{thread}/subscriptions', [ThreadSubscriptionController::class, 'store'])->name('subscriptions.store');
Route::delete('/threads/{channel}/{thread}/subscriptions', [ThreadSubscriptionController::class, 'destroy'])->name('subscriptions.destroy');

Route::delete('/replies/{reply}', [ReplyController::class, 'destroy'])->name('replies.destroy');
Route::patch('/replies/{reply}', [ReplyController::class, 'update'])->name('replies.update');
Route::post('/replies/{reply}/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
Route::delete('/replies/{reply}/favorites', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

Route::get('/profiles/{profile}', [ProfileController::class, 'show'])->name('profiles.show');
Route::get('/profiles/{profile}/notifications', [ProfileNotificationController::class, 'index'])->name('notifications.index');
Route::delete('/profiles/{profile}/notifications/{notification}', [ProfileNotificationController::class, 'destroy'])->name('notifications.destroy');

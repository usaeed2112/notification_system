<?php

use App\Http\Controllers\AsyncNotificationController;
use App\Http\Controllers\RealtimeNotificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});



Route::get('send/notification/async', [AsyncNotificationController::class, 'sendNotification'])->name('send.notification.async');
Route::get('subscribe/notification/async', [AsyncNotificationController::class, 'subscribeNotification'])->name('subscribe.notification.async');

Route::get('send/notification/realtime', [RealtimeNotificationController::class, 'sendNotification'])->name('send.notification.realtime');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

<?php

// Controller
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Setting\SettingController;
// Others
use Illuminate\Support\Facades\Route;



Route::view('/', 'welcome');


Route::get('/login', [AuthController::class, 'loginPage'])->middleware('not.logged.in')->name('login.page');
Route::post('/authenticate', [AuthController::class, 'login'])->middleware(['not.logged.in', 'throttle:login'])->name('login');


Route::prefix('chat-app')->middleware('auth')->name('chat.')->group(function () {

    Route::controller(AuthController::class)->group(function () {
        // GET
        Route::get('/logout', 'logout')->name('logout');
    });


    Route::get('/', HomeController::class)->name('home');

    Route::controller(ChatController::class)->group(function () {

        //POST
        Route::post('/chat-view', 'getChatView')->name('view');
        Route::post('/send-message', 'create')->name('send.message');
        Route::post('/get-message', 'getMessage')->name('get.message');
        Route::post('/message-update', 'updateMessage')->name('message.update');
        Route::post('/get-delete-message', 'getDeleteMessage')->name('get.delete.message');
        Route::post('/message-delete', 'deleteMessage')->name('message.delete');
    });

    Route::controller(SettingController::class)->group(function () {
        // GET
        Route::get('/setting', 'index')->name('setting');

        //POST
        Route::post('/setting/update/avatar', 'updateAvatar')->name('setting.update.avatar');
        Route::post('/setting/update/password', 'updatePassword')->name('setting.update.password');
    });
});

<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});



// Gönderen
Broadcast::channel('sender-message.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('sender-update-message.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('sender-delete-message.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});



// Alıcı
Broadcast::channel('receiver-message.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('receiver-update-message.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('receiver-delete-message.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

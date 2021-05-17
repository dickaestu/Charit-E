<?php

use App\AdminModel\JenisBencana;
use App\PoskoModel\PermintaanBarang;
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

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->user_id === (int) $id;
});

Broadcast::channel('App.PoskoModel.PermintaanBarang', function ($item) {
    return $item;
});

Broadcast::channel('chat', function ($item) {
    return $item;
});

Broadcast::channel('verifikasiPermintaan', function ($item) {
    return $item;
});

Broadcast::channel('permintaanLogistikVerified', function ($item) {
    return $item;
});

Broadcast::channel('infoKorban', function ($item) {
    return $item;
});

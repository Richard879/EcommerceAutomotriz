<?php

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
    return (int) $user->id === (int) $id;
});

/**
 * El Metodo Channel acepta dos argumentos:
 * el nombre del canal y una devolución de llamada que devuelve true o false
 * que indica si el usuario está autorizado para escuchar en el canal
 */
Broadcast::channel('userlogout.{id}', function ($user, $id) {
    // verificar que cualquier usuario que intente escuchar en el canal privado sea ​​igual al que origino el evento
    return (int) $user->id === (int) $id;
});

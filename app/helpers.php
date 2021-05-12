<?php

use Illuminate\Support\Facades\Route;

function set_message_flash ($message, $type = 'success') {
    session ()->flash ('notification.message', $message);
    session ()->flash ('notification.type', $type);
}

function set_active_route () {

    foreach (func_get_args() as $route ) {

        if (Route::is ($route)) {
           return 'active';
        }

    }
}

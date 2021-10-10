<?php

use Illuminate\Support\Facades\Log;

Broadcast::channel('screen_wire_auth_{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
<?php

use Illuminate\Support\Facades\Log;
use Vinkla\Hashids\Facades\Hashids;

Broadcast::channel('screen_wire_auth_{id}', function ($user, $id) {
    $id = Hashids::decode($id);
    
    if(count($id) > 0)
        return (int) $user->id === (int) $id[0];
});
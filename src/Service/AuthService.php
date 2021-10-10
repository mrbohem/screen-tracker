<?php

namespace Mrbohem\ScreenWire\Service;

use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Mrbohem\ScreenWire\Contract\ClientContract;

class AuthService extends ClientContract
{
    public function send()
    {
        Livewire::listen('component.dehydrate', function ($component, $response) {
            if (config('screen-wire.auth') && Auth::check()) {
                $this->broadcastAuthScreen($component, $response);
            }
        });
    }
}

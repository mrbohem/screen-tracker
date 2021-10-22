<?php

namespace Mrbohem\ScreenTracker\Service;

use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Mrbohem\ScreenTracker\Contract\ClientContract;

class AuthService extends ClientContract
{
    public function send()
    {
        Livewire::listen('component.dehydrate', function ($component, $response) {
            if (config('screen-tracker.auth') && Auth::check()) {
                $this->broadcastAuthScreen($component, $response);
            }
        });
    }
}

<?php

namespace Mrbohem\ScreenTracker\Service;

use Livewire\Livewire;
use Mrbohem\ScreenTracker\Contract\ClientContract;

class PublicService extends ClientContract
{
    public function send()
    {
        Livewire::listen('component.dehydrate', function ($component, $response) {
            $this->broadcastPublicScreen($component, $response);
        });
    }
}

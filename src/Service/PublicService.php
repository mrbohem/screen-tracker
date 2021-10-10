<?php

namespace Mrbohem\ScreenWire\Service;

use Livewire\Livewire;
use Mrbohem\ScreenWire\Contract\ClientContract;

class PublicService extends ClientContract
{
    public function send()
    {
        Livewire::listen('component.dehydrate', function ($component, $response) {
            $this->broadcastPublicScreen($component, $response);
        });
    }
}

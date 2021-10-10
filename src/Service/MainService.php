<?php

namespace Mrbohem\ScreenWire\Service;

use Mrbohem\ScreenWire\Contract\ClientContract;

class MainService
{
    public function __construct(public ClientContract $client)
    {
    }

    public function send()
    {
        $this->client->send();
    }
}

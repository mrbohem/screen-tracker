<?php

namespace Mrbohem\ScreenTracker\Service;

use Mrbohem\ScreenTracker\Contract\ClientContract;

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

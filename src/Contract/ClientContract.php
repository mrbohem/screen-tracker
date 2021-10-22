<?php

namespace Mrbohem\ScreenTracker\Contract;

use Illuminate\Support\Facades\Auth;
use Mrbohem\ScreenTracker\Events\ScreenTrackerAuthEvent;
use Mrbohem\ScreenTracker\Events\ScreenTrackerEvent;

abstract class ClientContract
{
    abstract public function send();

    protected function isEvent(array $updates): bool
    {
        if ($updates) {
            return ($updates[0]['type'] == "fireEvent") ? true : false;
        }

        return false;
    }

    protected function broadcastAuthScreen($component, $response)
    {
        $fireEvent = $this->isEvent($response->request->updates);
        if (isset($component->shouldBroadcast)) {
            if ($component->shouldBroadcast && ! $fireEvent) {
                event(new ScreenTrackerAuthEvent(
                    Auth::id(),
                    $response->request->fingerprint['id'],
                    $response->request->fingerprint['name'],
                    $response->request->updates,
                    $response->memo['data'] ?? [],
                    'take'
                ));
            } else {
                $component->shouldBroadcast = true;
            }
        }
    }

    protected function broadcastPublicScreen($component, $response)
    {
        $fireEvent = $this->isEvent($response->request->updates);
        if (isset($component->shouldBroadcast)) {
            if ($component->shouldBroadcast && ! $fireEvent) {
                event(new ScreenTrackerEvent(
                    $response->request->fingerprint['id'],
                    $response->request->fingerprint['name'],
                    $response->request->updates,
                    $response->memo['data'] ?? [],
                    'take'
                ));
            } else {
                $component->shouldBroadcast = true;
            }
        }
    }
}

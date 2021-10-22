<?php

namespace Mrbohem\ScreenWire\Contract;

use Illuminate\Support\Facades\Auth;
use Mrbohem\ScreenWire\Events\ScreenWireAuthEvent;
use Mrbohem\ScreenWire\Events\ScreenWireEvent;

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
                event(new ScreenWireAuthEvent(
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
                event(new ScreenWireEvent(
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

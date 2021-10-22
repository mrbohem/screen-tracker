<?php

namespace Mrbohem\ScreenTracker\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Vinkla\Hashids\Facades\Hashids;

class ScreenTrackerAuthEvent implements ShouldBroadcastNow
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        public int $userId,
        public string $compId,
        public string $component,
        public array $updates,
        public array $params,
        public bool $shouldReceive,
    ) {
    }

    public function broadcastAs()
    {
        return 'App\Events\ScreenTrackerAuthEvent';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('screen_tracker_auth_'. Hashids::encode($this->userId));
    }
}

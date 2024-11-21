<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewFeexPaymentPayloadEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public string $message;
    public int $userId;

    /**
     * Create a new event instance.
     */
    public function __construct(string $message, int $id)
    {
        $this->userId = $id;
        $this->message = $message;
    }

    /**
     * The data to broadcast.
     *
     * @return array
     */
    public function broadcastWith(): array
    {
        return [
            'message' => $this->message,
            'userId' => $this->userId,
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('payment-status-updated.' . $this->userId),
        ];
    }
}

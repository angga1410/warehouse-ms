<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TransactionInventoryEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $type;
    public $txnId;
    public $inventoryId;
    public $qtyIn;
    public $qtyOut;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($type, $txnId, $inventoryId, $qtyIn, $qtyOut)
    {
        $this->type        = $type;
        $this->txnId       = $txnId;
        $this->inventoryId = $inventoryId;
        $this->qtyIn       = $qtyIn;
        $this->qtyOut      = $qtyOut;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

<?php

namespace App\Events;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InvoiceActionPerformed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // public $invoice;
    // public $action;
    // public $user;
    // public $role;

    /**
     * Create a new event instance.
     */
    // public function __construct(Invoice $invoice, string $action, User $user, string $role)
    // {
        // $this->invoice = $invoice;
        // $this->action  = $action;
        // $this->user    = $user;
        // $this->role    = $role;
    // }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}

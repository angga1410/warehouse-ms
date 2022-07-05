<?php

namespace App\Listeners;

use App\Events\TransactionInventoryEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\TransactionInventory;

class TransactionInventoryListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TransactionInventoryEvent  $event
     * @return void
     */
    public function handle(TransactionInventoryEvent $event)
    {
        $transactionData = new TransactionInventory;
        $transactionData->txn_type     = $event->type;
        $transactionData->txn_id       = $event->txnId;
        $transactionData->inventory_id = $event->inventoryId;
        $transactionData->qty_in       = $event->qtyIn;
        $transactionData->qty_out      = $event->qtyOut;
        $transactionData->save();

    }
}

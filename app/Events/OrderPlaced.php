<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderPlaced
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $customerAddress;
    public $carts;
    public $shippingCharge;
    public $subTotal;
    public $couponDiscount;
    public $totalCharge;


    /**
     * Create a new event instance.
     */
    public function __construct($customerAddress,$carts,$shippingCharge,$subTotal,$couponDiscount,$totalCharge)
    {
        $this->customerAddress=$customerAddress;
        $this->carts=$carts;
        $this->shippingCharge=$shippingCharge;
        $this->subTotal=$subTotal;
        $this->couponDiscount=$couponDiscount;
        $this->totalCharge=$totalCharge;
    }

   
}

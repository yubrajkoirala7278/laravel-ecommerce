<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Mail\CustomerMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class NotifyUser
{
    
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(OrderPlaced $event)
    {
        $carts = $event->carts->toArray();
       Mail::to(Auth::user()->email)->send(new CustomerMail($event->customerAddress,$carts,$event->shippingCharge,$event->subTotal,$event->couponDiscount,$event->totalCharge));
    }
}

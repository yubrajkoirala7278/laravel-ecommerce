<?php

namespace App\Listeners;

use App\Events\ContactFormSubmitted;
use App\Mail\ContactMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendContactFormEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ContactFormSubmitted $event): void
    {
        Mail::to('yubrajkoirala7278@gmail.com')->queue(new ContactMail($event->data));
    }
}

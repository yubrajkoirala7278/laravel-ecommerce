<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $customerAddress;
    public $carts;
    public $shippingCharge;
    public $subTotal;
    public $couponDiscount;
    public $totalCharge;

    /**
     * Create a new message instance.
     */
    public function __construct($customerAddress, $carts, $shippingCharge, $subTotal, $couponDiscount, $totalCharge)
    {
        $this->customerAddress = $customerAddress;
        $this->carts = $carts;
        $this->shippingCharge = $shippingCharge;
        $this->subTotal = $subTotal;
        $this->couponDiscount = $couponDiscount;
        $this->totalCharge = $totalCharge;
    }


    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.notify_user_invoice',
            with: [
                'customerAddress' => $this->customerAddress,
                'carts' => $this->carts,
                'shippingCharge' => $this->shippingCharge,
                'subTotal' => $this->subTotal,
                'couponDiscount' => $this->couponDiscount,
                'totalCharge' => $this->totalCharge,
            ]
        );
    }
    

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->view('mail.notify_user_invoice')
            ->with([
                'customerAddress' => $this->customerAddress,
                'carts' => $this->carts,  // Make sure carts is explicitly set
                'shippingCharge' => $this->shippingCharge,
                'subTotal' => $this->subTotal,
                'couponDiscount' => $this->couponDiscount,
                'totalCharge' => $this->totalCharge,
            ]);
    }
}

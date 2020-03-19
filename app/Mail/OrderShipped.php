<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    private $sendto;
    private $id;
    private $orderProducts;
    private $totalPrice;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sendto, $orderId, $orderProducts, $totalPrice)
    {
        $this->sendto = $sendto;
        $this->id = $orderId;
        $this->orderProducts = $orderProducts;
        $this->totalPrice = $totalPrice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->to($this->sendto)
            ->view('mail', [
                'order_id' => $this->id,
                'order_products' => $this->orderProducts,
                'order_total_price' => $this->totalPrice
            ]);
    }
}

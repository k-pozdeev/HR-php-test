<?php

namespace App\Services;

use App\Http\Requests\OrderSaveRequest;
use App\Jobs\SendEmail;
use App\Mail\OrderShipped;
use App\Order;
use Illuminate\Queue\Jobs\Job;

class OrderService
{
    /**
     * @param string $type
     * @return Order[]
     */
    public function getOrders($type = 'overdued') {
        $query = Order::query()
            ->select(['orders.*', 'pr.name AS partner_name'])
            ->selectRaw('sum(op.quantity * op.price) AS order_price')
            ->selectRaw('GROUP_CONCAT(DISTINCT p.name ORDER BY p.name SEPARATOR \', \') AS order_list')
            ->join('order_products AS op', 'op.order_id', '=', 'orders.id')
            ->join('products AS p', 'op.product_id', '=', 'p.id')
            ->join('partners AS pr', 'orders.partner_id', '=', 'pr.id')
            ->groupBy('orders.id');
        switch ($type) {
            case 'overdued':
                $query->whereOverdued()
                    ->orderBy('delivery_dt', 'desc')
                    ->limit(50);
                break;
            case 'active':
                $query->whereActive()
                    ->orderBy('delivery_dt', 'asc');
                break;
            case 'new':
                $query->whereNew()
                    ->orderBy('delivery_dt', 'asc')
                    ->limit(50);
                break;
            case 'complete':
                $query->whereComplete()
                    ->orderBy('delivery_dt', 'desc')
                    ->limit(50);
        }
        return $query->get();
    }

    public function save(Order $order, OrderSaveRequest $orderSaveRequest) {
        $order->status = $orderSaveRequest->get('status');
        $order->partner_id = $orderSaveRequest->get('partner_id');
        $order->client_email = $orderSaveRequest->get('client_email');
        $order->save();

        if ($order->status == Order::STATUS_COMPLETE) {
            $this->sendOrderCompleteNotification($order);
        }
    }

    private function sendOrderCompleteNotification(Order $order) {
        $sendto = [];
        $sendto[] = $order->partner->email;
        $orderProducts = $order->orderProducts()->with('product.vendor')->get();
        foreach ($orderProducts as $orderProduct) {
            $sendto[] = $orderProduct->product->vendor->email;
        }
        foreach ($sendto as $address) {
            $mail = new OrderShipped($address, $order->id, $orderProducts, $order->getTotalPrice());
            SendEmail::dispatch($mail);
        }
    }
}
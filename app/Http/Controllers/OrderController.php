<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderSaveRequest;
use App\Order;
use App\Partner;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders(Request $request, OrderService $orderService) {
        $type = $request->get('type', 'overdued');
        if (!in_array($type, ['overdued', 'active', 'new', 'complete'])) {
            $type = 'overdued';
        }
        $orders = $orderService->getOrders($type);
        $data = [
            'title' => 'Заказы',
            'menu_active' => 'orders',
            'orders' => $orders,
            'type' => $type,
        ];
        return view('orderlist', $data);
    }

    public function orderEdit($id) {
        /** @var Order $order */
        $order = Order::with('orderProducts.product')->findOrFail($id);
        $partners = Partner::all();
        $data = [
            'title' => 'Заказ №' . $id,
            'menu_active' => 'orders',
            'order' => $order,
            'partners' => $partners,
            'order_total_price' => $order->getTotalPrice(),
        ];
        return view('order-edit', $data);
    }

    public function orderSave(OrderSaveRequest $orderSaveRequest, OrderService $orderService, $id) {
        /** @var Order $order */
        $order = Order::findOrFail($id);
        $orderService->save($order, $orderSaveRequest);
        return redirect()->back()->with('flash', 'Заказ сохранен');
    }
}

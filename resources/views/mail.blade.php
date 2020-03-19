<h1>Заказ №{{ $order_id }} завершен</h1>

<h2>Список продуктов</h2>
<ul>
    @foreach($order_products as $order_product)
        <li>{{ $order_product->product->name }}</li>
    @endforeach
</ul>

<p>Стоимость заказа: {{ $order_total_price }}</p>
@extends('layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <ul class="nav nav-tabs">
                <li role="presentation" class="{{ $type == 'overdued' ? 'active' : '' }}">
                    <a href="{{ route('orders', ['type' => 'overdued'], false) }}">Просроченные</a>
                </li>
                <li role="presentation" class="{{ $type == 'active' ? 'active' : '' }}">
                    <a href="{{ route('orders', ['type' => 'active'], false) }}">Текущие</a>
                </li>
                <li role="presentation" class="{{ $type == 'new' ? 'active' : '' }}">
                    <a href="{{ route('orders', ['type' => 'new'], false) }}">Новые</a>
                </li>
                <li role="presentation" class="{{ $type == 'complete' ? 'active' : '' }}">
                    <a href="{{ route('orders', ['type' => 'complete'], false) }}">Завершенные</a>
                </li>
            </ul>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Партнер</th>
                        <th>Стоимость</th>
                        <th>Состав заказа</th>
                        <th>Статус</th>
                    </tr>
                </thead>
                <tbody>
                @php /** @var \App\Order $order */ @endphp
                @foreach($orders as $order)
                    <tr>
                        <td><a href="{{ route('orders-edit', ['id' => $order->id]) }}">{{ $order->id }}</a></td>
                        <td>{{ $order->partner_name }}</td>
                        <td>{{ $order->order_price }}</td>
                        <td>{{ $order->order_list }}</td>
                        <td>{{ \App\Order::STATUS_LABELS[$order->status] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
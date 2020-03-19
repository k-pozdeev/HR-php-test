@extends('layout')

@section('content')
    @php
        /**
         * @var \App\Order $order
         * @var \App\Partner $partner
         * @var \App\OrderProduct $orderProduct
         */
    @endphp
    <div class="row">
        <div class="col-6 col-lg-6 col-md-6 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="post" action="{{ route('orders-save', ['id' => $order->id]) }}">
                        {!! csrf_field() !!}
                        <div class="container">

                        </div>

                        <div class="form-group{{ isset($errors) && $errors->has('client_email') ? ' has-error' : '' }}">
                            <label for="client_email">E-mail клиента</label>
                            <input id="client_email"
                                   class="form-control"
                                   type="text"
                                   name="client_email"
                                   value="{{ old('client_email', $order->client_email) }}">
                            @if(isset($errors) && $errors->has('client_email'))
                                <span class="help-block">{{ $errors->first('client_email') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ isset($errors) && $errors->has('partner_id') ? ' has-error' : '' }}">
                            <label for="partner_id">Партнер</label>
                            <select id="partner_id"
                                    name="partner_id"
                                    class="form-control">
                                @foreach($partners as $p)
                                    <option value="{{ $p->id }}"
                                            {{ old('partner_id', $order->partner_id) == $p->id ? ' selected' : '' }}
                                    >{{ $p->name }}</option>
                                @endforeach
                            </select>
                            @if(isset($errors) && $errors->has('partner_id'))
                                <span class="help-block">{{ $errors->first('partner_id') }}</span>
                            @endif
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Продукты в заказе
                            </div>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Наименование</th>
                                    <th>Количество</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->orderProducts as $orderProduct)
                                    <tr>
                                        <td>{{ $orderProduct->product->name }}</td>
                                        <td>{{ $orderProduct->quantity }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group{{ isset($errors) && $errors->has('status') ? ' has-error' : '' }}">
                            <label for="status">Статус заказа</label>
                            <select id="status"
                                    name="status"
                                    class="form-control">
                                @foreach(\App\Order::STATUS_LABELS as $id => $label)
                                    <option value="{{ $id }}"{{ old('status', $order->status) == $id ? ' selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if(isset($errors) && $errors->has('status'))
                                <span class="help-block">{{ $errors->first('status') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <p>Стоимость заказа: {{ $order_total_price }}</p>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-primary" value="Сохранить"/>
                        </div>
                    </form>
                    {{--            <table class="table table-striped table-bordered table-hover">--}}
                    {{--                <thead>--}}
                    {{--                    <tr>--}}
                    {{--                        <th>ID</th>--}}
                    {{--                        <th>Партнер</th>--}}
                    {{--                        <th>Стоимость</th>--}}
                    {{--                        <th>Состав заказа</th>--}}
                    {{--                        <th>Статус</th>--}}
                    {{--                    </tr>--}}
                    {{--                </thead>--}}
                    {{--                <tbody>--}}
                    {{--                @php /** @var \App\Dto\OrderDto $order */ @endphp--}}
                    {{--                @foreach($orders as $order)--}}
                    {{--                    <tr>--}}
                    {{--                        <td><a href="{{ route('orders-edit', ['id' => $order->id]) }}">{{ $order->id }}</a></td>--}}
                    {{--                        <td>{{ $order->partner_name }}</td>--}}
                    {{--                        <td>{{ $order->order_price }}</td>--}}
                    {{--                        <td>{{ $order->order_list }}</td>--}}
                    {{--                        <td>{{ $order->status }}</td>--}}
                    {{--                    </tr>--}}
                    {{--                @endforeach--}}
                    {{--                </tbody>--}}
                    {{--            </table>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
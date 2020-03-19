@extends('layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Наименование продукта</th>
                        <th>Наименование поставщика</th>
                        <th>Цена</th>
                        <th>Сохранить</th>
                    </tr>
                </thead>
                <tbody>
                @php /** @var \App\Product $product */ @endphp
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->vendor_name }}</td>
                        <td>
                            <div class="form-group">
                                <input class="product-price form-control"
                                       type="text"
                                       value="{{ $product->price }}"
                                       data-id="{{ $product->id }}"/>
                            </div>
                        </td>
                        <td>
                            <button class="product-price-save" type="button" disabled>Сохранить</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            @include('pagination', ['paginator' => $paginator])
        </div>
    </div>
@endsection
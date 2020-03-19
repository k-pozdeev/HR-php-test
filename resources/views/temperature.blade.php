@extends('layout', ['title' => $title, 'menu_active' => $menu_active])

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            @if($temperature === null)
                <strong>Сервис временно недоступен. Попробуйте перезагрузить страницу позднее.</strong>
            @else
                <p>Температура в Брянске: {{ $temperature }} градусов Цельсия.</p>
            @endif
        </div>
    </div>
@endsection
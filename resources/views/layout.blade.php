<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{{ $title }}</title>
    <link href="/css/app.css" rel="stylesheet">
    <script src="/js/app.js"></script>
    <script src="/js/script.js"></script>
    <link rel="shortcut icon" href="/favicon.ico" type="image/png">
</head>
<body>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">The Site</a>
        </div>
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    @php $menu_active = $menu_active ?? null; @endphp
                    <li class="{{ $menu_active == 'temperature' ? 'active' : '' }}">
                        <a href="{{ route('temperature', [], false) }}" class="{{ ($menu_active == 'temperature') ? 'active' : '' }}">
                            <i class="fa fa-th-list fa-fw"></i>
                            Температура в Брянске
                        </a>
                    </li>
                    <li class="{{ $menu_active == 'orders' ? 'active' : '' }}">
                        <a href="{{ route('orders', [], false) }}" class="{{ ($menu_active == 'orders') ? 'active' : '' }}">
                            <i class="fa fa-th-list fa-building" style="width: 15px; margin-left: 3px;"></i>
                            Заказы
                        </a>
                    </li>
                    <li class="{{ $menu_active == 'products' ? 'active' : '' }}">
                        <a href="{{ route('products', [], false) }}" class="{{ ($menu_active == 'products') ? 'active' : '' }}">
                            <i class="fa fa-th-list fa-rocket" style="width: 15px; margin-left: 3px;"></i>
                            Продукты
                        </a>
                    </li>
{{--                    <li class="{{ (in_array($menu_active,array('icos')))?'active':'' }}">--}}
{{--                        <a href="{{ route('admin-icos', [], false) }}" class="{{ ($menu_active=='icos')?'active':'' }}">--}}
{{--                            <i class="fa fa-navicon fa-fw"></i>--}}
{{--                            ICOs--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="{{ (in_array($menu_active,array('articles')))?'active':'' }}">--}}
{{--                        <a href="{{ route('admin-articles', [], false) }}" class="{{ ($menu_active=='articles')?'active':'' }}">--}}
{{--                            <i class="fa fa-wordpress fa-fw"></i>--}}
{{--                            Articles--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="{{ (in_array($menu_active,array('news')))?'active':'' }}">--}}
{{--                        <a href="{{ route('admin-news', [], false) }}" class="{{ ($menu_active=='news')?'active':'' }}">--}}
{{--                            <i class="fa fa-newspaper-o fa-fw"></i>--}}
{{--                            News--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="{{ (in_array($menu_active,array('texts')))?'active':'' }}">--}}
{{--                        <a href="{{ route('admin-texts', [], false) }}" class="{{ ($menu_active=='texts')?'active':'' }}">--}}
{{--                            <i class="fa fa-paragraph fa-fw"></i>--}}
{{--                            Page Meta, Texts--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="{{ (in_array($menu_active,array('subscribers')))?'active':'' }}">--}}
{{--                        <a href="{{ route('admin-subscribers', [], false) }}" class="{{ ($menu_active=='subscribers')?'active':'' }}">--}}
{{--                            <i class="fa fa-mail-reply fa-fw"></i>--}}
{{--                            Subscribers--}}
{{--                        </a>--}}
{{--                    </li>--}}
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>
    {{--<!-- /.navbar-static-side -->--}}
    {{--</nav>--}}

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">{{ $title }}</h2>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        @if( $flash = session('flash'))
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <span>{{ $flash }}</span>
            </div>
        @endif
        @yield('content')
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
@stack('body-bottom-scripts')
</body>

</html>
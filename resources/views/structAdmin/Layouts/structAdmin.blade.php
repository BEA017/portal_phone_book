<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{asset('css/adminPage.css') }}">

{{--    <link rel="stylesheet" href={{ asset('css/bs/bootstrap.min.css') }}>--}}
{{--    <script type="text/javascript" src="{{ asset('js/bs/bootstrap.min.js') }}"></script>--}}

    <script type="text/javascript" src="{{ asset('js/menu.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/tableSearch.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/postAdm.js') }}"></script>


    <title>Document</title>
</head>
<body>
<a class="btnEdit" href="{{route('phoneBook')}}">К Справочнику</a>
<ul class="main-menu">

    <li class="menu-link"><a href="{{route('sa.employee')}}">Сотрудники</a></li>
    <li class="menu-link"><a href="{{route('sa.status')}}">Статус</a></li>
    <li class="menu-link"><a href="{{route('sa.structs')}}">Отделы</a></li>
{{--    <li class="menu-link"><a href="{{route('sa.accounting')}}">Прием/увольнение</a></li>--}}
    <li class="menu-link"> <a   href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            {{ __('Выйти') }}
        </a> <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form></li>

</ul>
@if(session('success'))
    <div style="background-color: Green;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background-color: Red;">
        {{ session('error') }}
    </div>
@endif

 @yield('content')


</body>
</html>

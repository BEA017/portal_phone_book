<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/btnAuth.css') }}">
    <script type="text/javascript" src="{{ asset('js/tableSearch.js') }}"></script>
    <title>Document</title>


</head>
<body>
<div class="page">
    <div class="head">
        <div class="title">
                <span>
                    Справочник
                </span>

            <div class="search">
                <img src="{{asset('./img/search_icon.svg') }}" alt="Поиск"/>
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Поиск">
            </div>
        </div>
        <div class="head_table">
            <div class="td">
                ФИО
            </div>
            <div class="td">
                Должность
            </div>
            <div class="td">
                № кабинета
            </div>
            <div class="td">
                Рабочий телефон
            </div>
            <div class="td">
                Внутренний телефон
            </div>
            <div class="td">
                Мобильный телефон
            </div>
            <div class="td">
                Электронная почта
            </div>
{{--            <div class="td">--}}
{{--                Корпоративная почта--}}
{{--            </div>--}}
            <div class="td">
                Статус
            </div>
            <div class="td">
                @guest
                    @if (Route::has('login'))

                            <a class="btnAuth" href="{{ route('login') }}">{{ __('Войти') }}</a>

                    @endif

                    @if (Route::has('register'))

                    @endif
                @else

                        <a id="navbarDropdown" class="btnAuth" href="{{route('login')}}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>


                            <a class="btnAuth" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Выйти') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>


                @endguest
            </div>
        </div>
    </div>
    <div class="content">

        <div class="table" id="dataTable">
            @foreach($structures as $struct)
                <div class="title_post">
                    {{$struct->structName}}
                </div>
                @foreach($employeeCard as $item)
                    @if($struct->structName == $item->structName)
                    <div class="row">
                        <div class="td name">
                            {{$item->personName}}
                        </div>
                        <div class="td post">
                            {{$item->postName}}
                        </div>
                        <div class="td">
                            {{$item->workplaceAddress}}
                        </div>
                        <div class="td">
                            {{$item->workPhoneNumber}}
                        </div>
                        <div class="td">
                            {{$item->internalPhoneNumber}}
                        </div>
                        <div class="td">
                            {{$item->personalPhoneNumber}}
                        </div>
                        <div class="td">
                            <a href="mailto:{{$item->personalEmail}}">{{$item->personalEmail}}</a>
                       </div>  <!--
{{--                        <div class="td">--}}
{{--                            <a href="mailto:{{$item->personalEmail}}">{{$item->personalEmail}}</a>--}}
{{--                        </div>--}} -->
                        <div class="td status">
                            <div class="circle"></div>
                            @foreach($statuses as $status)
                                @if( $item->absenceType == $status->id)
                                    {{$status->statusName}}
                                @endif

                            @endforeach
                        </div>
                    </div>
                    @endif
                @endforeach
            @endforeach
        </div>
    </div>
</div>

</body>
</html>

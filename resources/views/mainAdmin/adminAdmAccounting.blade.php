@extends('mainAdmin.Layouts.mainAdm')
@section('content')

<div class="container" id="admin" >
    <div class="left">
        <b>Аккаунты</b>
        <input type="text" id="myInput" onkeyup="AnyTablesSearch()" placeholder="Поиск...">
        <table id="dataTable">
            <thead>
            <tr>
                <th>Роль</th>
                <th>Название структуры</th>
                <th>ФИО Администратора</th>
                <th>Логин</th>
            </tr>
            </thead>
            <tbody>
            @if($userCards->count()>0)
                @foreach($userCards as $item)
                    <tr   id="{{$item->id}}">
                        <td>{{$item->role}}</td>
                        <td>{{$item->structName}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                         <td>
                             <form id="tableForm" accept-charset="UTF-8" action="{{route('ma.admins.del', $item->id)}}"   method="post"   >
                                 @csrf
                                 @method('delete')
                                 <button type="submit"  style="background-color: Red;" onclick="return confirm('Вы уверены, что хотите удалить?')" >Удалить</button>
                             </form></td>
                    </tr>
                @endforeach
            @endif
            <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
    <div class="right">
         <a class="btnEdit"   href="{{ route('register') }}">{{ __('Зарегистрировать администратора') }}</a>
    </div>
</div>
@endsection

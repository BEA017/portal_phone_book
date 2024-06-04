@extends('mainAdmin.Layouts.mainAdm')
@section('content')
    <b>Статусы</b>
    <div class="container" id="struct">
        <div class="left">

            <input type="text" id="myInput" onkeyup="AnyTablesSearch()" placeholder="Поиск...">
            <table id="dataTable">
                <thead>
                <tr>
                    <th>Номер(ID)</th>
                    <th>Название статуса</th>
                     <th> </th>
                </tr>
                </thead>
                <tbody>
                @foreach($Statuses as $item)
                    <tr id="{{$item->id}}">
                        <td>{{$item->id}}</td>
                        <td>{{$item->statusName}}</td>

                        <td><a class="btnEdit" href="{{route('ma.statuses.edit',$item->id)}}">Редактировать</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="right">
            <form id="tableForm" accept-charset="UTF-8" action="{{route('ma.statuses.create')}}" method="post" >
                @csrf
                <b>Название должности</b>
                <input name="StatusName" type="text" id="inputStatusName" placeholder="">

                <br>

                <button type="submit"  id="submitBtn" >Добавить новый</button>
            </form>
        </div>

    </div>
@endsection

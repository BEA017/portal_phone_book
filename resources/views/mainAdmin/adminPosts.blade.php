@extends('mainAdmin.Layouts.mainAdm')

@section('content')
    <div class="container" id="struct">
        <div class="left">
            <b>Должности</b>
            <input type="text" id="myInput" onkeyup="AnyTablesSearch()" placeholder="Поиск...">
            <table id="dataTable">
                <thead>
                <tr>
                    <th>Номер(ID)</th>
                    <th>Название должности</th>
                    <th>Младше чем(ID)</th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                @foreach($Posts as $item)
                    <tr id="{{$item->id}}">
                        <td>{{$item->id}}</td>
                        <td>{{$item->postName}}</td>
                        <td>{{$item->parentId}}</td>

                        <td><a class="btnEdit" href="{{route('ma.posts.edit',$item->id)}}">Редактировать</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="right">
            <form id="tableForm" accept-charset="UTF-8" action="{{route('ma.posts.create')}}" method="post" >
                @csrf
                <b>Название должности</b>
                <input name="PostName" type="text" id="inputPostName" placeholder="">
                <b>Подчинен(ID)</b>
                <input name="ParentId" type="text" id="inputPostParent" placeholder="">

                <br>

                <button type="submit"  id="submitBtn" >Добавить новый</button>
            </form>
        </div>

    </div>
@endsection

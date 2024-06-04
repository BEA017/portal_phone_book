@extends('mainAdmin.Layouts.mainAdm')
@section('content')
    <div class="container" id="struct">
        <div class="left">
            <b>Отделы</b>
            <input type="text" id="myInput" onkeyup="AnyTablesSearch()" placeholder="Поиск...">
            <table id="dataTable">
                <thead>
                <tr>
                    <th>Номер(ID)</th>
                    <th>Название головной структуры</th>
                    <th>Подчинен(ID)</th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                @foreach($MainStructures as $item)
                    <tr   id="{{$item->id}}">

                        <td>{{$item->id}}</td>
                        <td>{{$item->structName}}</td>
                        <td>{{$item->parentId}}</td>
                        <td><a class="btnEdit" href="{{route('ma.main_structs.edit',$item->id)}}">Редактировать</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="right">
            <form id="tableForm" accept-charset="UTF-8" action="{{route('ma.main_structs.create')}}" method="post" >
                @csrf
            <b>Название структуры</b>
            <input name="MainStructName" type="text" id="inputStructName" placeholder="">
            <b>Ниже чем(ID)</b>
            <input name="StructParent" type="number" id="inputStructParent" placeholder="">
            <br>
            <button type="submit"  id="submitBtn" >Добавить новый</button>
            </form>
        </div>

    </div>
@endsection

@extends('structAdmin.Layouts.structAdmin')
@section('content')
    <div class="container" id="struct">
        <div class="left">
            <b>Отделы</b>
            <input type="text" id="myInput" onkeyup="AnyTablesSearch()" placeholder="Поиск...">
            <table id="dataTable">
                <thead>
                <tr>
                    <th>Номер(ID)</th>
                    <th>Название отдела</th>
                    <th>Телефон отдела</th>
                    <th>Адрес отдела</th>
                    <th>Ниже чем(ID)</th>
                    <th> </th>

                </tr>
                </thead>
                <tbody>
                @foreach($Structures as $item)
                    <tr   id="{{$item->id}}">

                        <td>{{$item->id}}</td>
                        <td>{{$item->structName}}</td>
                        <td>{{$item->structPhone}}</td>
                        <td>{{$item->structAddress}}</td>
                        <td>{{$item->parentId}}</td>
                        <td><a class="btnEdit" href="{{route('sa.structs.edit',$item->id)}}">Редактировать</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="right">
            <form id="tableForm" accept-charset="UTF-8" action="{{route('sa.structs.create')}}" method="post" >
                @csrf
            <b>Название отдела</b>
            <input name="StructName" type="text" id="inputStructName" placeholder="">
            <b>Телефон отдела</b>
            <input name="StructPhone" type="text" id="inputStructPhone" placeholder="">
            <b>Адрес отдела</b>
            <input name="StructAddress" type="text" id="inputStructAddress" placeholder="">
            <b>Ниже чем(ID)</b>
            <input name="StructParent" type="text" id="inputStructParent" placeholder="">

            <br>

            <button type="submit"  id="submitBtn" >Добавить новый</button>
            </form>
        </div>

    </div>
@endsection

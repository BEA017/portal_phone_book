@extends('mainAdmin.Layouts.mainAdm')
@section('content')
    <div class="container" id="absence">
        <div class="left">

        <b>Статус</b>
        <br>

        <input type="text" id="myInput" onkeyup="AnyTablesSearch()" placeholder="Поиск...">
        <table id="dataTable">
            <thead>
            <tr><!-- выводить данные всех сотрудников отдела -->
                <th>Отдел</th>
                <th>Должность</th>
                <th>ФИО</th>
                <th>Начало</th>
                <th>Окончание</th>
                <th>Инфо</th>
            </tr>
            </thead>
            <tbody>
            @foreach($accountCards as $item)
                <tr   id="{{$item->id}}">
                    <td>{{$item->structName}}</td>
                    <td>{{$item->postName}}</td>
                    <td>{{$item->personName}}</td>
                    <td>{{$item->dateStartAccounting}}</td>
                    <td>{{$item->dateEndAccounting}}</td>
                    <td>{{$item->accountingInfo}}</td>

                    <td><a class="btnEdit" href="{{route('ma.emp_accounting.edit',$item->id)}}">Редактировать</a></td>
                </tr>
            @endforeach
            <!-- Add more rows as needed -->
            </tbody>
        </table>
        </div>
        <div class="right">
            <form id="tableForm" accept-charset="UTF-8" action="{{route('ma.emp_accounting.create')}}" method="post" >
                @csrf

                <b>ID Cотрудника</b>
                <input name="personId" type="text" id="inputID" placeholder="" required>
                <b>Дата начала</b>
                <input name="dateStartAccounting" type="date" id="inputBirth" placeholder=" " value=""  >
                <br>
                <b>Дата окончания</b>
                <input name="dateEndAccounting" type="date" id="inputBirth" placeholder=" " value=""  >
                <br>
                <b>Инфо</b>
                <input name="accountingInfo" type="text" id="inputID" placeholder="" value=""  >
                <button type="submit"  id="submitBtn" >Добавить новый</button>
            </form>
        </div>
    </div>
@endsection

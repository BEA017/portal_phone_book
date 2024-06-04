@extends('structAdmin.Layouts.structAdmin')
@section('content')
<div class="container" id="empAcc">
        <div class="left">
        <b>Прием/увольнение</b>
        <br>
            <input type="text" id="myInput" onkeyup="AnyTablesSearch()" placeholder="Поиск...">
             <table id="dataTable">
                <thead>
                <tr><!-- выводить данные всех сотрудников отдела -->
                    <th>Номер</th>
                    <th>Название должности</th>
                    <th>ФИО</th>
                    <th>Начало</th>
                    <th>Окончание</th>
                    <th>Инфо</th>

                </tr>
                </thead>
                <tbody>
                <tr onclick="fillInputs(this)">
                    <td>Data 1</td>
                    <td>Data 2</td>
                    <td>Data 3</td>
                    <td>Data 4</td>
                    <td>Data 5</td>
                    <td>Data 6</td>

                </tr>

                <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
        <div class="right">
            <b>Номер</b>
            <input type="text" id="inputId" readonly placeholder="">
            <b>Название должности</b>
            <input type="text" id="inputPostName" placeholder=" ">
            <b>ФИО</b>
            <input type="text" id="inputPostName" placeholder=" ">
            <b>Начало</b>
            <input type="text" id="inputStartDate" placeholder=" ">
            <b>Окончание</b>
            <input type="text" id="inputEndDate" placeholder=" ">
            <b>Инфо</b>
            <input type="text" id="inputInfo" placeholder=" ">

            <br>
            <button onclick="saveData()">Редактировать</button>
            <button onclick="dellData()">Удалить</button>
            <button onclick="addData()">Добавить новый</button>
        </div>
    </div>
    @endsection

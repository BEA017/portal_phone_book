@extends('mainAdmin.Layouts.mainAdm')
@section('content')
    <div class="container" id="localAdmin">
        <div class="left">
            <b>Сотрудники</b>
            <br>
            <input type="text" id="myInput" onkeyup="AnyTablesSearch()" placeholder="Поиск...">
            <table id="dataTable" class="mt">
                <thead>
                <tr ><!-- выводить данные всех сотрудников отдела -->
                    <th>Номер</th>
                    <th>Название структуры</th>
                    <th>ФИО Администратора</th>
                    <th>Логин</th>
                </tr>
                </thead>
                <tbody>
                @if($employeeCards->count()>0)
                    @foreach($employeeCards as $item)
                        <tr   id="{{$item->id}}">
                            <td>{{$item->personName}}</td>
                            <td>{{$item->postName}}</td>
                            <td>{{$item->structName}}</td>
                            <td>{{$item->personalEmail}}</td>
                            <td>{{$item->workPhoneNumber}}</td>
                            <td>{{$item->internalPhoneNumber}}</td>
                            <td>{{$item->personalPhoneNumber}}</td>
                            <td>{{$item->workplaceAddress}}</td>
                            <td><a class="btnEdit" href="{{route('sa.employee.edit',$item->id)}}">Редактировать</a></td>
                        </tr>
                    @endforeach
                @endif
                <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
        <div class="right">
            <form id="tableForm" accept-charset="UTF-8" action="{{route('sa.employee.create')}}" method="post" >
                @csrf

                {{--                <b>Номер</b>--}}
                {{--                <input name="id" type="text" id="inputId" readonly placeholder="" required>--}}
                <b>ФИО</b>
                <input name="personName" type="text" id="inputName" placeholder="" required>
                <b>Должность</b>
                <br>
                <select name="SelectPost" id="post-select" required>
                    <br>
                    <option  value=""></option>
                    @foreach($posts as $post)
                        <option value="{{$post->id}}"> {{$post->postName}}</option>
                    @endforeach
                </select>
                <br>
                <br>
                <b>Отдел</b>
                <br>
                <select name="SelectStruct" id="struct-select" required>
                    <option  value=""></option>
                    @foreach($structs as $struct)
                        <option value="{{$struct->id }}"> {{$struct->structName }}</option>
                    @endforeach
                </select>
                <br>
                <br>
                <b>Почта</b>
                <input name="personalEmail"  type="text" id="inputMail" placeholder="" required>
                <b>Рабочий телефон</b>
                <input name="workPhoneNumber" type="text" id="inputWorkPhone" placeholder="" required>
                <b>Внутренний телефон</b>
                <input name="internalPhoneNumber" type="text" id="inputInternalPhone" placeholder="" required>
                <b>Мобильный телефон</b>
                <input name="personalPhoneNumber" type="text" id="inputPersonalPhone" placeholder="" required>
                <b>Кабинет</b>
                <input name="workplaceAddress" type="text" id="inputAddress" placeholder="" required>

                <br>

                <button type="submit"  id="submitBtn" >Добавить новый</button>
            </form>
        </div>
    </div>

<div class="container" id="admin" >
    <div class="left">
        <input type="text" id="myInput" onkeyup="AnyTablesSearch()" placeholder="Поиск...">
        <table id="dataTable">
            <thead>
            <tr>
                <th>Номер</th>
                <th>Название структуры</th>
                <th>ФИО Администратора</th>
                <th>Логин</th>
            </tr>
            </thead>
            <tbody>
            <tr onclick="fillInputs(this)">
                <td>Data 1</td>
                <td>Data 2</td>
                <td>Data 3</td>
                <td>Data 4</td>

            </tr>
            <tr onclick="fillInputs(this)">
                <td>Rata 1</td>
                <td>Fata 2</td>
                <td>Gata 3</td>
                <td>Nata 4</td>

            </tr>
            <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
    <div class="right">
        <b>Номер</b>
        <input type="text" id="inputId" readonly placeholder="">
        <b>Название структуры</b>
        <input type="text" id="inputStructName" placeholder="">
        <b>ФИО Администратора</b>
        <input type="text" id="inputAdminName" placeholder="">
        <b>Логин</b>
        <input type="text" id="inputLogin" placeholder="">
        <b>Пароль</b>
        <input type="text" id="inputPassword" placeholder="">

        <br>
        <button onclick="saveData()">Редактировать</button>
        <button onclick="dellData()">Удалить</button>
        <button onclick="addData()">Добавить новый</button>
    </div>
</div>
@endsection

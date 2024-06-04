@extends('structAdmin.Layouts.structAdmin')
@section('content')
    <div class="container" id="localAdmin">
        <div class="left">
        <b>Сотрудники</b>
        <br>
        <input type="text" id="myInput" onkeyup="AnyTablesSearch()" placeholder="Поиск...">
            <table id="dataTable">
                <thead>
                <tr ><!-- выводить данные всех сотрудников отдела -->
                    <th>ФИО</th>
                    <th>Должность</th>
                    <th>Отдел</th>
                    <th>Электронная почта</th>
                    <th>Рабочий телефон</th>
                    <th>Внутренний телефон</th>
                    <th>Мобильный телефон</th>
                    <th>Кабинет</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employeeCard as $item)
                <tr onclick="fillInputsSAEmployee(this)" id="{{$item->id}}">
                    <td>{{$item->personName}}</td>
                    <td>{{$item->postName}}</td>
                    <td>{{$item->structName}}</td>
                    <td>{{$item->personalEmail}}</td>
                    <td>{{$item->workPhoneNumber}}</td>
                    <td>{{$item->internalPhoneNumber}}</td>
                    <td>{{$item->personalPhoneNumber}}</td>
                    <td>{{$item->workplaceAddress}}</td>

                </tr>
                @endforeach
                <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
        <div class="right">
            <form id="tableForm" accept-charset="UTF-8" action="#" method="#" >
                @csrf

                <b>Номер</b>
                <input name="id" type="text" id="inputId" readonly placeholder="">
                <b>ФИО</b>
                <input name="personName" type="text" id="inputName" placeholder=" ">
                <b>Должность</b>
                <br>
                <select name="SelectPost" id="post-select">
                    <br>
                    <option  value="0">Выбрать должность</option>
                    @foreach($posts as $post)
                        <option value="{{$post->id}}"> {{$post->postName}}</option>
                    @endforeach
                </select>
                <br>
                <br>
                <b>Отдел</b>
                <br>
                <select name="SelectStruct" id="struct-select">
                    <option value="0">Выбрать отдел</option>
                    @foreach($structs as $struct)
                        <option value="{{$struct->id }}"> {{$struct->structName }}</option>
                    @endforeach
                </select>
                <br>
                <br>
                <b>Почта</b>
                <input name="personalEmail"  type="text" id="inputMail" placeholder=" " >
                <b>Рабочий телефон</b>
                <input name="workPhoneNumber" type="text" id="inputWorkPhone" placeholder=" ">
                <b>Внутренний телефон</b>
                <input name="internalPhoneNumber" type="text" id="inputInternalPhone" placeholder=" ">
                <b>Мобильный телефон</b>
                <input name="personalPhoneNumber" type="text" id="inputPersonalPhone" placeholder=" ">
                <b>Кабинет</b>
                <input name="workplaceAddress" type="text" id="inputAddress" placeholder=" ">

                <br>
                <button onclick="submitForm('{{route('sa.employee.update',"")}}', 'patch')">Редактировать</button>
                <button onclick="submitForm('{{route('sa.employee.del',"")}}', 'delete')">Удалить</button>
                <button onclick="submitForm('{{route('sa.employee.create')}}', 'post')" >Добавить новый</button> <!--onclick="addData()"-->
            </form>
        </div>
    </div>


<script>
    function submitForm(action, method) {
        if (method == "post") {
            console.log("POST")

            document.getElementById('tableForm').action = action;
            document.getElementById('tableForm').method = method;
            document.getElementById('tableForm').submit();
        }
        if(method=="delete") {
            console.log("DEL")
            let id= document.getElementById('inputId').value;
             document.getElementById('tableForm').action = "route('sa.employee.delete', "+id+")";
             document.getElementById('tableForm').method = method;
            document.getElementById('tableForm').submit();
        }
        if(method=="patch") {
            console.log("Patch")

            let id= document.getElementById('inputId').value;
            document.getElementById('tableForm').action = "route('sa.employee.update', "+id+")";
            document.getElementById('tableForm').method = method;
            document.getElementById('tableForm').submit();
        }
    }

</script>
@endsection

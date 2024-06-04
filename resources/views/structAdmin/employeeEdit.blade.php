@extends('structAdmin.Layouts.structAdmin')
@section('content')
    <a class="btnEdit" href="{{route('sa.employee')}}">Назад</a>
    <br>
    <br>
    @foreach($employeeCard as $employee) @endforeach
        <form id="tableForm" accept-charset="UTF-8" action="{{route('sa.employee.update', $employee->id)}}"   method="post"   >
            @csrf
        @method('put')
{{--             <b>Идентификатор</b>--}}
{{--            <input name="id" type="text" id="inputId" readonly placeholder="" value="{{$employee->id}}" required>--}}

            <b>ФИО</b>
            <input name="personName" type="text" id="inputName" placeholder=" " value="{{$employee->personName}}" required>
             <br>
            <b>Дата рождения</b>
            <input name="dateOfBirth" type="date" id="inputBirth" placeholder=" " value="{{$employee->dateOfBirth}}" required>
            <br>
            <br>
            <b>Должность</b>
            <br>
            <select name="SelectPost" id="post-select" required>
                <br>
                <option  value="{{$employee->postId}}">{{$employee->postName}}</option>
                @foreach($posts as $post)
                    <option value="{{$post->id}}"> {{$post->postName}}</option>
                @endforeach

            </select>
            <br>
            <br>
            <b>Отдел</b>
            <br>
            <select name="SelectStruct" id="struct-select" required>
                <option value="{{$employee->idworkingStructure}}">{{$employee->structName}}</option>
                @foreach($structs as $struct)
                    <option value="{{$struct->id }}"> {{$struct->structName }}</option>
                @endforeach
            </select>
            <br>
            <br>
            <b>Почта</b>
            <input name="personalEmail"  type="text" id="inputMail" placeholder=" " value="{{$employee->personalEmail}}" required>
            <b>Рабочий телефон</b>
            <input name="workPhoneNumber" type="text" id="inputWorkPhone" placeholder="" value="{{$employee->workPhoneNumber}}" required>
            <b>Внутренний телефон</b>
            <input name="internalPhoneNumber" type="text" id="inputInternalPhone" placeholder=" " value="{{$employee->internalPhoneNumber}}" required>
            <b>Мобильный телефон</b>
            <input name="personalPhoneNumber" type="text" id="inputPersonalPhone" placeholder=" " value="{{$employee->personalPhoneNumber}}" required>
            <b>Кабинет</b>
            <input name="workplaceAddress" type="text" id="inputAddress" placeholder=" " value="{{$employee->workplaceAddress}}" required>

            <br>
            <button type="submit"  id="submitBtn" >Редактировать</button>
           </form>

    <form id="tableForm" accept-charset="UTF-8" action="{{route('sa.employee.del', $employee->id)}}"   method="post"   >
        @csrf
        @method('delete')
        <button type="submit"  style="background-color: Red;" onclick="return confirm('Вы уверены, что хотите удалить?')" >Удалить</button>
    </form>

@endsection

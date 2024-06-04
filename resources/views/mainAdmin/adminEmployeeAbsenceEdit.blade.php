@extends('mainAdmin.Layouts.mainAdm')
@section('content')


    <a class="btnEdit" href="{{route('ma.emp_status')}}">Назад</a>

    <br>
    <br>
    @foreach($statusCard as $item) @endforeach
    <form id="tableForm" accept-charset="UTF-8" action="{{route('ma.emp_status.update', $item->id)}}"   method="post">
        @csrf
        @method('put')
        <b>Должность</b>
        <br>
        <input  readonly name="Post" id="post-select"  value="{{$item->postName}}">
        <br>
        <br>
        <b>ФИО</b>
        <br>
        <input readonly name="personName" id="inputName" value="{{$item->personName}}"  >
        <br>
        <br>
        <b>Статус</b>
        <br>
        <select required name="absenceType" id="status-select">

         <option value="{{$item->absenceType}}"> Текущий статус</option>

        @foreach($statuses as $status)
                <option value="{{$status->id}}"> {{$status->statusName}}</option>
            @endforeach
        </select>

        <br>
        <br>
        <b>Дата начала</b>
        <br>
        <input name="dateStartAbsence" type="date" id="inputStart" placeholder="" value="{{$item->dateStartAbsence}}">
        <br>
        <br>
        <b>Дата окончания</b>
        <br>
        <input name="dateEndAbsence" type="date" id="inputEnd" placeholder="" value="{{$item->dateEndAbsence}}">
        <br>
        <br>
        <b>Инфо</b>
        <br>
        <input name="absenceInfo"  id="inputMail" placeholder="" value="{{$item->absenceInfo}}">
        <br>
        <br>
        <button type="submit"  id="submitBtn" >Редактировать</button>
    </form>

@endsection

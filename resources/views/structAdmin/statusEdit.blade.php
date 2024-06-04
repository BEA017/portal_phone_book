@extends('structAdmin.Layouts.structAdmin')
@section('content')
    <a class="btnEdit" href="{{route('sa.status')}}">Назад</a>
    <br>
    <br>
    @foreach($statusCard as $item) @endforeach
    <form id="tableForm" accept-charset="UTF-8" action="{{route('sa.status.update', $item->id)}}"   method="post">
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
            <br>
            <br>
            @foreach($statuses as $status)
                <option value="{{$status->id}}"> {{$status->statusName}}</option>
            @endforeach
        </select>
        <br>
        <br>
        <b>Дата начала</b>
        <br>
        <input name="dateStartAbsence" type="date" id="inputStart" placeholder="" value="">
        <br>
        <br>
        <b>Дата окончания</b>
        <br>
        <input name="dateEndAbsence" type="date" id="inputEnd" placeholder="" value="">
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

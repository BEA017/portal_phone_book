@extends('mainAdmin.Layouts.mainAdm')
@section('content')
    <a class="btnEdit" href="{{route('ma.posts')}}">Назад</a>
    <br>
    <br>
    @foreach($Status as $item) @endforeach
    <form id="tableForm" accept-charset="UTF-8" action="{{route('ma.statuses.update', $item->id)}}"   method="post"   >
        @csrf
        @method('put')
        <b>Номер(ID)</b>
        <input name="id" type="text" id="inputId" readonly placeholder="" value="{{$item->id}}" required>
        <br>
        <br>
        <b>Название статуса</b>
        <input name="StatusName" type="text" id="inputName" placeholder=" " value="{{$item->statusName}}"  >
        <br>
        <br>

        <button type="submit"  id="submitBtn" >Редактировать</button>
    </form>

    <form id="tableForm" accept-charset="UTF-8" action="{{route('ma.statuses.del', $item->id)}}"   method="post"   >
        @csrf
        @method('delete')
        <button type="submit"  style="background-color: Red;" onclick="return confirm('Вы уверены, что хотите удалить?')" >Удалить</button>
    </form>
@endsection

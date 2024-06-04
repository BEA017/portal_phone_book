@extends('mainAdmin.Layouts.mainAdm')
@section('content')
<a class="btnEdit" href="{{route('ma.employee')}}">Назад</a>
<br>
<br>
@foreach($accountCard as $item) @endforeach
<form id="tableForm" accept-charset="UTF-8" action="{{route('ma.emp_accounting.update', $item->id)}}"   method="post"   >
    @csrf
    @method('put')
    {{--             <b>Идентификатор</b>--}}
    {{--            <input name="id" type="text" id="inputId" readonly placeholder="" value="{{$employee->id}}" required>--}}

    <b>Отдел</b>
    <input readonly ="structName" type="text" id="inputName" placeholder=" " value="{{$item->structName}}"  >
    <br>
    <br>
    <b>Должность</b>
    <input readonly name="postName" type="text" id="inputName" placeholder=" " value="{{$item->postName}}"  >
    <br>
    <br>
    <b>ФИО</b>
    <br>
    <input readonly name="personName" type="text" id="inputName" placeholder=" " value="{{$item->personName}}"  >

    <br>
    <br>

    <b>Дата начала</b>
    <input name="dateOfBirth" type="date" id="inputBirth" placeholder=" " value="{{$item->dateStartAccounting}}"  >
    <br>
    <b>Дата окончания</b>
    <input name="dateOfBirth" type="date" id="inputBirth" placeholder=" " value="{{$item->dateEndAccounting}}"  >
    <br>
    <b>Инфо</b>
    <input name="accountingInfo" type="text" id="inputID" placeholder=""  value="{{$item->accountingInfo}}">
    <br>
    <button type="submit"  id="submitBtn" >Редактировать</button>
</form>

<form id="tableForm" accept-charset="UTF-8" action="{{route('ma.emp_accounting.del', $item->id)}}"   method="post"   >
    @csrf
    @method('delete')
    <button type="submit"  style="background-color: Red;" onclick="return confirm('Вы уверены, что хотите удалить?')" >Удалить</button>
</form>




@endsection

@extends('mainAdmin.Layouts.mainAdm')
@section('content')
    <a class="btnEdit" href="{{route('sa.structs')}}">Назад</a>
    <br>
    <br>
    @foreach($Struct as $item) @endforeach
    <form id="tableForm" accept-charset="UTF-8" action="{{route('ma.structs.update', $item->id)}}"   method="post"   >
        @csrf
        @method('put')
         <b>Номер(ID)</b>
        <input name="id" type="text" id="inputId" readonly placeholder="" value="{{$item->id}}" required>
        <br>
        <br>
        <b>Название отдела</b>
        <input name="StructName" type="text" id="inputName" placeholder=" " value="{{$item->structName}}"  >
        <br>
        <br>
        <b>Телефон отдела</b>
        <input name="StructPhone" type="text" id="inputPhone" placeholder="" value="{{$item->structPhone}}"  >
        <br>
        <br>
        <b>Адрес отдела</b>
        <input name="StructAddress" type="text" id="inputStructAddress" placeholder=" " value="{{$item->structAddress}}"  >
        <br>
        <br>
        <b>Ниже чем(ID)</b>
        <input name="StructParent" type="text" id="inputParent" placeholder=" " value="{{$item->parentId}}"  >
        <br>
        <button type="submit"  id="submitBtn" >Редактировать</button>
    </form>

    <form id="tableForm" accept-charset="UTF-8" action="{{route('ma.structs.del', $item->id)}}"   method="post"   >
        @csrf
        @method('delete')
        <button type="submit"  style="background-color: Red;" onclick="return confirm('Вы уверены, что хотите удалить?')" >Удалить</button>
    </form>
@endsection

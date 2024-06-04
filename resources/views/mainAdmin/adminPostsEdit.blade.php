@extends('mainAdmin.Layouts.mainAdm')

@section('content')
    <a class="btnEdit" href="{{route('ma.posts')}}">Назад</a>
    <br>
    <br>
    @foreach($Post as $item) @endforeach
    <form id="tableForm" accept-charset="UTF-8" action="{{route('ma.posts.update', $item->id)}}"   method="post"   >
        @csrf
        @method('put')
        <b>Номер(ID)</b>
        <input name="id" type="text" id="inputId" readonly placeholder="" value="{{$item->id}}" required>
        <br>
        <br>
        <b>Название должности</b>
        <input name="PostName" type="text" id="inputName" placeholder=" " value="{{$item->postName}}"  >
        <br>
        <br>
        <b>Младше чем(ID)</b>
        <input name="ParentId" type="text" id="inputParent" placeholder=" " value="{{$item->parentId}}"  >
        <br>
        <button type="submit"  id="submitBtn" >Редактировать</button>
    </form>

    <form id="tableForm" accept-charset="UTF-8" action="{{route('ma.posts.del', $item->id)}}"   method="post"   >
        @csrf
        @method('delete')
        <button type="submit"  style="background-color: Red;" onclick="return confirm('Вы уверены, что хотите удалить?')" >Удалить</button>
    </form>
@endsection

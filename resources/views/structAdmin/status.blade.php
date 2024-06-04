@extends('structAdmin.Layouts.structAdmin')
@section('content')
<div class="container" id="absence">

        <b>Статус</b>
        <br>

            <input type="text" id="myInput" onkeyup="AnyTablesSearch()" placeholder="Поиск...">
            <table id="dataTable">
                <thead>
                <tr><!-- выводить данные всех сотрудников отдела -->
                     <th>Название должности</th>
                    <th>ФИО</th>
                    <th>Начало</th>
                    <th>Окончание</th>
                    <th>Статус</th>
                    <th>Инфо</th>

                </tr>
                </thead>
                <tbody>
                @foreach($statusCards as $item)
                    <tr   id="{{$item->id}}">
                        <td>{{$item->postName}}</td>
                        <td>{{$item->personName}}</td>
                        <td>{{$item->dateStartAbsence}}</td>
                        <td>{{$item->dateEndAbsence}}</td>
                        <td>
                            @foreach($statuses as $status)
                                @if( $item->absenceType == $status->id)
                                    {{$status->statusName}}
                                @endif
                             @endforeach
                           </td>
                        <td>{{$item->absenceInfo}}</td>

                        <td><a class="btnEdit" href="{{route('sa.status.edit',$item->id)}}">Редактировать</a></td>
                    </tr>
                @endforeach
                 <!-- Add more rows as needed -->
                </tbody>
            </table>



</div>


@endsection


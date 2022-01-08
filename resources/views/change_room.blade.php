@extends('layouts.general')



@section('main')

    <h3 class="text" align="center">This is where you will change the room</h3>

    <p class="text" align="center">The available rooms</p>

    <div class="line" style="margin: auto"></div>

    <br><br>
{{--    if there is already one request, there cannot be more request--}}

    <table class="table table-hover">

        <thead>
            <tr>
                <th>Sl No</th>
                <th>Room No</th>
                <th>Current condition</th>
            </tr>
        </thead>

        <tbody>
            @foreach($all_rooms as $room)
            <tr>
                <td>{{$room->id}}</td>
                <td>{{$room->name}}</td>
                @if($room->status == 1)
                    <td class="success">Available</td>
                @elseif($room->status == 2)
                    <td>Already taken by {{$room->taken_by}}</td>
                @elseif($room->status == 3)
                    <td class="red">Unsable</td>
                @elseif($room->status == 4)
                    <td>requested</td>
                @else
                    <td>unanticipated status</td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>

    <form action="change_room_handle" method="post">
        @csrf
        <div class="form-group">
            <label for="usr">Room: </label>
            <input type="text" class="form-control" id="usr" name="room">
        </div>

        <button class="btn btn-success" name="submit">Submit</button>
    </form>

    @if (Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! Session::get('success') !!}</li>
            </ul>
        </div>
    @endif

    @if (Session::has('not_allowed'))
        <div class="alert alert-danger">
            <ul>
                <li>{!! Session::get('not_allowed') !!}</li>
            </ul>
        </div>
    @endif




@endsection

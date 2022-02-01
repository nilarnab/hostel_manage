@extends('layouts.general')

@extends('layouts.navmid')


@section('post_nav')
@endsection



@section('main')

    <h3 class="text" align="center">This is where you will change the room</h3>

    <p class="text" align="center">The available rooms</p>

    <div class="line" style="margin: auto"></div>

    <br><br>
{{--    if there is already one request, there cannot be more request--}}

    <table id="table" class="table table-hover">

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
                <td id="col1">{{$room->id}}</td>
                <td id="col2">{{$room->name}}</td>
                @if($room->status == 1)
                    <td id="col3" class="success">Available</td>
                @elseif($room->status == 2)
                    <td id="col3">Already taken by {{$room->taken_by}}</td>
                @elseif($room->status == 3)
                    <td id="col3" class="red">Unsable</td>
                @elseif($room->status == 4)
                    <td id="col3">requested</td>
                @else
                    <td id="col3">unanticipated status</td>
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

    <br>

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

    <script>

        night = 0;

        function toggle() {
            document.getElementById("body").classList.toggle("dark");
            document.getElementById("table").classList.toggle("table_dark");

            night = 1 ^ night;

            if(!night)
            {
                document.getElementById("toogle_button").innerHTML = '<i class="far fa-moon"></i>'
            }
            else
            {
                document.getElementById("toogle_button").innerHTML = '<i class="fas fa-sun"></i>'
            }


        }
    </script>




@endsection

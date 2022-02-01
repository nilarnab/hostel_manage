@extends('layouts.general')
@extends('layouts.navmid')


@section('post_nav')
@endsection

@section('main')

{{--  date coming in
    users-> [sl_no, user name, current role]  --}}

    <h6 class="text" align="center">Select a user</h6>
    <p align="center">Choose the user whose role you want to change</p>
    <table id="table" class="table table-hover">

        <thead>
        <tr>
            <th>Sl No</th>
            <th>User Name</th>
            <th>User Id</th>
            <th>Current Role</th>
        </tr>
        </thead>

        <tbody>
        @foreach($users as $user)

            @if(Session::has('update_id'))
                @if(Session::get('update_id') == $user['id'])

            <tr style="background-color: green">
                @else
                    <tr>
                        @endif

                        @else
                <tr>
                    @endif


                <td>{{$user['sl_no']}}</td>
                <td>{{$user['name']}}</td>
                <td>{{$user['id']}}</td>

                <form method="post" action="/update_role_ajax">
                    @csrf
                    <td>

                        <select name="new_role">

                            @foreach($roles as $role)
                                @if($user['role_id'] == $role['id'])
                                    <option value="{{$role['id']}}" selected>{{$role['name']}}</option>
                                @else
                                    <option value="{{$role['id']}}">{{$role['name']}}</option>
                                @endif
                            @endforeach

                        </select>
                        <input name="current_user" value="{{$user['id']}}" style="width: 0px; padding: 0px; opacity: 0">

                    </td>
                    <td>
                        <button class="btn btn-success">Update</button>
                    </td>
                </form>

            </tr>
        @endforeach
        </tbody>
    </table>


    <script>
        var night = 0;

        function toggle() {
            document.getElementById("body").classList.toggle("dark");
            document.getElementById("table").classList.toggle("table_dark");


            night = 1 ^ night;

            if (!night) {
                document.getElementById("toogle_button").innerHTML = '<i class="far fa-moon"></i>'
            } else {
                document.getElementById("toogle_button").innerHTML = '<i class="fas fa-sun"></i>'
            }
        }
    </script>




@endsection

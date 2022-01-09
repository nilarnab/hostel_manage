@extends('layouts.general')
@extends('layouts.navmid')


@section('post_nav')
@endsection

@section('main')

    <style>

    </style>


    <div class="row">
        <div class="holders col-xs-12 col-md-6">
            <div class="request_num">
                <div id="pending_requests">
                    <h2 id="pending_num" class="gradient_warning">{{$num_pending_request}}</h2>
                </div>
                <h3 class="text">Pending requests</h3>

            </div>

            <div class="users_number">
                <p class="gradient_success">{{$users_num}}</p>
                <h3 class="text">Hostelers</h3>

            </div>

        </div>


        <div class="right_flank col-xs-12 col-md-6">
            <div id="graphs" class="holders graph" align='center'>
                <div class="text" align='center'>Graphs</div>
                <br>
                <div class="line" data-aos="flip-right"></div>
                <br>


                <div class="row bar_holder">
                    <div class="bars bar_1 col-3" style="height: {{$rooms_status['3'][0]}}px; " data-aos="fade-down">

                    </div>
                    <div class="col-1">
                    </div>
                    <div class="bars bar_2 col-3" style="height: {{$rooms_status['2'][0]}}px;" data-aos="fade-down">
                    </div>
                    <div class="col-1">

                    </div>
                    <div class="bars bar_3 col-3" style="height: {{$rooms_status['1'][0]}}px; " data-aos="fade-down">
                    </div>
                    <div class="col-1">

                    </div>
                </div>

                <div id="graph_label" class="row bar_holder" style="height: 2px; width: auto;">
                    <div class="bar_1 col-3" style="height: 150px; ">
                        <div id="graph_label">
                            <p id="label" class="text">Available ({{$rooms_status['1'][1]}})</p>
                        </div>
                    </div>
                    <div id class="col-1">
                    </div>
                    <div class="bar_2 col-3" style="height: {{$rooms_status['2'][1]}}px;">
                        <div id="graph_label">
                            <p id="label" class="text">Taken <br>({{$rooms_status['2'][1]}})</p>
                        </div>
                    </div>
                    <div class="col-1">

                    </div>
                    <div class="bar_3 col-3" style="height:{{$rooms_status['3'][1]}}px; ">
                        <div id="graph_label">
                            <p id="label" class="text">
                                Unusable ({{$rooms_status['3'][1]}})
                            </p>
                        </div>
                    </div>
                    <div class="col-1"></div>
                </div>


            </div>


        </div>

    </div>





    <div class="row">
        <div class="col-xs-12 col-md-4">
            {{--    mess timings--}}
            <div class="mess_timing">
                <h3 class="text">Mess Timings</h3>

                <table class="table table-hover">

                    <thead>
                    <tr>
                        <th>Meal</th>
                        <th>Starts</th>
                        <th>Ends</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($mess_timings as $mess_timing)
                        <tr>
                            <td>
                                {{$mess_timing['meal_name']}}
                            </td>
                            <td>
                                {{$mess_timing['start']}}
                            </td>
                            <td>
                                {{$mess_timing['end']}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>
        <div class="col-xs-12 col-md-8">
            {{--   Requests--}}
            <div class="requests">
                <h3 class="text">Request Information</h3>

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>Room id</th>
                            <th>Room No</th>
                            <th>Current condition</th>
                            <th>User</th>
                            <th>Approve</th>
                            <th>Deny</th>
                        </tr>
                    </thead>

                    <tbody id="request_table">



                    @foreach($room_info as $room)

                        @if($room['status_id'] == 4)
                            <tr id="row{{$room["room_id"]}}">
                                <td class="table_text">{{$room["room_id"]}}</td>
                                <td class="table_text">{{$room["name"]}}</td>
                                <td class="table_text">{{$room["status"]}}</td>
                                <td class="table_text">{{$room["user_name"]}}</td>
                                <td><button class="btn btn-success" role="button" name="{{$room["room_id"]}}" id="" onclick="approve({{$room["room_id"]}})">Approve</button></td>
                                <td><button class="btn btn-danger" role="button" name="{{$room["room_id"]}}" id="" onclick="deny({{$room["room_id"]}})">Deny</button></td>
                            </tr>

                        @endif
                    @endforeach

                    </tbody>

                </table>
                @if($num_pending_request == 0)
                    <div style="width: auto; text-align: center">
                        <br><br>
                        <p>No pending requests. All caught up!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>






{{--   personal infos--}}
    <div class="personal_infos">
        <h3 class="text">Hosteler's info </h3>

        <table class="table table-hover">

            <thead>
            <tr>
                <th>Sl No</th>
                <th>Name of hosteler</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Room</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($users as $user)


                    <tr id="approval{{$user['id']}}">
                        <td>{{$user["sl_no"]}}</td>
                        <td>{{$user["name"]}}</td>
                        <td>{{$user["email"]}}</td>
                        <td>{{$user["phone"]}}</td>

                        @if(isset($user['room_name']))
                            <td>{{$user["room_name"]}}</td>
                        @else
                            <td><p class="red">Does not have a room</p></td>
                        @endif

                        @if ($user['is_allowed'])
                            <td id="approval{{$user['id']}}"><button id="btnapproval{{$user['id']}}" class="btn btn-danger" onclick="handle_approval({{$user['id']}}, 0)">Disapprove</button> </td>
                        @else
                            <td id="approval{{$user['id']}}"><button id="btnapproval{{$user['id']}}" class="btn btn-success" onclick="handle_approval({{$user['id']}}, 1)">Approve</button> </td>
                        @endif
                    </tr>


            @endforeach
            </tbody>
        </table>

    </div>
    <br>

    <div class="personal_infos">
        <h3 class="text">Room Details</h3>

        <table class="table table-hover">

            <thead>
            <tr>
                <th>Room id</th>
                <th>Name of room</th>
                <th>status</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($room_info as $room)


                <tr id="room{{$room['room_id']}}">
                    <td>{{$room["room_id"]}}</td>
                    <td>{{$room["name"]}}</td>

                    @if($room['status_id'] == 1)
                        <td class="success">Available</td>
                    @elseif($room['status_id'] == 2)
                        <td>Already taken by {{$room['user_name']}}</td>
                    @elseif($room['status_id'] == 3)
                        <td class="red">Unsable</td>
                    @elseif($room['status_id'] == 4)
                        <td>requested</td>
                    @else
                        <td>unanticipated status</td>
                    @endif

                    @if ($room['status_id'] != 3)
                        <td id="room{{$room['room_id']}}"><button id="btnroom{{$room['room_id']}}" class="btn btn-danger" onclick="room_approval({{$room['room_id']}}, 0)">Disapprove</button> </td>
                    @else
                        <td id="room{{$room['room_id']}}"><button id="btnroom{{$room['room_id']}}" class="btn btn-success" onclick="room_approval({{$room['room_id']}}, 1)">Approve</button> </td>
                    @endif
                </tr>


            @endforeach
            </tbody>
        </table>

    </div>

    <br>

{{--    --}}{{--   mailing info--}}
{{--    <div class="request_mess">--}}
{{--        <h3 class="text">Input box to request mess secretary by mail</h3>--}}

{{--        <textarea placeholder="Write a mail">--}}

{{--        </textarea>--}}
{{--    </div>--}}

    <script>

        function approve(id)
        {
            console.log("Cliced approve " + id);
            jQuery.ajax(
                {
                    url: "{{url('./ajax_approve')}}",
                    data: {
                        'id' : id,
                    },
                    type: 'get',
                    success:
                        function (result)
                        {
                            console.log(result);


                            // document.getElementById(id).style.backgroundColor = 'grey';
                            // document.getElementById(id).style.color = 'black';
                            document.getElementById('row'+id).style.opacity = '0.4';

                            if (result.result !== 'invalid request')
                            {
                                document.getElementById('pending_requests').innerHTML = '<h2  class="gradient_warning">' + result['pending_now'] + '</div>';
                            }
                        }
                }
            )
        }

        function deny(id)
        {
            console.log("Cliced deny " + id);
            jQuery.ajax(
                {
                    url: "{{url('./ajax_deny')}}",
                    data: {
                        'id' : id,
                    },
                    type: 'get',
                    success:
                        function (result)
                        {
                            console.log(result);


                            // document.getElementById(id).style.backgroundColor = 'grey';
                            // document.getElementById(id).style.color = 'black';
                            document.getElementById('row'+id).style.opacity = '0.4';

                            if (result.result !== 'invalid request')
                            {
                                document.getElementById('pending_requests').innerHTML = '<h2  class="gradient_warning">' + result['pending_now'] + '</div>';
                            }
                        }
                }
            )
        }

        function handle_approval(id, action)
        {

            console.log("Cliced approval " + id + ' action ' + action);
            jQuery.ajax(
                {
                    url: "{{url('./ajax_approval')}}",
                    data: {
                        'id' : id,
                        'action' : action
                    },
                    type: 'get',
                    success:
                        function (result)
                        {
                            console.log(result);

                            if(!action)
                            {
                                document.getElementById('btnapproval'+id).classList.add('btn-danger');
                                document.getElementById('btnapproval'+id).classList.remove('btn-success');
                                document.getElementById('btnapproval'+id).innerHTML = "Disapproved";
                                document.getElementById('approval'+id).style.backgroundColor = 'tomato';

                            }

                            else
                            {

                                document.getElementById('btnapproval'+id).classList.add('btn-succes');
                                document.getElementById('btnapproval'+id).classList.remove('btn-danger');
                                document.getElementById('btnapproval'+id).innerHTML = "Approved";

                                document.getElementById('approval'+id).style.backgroundColor = 'green';

                            }

                            // window.setInterval('refresh()', 1000);



                        }
                }
            )

        }

        function room_approval(id, action)
        {

            console.log("Cliced room approval " + id + ' action ' + action);
            jQuery.ajax(
                {
                    url: "{{url('./ajax_room_approval')}}",
                    data: {
                        'id' : id,
                        'action' : action
                    },
                    type: 'get',
                    success:
                        function (result)
                        {

                            console.log(result);

                            if (result.result === 'success')
                            {
                                document.getElementById('room'+id).style.opacity = '0.4'
                            }
                            else
                            {
                                document.getElementById('room'+id).innerHTML = '<p class="red">' +  result.message + '</p>';
                            }


                            // window.setInterval('refresh()', 1000);



                        }
                }
            )

        }

        function refresh() {
            window .location.reload();
        }

    </script>

    <script>
        function toggle() {
            document.getElementById("body").classList.toggle("dark");
            // document.getElementById("elevate").classList.toggle("dark_oval");
            // document.getElementById("card1").classList.toggle("dark_oval");
            // document.getElementById("card2").classList.toggle("dark_oval");
            // document.getElementById("card3").classList.toggle("dark_oval");
            // document.getElementById("graphs").classList.toggle("dark_oval");
            // document.getElementById("status").classList.toggle("dark_oval");
            // document.getElementById("bar1").classList.toggle("shadow_less");
            // document.getElementById("bar2").classList.toggle("shadow_less");
            // document.getElementById("bar3").classList.toggle("shadow_less");


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

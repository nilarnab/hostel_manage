@extends('layouts.general')
@extends('layouts.navmid')


@section('post_nav')
@endsection

@section('main')

    <div class="row">
        <div class="col-xs-12 col-md-6">
            {{--    mess timings--}}
            <div id="card_1" class="mess_timing">
                <h3 class="text">Mess Timings</h3>

                <table id="table" class="table table-hover">

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

        <div id="card1" class="col-xs-12 col-md-6 mess_timing">

            <form method="post" action="/change_time">
                @csrf

                <div class="meal_check">



                <h3 class="text" style="text-align: center">Update Timing</h3>

                <div class="row">

                    <div class="col-6">
                        <p>Choose the meal</p>

                        @foreach($mess_timings as $mess_timing)
                            <div class="checkbox">
                                <label>
                                    <input type="radio" value="{{$mess_timing['id']}}" name="meal_chosen"> {{$mess_timing['meal_name']}}
                                </label>
                            </div>
                        @endforeach

                        <button class="btn btn-success" style="margin: auto">Change</button>



                    </div>

                    <div class="col-6">
                        <p>Choose new name</p>
                        <label>Name of meal: <input class="form-control" type="text" name="meal_name"></label>
                        <br>

                        <label>Starting: <input class="form-control" type="time" name="meal_start"></label>
                        <label>End: <input class="form-control" type="time" name="meal_end"></label>



                    </div>

                    @if (Session::has('success'))
                        <p class="success">{!! Session::get('success') !!}</p>
                    @endif

                    @if ($errors->any())
                        <ul class="red">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                </div>
            </div>
            </form>

        </div>

    </div>

    <div class="row">

        <div id="card_2" class="col-xs-12 col-md-12 mess_timing" style="height: auto !important;">
            <div class="text">Mess Menue</div>
            <br>

            <table id="table_1" class="table table-hover" >
                <thead>
                    <tr>
                        <th>Timing</th>
                        <th>Sun</th>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                        <th>Fri</th>
                        <th>Sat</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($mess_timings as $timing)
                        <tr>
                            <td>
                                {{$timing_id_to_timing_name[$timing['id']]}}
                            </td>

                        @foreach($menues[$timing['id']] as $menue)

                            <td>
                                {{$menue['has_food']['name']}}
                            </td>


                        @endforeach
                        </tr>

                    @endforeach

                </tbody>
            </table>

        </div>


        <div id="card_3" class="col-xs-12 col-md-6 mess_timing"  style="height: auto">

            <form method="post" action="/change_menue">
                @csrf

                <div class="meal_check">



                    <h3 class="text" style="text-align: center">Update Menue</h3>

                    <div class="row">

                        <div class="col-6" >
                            <p>Choose the meal</p>

                            @foreach($mess_timings as $mess_timing)
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" value="{{$mess_timing['id']}}" name="meal_name"> {{$mess_timing['meal_name']}}
                                    </label>
                                </div>
                            @endforeach

                            <br>

                            <button class="btn btn-success" style="position:relative; margin: auto; bottom: 0px">Change</button>

                        </div>

                        <div class="col-6" style="height: auto">
                            <p>Choose the day</p>

                            <div class="check-box">
                                <label>
                                    <input type="radio" value="mon" name="day">Monday
                                </label>
                                <label>
                                    <input type="radio" value="tue" name="day">Tuesday
                                </label>
                                <label>
                                    <input type="radio" value="wed" name="day">Wednesday
                                </label>
                                <label>
                                    <input type="radio" value="thu" name="day">Thursday
                                </label>
                                <label>
                                    <input type="radio" value="fri" name="day">Friday
                                </label>
                                <label>
                                    <input type="radio" value="sat" name="day">Saturday
                                </label>
                                <label>
                                    <input type="radio" value="sun" name="day">Sunday
                                </label>

                            </div>

                            <div id="food_name">

                                <p>Choose the new food</p>
                                <select class="form-select form-select-lg" style="width: 100%" name="food_id">
                                @foreach($foods as $food)


                                            <option value="{{$food['id']}}"><p>{{$food['name']}}</p></option>


                                @endforeach
                                </select>
                            </div>

                            <br>

                        </div>

                        <div class="message" style="margin: auto">
                            @if (Session::has('success_menue'))
                                <p class="success">{!! Session::get('success_menue') !!}</p>
                            @endif

                            @if (Session::has('failure_menue'))
                                <p class="red">{!! Session::get('failure_menue') !!}</p>
                            @endif

                        </div>




                    </div>
                </div>
            </form>

        </div>

        <div id="" class="col-xs-12 col-md-1"  style="height: auto"></div>

        <div id="card_6" class="col-xs-12 col-md-5 mess_timing"  style="height: auto">
            <form method="post" action="/delete_food">
                @csrf

                <div class="meal_check">
                    <h3 class="text" style="text-align: center">Delete A food Item</h3>
                    <div id="food_name">
                        <p>Choose the new food</p>
                        <select class="form-select form-select-lg" style="width: 100%" name="food_id">
                            @foreach($foods as $food)
                                <option value="{{$food['id']}}"><p>{{$food['name']}}</p></option>
                            @endforeach
                        </select>
                        <br>
                    </div>

                    <br>
                    <button class="btn btn-danger" align="center">Delete</button>

                    <div class="message" style="margin: auto">
                        @if (Session::has('success_del_food'))
                            <p class="success">{!! Session::get('success_del_food') !!}</p>
                        @endif

                        @if (Session::has('failure_del_food'))
                            <p class="red">{!! Session::get('failure_del_food') !!}</p>
                        @endif

                    </div>

                </div>
            </form>

            <br>
{{--            <form method="post" action="/delete_timing">--}}
{{--                @csrf--}}

{{--                <div class="meal_check">--}}
{{--                    <h3 class="text" style="text-align: center">Delete A Schedule</h3>--}}
{{--                    <div id="food_name">--}}
{{--                        <p>Choose the new food</p>--}}
{{--                        <select class="form-select form-select-lg" style="width: 100%" name="food_id">--}}
{{--                            @foreach($mess_timings as $food)--}}
{{--                                <option value="{{$food['id']}}"><p>{{$food['meal_name']}}</p></option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        <br>--}}
{{--                    </div>--}}

{{--                    <br>--}}
{{--                    <button class="btn btn-danger" align="center">Delete</button>--}}

{{--                    <div class="message" style="margin: auto">--}}
{{--                        @if (Session::has('success_del_timing'))--}}
{{--                            <p class="success">{!! Session::get('success_del_timing') !!}</p>--}}
{{--                        @endif--}}

{{--                        @if (Session::has('failure_del_timing'))--}}
{{--                            <p class="red">{!! Session::get('failure_del_timing') !!}</p>--}}
{{--                        @endif--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </form>--}}

        </div>

    </div>


    <div class="row">

        <div id="card_4" class="col-xs-12 col-md-6 mess_timing" style="height: auto">

            <form method="post" action="/add_food">
                @csrf
                <h3 class="text" style="text-align: center" >Add Food</h3>

                <label style="width: 100%">Name of meal: <input class="form-control" type="text" name="meal_name"></label>
                <br>

                <label style="width: 100%">Describe the meal<textarea class="form-control" type="text" name="meal_describe"></textarea></label>
                <br>

                <label style="width: 100%">pic url<input id="url" class="form-control" type="text" name="meal_pic" oninput="putImage()"></label>
                <br>

                <div class="message" style="margin: auto">
                    @if (Session::has('success_food'))
                        <p class="success">{!! Session::get('success_food') !!}</p>
                    @endif

                    @if (Session::has('failure_food'))
                        <p class="red">{!! Session::get('failure_food') !!}</p>
                    @endif

                </div>

                <button class="btn btn-success">Submit</button>

            </form>

        </div>

        <div id="card_4" class="col-xs-12 col-md-1"></div>

        <div id="card_5" class="col-xs-12 col-md-5 mess_timing" style="height: auto">

            <div class="title" align="center">The image will appear here</div>
            <img id="preview" src="" style="height: auto; width: 100%; border-radius: 20px" onerror="this.src='https://cdn1.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/eat-circle-orange-1024.png'">
        </div>

    </div>

    <div class="row">



    </div>

    <script>
        function putImage()
        {
            console.log("Changing image");
            console.log(document.getElementById('url').innerHTML.value);
            document.getElementById('preview').src = document.getElementById('url').value;


        }
    </script>



    <script>

        var night = 0;

        function toggle() {
            document.getElementById("body").classList.toggle("dark");
            // document.getElementById("elevate").classList.toggle("dark_oval");

            // document.getElementById("card2").classList.toggle("dark_oval");
            // document.getElementById("card3").classList.toggle("dark_oval");
            // document.getElementById("graphs").classList.toggle("dark_oval");
            // document.getElementById("status").classList.toggle("dark_oval");
            // document.getElementById("bar1").classList.toggle("shadow_less");
            // document.getElementById("bar2").classList.toggle("shadow_less");
            // document.getElementById("bar3").classList.toggle("shadow_less");
            document.getElementById("card1").classList.toggle("dark_oval");
            document.getElementById("card_1").classList.toggle("dark_oval");
            document.getElementById("card_2").classList.toggle("dark_oval");
            document.getElementById("card_3").classList.toggle("dark_oval");
            document.getElementById("card_4").classList.toggle("dark_oval");
            document.getElementById("card_5").classList.toggle("dark_oval");
            document.getElementById("card_6").classList.toggle("dark_oval");
            document.getElementById("table").classList.toggle("bright_text");
            document.getElementById("table_1").classList.toggle("bright_text");

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

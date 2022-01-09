@extends('layouts.general')
@extends('layouts.navmid')

@section('post_nav')
@endsection
@section('main')



    @if ($user_data['is_allowed'])
        <div class="row">

            <div class="holders col-xs-12 col-md-8" style="height: 550px; width: 100%; overflow: hidden">

                <div id="demo" class="carousel slide" data-ride="carousel" >
                    <ul class="carousel-indicators">
                        <li data-target="#demo" data-slide-to="0" class="active"></li>

                        @for($i = 1; $i < sizeof($dish); $i ++)

                            <li data-target="#demo" data-slide-to="{{$i}}"></li>

                        @endfor
                    </ul>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{$dish[0]['pic_url']}}"
                                 alt="{{$dish[0]['title']}}">
                            <div class="carousel-caption">
                                <h3>{{$dish[0]['title']}}</h3>
                                <p>{{$dish[0]['describe']}}</p>
                            </div>
                        </div>


                        @for($i = 1; $i < sizeof($dish); $i++)

                            <div class="carousel-item">
                                <img src="{{$dish[$i]['pic_url']}}"
                                     alt="{{$dish[$i]['title']}}">
                                <div class="carousel-caption">
                                    <h3>{{$dish[$i]['title']}}</h3>
                                    <p>{{$dish[$i]['describe']}}</p>
                                </div>
                            </div>

                        @endfor


                    </div>
                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div>

            </div>

            <div class="right_flank col-xs-12 col-md-4">
                <div id="graphs" class="holders graph " align='center'>
                    <div class="text" align='center'>Graphs</div>
                    <br>
                    <div class="line" data-aos="flip-right"></div>
                    <br>


                    <div class="row bar_holder">
                        <div id="bar1" class="bars bar_1 col-3" style="height: {{$rooms_status['3'][0]}}px; " data-aos="fade-down">

                        </div>
                        <div class="col-1">
                        </div>
                        <div id="bar2" class="bars bar_2 col-3" style="height: {{$rooms_status['2'][0]}}px;" data-aos="fade-down">
                        </div>
                        <div class="col-1">

                        </div>
                        <div id="bar3" class="bars bar_3 col-3" style="height: {{$rooms_status['1'][0]}}px; " data-aos="fade-down">
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

                <div id="status" class="holders status col-12">
                    <div class="text">Current Room</div>
                    <div class="line" style="margin: auto;"></div>

                    @if(sizeof($user_data["hosteler_room"]))
                        @if($user_data["hosteler_room"][0]["status"] == 2)
                            <div class="status_text gradient_success">{{$user_data["hosteler_room"][0]["name"]}}</div>
                        @else
                            <div class="red" style="color: tomato"><h3>Requested {{$user_data["hosteler_room"][0]["name"]}}</h3></div>
                        @endif
                    @else
                        <div class="red"><h3>No Room</h3></div>
                    @endif

                </div>
            </div>

        </div>
        <br><br>

        <div id="elevate" class="elevate">
            <h3 align='center'>
                <div class="text">Here are some important links</div>
                <br>
                <div class="line" align='center' style="margin: auto;" data-aos="flip-right"></div>
            </h3>
            <br><br>
            <div class="row" style="margin: auto;">
                <div id="card1" class="holders cards border col-xs-8 col-md-3" data-aos="fade-up">
                    <h2>
                        <div class="text">Request Room</div>
                    </h2>
                    <div class="line"></div>
                    <p>
                        Request a new room that you might find comfortable
                    </p>
                    <p><a href="./change_room">Link to Request room</a></p>
                </div>
                <div id="card2" class="holders cards border col-xs-8 col-md-3" data-aos="fade-up">
                    <h2>
                        <div class="text">Have Grievance?</div>
                    </h2>
                    <div class="line"></div>
                    <p>
                        You can mail a grievance and it will be broadcasted to all the care takers
                    </p>
                    <p><a href="./">Link to mailing</a></p>
                </div>
                <div id="card3" class="holders cards border col-xs-8 col-md-3" data-aos="fade-up">
                    <h2>
                        <div class="text">Change Profile</div>
                    </h2>
                    <div class="line"></div>
                    <p>
                        Want to update your personal information? you can proceed
                    </p>
                    <p><a href="./update_profile">Link to update profile</a></p>
                </div>

            </div>
            <br><br>
        </div>

        <br><br>

        <script>
            function toggle() {
                document.getElementById("body").classList.toggle("dark");
                document.getElementById("elevate").classList.toggle("dark_oval");
                document.getElementById("card1").classList.toggle("dark_oval");
                document.getElementById("card2").classList.toggle("dark_oval");
                document.getElementById("card3").classList.toggle("dark_oval");
                document.getElementById("graphs").classList.toggle("dark_oval");
                document.getElementById("status").classList.toggle("dark_oval");
                document.getElementById("bar1").classList.toggle("shadow_less");
                document.getElementById("bar2").classList.toggle("shadow_less");
                document.getElementById("bar3").classList.toggle("shadow_less");


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
    @else
        <h2 class="red" align="center">Oh No!</h2>
        <p class="red" align="center">You currently don't have access</p>
    @endif

@endsection

@extends('layouts.general')
@extends('layouts.navmid')


@section('post_nav')
@endsection

@section('main')


    @if ($user_data['is_allowed'])


        <div class="row">
            <div class="col-md-6 col-xs-12" align="center">

    {{--            Showing current image that is present --}}

                @if($user_data['pic_name'] == NULL)
                    <img src="{{URL('/images/user_default.png')}}" width="80%" height="80%" align="center" style="margin: auto; border-radius: 50%;">
                @else
                    <img src="{{URL('/images/'.$user_data['pic_name'].'')}}" align="center" style="margin: auto; border-radius: 50%; width:400px; height: 400px;">
                @endif

                <br><br>

                <form action="./update_photo" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>

                    </div>
                </form>

                <br>

            </div>
            <div class="col-md-6 col-xs-12">

                <p class="text">Update your profile here {{$user_data['name']}}</p>


                <form action="./update_profile_act" method="post">

                    @csrf

                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="name" value="
    {{$user_data['name']}}">
                        <small id="emailHelp" class="form-text text-muted">Let us know your name</small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{\Illuminate\Support\Facades\Auth::user()->email}}">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone number</label>
                        <input type="tel" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter phone number" name="phone" value="{{$user_data['phone']}}">
                        <small id="emailHelp" class="form-text text-muted">Please provide your current phone number</small>
                    </div>

                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>

            </div>

            <div class="response" style="margin: auto">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <div class="success">{{ $message }}</div>
                    </div>

                @endif

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                    @if ($message = Session::get('failure'))
                        <div class="alert alert-danger">
                            <div class="red">
                                {{$message}}
                            </div>
                        </div>
                    @endif



            </div>

        </div>

        <script>

            var night = 0;

            function toggle() {
                document.getElementById("body").classList.toggle("dark");

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
        <p class="red">You currently don't have access!</p>

    @endif


@endsection

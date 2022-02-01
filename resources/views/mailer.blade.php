@extends('layouts.general')
@extends('layouts.navmid')

@section('post_nav')
@endsection
@section('main')

    <style>

        @media only screen and (max-width: 800px) {
            form
            {
                margin-left: 0px;
            }
        }

        @media only screen and (min-width: 800px) {
            form
            {
                margin-left: 18%;
            }

        }

    </style>

    <div style="margin: auto;">

        <form class="col-xs-12 col-md-8" method="post" action="/handle_mail">
            @csrf

            <div class="text">
                Mail to all the caretakers
            </div>
            <div class="line"></div>

            <div class="form-group">
                <label for="sel1">Send To</label>
                <select class="form-control" id="sel1" name="send_to">

                    @if(\Illuminate\Support\Facades\Auth::user()->role == 2)
                        <option value="1">Hostelers</option>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->role == 1 or \Illuminate\Support\Facades\Auth::user()->role == 3)
                            <option value="2">Admins</option>


                        @endif

                    @if(\Illuminate\Support\Facades\Auth::user()->role == 2 or \Illuminate\Support\Facades\Auth::user()->role == 4)
                    <option value="3">Mess Secretary</option>
                        @endif

                        @if(\Illuminate\Support\Facades\Auth::user()->role == 3)
                            <option value="4">Food Provider</option>
                        @endif

                    @if(\Illuminate\Support\Facades\Auth::user()->role == 2)
                        <option value="5">Everyone</option>
                        @endif
                </select>
            </div>




            <div class="form-group">
            <label>Subject</label>
            <input class="form-control" name="subject" placeholder="Subject of the mail" required>
            </div>

            <div class="form-group">
                <label>Body of the mail</label>
                <textarea id="summernote" class="form-control" name="body" placeholder="Body of the mail" cols="10"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Submit</button>

            <br><br>
            @if (Session::has('success'))
                <div class="alert alert-success" style="width: auto">
                    <ul>
                        <li>{!! Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif


        </form>
    </div>
    <script>
        $('#summernote').summernote({
            placeholder: 'Body of the mail',
            tabsize: 2,
            height: 100
        });

        night = 0;

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

@endsection

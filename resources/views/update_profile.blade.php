@extends('layouts.general')


@section('main')


    <p>Update your profile here {{session('name')}}</p>


    <form action="./change_hosteler_profile" method="post">

        @csrf

        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="name" value="
{{\Illuminate\Support\Facades\Auth::user()->name}}">
            <small id="emailHelp" class="form-text text-muted">Let us know your name</small>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{\Illuminate\Support\Facades\Auth::user()->email}}">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>


        <div class="form-group">
            <label for="exampleInputEmail1">Room number</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter current room number" name="room_no">
            <small id="emailHelp" class="form-text text-muted">Please provide your current room number</small>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Phone number</label>
            <input type="tel" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter phone number" name="phone_number">
            <small id="emailHelp" class="form-text text-muted">Please provide your current phone number</small>
        </div>

        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>

@endsection

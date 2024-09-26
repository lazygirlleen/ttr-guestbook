@extends('layouts.template')

@section('title', 'Home | Guestbook')

@section('body')
    <div class="container">
    <h1>Welcome {{ $guest_name }}!</h1>

    <form action="" method="POST">
        @csrf()

        <label for="name" class="form-label">Guest Name</label>
        <input type="text" class="form-control" id="name" name="name"/>

        <br>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>

@endsection

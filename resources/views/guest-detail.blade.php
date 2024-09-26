@extends('layouts.template')

@section('title', 'Guest Detail | Guestbook')

@section('body')

    <h1>Guest Detail</h1>
    <h2>{{ $id }}</h2>
    <h3>{{ $serial_number }}</h3>


    @endsection

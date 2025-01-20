@extends('user::layouts.master')

@section('content')
    <h1>Hello Arewa from User Model</h1>

    <p>Module: {!! config('user.name') !!}</p>
@endsection

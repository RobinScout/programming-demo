@extends('layouts.default')

@section('pageTitle', 'Chuck Norris Jokes')

@section('content')
    <div class="container pt-3">
        <joke class="mb-3"></joke>
        <joke-search></joke-search>
    </div>
@endsection

@extends('layouts.master')
@section('link')
    <style>
        .center {
            margin: auto;
            width: 50%;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="center mt-5">
            <div class="row">
                <div class="col-sm-4">
                    <img style="border-radius: 50px; width:150px; height:150px;" src="/img/{{ $user->photo ? $user->photo->name : '123'}}">
                </div>
                <div class="col-sm-8">
                    <div>
                        Name : {{ $user->name }}
                    </div>
                    <div>
                        No of friends: 100
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
    <div class="container mt-5">
        @foreach($users as $user)
            <div class="w-50 center">
                <div class="media">
                    <img src="/img/{{ $user->photo ? $user->photo->name : 'Not Found' }}" class="mr-3 rounded" style="width:100px;"alt="">
                    <div class="media-body">
                        <h5 class="mt-0">{{ $user->name }}</h5>
                    </div>
                    <a href="#" class="btn btn-primary">Send Request</a>
                    <a href="#" class="btn btn-warning ml-1">View Profile</a>
                </div>    
            </div>
        @endforeach
    </div>
@endsection

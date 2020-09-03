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
        <hr>
        <div class="row">
            <div class="col-sm-6">
            <h4>All Posts</h4><hr>
                @foreach(Auth::user()->posts as $post)
                    <div class="card mb-3">
                        <img src="/img/{{ $post->photo ? $post->photo->name : '' }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->body }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-sm-4 offset-sm-1" >
                <h4>All Friends</h4><hr>
                @foreach(Auth::user()->relations as $relation)
                    @if($relation->user)
                        <div>
                            Name : {{ $relation->user ? $relation->user->name : '' }}
                        </div>
                    @endif
                    
                @endforeach
            </div>
        </div>
    </div>
@endsection

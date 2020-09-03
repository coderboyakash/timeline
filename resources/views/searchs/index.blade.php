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
    <h4>Search results</h4>
        @foreach($users as $user)
            @if((!is_friends($user->id)) && (!is_request_sent($user->id)) && (!is_requested($user->id)))
            <div class="w-50 center mb-5">
                <div class="media">
                    <img src="/img/{{ $user->photo ? $user->photo->name : 'Not Found' }}" class="mr-3 rounded" style="width:100px;"alt="">
                    <div class="media-body">
                        <h5 class="mt-0">{{ $user->name }}</h5>
                    </div>
                    <form action="{{ route('friendrequest.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="sender_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="token" value="{{ Str::random(32) }}">
                        <input type="submit" class="btn btn-primary" value="Send Request">
                    </form>
                    <a href="{{ route('profile', $user->id) }}" class="btn btn-success ml-1">View Profile</a>
                </div>    
            </div>
            @else
            <div class="w-50 center mb-5">
                <div class="media">
                    <img src="/img/{{ $user->photo ? $user->photo->name : 'Not Found' }}" class="mr-3 rounded" style="width:100px;"alt="">
                    <div class="media-body">
                        <h5 class="mt-0">{{ $user->name }}</h5>
                    </div>
                    @if(is_friends($user->id))
                        <a href="" class="btn btn-primary ml-1 disabled">Already Friends</a>
                    @elseif(is_request_sent($user->id))
                        <a href="" class="btn btn-primary ml-1 disabled">Request Sent</a>
                    @elseif(is_requested($user->id))
                        <form action="{{ route('friendrequest.update', Auth::user()->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="sender_id" value="{{ $user->id }}">
                            <input type="hidden" name="token" value="{{ token($user->id) }}">
                            <input type="submit" class="btn btn-warning" value="Confirm">
                        </form>
                    @endif
                        <a href="{{ route('profile', $user->id) }}" class="btn btn-success ml-1">View Profile</a>
                </div>    
            </div>
            @endif
        @endforeach
    </div>
@endsection

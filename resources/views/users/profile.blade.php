@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <img style="border-radius: 50px; width:150px; height:150px;" src="/img/{{ $photo->name }}">
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
@endsection

@extends('layouts.master')

@section('content')
    <div class="container">
        <!-- search friends -->
        <form action="{{ route('search', Auth::user()->id) }}" method="POST">
            <div class="form-group">
                @csrf
                <input type="text" name="search" class="form-control" placeholder="Search new friends">
            </div>
        </form>
        @if(session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @endif
        <h1>HomePage</h1>
    </div>
@endsection

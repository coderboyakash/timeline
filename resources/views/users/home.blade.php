@extends('layouts.master')

@section('content')
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @endif
        <h1>HomePage</h1>
    </div>
@endsection

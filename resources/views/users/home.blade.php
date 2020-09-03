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
        @if(session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @endif
        <div class="row">
            <div class="col-sm-3">
                <div class="center mt-5">
                    <img class="rounded-circle" src="/img/{{ $photo ? $photo->name : 'notfound.png' }}" style="width:100px; border-radius:15px;">
                </div>
                <div class="center mt-5">
                    {{ Auth::user()->name }}
                </div>
            </div>
            <div class="col-sm-9">
                <h5>Publish a New Post</h5>
                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <input type="text" name="body" class="form-control" placeholder="Body">
                    </div>
                    <div class="form-group">
                        <input type="file" name="image" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="image" class="btn btn-success btn-block">
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                @foreach(Auth::user()->posts as $post)
                    Posted By: {{Auth::user()->name}} <strong>(you)</strong>
                    <div class="card mb-3">
                        <img src="/img/{{ $post->photo ? $post->photo->name : '' }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->body }} <span class="pull-right">[{{$post->created_at->diffForHumans()}}]</span></p>
                            <span class="pull-left"><a href="#" class="text-decoration-none">5k Likes</a></span><span class="pull-right"><a href="#" class="text-decoration-none">5k Comments</a></span>
                        </div>
                        <div class="row m-0">
                            <div class="col-sm-12">
                                <form action="">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 mb-2"> <i class="fa fa-comment"></i> Comments</button>
                                </form>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <button class="btn btn-primary w-100 mb-2"><i class="fa fa-thumbs-up"></i> Like</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <button class="btn btn-primary w-100 mb-2">Show Post</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                @foreach(Auth::user()->relations as $relation)
                    @if($relation->user)
                        @foreach($relation->user->posts as $post)
                            Posted By: {{$relation->user->name}}
                            <div class="card mb-3">
                                <img src="/img/{{ $post->photo ? $post->photo->name : '' }}" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">{{ $post->body }} <span class="pull-right">[{{$post->created_at->diffForHumans()}}]</span></p>
                                    <span class="pull-left"><a href="#" class="text-decoration-none">5k Likes</a></span><span class="pull-right"><a href="#" class="text-decoration-none">5k Comments</a></span>
                                </div>
                                <div class="row m-0">
                                    <div class="col-sm-12">
                                        <form action="">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" class="form-control">
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100 mb-2"> <i class="fa fa-comment"></i> Comments</button>
                                        </form>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <button class="btn btn-primary w-100 mb-2"><i class="fa fa-thumbs-up"></i> Like</button>
                                            </div>
                                            <div class="col-sm-6">
                                                <button class="btn btn-primary w-100 mb-2">Show Post</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection

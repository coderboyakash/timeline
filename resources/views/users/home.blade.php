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
        @if(session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
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
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Title">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="post_body" class="form-control @error('post_body') is-invalid @enderror" placeholder="Body">
                        @error('post_body')
                            <span class="invalid-feedback" role="alert">
                                <strong>The body field is required.</strong>
                            </span>
                        @enderror
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
                            <span class="pull-left"><a href="" class="text-decoration-none">{{ $post->likes ? count($post->likes) : '0' }} Likes</a></span>
                            <span class="pull-right"><a href="" class="text-decoration-none">{{ $post->comments ? count($post->comments) : '0' }} Comments</a></span>
                        </div>
                        <div class="row m-0">
                            <div class="col-sm-12">
                                <form action="{{ route('comment.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="body">
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 mb-2"> <i class="fa fa-comment"></i> Comments</button>
                                </form>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                @if(!is_liked($post->id))
                                    <div class="col-sm-6">
                                        <form action="{{ route('like.store') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            </div>
                                            <button class="btn btn-primary w-100 mb-2"><i class="fa fa-thumbs-up"></i> Like</button>
                                        </form>
                                    </div>
                                @elseif(is_liked($post->id))
                                    <div class="col-sm-6">
                                        <form action="{{ route('like.destroy', $post->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="form-group"></div>
                                            <button class="btn btn-disabled w-100 mb-2 border"><i style="color:blue;" class="fa fa-thumbs-up"></i> Liked</button>
                                        </form>
                                    </div>
                                @endif
                                    <div class="col-sm-6">
                                        <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary w-100 mb-2 mt-3">Show Post</a>
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
                                    <span class="pull-left"><a href="" class="text-decoration-none">{{ $post->likes ? count($post->likes) : '0' }} Likes</a></span>
                                    <span class="pull-right"><a href="" class="text-decoration-none">{{ $post->comments ? count($post->comments) : '0' }} Comments</a></span>
                                </div>
                                <div class="row m-0">
                                    <div class="col-sm-12">
                                        <form action="{{ route('comment.store') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="body">
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100 mb-2"> <i class="fa fa-comment"></i> Comments</button>
                                        </form>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="row">
                                            @if(!is_liked($post->id))
                                                <div class="col-sm-6">
                                                    <form action="{{ route('like.store') }}" method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                        </div>
                                                        <button class="btn btn-primary w-100 mb-2"><i class="fa fa-thumbs-up"></i> Like</button>
                                                    </form>
                                                </div>
                                            @elseif(is_liked($post->id))
                                                <div class="col-sm-6">
                                                    <form action="{{ route('like.destroy', $post->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="form-group"></div>
                                                        <button class="btn btn-disabled w-100 mb-2 border"><i style="color:blue;" class="fa fa-thumbs-up"></i> Liked</button>
                                                    </form>
                                                </div>
                                            @endif
                                            <div class="col-sm-6">
                                                <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary w-100 mb-2 mt-3">Show Post</a>
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

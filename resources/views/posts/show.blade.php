@extends('layouts.master')
@section('content')
<div class="container">
        @if(session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
        @endif
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            Posted By: {{ $post->user ? $post->user->name : '' }}@if(posted_by_me($post->user->id)) <strong>(you)</strong> @endif
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
                                <input type="text" class="form-control @error('body') is-invalid @enderror" name="body">
                                @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <input type="hidden" name="return" value="show">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-2"> <i class="fa fa-comment"></i> Comments</button>
                        </form>
                        </div>
                        <div class="col-sm-12">
                            <div class="row">
                            @if(!is_liked($post->id))
                                <div class="col-sm-12">
                                    <form action="{{ route('like.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                                            <input type="hidden" name="return" value="show">
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        </div>
                                        <button class="btn btn-primary w-100 mb-2"><i class="fa fa-thumbs-up"></i> Like</button>
                                    </form>
                                </div>
                            @elseif(is_liked($post->id))
                                <div class="col-sm-12 mb-3">
                                    <form action="{{ route('like.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="form-group">
                                            <input type="hidden" name="return" value="show">
                                        </div>
                                        <button class="btn btn-disabled w-100 mb-2 border"><i style="color:blue;" class="fa fa-thumbs-up"></i> Liked</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @if(posted_by_me($post->user->id))
                <a href="" class="btn btn-danger mb-4">Delete Post</a>
            @endif
            <!--  -->
            <ul class="list-unstyled">
                @foreach($post->comments as $comment)
                    <li class="media mb-2">
                        <img src="/img/{{ $post->user->photo ? $post->user->photo->name : '' }}" class="mr-3" style="width:50px;">
                        <div class="media-body">
                        <h5 class="mt-0 mb-1">{{ $comment->user->name }} @if(posted_by_me($comment->user->id)) <span>(you)</span> @endif</h5>
                        <p>{{ $comment->body }}</p>
                        @if(posted_by_me($comment->user->id))
                            <span class="pull-left">
                                <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <input type="submit" class="link" value="Delete" style="border:none; background:none; color:red; outline:none;">
                                </form>
                            </span>
                        @endif
                        <span class="pull-right">{{$comment->created_at->diffForHumans()}}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
            <!--  -->
        </div>
    </div>
</div>
@endsection

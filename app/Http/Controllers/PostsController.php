<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Photo;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'min:8'],
            'post_body' => ['required', 'string', 'min:8'],
        ]);
        if($request->file('image')){
            $path = $request->image->store('images', 'public');
            $post = Post::create([
                'title' => $request->title,
                'user_id' => $request->user_id,
                'body' => $request->post_body,
            ]);
            Photo::create([
                'post_id' => $post->id,
                'user_id' => $request->user_id,
                'path' => $path,
            ]);
            $request->session()->flash('message', 'Post Published Successfully');
            return redirect('home');
        }else{
            $post = Post::create([
                'title' => $request->title,
                'user_id' => $request->user_id,
                'body' => $request->post_body,
            ]);
            $request->session()->flash('message', 'Post Published Successfully');
            return redirect('home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

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
            'body' => ['required', 'string', 'min:8'],
        ]);
        if($request->file('image')){
            $file = $request->file('image');
            $image_name = $file->getClientOriginalName();
            $destinationPath = 'uploads';
            $file->move('img',$file->getClientOriginalName());
            $post = Post::create([
                'title' => $data['title'],
                'body' => $data['body'],
                'user_id' => $request->user_id,
            ]);
            Photo::create([
                'post_id' => $post->id,
                'user_id' => $request->user_id,
                'name' => $image_name,
                'meta_data' => 'post_pic'
            ]);
            $request->session()->flash('success', 'Post Published Successfully');
            return redirect('home');
        }else{
            $post = Post::create([
                'title' => $data['title'],
                'body' => $data['body'],
                'user_id' => $request->user_id,
            ]);
            $request->session()->flash('success', 'Post Published Successfully');
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
        //
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

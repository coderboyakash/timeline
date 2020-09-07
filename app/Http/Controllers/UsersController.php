<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Photo;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $photo = Photo::where('post_id', NULL)->where('user_id', Auth::user()->id)->first();
        return view('users.home', compact('photo'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $photo = Photo::where('post_id', NULL)->where('user_id', $id)->first();
        return view('users.profile', compact('user', 'photo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
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
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
        ]);
        if($request->file('image')){
            $file = $request->file('image');
            $image_name = $file->getClientOriginalName();
            $destinationPath = 'uploads';
            $file->move('img',$file->getClientOriginalName());
            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
            Photo::where('user_id', $id)->where('post_id', NULL)->delete();
            Photo::create([
                'user_id' => $id,
                'name' => $image_name,
            ]);
            $request->session()->flash('message', 'Profile Updated Successfully');
            return redirect('home');
        }else{
            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
            $request->session()->flash('message', 'Profile Updated Successfully');
            return redirect('home');
        }
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
    public function search(Request $request)
    {
        $query = $request->input('search');
        $users = User::where('id', '!=', Auth::user()->id)->where('name', 'like', '%'.$query.'%')->get();
        return view('searchs.index', compact('users'));
    }
}

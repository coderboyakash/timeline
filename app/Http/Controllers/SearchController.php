<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
class SearchController extends Controller
{
    public function search(Request $request){
        $query = $request->input('search');
        $users = User::where('id', '!=', Auth::user()->id)->where('name', 'like', '%'.$query.'%')->get();
        return view('searchs.index', compact('users'));
    }
}

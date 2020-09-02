<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class SearchController extends Controller
{
    public function search(Request $request, $id){
        // dd($request->all());
        $query = $request->search;
        $users = User::where('id', '!=', $id)->where('name', 'like', '%'.$query.'%')->get();
        return view('search', compact('users'));
    }
}

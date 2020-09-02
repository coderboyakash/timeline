<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class SearchController extends Controller
{
    public function search($id){
        $users = User::where('id', '!=', $id)->get();
        return view('search', compact('users'));
    }
}

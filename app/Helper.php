<?php
// use Auth;
use App\Relation;
use App\FriendRequest;
use App\Like;
    function is_friends($id){
        $result = Relation::where('user_2', $id)->where('user_1', Auth::user()->id)->get();
        if(count($result) == 0){
            return false;
        }else{
            return true;
        }
    }
    function is_request_sent($id){
        $result = FriendRequest::where('sender_id', Auth::user()->id)->where('user_id', $id)->get();
        if(count($result) == 0){
            return false;
        }else{
            return true;
        }
    }
    function is_requested($id){
        $result = FriendRequest::where('user_id', Auth::user()->id)->where('sender_id', $id)->get();
        if(count($result) == 0){
            return false;
        }else{
            return true;
        }
    }
    function token($sender_id){
        $request = FriendRequest::where('sender_id', $sender_id)->where('user_id', Auth::user()->id)->select('token')->first();
        return $request->token;
    }
    function is_liked($id){
        $result = Like::where('user_id', Auth::user()->id)->where('post_id', $id)->get();
        if(count($result) == 0){
            return false;
        }else{
            return true;
        }
    }
    function posted_by_me($id){
        if(Auth::user()->id == $id){
            return true;
        }else{
            return false;
        }
    }
?>
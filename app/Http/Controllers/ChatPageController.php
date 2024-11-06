<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatPageController extends Controller
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
        $chat_one = DB::table('chats')
        ->join('users','chats.friend_one_id','=','users.id')
        ->Where('friend_two_id', '=',Auth()->user()->id)->select('chats.*','users.*')
        ->get();
        $chat_two = DB::table('chats')
        ->join('users','chats.friend_two_id','=','users.id')
        ->where('friend_one_id','=',Auth()->user()->id)
        ->select('chats.*','users.*')
        ->get();
      
        return view('chats.chat-page',compact('chat_one','chat_two'));
    }


    function getProfile($id) {
        $user_profile = DB::table('users')
        ->join('user_profiles','users.id','=','user_profiles.user_id')
        ->where('users.id','=',$id)
        ->first();


        return response()->json([
            'status'=>200,
            'data'=>$user_profile
        ]);
    }
}

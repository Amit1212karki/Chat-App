<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\FriendRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FriendRequestController extends Controller
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
        $request = DB::table('friend_requests')
        ->join('users','friend_requests.friend_one_id','=','users.id')
        ->where('friend_two_id','=',Auth::user()->id)
        ->where('status','=',0)
        ->select('users.*','friend_requests.*')
        ->get();

        return view('chats.FriendRequest',compact('request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $sender_id = Auth::user()->id;
        $receiver_id = $request->id;

        if(FriendRequest::where('friend_one_id','=',$sender_id)->where('friend_two_id','=',$receiver_id)->exists())
        {
            return response()->json([
                'status'=>'200',
                'message' => 'already sent request'
            ]);
        }
        elseif(FriendRequest::where('friend_two_id','=',$sender_id)->where('friend_one_id','=',$receiver_id)->exists())
        {
            return response()->json([
                'status'=>'200',
                'message' => 'already sent request'
            ]);
        }
        else{

            $req = new FriendRequest;
            $req->friend_one_id=$sender_id;
            $req->friend_two_id=$receiver_id;
            $req->save();

            return response()->json([
                'status'=>'200',
                'message' => 'success'
            ]);
        }

    }


    public function accept($id)
    {
        $acceptFrined = FriendRequest::find($id);
        $acceptFrined->status = 1;
        $acceptFrined->save();


        $chat = new Chat;
        $chat->friend_one_id = $acceptFrined->friend_one_id;
        $chat->friend_two_id = $acceptFrined->friend_two_id;
        $chat->save();

        $chat_id = $chat->id;

        return response()->json([
            'status'=>'200',
            'message'=>'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FriendRequest  $friendRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(FriendRequest $friendRequest,$id)
    {
        $deleteFriend = FriendRequest::find($id);
        $deleteFriend->delete();
        return response()->json([
            'status'=>'200',
            'message'=>'success',
        ]);
    }
}

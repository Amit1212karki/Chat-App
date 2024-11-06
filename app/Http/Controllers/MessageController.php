<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //

    public function getMessage($id)
    {
        $messages = Message::where('message_chat_id', '=', $id)->get();

       
        return response()->json([
            'status' => 200,
            'data' => $messages
        ]);
    }

    public function create(Request $request,$id){

        $user = Auth()->user()->id;

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $image_new_name = time().$image->getClientOriginalName();
            $image ->move('uploads/image/',$image_new_name);
    
            $message = new Message;
            $message->user_id=$request->user_id;
            $message->message=$request->message;
            $message->message_chat_id = $id;
            $message->image = 'uploads/messageImages/'.$image_new_name;
            $message->save();
        }else{

            $message = new Message;
            $message->user_id=$request->user_id;
            $message->message_chat_id = $id;
            $message->message=$request->message;
            $message->save();
        }

        return response()->json([
            'status'=>200,
        ]);

       

    }
}

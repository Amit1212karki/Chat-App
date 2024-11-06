<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
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
    public function chatHome()
    {   
        $authid = Auth::user('id');
        $user = User::inRandomOrder()
        ->get()
        ->except(Auth::id());
        return view('chats.chat-home',compact('user'));    
    }
    
}

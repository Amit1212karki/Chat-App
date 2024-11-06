<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Profiler\Profile;

class UserProfileController extends Controller
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
        
        $user = DB::table('users')
        ->leftJoin('user_profiles','users.id','=','user_profiles.user_id')
        ->where('users.id','=',auth()->user()->id)
        ->first();
        return view('chats.user-profile',compact('user'));
    }

    public function store(Request $request)
    {
        $user = Auth()->user()->id;

        $image = $request->file('image');
        $image_new_name = time().$image->getClientOriginalName();
        $image ->move('uploads/image/',$image_new_name);


        $profile = new UserProfile;
        $profile->facebook=$request->facebook;
        $profile->twitter=$request->twitter;
        $profile->skype=$request->skype;
        $profile->bio=$request->bio;
        $profile->user_id=$user;
        $profile->profile_image='uploads/image/'.$image_new_name;
        $profile->save();

        return redirect()->route('userprofile');

    }

  
    public function show()
    {
        return view('chats.edit-profile');
    }

   
    public function update(Request $request,UserProfile $userProfile)
    {   
        $user = Auth::user('id');
        $id = $user->id;
        $file = $request->file('image');
        $file_new_name = time().$file->getClientOriginalName();
        $file -> move('uploads/image/', $file_new_name);

        $profile = UserProfile::where('user_id','=',$user->id)->first();
        $profile-> profile_image = 'uploads/image/'.$file_new_name;
        $profile -> facebook = $request->facebook;
        $profile -> twitter = $request->twitter;
        $profile -> skype = $request->skype;
        $profile -> bio = $request->bio;
        $profile -> user_id = $id;
        $profile->save();

        return redirect('/userprofile');


    }

   
}

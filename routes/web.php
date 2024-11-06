<?php

use App\Http\Controllers\ChatPageController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// login
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/logout', function () {
    Auth::logout();
});

	
Route::get('/status', [UserController::class, 'userOnlineStatus']);


Auth::routes();

// main homepage 
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/chathome', [App\Http\Controllers\ChatController::class, 'chatHome'])->name('chatHome');
Route::get('/chatpage', [App\Http\Controllers\ChatPageController::class, 'index'])->name('chatpage');

// profile
Route::get('/userprofile', [App\Http\Controllers\UserProfileController::class, 'index'])->name('userprofile');
Route::get('/edit-profile', [App\Http\Controllers\UserProfileController::class, 'show'])->name('editProfile');
Route::post('/update-profile', [App\Http\Controllers\UserProfileController::class, 'update'])->name('update.profile');


// friend request 
Route::post('/send-request', [FriendRequestController::class, 'create'])->name('sendRequest');
Route::get('/showrequest', [FriendRequestController::class, 'index'])->name('showRequest');
Route::get('/get-message/{id}', [MessageController::class, 'getMessage'])->name('getMessage');


// accept friend request
Route::get('/accept-request/{id}',[FriendRequestController::class,'accept'])->name('request.accept');
Route::get('/delete-request/{id}',[FriendRequestController::class,'destroy'])->name('request.delete');



// get profile 
Route::get('/get-profile/{id}', [ChatPageController::class, 'getProfile'])->name('get.profile');

// send message
Route::post('/send-message/{id}',[MessageController::class,'create'])->name('message.create');




Route::get('/video-chat', function () {
    // fetch all users apart from the authenticated user
    $users = User::where('id', '<>', Auth::id())->get();
    return view('video-chat', ['users' => $users]);
});

// Endpoints to call or receive calls.
Route::post('/video/call-user', 'App\Http\Controllers\VideoChatController@callUser');
Route::post('/video/accept-call', 'App\Http\Controllers\VideoChatController@acceptCall');
@extends('layouts.master')
@section('content')
<section class="w-75p-3" style="background-color: #eee" ;>

  <div class="card-body text-center" style="height: 90vh;">
    <h2 class="text-center" style="color:blue">My Profile</h2>
    <div class="mt-3 mb-4">
      @if($user->profile_image == null )
      <img class="rounded-circle img-fluid" style="height: 150px; width:150px; border-radius:50%;" src="https://source.unsplash.com/random" />
      @else
      <img class="rounded-circle img-fluid" style="height: 150px; width:150px; border-radius:50%;" src="{{asset($user->profile_image)}}" />

      @endif
    </div>
    <h4 class="mb-2">{{$user->f_name}} {{$user->l_name}}</h4>
    <?php

    use Carbon\Carbon;
    ?>
    <span>Member since {{\Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</span>

    <div class="mt-3 mb-4 pb-2">
      <a type="button" href="{{$user->facebook}}" class="btn btn-outline-primary btn-floating">
        <i class="fab fa-facebook-f fa-lg"></i>
      </a>
      <a type="button" href="{{$user->twitter}}" class="btn btn-outline-primary btn-floating">
        <i class="fab fa-twitter fa-lg"></i>
      </a>
      <a type="button" href="{{$user->skype}}" class="btn btn-outline-primary btn-floating">
        <i class="fab fa-skype fa-lg"></i>
      </a>
    </div>

    <a href="/edit-profile">
      <button type="button" class="btn btn-primary btn-rounded btn-lg">
        Edit Profile
      </button>
    </a>


    <div class="mt-3 mb-4" style="color:black">
      <p class="text-muted mb-4">{{$user->email}} <span class="mx-2">|</span> {{$user->bio}}</p>
    </div>

  </div>

  <div class="message">
    <div class="message__outer">
      <div class="message__avatar"></div>
      <div class="message__inner">
        <div class="message__bubble"></div>
        <div class="message__actions"></div>
        <div class="message__spacer"></div>
      </div>
      <div class="message__status"></div>
    </div>
  </div>
</section>
@endsection
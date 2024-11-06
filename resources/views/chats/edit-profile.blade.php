@extends('layouts.master')
@section('content')
<section class="w-75p-3" style="background-color: #eee" ;>

  <div class="card-body text-center" style="height: 90vh;">
    <h2 class="text-center" style="color:blue">Edit Your Profile</h2>
    <div class="container">
      <form action="/update-profile" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
        <div class="form-group">
          <label for="name">Profile Picture</label>
          <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
          <label for="name">Facebook</label>
          <input type="text" name="facebook" class="form-control">
        </div>
        <div class="form-group">
          <label for="name">Twitter</label>
          <input type="text" name="twitter" class="form-control">
        </div>
        <div class="form-group">
          <label for="name">Skype</label>
          <input type="text" name="skype" class="form-control">
        </div>
        <div class="form-group">
          <label for="name">Bio</label>
          <textarea name="bio" id="" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <input type="submit" class="btn btn-success">
      </form>
    </div>
  </div>
</section>
@endsection
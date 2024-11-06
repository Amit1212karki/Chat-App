@extends('layouts.master')
@section('content')

<div class="container my-3">
  <h5 style="color:blue">Mange friend requst</h5>

</div>

<div class="single-active-friend my-3">

  @if($request->count() <= 0) <div>
    <h4 class="text-center">No request yet</h4>
</div>
@else

@foreach($request as $data)
<a class="my-3 mb-5 p-5" style="text-decoration: none;">
  <div class="container shadow p-3" style="border-radius: 10px;">
    <div class="row">
      <div class="col-md-1">
        <div class="user-image" style="position: relative; height:50px; width:50px; border-radius:50%; background:url('https://source.unsplash.com/random'); background-size:cover;background-repeat:no-repeat">
          <div class="online" style="height: 10px; width:10px; border-radius:50%; background:#32CD32; position:absolute; bottom:1px; right:1px; border:1px solid #fff">

          </div>
        </div><!-- user image -->
      </div>
      <div class="col-md-8">
        <div class="user-info">
          <h5>{{$data->f_name}} {{$data->m_name}} {{$data->l_name}}</h5>
          <p>{{$data->email}}</p>
        </div>
      </div>
      <div class="col-md-3">
        <div style="height: 100%; display:flex; align-items:center; justify-content:center">
          <i class="fa-solid fa-user-plus fa-2x" id="user-request" onclick="acceptRequest(`{{$data->id}}`)" style="color:orange"></i>
          <i class="fa-solid fa-user-minus fa-2x ms-2" id="user-request" onclick="deleteRequest(`{{$data->id}}`)" style="color:red"></i>

        </div>
      </div>

    </div>
  </div>
</a>
@endforeach
@endif

</div>

<script>
  const acceptRequest = (e) => {
    var id = e;

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({

      url: '/accept-request/'+id,
      type: "GET",
      dataType: 'json',
      success: function(data) {
        console.log(data);
        if (data.message == 'success') {
          alert('request accepted')
          location.reload();
        }

      },
      error: function(data) {
        console.log(data);

      }
    });
  }
  const deleteRequest = (e) => {
    var id = e;

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
     
      url: '/delete-request/'+id,
      type: "GET",
      dataType: 'json',
      success: function(data) {
        console.log(data)
        if (data.message == 'success') {
          alert('request deleted');
          location.reload();
        }

      },

    });
  }

</script>
@endsection
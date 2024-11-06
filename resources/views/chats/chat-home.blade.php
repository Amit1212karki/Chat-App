@extends('layouts.master')
@section('content')

<div class="container my-3">
  <h5 style="color:blue">Search your friends</h5>
  <form class="d-flex">
    <input id="myInput" onkeyup="myFunction()" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
  </form>
</div>

<div class="single-active-friend my-3">

  @if($user->count() <= 0) <div>
    <h4 class="text-center">No user registerd yet</h4>
</div>
@else
<div id="myUL">
  @foreach($user as $data)
  <a class="my-3 mb-5 p-5" style="text-decoration: none;">
    <div class="container shadow p-3" style="border-radius: 10px;">
      <div class="row">
        <div class="col-md-1">
          <div class="user-image" style="position: relative; height:50px; width:50px; border-radius:50%; background:url('https://source.unsplash.com/random'); background-size:cover;background-repeat:no-repeat">
            @if(Cache::has('user-is-online-' . $data->id))
            <div class="online" style="height: 15px; width:15px; border-radius:50%; background:#32CD32; position:absolute; bottom:1px; right:1px; border:2.5px solid #fff">

            </div>
            @else
            <div class="online" style="height: 15px; width:15px; border-radius:50%; background:#aaaaaa; position:absolute; bottom:1px; right:1px; border:2.5px solid #fff">

            </div>
            @endif
          </div><!-- user image -->
        </div>
        <div class="col-md-8">
          <div class="user-info">
            <h5 class="user-name">{{$data->f_name}} {{$data->m_name}} {{$data->l_name}}</h5>
            <p>{{$data->email}}</p>
          </div>
        </div>
        <div class="col-md-3">
          <div style="height: 100%; display:flex; align-items:center; justify-content:center">
            <i class="fa-solid fa-user-plus fa-2x user-request" id="user-request" onclick="hello(`{{$data->id}}`)" style="color:orange"></i>
          </div>
        </div>

      </div>
    </div>
  </a>
  @endforeach
  @endif

</div>


<script>
  function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("a");
    for (i = 0; i < li.length; i++) {
      a = li[i].getElementsByClassName("user-name")[0];
      txtValue = a.textContent || a.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        li[i].style.display = "";
      } else {
        li[i].style.display = "none";
      }
    }
  }
</script>
<script>
  const hello = (e) => {
    var id = e;
    console.log(id)
    value = {
      'id': id
    }
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      data: value,
      url: '/send-request',
      type: "POST",
      dataType: 'json',
      success: function(data) {

        console.log(data)

        if (data.message == 'success') {
          alert('request sent')
        }

        if (data.message == 'already sent request') {
          alert('request already sent')
        }

      },
      error: function(data) {
        console.log(data);

      }
    });
  }
  const yes = () => {
    console.log('add room')
  }
</script>
@endsection
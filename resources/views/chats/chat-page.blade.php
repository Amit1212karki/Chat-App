    @extends('layouts.master')
    @section('content')
    @inject('carbon', 'Carbon\Carbon')
    <div class="container-fluid ">
        <div class="row">
            <div class="col-lg-3 border pt-3">
                <input type="text" class="form-control mb-4" placeholder="search here">
                <ul class="list-group p-1" style=" width: 100%;height: 80vh; overflow: scroll; overflow-x: hidden;">
                    @foreach($chat_one as $c)

                    <a onclick="getMessage(`{{$c->chat_id}}`);getProfile(`{{$c->id}}`) ;setRunningFunction(`{{$c->chat_id}}`) " style="text-decoration: none;">
                        <li class="list-group-item d-flex">
                            <div class="user-image" style="position: relative; height:50px; width:50px; border-radius:50%; background:url('https://upload.wikimedia.org/wikipedia/commons/0/05/Google_Messages_logo.svg'); background-size:cover;background-repeat:no-repeat">
                                @if(Cache::has('user-is-online-' . $c->id))
                                <div class="online" style="height: 15px; width:15px; border-radius:50%; background:#32CD32; position:absolute; bottom:1px; right:1px; border:2.5px solid #fff">

                                </div>
                                @else
                                <div class="online" style="height: 15px; width:15px; border-radius:50%; background:#aaaaaa; position:absolute; bottom:1px; right:1px; border:2.5px solid #fff">

                                </div>
                                @endif
                            </div><!-- user image -->
                            <div class="ms-3">
                                <span style="font-weight: 600;">{{$c->f_name}} {{$c->m_name}} {{$c->l_name}}</span><br>
                                <span>{{$carbon::parse($c->last_seen)->diffForHumans() }}</span>
                            </div>

                        </li>
                    </a>


                    @endforeach
                    @foreach($chat_two as $c)

                    <a onclick="getMessage(`{{$c->chat_id}}`);getProfile(`{{$c->id}}`);setRunningFunction(`{{$c->chat_id}}`)" style="text-decoration: none;">
                        <li class="list-group-item d-flex">
                            <div class="user-image" style="position: relative; height:50px; width:50px; border-radius:50%;background:url('https://upload.wikimedia.org/wikipedia/commons/0/05/Google_Messages_logo.svg');  background-size:cover;background-repeat:no-repeat">
                                @if(Cache::has('user-is-online-' . $c->id))
                                <div class="online" style="height: 15px; width:15px; border-radius:50%; background:#32CD32; position:absolute; bottom:1px; right:1px; border:2.5px solid #fff">

                                </div>
                                @else
                                <div class="online" style="height: 15px; width:15px; border-radius:50%; background:#aaaaaa; position:absolute; bottom:1px; right:1px; border:2.5px solid #fff">

                                </div>
                                @endif
                            </div><!-- user image -->
                            <div class="ms-3">
                                <span style="font-weight: 600;">{{$c->f_name}} {{$c->m_name}} {{$c->l_name}}</span><br>
                                <span>{{$carbon::parse($c->last_seen)->diffForHumans() }}</span>
                            </div>

                        </li>
                    </a>


                    @endforeach

                </ul>
            </div>
            <div class="col-lg-6" style="height: 88vh; position: relative;">
                <div class="container-fluid" id="message-box" style="height: 75vh;overflow: scroll;overflow-x: hidden;">
                    <div class="row m-3">
                        <div class="col-lg-12 d-flex justify-content-center align-items-center" style="height: 400px;">
                            <span class="text-center">select a conversation</span>
                        </div>


                    </div>
                </div>
                <div class="inputs" style="position: absolute; width:97%; bottom:0px;">
                    <form onsubmit=" " action="#" id="sendMessage">
                        <div class="form-group d-flex">
                            <input type="text" class="form-control" id="message-input">
                            <div class="image-upload">
                                <label for="file-input" style="padding: 10px; border: 1px solid;margin: 3px 3px;">

                                    <img src="https://cdn2.iconfinder.com/data/icons/pittogrammi/142/95-512.png" width="20px" alt="">
                                </label>

                                <input id="file-input" type="file" />
                            </div>
                            <button type="submit">
                                <svg width="50px" height="50px" viewBox="0 0 24 24" class="crt8y2ji">
                                    <path d="M16.6915026,12.4744748 L3.50612381,13.2599618 C3.19218622,13.2599618 3.03521743,13.4170592 3.03521743,13.5741566 L1.15159189,20.0151496 C0.8376543,20.8006365 0.99,21.89 1.77946707,22.52 C2.41,22.99 3.50612381,23.1 4.13399899,22.8429026 L21.714504,14.0454487 C22.6563168,13.5741566 23.1272231,12.6315722 22.9702544,11.6889879 C22.8132856,11.0605983 22.3423792,10.4322088 21.714504,10.118014 L4.13399899,1.16346272 C3.34915502,0.9 2.40734225,1.00636533 1.77946707,1.4776575 C0.994623095,2.10604706 0.8376543,3.0486314 1.15159189,3.99121575 L3.03521743,10.4322088 C3.03521743,10.5893061 3.34915502,10.7464035 3.50612381,10.7464035 L16.6915026,11.5318905 C16.6915026,11.5318905 17.1624089,11.5318905 17.1624089,12.0031827 C17.1624089,12.4744748 16.6915026,12.4744748 16.6915026,12.4744748 Z" fill="#0084ff"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 pt-3 text-center border" id="profile">

            </div>
        </div>
    </div>

    <style>
        .image-upload>input {
            display: none;
        }
    </style>

    <script>
        function setRunningFunction(e) {
            setInterval(function() {
                getMessage(e)
            }, 1000);
        }

        const getMessage = (e) => {

            var id = e;
            var user = `{{auth()->user()->id}}`
            $('#sendMessage').attr('onSubmit', `sendMessage(${id}); return false`)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({

                url: '/get-message/' + id,
                type: "GET",
                dataType: 'json',
                success: function(data) {
                    $('#message-box').empty();
                    console.log(data);
                    for (let i = 0; i < data.data.length; i++) {
                        if (data.data[i].user_id == user) {
                            $('#message-box').append(`<div class="row m-3 justify-content-end"><div class="col-lg-12"><div style="display: flex;justify-content: end;"><span class="p-2 bg-primary text-white rounded border border-primary">${data.data[i].message}</span></div></div></div>`)
                        } else {
                            $('#message-box').append(`<div class="row m-3"><div class="col-lg-12"><div><span class="p-2 bg-light rounded border border-primary">${data.data[i].message}</span></div></div></div>`)
                        }
                    }
                },
                error: function(data) {
                    console.log(data);

                }
            });
        }

        function getProfile(id) {
            console.log('first')
            var user_id = id

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/get-profile/' + user_id,
                type: "GET",
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('#profile').empty();
                    $('#profile').append(`<ul style="list-style: none;"><li><img id="profile_image" src="${data.data.profile_image}" style="width: 150px; height: 150px; border-radius: 50%;" alt=""></li><li><span id="profile_name" style="font-weight: bold;font-size: 30px;">${data.data.f_name} ${data.data.l_name}</span></li></ul>`)

                },
                error: function(data) {
                    console.log(data);

                }
            });
        }

        function sendMessage(id) {
            var user = `{{auth()->user()->id}}`
            var message = $('#message-input').val();
            var file = $('#file-input').prop('files');
            var data = new FormData;
            data.append('image', file[0]);
            data.append('message', message);
            data.append('user_id', user);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/send-message/' + id,
                type: "post",
                data: data,
                processData: false, //add this
                contentType: false, //and this
                success: function(data) {
                    console.log(data);
                    $('#message-input').val('');
                    $('#file-input').val('');
                    getMessage(id);
                    $('#message-box').animate({
            scrollTop: $('html, #message-box').height()
        }, 'slow');
                },
                error: function(data) {
                    console.log(data);

                }
            });
        }
    </script>
    @endsection
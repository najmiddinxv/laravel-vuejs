@extends('layouts.backend')
@section('content')
<div class="chat-container">
    <div class="chat-sidebar">
        <h1>Chat Rooms</h1>
        <ul>
            @foreach ($users as $user)
            <li><a href="{{route('chat.room',['user_id'=>$user->id])}}">{{$user->username}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="chat-main">
        <div class="chat-header">
            <h2>Room 1</h2>
        </div>

        <ul class="chat-list" id="messages">
            {{-- @foreach($messages as $message)
                <li class="{{($message->from_id == auth()->user()->id) ? 'my-message' : 'user-message'}}">
                    {{ $message->message }}
                </li>
            @endforeach --}}
            {{-- <li class="user-message">user-message</li> --}}
            @foreach ($messages as $message)
                @if ($message->from_id == auth()->user()->id)
                    <li class="my-message">{{$message->message}}</li>
                @else
                {{-- @if($message->to_id == request()->user_id) --}}
                    <li class="user-message">{{$message->message}}</li>
                @endif
            @endforeach
        </ul>
        <div class="chat-input">
            <form action="" id="chat-form" method="POST">
                @csrf
                @method('post')
                <input type="text" required id="message-input" class="form-control" placeholder="Type your message...">
                <button id="send-button" class="btn btn-info">Send</button>
            </form>
        </div>
    </div>
</div>

<style>

.chat-list {
        list-style: none;
        padding: 0;
    }

    .my-message {
        background-color: #DCF8C6;
        border-radius: 10px;
        padding: 10px;
        margin: 10px 0;
        text-align: right;
    }

    .user-message {
        background-color: #E1E1E1;
        border-radius: 10px;
        padding: 10px;
        margin: 10px 0;
        text-align: left;
    }

.chat-container {
    display: flex;
    max-width: 800px;
    margin: 0 auto;
    background-color: #fff;
    border: 1px solid #ccc;
}

.chat-sidebar {
    width: 25%;
    padding: 20px;
    border-right: 1px solid #ccc;
}

.chat-sidebar h1 {
    font-size: 20px;
    margin-bottom: 20px;
}

.chat-sidebar ul {
    list-style: none;
    padding: 0;
}

.chat-sidebar li {
    margin-bottom: 10px;
}

.chat-main {
    flex: 1;
}

.chat-header {
    background-color: #007BFF;
    color: #fff;
    padding: 10px;
    text-align: center;
    font-size: 20px;
}

/* .chat-messages {
    max-height: 400px;
    overflow-y: scroll;
    padding: 10px;
} */

.chat-input {
    padding: 10px;
    /* display: flex; */
    align-items: center;
    border-top: 1px solid #ccc;
}
.chat-input form{
    display: flex;
    justify-content: space-between;
}
#message-input {
    /* flex: 1; */
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

#send-button {
    background-color: #007BFF;
    color: #fff;
    border: none;
    border-radius: 3px;
    padding: 5px 10px;
    cursor: pointer;
}
</style>






    {{-- <div class="container">
        <div id="app" style="margin-top: 100px">
            <div id="chat-window">
                <div id="messages">
                    @foreach ($messages as $message)
                        <p>{{$message->message}}</p>
                    @endforeach
                </div>
                <form action="" id="chat-form" method="POST">
                    <input type="text" required id="message-input" class="form-control" placeholder="Type your message...">
                    <button id="send-button" class="btn btn-info">Send</button>
                </form>
            </div>
        </div>
    </div> --}}
@endsection
@section('scripts')
<script>

    let socket = new WebSocket("ws://192.168.150.72:8080");

    socket.onopen = function(e) {
        // alert("[open] Соединение установлено");
        console.log("[open] Соединение установлено");
        // alert("Отправляем данные на сервер");
        // socket.send("asdasda");
    };

    socket.onmessage = function(event) {
        console.log(event);
        // alert(`[message] Данные получены с сервера: ${event.data}`);
        console.log(`[message] Данные получены с сервера: ${event.data}`);
        // $('#messages').text(`${event.data} nomli post yaratildi`);
            if(typeof event.data === "object"){
                $('#messages').append(`<li>${event.data}</li>`);
            }else{
                var ArrayData = JSON.parse(event.data);
                $('#messages').append(`<li class="user-message">${ArrayData['message']}</li>`);
            }
        toastr.success('Sizga yangi xabar keldi')

    };

    socket.onclose = function(event) {
        if (event.wasClean) {
            console.log(`[close] Соединение закрыто чисто, код=${event.code} причина=${event.reason}`);
        } else {
            // например, сервер убил процесс или сеть недоступна
            // обычно в этом случае event.code 1006
            console.log('[close] Соединение прервано');
        }
    };

    socket.onerror = function(error) {
        console.error("[error] An error occurred:", error);
    };


    $('#chat-form').on('submit', function(e){
        e.preventDefault();
        // console.log('asdasd');

        var myMessage = $('#message-input').val();
        const data = {
            from_id: {{auth()->user()->id}},
            to_id: {{request()->user_id}},
            message: myMessage
        };
        const jsonData = JSON.stringify(data);
        socket.send(jsonData);

        $('#messages').append(`<li class="my-message">${myMessage}</li>`);
        $('#message-input').val('');
    })

</script>
@endsection

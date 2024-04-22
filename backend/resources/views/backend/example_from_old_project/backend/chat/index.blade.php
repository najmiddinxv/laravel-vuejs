@extends('layouts.backend')
@section('content')
    <div class="container">
        <ul class="list-group">
            @foreach ($users as $user)
                <li class="list-group-item"><a href="{{route('chat.room',['user_id'=>$user->id])}}">{{$user->username}}</a></li>
            @endforeach
        </ul>
    </div>
@endsection
@section('scripts')
<script>

    // let socket = new WebSocket("ws://192.168.150.72:8080");

    // socket.onopen = function(e) {
    //     // alert("[open] Соединение установлено");
    //     console.log("[open] Соединение установлено");
    //     // alert("Отправляем данные на сервер");
    //     socket.send("asdasda");
    // };

    // socket.onmessage = function(event) {
    //     console.log(event);
    //     // alert(`[message] Данные получены с сервера: ${event.data}`);
    //     console.log(`[message] Данные получены с сервера: ${event.data}`);
    //     // $('#messages').text(`${event.data} nomli post yaratildi`);
    //         if(typeof event.data === "object"){
    //             $('#messages').append(`<p>${event.data}</>`);
    //         }else{
    //             var ArrayData = JSON.parse(event.data);
    //             $('#messages').append(`<p>${ArrayData['message']}</>`);
    //         }
    //     toastr.success('Sizga yangi xabar keldi')

    // };

    // socket.onclose = function(event) {
    //     if (event.wasClean) {
    //         console.log(`[close] Соединение закрыто чисто, код=${event.code} причина=${event.reason}`);
    //     } else {
    //         // например, сервер убил процесс или сеть недоступна
    //         // обычно в этом случае event.code 1006
    //         console.log('[close] Соединение прервано');
    //     }
    // };

    // socket.onerror = function(error) {
    //     console.error("[error] An error occurred:", error);
    // };


    // $('#chat-form').on('submit', function(e){
    //     e.preventDefault();
    //     // console.log('asdasd');
    //     const data = {
    //         from_id: {{auth()->user()->id}},
    //         to_id: 12,
    //         message: $('#message-input').val()
    //     };
    //     const jsonData = JSON.stringify(data);
    //     socket.send(jsonData);

    //     $('#message-input').val('');
    // })

</script>
@endsection

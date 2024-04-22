@extends('layouts.backend')
@section('content')
<div class="container">
    <form action="{{route('post.store')}}" method="POST" id="post-store">
        @csrf
        <input type="number" name="category_id" placeholder="category" required>
        <input type="text" name="title" placeholder="title" id="post-title" required>
        <input type="text" name="description" placeholder="description" required>
        <input type="text" name="body" placeholder="body" required>
        <button type="submit">send</button>
    </form>
</div>
@endsection
@section('scripts')
<script>
    // yoki ichkaridan yuborsak ham boladi
    // postcontrollerning store methodiga qara
    //----------------------------------------------------------------
    // shu yerdan ham websocketga xabar yuborsak boladi va uni qaysi pageda chiqarmochi bolsak osha joyga js websocket code orqali chiqaramiz
    //masalan post/index.blade.php ga qara
    // let socket = new WebSocket("ws://192.168.150.72:8080");

    // $('#post-store').on('submit', function(){
    //     // alert('adasd');
    //     // let outgoingMessage = $(this).serialize();
    //     let outgoingMessage = $('#post-title').val();
    //     socket.send(outgoingMessage);
    //     return false;
    // })
</script>
@endsection

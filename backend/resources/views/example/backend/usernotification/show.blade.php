@extends('layouts.backend')
@section('content')
    <div class="container">

        <p>{{$usernotification->data['title']}}</p>
        <p>read at : {{$usernotification->read_at}}</p>
        <p>created at : {{$usernotification->created_at}}</p>

    </div>
@endsection
@section('scripts')
<script>
</script>
@endsection

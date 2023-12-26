@extends('layouts.backend')
@section('content')
    <div class="container">

        <div class="table-responsive">
            <table class="table">
            <caption>List of posts</caption>
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">title</th>
                <th scope="col">status</th>
            </tr>
            </thead>
            <tbody>
                @forelse ($usernotifications as $key => $usernotification)
                    <tr>
                        <td>{{1 + $key}}</td>
                        <td><a href="{{route('usernotification.show',['id'=>$usernotification->id])}}">{{$usernotification['data']['title']}}</a></td>
                        <td>{{$usernotification->read_at === null ? 'yangi' : 'eski'}}</td>
                    </tr>
                @empty
                    <p>no content</p>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
@endsection
@section('scripts')
<script>
</script>
@endsection

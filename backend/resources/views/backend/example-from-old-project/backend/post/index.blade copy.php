@extends('layouts.backend')
@section('content')
    <div class="container">

        <ul>
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li>
                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                </li>
            @endforeach
        </ul>

        {{app()->getLocale()}}
        <h3>@lang('lang.hello')</h3>

        <hr>
        <p>role</p>
        {{-- @role('super-admin', 'admin')
            I am a super-admin!
        @else
            I am not a super-admin...
        @endrole --}}
        @role('admin')
            <h1>men Admin</h1>
        @else
            <h1>Admin emasman</h1>
        @endrole

        @role('manager')
            <h1>men manager</h1>
        @else
            <h1>manager emasman</h1>
        @endrole

        @role('user')
            <h1>men user</h1>
        @else
            <h1>user emasman</h1>
        @endrole

        <p>permission</p>
        @can('delete')
            <h1>delete</h1>
        @else
            <h1>delete qilish imkoniyatim yoq</h1>
        @endcan

        @can('publish')
            <h1>publish</h1>
        @else
            <h1>publish qilish imkoniyatim yoq</h1>
        @endcan

        @can('view')
            <h1>view</h1>
        @else
            <h1>view qilish imkoniyatim yoq</h1>
        @endcan

        {{-- @if(auth()->user()->can('edit articles') && $some_other_condition)

        @endif --}}


        <hr>
        {{-- <h3>user ntification : <a href="{{route('usernotification.index')}}">{{\App\Models\User::first()->unreadNotifications->count()}} ta</a></h3> --}}
    <div style="margin-top: 50px">
        <form action="{{ route('post.search') }}" method="get">
            <div class="row">
                <div class="col-md-10">
                    <input type="text" class="form-control mb-3" placeholder="search" name="q" id="searchUser">
                    <ul id="userList"></ul>
                </div>
                <div class="col-md-2">
                    <input type="submit" class="form-control mb-3" value="Search">
                </div>
            </div>
        </form>

        <ul>
        </ul>
    </div>


    <div>
        <h1 id="websocket-test"></h1>
    </div>


        <style>
            img {
                background: #F1F1FA;
                width: 400px;
                height: 300px;
                display: block;
                margin: 10px auto;
                border: 0;
            }
        </style>

        <img src="https://ik.imagekit.io/demo/img/image1.jpeg?tr=w-400,h-300" />
        <img src="https://ik.imagekit.io/demo/img/image2.jpeg?tr=w-400,h-300" />
        <img src="https://ik.imagekit.io/demo/img/image3.jpg?tr=w-400,h-300" />
        <img class="lazy" data-src="https://ik.imagekit.io/demo/img/image4.jpeg?tr=w-400,h-300" />
        <img class="lazy" data-src="https://ik.imagekit.io/demo/img/image5.jpeg?tr=w-400,h-300" />
        <img class="lazy" data-src="https://ik.imagekit.io/demo/img/image6.jpeg?tr=w-400,h-300" />
        <img class="lazy" data-src="https://ik.imagekit.io/demo/img/image7.jpeg?tr=w-400,h-300" />
        <img class="lazy" data-src="https://ik.imagekit.io/demo/img/image8.jpeg?tr=w-400,h-300" />
        <img class="lazy" data-src="https://ik.imagekit.io/demo/img/image9.jpeg?tr=w-400,h-300" />
        <img class="lazy" data-src="https://ik.imagekit.io/demo/img/image10.jpeg?tr=w-400,h-300" />

        <h2>jami postlar : {{count($models)}}</h2>
        <div class="table-responsive">
            <table class="table">
            <caption>List of posts</caption>
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">title</th>
                <th scope="col">Image</th>
            </tr>
            </thead>
            <tbody>
                @forelse ($models as $key => $model)
                    <tr>
                        <td>{{1 + $key}}</td>
                        {{-- <td><a href="{{route('post.show',['slug'=>$model->slug])}}">{{$model->title}}</a></td> --}}
                        {{-- <td><a href="{{route('post.show',['slug'=>$model->slug])}}">{{$model->getTranslations('title', ['uz', 'ru']);}}</a></td> --}}
                        {{-- <td><a href="{{route('post.show',['slug'=>$model->slug])}}">{{$model->getTranslations('title', app()->getLocale());}}</a></td> --}}
                        <td><a href="{{route('post.show',['slug'=>$model->slug])}}">
                            {{-- {{$model->title}} --}}
                            {{-- {{$model->title[app()->getLocale()] ?? ''}} --}}

                            @php $modelData = json_decode($model->title, true); @endphp
                           <p> {{ $modelData[app()->getLocale()] ?? null }}</p>

                            <p>{{$model->title}}</p>
                            {{-- {{$model->getTranslation('title', app()->getLocale())}} --}}
                        </a></td>
                        <td><img class="lazy" src="{{$model->image}}" alt="" style="width: 100px"></td>
                        <td>
                            <form action="{{route('post.destroy',['post'=>$model->id])}}" method="post">
                                @csrfa
                                @method('DELETE')
                                <button type="submit">x</button>
                            </form>
                        </td>
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
    var lang = `{{app()->getLocale()}}`;
   $(function() {
        $('.lazy').lazy({
            // delay: 500,
            beforeLoad: function(element) {
                var imageSrc = element.data('src');
                console.log('image "' + imageSrc + '" is about to be loaded');
            },
            scrollDirection: 'vertical',
            effect: "fadeIn",
            effectTime: 1000,
            threshold: 0,
            onError: function(element) {
                console.log('error loading ' + element.data('src'));
            }
        });
    });

    $('#searchUser').on('keyup',function() {
        var query = $(this).val();
        $.ajax({
            url:"{{ route('post.search') }}",
            type:"GET",
            data:{'q':query},
            success:function (data) {
                console.log(data.posts);
                var postsLi = ``;
                if (data.posts && data.posts.length>0){
                    data.posts.forEach(post => {
                         var jsonTitle = JSON.parse(post.title);
                        // console.log(jsonTitle['uz']);
                        // postsLi+=`<li>${jsonTitle['uz']}</li>` // {"uz":"Sport yangiliklari","ru":"Спортивные новости","en":"Sports news"}
                         postsLi+=`<li>${jsonTitle[`${lang}`]}</li>` // {"uz":"Sport yangiliklari","ru":"Спортивные новости","en":"Sports news"}
                        // bazaga shu tartibda saqlanga bolsa laravelda chiqarish uchun
                        // mcamara va spatie laravel translatabledan foydalanilayotgan bolas shunday tartibda chiuqarsa boladi

                        // postsLi+=`<li>${post.title.uz}</li>`
                        postsLi+=`<li>${post.title}</li>`
                    });
                }
                $('#userList').html(postsLi);

            }
        })
    });






    // let socket = new WebSocket("ws://192.168.150.72:8080");

    // socket.onopen = function(e) {
    //     // alert("[open] Соединение установлено");
    //     // console.log("[open] Соединение установлено");
    //     // alert("Отправляем данные на сервер");
    //     // socket.send("asdasda");
    // };contact

    // socket.onmessage = function(event) {
    //     console.log(event);
    //     // alert(`[message] Данные получены с сервера: ${event.data}`);
    //     // console.log(`[message] Данные получены с сервера: ${event.data}`);
    //     $('#websocket-test').text(`${event.data} nomli post yaratildi`);
    //     toastr.success(`${event.data} `, 'nomli post yaratildi')
    // };

    // socket.onclose = function(event) {
    //     // if (event.wasClean) {
    //     //     alert(`[close] Соединение закрыто чисто, код=${event.code} причина=${event.reason}`);
    //     // } else {
    //     //     // например, сервер убил процесс или сеть недоступна
    //     //     // обычно в этом случае event.code 1006
    //     //     alert('[close] Соединение прервано');
    //     // }
    // };

    // socket.onerror = function(error) {
    //     // alert(`[error]`);
    // };

</script>
@endsection

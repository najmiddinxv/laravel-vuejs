@extends('frontend.layouts.main')
@section('content')
<div class="site-title-area text-center shadow dark bg-fixed text-light" style="background-image: url(/assets/frontend/img/2440x1578.png);">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Blog Right Sidebar</h1>
            </div>
        </div>
    </div>
</div>
<div class="breadcrumb-area text-center bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="#">Blog</a></li>
                    <li class="active">Right Sidebar</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="blog-area full-blog right-sidebar default-padding">
    <div class="container">
        <div class="row">

            {{-- <div class="blog-items">
                <div class="blog-content "> --}}

                    @forelse($posts as $post)
                    <div class="single-item col-md-4">
                        <div class="item">
                            <div class="thumb">
                                <a href="#">
                                    <a href="#">
                                        <img src="{{ optional($post->main_image)['large'] ? Storage::url($post->main_image['large']) : '/assets/frontend/img/1500x700.png' }}" alt="Thumb"
                                             style="height: 200px; object-fit: cover; width: 100%;">
                                    </a>

                                </a>
                            </div>
                            <div class="info">
                                <div class="date">
                                    <h4>{{ $post->created_at->format('D, M d, Y')}}</h4>
                                </div>
                                <h4>
                                    <a href="#"> {{Str::limit($post->title , 40,' ...')}}</a>
                                </h4>
                                <div class="meta">
                                    <ul>
                                        <li>
                                            <a href="#"><i class="fas fa-comments"></i> 23 Comments</a>
                                        </li>
                                    </ul>
                                </div>
                                <p>
                                    {{ $post->description }}
                                </p>
                                <a class="btn btn-theme border btn-md" href="{{ route('frontend.posts.show',['slug'=>$post->slug]) }}">{{ __('lang.read_more') }}</a>
                            </div>
                        </div>
                    </div>
                    @empty

                    @endforelse
                    <div class="row">
                        <div class="col-md-12 pagi-area">
                            <nav aria-label="navigation">

                                {{ $posts->links() }}

                            </nav>
                        </div>
                    </div>

                {{-- </div>
            </div> --}}

        </div>
    </div>
</div>
@endsection

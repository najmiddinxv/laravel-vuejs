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


<div class="blog-area single full-blog right-sidebar default-padding">
    <div class="container">
        <div class="row">
            <div class="blog-items">
                <div class="blog-content col-md-8">
                    <div class="item">

                        <!-- Start Post Thumb -->
                        <div class="thumb">
                            <img src="{{ optional($post->main_image)['large'] ? Storage::url($post->main_image['large']) : '/assets/img/1500x700.png' }}" alt="Thumb">
                        </div>
                        <!-- Start Post Thumb -->

                        <div class="info">
                            <div class="date">
                                <h4>{{ $post->created_at->format('D, M d, Y')}}</h4> <span>{{ $post->view_count }}</span>
                            </div>
                            <h3>{{ $post->title }}</h3>
                            <p>
                                {!! $post->body !!}
                            </p>

                            <!-- Start Post Pagination -->
                            {{-- <div class="post-pagi-area">
                                <a href="{{ $prevPost && $prevPost->slug ? route('frontend.posts.show', ['slug' => $prevPost->slug]) : '' }}">
                                    <i class="fas fa-angle-double-left"></i> Previous Post
                                </a>
                                <a href="{{ $nextPost && $nextPost->slug ? route('frontend.posts.show', ['slug' => $nextPost->slug]) : '' }}">
                                    Next Post <i class="fas fa-angle-double-right"></i>
                                </a>
                            </div> --}}
                            <div class="post-pagi-area">
                                <a href="{{ $prevPost && $prevPost->slug && $prevPost ? route('frontend.posts.show', ['slug' => $prevPost->slug]) : '' }}"
                                   class="post-link {{ $prevPost ? 'active' : 'disabled' }}">
                                    <i class="fas fa-angle-double-left"></i> Previous Post
                                </a>
                                <a href="{{ $nextPost && $nextPost->slug && $nextPost ? route('frontend.posts.show', ['slug' => $nextPost->slug]) : '' }}"
                                   class="post-link {{ $nextPost ? 'active' : 'disabled'}}">
                                    Next Post <i class="fas fa-angle-double-right"></i>
                                </a>
                            </div>

                            <div class="post-tags share">
                                <div class="tags">
                                    <span>Tags: </span>
                                    @forelse ($post->tags as $tag)
                                        <a href="{{ route('frontend.posts.byTag', ['tagId' => $tag->id]) }}">{{ $tag->name }}</a>
                                    @empty

                                    @endforelse
                                </div>
                            </div>

                            <div class="comments-area">
                                <div class="comments-title">
                                    @if($post->comments->isNotEmpty())
                                        <h4>
                                            {{ $post->comments?->count() }} comments
                                        </h4>
                                        <div class="comments-list">
                                            @include('frontend.comments.show', ['comments' => $post->comments])
                                        </div>
                                    @endif
                                </div>

                                <div class="comments-form">
                                    <div class="title">
                                        <h4>Leave a comments</h4>
                                    </div>
                                    @auth
                                    <form action="{{ route('frontend.comments.store', ['commentableId' => $post->id, 'commentableType' => get_class($post)]) }}" method="POST">
                                        @csrf
                                         <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group comments">
                                                    <textarea name="body" class="form-control" placeholder="Comment"></textarea>
                                                </div>
                                                <div class="form-group full-width submit">
                                                    <button type="submit">
                                                        Post Comments
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    @else
                                        <p>comment qoldirish uchun tizimga kiring
                                            <a href="{{route('userProfile.auth.login')}}" title="login" class="btn btn-success">
                                                login
                                            </a>
                                        </p>
                                    @endauth
                                </div>
                            </div>
                            <!-- End Comments Form -->
                        </div>
                    </div>
                </div>

                <!-- Start Sidebar -->
                <div class="sidebar col-md-4">
                    <x-sidebar-component></x-sidebar-component>
                </div>
                <!-- End Start Sidebar -->
            </div>
        </div>
    </div>
</div>
@endsection

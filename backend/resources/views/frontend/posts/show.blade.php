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

                            <style>
                              .post-link {
                                /* display: inline-block;
                                margin-right: 10px;
                                padding: 5px 10px;
                                text-decoration: none;
                                color: black;
                                border: 1px solid black;
                                border-radius: 5px; */
                            }

                            .post-link.active {
                                /* background-color: #007bff; */
                                color: #000;
                            }

                            .post-link.disabled {
                                pointer-events: none;
                                opacity: 0.5;
                                color: grey;
                            }

                            </style>

                            <!-- End Post Pagination -->

                            <!-- Start Post Tag s-->
                            <div class="post-tags share">
                                <div class="tags">
                                    <span>Tags: </span>
                                    <a href="#">Consulting</a>
                                    <a href="#">Planing</a>
                                    <a href="#">Business</a>
                                    <a href="#">Fashion</a>
                                </div>
                            </div>
                            <!-- End Post Tags -->

                            <!-- Start Comments Form -->
                            <div class="comments-area">
                                <div class="comments-title">
                                    <h4>
                                        5 comments
                                    </h4>
                                    <div class="comments-list">
                                        <div class="commen-item">
                                            <div class="avatar">
                                                <img src="assets/img/800x800.png" alt="Author">
                                            </div>
                                            <div class="content">
                                                <h5>Jonathom Doe</h5>
                                                <div class="comments-info">
                                                    <p>July 15, 2018</p> <a href="#"><i class="fa fa-reply"></i>Reply</a>
                                                </div>
                                                <p>
                                                    Delivered ye sportsmen zealously arranging frankness estimable as. Nay any article enabled musical shyness yet sixteen yet blushes. Entire its the did figure wonder off.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="commen-item reply">
                                            <div class="avatar">
                                                <img src="assets/img/800x800.png" alt="Author">
                                            </div>
                                            <div class="content">
                                                <h5>Spark Lee</h5>
                                                <div class="comments-info">
                                                    <p>July 15, 2018</p> <a href="#"><i class="fa fa-reply"></i>Reply</a>
                                                </div>
                                                <p>
                                                    Delivered ye sportsmen zealously arranging frankness estimable as. Nay any article enabled musical shyness yet sixteen yet blushes. Entire its the did figure wonder off.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="comments-form">
                                    <div class="title">
                                        <h4>Leave a comments</h4>
                                    </div>
                                    <form action="#" class="contact-comments">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <!-- Name -->
                                                    <input name="name" class="form-control" placeholder="Name *" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <!-- Email -->
                                                    <input name="email" class="form-control" placeholder="Email *" type="email">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group comments">
                                                    <!-- Comment -->
                                                    <textarea class="form-control" placeholder="Comment"></textarea>
                                                </div>
                                                <div class="form-group full-width submit">
                                                    <button type="submit">
                                                        Post Comments
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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

{{-- <div class="sidebar col-md-4"> --}}
    <aside>
        <div class="sidebar-item search">
            <div class="title">
                <h4>Search</h4>
            </div>
            <div class="sidebar-info">
                <form>
                    <input type="text" class="form-control">
                    <input type="submit" value="search">
                </form>
            </div>
        </div>
        <div class="sidebar-item category">
            <div class="title">
                <h4>category list</h4>
            </div>
            <div class="sidebar-info">
                <ul>
                    @forelse ($categories as $category)
                        <li>
                            <a href="#">{{ $category->name }} <span>{{ $category->posts_count+$category->news_count+$category->pages_count }}</span></a>
                        </li>
                    @empty

                    @endforelse
                </ul>
            </div>
        </div>
        <div class="sidebar-item recent-post">
            <div class="title">
                <h4>Recent Post</h4>
            </div>
            <ul>
                <li>
                    <div class="thumb">
                        <a href="#">
                            <img src="assets/img/800x800.png" alt="Thumb">
                        </a>
                    </div>
                    <div class="info">
                        <a href="#">Participate in staff meetingness manage dedicated</a>
                        <div class="meta-title">
                            <span class="post-date">12 Feb, 2018</span> - By <a href="#">Author</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="thumb">
                        <a href="#">
                            <img src="assets/img/800x800.png" alt="Thumb">
                        </a>
                    </div>
                    <div class="info">
                        <a href="#">Future Plan & Strategy for Consutruction </a>
                        <div class="meta-title">
                            <span class="post-date">12 Feb, 2018</span> - By <a href="#">Author</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="thumb">
                        <a href="#">
                            <img src="assets/img/800x800.png" alt="Thumb">
                        </a>
                    </div>
                    <div class="info">
                        <a href="#">Melancholy particular devonshire alteration</a>
                        <div class="meta-title">
                            <span class="post-date">12 Feb, 2018</span> - By <a href="#">Author</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div class="sidebar-item gallery">
            <div class="title">
                <h4>Gallery</h4>
            </div>
            <div class="sidebar-info">
                <ul>
                    @forelse($images as $image)
                        <li>
                            <a href="{{ Storage::url($image->path['large'] ?? '') }}">
                                <img src="{{ Storage::url($image->path['medium'] ?? '') }}" alt="img">
                            </a>
                        </li>
                    @empty

                    @endforelse
                </ul>
            </div>
        </div>
        <div class="sidebar-item social-sidebar">
            <div class="title">
                <h4>follow us</h4>
            </div>
            <div class="sidebar-info">
                <ul>
                    <li class="facebook">
                        <a href="#">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li class="twitter">
                        <a href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li class="pinterest">
                        <a href="#">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </li>
                    <li class="g-plus">
                        <a href="#">
                            <i class="fab fa-google-plus-g"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </aside>
{{-- </div> --}}

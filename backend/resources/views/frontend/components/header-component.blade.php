<div>
@php
function renderMenu($menu) {
    foreach ($menu as $menu_item) {
        // if (!empty($menu_item->children)) {
        if ($menu_item->children->count() > 0) {

            // echo '<li class="dropdown active">';
            echo '<li class="dropdown">';
            echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" >' . $menu_item->name . '</a>';
            echo '<ul class="dropdown-menu">';
                renderMenu($menu_item->children);
            echo '</ul>';
            echo '</li>';
        } else {
            echo '<li><a href="' . url($menu_item->url) . '">' . $menu_item->name . '</a></li>';

        }
    }

}

// echo '<ul class="nav navbar-nav navbar-right my-style" data-in="#" data-out="#">';
// renderMenu($menu);die;
// echo '</ul>';

@endphp
<header id="home">

    <!-- Start Navigation -->
    <nav class="navbar navbar-default active-border-top attr-border navbar-sticky bootsnav">

        <!-- Start Top Search -->
        <div class="container">
            <div class="row">
                <div class="top-search">
                    <div class="input-group">
                        <form action="#">
                            <input type="text" name="text" class="form-control" placeholder="Search">
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Top Search -->

        <div class="container">

            <!-- Start Atribute Navigation -->
            <div class="attr-nav">
                <ul>
                    <li class="login">
                        @auth
                        <div style="display: flex;align-items:center">
                            <form action="{{route('userProfile.auth.logout')}}" method="POST">
                                @csrf
                                @method('POST')
                                <button class="btn btn-danger" >
                                    <i class="bi bi-box-arrow-right"></i>
                                    Logout
                                </button>
                            </form>
                            @if (request()->routeIs('userProfile.*'))
                            <div>
                                <a href="{{ route('frontend.index') }}" class="btn btn-success">saytga qaytish</a>
                             </div>
                            @else
                            <a href="{{route('userProfile.index')}}" class="btn btn-success">
                                profile
                            </a>
                            @endif
                        </div>

                        @else

                        <a href="{{route('userProfile.auth.login')}}" title="login" class="btn btn-success">
                            login
                        </a>
                        <a href="{{route('userProfile.auth.register')}}" title="register" class="btn btn-success">
                            register
                        </a>

                        @endauth
                    </li>
                    <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                    <li class="side-menu"><a href="#"><i class="fa fa-bars"></i></a></li>
                </ul>
            </div>
            <!-- End Atribute Navigation -->

            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.html">
                    <img src="/assets/frontend/img/logo.png" class="logo" alt="Logo">
                </a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav navbar-right" data-in="#" data-out="#">
                    @php
                        echo renderMenu($menuItems);
                    @endphp
                    <li class="dropdown active">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Home</a>
                        <ul class="dropdown-menu">
                            <li><a href="index-6.html">Home Version Six</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Onepage Version</a>
                                <ul class="dropdown-menu">
                                    <li><a href="index-op.html">Home One</a></li>
                                    <li><a href="index-op-2.html">Home Two</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="active" href="contact.html">contact</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>

        <!-- Start Side Menu -->
        <div class="side">
            <a href="#" class="close-side"><i class="fa fa-times"></i></a>
            <div class="widget">
                <h4 class="title">About Us</h4>
                <p>
                    Arrived compass prepare an on as. Reasonable particular on my it in sympathize. Size now easy eat hand how. Unwilling he departure elsewhere dejection at. Heart large seems may purse means few blind.
                </p>
            </div>
            <div class="widget address">
                <h4 class="title">Office Location</h4>
                <ul>
                    <li>
                        <i class="fas fa-phone"></i>
                        +123 456 7890
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        California, TX 70240
                    </li>
                    <li>
                        <i class="fas fa-envelope-open"></i>
                        info@yourdomain.com
                    </li>
                </ul>
            </div>
            <div class="widget opening-hours">
                <h4>Opening Hours</h4>
                <ul>
                    <li>
                        Mon - Fri <span>9:00 - 21:00</span>
                    </li>
                    <li>
                        Saturday <span>10:00 - 16:00</span>
                    </li>
                </ul>
            </div>
            <div class="widget social">
                <h4 class="title">Connect With Us</h4>
                <ul class="link">
                    <li class="facebook"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="twitter"><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li class="pinterest"><a href="#"><i class="fab fa-pinterest"></i></a></li>
                    <li class="dribbble"><a href="#"><i class="fab fa-dribbble"></i></a></li>
                </ul>
            </div>
        </div>
        <!-- End Side Menu -->

    </nav>
    <!-- End Navigation -->

</header>
</div>

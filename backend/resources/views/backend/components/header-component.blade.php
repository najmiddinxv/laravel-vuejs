<div>
@php
function renderMenu($menu) {
    foreach ($menu as $menu_item) {
        if (!empty($menu_item->children)) {
            // echo '<li class="dropdown active">';
            echo '<li class="dropdown">';
            echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" >' . $menu_item->translate(Yii::$app->language)->name . '</a>';
            echo '<ul class="dropdown-menu">';
            renderMenu($menu_item->children); // Recursively render submenu
            echo '</ul>';
            echo '</li>';
        } else {
            echo '<li><a href="' . Yii::$app->urlManager->createUrl($menu_item->url) . '">' . $menu_item->translate(Yii::$app->language)->name . '</a></li>';

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
                    <li class="dropdown active">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Home</a>
                        <ul class="dropdown-menu">
                            <li><a href="index.html">Home Version One</a></li>
                            <li><a href="index-2.html">Home Version Two</a></li>
                            <li><a href="index-3.html">Home Version Three</a></li>
                            <li><a href="index-4.html">Home Version Four</a></li>
                            <li><a href="index-5.html">Home Version Five</a></li>
                            <li><a href="index-6.html">Home Version Six</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Onepage Version</a>
                                <ul class="dropdown-menu">
                                    <li><a href="index-op.html">Home One</a></li>
                                    <li><a href="index-op-2.html">Home Two</a></li>
                                    <li><a href="index-op-3.html">Home Three</a></li>
                                    <li><a href="index-op-4.html">Home Four</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" >Pages</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" >About</a>
                                <ul class="dropdown-menu">
                                    <li><a href="about.html">Version One</a></li>
                                    <li><a href="about-2.html">Version Two</a></li>
                                </ul>
                            </li>
                            <li><a href="pricing-table.html">Pricing Table</a></li>
                            <li><a href="contact.html">Contact</a></li>
                            <li><a href="404.html">Error Page</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" >Gallery</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Grid Colum</a>
                                <ul class="dropdown-menu">
                                    <li><a href="gallery-grid-2-colum.html">Gallery Two Colum</a></li>
                                    <li><a href="gallery-grid-3-colum.html">Gallery Three Colum</a></li>
                                    <li><a href="gallery-grid-4-colum.html">Gallery Four Colum</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Masonary Colum</a>
                                <ul class="dropdown-menu">
                                    <li><a href="gallery-masonary-2-colum.html">Gallery Two Colum</a></li>
                                    <li><a href="gallery-masonary-3-colum.html">Gallery Three Colum</a></li>
                                    <li><a href="gallery-masonary-4-colum.html">Gallery Four Colum</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" >Services</a>
                        <ul class="dropdown-menu">
                            <li><a href="services.html">Version One</a></li>
                            <li><a href="services-2.html">Version Two</a></li>
                            <li><a href="services-3.html">Version Three</a></li>
                            <li><a href="services-details.html">Services Details</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" >Team</a>
                        <ul class="dropdown-menu">
                            <li><a href="team.html">Three Colum</a></li>
                            <li><a href="team-carousel.html">Carousel</a></li>
                            <li><a href="team-single.html">Single</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Blog</a>
                        <ul class="dropdown-menu">
                            <li><a href="blog-standard.html">Blog Standard</a></li>
                            <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                            <li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
                            <li><a href="blog-single.html">Blog Single Standard</a></li>
                            <li><a href="blog-single-left-sidebar.html">Single Left Sidebar</a></li>
                            <li><a href="blog-single-right-sidebar.html">Single Right Sidebar</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="contact.html">contact</a>
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

@extends('frontend.layouts.main')
@section('content')

    {{-- <x-alert-component type="error">
        <x-slot name="title">This is a alert</x-slot>
        <x-slot name="sub">This is a sub message</x-slot>
    </x-alert-component> --}}

    {{-- @php
        $message = "test";
    @endphp

    <x-alert-component type="danger" :message="$message" class="mt-4"></x-alert-component> --}}

    <!-- Start Header Top
    ============================================= -->
    <div class="top-bar-area inline inc-border">
        <div class="container">
            <div class="row">
                <div class="col-md-7 address-info text-left">
                    <div class="info box">
                        <ul>
                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                <p>
                                   @lang('lang.hello')
                                </p>
                            </li>
                            <li>
                                <i class="fas fa-envelope-open"></i>
                                <p>
                                    Info@gmail.com
                                </p>
                            </li>
                            <li>
                                <i class="fas fa-phone"></i>
                                <p>
                                    +123 456 7890
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5 info-right">
                    <div class="item-flex border-less">
                        <div class="social">
                            <ul>
                                <li>
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fab fa-pinterest"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fab fa-google-plus-g"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="language-switcher">

                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" data-toggle="dropdown">
                                    {{ app()->getLocale() }}
                                    <span class="fas fa-angle-down"></span>
                                </button>
                                <ul class="dropdown-menu">
                                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            <li>
                                                <a rel="alternate" hreflang="{{ $localeCode }}"
                                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                    {{ $properties['native'] }}
                                                </a>
                                            </li>
                                        @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="language-switcher">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="fas fa-user"></span>
                                </a>

                                {{-- @if (Route::has('login'))
                                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                                    @auth

                                    <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>

                                        @else
                                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                                        @endif
                                    @endauth
                                    </div>
                                @endif --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top -->

    <!-- Header
    ============================================= -->
    <x-header-component></x-header-component>
    <!-- End Header -->

    <!-- Start Banner
    ============================================= -->
    <div class="banner-area auto-height title-uppercase small-first text-light text-center">
        <div id="bootcarousel" class="carousel inc-top-heading slide carousel-fade animate_text" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner carousel-zoom">
                <div class="item active">
                    <div class="slider-thumb bg-cover" style="background-image: url(/assets/frontend/img/2440x1578.png);"></div>
                    <div class="box-table">
                        <div class="box-cell shadow dark">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="content">
                                            <h3 data-animation="animated slideInDown">We are Deluck</h3>
                                            <h1 data-animation="animated slideInDown">Start with us and grow your business</h1>
                                            <a data-animation="animated slideInUp" class="btn btn-light border btn-md" href="#">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="slider-thumb bg-cover" style="background-image: url(/assets/frontend/img/2440x1578.png);"></div>
                    <div class="box-table">
                        <div class="box-cell shadow dark">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="content">
                                            <h3 data-animation="animated slideInDown">Search a businessman</h3>
                                            <h1 data-animation="animated slideInLeft">For making a Plan in Your Business</h1>
                                            <a data-animation="animated slideInUp" class="btn btn-light border btn-md" href="#">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="slider-thumb bg-cover" style="background-image: url(/assets/frontend/img/2440x1578.png);"></div>
                    <div class="box-table">
                        <div class="box-cell shadow dark">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="content">
                                            <h3 data-animation="animated slideInDown">Creating more value</h3>
                                            <h1 data-animation="animated slideInRight">Find Value And Build Confidence</h1>
                                            <a data-animation="animated slideInUp" class="btn btn-light border btn-md" href="#">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Wrapper for slides -->

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#bootcarousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#bootcarousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <!-- End Banner -->

    <!-- Start About
    ============================================= -->
    <div class="about-area default-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-4 thumb">
                    <img src="/assets/frontend/img/800x800.png" alt="Thumb">
                </div>
                <div class="col-md-8 tabs-items">
                    <div class="row">

                        <div class="tab-navs col-md-4">
                            <!-- Tab Nav -->
                            <ul class="nav nav-pills">
                                <li class="active">
                                    <a data-toggle="tab" href="#tab1" aria-expanded="true">
                                        <i class="flaticon-story"></i> Our Story
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab2" aria-expanded="false">
                                        <i class="flaticon-shield"></i> Audit & Assurance
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab3" aria-expanded="false">
                                        <i class="flaticon-support-1"></i> 24/7 Live Support
                                    </a>
                                </li>
                            </ul>
                            <!-- End Tab Nav -->
                        </div>

                        <div class="tab-content-box col-md-8">
                            <!-- Start Tab Content -->
                            <div class="tab-content tab-content-info">
                                <!-- Single Item -->
                                <div id="tab1" class="tab-pane fade active in">
                                    <div class="info title">
                                        <h4>Has been working since 2000</h4>
                                        <h2>We Have 35+ Years Of Experiance In Standard Professional Services</h2>
                                        <p>
                                            However venture pursuit he am mr cordial. Forming musical am hearing studied be luckily. Ourselves for determine attending how led gentleman sincerity. Valley afford uneasy joy she thrown though bed set.
                                        </p>
                                        <p>
                                            Friendship so considered remarkably be to sentiments. Offered mention greater fifteen one promise because nor. Why denoting speaking fat indulged saw dwelling raillery.
                                        </p>
                                        <a class="btn btn-theme border btn-md" href="#">Read More</a>
                                    </div>
                                </div>
                                <!-- End Single Item -->

                                <!-- Single Item -->
                                <div id="tab2" class="tab-pane fade">
                                    <div class="info title">
                                        <h3>We offer creative business</h3>
                                        <p>
                                            Calling nothing end fertile for venture way boy. Esteem spirit temper too say adieus who direct esteem. It esteems luckily mr or picture placing drawing no. Apartments frequently or motionless.
                                        </p>
                                        <p>
                                            Proposal its disposed eat advanced marriage sociable. Drawings led greatest add subjects endeavor gay remember. Principles one yet assistance you met impossible.
                                        </p>
                                        <ul>
                                            <li><i class="fas fa-check-circle"></i> Professional Workers</li>
                                            <li><i class="fas fa-check-circle"></i> Consumer satisfaction</li>
                                            <li><i class="fas fa-check-circle"></i> Transport & Logistics</li>
                                            <li><i class="fas fa-check-circle"></i> Financial Services</li>
                                            <li><i class="fas fa-check-circle"></i> Energy Environment</li>
                                            <li><i class="fas fa-check-circle"></i> Business Services </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Single Item -->

                                <!-- Single Item -->
                                <div id="tab3" class="tab-pane fade">
                                    <div class="info title">
                                        <h3>Ask your question to us</h3>
                                        <p>
                                            Calling nothing end fertile for venture way boy. Esteem spirit temper too say adieus who direct esteem. It esteems luckily mr or picture placing drawing no. Apartments frequently or motionless on reasonable projecting expression. Way mrs end gave tall walk fact bed.  Friendship so considered remarkably be to sentiments.
                                        </p>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td>Email</td>
                                                        <td>info@example.com</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phone</td>
                                                        <td>+123 456 7890</td>
                                                    </tr>
                                                    <tr>
                                                        <td>PO Box</td>
                                                        <td>1622 Colins Street West</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Item -->

                            </div>
                            <!-- End Tab Content -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About -->

    <!-- Start Services
    ============================================= -->
    <div class="services-area carousel-shadow half-bg inc-thumb default-padding bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="site-heading text-center">
                        <h2>Our Services</h2>
                        <span class="devider"></span>
                        <p>
                            While mirth large of on front. Ye he greater related adapted proceed entered an. Through it examine express promise no. Past add size game cold girl off how old
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="services-items services-carousel owl-carousel owl-theme text-center">
                        <!-- Single Item -->
                        <div class="item">
                            <div class="thumb">
                                <img src="/assets/frontend/img/800x600.png" alt="Thumb">
                                <div class="overlay">
                                    <a href="#">Read More</a>
                                </div>
                            </div>
                            <div class="info">
                                <div class="icon">
                                    <i class="flaticon-document"></i>
                                </div>
                                <h4>
                                    <a href="#">Financial Planning</a>
                                </h4>
                                <p>
                                    Prudent you too his conduct feeling limited and. Side he lose paid as hope so face upon be. Goodness did suitable learning put.
                                </p>
                            </div>
                        </div>
                        <!-- End Single Item -->
                        <!-- Single Item -->
                        <div class="item">
                            <div class="thumb">
                                <img src="/assets/frontend/img/800x600.png" alt="Thumb">
                                <div class="overlay">
                                    <a href="#">Read More</a>
                                </div>
                            </div>
                            <div class="info">
                                <div class="icon">
                                    <i class="flaticon-investment-1"></i>
                                </div>
                                <h4>
                                    <a href="#">Investment Planning</a>
                                </h4>
                                <p>
                                    Prudent you too his conduct feeling limited and. Side he lose paid as hope so face upon be. Goodness did suitable learning put.
                                </p>
                            </div>
                        </div>
                        <!-- End Single Item -->
                        <!-- Single Item -->
                        <div class="item">
                            <div class="thumb">
                                <img src="/assets/frontend/img/800x600.png" alt="Thumb">
                                <div class="overlay">
                                    <a href="#">Read More</a>
                                </div>
                            </div>
                            <div class="info">
                                <div class="icon">
                                    <i class="flaticon-piggy-bank"></i>
                                </div>
                                <h4>
                                    <a href="#">Mutual Funds</a>
                                </h4>
                                <p>
                                    Prudent you too his conduct feeling limited and. Side he lose paid as hope so face upon be. Goodness did suitable learning put.
                                </p>
                            </div>
                        </div>
                        <!-- End Single Item -->
                        <!-- Single Item -->
                        <div class="item">
                            <div class="thumb">
                                <img src="/assets/frontend/img/800x600.png" alt="Thumb">
                                <div class="overlay">
                                    <a href="#">Read More</a>
                                </div>
                            </div>
                            <div class="info">
                                <div class="icon">
                                    <i class="flaticon-stadistics"></i>
                                </div>
                                <h4>
                                    <a href="#">Markets Research</a>
                                </h4>
                                <p>
                                    Prudent you too his conduct feeling limited and. Side he lose paid as hope so face upon be. Goodness did suitable learning put.
                                </p>
                            </div>
                        </div>
                        <!-- End Single Item -->
                        <!-- Single Item -->
                        <div class="item">
                            <div class="thumb">
                                <img src="/assets/frontend/img/800x600.png" alt="Thumb">
                                <div class="overlay">
                                    <a href="#">Read More</a>
                                </div>
                            </div>
                            <div class="info">
                                <div class="icon">
                                    <i class="flaticon-analysis-1"></i>
                                </div>
                                <h4>
                                    <a href="#">Report Analysis</a>
                                </h4>
                                <p>
                                    Prudent you too his conduct feeling limited and. Side he lose paid as hope so face upon be. Goodness did suitable learning put.
                                </p>
                            </div>
                        </div>
                        <!-- End Single Item -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Services -->

    <!-- Start Chart Box
    ============================================= -->
    <div class="chart-area default-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6 default info">
                    <h2>We are offering best ways To Grow Your Business Management</h2>
                    <p>
                        Both rest of know draw fond post as. It agreement defective to excellent. Feebly do engage of narrow. Extensive repulsive belonging depending if promotion be zealously as. Preference inquietude ask now are dispatched led appearance. Small meant in so doubt hopes. Exquisite excellent son gentleman acuteness her. Do is voice total power mr ye might round still. Delay rapid joy share allow age manor six. Went why far saw many knew.
                    </p>
                    <div class="fun-facts">
                        <div class="row">
                            <div class="col-md-4 item">
                                <div class="fun-fact">
                                    <div class="timer" data-to="230" data-speed="5000"></div>
                                    <span class="medium">Global Locations</span>
                                </div>
                            </div>
                            <div class="col-md-4 item">
                                <div class="fun-fact">
                                    <div class="timer" data-to="89" data-speed="5000"></div>
                                    <span class="medium">Consultants</span>
                                </div>
                            </div>
                            <div class="col-md-4 item">
                                <div class="fun-fact">
                                    <div class="timer" data-to="2348" data-speed="5000"></div>
                                    <span class="medium">Successfull Projects</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="lineChart">
                        <canvas id="lineChart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Chart Box -->

    <!-- Start Our Goal
    ============================================= -->
    <div class="our-goal-area default-padding top-border">
        <div class="container">
            <div class="row">
                <div class="goal-items goal-carousel owl-carousel owl-theme">
                    <!-- Single Item -->
                    <div class="item">
                        <div class="col-md-6 thumb">
                            <img src="/assets/frontend/img/800x700.png" alt="Thumb">
                        </div>
                        <div class="col-md-6 info">
                            <h2>Why Choose us</h2>
                            <h4>Because we are Reliable.</h4>
                            <p>
                                Removed demands expense account in outward tedious do. Particular way thoroughly unaffected projection favourable mrs can projecting own. Thirty it matter enable become admire in giving. See resolved goodness felicity shy civility domestic had but Drawings offended.
                            </p>
                            <blockquote>
                                We always stay with our clients and respect their business. We deliver 100% and provide instant response.
                            </blockquote>
                            <ul>
                                <li>First Working Prosses</li>
                                <li>IT Control Solutions</li>
                                <li>Financial Profil </li>
                                <li>Big Data & Analysis</li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Item -->
                    <!-- Single Item -->
                    <div class="item">
                        <div class="col-md-6 thumb">
                            <img src="/assets/frontend/img/800x700.png" alt="Thumb">
                        </div>
                        <div class="col-md-6 info">
                            <h2>Our Mission</h2>
                            <h4>To Redefine your Career</h4>
                            <p>
                                Removed demands expense account in outward tedious do. Particular way thoroughly unaffected projection favourable mrs can projecting own. Thirty it matter enable become admire in giving. See resolved goodness felicity shy civility domestic had but Drawings offended.
                            </p>
                            <blockquote>
                                We always stay with our clients and respect their business. We deliver 100% and provide instant response.
                            </blockquote>
                            <ul>
                                <li>First Working Prosses</li>
                                <li>IT Control Solutions</li>
                                <li>Financial Profil </li>
                                <li>Big Data & Analysis</li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Item -->
                    <!-- Single Item -->
                    <div class="item">
                        <div class="col-md-6 thumb">
                            <img src="/assets/frontend/img/800x700.png" alt="Thumb">
                        </div>
                        <div class="col-md-6 info">
                            <h2>What we do</h2>
                            <h4>Make our Customers Happy</h4>
                            <p>
                                Removed demands expense account in outward tedious do. Particular way thoroughly unaffected projection favourable mrs can projecting own. Thirty it matter enable become admire in giving. See resolved goodness felicity shy civility domestic had but Drawings offended.
                            </p>
                            <blockquote>
                                We always stay with our clients and respect their business. We deliver 100% and provide instant response.
                            </blockquote>
                            <ul>
                                <li>First Working Prosses</li>
                                <li>IT Control Solutions</li>
                                <li>Financial Profil </li>
                                <li>Big Data & Analysis</li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Item -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Our Goal -->

    <!-- Start Gallery
    ============================================= -->
    <div class="gallery-area bg-gray default-padding">
        <div class="container">
            <div class="gallery-items-area text-center">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="site-heading text-center">
                            <h2>Complate Cases</h2>
                            <span class="devider"></span>
                            <p>
                                While mirth large of on front. Ye he greater related adapted proceed entered an. Through it examine express promise no. Past add size game cold girl off how old
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mix-item-menu text-center">
                            <button class="active" data-filter="*">All</button>
                            <button data-filter=".development">Development</button>
                            <button data-filter=".consulting">Consulting</button>
                            <button data-filter=".finance">Finance</button>
                            <button data-filter=".branding">Branding</button>
                            <button data-filter=".capital">Capital</button>
                        </div>
                        <!-- End Mixitup Nav-->

                        <div class="row text-center masonary">
                            <div id="portfolio-grid" class="gallery-items col-3">
                                <!-- Single Item -->
                                <div class="pf-item development capital">
                                    <div class="item">
                                        <a href="#">
                                            <img src="/assets/frontend/img/800x800.png" alt="Thumb">
                                            <div class="item-inner">
                                                <h4>Startup Funding</h4>
                                                <p>Finance, Assets</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="pf-item consulting branding">
                                    <div class="item">
                                        <a href="#">
                                            <img src="/assets/frontend/img/800x800.png" alt="Thumb">
                                            <div class="item-inner">
                                                <h4>Merger & Acquisition</h4>
                                                <p>Benefits, Business</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="pf-item consulting finance">
                                    <div class="item">
                                        <a href="#">
                                            <img src="/assets/frontend/img/800x800.png" alt="Thumb">
                                            <div class="item-inner">
                                                <h4>Assets for technolodgy</h4>
                                                <p>Invest, Earning</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="pf-item finance">
                                    <div class="item">
                                        <a href="#">
                                            <img src="/assets/frontend/img/800x800.png" alt="Thumb">
                                            <div class="item-inner">
                                                <h4>Startup Funding</h4>
                                                <p>Source, Business</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="pf-item capital development">
                                    <div class="item">
                                        <a href="#">
                                            <img src="/assets/frontend/img/800x800.png" alt="Thumb">
                                            <div class="item-inner">
                                                <h4>Business Matching</h4>
                                                <p>Profit, Earning</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="pf-item consulting branding">
                                    <div class="item">
                                        <a href="#">
                                            <img src="/assets/frontend/img/800x800.png" alt="Thumb">
                                            <div class="item-inner">
                                                <h4>Startup Funding</h4>
                                                <p>Finance, Assets</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- Single Item -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Gallery -->

    <!-- Start Video Area
    ============================================= -->
    <div class="video-area default-padding text-center half-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="heading">
                        <h2>
                            We offer <span>product design, manufacturing</span> and engineering management services.
                        </h2>
                    </div>
                </div>
                <div class="col-md-8 col-md-offset-2">
                    <div class="thumb wow fadeInUp">
                        <img src="/assets/frontend/img/2440x1578.png" alt="Thumb">
                        <a href="https://www.youtube.com/watch?v=owhuBrGIOsE" class="popup-youtube light video-play-button item-center">
                            <i class="fa fa-play"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Video Area -->

    <!-- Start Team
    ============================================= -->
    <div class="team-area bg-gray default-padding bottom-less">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="site-heading text-center">
                        <h2>Meet Our Teams</h2>
                        <span class="devider"></span>
                        <p>
                            While mirth large of on front. Ye he greater related adapted proceed entered an. Through it examine express promise no. Past add size game cold girl off how old
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="team-items text-center">
                    <!-- Single Item -->
                    <div class="col-md-4 single-item">
                        <div class="item">
                            <div class="thumb">
                                <div class="top-img">
                                    <img src="/assets/frontend/img/800x800.png" alt="Thumb">
                                </div>
                                <div class="overlay">
                                    <ul>
                                        <li class="facebook">
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li class="twitter">
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li class="pinterest">
                                            <a href="#"><i class="fab fa-pinterest"></i></a>
                                        </li>
                                        <li class="google-plus">
                                            <a href="#"><i class="fab fa-google-plus-g"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="info">
                                <div class="overlay">
                                    <h4>Jessica Jones</h4>
                                </div>
                                <span>Sales & Marketing / <strong>Mc Ins.</strong></span>
                                <p>
                                    Advice branch vanity or do thirty living. Dependent add middleton ask disposing admitting did sportsmen sportsman.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Item -->
                    <!-- Single Item -->
                    <div class="col-md-4 single-item">
                        <div class="item">
                            <div class="thumb">
                                <div class="top-img">
                                    <img src="/assets/frontend/img/800x800.png" alt="Thumb">
                                </div>
                                <div class="overlay">
                                    <ul>
                                        <li class="facebook">
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li class="twitter">
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li class="pinterest">
                                            <a href="#"><i class="fab fa-pinterest"></i></a>
                                        </li>
                                        <li class="google-plus">
                                            <a href="#"><i class="fab fa-google-plus-g"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="info">
                                <div class="overlay">
                                    <h4>Mark Henri</h4>
                                </div>
                                <span>Senior Developer / <strong>Mc Ins.</strong></span>
                                <p>
                                    Advice branch vanity or do thirty living. Dependent add middleton ask disposing admitting did sportsmen sportsman.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Item -->
                    <!-- Single Item -->
                    <div class="col-md-4 single-item">
                        <div class="item">
                            <div class="thumb">
                                <div class="top-img">
                                    <img src="/assets/frontend/img/800x800.png" alt="Thumb">
                                </div>
                                <div class="overlay">
                                    <ul>
                                        <li class="facebook">
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li class="twitter">
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li class="pinterest">
                                            <a href="#"><i class="fab fa-pinterest"></i></a>
                                        </li>
                                        <li class="google-plus">
                                            <a href="#"><i class="fab fa-google-plus-g"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="info">
                                <div class="overlay">
                                    <h4>Natasha</h4>
                                </div>
                                <span>Data Scientist / <strong>Mc Ins.</strong></span>
                                <p>
                                    Advice branch vanity or do thirty living. Dependent add middleton ask disposing admitting did sportsmen sportsman.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Item -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Team -->

    <!-- Start Blog Area
    ============================================= -->
    <div class="blog-area default-padding bottom-less">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="site-heading text-center">
                        <h2>Latest News</h2>
                        <span class="devider"></span>
                        <p>
                            While mirth large of on front. Ye he greater related adapted proceed entered an. Through it examine express promise no. Past add size game cold girl off how old
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="blog-items">
                    <!-- Single Item -->
                    <div class="col-md-6 single-item">
                        <div class="item">
                            <div class="thumb">
                                <a href="#"><img src="/assets/frontend/img/1500x700.png" alt="Thumb"></a>
                            </div>
                            <div class="info">
                                <div class="date">
                                    <h4>12 Nov, 2019</h4>
                                </div>
                                <h4>
                                    <a href="#">delivered applauded affection out Peculiar trifling</a>
                                </h4>
                                <div class="meta">
                                    <ul>
                                        <li>
                                            <a href="#"><i class="fas fa-user"></i> Admin</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fas fa-comments"></i> 23 Comments</a>
                                        </li>
                                    </ul>
                                </div>
                                <p>
                                    families believed if no elegance interest surprise an. It abode wrong miles an so delay plate. She relation own put outlived may disposed
                                </p>
                                <a class="btn btn-theme border btn-md" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Item -->
                    <!-- Single Item -->
                    <div class="col-md-6 single-item">
                        <div class="item">
                            <div class="thumb">
                                <a href="#"><img src="/assets/frontend/img/1500x700.png" alt="Thumb"></a>
                            </div>
                            <div class="info">
                                <div class="date">
                                    <h4>16 Apr, 2019</h4>
                                </div>
                                <h4>
                                    <a href="#">Peculiar trifling absolute and wandered</a>
                                </h4>
                                <div class="meta">
                                    <ul>
                                        <li>
                                            <a href="#"><i class="fas fa-user"></i> Admin</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fas fa-comments"></i> 32 Comments</a>
                                        </li>
                                    </ul>
                                </div>
                                <p>
                                    families believed if no elegance interest surprise an. It abode wrong miles an so delay plate. She relation own put outlived may disposed
                                </p>
                                <a class="btn btn-theme border btn-md" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Item -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Blog Area -->

    <!-- Start Footer
    ============================================= -->
    <x-footer-component></x-footer-component>
    <!-- End Footer -->

@endsection

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="description" content="Deluck - Business Agency & Corporate Template">
    <meta name="keywords" content="website, blog, foo, bar">
    {{-- <meta property="og:title" content="News of Uzbekistan and the World">
    <meta property="og:description" content="Eng qiziqarli yangiliklar — bizda! Dunyo, mahalliy, shou-biznes, gadjetlar, sport, avtomobillar olami yangiliklaridan xabardor bo‘ling.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kun.uz/en">
    <meta property="og:site_name" content="Kun.uz"> --}}

    {{--
    <meta name="author" content="John Doe">
    <meta name="publisher" content="John Doe">
    <meta name="copyright" content="John Doe">
    <meta name="page-topic" content="Media">
    <meta name="page-type" content="Blogging">
    <meta name="audience" content="Everyone">
    <meta name="robots" content="index, follow">
    <meta http-equiv="content-language" content="en">
    --}}

    <title>Frontend</title>
    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <!-- ========== Start Stylesheet ========== -->
    <link href="{{asset('assets/frontend/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/frontend/css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/frontend/css/flaticon-set.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/frontend/css/magnific-popup.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/frontend/css/owl.carousel.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/frontend/css/owl.theme.default.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/frontend/css/animate.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/frontend/css/bootsnav.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/frontend/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/frontend/css/responsive.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/frontend/css/custom.css')}}" rel="stylesheet" />
    @yield('styles')
    <!-- ========== End Stylesheet ========== -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="assets/js/html5/html5shiv.min.js"></script>
    <script src="assets/js/html5/respond.min.js"></script>
    <![endif]-->
    <!-- ========== Google Fonts ========== -->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800" rel="stylesheet">
</head>
<body>
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
                                            {{-- <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"> --}}
                                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, route('frontend.index'), [], true) }}">
                                                {{ $properties['native'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                      {{-- <div class="language-switcher">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="fas fa-user"></span>
                                </a>

                                 @if (Route::has('login'))
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
                                @endif

                             </div>
                        </div> --}}


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

    @yield('content')


     <!-- Start Footer
    ============================================= -->
    <x-footer-component></x-footer-component>
    <!-- End Footer -->


    <!-- jQuery Frameworks
    ============================================= -->
    <script src="{{asset('assets/frontend/js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/equal-height.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/jquery.appear.js')}}"></script>
    <script src="{{asset('assets/frontend/js/jquery.easing.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/modernizr.custom.13711.js')}}"></script>
    <script src="{{asset('assets/frontend/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/wow.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/count-to.js')}}"></script>
    <script src="{{asset('assets/frontend/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/Chart.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/custom-chart.js')}}"></script>
    <script src="{{asset('assets/frontend/js/bootsnav.js')}}"></script>
    <script src="{{asset('assets/frontend/js/main.js')}}"></script>
    @yield('scripts')
</body>
</html>

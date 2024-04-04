<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Backend - @yield('title')</title>

    <meta name="description" content="Deluck - Business Agency & Corporate Template">
    <meta name="keywords" content="website, blog, foo, bar">
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

    {{-- <meta property="og:title" content="News of Uzbekistan and the World">
    <meta property="og:description" content="Eng qiziqarli yangiliklar — bizda! Dunyo, mahalliy, shou-biznes, gadjetlar, sport, avtomobillar olami yangiliklaridan xabardor bo‘ling.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kun.uz/en">
    <meta property="og:site_name" content="Kun.uz"> --}}

    <link href="{{asset('assets/backend/img/favicon.png')}}" rel="icon">
    <link href="{{asset('assets/backend/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="{{asset('assets/backend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/backend/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/backend/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/backend/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('assets/backend/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{asset('assets/backend/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('assets/backend/vendor/simple-datatables/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/backend/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/backend/css/custom.css')}}" rel="stylesheet">
    @yield('styles')
</head>
<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{route('backend.index')}}" class="logo d-flex align-items-center">
{{--        <img src="assets/img/logo.png" alt="">--}}
        <span class="d-none d-lg-block">Admin</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    {{-- <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div> --}}
    <!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        {{-- <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a>


          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li>
         --}}
        {{-- <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul>
        </li> --}}

          <li class="nav-item dropdown  pe-3">

              <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                  <span class="d-none d-md-block dropdown-toggle ps-2"> {{ app()->getLocale() }}</span>
              </a>
              <style>
                  .dropdown-menu li:last-child {
                      display: none;
                  }
              </style>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages" style="min-width: 120px;padding:0;">

                  @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                        <li class="">
                          <a class="dropdown-item d-flex align-items-center" rel="alternate" hreflang="{{ $localeCode }}"
                             href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                            style="padding: 5px 5px"
                          >
                              {{ $properties['native'] }}
                          </a>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>
                  @endforeach


              </ul>
          </li>

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{asset('assets/backend/img/profile-img.jpg')}}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{auth()->user()->email ?? 'user'}}</span>
          </a><!-- End Profile Iamge Icon -->
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{auth()->user()->last_name}} {{auth()->user()->first_name}}</h6>
              {{-- <span>{{auth()->user()->getRoleNames()}}</span> --}}
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            {{-- <li>
              <a class="dropdown-item d-flex align-items-center" href="">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li> --}}
            <li>
              <hr class="dropdown-divider">
            </li>

              <li>

                  <form action="{{route('backend.auth.logout')}}" method="POST">
                      @csrf
                      @method('POST')
                      <button class="dropdown-item d-flex align-items-center" >
                          <i class="bi bi-box-arrow-right"></i>
                          Logout
                      </button>
                  </form>

              </li>
            <li>
              <hr class="dropdown-divider">
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link " href="{{route('backend.index')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs(['backend.users.*','backend.roles.*','backend.permissions.*']) ? '' : 'collapsed' }}" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Settings</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content {{ request()->routeIs(['backend.users.*','backend.roles.*','backend.permissions.*']) ? 'show' : 'collapse' }}  " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('backend.users.index') }}" class="{{ request()->routeIs('backend.users.*') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Users</span>
            </a>
          </li>
          <li>
            <a href="{{ route('backend.roles.index') }}" class="{{ request()->routeIs('backend.roles.*') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Roles</span>
            </a>
          </li>
          <li>
            <a href="{{ route('backend.permissions.index') }}" class="{{ request()->routeIs('backend.permissions.*') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Permissions</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </aside>
  <main id="main" class="main">
    <section class="section dashboard">
        @yield('content')
    </section>
  </main>
  {{-- <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer> --}}
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="{{asset('assets/backend/js/jquery.min.js')}}"></script>
  <script src="{{asset('assets/backend/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/backend/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{asset('assets/backend/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('assets/backend/vendor/quill/quill.min.js')}}"></script>
  <script src="{{asset('assets/backend/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('assets/backend/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('assets/backend/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('assets/backend/js/main.js')}}"></script>
  <script src="{{asset('assets/backend/js/custom.js')}}"></script>
  @yield('scripts')
</body>
</html>

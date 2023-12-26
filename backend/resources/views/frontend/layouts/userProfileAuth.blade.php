<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Deluck - Business Agency & Corporate Template">
    <meta name="keywords" content="website, blog, foo, bar">
    <link rel="shortcut icon" href="/assets/userProfile/images/favicon.svg" type="image/x-icon" />
    <title>User Profile</title>
    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{asset('assets/user-profile/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/user-profile/css/lineicons.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/user-profile/css/materialdesignicons.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/user-profile/css/main.css')}}" />
    @yield('styles')

</head>
<body>
<main class="">
    <section class="signin-section">
        <div class="container-fluid h-100">
            @yield('content')
        </div>
    </section>
</main>
<script src="{{asset('assets/user-profile/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/user-profile/js/moment.min.js')}}"></script>
<script src="{{asset('assets/user-profile/js/polyfill.js')}}"></script>
<script src="{{asset('assets/user-profile/js/main.js')}}"></script>
@yield('scripts')
</body>
</html>

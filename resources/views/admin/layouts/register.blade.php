<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('admin.partials.action_css')
    <title>@yield('title','LMS')</title>
</head>

<body class="preloader-visible" data-barba="wrapper">
<!-- preloader start -->
<div class="preloader js-preloader">
    <div class="preloader__bg"></div>
</div>
<!-- preloader end -->

<!-- barba container start -->
<div class="barba-container" data-barba="container">


    <main class="main-content">
        <div class="content-wrapper js-content-wrapper">
            <div class="dashboard -home-9 js-dashboard-home-9">
                @yield('dashboard')
            </div>
        </div>
    </main>

{{--aside joyi message btn--}}
</div>
<!-- barba container end -->

<!-- JavaScript -->
@include('admin.partials.action_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
<script src="{{asset('assets/js/depdrop.js')}}"></script>
@yield('prefix')
</body>

</html>

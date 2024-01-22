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
    @yield('summernote-editor')
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
        @include('admin.components.action_header')
        <div class="content-wrapper js-content-wrapper">
            <div class="dashboard -home-9 js-dashboard-home-9">
                @include('admin.components.sidebar')
{{--                @include('admin.components.dashboard')--}}
                @yield('action')
            </div>
        </div>
    </main>

{{--aside joyi message btn--}}
</div>
<!-- barba container end -->

<!-- JavaScript -->
@include('admin.partials.action_js')
@yield('summernote-editor-js')
@yield('depdrop')
</body>

</html>

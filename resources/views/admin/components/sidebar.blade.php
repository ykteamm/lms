<?php
    $rolID = auth()->user()->rol_id
?>
<div class="dashboard__sidebar scroll-bar-1">
    <div class="sidebar -dashboard">
        @if($rolID === 'admin')
        <div class="sidebar__item <?php if (Request::is('admin')){echo '-is-active -dark-bg-dark-2';}?>">
            <a href="/admin" class="d-flex items-center text-17 lh-1 fw-500 -dark-text-white">
                <i class="text-20 fas fa-home mr-15"></i>
                Asosiy sahida
            </a>
        </div>

        <div class="sidebar__item <?php if (Request::is('admin/users')){echo '-is-active -dark-bg-dark-2';}?>">
            <a href="{{url('admin/users')}}" class="d-flex items-center text-17 lh-1 fw-500">
{{--                <i class="text-20 icon-setting mr-15"></i>--}}
                <i class="fas fa-users text-20 mr-15"></i>
                Admin or Assistant
            </a>
        </div>

        <div class="sidebar__item <?php if (Request::is('admin/elchi')){echo '-is-active -dark-bg-dark-2';}?>">
            <a href="{{url('admin/elchi')}}" class="d-flex items-center text-17 lh-1 fw-500">
                <i class="fas fa-users text-20 mr-15"></i>
                Ustozlar va Elchilar
            </a>
        </div>

        <div class="sidebar__item <?php if (Request::is('admin/new_user')){echo '-is-active -dark-bg-dark-2';}?>">
            <a href="{{url('admin/new_user')}}" class="d-flex items-center text-17 lh-1 fw-500">
                <i class="fas fa-users text-20 mr-15"></i>
                Yangi Elchilar
            </a>
        </div>


        <div class="sidebar__item <?php if (Request::is('admin/enter_exit')){echo '-is-active -dark-bg-dark-2';}?>">
            <a href="{{url('admin/enter_exit')}}" class="d-flex items-center text-17 lh-1 fw-500">
                <i class="fas fa-users text-20 mr-15"></i>
                Kirish va Chiqish
            </a>
        </div>

        <div class="sidebar__item <?php if (Request::is('admin/statistic')){echo '-is-active -dark-bg-dark-2';}?>">
            <a href="{{route('statistic_admin')}}" class="d-flex items-center text-17 lh-1 fw-500 -dark-text-white">
                <i class="fas fa-trophy text-20 mr-15"></i>
                Statistika
            </a>
        </div>

{{--        <div class="sidebar__item <?php if (Request::is('admin/users_check')){echo '-is-active -dark-bg-dark-2';}?>">--}}
{{--            <a href="{{url('admin/users_check')}}" class="d-flex items-center text-17 lh-1 fw-500">--}}
{{--                --}}{{--                <i class="text-20 icon-setting mr-15"></i>--}}
{{--                <i class="fas fa-users text-20 mr-15"></i>--}}
{{--                Users Check--}}
{{--            </a>--}}
{{--        </div>--}}

{{--        <div class="sidebar__item <?php if (Request::is('admin/integration')){echo '-is-active -dark-bg-dark-2';}?>">--}}
{{--            <a href="{{url('admin/integration')}}" class="d-flex items-center text-17 lh-1 fw-500">--}}
{{--                --}}{{--                <i class="text-20 icon-setting mr-15"></i>--}}
{{--                <i class="fas fa-users text-20 mr-15"></i>--}}
{{--                Jang Integratsiya--}}
{{--            </a>--}}
{{--        </div>--}}

{{--        <div class="sidebar__item <?php if (Request::is('admin/test')){echo '-is-active -dark-bg-dark-2';}?>">--}}
{{--            <a href="{{url('admin/test')}}" class="d-flex items-center text-17 lh-1 fw-500">--}}
{{--                --}}{{--                <i class="text-20 icon-setting mr-15"></i>--}}
{{--                <i class="fas fa-question text-20 mr-15"></i>--}}
{{--                Test--}}
{{--            </a>--}}
{{--        </div>--}}

{{--        <div class="sidebar__item <?php if (Request::is('admin/group_test')){echo '-is-active -dark-bg-dark-2';}?>">--}}
{{--            <a href="{{url('admin/group_test')}}" class="d-flex items-center text-17 lh-1 fw-500 ">--}}
{{--                <i class="text-20 icon-comment mr-15"></i>--}}
{{--                Group test--}}
{{--            </a>--}}
{{--        </div>--}}

{{--        <div class="sidebar__item <?php if (Request::is('admin/video')){echo '-is-active -dark-bg-dark-2';}?>">--}}
{{--            <a href="{{url('admin/video')}}" class="d-flex items-center text-17 lh-1 fw-500 ">--}}
{{--                --}}{{--                <i class="text-20 icon-bookmark mr-15"></i>--}}
{{--                <i class="fas fa-play text-20 mr-15"></i>--}}
{{--                Videos--}}
{{--            </a>--}}
{{--        </div>--}}

        <div class="sidebar__item <?php if (Request::is('admin/course')){echo '-is-active -dark-bg-dark-2';}?> ">
            <a href="{{url('admin/course')}}" class="d-flex items-center text-17 lh-1 fw-500 ">
                <i class="text-20 icon-play-button mr-15"></i>
                Kurs
            </a>
        </div>

{{--        <div class="sidebar__item <?php if (Request::is('admin/lessons')){echo '-is-active -dark-bg-dark-2';}?>">--}}
{{--            <a href="{{url('admin/lessons')}}" class="d-flex items-center text-17 lh-1 fw-500 ">--}}
{{--                <i class="text-20 icon-list mr-15"></i>--}}
{{--               Lessons--}}
{{--            </a>--}}
{{--        </div>--}}

{{--        <div class="sidebar__item <?php if (Request::is('admin/raspisaniya')){echo '-is-active -dark-bg-dark-2';}?>">--}}
{{--            <a href="{{url('admin/raspisaniya')}}" class="d-flex items-center text-17 lh-1 fw-500 ">--}}
{{--                --}}{{--                <i class="text-20 icon-message mr-15"></i>--}}
{{--                <i class="text-20 mr-15 fas fa-calendar-plus"></i>--}}
{{--                Raspisaniya--}}
{{--            </a>--}}
{{--        </div>--}}


        @elseif($rolID === 'assistant')
            <div class="sidebar__item <?php if (Request::is('admin')){echo '-is-active -dark-bg-dark-2';}?>">
                <a href="/admin" class="d-flex items-center text-17 lh-1 fw-500 -dark-text-white">
                    <i class="text-20 icon-discovery mr-15"></i>
                    Dashboard
                </a>
            </div>

            <div class="sidebar__item <?php if (Request::is('admin/statistic')){echo '-is-active -dark-bg-dark-2';}?>">
                <a href="{{route('statistic_admin')}}" class="d-flex items-center text-17 lh-1 fw-500 -dark-text-white">
                    <i class="fas fa-trophy text-20 mr-15"></i>
                    Statistika
                </a>
            </div>


            <div class="sidebar__item <?php if (Request::is('admin/new_user')){echo '-is-active -dark-bg-dark-2';}?>">
                <a href="{{url('admin/new_user')}}" class="d-flex items-center text-17 lh-1 fw-500">
                    <i class="fas fa-users text-20 mr-15"></i>
                    Yangi Elchilar
                </a>
            </div>

            <div class="sidebar__item <?php if (Request::is('admin/elchi')){echo '-is-active -dark-bg-dark-2';}?>">
                <a href="{{url('admin/elchi')}}" class="d-flex items-center text-17 lh-1 fw-500">
                    {{--                <i class="text-20 icon-setting mr-15"></i>--}}
                    <i class="fas fa-users text-20 mr-15"></i>
                    Ustozlar va Elchilar
                </a>
            </div>


            <div class="sidebar__item <?php if (Request::is('admin/course')){echo '-is-active -dark-bg-dark-2';}?> ">
                <a href="{{url('admin/course')}}" class="d-flex items-center text-17 lh-1 fw-500 ">
                    <i class="text-20 icon-play-button mr-15"></i>
                    Kurs
                </a>
            </div>

{{--            <div class="sidebar__item <?php if (Request::is('admin/users_check')){echo '-is-active -dark-bg-dark-2';}?>">--}}
{{--                <a href="{{url('admin/users_check')}}" class="d-flex items-center text-17 lh-1 fw-500">--}}
{{--                    --}}{{--                <i class="text-20 icon-setting mr-15"></i>--}}
{{--                    <i class="fas fa-users text-20 mr-15"></i>--}}
{{--                    Users Check--}}
{{--                </a>--}}
{{--            </div>--}}
        @else
            <h1>
                Nima bor senga!
            </h1>
        @endif
        <div class="sidebar__item ">
            <a href="{{route('logout')}}" class="d-flex items-center text-17 lh-1 fw-500 ">
                <i class="text-20 icon-power mr-15"></i>
                Chiqish
            </a>
        </div>

    </div>
</div>

<?php
$user = auth()->user();
?>
@extends('admin.layouts.app')
@section('title','LMS')
@section('dashboard')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">
            <div class="row pb-50 mb-10">
                <div class="col-auto">

                    <h1 class="text-30 lh-12 fw-700">Salom, {{$user->first_name}}</h1>
                </div>
            </div>


            <div class="row y-gap-30">

                <div class="col-xl-3 col-md-6">
                    <div class="d-flex justify-between items-center py-35 px-30 rounded-16 bg-white -dark-bg-dark-1 shadow-4">
                        <div>
                            <div class="lh-1 fw-500">Total Sales</div>
                            <div class="text-24 lh-1 fw-700 text-dark-1 mt-20">$10,800</div>
                            <div class="lh-1 mt-25"><span class="text-purple-1">$50</span> New Sales</div>
                        </div>

                        <i class="text-40 icon-coupon text-purple-1"></i>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="d-flex justify-between items-center py-35 px-30 rounded-16 bg-white -dark-bg-dark-1 shadow-4">
                        <div>
                            <div class="lh-1 fw-500">Total Courses</div>
                            <div class="text-24 lh-1 fw-700 text-dark-1 mt-20">3,759</div>
                            <div class="lh-1 mt-25"><span class="text-purple-1">40+</span> New Courses</div>
                        </div>

                        <i class="text-40 icon-play-button text-purple-1"></i>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="d-flex justify-between items-center py-35 px-30 rounded-16 bg-white -dark-bg-dark-1 shadow-4">
                        <div>
                            <div class="lh-1 fw-500">Total Students</div>
                            <div class="text-24 lh-1 fw-700 text-dark-1 mt-20">129,786</div>
                            <div class="lh-1 mt-25"><span class="text-purple-1">90+</span> New Students</div>
                        </div>

                        <i class="text-40 icon-graduate-cap text-purple-1"></i>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="d-flex justify-between items-center py-35 px-30 rounded-16 bg-white -dark-bg-dark-1 shadow-4">
                        <div>
                            <div class="lh-1 fw-500">Total Instructor</div>
                            <div class="text-24 lh-1 fw-700 text-dark-1 mt-20">22,786</div>
                            <div class="lh-1 mt-25"><span class="text-purple-1">290+</span> New Instructors</div>
                        </div>

                        <i class="text-40 icon-online-learning text-purple-1"></i>
                    </div>
                </div>

            </div>

            <div class="row y-gap-30 pt-30">
                <div class="col-xl-8 col-md-6">
                    <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
                        <div class="d-flex justify-between items-center py-20 px-30 border-bottom-light">
                            <h2 class="text-17 lh-1 fw-500">Earning Statistics</h2>
                            <div class="">

                                <div class="dropdown js-dropdown js-category-active">
                                    <div class="dropdown__button d-flex items-center text-14 bg-white -dark-bg-dark-1 border-light rounded-8 px-20 py-10 text-14 lh-12" data-el-toggle=".js-category-toggle" data-el-toggle-active=".js-category-active">
                                        <span class="js-dropdown-title">This Week</span>
                                        <i class="icon text-9 ml-40 icon-chevron-down"></i>
                                    </div>

                                    <div class="toggle-element -dropdown -dark-bg-dark-2 -dark-border-white-10 js-click-dropdown js-category-toggle">
                                        <div class="text-14 y-gap-15 js-dropdown-list">

                                            <div><a href="#" class="d-block js-dropdown-link">Animation</a></div>

                                            <div><a href="#" class="d-block js-dropdown-link">Design</a></div>

                                            <div><a href="#" class="d-block js-dropdown-link">Illustration</a></div>

                                            <div><a href="#" class="d-block js-dropdown-link">Business</a></div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="py-40 px-30">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
                        <div class="d-flex justify-between items-center py-20 px-30 border-bottom-light">
                            <h2 class="text-17 lh-1 fw-500">Traffic</h2>
                            <div class="">

                                <div class="dropdown js-dropdown js-category-active">
                                    <div class="dropdown__button d-flex items-center text-14 bg-white -dark-bg-dark-1 border-light rounded-8 px-20 py-10 text-14 lh-12" data-el-toggle=".js-category-toggle" data-el-toggle-active=".js-category-active">
                                        <span class="js-dropdown-title">This Week</span>
                                        <i class="icon text-9 ml-40 icon-chevron-down"></i>
                                    </div>

                                    <div class="toggle-element -dropdown -dark-bg-dark-2 -dark-border-white-10 js-click-dropdown js-category-toggle">
                                        <div class="text-14 y-gap-15 js-dropdown-list">

                                            <div><a href="#" class="d-block js-dropdown-link">Animation</a></div>

                                            <div><a href="#" class="d-block js-dropdown-link">Design</a></div>

                                            <div><a href="#" class="d-block js-dropdown-link">Illustration</a></div>

                                            <div><a href="#" class="d-block js-dropdown-link">Business</a></div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="py-40 px-30">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('user.components.footer')
    </div>

@endsection


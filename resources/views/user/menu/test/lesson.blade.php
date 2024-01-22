<?php

?>
@extends('user.layouts.app')
@section('title','LMS')
@section('dashboard')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">
            <div class="container">
                <a href="{{url('user')}}" class="btn btn-danger">
                    <i class=" fas fa-backward"></i>
                    Back
                </a>
            </div>
             <section class="layout-pt-md layout-pb-md">
                    <div data-anim-wrap="" class="container animated">
                        <div class="tabs -pills js-tabs">
                            <div class="row y-gap-20 justify-between items-end">
                                <div class="col-auto">
                                    <div class="sectionTitle ">
                                        <h2 class="sectionTitle__title">Lesson</h2>
                                    </div>
                                </div>
                            </div>

{{--                            <section class="">--}}
{{--                                <div class="relative pt-40 col-12">--}}
{{--                                    <img class="w-1/1" src="{{asset('assets/img/lesson-single/1.png')}}" alt="image">--}}
{{--                                    <div class="absolute-full-center d-flex justify-center items-center">--}}
{{--                                        <a href="" class="d-flex justify-center items-center size-60 rounded-full bg-white js-gallery" data-gallery="gallery1">--}}
{{--                                            <div class="icon-play text-18"></div>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </section>--}}

                            <div class="row y-gap-30 mt-60">
                                @foreach($lesson as $less)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                                    @if($less->course_id && $less->video_id)
                                        <a href="{{ url('user/lesson-test/'.$less->id.'/rasp_id/'.$raspisaniya->id) }}" class="">
                                    @elseif($less->course_id && $less->medicine_id)
                                        <a href="{{ url('user/lesson-med-test/'.$less->id.'/rasp_id/'.$raspisaniya->id) }}" class="">
                                    @else
                                    @endif
                                        <div class="relative">
                                            <div class="coursesCard__image overflow-hidden rounded-8">
                                                <img class="w-1/1" src="{{asset('assets/img/coursesCards/1.png')}}" alt="image">
{{--                                                <div class="coursesCard__image_overlay rounded-8"></div>--}}
                                                <div class="absolute-full-center d-flex justify-center items-center">
                                                    <a href="" class="d-flex justify-center items-center size-60 rounded-full bg-white js-gallery" data-gallery="gallery1">
                                                        <div class="icon-play text-18"></div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pt-15">
                                            <div class="text-17 lh-15 fw-500 text-dark-1 mt-10">{{$less->title}}</div>
                                            <div class="d-flex x-gap-10 items-center pt-10">
                                                <div class="d-flex items-center col-6">
                                                    <div class="mr-8">
                                                        <img src="{{asset('assets/img/coursesCards/icons/1.svg')}}" alt="icon">
                                                    </div>
                                                    <div class="text-14 lh-1">Count lesson</div>
                                                </div>
                                                <div class="d-flex items-center col-6">
                                                    <div class="mr-8">
                                                        <img src="{{asset('assets/img/coursesCards/icons/2.svg')}}" alt="icon">
                                                    </div>
                                                    <div class="text-14 lh-1">3h 56m</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            @if($less->course_id && $less->video_id)
                                                <a href="{{ url('user/lesson-test/'.$less->id.'/rasp_id/'.$raspisaniya->id) }}" class="btn btn-success mt-20">
                                                    Test yechish
                                                </a>
                                            @elseif($less->course_id && $less->medicine_id)
                                                <a href="{{ url('user/lesson-med-test/'.$less->id.'/rasp_id/'.$raspisaniya->id) }}" class="btn btn-success mt-20">
                                                </a>
                                            @else
                                            @endif

                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
        </div>

        <footer class="footer -dashboard py-30">
            <div class="row items-center justify-between">
                <div class="col-auto">
                    <div class="text-13 lh-1">© 2022 Educrat. All Right Reserved.</div>
                </div>

                <div class="col-auto">
                    <div class="d-flex items-center">
                        <div class="d-flex items-center flex-wrap x-gap-20">
                            <div>
                                <a href="help-center.html" class="text-13 lh-1">Help</a>
                            </div>
                            <div>
                                <a href="terms.html" class="text-13 lh-1">Privacy Policy</a>
                            </div>
                            <div>
                                <a href="#" class="text-13 lh-1">Cookie Notice</a>
                            </div>
                            <div>
                                <a href="#" class="text-13 lh-1">Security</a>
                            </div>
                            <div>
                                <a href="terms.html" class="text-13 lh-1">Terms of Use</a>
                            </div>
                        </div>

                        <button class="button -md -rounded bg-light-4 text-light-1 ml-30">English</button>
                    </div>
                </div>
            </div>
        </footer>
    </div>

@endsection


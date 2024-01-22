<?php
$number = 1;
?>
@extends('user.layouts.app')
@section('title','First Test')
@section('dashboard')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">
{{--            @if(session()->has('success'))--}}
{{--                <div class="row">--}}
{{--                    <div class="col-12 ">--}}
{{--                        <div class="alert bg-success-1 alert-dismissible fade show pb-20 pt-20 pl-20 pr-20 rounded-8" role="alert">--}}
{{--                            <div class="text-success-2 lh-1 fw-500">{{session('success')}}</div>--}}
{{--                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            @if(session()->has('limit'))
                <div class="row">
                    <div class="col-12 ">
                        <div class="alert bg-error-1 alert-dismissible fade show pb-20 pt-20 pl-20 pr-20 rounded-8" role="alert">
                            <div class="text-error-2 lh-1 fw-500">{{session('limit')}}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif
{{--            @if(session()->has('limit_number'))--}}
{{--                <div class="row">--}}
{{--                    <div class="col-12 ">--}}
{{--                        <div class="alert bg-error-1 alert-dismissible fade show pb-20 pt-20 pl-20 pr-20 rounded-8" role="alert">--}}
{{--                            <div class="text-error-2 lh-1 fw-500">Sizda yana {{session('limit_number')}} ta urinish qoldi!</div>--}}
{{--                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endif--}}


            @if($foiz == null)
            @else
                @if($foiz >= $group_test->ball)
                    <div class="row">
                        <div class="col-12 ">
                            <div class="alert bg-success-1 alert-dismissible fade show pb-20 pt-20 pl-20 pr-20 rounded-8" role="alert">
                                <div class="text-success-2 lh-1 fw-500">Siz testdan muvvaffaqiyatli o'tdingiz! Ishlaringizga omad!</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-12 ">
                            <div class="alert bg-error-1 alert-dismissible fade show pb-20 pt-20 pl-20 pr-20 rounded-8" role="alert">
                                <div class="text-error-2 lh-1 fw-500">Siz testdan muvvaffaqiyatli o'tolmadiz! Yana bir bor sinab ko'ring!</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            <div class="row pb-50 mb-10">
                <div class="col-6">
                    <h1 class="text-30 lh-12 fw-700">{{$course->title}}</h1>
                </div>

            </div>


                <div class="content-wrapper  js-content-wrapper">

                    <section class="">
                        <div class="relative pt-40">
                            <img class="w-1/1" src="{{asset('assets/img/lesson-single/1.png')}}" alt="image">
                            <div class="absolute-full-center d-flex justify-center items-center">
                                <a href="{{$video->url}}" class="d-flex justify-center items-center size-60 rounded-full bg-white js-gallery" data-gallery="gallery1">
                                    <div class="icon-play text-18"></div>
                                </a>
                            </div>
                        </div>
                    </section>

                    <div class="d-flex flex-column">
                        <section class="pt-40 layout-pb-lg lg:order-2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                                        <div class="">
                                            <h4 class="text-18 fw-500">Description</h4>
                                            <p class="mt-30">
                                               {{$video->content}}
                                            </p>

                                            <form action="{{route('check_test')}}" method="POST">
                                                @csrf
                                    @foreach($test as $first)
                                        @if($course->video_id == $video->id && $video->group_test_id == $group_test->id)
                                           <div class="border-light overflow-hidden rounded-8 mt-60">
                                                <div class="py-40 px-40 bg-dark-5">
                                                    <div class="d-flex justify-between">
                                                        <h4 class="text-18 lh-1 fw-500 text-white">Savol {{$number++}}</h4>
                                                        <div class="d-flex x-gap-50">
                                                            <div class="d-flex items-center text-white">
                                                                <div class="icon-flag mr-10"></div>
                                                                <div>Flag Question</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex pt-15">
{{--                                                        <div class="text-white">Not yet answered</div>--}}
{{--                                                        <div class="text-white ml-50">Marked out of 1.00</div>--}}
                                                    </div>
                                                    <div class="text-20 lh-1 text-white mt-15">{{$first->title}}</div>
                                                </div>

                                                <div class="px-40 py-40">
                                                    <input type="hidden" name="question_ids[]" value="{{$first->id}}">
                                                    <input type="hidden" name="course_id" value="{{$course->id}}">
                                                    <input type="hidden" name="ball" value="{{$group_test->ball}}">
                                                    <input type="hidden" name="limit" value="{{$group_test->limit}}">
                                                        <div class="form-radio d-flex items-center">
                                                            <div class="radio">
                                                                <input type="radio" value="A" name="answers[{{ $first->id }}][]" class="answer_check{{$first->id}}">
                                                                <div class="radio__mark">
                                                                    <div class="radio__icon"></div>
                                                                </div>
                                                            </div>
                                                            <div class="fw-500 ml-12">A.{{$first->variant_a}}</div>
                                                        </div>

                                                        <div class="form-radio d-flex items-center mt-20">
                                                            <div class="radio">
                                                                <input type="radio" value="B" name="answers[{{ $first->id }}][]" class="answer_check{{$first->id}}">
                                                                <div class="radio__mark">
                                                                    <div class="radio__icon"></div>
                                                                </div>
                                                            </div>
                                                            <div class="fw-500 ml-12">B.{{$first->variant_b}}</div>
                                                        </div>

                                                        <div class="form-radio d-flex items-center mt-20">
                                                            <div class="radio">
                                                                <input type="radio" value="C" name="answers[{{ $first->id }}][]" class="answer_check{{$first->id}}">
                                                                <div class="radio__mark">
                                                                    <div class="radio__icon"></div>
                                                                </div>
                                                            </div>
                                                            <div class="fw-500 ml-12">C.{{$first->variant_c}}</div>
                                                        </div>

                                                        <div class="form-radio d-flex items-center mt-20">
                                                            <div class="radio">
                                                                <input type="radio" value="D" name="answers[{{ $first->id }}][]" class="answer_check{{$first->id}}">
                                                                <div class="radio__mark">
                                                                    <div class="radio__icon"></div>
                                                                </div>
                                                            </div>
                                                            <div class="fw-500 ml-12">D.{{$first->variant_d}}</div>
                                                        </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                                <div class="d-flex justify-end">
                                                    <button class="button -md -dark-1 text-white -dark-button-white mt-40">Finish</button>
                                                </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>

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
</div>
@endsection


<?php
$number = 1;
?>
@extends('user.layouts.app')
@section('title','Ishga kirish testi')
@section('dashboard')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">

                <div class="container mb-50">
                    <a href="{{url('user/first')}}" class="btn btn-danger">
                        <i class=" fas fa-backward"></i>
                        Back
                    </a>
                </div>

            <div class="row pb-50 mb-10">
                <div class="col-6">
                    <h1 class="text-30 lh-12 fw-700">{{$course->title}}</h1>
                </div>
            </div>
                <div class="content-wrapper  js-content-wrapper">
                    <div class="d-flex flex-column">
                        <section class="pt-40 layout-pb-lg lg:order-2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                                        <div class="">
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
                                                    <div class="text-20 lh-1 text-white mt-15">{{$first->title}}</div>
                                                </div>

                                                <div class="px-40 py-40">
                                                    <input type="hidden" name="question_ids[]" value="{{$first->id}}">
                                                    <input type="hidden" name="course_id" value="{{$course->id}}">
                                                    <input type="hidden" name="ball" value="{{$group_test->ball}}">
                                                    <input type="hidden" name="limit" value="{{$group_test->limit}}">
                                                        <div class="form-radio d-flex items-center">
                                                            <div class="radio">
                                                                <input type="radio" value="A" name="answers[{{ $first->id }}][]" class="answer_check{{$first->id}}" required>
                                                                <div class="radio__mark">
                                                                    <div class="radio__icon"></div>
                                                                </div>
                                                            </div>
                                                            <div class="fw-500 ml-12">A.{{$first->variant_a}}</div>
                                                        </div>

                                                        <div class="form-radio d-flex items-center mt-20">
                                                            <div class="radio">
                                                                <input type="radio" value="B" name="answers[{{ $first->id }}][]" class="answer_check{{$first->id}}" required>
                                                                <div class="radio__mark">
                                                                    <div class="radio__icon"></div>
                                                                </div>
                                                            </div>
                                                            <div class="fw-500 ml-12">B.{{$first->variant_b}}</div>
                                                        </div>

                                                        <div class="form-radio d-flex items-center mt-20">
                                                            <div class="radio">
                                                                <input type="radio" value="C" name="answers[{{ $first->id }}][]" class="answer_check{{$first->id}}" required>
                                                                <div class="radio__mark">
                                                                    <div class="radio__icon"></div>
                                                                </div>
                                                            </div>
                                                            <div class="fw-500 ml-12">C.{{$first->variant_c}}</div>
                                                        </div>

                                                        <div class="form-radio d-flex items-center mt-20">
                                                            <div class="radio">
                                                                <input type="radio" value="D" name="answers[{{ $first->id }}][]" class="answer_check{{$first->id}}" required>
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


<?php
use App\Models\Passed;
?>
@extends('user.layouts.app')
@section('title','Darslar')
@section('dashboard')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">

            <div class="row pb-20 mb-10">
                <div class="col-12">
                    <a href="{{url('user/module/'.$course->course_id)}}" class="btn btn-danger text-white">
                        <i class="fas fa-backward"></i>
                        Orqaga qaytish
                    </a>
                </div>
            </div>

            @if(session()->has('dars_test') )
                <div class="row">
                    <div class="col-12 ">
                        <div class="alert bg-success-1 alert-dismissible fade show pb-20 pt-20 pl-20 pr-20 rounded-8" role="alert">
                            <div class="text-success-2 lh-1 fw-500">
                                {{session('dars_test')}} Keyingi darslarni ham shunday davom eting!
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif

            @if(session()->has('dars_test_fail') )
                <div class="row">
                    <div class="col-12 ">
                        <div class="alert bg-error-1 alert-dismissible fade show pb-20 pt-20 pl-20 pr-20 rounded-8" role="alert">
                            <div class="text-error-2 lh-1 fw-500">
                                {{session('dars_test_fail')}} Umidizni cho'ktirmang va keyingi darslarga yaxshiroq tayyorlaning!
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif


            <div class="row pb-20">
                <div class="col-12">
                    <h1 class="text-30 lh-12 fw-700">Dars</h1>
                </div>
            </div>

            <div class="container mt-15">
                <div class="row">
                    @foreach($lessons as $index => $less)
                        @php

                            $passed = Passed::where([
                                'course_id'=>$course->course_id,
                                'module_id'=>$course->id,
                                'lesson_id'=>$less->id,
                                'user_id'=>$userID,
                                ])->first();

                            $isReady = $index == 0 || Passed::where([
                                'course_id'=>$course->course_id,
                                'module_id'=>$course->id,
                                'lesson_id'=> $lessons[$index - 1]->id,
                                'pass_status'=>1,
                                'user_id'=>$userID,
                                ])->first();
                        @endphp
                    @if($isReady)
                        <div class="side-content mt-15  mr-10 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12" style="border: 2px solid #ddd; border-radius: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            <a href="{{url('user/lesson-show/'.$less->id)}}" class="coursesCard -type-1" style="padding: 20px 10px">
                                <div class="row align-items-center">
                                    <div class="col-2" style="border: 2px solid #e4ded6;border-radius: 20px; padding: 10px;background: #faf8f5;text-align: center;">
                                        <i class="fas fa-play" style="color: green"></i>
                                    </div>
                                    <div class="col-8">
                                        <div class="text-17 lh-15 fw-500 text-dark-1 ">
                                            {{$less->title}}
                                        </div>
                                    </div>
                                    @if($passed && $passed->pass_status == 0 && $passed->limit == 0)
                                        <div class="col-2">
                                            <i class="far fa-times-circle" style="color: #e5b781"></i>
                                        </div>
                                    @elseif($passed && $passed->pass_status == 1)
                                        <div class="col-2">
                                            <i class="fas fa-check-circle" style="color: #e5b781"></i>
                                        </div>
                                    @else
                                        <div class="col-2">
                                            <i class="far fa-circle" style="color: #e5b781"></i>
                                        </div>
                                    @endif
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="side-content mt-15  mr-10 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12" style="border: 2px solid #ddd; border-radius: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                <a href="" class="coursesCard -type-1" style="padding: 20px 10px">
                                    <div class="row align-items-center">
                                        <div class="col-2" style="border: 2px solid #e4ded6;border-radius: 20px; padding: 10px;background: #faf8f5;text-align: center;">
                                            <i class="fas fa-play" style="color: green"></i>
                                        </div>
                                        <div class="col-8">
                                            <div class="text-17 lh-15 fw-500 text-dark-1 ">
                                                {{$less->title}}
                                            </div>
                                        </div>
                                            <div class="col-2">
                                                <i class="fas fa-lock" style="color: #e5b781"></i>
                                            </div>
                                    </div>
                                </a>
                            </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @include('user.components.footer')
        </div>
    </div>

@endsection


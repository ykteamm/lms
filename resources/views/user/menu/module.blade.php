<?php
use App\Models\RaspisaniyaUser;
use App\Models\Passed;
use Carbon\Carbon;
use App\Models\Lesson;
use App\Models\Video;
use App\Models\GroupTest;
use App\Models\AnswerCheck;
use App\Models\Medicine;
use App\Models\Module;
?>
@extends('user.layouts.app')
@section('title','Module')
@section('dashboard')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">

            <div class="row pb-20 mb-10">
                <div class="col-12">
                    <a href="{{route('user')}}" class="btn btn-danger text-white">
                        <i class="fas fa-backward"></i>
                        Orqaga qaytish
                    </a>
                </div>
            </div>
            <div class="row pb-20">
                <div class="col-12">
                    <h1 class="text-30 lh-12 fw-700">Modul</h1>
                </div>
            </div>

            <div class="container mt-15">
                <div class="row">
                    @foreach($module as $modul)
                        @php
                            $lesson =  \App\Models\Lesson::where('module_id', $modul->id)->count();
                            $lesson_id =  \App\Models\Lesson::where('module_id', $modul->id)->first();
                            $passed = Passed::where(['user_id'=>$userID,'module_id'=>$modul->id,'course_id'=>$course_id,'pass_status'=>1])->count();
                            if ($lesson != 0){
                                $progress = round(($passed / $lesson) * 100);
                            }else{
                                $progress = 0;
                            }
                        @endphp
                        <div class="side-content ml-10 mr-10 mt-20 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12" style="padding: 10px 20px; border: 2px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            <a href="{{url('user/lesson/'.$modul->id)}}" class="coursesCard -type-1 ">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="text-17 lh-15 fw-500 text-dark-1 mt-10" style="margin: 10px;">
                                            {{$modul->title}}
                                        </div>
                                        <div class="d-flex pt-10">
                                            <div class="d-flex align-items-center mr-20">
                                                <div class="mr-8">
                                                    <img src="{{asset('assets/img/coursesCards/icons/1.svg')}}" alt="icon">
                                                </div>
                                                <div class="text-14 lh-1">{{$lesson}}ta dars</div>
                                            </div>

{{--                                            <div class="d-flex align-items-center">--}}
{{--                                                <div class="mr-8">--}}
{{--                                                    <img src="{{asset('assets/img/coursesCards/icons/2.svg')}}" alt="icon">--}}
{{--                                                </div>--}}
{{--                                                <div class="text-14 lh-1">3h 56m</div>--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div role="progressbar" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100" style="--value: {{$progress}}"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            @include('user.components.footer')
        </div>
    </div>

@endsection


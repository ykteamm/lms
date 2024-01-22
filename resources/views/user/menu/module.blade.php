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
                                                <div class="text-14 lh-1">{{$lesson}} lesson</div>
                                            </div>

                                            <div class="d-flex align-items-center">
                                                <div class="mr-8">
                                                    <img src="{{asset('assets/img/coursesCards/icons/2.svg')}}" alt="icon">
                                                </div>
                                                <div class="text-14 lh-1">3h 56m</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="--value: 50"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>





            <footer class="footer -dashboard py-30">
                <div class="row items-center justify-between">
                    <div class="col-auto">
                        <div class="text-13 lh-1">© 2024 Novatio. All Right Reserved.</div>
                    </div>

                    <div class="col-auto">
                        <div class="d-flex items-center">
                            <div class="d-flex items-center flex-wrap x-gap-20">
                                <div>
                                    <a href="" class="text-13 lh-1">Help</a>
                                </div>
                                <div>
                                    <a href="" class="text-13 lh-1">Privacy Policy</a>
                                </div>
                                <div>
                                    <a href="#" class="text-13 lh-1">Cookie Notice</a>
                                </div>
                                <div>
                                    <a href="#" class="text-13 lh-1">Security</a>
                                </div>
                                <div>
                                    <a href="" class="text-13 lh-1">Terms of Use</a>
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


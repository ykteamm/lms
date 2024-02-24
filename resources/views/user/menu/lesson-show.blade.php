<?php

use app\Models\Test;

$user = auth()->user();
$urinish = 1;
?>
@extends('user.layouts.app')
@section('title','Video')
@section('dashboard')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">

            @if($user->status == 1)
                <div class="row mb-50">
                    <div class="col-8">
                        <a href="{{url('user/lesson/'.$lesson->module_id)}}" class="btn btn-danger">
                            <i class=" fas fa-backward"></i>
                            Orqaga qaytish
                        </a>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-3 text-center">
                        <i class="fas fa-gem text-14 lh-1" style="color:blue;"></i>
                        @if($zumrad != null)
                            {{$zumrad->zumrad}}
                        @else
                            0
                        @endif
                    </div>
                </div>
            @else
                <div class="container mb-50">
                    <a href="{{route('user')}}" class="btn btn-danger">
                        <i class=" fas fa-backward"></i>
                        Orqaga qaytish
                    </a>
                </div>
            @endif

            @if(session()->has('ball_kam') )
                <div class="row">
                    <div class="col-12 ">
                        <div class="alert bg-error-1 alert-dismissible fade show pb-20 pt-20 pl-20 pr-20 rounded-8"
                             role="alert">
                            <div class="text-error-2 lh-1 fw-500">
                                {{session('ball_kam')}} Sizda {{$passed ? $passed->limit :null}} ta limit qoldi. Ehtiyot
                                bo'ling!
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif

            @if(session()->has('imkoniyat') )
                <div class="row">
                    <div class="col-12 ">
                        <div class="alert bg-success-1 alert-dismissible fade show pb-20 pt-20 pl-20 pr-20 rounded-8"
                             role="alert">
                            <div class="text-success-2 lh-1 fw-500">
                                {{session('imkoniyat')}}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif

            @if(session()->has('dars_test') )
                <div class="row">
                    <div class="col-12 ">
                        <div class="alert bg-error-1 alert-dismissible fade show pb-20 pt-20 pl-20 pr-20 rounded-8"
                             role="alert">
                            <div class="text-error-2 lh-1 fw-500">
                                {{session('dars_test')}} Sizda {{$passed ? $passed->limit :null}} ta limit qoldi.
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif

            @if(session()->has('natija'))
                    <div class="modal fade show" id="Natija"  tabindex="-1" aria-labelledby="exampleModalLabel"  aria-modal="true" role="dialog" style="display: block">
                        <div class="modal-dialog modal-lg" >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModalButton"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        <img src="{{asset('assets/img/ibrat/natija.jpg')}}" width="200" height="50" alt="">
                                    </div>
                                    <div class="text-center" style="padding: 10px 20px">
                                        <h2 class="fw-700">Test yakunlandi</h2>
                                    </div>
                                    <div class="text-center" style="padding: 10px 30px">
                                        @if($group_test->ball <= $natija_result->foiz)
                                            <h5 style="color: #16e116">Muvaffaqiyatli o'tdingiz</h5>
                                        @else
                                            <h5 style="color: red">Muvaffaqiyatsiz urunish</h5>
                                        @endif
                                    </div>
                                    <div style="padding: 10px 10px">
                                        <div class="row align-items-center">
                                            <div class="col-xxl-3 col-xl-3  col-6  mt-20 text-center">
                                                <i class="fas fa-star text-14 lh-1" style="color: blue;"></i>
                                                <br>
                                                <p class="fw-400" style="color: black">O'tish bali</p>
                                                @if($passed == null)
                                                    <div class="col-12 mt-10 text-center">
                                                        <h6 style="color: red">{{$group_test ? $group_test->ball : null}}</h6>
                                                    </div>
                                                @else
                                                    <div class="col-12 mt-10 text-center">
                                                        <h6 style="color: red">{{$group_test->ball}}</h6>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-xxl-3 col-xl-3   col-6  mt-20 text-center">
                                                <i class="fas fa-star text-14 lh-1" style="color: blue;"></i>
                                                <br>
                                                <p class="fw-400" style="color: black">To'plagan balingiz</p>
                                                <div class="col-12 mt-10 text-center">
                                                    @if($group_test->ball <= $natija_result->foiz)
                                                        <h6 style="color: white; background: green;">{{$natija_result->foiz}}</h6>
                                                    @else
                                                        <h6 style="color: white; background: red;">{{$natija_result->foiz}}</h6>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-xl-3  col-6 mt-20 text-center">
                                                <i class="icon-infinity text-14 lh-1" style="color:blue;"></i>
                                                <br>
                                                <p class="fw-400" style="color: black">Imkoniyat</p>
                                                <div class="col-12 mt-10 text-center">
                                                    <h6 style="color: red">{{$natija_pass->limit}}</h6>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-xl-3 col-6 mt-20 text-center">
                                                <i class="fas fa-gem text-14 lh-1" style="color:blue;"></i>
                                                <br>
                                                <p class="fw-400" style="color: black">Zumrad</p>
                                                <div class="col-12 mt-10 text-center">
                                                    <h6 style="color: red">
                                                        @if($group_test->ball <= $natija_result->foiz)
                                                            1
                                                        @else
                                                            0
                                                        @endif
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            @endif

            @if(session()->has('ishga_kirish_natija'))
                    <div class="modal fade show" id="Natija"  tabindex="-1" aria-labelledby="exampleModalLabel"  aria-modal="true" role="dialog" style="display: block">
                        <div class="modal-dialog modal-lg" >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModalButton"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        <img src="{{asset('assets/img/ibrat/natija.jpg')}}" width="200" height="50" alt="">
                                    </div>
                                    <div class="text-center" style="padding: 10px 20px">
                                        <h2 class="fw-700">Test yakunlandi</h2>
                                    </div>
                                    <div class="text-center" style="padding: 10px 30px">
                                        @if($group_test->ball <= $natija_result->foiz)
                                            <h5 style="color: #16e116">Muvaffaqiyatli o'tdingiz</h5>
                                        @else
                                            <h5 style="color: red">Muvaffaqiyatsiz urunish</h5>
                                        @endif
                                    </div>
                                    <div style="padding: 10px 10px">
                                        <div class="row align-items-center">
                                            <div class="col-xxl-3 col-xl-3  col-4  mt-20 text-center">
                                                <i class="fas fa-star text-14 lh-1" style="color: blue;"></i>
                                                <br>
                                                <p class="fw-400" style="color: black">O'tish bali</p>
                                                @if($passed == null)
                                                    <div class="col-12 mt-10 text-center">
                                                        <h6 style="color: red">{{$group_test ? $group_test->ball : null}}</h6>
                                                    </div>
                                                @else
                                                    <div class="col-12 mt-10 text-center">
                                                        <h6 style="color: red">{{$group_test->ball}}</h6>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-xxl-3 col-xl-3   col-4  mt-20 text-center">
                                                <i class="fas fa-star text-14 lh-1" style="color: blue;"></i>
                                                <br>
                                                <p class="fw-400" style="color: black">To'plagan balingiz</p>
                                                <div class="col-12 mt-10 text-center">
                                                    @if($group_test->ball <= $natija_result->foiz)
                                                        <h6 style="color: white; background: green;">{{$natija_result->foiz}}</h6>
                                                    @else
                                                        <h6 style="color: white; background: red;">{{$natija_result->foiz}}</h6>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-xl-3  col-4 mt-20 text-center">
                                                <i class="icon-infinity text-14 lh-1" style="color:blue;"></i>
                                                <br>
                                                <p class="fw-400" style="color: black">Imkoniyat</p>
                                                <div class="col-12 mt-10 text-center">
                                                    <h6 style="color: red">{{$natija_pass->limit}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


            <div class="content-wrapper  js-content-wrapper">
                @if($video_lesson)
                    <section class="">
                        <div class="relative pt-20 col-12">
                            <img class="w-1/1" src="{{asset('storage/'. $video_lesson->image)}}" alt="image">
                            <div class="absolute-full-center d-flex justify-center items-center">
                                <a href="{{$video_lesson->url}}"
                                   class="d-flex justify-center items-center size-60 rounded-full bg-white js-gallery"
                                   data-gallery="gallery1">
                                    <div class="icon-play text-18"></div>
                                </a>
                            </div>
                        </div>
                    </section>

                    <div class="row pt-50">
                        <div class="col-12">
                            <h1 class="text-30 lh-12 fw-700">{{$lesson->title}}</h1>
                        </div>
                    </div>

                    <div class="d-flex flex-column">
                        <section class="pt-40 layout-pb-lg lg:order-2">
                            <div class="row">
                                <div class="col-xxl-12 col-xl-12 col-lg-12">
                                    <div class="">
                                        <h4 class="text-18 fw-500">Tavsif</h4>
                                        <p class="mt-30">
                                            {!!$video_lesson->content !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                @endif

                @if((!$test->isEmpty()) && $group_test)
                    @if($passed && $passed->pass_status == 1)
                        <div class="text-center">
                            <button class="btn btn-warning text-white" type="button" data-bs-toggle="modal"
                                    data-bs-target="#TestNatija2" style="padding: 10px">
                                <i class="fas fa-eye"></i>
                                Natijani ko'rish
                            </button>
                        </div>
                        <div class="modal fade" id="TestNatija2" tabindex="-1" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="text-center" style="padding: 10px 20px">
                                            <h2 class="fw-700">{{$lesson->title}}</h2>
                                        </div>
                                        <div>
                                            <div class="row">
                                                @foreach($result as $res)
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-20">
                                                        @php
                                                            $number = 1;
                                                        @endphp
                                                        <h5 class="fw-500 text-center">{{$urinish++}} chi urinish</h5>
                                                        <div class="row">
                                                            <p class="col-3"
                                                               style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                Javoblaringiz
                                                            </p>

                                                            <p class="col-1"
                                                               style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                To'g'ri
                                                            </p>

                                                            <p class="col-1"
                                                               style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                Noto'g'ri
                                                            </p>

                                                            <p class="col-2"
                                                               style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                Ishlash kerak
                                                            </p>

                                                            <p class="col-2"
                                                               style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                To'plagan ball
                                                            </p>

                                                            <p class="col-3"
                                                               style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                Status
                                                            </p>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-3" style="padding: 0 !important;">
                                                                @foreach($res->user_answers as $questionNumber => $answer)
                                                                    @php
                                                                        $userAnswer = current($answer);
                                                                        $test = Test::find($questionNumber);
                                                                        $correctAnswer = $test ? $test->answer : null;
                                                                        $mark = ($userAnswer == $correctAnswer) ? '+' : '-';
                                                                    @endphp
                                                                    <p>
                                                                        {{$number++}}.
                                                                        @foreach($answer as $subAnswer)
                                                                            {{ $subAnswer }}
                                                                        @endforeach
                                                                        <span style="margin-right: 5px;">
                                                                           @if($mark == '+')
                                                                                <i class="fas fa-check"
                                                                                   style="color: green"></i>
                                                                            @elseif($mark == '-')
                                                                                <i class="fas fa-times"
                                                                                   style="color: red;"></i>
                                                                            @endif
                                                                            </span>
                                                                    </p>
                                                                @endforeach
                                                            </div>
                                                            <div
                                                                class="col-1 justify-content-center d-flex align-items-center"
                                                                style="background: green; color: white; border: 2px solid white;padding: 0 !important;">
                                                                <p>{{$res->correct_answer}}</p>
                                                            </div>
                                                            <div
                                                                class="col-1 justify-content-center d-flex align-items-center"
                                                                style="background: red;color: white; border: 2px solid white;padding: 0 !important;">
                                                                <p>{{$res->question_numbers - $res->correct_answer}}</p>
                                                            </div>
                                                            <div
                                                                class="col-2 d-flex align-items-center justify-content-center"
                                                                style="background: green; color: white; border: 2px solid white;padding: 0 !important;">
                                                                <p>{{$group_test->ball}}</p>
                                                            </div>

                                                            @if($res->foiz >= $group_test->ball)
                                                                <div
                                                                    class="col-2 justify-content-center d-flex align-items-center"
                                                                    style="background: green;color: white; border: 2px solid white;padding: 0 !important;">
                                                                    <p>{{$res->foiz}}</p>
                                                                </div>
                                                            @else
                                                                <div
                                                                    class="col-2 justify-content-center d-flex align-items-center"
                                                                    style="background: red;color: white; border: 2px solid white;padding: 0 !important;">
                                                                    <p>{{$res->foiz}}</p>
                                                                </div>
                                                            @endif
                                                            @if($res->foiz >= $group_test->ball)
                                                                <div class="col-3 d-flex align-items-center"
                                                                     style="background: green; color: white; border: 2px solid white; padding: 0 !important;">
                                                                    <p>
                                                                        O'tdingiz
                                                                    </p>
                                                                </div>
                                                            @else
                                                                <div
                                                                    class="col-3 d-flex align-items-center justify-content-center"
                                                                    style="background: red; color: white; border: 2px solid white; padding: 0 !important;">
                                                                    <p>
                                                                        O'tmadingiz
                                                                    </p>
                                                                </div>
                                                            @endif
                                                            <hr>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        @if($passed && $passed->limit <= 0)
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-center">
                                        <button class="btn btn-warning text-white" type="button" data-bs-toggle="modal"
                                                data-bs-target="#TestNatija1" style="padding: 10px">
                                            <i class="fas fa-eye"></i>
                                            Natijani ko'rish
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center">
                                        <button class="btn btn-info text-white" type="button" data-bs-toggle="modal"
                                                data-bs-target="#Test" style="padding: 10px">
                                            Test yechish
                                            <i class="fas fa-fast-forward ml-10"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="TestNatija1" tabindex="-1" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-center" style="padding: 10px 20px">
                                                <h2 class="fw-700">{{$lesson->title}}</h2>
                                            </div>
                                            <div>
                                                <div class="row">
                                                    @foreach($result as $res)
                                                        <div
                                                            class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-20">
                                                            @php
                                                                $number = 1;
                                                            @endphp
                                                            <h5 class="fw-500 text-center">{{$urinish++}} chi
                                                                urinish</h5>
                                                            <div class="row">
                                                                <p class="col-3"
                                                                   style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                    Javoblaringiz
                                                                </p>

                                                                <p class="col-1"
                                                                   style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                    To'g'ri
                                                                </p>

                                                                <p class="col-1"
                                                                   style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                    Noto'g'ri
                                                                </p>

                                                                <p class="col-2"
                                                                   style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                    Ishlash kerak
                                                                </p>

                                                                <p class="col-2"
                                                                   style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                    To'plagan ball
                                                                </p>

                                                                <p class="col-3"
                                                                   style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                    Status
                                                                </p>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-3" style="padding: 0 !important;">
                                                                    @foreach($res->user_answers as $questionNumber => $answer)
                                                                        @php
                                                                            $userAnswer = current($answer);
                                                                            $test = Test::find($questionNumber);
                                                                            $correctAnswer = $test ? $test->answer : null;
                                                                            $mark = ($userAnswer == $correctAnswer) ? '+' : '-';
                                                                        @endphp
                                                                        <p>
                                                                            {{$number++}}.
                                                                            @foreach($answer as $subAnswer)
                                                                                {{ $subAnswer }}
                                                                            @endforeach
                                                                            <span style="margin-right: 5px;">
                                                                           @if($mark == '+')
                                                                                    <i class="fas fa-check"
                                                                                       style="color: green"></i>
                                                                                @elseif($mark == '-')
                                                                                    <i class="fas fa-times"
                                                                                       style="color: red;"></i>
                                                                                @endif
                                                                            </span>
                                                                        </p>
                                                                    @endforeach
                                                                </div>
                                                                <div
                                                                    class="col-1 justify-content-center d-flex align-items-center"
                                                                    style="background: green; color: white; border: 2px solid white;padding: 0 !important;">
                                                                    <p>{{$res->correct_answer}}</p>
                                                                </div>
                                                                <div
                                                                    class="col-1 justify-content-center d-flex align-items-center"
                                                                    style="background: red;color: white; border: 2px solid white;padding: 0 !important;">
                                                                    <p>{{$res->question_numbers - $res->correct_answer}}</p>
                                                                </div>
                                                                <div
                                                                    class="col-2 d-flex align-items-center justify-content-center"
                                                                    style="background: green; color: white; border: 2px solid white;padding: 0 !important;">
                                                                    <p>{{$group_test->ball}}</p>
                                                                </div>

                                                                @if($res->foiz >= $group_test->ball)
                                                                    <div
                                                                        class="col-2 justify-content-center d-flex align-items-center"
                                                                        style="background: green;color: white; border: 2px solid white;padding: 0 !important;">
                                                                        <p>{{$res->foiz}}</p>
                                                                    </div>
                                                                @else
                                                                    <div
                                                                        class="col-2 justify-content-center d-flex align-items-center"
                                                                        style="background: red;color: white; border: 2px solid white;padding: 0 !important;">
                                                                        <p>{{$res->foiz}}</p>
                                                                    </div>
                                                                @endif
                                                                @if($res->foiz >= $group_test->ball)
                                                                    <div class="col-3 d-flex align-items-center"
                                                                         style="background: green; color: white; border: 2px solid white; padding: 0 !important;">
                                                                        <p>
                                                                            O'tdingiz
                                                                        </p>
                                                                    </div>
                                                                @else
                                                                    <div
                                                                        class="col-3 d-flex align-items-center justify-content-center"
                                                                        style="background: red; color: white; border: 2px solid white; padding: 0 !important;">
                                                                        <p>
                                                                            O'tmadingiz
                                                                        </p>
                                                                    </div>
                                                                @endif
                                                                <hr>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="Test" tabindex="-1" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-center">
                                                <img src="{{asset('assets/img/ibrat/test.png')}}" alt="">
                                            </div>
                                            <div class="text-center" style="padding: 10px 20px">
                                                <h2 class="fw-700">Testni yechishga tayyormisiz!</h2>
                                            </div>
                                            <div class="text-center" style="padding: 10px 30px">
                                                <h5 style="color: gray">Tayyor bo'lgach, boshlash tugmasini bosing</h5>
                                            </div>
                                            <div style="padding: 10px 10px">
                                                <div class="row">
                                                    <div class="col-xxl-3 col-xl-3 col-4 mt-20 text-center">
                                                        <i class="icon-bar-chart-2 text-14 lh-1"
                                                           style="color: blue"></i>
                                                        <br>
                                                        <p class="fw-400" style="color: black">Daraja</p>
                                                        @if($passed == null)
                                                            <div class="col-12 text-center mt-10">
                                                                <h6 style="color: red">{{$group_test ? $group_test->level :null}}</h6>
                                                            </div>
                                                        @else
                                                            <div class="col-12 text-center mt-10">
                                                                <h6 style="color: red">{{$group_test->level}}</h6>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-xxl-2 col-xl-2 col-4 mt-20 text-center">
                                                        <i class="fas fa-question text-14 lh-1" style="color: blue"></i>
                                                        <br>
                                                        <p class="fw-400" style="color: black">Savol</p>
                                                        @if($passed == null)
                                                            <div class="col-12 mt-10 text-center">
                                                                <h6 style="color: red">{{$test_count}}</h6>
                                                            </div>
                                                        @else
                                                            <div class="col-12 mt-10 text-center">
                                                                <h6 style="color: red">{{$test_count}}</h6>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-xxl-2 col-xl-2  col-4  mt-20 text-center">
                                                        <i class="fas fa-star text-14 lh-1" style="color: blue;"></i>
                                                        <br>
                                                        <p class="fw-400" style="color: black">O'tish bali</p>
                                                        @if($passed == null)
                                                            <div class="col-12 mt-10 text-center">
                                                                <h6 style="color: red">{{$group_test ? $group_test->ball : null}}
                                                                    /100</h6>
                                                            </div>
                                                        @else
                                                            <div class="col-12 mt-10 text-center">
                                                                <h6 style="color: red">{{$group_test->ball}}/100</h6>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-xxl-2 col-xl-2 col-4 mt-20 text-center">
                                                        <i class="icon-infinity text-14 lh-1" style="color:blue;"></i>
                                                        <br>
                                                        <p class="fw-400" style="color: black">Imkoniyat</p>
                                                        @if($passed == null)
                                                            <div class="col-12 mt-10 text-center">
                                                                <h6 style="color: red">{{ $group_test ? $group_test->limit : null}}</h6>
                                                            </div>
                                                        @else
                                                            <div class="col-12 mt-10 text-center">
                                                                <h6 style="color: red">{{$passed->limit}}</h6>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    @if($passed && $passed->limit <= 0 && $user->status == 1)
                                                        <div class="col-xxl-3 col-xl-3 col-6 mt-20 text-center">
                                                            <i class="fas fa-gem text-14 lh-1" style="color:blue;"></i>
                                                            <br>
                                                            <p class="fw-400" style="color: black">Sizning
                                                                zumradingiz</p>
                                                            <div class="col-12 mt-10 text-center">
                                                                <h6 style="color: red">{{$zumrad->zumrad}}</h6>
                                                            </div>
                                                        </div>
                                                    @else
                                                        @if($user->status == 1)
                                                            <div class="col-xxl-2 col-xl-2 col-4 mt-20 text-center">
                                                                <i class="fas fa-gem text-14 lh-1"
                                                                   style="color:blue;"></i>
                                                                <br>
                                                                <p class="fw-400" style="color: black">Zumrad</p>
                                                                <div class="col-12 mt-10 text-center">
                                                                    <h6 style="color: red">1</h6>
                                                                </div>
                                                            </div>
                                                        @else
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                            @if($passed  && $passed->limit <= 0 && $user->status == 1)
                                                <div class="text-center mt-30">
                                                    <h5 style="color: #dc1111">
                                                        Sizga berilgan imkoniyatlar tugadi.
                                                        Siz endi to'plagan zumradlarigizdan foydalanib,
                                                        imkoniyat olishingiz mumkin!
                                                    </h5>
                                                </div>

                                                <div class="text-center">
                                                    <form action="{{route('imkoniyat')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                                        <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
                                                        <button type="submit" class="btn btn-success mt-20"
                                                                style="color: white; padding: 10px">
                                                            Imkoniyat olish
                                                            <i class="icon-infinity"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-center">
                                        <button class="btn btn-warning text-white" type="button" data-bs-toggle="modal"
                                                data-bs-target="#TestNatija" style="padding: 10px">
                                            <i class="fas fa-eye"></i>
                                            Natijani ko'rish
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center">
                                        <button class="btn btn-info text-white" type="button" data-bs-toggle="modal"
                                                data-bs-target="#Test" style="padding: 10px">
                                            Test yechish
                                            <i class="fas fa-fast-forward ml-10"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="TestNatija" tabindex="-1" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-center" style="padding: 10px 20px">
                                                <h2 class="fw-700">{{$lesson->title}}</h2>
                                            </div>
                                            <div>
                                                <div class="row">
                                                    @foreach($result as $res)
                                                        <div
                                                            class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-20">
                                                            @php
                                                                $number = 1;
                                                            @endphp
                                                            <h5 class="fw-500 text-center">{{$urinish++}} chi
                                                                urinish</h5>
                                                            <div class="row">
                                                                <p class="col-3"
                                                                   style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                    Javoblaringiz
                                                                </p>
                                                                <p class="col-1"
                                                                   style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                    To'g'ri
                                                                </p>

                                                                <p class="col-1"
                                                                   style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                    Noto'g'ri
                                                                </p>

                                                                <p class="col-2"
                                                                   style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                    Ishlash kerak
                                                                </p>

                                                                <p class="col-2"
                                                                   style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                    To'plagan ball
                                                                </p>

                                                                <p class="col-3"
                                                                   style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                    Status
                                                                </p>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-3" style="padding: 0 !important;">
                                                                    @foreach($res->user_answers as $questionNumber => $answer)
                                                                        @php
                                                                            $userAnswer = current($answer);
                                                                            $test = Test::find($questionNumber);
                                                                            $correctAnswer = $test ? $test->answer : null;
                                                                            $mark = ($userAnswer == $correctAnswer) ? '+' : '-';
                                                                        @endphp
                                                                        <p>
                                                                            {{$number++}}.
                                                                            @foreach($answer as $subAnswer)
                                                                                {{ $subAnswer }}
                                                                            @endforeach
                                                                            <span style="margin-right: 5px;">
                                                                           @if($mark == '+')
                                                                                    <i class="fas fa-check"
                                                                                       style="color: green"></i>
                                                                                @elseif($mark == '-')
                                                                                    <i class="fas fa-times"
                                                                                       style="color: red;"></i>
                                                                                @endif
                                                                            </span>
                                                                        </p>
                                                                    @endforeach
                                                                </div>
                                                                <div
                                                                    class="col-1 justify-content-center d-flex align-items-center"
                                                                    style="background: green; color: white; border: 2px solid white;padding: 0 !important;">
                                                                    <p>{{$res->correct_answer}}</p>
                                                                </div>
                                                                <div
                                                                    class="col-1 justify-content-center d-flex align-items-center"
                                                                    style="background: red;color: white; border: 2px solid white;padding: 0 !important;">
                                                                    <p>{{$res->question_numbers - $res->correct_answer}}</p>
                                                                </div>
                                                                <div
                                                                    class="col-2 d-flex align-items-center justify-content-center"
                                                                    style="background: green; color: white; border: 2px solid white;padding: 0 !important;">
                                                                    <p>{{$group_test->ball}}</p>
                                                                </div>

                                                                @if($res->foiz >= $group_test->ball)
                                                                    <div
                                                                        class="col-2 justify-content-center d-flex align-items-center"
                                                                        style="background: green;color: white; border: 2px solid white;padding: 0 !important;">
                                                                        <p>{{$res->foiz}}</p>
                                                                    </div>
                                                                @else
                                                                    <div
                                                                        class="col-2 justify-content-center d-flex align-items-center"
                                                                        style="background: red;color: white; border: 2px solid white;padding: 0 !important;">
                                                                        <p>{{$res->foiz}}</p>
                                                                    </div>
                                                                @endif
                                                                @if($res->foiz >= $group_test->ball)
                                                                    <div class="col-3 d-flex align-items-center"
                                                                         style="background: green; color: white; border: 2px solid white; padding: 0 !important;">
                                                                        <p>
                                                                            O'tdingiz
                                                                        </p>
                                                                    </div>
                                                                @else
                                                                    <div
                                                                        class="col-3 d-flex align-items-center justify-content-center"
                                                                        style="background: red; color: white; border: 2px solid white; padding: 0 !important;">
                                                                        <p>
                                                                            O'tmadingiz
                                                                        </p>
                                                                    </div>
                                                                @endif
                                                                <hr>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="Test" tabindex="-1" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-center">
                                                <img src="{{asset('assets/img/ibrat/test.png')}}" alt="">
                                            </div>
                                            <div class="text-center" style="padding: 10px 20px">
                                                <h2 class="fw-700">Testni yechishga tayyormisiz!</h2>
                                            </div>
                                            <div class="text-center" style="padding: 10px 30px">
                                                <h5 style="color: gray">Tayyor bo'lgach, boshlash tugmasini bosing</h5>
                                            </div>
                                            <div style="padding: 10px 10px">
                                                <div class="row">
                                                    <div class="col-xxl-3 col-xl-3 col-4 mt-20 text-center">
                                                        <i class="icon-bar-chart-2 text-14 lh-1"
                                                           style="color: blue"></i>
                                                        <br>
                                                        <p class="fw-400" style="color: black">Daraja</p>
                                                        @if($passed == null)
                                                            <div class="col-12 text-center mt-10">
                                                                <h6 style="color: red">{{$group_test ? $group_test->level :null}}</h6>
                                                            </div>
                                                        @else
                                                            <div class="col-12 text-center mt-10">
                                                                <h6 style="color: red">{{$group_test->level}}</h6>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-xxl-2 col-xl-2 col-4 mt-20 text-center">
                                                        <i class="fas fa-question text-14 lh-1" style="color: blue"></i>
                                                        <br>
                                                        <p class="fw-400" style="color: black">Savol</p>
                                                        @if($passed == null)
                                                            <div class="col-12 mt-10 text-center">
                                                                <h6 style="color: red">{{$test_count}}</h6>
                                                            </div>
                                                        @else
                                                            <div class="col-12 mt-10 text-center">
                                                                <h6 style="color: red">{{$test_count}}</h6>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-xxl-2 col-xl-2  col-4  mt-20 text-center">
                                                        <i class="fas fa-star text-14 lh-1" style="color: blue;"></i>
                                                        <br>
                                                        <p class="fw-400" style="color: black">O'tish bali</p>
                                                        @if($passed == null)
                                                            <div class="col-12 mt-10 text-center">
                                                                <h6 style="color: red">{{$group_test ? $group_test->ball : null}}
                                                                    /100</h6>
                                                            </div>
                                                        @else
                                                            <div class="col-12 mt-10 text-center">
                                                                <h6 style="color: red">{{$group_test->ball}}/100</h6>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-xxl-2 col-xl-2 col-4 mt-20 text-center">
                                                        <i class="icon-infinity text-14 lh-1" style="color:blue;"></i>
                                                        <br>
                                                        <p class="fw-400" style="color: black">Imkoniyat</p>
                                                        @if($passed == null)
                                                            <div class="col-12 mt-10 text-center">
                                                                <h6 style="color: red">{{ $group_test ? $group_test->limit : null}}</h6>
                                                            </div>
                                                        @else
                                                            <div class="col-12 mt-10 text-center">
                                                                <h6 style="color: red">{{$passed->limit}}</h6>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    @if($user->status == 1)
                                                        <div class="col-xxl-2 col-xl-2 col-4 mt-20 text-center">
                                                            <i class="fas fa-gem text-14 lh-1" style="color:blue;"></i>
                                                            <br>
                                                            <p class="fw-400" style="color: black">Zumrad</p>
                                                            <div class="col-12 mt-10 text-center">
                                                                <h6 style="color: red">1</h6>
                                                            </div>
                                                        </div>
                                                    @else
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <a href="{{url('user/lesson-test/'.$lesson->id)}}"
                                                   class="btn btn-warning mt-20" style="color: white; padding: 10px">
                                                    Davom etish
                                                    <i class="fas fa-fast-forward ml-10"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @else
                @endif
            </div>
        </div>
        @include('user.components.footer')
    </div>

@endsection
@section('natija_js')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            var natijaModal = document.getElementById('Natija');

            if (natijaModal.classList.contains('show')) {
                document.body.classList.add('modal-open');
                var backdrop = document.createElement('div');
                backdrop.classList.add('modal-backdrop', 'show');
                document.body.appendChild(backdrop);
                // .modal-backdrop.show {
                //         opacity: var(--bs-backdrop-opacity);
                //     }
            }
        });
        // Modal yopish uchun JavaScript
        document.getElementById('closeModalButton').addEventListener('click', function () {
            var body = document.body
            var modal = document.getElementById('Natija');
            var backdrop = document.querySelector('.modal-backdrop.show');
            modal.classList.remove('show');
            modal.style.display = 'none';
            body.classList.remove('modal-open');
            if (backdrop) {
                backdrop.remove();
            }
        });
    </script>
@endsection

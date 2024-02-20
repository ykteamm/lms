<?php
$number = 1;

use app\Models\Test;

?>
@extends('user.layouts.app')
@section('title','Video')
@section('dashboard')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">
            @if($pass_data != null && $pass_data->pass_status == 0)
                <div class="row">
                    <div class="col-12 ">
                        <div class="alert bg-error-1 alert-dismissible fade show pb-20 pt-20 pl-20 pr-20 rounded-8"
                             role="alert">
                            <div class="text-error-2 lh-1 fw-500">
                                Sizda {{$pass_data->limit}}ta limit qoldi, yaxshilab o'ylab ko'rib ishlang!
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @elseif($pass_data != null && $pass_data->pass_status == 1)
                <div class="row">
                    <div class="col-12 ">
                        <div class="alert bg-success-1 alert-dismissible fade show pb-20 pt-20 pl-20 pr-20 rounded-8"
                             role="alert">
                            <div class="text-success-2 lh-1 fw-500">
                                Siz bu darsni muvaffaqiyatli o'zlashtirgansiz!
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12 ">
                        <div class="alert bg-success-1 alert-dismissible fade show pb-20 pt-20 pl-20 pr-20 rounded-8"
                             role="alert">
                            <div class="text-success-2 lh-1 fw-500">
                                Sizda {{$group_test_id->limit}} ta imkoniyat bor. Omadizni bersin!
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif

            <div class="container mb-50">
                <a href="{{url('user')}}" class="btn btn-danger">
                    <i class=" fas fa-backward"></i>
                    Back
                </a>
            </div>
            @if(isset($course_id) && $course_id != null)
                <div class="row pb-50 mb-10">
                    <div class="col-6">
                        <h1 class="text-30 lh-12 fw-700">{{$course_id->title}}</h1>
                    </div>
                </div>

                <div class="content-wrapper  js-content-wrapper">
                    <section class="">
                        <div class="relative pt-40 col-12">
                            <img class="w-1/1" src="{{asset('assets/img/lesson-single/1.png')}}" alt="image">
                            <div class="absolute-full-center d-flex justify-center items-center">
                                <a href="{{$video_id->url}}"
                                   class="d-flex justify-center items-center size-60 rounded-full bg-white js-gallery"
                                   data-gallery="gallery1">
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
                                                {{$video_id->content}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    @if(!$result->isEmpty())
                        <div class="accordion accordion-flush width" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseOne" aria-expanded="false"
                                            aria-controls="flush-collapseOne">
                                        Natijani ko'rish
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                     aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <table class="table table-sm">
                                            <thead>
                                            <tr>
                                                <th scope="col">T/r</th>
                                                <th scope="col">Dars nomi</th>
                                                <th scope="col">Sizning Javoblaringiz</th>
                                                <th scope="col">Umumiy savol</th>
                                                <th scope="col">To'g'ri</th>
                                                <th scope="col">Noto'g'ri</th>
                                                <th scope="col">Foiz</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($result as $res)
                                                <tr>
                                                    <th scope="row">{{$number++}}</th>
                                                    <td>{{$lesson_have->title}}</td>
                                                    <td>
                                                        @foreach($res->user_answers as $questionNumber => $answer)
                                                            @php
                                                                $userAnswer = current($answer);
                                                                $test = Test::find($questionNumber);
                                                                $correctAnswer = $test ? $test->answer : null;
                                                                $mark = ($userAnswer == $correctAnswer) ? '+' : '-';
                                                            @endphp
                                                            <li style="list-style-type: decimal;">
                                                                @foreach($answer as $subAnswer)
                                                                    {{ $subAnswer }}
                                                                @endforeach
                                                                <span style="margin-right: 5px;">
                                                    @if($mark == '+')
                                                                        <i class="fas fa-check"
                                                                           style="color: green"></i>
                                                                    @elseif($mark == '-')
                                                                        <i class="fas fa-times" style="color: red;"></i>
                                                                    @endif
                                                </span>
                                                            </li>
                                                        @endforeach
                                                    </td>
                                                    <td>{{$res->question_numbers}}</td>
                                                    <td style="background: green; color: white;">{{$res->correct_answer}}</td>
                                                    <td style="background: red;color: white;">{{$res->question_numbers - $res->correct_answer}}</td>
                                                    @if($res->foiz >= $group_test_id->ball)
                                                        <td style="background: green;color: white;">{{$res->foiz}}</td>
                                                    @else
                                                        <td style="background: red;color:white;">{{$res->foiz}}</td>
                                                    @endif
                                                    @if($res->foiz >= $group_test_id->ball)
                                                        <td style="background: green; color: white">
                                                            O'tdingiz
                                                        </td>
                                                    @else
                                                        <td style="background: red; color: white">
                                                            O'tolmadingiz
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                    @endif

                    @if($pass_data == null || $pass_data->pass_status != 1)
                        <div class="text-center">
                            <a href="{{ url('user/lesson-test/'.$lesson_have->id.'/rasp_id/'.$raspisaniya->id) }}"
                               class="btn btn-success mt-20">
                                Test yechish
                            </a>
                        </div>
                    @else
                    @endif

                </div>
            @else
            @endif
            @if(isset($medicine_id) && $medicine_id != null)
                <div class="row pb-50 mb-10">
                    <div class="col-6">
                        <h1 class="text-30 lh-12 fw-700">{{$course_med_id->title}}</h1>
                    </div>
                </div>
                <div class="content-wrapper  js-content-wrapper">
                    <section class="">
                        <div class="relative pt-40">
                            <img class="w-1/1" src="{{asset('assets/img/lesson-single/1.png')}}" alt="image">
                            <div class="absolute-full-center d-flex justify-center items-center">
                                <a href="{{$video_med_id->url}}"
                                   class="d-flex justify-center items-center size-60 rounded-full bg-white js-gallery"
                                   data-gallery="gallery1">
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
                                                {{$video_med_id->content}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    @if(!$result->isEmpty())
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseOne" aria-expanded="false"
                                            aria-controls="flush-collapseOne">
                                        Natijani ko'rish
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                     aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <table class="table table-sm">
                                            <thead>
                                            <tr>
                                                <th scope="col">T/r</th>
                                                <th scope="col">Dars nomi</th>
                                                <th scope="col">Sizning Javoblaringiz</th>
                                                <th scope="col">Umumiy savol</th>
                                                <th scope="col">To'g'ri</th>
                                                <th scope="col">Noto'g'ri</th>
                                                <th scope="col">Foiz</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($result as $res)
                                                <tr>
                                                    <th scope="row">{{$number++}}</th>
                                                    <td>{{$lesson_have->title}}</td>
                                                    <td>
                                                        @foreach($res->user_answers as $questionNumber => $answer)
                                                            @php
                                                                $userAnswer = current($answer);
                                                                $test = Test::find($questionNumber);
                                                                $correctAnswer = $test ? $test->answer : null;
                                                                $mark = ($userAnswer == $correctAnswer) ? '+' : '-';
                                                            @endphp
                                                            <li style="list-style-type: decimal;">
                                                                @foreach($answer as $subAnswer)
                                                                    {{ $subAnswer }}
                                                                @endforeach
                                                                <span style="margin-right: 5px;">
                                                   @if($mark == '+')
                                                                        <i class="fas fa-check"
                                                                           style="color: green"></i>
                                                                    @elseif($mark == '-')
                                                                        <i class="fas fa-times" style="color: red;"></i>
                                                                    @endif
                                                </span>
                                                            </li>
                                                        @endforeach
                                                    </td>
                                                    <td>{{$res->question_numbers}}</td>
                                                    <td style="background: green; color: white;">{{$res->correct_answer}}</td>
                                                    <td style="background: red;color: white;">{{$res->question_numbers - $res->correct_answer}}</td>
                                                    @if($res->foiz >= $group_test_id->ball)
                                                        <td style="background: green;color: white;">{{$res->foiz}}</td>
                                                    @else
                                                        <td style="background: red;color:white;">{{$res->foiz}}</td>
                                                    @endif
                                                    @if($res->foiz >= $group_test_id->ball)
                                                        <td style="background: green; color: white">
                                                            O'tdingiz
                                                        </td>
                                                    @else
                                                        <td style="background: red; color: white">
                                                            O'tolmadingiz
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                    @endif

                    @if($pass_data == null || $pass_data->pass_status != 1)
                        <div class="text-center">
                            <a href="{{ url('user/lesson-med-test/'.$lesson_have->id.'/rasp_id/'.$raspisaniya->id) }}"
                               class="btn btn-success mt-20">
                                Test yechish
                            </a>
                        </div>
                    @else
                    @endif
                </div>
            @else
            @endif


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


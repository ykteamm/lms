<?php
$t_r = 0;
use App\Models\Test;
?>
@extends('user.layouts.app')
@section('css')
@endsection
@section('title','LMS')
@section('dashboard')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">
            <div class="row pb-50 mb-10">
                <div class="col-12">
                    <a href="{{route('user')}}" class="btn btn-danger text-white">
                        <i class=" fas fa-backward"></i>
                        Orqaga qaytish
                    </a>
                </div>

                <div class="col-auto mt-20">
                    <h1 class="text-30 lh-12 fw-700">Shogirdlarim</h1>
                </div>
            </div>
            <div class="row y-gap-30">
                <div class="col-12">
                    <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
                        <div class="tabs -active-purple-2 js-tabs pt-0">
                            <div class="tabs__controls d-flex x-gap-30 items-center pt-20 px-30 border-bottom-light js-tabs-controls">
                                <button class="tabs__button text-light-1 js-tabs-button is-active" data-tab-target=".-tab-item-1" type="button">
                                    Butun davr
                                </button>
                                <button class="tabs__button text-light-1 js-tabs-button" data-tab-target=".-tab-item-2" type="button">
                                    Haftalik
                                </button>
                                <button class="tabs__button text-light-1 js-tabs-button" data-tab-target=".-tab-item-3" type="button">
                                    Oylik
                                </button>
                            </div>

                            <div class="tabs__content py-30 px-30 js-tabs-content">
                                <div class="tabs__pane -tab-item-1 is-active">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        @foreach($users as $use)
                                            @if($use['id'] == $user->id)
                                                <div class="accordion-item border mt-20">
                                                    <h2 class="accordion-header" id="flush-heading{{$use['id']}}">
                                                        <button class="accordion-button collapsed" style="background: green;color: white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$use['id']}}" aria-expanded="false" aria-controls="flush-collapse{{$use['id']}}">
                                                            {{$use['firstname']}} {{$use['lastname']}}
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapse{{$use['id']}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$use['id']}}" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body">
                                                            @foreach($lesson_ids as $ids)
                                                            @php
                                                                $urinish  = 1;
                                                            @endphp
                                                                @foreach($answer_check as $check)
                                                                    @if($ids['lesson_id'] == $check['lesson_id'])
                                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-20">
                                                                            @php
                                                                                $number = 1;
                                                                            @endphp
                                                                            <h4 class="fw-500 text-center">{{$ids['lesson_id']}} Dars</h4>
                                                                            <h6 class="fw-500 text-center">{{$urinish++}} chi urinish</h6>
                                                                            <div class="row">
                                                                                <p class="col-5 text-center" style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                                    Javoblar
                                                                                </p>
                                                                                <p class="col-1 text-center"  style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                                    <i class="fas fa-check" style="color: green"></i>
                                                                                </p>

                                                                                <p class="col-1 text-center" style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                                    <i class="fas fa-times" style="color: red;"></i>
                                                                                </p>

                                                                                <p class="col-2 text-center" style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                                    Ball
                                                                                </p>

                                                                                <p class="col-3 text-center" style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                                    Status
                                                                                </p>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-5" style="border-left: 1px  solid black;border-right: 1px  solid black; border-bottom: 1px  solid black; padding: 0 !important;">
                                                                                    @foreach($check->user_answers as $questionNumber => $answer)
                                                                                        @php
                                                                                            $userAnswer = current($answer);
                                                                                            $test = Test::find($questionNumber);
                                                                                            $correctAnswer = $test ? $test->answer : null;
                                                                                            $mark = ($userAnswer == $correctAnswer) ? '+' : '-';
                                                                                        @endphp
                                                                                        {{$number++}}.
                                                                                        @foreach($answer as $subAnswer)
                                                                                            {{ $subAnswer }}
                                                                                        @endforeach
                                                                                        <span style="margin-right: 5px;">
                                                                                        @if($mark == '+')
                                                                                            <i class="fas fa-check" style="color: green"></i>
                                                                                        @elseif($mark == '-')
                                                                                            <i class="fas fa-times" style="color: red;"></i>
                                                                                        @endif
                                                                                        </span>
                                                                                    @endforeach
                                                                                </div>
                                                                                <div class="col-1 justify-content-center d-flex align-items-center"  style="background: green; color: white; border: 2px solid white;padding: 0 !important;">
                                                                                    {{$check['correct_answer']}}
                                                                                </div>
                                                                                <div class="col-1 justify-content-center d-flex align-items-center" style="background: red;color: white; border: 2px solid white;padding: 0 !important;">
                                                                                    {{$check['question_numbers'] - $check['correct_answer']}}
                                                                                </div>
                                                                                @foreach($group_test as $group)
                                                                                    @if($check['lesson_id'] == $group['lesson_id'])
                                                                                        @if($check['foiz'] >= $group['ball'])
                                                                                        <div class="col-2 d-flex align-items-center justify-content-center" style="background: green; color: white; border: 2px solid white;padding: 0 !important;">
                                                                                              {{$check['foiz']}}
                                                                                        </div>
                                                                                        @else
                                                                                        <div class="col-2 d-flex align-items-center justify-content-center" style="background: red; color: white; border: 2px solid white;padding: 0 !important;">
                                                                                           {{$check['foiz']}}
                                                                                        </div>
                                                                                        @endif
                                                                                    @endif
                                                                                @endforeach
                                                                                @foreach($group_test as $group)
                                                                                    @if($check['lesson_id'] == $group['lesson_id'])
                                                                                        @if($check['foiz'] >= $group['ball'])
                                                                                            <div class="col-3 d-flex align-items-center justify-content-center" style="background: green; color: white; border: 2px solid white;padding: 0 !important;">
                                                                                                O'tdi
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="col-3 d-flex align-items-center justify-content-center" style="background: red; color: white; border: 2px solid white;padding: 0 !important;">
                                                                                                O'tmadi
                                                                                            </div>
                                                                                        @endif
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                         </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="accordion-item border mt-20">
                                                    <h2 class="accordion-header" id="flush-heading{{$use['id']}}">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$use['id']}}" aria-expanded="false" aria-controls="flush-collapse{{$use['id']}}">
                                                            {{$use['firstname']}} {{$use['lastname']}}
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapse{{$use['id']}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$use['id']}}" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body">
                                                            @foreach($lesson_ids as $ids)
                                                                @php
                                                                    $urinish  = 1;
                                                                @endphp
                                                                @foreach($answer_check as $check)
                                                                    @if($ids['lesson_id'] == $check['lesson_id'])
                                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-20">
                                                                            @php
                                                                                $number = 1;
                                                                            @endphp
                                                                            <h4 class="fw-500 text-center">{{$ids['lesson_id']}} Dars</h4>
                                                                            <h6 class="fw-500 text-center">{{$urinish++}} chi urinish</h6>
                                                                            <div class="row">
                                                                                <p class="col-5 text-center" style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                                    Javoblar
                                                                                </p>
                                                                                <p class="col-1 text-center"  style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                                    <i class="fas fa-check" style="color: green"></i>
                                                                                </p>

                                                                                <p class="col-1 text-center" style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                                    <i class="fas fa-times" style="color: red;"></i>
                                                                                </p>

                                                                                <p class="col-2 text-center" style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                                    Ball
                                                                                </p>

                                                                                <p class="col-3 text-center" style="color: black;border: 1px solid black;padding: 0 !important;">
                                                                                    Status
                                                                                </p>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-5" style="border-left: 1px  solid black;border-right: 1px  solid black; border-bottom: 1px  solid black; padding: 0 !important;">
                                                                                    @foreach($check->user_answers as $questionNumber => $answer)
                                                                                        @php
                                                                                            $userAnswer = current($answer);
                                                                                            $test = Test::find($questionNumber);
                                                                                            $correctAnswer = $test ? $test->answer : null;
                                                                                            $mark = ($userAnswer == $correctAnswer) ? '+' : '-';
                                                                                        @endphp
                                                                                        {{$number++}}.
                                                                                        @foreach($answer as $subAnswer)
                                                                                            {{ $subAnswer }}
                                                                                        @endforeach
                                                                                        <span style="margin-right: 5px;">
                                                                                        @if($mark == '+')
                                                                                                <i class="fas fa-check" style="color: green"></i>
                                                                                            @elseif($mark == '-')
                                                                                                <i class="fas fa-times" style="color: red;"></i>
                                                                                            @endif
                                                                                        </span>
                                                                                    @endforeach
                                                                                </div>
                                                                                <div class="col-1 justify-content-center d-flex align-items-center"  style="background: green; color: white; border: 2px solid white;padding: 0 !important;">
                                                                                    {{$check['correct_answer']}}
                                                                                </div>
                                                                                <div class="col-1 justify-content-center d-flex align-items-center" style="background: red;color: white; border: 2px solid white;padding: 0 !important;">
                                                                                    {{$check['question_numbers'] - $check['correct_answer']}}
                                                                                </div>
                                                                                @foreach($group_test as $group)
                                                                                    @if($check['lesson_id'] == $group['lesson_id'])
                                                                                        @if($check['foiz'] >= $group['ball'])
                                                                                            <div class="col-2 d-flex align-items-center justify-content-center" style="background: green; color: white; border: 2px solid white;padding: 0 !important;">
                                                                                                {{$check['foiz']}}
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="col-2 d-flex align-items-center justify-content-center" style="background: red; color: white; border: 2px solid white;padding: 0 !important;">
                                                                                                {{$check['foiz']}}
                                                                                            </div>
                                                                                        @endif
                                                                                    @endif
                                                                                @endforeach
                                                                                @foreach($group_test as $group)
                                                                                    @if($check['lesson_id'] == $group['lesson_id'])
                                                                                        @if($check['foiz'] >= $group['ball'])
                                                                                            <div class="col-3 d-flex align-items-center justify-content-center" style="background: green; color: white; border: 2px solid white;padding: 0 !important;">
                                                                                                O'tdi
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="col-3 d-flex align-items-center justify-content-center" style="background: red; color: white; border: 2px solid white;padding: 0 !important;">
                                                                                                O'tmadi
                                                                                            </div>
                                                                                        @endif
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tabs__pane -tab-item-2">
                                </div>
                                <div class="tabs__pane -tab-item-3">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('user.components.footer')
    </div>
@endsection

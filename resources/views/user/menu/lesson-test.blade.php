<?php
$number = 1;
$user = auth()->user();
?>
@extends('user.layouts.app')
@section('title','Test')
@section('dashboard')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">

            <div class="container mb-50">
                <a href="{{url('user/lesson-show/'.$lesson->id)}}" class="btn btn-danger">
                    <i class=" fas fa-backward"></i>
                    Orqaga qaytish
                </a>
            </div>

                <div class="row ">
                    <div class="col-12">
                        <h1 class="text-30 lh-12 fw-700">{{$lesson->title}}</h1>
                    </div>
                </div>
                <div class="content-wrapper  js-content-wrapper">
                    <div class="d-flex flex-column">
                        <section class="pt-40 layout-pb-lg lg:order-2">
                            <div class="container">
                                <div class="row">
                                     <form action="
                                     @if($user->status ==0)
                                     {{route('first_test')}}
                                     @elseif($user->status == 1)
                                     {{route('all_test')}}
                                     @endif
                                     " method="POST">
                                         @csrf
                                         @foreach($tests as $first)
                                             <input type="hidden" name="question_ids[]" value="{{$first->id}}">
                                             <input type="hidden" name="course_id" value="{{$course_id->course_id}}">
                                             <input type="hidden" name="module_id" value="{{$lesson->module_id}}">
                                             <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
                                             <input type="hidden" name="ball" value="{{$group_test->ball}}">
                                             <input type="hidden" name="limit" value="{{$group_test->limit}}">
                                             <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                 <div class="border-light overflow-hidden rounded-8">
                                                            <div class="py-40 px-40 py:lg-40 bg-dark-5">
                                                                <div class="d-flex justify-between">
                                                                    <h4 class="text-18 lh-1 fw-500 text-white">Savol: {{$number++}}</h4>
                                                                </div>
                                                                <div class="text-20 lh-1 text-white mt-30" style="text-transform: capitalize">{{$first->title}}</div>
                                                            </div>

                                                            <div class="px-40 py-40">
                                                                <div class="form-radio d-flex items-center">
                                                                    <div class="radio">
                                                                        <input type="radio" value="A" name="answers[{{ $first->id }}][]" class="answer_check{{$first->id}}" required>
                                                                        <div class="radio__mark">
                                                                            <div class="radio__icon"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="fw-500 ml-12" style="text-transform: capitalize">A) {{$first->variant_a}}</div>
                                                                </div>

                                                                <div class="form-radio d-flex items-center mt-20">
                                                                    <div class="radio">
                                                                        <input type="radio" value="B" name="answers[{{ $first->id }}][]" class="answer_check{{$first->id}}" required>
                                                                        <div class="radio__mark">
                                                                            <div class="radio__icon"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="fw-500 ml-12" style="text-transform: capitalize">B) {{$first->variant_b}}</div>
                                                                </div>

                                                                <div class="form-radio d-flex items-center mt-20">
                                                                    <div class="radio">
                                                                        <input type="radio" value="C" name="answers[{{ $first->id }}][]" class="answer_check{{$first->id}}" required>
                                                                        <div class="radio__mark">
                                                                            <div class="radio__icon"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="fw-500 ml-12" style="text-transform: capitalize">C) {{$first->variant_c}}</div>
                                                                </div>

                                                                <div class="form-radio d-flex items-center mt-20">
                                                                    <div class="radio">
                                                                        <input type="radio" value="D" name="answers[{{ $first->id }}][]" class="answer_check{{$first->id}}" required>
                                                                        <div class="radio__mark">
                                                                            <div class="radio__icon"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="fw-500 ml-12" style="text-transform: capitalize">D) {{$first->variant_d}}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                             </div>
                                         @endforeach
                                         <div class="" style="text-align: center" id="tugatish">
                                             <button type="submit" class="button -md -dark-1 text-white -dark-button-white mt-40" onclick="submitWithDelay()">Testni tugatish</button>
                                         </div>

                                         <div class=" d-none" style="text-align: center" id="kutish">
                                             <button type="button" class="button -md -dark-1 text-white -dark-button-white mt-40" >Biroz kuting!!!</button>
                                         </div>


{{--                                         <div class="modal-footer" id="for-open-smena-user-none">--}}
{{--                                             <button type="submit"--}}
{{--                                                     onclick="$('#for-open-smena-user-none').addClass('d-none');$('#for-open-smena-user').removeClass('d-none');"--}}
{{--                                                     class="btn btn-success">Smena ochish</button>--}}
{{--                                         </div>--}}
{{--                                         <div class="modal-footer d-none" id="for-open-smena-user">--}}
{{--                                             <button type="button" class="btn btn-primary">Biroz kuting !!!</button>--}}
{{--                                         </div>--}}


                                     </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

            @include('user.components.footer')
        </div>
    </div>
@endsection
@section('natija_js')
    <script type="text/javascript">
        function submitWithDelay() {
            // Hide the first button and show the second button
            document.getElementById('tugatish').classList.add('d-none');
            document.getElementById('kutish').classList.remove('d-none');
        }
    </script>
@endsection

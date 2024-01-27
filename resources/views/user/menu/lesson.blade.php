<?php
use App\Models\Passed;
use App\Models\AnswerCheck;
use App\Models\GroupTest;
$user = auth()->user();
?>
@extends('user.layouts.app')
@section('title','Darslar')
@section('dashboard')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">

            <div class="row pb-20 mb-10">
                <div class="col-8">
                    <a href="{{url('user/module/'.$course->course_id)}}" class="btn btn-danger text-white">
                        <i class=" fas fa-backward"></i>
                        Orqaga qaytish
                    </a>
                </div>
                <div class="col-1"></div>
                @if($user->status == 1)
                    <div class="col-3 text-center">
                        <i class="fas fa-gem text-14 lh-1" style="color:blue;"></i>
                        @if($zumrad != null)
                            {{$zumrad->zumrad}}
                        @else
                            0
                        @endif
                    </div>
                @else
                @endif
            </div>

{{--            @if(session()->has('natija'))--}}
{{--                @php--}}
{{--                    $group_test = GroupTest::where('lesson_id',$less->id)->first();--}}
{{--                    $passed = Passed::where(['lesson_id'=>$less->id,'user_id'=>$user->id])->first();--}}
{{--                    $natija_pass = Passed::where(['lesson_id'=>$less->id,'user_id'=>$user->id])->orderBy('id','desc')->first();--}}
{{--                    $natija_result = AnswerCheck::where(['user_id'=>$user->id,'lesson_id'=>$less->id])->orderBy('id','desc')->first();--}}
{{--                @endphp--}}
{{--                <div class="modal fade show" id="Natija"  tabindex="-1" aria-labelledby="exampleModalLabel"  aria-modal="true" role="dialog" style="display: block">--}}
{{--                    <div class="modal-dialog modal-lg" >--}}
{{--                        <div class="modal-content">--}}
{{--                            <div class="modal-header">--}}
{{--                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModalButton"></button>--}}
{{--                            </div>--}}
{{--                            <div class="modal-body">--}}
{{--                                <div class="text-center">--}}
{{--                                    <img src="{{asset('assets/img/ibrat/natija.jpg')}}" width="200" height="50" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="text-center" style="padding: 10px 20px">--}}
{{--                                    <h2 class="fw-700">Test yakunlandi</h2>--}}
{{--                                </div>--}}
{{--                                <div class="text-center" style="padding: 10px 30px">--}}
{{--                                    @if($group_test->ball <= $natija_result->foiz)--}}
{{--                                        <h5 style="color: #16e116">Muvaffaqiyatli o'tdingiz</h5>--}}
{{--                                    @else--}}
{{--                                        <h5 style="color: red">Muvaffaqiyatsiz urunish</h5>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                                <div style="padding: 10px 10px">--}}
{{--                                    <div class="row align-items-center">--}}
{{--                                        <div class="col-xxl-3 col-xl-3  col-6  mt-20 text-center">--}}
{{--                                            <i class="fas fa-star text-14 lh-1" style="color: blue;"></i>--}}
{{--                                            <br>--}}
{{--                                            <p class="fw-400" style="color: black">O'tish bali</p>--}}
{{--                                            @if($passed == null)--}}
{{--                                                <div class="col-12 mt-10 text-center">--}}
{{--                                                    <h6 style="color: red">{{$group_test ? $group_test->ball : null}}</h6>--}}
{{--                                                </div>--}}
{{--                                            @else--}}
{{--                                                <div class="col-12 mt-10 text-center">--}}
{{--                                                    <h6 style="color: red">{{$group_test->ball}}</h6>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                        <div class="col-xxl-3 col-xl-3   col-6  mt-20 text-center">--}}
{{--                                            <i class="fas fa-star text-14 lh-1" style="color: blue;"></i>--}}
{{--                                            <br>--}}
{{--                                            <p class="fw-400" style="color: black">To'plagan balingiz</p>--}}
{{--                                            <div class="col-12 mt-10 text-center">--}}
{{--                                                @if($group_test->ball <= $natija_result->foiz)--}}
{{--                                                    <h6 style="color: white; background: green;">{{$natija_result->foiz}}</h6>--}}
{{--                                                @else--}}
{{--                                                    <h6 style="color: white; background: red;">{{$natija_result->foiz}}</h6>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-xxl-3 col-xl-3  col-6 mt-20 text-center">--}}
{{--                                            <i class="icon-infinity text-14 lh-1" style="color:blue;"></i>--}}
{{--                                            <br>--}}
{{--                                            <p class="fw-400" style="color: black">Imkoniyat</p>--}}
{{--                                            <div class="col-12 mt-10 text-center">--}}
{{--                                                <h6 style="color: red">{{$natija_pass->limit}}</h6>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-xxl-3 col-xl-3 col-6 mt-20 text-center">--}}
{{--                                            <i class="fas fa-gem text-14 lh-1" style="color:blue;"></i>--}}
{{--                                            <br>--}}
{{--                                            <p class="fw-400" style="color: black">Zumrad</p>--}}
{{--                                            <div class="col-12 mt-10 text-center">--}}
{{--                                                <h6 style="color: red">--}}
{{--                                                    @if($group_test->ball <= $natija_result->foiz)--}}
{{--                                                        1--}}
{{--                                                    @else--}}
{{--                                                        0--}}
{{--                                                    @endif--}}
{{--                                                </h6>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            @endif--}}

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

